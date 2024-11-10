<?php

namespace Core\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class AIAssistantController extends Controller
{
    protected $api_key;
    protected $default_model;
    protected $ai_settings;

    function __construct()
    {
        $api_config = DB::table('open_ai_settings')->first();

        $this->api_key = $api_config->api_key;
        $this->default_model = $api_config->default_model;
        $this->ai_settings = $api_config;
    }

    /**
     * AI Setting Page
     */
    public function AISetting()
    {
        $ai_settings =  $this->ai_settings;
        return view('core::base.blog.settings.ai_setting', compact('ai_settings'));
    }

    /**
     * Update Open AI Settings
     */
    public function updateAISetting(Request $request)
    {
        try {
            $model = ['text-ada-001', 'text-babbage-001', 'text-curie-001', 'text-davinci-003'];
            $request->validate([
                'default_model' => ['required', Rule::in($model)],
                'api_key'       => 'required'
            ], [
                'default_model.*' => translate('Please Select Default Model Again.'),
                'api_key.required' => translate('Secret API Key Field is Required.'),
            ]);
            
            DB::table('open_ai_settings')->latest('id')->update([
                'default_model' => xss_clean($request->default_model),
                'api_key' => xss_clean($request->api_key)
            ]);
            toastNotification('success', translate('Open AI Settings Updated Successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            toastNotification('error', translate('Open AI Settings Updating Failed'));
            return redirect()->back();
        }
    }

    /**
     * Generate content according to user input
     */
    public function generateContent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'primary_focus' => 'required',
            'priority_keywords' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($request['lang'] == "-1") {
            return response()->json(['errors' => [
                'language' => ['Please select a language']
            ]], 422);
        }
        if (!($request['short_details'] == "true" || $request['blog_details'] == "true" || $request['blog_title'] == "true")) {
            return response()->json(['errors' => [
                'request_type' => ['Please select any of the above to generate response']
            ]], 422);
        }
        try {
            $content_length = $request['content_length'];
            $short_content_length = $request['short_details_length'];
            $title_length = $request['title_length'];
            $blog_details = '';
            $short_details = '';
            $blog_title = '';
            if ($request['blog_details'] == "true") {
                $validator = Validator::make($request->all(), [
                    'content_length' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $response = $this->generateOutput('blog_details', $content_length, $request);
                if ($response['status']) {
                    $blog_details = $response['content'];
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => $response['message']
                    ], 500);
                }
            }
            if ($request['short_details'] == "true") {
                $validator = Validator::make($request->all(), [
                    'short_details_length' => 'required|numeric|max:100'
                ]);
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $response = $this->generateOutput('short_details', $short_content_length, $request);
                if ($response['status']) {
                    $short_details = $response['content'];
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => $response['message']
                    ], 500);
                }
            }
            if ($request['blog_title'] == "true") {
                $validator = Validator::make($request->all(), [
                    'title_length' => 'required|numeric|max:100'
                ]);
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $response = $this->generateOutput('blog_title', $title_length, $request);
                if ($response['status']) {
                    $blog_title = $response['content'];
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => $response['message']
                    ], 500);
                }
            }
            return response()->json([
                'success' => true,
                'blog_details' => $blog_details,
                'short_details' => $short_details,
                'blog_title' => $blog_title,
                'message' => 'Content generation successful'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to generate content'
            ], 500);
        }
    }
    /**
     * Request response from open api
     */
    public function generateOutput($type, $max_token, $request)
    {
        if ($type == 'blog_title') {
            $prompt = $this->generatePromptForBlogTitle($request);
        }
        if ($type == 'blog_details') {
            $prompt = $this->generatePromptForBlogContent($request);
        }
        if ($type == 'short_details') {
            $prompt = $this->generatePromptForShortDescription($request);
        }
        $apiUrl = 'https://api.openai.com/v1/completions';
        $apiKey = $this->api_key;
        $requestData = [
            'model' => $this->default_model,
            'prompt' => $prompt,
            'temperature' => (float)$request['creativity_level'],
            'max_tokens' => (int)$max_token
        ];
        $postFields = json_encode($requestData);
        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json'
        ]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields);
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($httpCode == 200) {
            $data = json_decode($response, true);
            $response = [
                'status' => true,
                'content' => $data['choices'][0]['text']
            ];
            return $response;
        } else {
            if ($httpCode == 401) {
                $response = [
                    'status' => false,
                    'message' => "Unauthorized access."
                ];
                return $response;
            } elseif ($httpCode == 404) {
                $response = [
                    'status' => false,
                    'message' => "Resource not found."
                ];
                return $response;
            } elseif ($httpCode == 429) {
                $response = [
                    'status' => false,
                    'message' => "You exceeded your current quota, please check your plan and billing details."
                ];
                return $response;
            } else {
                $response = [
                    'status' => false,
                    'message' => "Unable to generate content"
                ];
                return $response;
            }
        }
    }

    /**
     * generate prompt for short description
     */
    public function generatePromptForShortDescription($request)
    {
        $short_description_promt = [
            "ar" => "اكتب تفاصيل موجزة حول هذا الموضوع: " . $request['primary_focus'] . "\n\nاستخدم الكلمات الرئيسية التالية في المقال: " . $request['priority_keywords'] . "\n\nيجب أن يكون نغمة صوت المقال: " . $this->translateEditorialTone($request) . "\n\n",
            "bg" => "Напишете кратки подробности за тази тема: " . $request['primary_focus'] . "\n\nИзползвайте следните ключови думи в статията: " . $request['priority_keywords'] . "\n\nУверете се, че статията запазва тон: " . $this->translateEditorialTone($request) . "\n\n",
            "zh-CN" => "就这个主题写一些简短的细节: " . $request['primary_focus'] . " 創建一个引人注目的博客标题：\n在文章中运用以下关键词： " . $request['priority_keywords'] . "\n确保文章保持以下语调： " . $this->translateEditorialTone($request) . "\n\n",
            "zh-TW" => "就這個主題寫一些簡短的細節: " . $request['primary_focus'] . " 創建一個引人注目的部落格標題：\n在文章中運用以下關鍵詞： " . $request['priority_keywords'] . "\n確保文章保持以下語調： " . $this->translateEditorialTone($request) . "\n\n",
            "hr" => "Napišite kratke detalje o ovoj temi: " . $request['primary_focus'] . "\n\nIskoristite sljedeće ključne riječi u članku: " . $request['priority_keywords'] . "\n\nOsigurajte da članak održava ton: " . $this->translateEditorialTone($request) . "\n\n",
            "cs" => "Napište stručné informace k tomuto tématu: " . $request['primary_focus'] . "\n\nVyužijte následující klíčová slova v článku: " . $request['priority_keywords'] . "\n\nZajistěte, aby článek zachoval tón: " . $this->translateEditorialTone($request) . "\n\n",
            "da" => "Skriv nogle korte detaljer om dette emne: " . $request['primary_focus'] . "\n\nBrug følgende nøgleord i artiklen: " . $request['priority_keywords'] . "\n\nSørg for, at artiklen har en tone af: " . $this->translateEditorialTone($request) . "\n\n",
            "nl" => "Schrijf een korte toelichting over dit onderwerp: " . $request['primary_focus'] . "\n\nGebruik de volgende trefwoorden in het artikel: " . $request['priority_keywords'] . "\n\nZorg ervoor dat het artikel een toon heeft van: " . $this->translateEditorialTone($request) . "\n\n",
            "en" => "Write a short details on this topic: " . $request['primary_focus'] . "\n\nUtilize the following keywords in the article: " . $request['priority_keywords'] . "\n\nEnsure the article maintains a tone of: " . $this->translateEditorialTone($request) . "\n\n",
            "et" => "Kirjuta selle teema kohta lühikesed üksikasjad: " . $request['primary_focus'] . "\n\nKasuta järgnevaid märksõnu artiklis: " . $request['priority_keywords'] . "\n\nVeendu, et artikkel säilitab järgneva tooni: " . $this->translateEditorialTone($request) . "\n\n",
            "fi" => "Kirjoita lyhyet tiedot tästä aiheesta: " . $request['primary_focus'] . "\n\nHyödynnä seuraavia avainsanoja artikkelissa: " . $request['priority_keywords'] . "\n\nVarmista, että artikkeli säilyttää seuraavan sävyn: " . $this->translateEditorialTone($request) . "\n\n",
            "fr" => "Écrivez de courts détails sur ce sujet: " . $request['primary_focus'] . "\n\nUtilisez les mots-clés suivants dans l'article : " . $request['priority_keywords'] . "\n\nAssurez-vous que l'article maintient une tonalité de : " . $this->translateEditorialTone($request) . "\n\n",
            "de" => "Schreiben Sie kurze Details zu diesem Thema: " . $request['primary_focus'] . "\n\nVerwenden Sie die folgenden Schlüsselwörter im Artikel: " . $request['priority_keywords'] . "\n\nStellen Sie sicher, dass der Artikel einen Ton von: " . $this->translateEditorialTone($request) . " beibehält\n\n",
            "el" => "Γράψτε μια σύντομη περιγραφή για αυτό το θέμα: " . $request['primary_focus'] . "\n\nΧρησιμοποιήστε τις παρακάτω λέξεις-κλειδιά στο άρθρο: " . $request['priority_keywords'] . "\n\nΒεβαιωθείτε ότι το άρθρο διατηρεί μια τονικότητα του: " . $this->translateEditorialTone($request) . "\n\n",
            "he" => "כתוב פרטים קצרים על הנושא הזה: " . $request['primary_focus'] . "\n\nהשתמש במילות המפתח הבאות במאמר: " . $request['priority_keywords'] . "\n\nודא שהמאמר שומר על טון של: " . $this->translateEditorialTone($request) . "\n\n",
            "hi" => "इस विषय पर एक संक्षिप्त विवरण लिखें: " . $request['primary_focus'] . "\n\nलेख में निम्नलिखित कीवर्ड का उपयोग करें: " . $request['priority_keywords'] . "\n\nसुनिश्चित करें कि लेख में निम्नलिखित टोन को बनाए रखा जाता है: " . $this->translateEditorialTone($request) . "\n\n",
            "hu" => "Írj rövid részleteket erről a témáról: " . $request['primary_focus'] . "\n\nHasználja a következő kulcsszavakat a cikkben: " . $request['priority_keywords'] . "\n\nGyőződjön meg arról, hogy a cikk megtartja a következő hangnemet: " . $this->translateEditorialTone($request) . "\n\n",
            "is" => "Skrifaðu stuttar upplýsingar um þennan þátt: " . $request['primary_focus'] . "\n\nNotaðu eftirfarandi lykilorð í greininni: " . $request['priority_keywords'] . "\n\nTryggðu að greinin haldi í tónum: " . $this->translateEditorialTone($request) . "\n\n",
            "id" => "Tulis rincian singkat tentang topik ini: " . $request['primary_focus'] . "\n\nGunakan kata kunci berikut dalam artikel: " . $request['priority_keywords'] . "\n\nPastikan artikel mempertahankan nada: " . $this->translateEditorialTone($request) . "\n\n",
            "it" => "Scrivi brevi dettagli su questo argomento: " . $request['primary_focus'] . "\n\nUtilizza le seguenti parole chiave nell'articolo: " . $request['priority_keywords'] . "\n\nAssicurati che l'articolo mantenga un tono di: " . $this->translateEditorialTone($request) . "\n\n",
            "ja" => "このトピックについて短い詳細を書いてください: " . $request['primary_focus'] . "\n\n記事には次のキーワードを使用してください：" . $request['priority_keywords'] . "\n\n記事のトーンを以下のように保つようにしてください：" . $this->translateEditorialTone($request) . "\n\n",
            "ko" => "이 주제에 대해 간단한 세부 사항을 작성하세요: " . $request['primary_focus'] . "\n\n기사에 다음 키워드를 활용하세요: " . $request['priority_keywords'] . "\n\n기사가 다음의 어조를 유지하도록하세요: " . $this->translateEditorialTone($request) . "\n\n",
            "lt" => "Parašykite trumpus detalės šia tema: " . $request['primary_focus'] . "\n\nNaudokite šiuos pagrindinius raktažodžius straipsnyje: " . $request['priority_keywords'] . "\n\nĮsitikinkite, kad straipsnis išlaiko šį toną: " . $this->translateEditorialTone($request) . "\n\n",
            "ms" => "Tulis butiran ringkas mengenai topik ini: " . $request['primary_focus'] . "\n\nGunakan kata kunci berikut dalam artikel: " . $request['priority_keywords'] . "\n\nPastikan artikel mengekalkan nada: " . $this->translateEditorialTone($request) . "\n\n",
            "no" => "Skriv korte detaljer om dette emnet: " . $request['primary_focus'] . "\n\nBruk følgende prioriterte nøkkelord i artikkelen: " . $request['priority_keywords'] . "\n\nSørg for at artikkelen opprettholder denne tonen: " . $this->translateEditorialTone($request) . "\n\n",
            "pl" => "Napisz krótkie szczegóły na temat tego tematu: " . $request['primary_focus'] . "\n\nUżyj następujących słów kluczowych w artykule: " . $request['priority_keywords'] . "\n\nUpewnij się, że artykuł utrzymuje następujący ton: " . $this->translateEditorialTone($request) . "\n\n",
            "pt" => "Escreva detalhes breves sobre este tópico: " . $request['primary_focus'] . "\n\nUtilize as seguintes palavras-chave no artigo: " . $request['priority_keywords'] . "\n\nCertifique-se de que o artigo mantém uma tonalidade de: " . $this->translateEditorialTone($request) . "\n\n",
            "ro" => "Scrieți detalii scurte despre acest subiect: " . $request['primary_focus'] . "\n\nUtilizați următoarele cuvinte cheie în articol: " . $request['priority_keywords'] . "\n\nAsigurați-vă că articolul păstrează următorul ton: " . $this->translateEditorialTone($request) . "\n\n",
            "ru" => "Напишите краткую информацию по этой теме: " . $request['primary_focus'] . "\n\nИспользуйте следующие ключевые слова в статье: " . $request['priority_keywords'] . "\n\nУбедитесь, что статья сохраняет следующую тональность: " . $this->translateEditorialTone($request) . "\n\n",
            "sl" => "Napišite kratke podrobnosti o tej temi: " . $request['primary_focus'] . "\n\nV članku uporabite naslednje prednostne ključne besede: " . $request['priority_keywords'] . "\n\nPrepričajte se, da članek ohranja ta ton: " . $this->translateEditorialTone($request) . "\n\n",
            "es" => "Escribe detalles breves sobre este tema: " . $request['primary_focus'] . "\n\nUtiliza las siguientes palabras clave en el artículo: " . $request['priority_keywords'] . "\n\nAsegúrate de que el artículo mantenga un tono de: " . $this->translateEditorialTone($request) . "\n\n",
            "sw" => "Andika maelezo mafupi juu ya mada hii: " . $request['primary_focus'] . "\n\nTumia maneno muhimu ya kipaumbele yafuatayo katika makala: " . $request['priority_keywords'] . "\n\nHakikisha makala inahifadhi mtindo huu: " . $this->translateEditorialTone($request) . "\n\n",
            "sv" => "Skriv en kort beskrivning om detta ämne: " . $request['primary_focus'] . "\n\nAnvänd följande nyckelord i artikeln: " . $request['priority_keywords'] . "\n\nSe till att artikeln behåller följande ton: " . $this->translateEditorialTone($request) . "\n\n",
            "th" => "เขียนรายละเอียดสั้น ๆ เกี่ยวกับหัวข้อนี้: " . $request['primary_focus'] . "\n\nใช้คำสำคัญต่อไปนี้ในบทความ: " . $request['priority_keywords'] . "\n\nตรวจสอบให้แน่ใจว่าบทความคงความเป็นตาม: " . $this->translateEditorialTone($request) . "\n\n",
            "tr" => "Bu konu hakkında kısa detaylar yazın: " . $request['primary_focus'] . "\n\nMakaledeki aşağıdaki anahtar kelimeleri kullanın: " . $request['priority_keywords'] . "\n\nMakalenin aşağıdaki tınıyı koruduğundan emin olun: " . $this->translateEditorialTone($request) . "\n\n",
            "uk" => "Напишіть короткі деталі на цю тему: " . $request['primary_focus'] . "\n\nВикористовуйте наступні ключові слова в статті: " . $request['priority_keywords'] . "\n\nПереконайтеся, що стаття зберігає наступний тон: " . $this->translateEditorialTone($request) . "\n\n",
            "vi" => "Viết một phần ngắn về chủ đề này: " . $request['primary_focus'] . "\n\nSử dụng các từ khóa sau trong bài viết: " . $request['priority_keywords'] . "\n\nĐảm bảo bài viết giữ được một phong cách: " . $this->translateEditorialTone($request) . "\n\n",
        ];

        if (array_key_exists($request['lang'], $short_description_promt)) {
            return $short_description_promt[$request['lang']];
        }
        return $short_description_promt['en'];
    }

    /**
     * generate prompt for blog content
     */
    public function generatePromptForBlogContent($request)
    {
        $content_promt = [
            "ar" => "اكتب مقالة كاملة حول هذا الموضوع: " . $request['primary_focus'] . "\n\nاستخدم الكلمات الرئيسية التالية في المقال: " . $request['priority_keywords'] . "\n\nيجب أن يكون نغمة صوت المقال: " . $this->translateEditorialTone($request) . "\n\n",
            "bg" => "Напишете пълен статия на тази тема: " . $request['primary_focus'] . "\n\nИзползвайте следните ключови думи в статията: " . $request['priority_keywords'] . "\n\nУверете се, че статията запазва тон: " . $this->translateEditorialTone($request) . "\n\n",
            "zh-CN" => "在这个主题上写一篇完整的文章: " . $request['primary_focus'] . "创建一个引人注目的博客标题：\n\n在文章中运用以下关键词：" . $request['priority_keywords'] . "\n\n确保文章保持以下语调：" . $this->translateEditorialTone($request) . "\n\n",
            "zh-TW" => "在這個主題上寫一篇完整的文章: " . $request['primary_focus'] . "創建一個引人注目的部落格標題：\n\n在文章中運用以下關鍵詞：" . $request['priority_keywords'] . "\n\n確保文章保持以下語調：" . $this->translateEditorialTone($request) . "\n\n",
            "hr" => "Napišite potpuni članak o ovoj temi: " . $request['primary_focus'] . "\n\nIskoristite sljedeće ključne riječi u članku: " . $request['priority_keywords'] . "\n\nOsigurajte da članak održava ton: " . $this->translateEditorialTone($request) . "\n\n",
            "cs" => "Napište úplný článek o tomto tématu: " . $request['primary_focus'] . "\n\nVyužijte následující klíčová slova v článku: " . $request['priority_keywords'] . "\n\nZajistěte, aby článek zachoval tón: " . $this->translateEditorialTone($request) . "\n\n",
            "da" => "Skriv en fuldstændig artikel om dette emne: " . $request['primary_focus'] . "\n\nBrug følgende nøgleord i artiklen: " . $request['priority_keywords'] . "\n\nSørg for, at artiklen har en tone af: " . $this->translateEditorialTone($request) . "\n\n",
            "nl" => "Schrijf een volledig artikel over dit onderwerp: " . $request['primary_focus'] . "\n\nGebruik de volgende trefwoorden in het artikel: " . $request['priority_keywords'] . "\n\nZorg ervoor dat het artikel een toon heeft van: " . $this->translateEditorialTone($request) . "\n\n",
            "en" => "Write a complete article on this topic: " . $request['primary_focus'] . "\n\nUtilize the following keywords in the article: " . $request['priority_keywords'] . "\n\nEnsure the article maintains a tone of: " . $this->translateEditorialTone($request) . "\n\n",
            "et" => "Kirjutage täielik artikkel selle teema kohta: " . $request['primary_focus'] . "\n\nKasuta järgnevaid märksõnu artiklis: " . $request['priority_keywords'] . "\n\nVeendu, et artikkel säilitab järgneva tooni: " . $this->translateEditorialTone($request) . "\n\n",
            "fi" => "Kirjoita täydellinen artikkeli aiheesta: " . $request['primary_focus'] . "\n\nHyödynnä seuraavia avainsanoja artikkelissa: " . $request['priority_keywords'] . "\n\nVarmista, että artikkeli säilyttää seuraavan sävyn: " . $this->translateEditorialTone($request) . "\n\n",
            "fr" => "Écrivez un article complet sur ce sujet: " . $request['primary_focus'] . "\n\nUtilisez les mots-clés suivants dans l'article : " . $request['priority_keywords'] . "\n\nAssurez-vous que l'article maintient une tonalité de : " . $this->translateEditorialTone($request) . "\n\n",
            "de" => "Schreiben Sie einen vollständigen Artikel über dieses Thema: " . $request['primary_focus'] . "\n\nVerwenden Sie die folgenden Schlüsselwörter im Artikel: " . $request['priority_keywords'] . "\n\nStellen Sie sicher, dass der Artikel einen Ton von: " . $this->translateEditorialTone($request) . " beibehält\n\n",
            "el" => "Γράψτε ένα πλήρες άρθρο για αυτό το θέμα: " . $request['primary_focus'] . "\n\nΧρησιμοποιήστε τις παρακάτω λέξεις-κλειδιά στο άρθρο: " . $request['priority_keywords'] . "\n\nΒεβαιωθείτε ότι το άρθρο διατηρεί μια τονικότητα του: " . $this->translateEditorialTone($request) . "\n\n",
            "he" => "כתוב מאמר מלא על הנושא הזה: " . $request['primary_focus'] . "\n\nהשתמש במילות המפתח הבאות במאמר: " . $request['priority_keywords'] . "\n\nודא שהמאמר שומר על טון של: " . $this->translateEditorialTone($request) . "\n\n", "en" => "Write a complete article on this topic: " . $request['primary_focus'] . "\n\nUtilize the following keywords in the article: " . $request['priority_keywords'] . "\n\nEnsure the article maintains a tone of: " . $this->translateEditorialTone($request) . "\n\n",
            "et" => "Kirjutage täielik artikkel selle teema kohta: " . $request['primary_focus'] . "\n\nKasuta järgnevaid märksõnu artiklis: " . $request['priority_keywords'] . "\n\nVeendu, et artikkel säilitab järgneva tooni: " . $this->translateEditorialTone($request) . "\n\n",
            "fi" => "Kirjoita täydellinen artikkeli aiheesta: " . $request['primary_focus'] . "\n\nHyödynnä seuraavia avainsanoja artikkelissa: " . $request['priority_keywords'] . "\n\nVarmista, että artikkeli säilyttää seuraavan sävyn: " . $this->translateEditorialTone($request) . "\n\n",
            "fr" => "Écrivez un article complet sur ce sujet: " . $request['primary_focus'] . "\n\nUtilisez les mots-clés suivants dans l'article : " . $request['priority_keywords'] . "\n\nAssurez-vous que l'article maintient une tonalité de : " . $this->translateEditorialTone($request) . "\n\n",
            "de" => "Schreiben Sie einen vollständigen Artikel über dieses Thema: " . $request['primary_focus'] . "\n\nVerwenden Sie die folgenden Schlüsselwörter im Artikel: " . $request['priority_keywords'] . "\n\nStellen Sie sicher, dass der Artikel einen Ton von: " . $this->translateEditorialTone($request) . " beibehält\n\n",
            "el" => "Γράψτε ένα πλήρες άρθρο για αυτό το θέμα: " . $request['primary_focus'] . "\n\nΧρησιμοποιήστε τις παρακάτω λέξεις-κλειδιά στο άρθρο: " . $request['priority_keywords'] . "\n\nΒεβαιωθείτε ότι το άρθρο διατηρεί μια τονικότητα του: " . $this->translateEditorialTone($request) . "\n\n",
            "he" => "כתוב מאמר מלא על הנושא הזה: " . $request['primary_focus'] . "\n\nהשתמש במילות המפתח הבאות במאמר: " . $request['priority_keywords'] . "\n\nודא שהמאמר שומר על טון של: " . $this->translateEditorialTone($request) . "\n\n",
            "hi" => "किसी विषय पर एक पूर्ण लेख लिखें: " . $request['primary_focus'] . "\n\nलेख में निम्नलिखित कीवर्ड का उपयोग करें: " . $request['priority_keywords'] . "\n\nसुनिश्चित करें कि लेख में निम्नलिखित टोन को बनाए रखा जाता है: " . $this->translateEditorialTone($request) . "\n\n",
            "hu" => "Írj egy teljes cikket erről a témáról: " . $request['primary_focus'] . "\n\nHasználja a következő kulcsszavakat a cikkben: " . $request['priority_keywords'] . "\n\nGyőződjön meg arról, hogy a cikk megtartja a következő hangnemet: " . $this->translateEditorialTone($request) . "\n\n",
            "hi" => "किसी विषय पर एक पूर्ण लेख लिखें: " . $request['primary_focus'] . "\n\nलेख में निम्नलिखित कीवर्ड का उपयोग करें: " . $request['priority_keywords'] . "\n\nसुनिश्चित करें कि लेख में निम्नलिखित टोन को बनाए रखा जाता है: " . $this->translateEditorialTone($request) . "\n\n",
            "hu" => "Írj egy teljes cikket erről a témáról: " . $request['primary_focus'] . "\n\nHasználja a következő kulcsszavakat a cikkben: " . $request['priority_keywords'] . "\n\nGyőződjön meg arról, hogy a cikk megtartja a következő hangnemet: " . $this->translateEditorialTone($request) . "\n\n",
            "is" => "Skrifaðu fullkomna grein um þetta efni: " . $request['primary_focus'] . "\n\nNotaðu eftirfarandi lykilorð í greininni: " . $request['priority_keywords'] . "\n\nTryggðu að greinin haldi í tónum: " . $this->translateEditorialTone($request) . "\n\n",
            "id" => "Tulis artikel lengkap tentang topik ini: " . $request['primary_focus'] . "\n\nGunakan kata kunci berikut dalam artikel: " . $request['priority_keywords'] . "\n\nPastikan artikel mempertahankan nada: " . $this->translateEditorialTone($request) . "\n\n",
            "it" => "Scrivi un articolo completo su questo argomento: " . $request['primary_focus'] . "\n\nUtilizza le seguenti parole chiave nell'articolo: " . $request['priority_keywords'] . "\n\nAssicurati che l'articolo mantenga un tono di: " . $this->translateEditorialTone($request) . "\n\n",
            "ja" => "このトピックについての完全な記事を書いてください: " . $request['primary_focus'] . "\n\n記事には次のキーワードを使用してください：" . $request['priority_keywords'] . "\n\n記事のトーンを以下のように保つようにしてください：" . $this->translateEditorialTone($request) . "\n\n",
            "ko" => "다음 주제에 대한 완전한 기사를 작성하세요: " . $request['primary_focus'] . "\n\n기사에 다음 키워드를 활용하세요: " . $request['priority_keywords'] . "\n\n기사가 다음의 어조를 유지하도록하세요: " . $this->translateEditorialTone($request) . "\n\n",
            "lt" => "Parašykite visą straipsnį apie šią temą: " . $request['primary_focus'] . "\n\nNaudokite šiuos pagrindinius raktažodžius straipsnyje: " . $request['priority_keywords'] . "\n\nĮsitikinkite, kad straipsnis išlaiko šį toną: " . $this->translateEditorialTone($request) . "\n\n",
            "ms" => "Tulis artikel lengkap tentang topik ini: " . $request['primary_focus'] . "\n\nGunakan kata kunci berikut dalam artikel: " . $request['priority_keywords'] . "\n\nPastikan artikel mengekalkan nada: " . $this->translateEditorialTone($request) . "\n\n",
            "no" => "Skriv en komplett artikkel om dette emnet: " . $request['primary_focus'] . "\n\nBruk følgende prioriterte nøkkelord i artikkelen: " . $request['priority_keywords'] . "\n\nSørg for at artikkelen opprettholder denne tonen: " . $this->translateEditorialTone($request) . "\n\n",
            "pl" => "Napisz kompletny artykuł na temat tego tematu: " . $request['primary_focus'] . "\n\nUżyj następujących słów kluczowych w artykule: " . $request['priority_keywords'] . "\n\nUpewnij się, że artykuł utrzymuje następujący ton: " . $this->translateEditorialTone($request) . "\n\n",
            "pt" => "Escreva um artigo completo sobre este tópico: " . $request['primary_focus'] . "\n\nUtilize as seguintes palavras-chave no artigo: " . $request['priority_keywords'] . "\n\nCertifique-se de que o artigo mantém uma tonalidade de: " . $this->translateEditorialTone($request) . "\n\n",
            "ro" => "Scrieți un articol complet despre acest subiect: " . $request['primary_focus'] . "\n\nUtilizați următoarele cuvinte cheie în articol: " . $request['priority_keywords'] . "\n\nAsigurați-vă că articolul păstrează următorul ton: " . $this->translateEditorialTone($request) . "\n\n",
            "ru" => "Напишите полную статью на тему: " . $request['primary_focus'] . "\n\nИспользуйте следующие ключевые слова в статье: " . $request['priority_keywords'] . "\n\nУбедитесь, что статья сохраняет следующую тональность: " . $this->translateEditorialTone($request) . "\n\n",
            "sl" => "Napišite celoten članek o tej temi: " . $request['primary_focus'] . "\n\nV članku uporabite naslednje prednostne ključne besede: " . $request['priority_keywords'] . "\n\nPrepričajte se, da članek ohranja ta ton: " . $this->translateEditorialTone($request) . "\n\n",
            "es" => "Escribe un artículo completo sobre este tema: " . $request['primary_focus'] . "\n\nUtiliza las siguientes palabras clave en el artículo: " . $request['priority_keywords'] . "\n\nAsegúrate de que el artículo mantenga un tono de: " . $this->translateEditorialTone($request) . "\n\n",
            "sw" => "Andika makala kamili kuhusu hili suala: " . $request['primary_focus'] . "\n\nTumia maneno muhimu ya kipaumbele yafuatayo katika makala: " . $request['priority_keywords'] . "\n\nHakikisha makala inahifadhi mtindo huu: " . $this->translateEditorialTone($request) . "\n\n",
            "sv" => "Skriv en komplett artikel om detta ämne: " . $request['primary_focus'] . "\n\nAnvänd följande nyckelord i artikeln: " . $request['priority_keywords'] . "\n\nSe till att artikeln behåller följande ton: " . $this->translateEditorialTone($request) . "\n\n",
            "th" => "เขียนบทความสมบูรณ์เกี่ยวกับหัวข้อนี้: " . $request['primary_focus'] . "\n\nใช้คำสำคัญต่อไปนี้ในบทความ: " . $request['priority_keywords'] . "\n\nตรวจสอบให้แน่ใจว่าบทความคงความเป็นตาม: " . $this->translateEditorialTone($request) . "\n\n",
            "tr" => "Üzerine tam bir makale yazın: " . $request['primary_focus'] . "\n\nMakaledeki aşağıdaki anahtar kelimeleri kullanın: " . $request['priority_keywords'] . "\n\nMakalenin aşağıdaki tınıyı koruduğundan emin olun: " . $this->translateEditorialTone($request) . "\n\n",
            "uk" => "Напишіть повну статтю на тему: " . $request['primary_focus'] . "\n\nВикористовуйте наступні ключові слова в статті: " . $request['priority_keywords'] . "\n\nПереконайтеся, що стаття зберігає наступний тон: " . $this->translateEditorialTone($request) . "\n\n",
            "vi" => "Viết một bài viết hoàn chỉnh về chủ đề này: " . $request['primary_focus'] . "\n\nSử dụng các từ khóa sau trong bài viết: " . $request['priority_keywords'] . "\n\nĐảm bảo bài viết giữ được một phong cách: " . $this->translateEditorialTone($request) . "\n\n"
        ];

        if (array_key_exists($request['lang'], $content_promt)) {
            return $content_promt[$request['lang']];
        }
        return $content_promt['en'];
    }

    /**
     * generate prompt for blog title
     */
    public function generatePromptForBlogTitle($request)
    {
        $blogTitles = [
            "ar" => "أنشئ عنوانًا جذابًا للمدونة حول: " . $request['primary_focus'] . "\n\nاستخدم الكلمات الرئيسية التالية في المقال: " . $request['priority_keywords'] . "\n\nيجب أن يكون نغمة صوت المقال: " . $this->translateEditorialTone($request) . "\n\n",
            "bg" => "Създайте внимание-привличащо заглавие за: " . $request['primary_focus'] . "\n\nИзползвайте следните ключови думи в статията: " . $request['priority_keywords'] . "\n\nУверете се, че статията запазва тон: " . $this->translateEditorialTone($request) . "\n\n",
            "zh-CN" => "创建一个引人注目的博客标题: " . $request['primary_focus'] . " 創建一个引人注目的博客标题：\n在文章中运用以下关键词： " . $request['priority_keywords'] . "\n确保文章保持以下语调： " . $this->translateEditorialTone($request) . "\n\n",
            "zh-TW" => "創建一個引人入勝的部落格標題: " . $request['primary_focus'] . " 創建一個引人注目的部落格標題：\n在文章中運用以下關鍵詞： " . $request['priority_keywords'] . "\n確保文章保持以下語調： " . $this->translateEditorialTone($request) . "\n\n",
            "hr" => "Kreirajte upečatljiv naslov bloga za: " . $request['primary_focus'] . "\n\nIskoristite sljedeće ključne riječi u članku: " . $request['priority_keywords'] . "\n\nOsigurajte da članak održava ton: " . $this->translateEditorialTone($request) . "\n\n",
            "cs" => "Vytvořte pozornost vzbuzující nadpis blogu pro: " . $request['primary_focus'] . "\n\nVyužijte následující klíčová slova v článku: " . $request['priority_keywords'] . "\n\nZajistěte, aby článek zachoval tón: " . $this->translateEditorialTone($request) . "\n\n",
            "da" => "Opret en opmærksomhedsvækkende blogtitel for: " . $request['primary_focus'] . "\n\nBrug følgende nøgleord i artiklen: " . $request['priority_keywords'] . "\n\nSørg for, at artiklen har en tone af: " . $this->translateEditorialTone($request) . "\n\n",
            "nl" => "Creëer een aandacht grijpende blogtitel voor: " . $request['primary_focus'] . "\n\nGebruik de volgende trefwoorden in het artikel: " . $request['priority_keywords'] . "\n\nZorg ervoor dat het artikel een toon heeft van: " . $this->translateEditorialTone($request) . "\n\n",

            "en" => "Create an attention-grabbing blog title for: " . $request['primary_focus'] . "\n\nUtilize the following keywords in the article: " . $request['priority_keywords'] . "\n\nEnsure the article maintains a tone of: " . $this->translateEditorialTone($request) . "\n\n",
            "et" => "Loo tähelepanu äratav ajaveebi pealkiri: " . $request['primary_focus'] . "\n\nKasuta järgnevaid märksõnu artiklis: " . $request['priority_keywords'] . "\n\nVeendu, et artikkel säilitab järgneva tooni: " . $this->translateEditorialTone($request) . "\n\n",
            "fi" => "Luo huomiota herättävä blogiotsikko aiheelle: " . $request['primary_focus'] . "\n\nHyödynnä seuraavia avainsanoja artikkelissa: " . $request['priority_keywords'] . "\n\nVarmista, että artikkeli säilyttää seuraavan sävyn: " . $this->translateEditorialTone($request) . "\n\n",
            "fr" => "Créez un titre accrocheur pour votre blog sur: " . $request['primary_focus'] . "\n\nUtilisez les mots-clés suivants dans l'article : " . $request['priority_keywords'] . "\n\nAssurez-vous que l'article maintient une tonalité de : " . $this->translateEditorialTone($request) . "\n\n",
            "de" => "Erstellen Sie einen aufmerksamkeitserregenden Blogtitel für: " . $request['primary_focus'] . "\n\nVerwenden Sie die folgenden Schlüsselwörter im Artikel: " . $request['priority_keywords'] . "\n\nStellen Sie sicher, dass der Artikel einen Ton von: " . $this->translateEditorialTone($request) . " beibehält\n\n",
            "el" => "Δημιουργήστε έναν τίτλο ιστολογίου που τραβάει την προσοχή για: " . $request['primary_focus'] . "\n\nΧρησιμοποιήστε τις παρακάτω λέξεις-κλειδιά στο άρθρο: " . $request['priority_keywords'] . "\n\nΒεβαιωθείτε ότι το άρθρο διατηρεί μια τονικότητα του: " . $this->translateEditorialTone($request) . "\n\n",
            "he" => "צור כותרת מעניינת לבלוג על: " . $request['primary_focus'] . "\n\nהשתמש במילות המפתח הבאות במאמר: " . $request['priority_keywords'] . "\n\nודא שהמאמר שומר על טון של: " . $this->translateEditorialTone($request) . "\n\n",
            "hi" => "किसी विषय पर ध्यान आकर्षित करने वाला ब्लॉग शीर्षक बनाएं: " . $request['primary_focus'] . "\n\nलेख में निम्नलिखित कीवर्ड का उपयोग करें: " . $request['priority_keywords'] . "\n\nसुनिश्चित करें कि लेख में निम्नलिखित टोन को बनाए रखा जाता है: " . $this->translateEditorialTone($request) . "\n\n",
            "hu" => "Hozzon létre figyelemfelkeltő blogcímet: " . $request['primary_focus'] . "\n\nHasználja a következő kulcsszavakat a cikkben: " . $request['priority_keywords'] . "\n\nGyőződjön meg arról, hogy a cikk megtartja a következő hangnemet: " . $this->translateEditorialTone($request) . "\n\n",
            "is" => "Búðu til athyglisverða bloggfyrirsögn fyrir: " . $request['primary_focus'] . "\n\nNotaðu eftirfarandi lykilorð í greininni: " . $request['priority_keywords'] . "\n\nTryggðu að greinin haldi í tónum: " . $this->translateEditorialTone($request) . "\n\n",
            "id" => "Buat judul blog yang menarik perhatian untuk: " . $request['primary_focus'] . "\n\nGunakan kata kunci berikut dalam artikel: " . $request['priority_keywords'] . "\n\nPastikan artikel mempertahankan nada: " . $this->translateEditorialTone($request) . "\n\n",
            "it" => "Crea un titolo accattivante per il blog su: " . $request['primary_focus'] . "\n\nUtilizza le seguenti parole chiave nell'articolo: " . $request['priority_keywords'] . "\n\nAssicurati che l'articolo mantenga un tono di: " . $this->translateEditorialTone($request) . "\n\n",
            "ja" => "～のための注目を集めるブログのタイトルを作成してください： " . $request['primary_focus'] . "\n\n記事には次のキーワードを使用してください：" . $request['priority_keywords'] . "\n\n記事のトーンを以下のように保つようにしてください：" . $this->translateEditorialTone($request) . "\n\n",


            "ko" => "주목을 끄는 블로그 제목을 작성하세요: " . $request['primary_focus'] . "\n\n기사에 다음 키워드를 활용하세요: " . $request['priority_keywords'] . "\n\n기사가 다음의 어조를 유지하도록하세요: " . $this->translateEditorialTone($request) . "\n\n",
            "lt" => "Sukurkite įdomų tinklaraščio pavadinimą apie: " . $request['primary_focus'] . "\n\nNaudokite šiuos pagrindinius raktažodžius straipsnyje: " . $request['priority_keywords'] . "\n\nĮsitikinkite, kad straipsnis išlaiko šį toną: " . $this->translateEditorialTone($request) . "\n\n",
            "ms" => "Cipta tajuk blog yang menarik perhatian untuk: " . $request['primary_focus'] . "\n\nGunakan kata kunci berikut dalam artikel: " . $request['priority_keywords'] . "\n\nPastikan artikel mengekalkan nada: " . $this->translateEditorialTone($request) . "\n\n",
            "no" => "Opprett en oppmerksomhetsskapende bloggtittel for: " . $request['primary_focus'] . "\n\nBruk følgende prioriterte nøkkelord i artikkelen: " . $request['priority_keywords'] . "\n\nSørg for at artikkelen opprettholder denne tonen: " . $this->translateEditorialTone($request) . "\n\n",
            "pl" => "Stwórz przyciągający uwagę tytuł bloga na temat: " . $request['primary_focus'] . "\n\nUżyj następujących słów kluczowych w artykule: " . $request['priority_keywords'] . "\n\nUpewnij się, że artykuł utrzymuje następujący ton: " . $this->translateEditorialTone($request) . "\n\n",
            "pt" => "Crie um título chamativo para o blog sobre: " . $request['primary_focus'] . "\n\nUtilize as seguintes palavras-chave no artigo: " . $request['priority_keywords'] . "\n\nCertifique-se de que o artigo mantém uma tonalidade de: " . $this->translateEditorialTone($request) . "\n\n",
            "ro" => "Creați un titlu de blog captivant pentru: " . $request['primary_focus'] . "\n\nUtilizați următoarele cuvinte cheie în articol: " . $request['priority_keywords'] . "\n\nAsigurați-vă că articolul păstrează următorul ton: " . $this->translateEditorialTone($request) . "\n\n",
            "ru" => "Создайте привлекательный заголовок для блога о: " . $request['primary_focus'] . "\n\nИспользуйте следующие ключевые слова в статье: " . $request['priority_keywords'] . "\n\nУбедитесь, что статья сохраняет следующую тональность: " . $this->translateEditorialTone($request) . "\n\n",
            "sl" => "Ustvarite privlačen naslov bloga za: " . $request['primary_focus'] . "\n\nV članku uporabite naslednje prednostne ključne besede: " . $request['priority_keywords'] . "\n\nPrepričajte se, da članek ohranja ta ton: " . $this->translateEditorialTone($request) . "\n\n",

            "es" => "Crea un título llamativo para el blog sobre: " . $request['primary_focus'] . "\n\nUtiliza las siguientes palabras clave en el artículo: " . $request['priority_keywords'] . "\n\nAsegúrate de que el artículo mantenga un tono de: " . $this->translateEditorialTone($request) . "\n\n",
            "sw" => "Tengeneza kichwa cha habari kinachovuta hisia kwa: " . $request['primary_focus'] . "\n\nTumia maneno muhimu ya kipaumbele yafuatayo katika makala: " . $request['priority_keywords'] . "\n\nHakikisha makala inahifadhi mtindo huu: " . $this->translateEditorialTone($request) . "\n\n",
            "sv" => "Skapa en uppmärksamhetsväckande bloggtitel för: " . $request['primary_focus'] . "\n\nAnvänd följande nyckelord i artikeln: " . $request['priority_keywords'] . "\n\nSe till att artikeln behåller följande ton: " . $this->translateEditorialTone($request) . "\n\n",
            "th" => "สร้างชื่อเรื่องบล็อกที่ดึงดูดความสนใจสำหรับ: " . $request['primary_focus'] . "\n\nใช้คำสำคัญต่อไปนี้ในบทความ: " . $request['priority_keywords'] . "\n\nตรวจสอบให้แน่ใจว่าบทความคงความเป็นตาม: " . $this->translateEditorialTone($request) . "\n\n",
            "tr" => "Dikkat çekici bir blog başlığı oluşturun: " . $request['primary_focus'] . "\n\nMakaledeki aşağıdaki anahtar kelimeleri kullanın: " . $request['priority_keywords'] . "\n\nMakalenin aşağıdaki tınıyı koruduğundan emin olun: " . $this->translateEditorialTone($request) . "\n\n",
            "uk" => "Створіть привабливий заголовок для блогу про: " . $request['primary_focus'] . "\n\nВикористовуйте наступні ключові слова в статті: " . $request['priority_keywords'] . "\n\nПереконайтеся, що стаття зберігає наступний тон: " . $this->translateEditorialTone($request) . "\n\n",
            "vi" => "Tạo tiêu đề blog hấp dẫn cho: " . $request['primary_focus'] . "\n\nSử dụng các từ khóa sau trong bài viết: " . $request['priority_keywords'] . "\n\nĐảm bảo bài viết giữ được một phong cách: " . $this->translateEditorialTone($request) . "\n\n",
        ];

        if (array_key_exists($request['lang'], $blogTitles)) {
            return $blogTitles[$request['lang']];
        }
        return $blogTitles['en'];
    }

    /**
     * Translate editorial tone
     */
    public function translateEditorialTone($request)
    {
        $tone = [
            'formal' => [
                "ar" => "رسمي",
                "bg" => "формален",
                "zh-CN" => "正式的",
                "zh-TW" => "正式的",
                "hr" => "formalan",
                "cs" => "formální",
                "da" => "formel",
                "nl" => "formeel",
                "en" => "formal",
                "et" => "formaalne",
                "fi" => "muodollinen",
                "fr" => "formel",
                "de" => "formell",
                "el" => "επίσημος",
                "he" => "פורמלי",
                "hi" => "औपचारिक",
                "hu" => "hivatalos",
                "is" => "formlegur",
                "id" => "formal",
                "it" => "formale",
                "ja" => "正式な",
                "ko" => "정식의",
                "lt" => "formalus",
                "ms" => "formal",
                "no" => "formell",
                "pl" => "formalny",
                "pt" => "formal",
                "ro" => "formal",
                "ru" => "формальный",
                "sl" => "formalno",
                "es" => "formal",
                "sw" => "rasmi",
                "sv" => "formell",
                "th" => "เป็นทางการ",
                "tr" => "resmi",
                "uk" => "формальний",
                "vi" => "chính thức"
            ],
            'casual' => [
                "ar" => "عارضي",
                "bg" => "неофициален",
                "zh-CN" => "随意的",
                "zh-TW" => "隨意的",
                "hr" => "neformalan",
                "cs" => "neformální",
                "da" => "afslappet",
                "nl" => "casual",
                "en" => "casual",
                "et" => "lõdvestunud",
                "fi" => "rento",
                "fr" => "décontracté",
                "de" => "lässig",
                "el" => "επίσημος",
                "he" => "פוטר",
                "hi" => "आरामदायक",
                "hu" => "legényes",
                "is" => "afslappaður",
                "id" => "santai",
                "it" => "casuale",
                "ja" => "カジュアルな",
                "ko" => "캐주얼한",
                "lt" => "neformalus",
                "ms" => "kasual",
                "no" => "uformell",
                "pl" => "swobodny",
                "pt" => "casual",
                "ro" => "neoficial",
                "ru" => "повседневный",
                "sl" => "sproščeno",
                "es" => "informal",
                "sw" => "kawaida",
                "sv" => "ledig",
                "th" => "สบายๆ",
                "tr" => "gündelik",
                "uk" => "неофіційний",
                "vi" => "thoải mái",
            ],
            'intimate' => [
                "ar" => "حميمي",
                "bg" => "интимен",
                "zh-CN" => "亲密",
                "zh-TW" => "親密",
                "hr" => "intiman",
                "cs" => "intimní",
                "da" => "intim",
                "nl" => "intiem",
                "en" => "intimate",
                "et" => "intiimne",
                "fi" => "läheinen",
                "fr" => "intime",
                "de" => "vertraut",
                "el" => "οικείος",
                "he" => "אינטימי",
                "hi" => "आत्मीय",
                "hu" => "intim",
                "is" => "náinn",
                "id" => "intim",
                "it" => "intimo",
                "ja" => "親しい",
                "ko" => "친밀한",
                "lt" => "intymus",
                "ms" => "intim",
                "no" => "intim",
                "pl" => "intymny",
                "pt" => "íntimo",
                "ro" => "intim",
                "ru" => "интимный",
                "sl" => "intimen",
                "es" => "íntimo",
                "sw" => "karibu",
                "sv" => "intim",
                "th" => "ใกล้ชิด",
                "tr" => "samimi",
                "uk" => "інтимний",
                "vi" => "thân mật",
            ],
            'witty' => [
                "ar" => "ذكي",
                "bg" => "остър",
                "zh-CN" => "机智",
                "zh-TW" => "機智",
                "hr" => "duhovit",
                "cs" => "vtipný",
                "da" => "vittig",
                "nl" => "geestig",
                "en" => "witty",
                "et" => "vaimukas",
                "fi" => "iloisen nokkela",
                "fr" => "spirituel",
                "de" => "geistreich",
                "el" => "ξεφωνητός",
                "he" => "מַצְחִיק",
                "hi" => "मनोहारी",
                "hu" => "szellemes",
                "is" => "skemmtilegur",
                "id" => "cerdas",
                "it" => "spiritoso",
                "ja" => "ウィットに富んだ",
                "ko" => "재치있는",
                "lt" => "pasakėtinas",
                "ms" => "kelucuan",
                "no" => "vittig",
                "pl" => "błyskotliwy",
                "pt" => "espirituoso",
                "ro" => "spiritos",
                "ru" => "остроумный",
                "sl" => "duhovit",
                "es" => "ingenioso",
                "sw" => "cheshi",
                "sv" => "kvick",
                "th" => "มีไหวพริบ",
                "tr" => "esprili",
                "uk" => "гострий",
                "vi" => "duyên dáng",
            ],
            'educational' => [
                "ar" => "تعليمي",
                "bg" => "образователен",
                "zh-CN" => "教育性的",
                "zh-TW" => "教育性的",
                "hr" => "obrazovni",
                "cs" => "vzdělávací",
                "da" => "uddannelsesmæssig",
                "nl" => "educatief",
                "en" => "educational",
                "et" => "hariduslik",
                "fi" => "opettavainen",
                "fr" => "éducatif",
                "de" => "bildend",
                "el" => "εκπαιδευτικός",
                "he" => "חינוכי",
                "hi" => "शैक्षिक",
                "hu" => "oktató jellegű",
                "is" => "fræðandi",
                "id" => "pendidikan",
                "it" => "educativo",
                "ja" => "教育的な",
                "ko" => "교육적인",
                "lt" => "švietimas",
                "ms" => "pendidikan",
                "no" => "pedagogisk",
                "pl" => "edukacyjny",
                "pt" => "educativo",
                "ro" => "educativ",
                "ru" => "образовательный",
                "sl" => "izobraževalen",
                "es" => "educativo",
                "sw" => "elimu",
                "sv" => "lärorik",
                "th" => "ทางการศึกษา",
                "tr" => "eğitici",
                "uk" => "освітній",
                "vi" => "giáo dục",
            ],
            'inspirational' => [
                "ar" => "ملهم",
                "bg" => "вдъхновяващ",
                "zh-CN" => "鼓舞人心的",
                "zh-TW" => "鼓舞人心的",
                "hr" => "inspirativan",
                "cs" => "inspirativní",
                "da" => "inspirerende",
                "nl" => "inspirerend",
                "en" => "inspirational",
                "et" => "inspireeriv",
                "fi" => "inspiroiva",
                "fr" => "inspirant",
                "de" => "inspirierend",
                "el" => "εμπνευσμένος",
                "he" => "מְעוּרֵה",
                "hi" => "प्रेरणादायक",
                "hu" => "inspiráló",
                "is" => "hugmyndavekjandi",
                "id" => "inspiratif",
                "it" => "ispiratore",
                "ja" => "インスピレーションを与える",
                "ko" => "영감을 주는",
                "lt" => "įkvepiantis",
                "ms" => "memberi inspirasi",
                "no" => "inspirerende",
                "pl" => "inspirujący",
                "pt" => "inspirador",
                "ro" => "inspirațional",
                "ru" => "вдохновляющий",
                "sl" => "navdihujoč",
                "es" => "inspirador",
                "sw" => "yenye hamasa",
                "sv" => "inspirerande",
                "th" => "เป็นแรงบันดาลใจ",
                "tr" => "ilham verici",
                "uk" => "надихаючий",
                "vi" => "truyền cảm hứng",
            ],
            'empathetic' => [
                "ar" => "متعاطف",
                "bg" => "емпатичен",
                "zh-CN" => "有同情心的",
                "zh-TW" => "有同理心的",
                "hr" => "empatičan",
                "cs" => "empatický",
                "da" => "empatisk",
                "nl" => "inlevend",
                "en" => "empathetic",
                "et" => "kaastundlik",
                "fi" => "empaattinen",
                "fr" => "empathique",
                "de" => "einfühlsam",
                "el" => "ενσυναισθητικός",
                "he" => "אַמפַּתֵטִי",
                "hi" => "सहानुभूतिशील",
                "hu" => "empatikus",
                "is" => "samhæfður",
                "id" => "empatis",
                "it" => "empatico",
                "ja" => "共感的な",
                "ko" => "공감적인",
                "lt" => "empatinis",
                "ms" => "empatik",
                "no" => "empatisk",
                "pl" => "empatyczny",
                "pt" => "empático",
                "ro" => "empatic",
                "ru" => "эмпатичный",
                "sl" => "empatičen",
                "es" => "empático",
                "sw" => "wenye huruma",
                "sv" => "empatisk",
                "th" => "เห็นใจ",
                "tr" => "empatik",
                "uk" => "емпатичний",
                "vi" => "thấu hiểu",
            ],
            'persuasive' => [
                "ar" => "مقنع",
                "bg" => "убедителен",
                "zh-CN" => "有说服力的",
                "zh-TW" => "有說服力的",
                "hr" => "uvjerljiv",
                "cs" => "přesvědčivý",
                "da" => "overbevisende",
                "nl" => "overtuigend",
                "en" => "persuasive",
                "et" => "veenev",
                "fi" => "vakuuttava",
                "fr" => "persuasif",
                "de" => "überzeugend",
                "el" => "πειστικός",
                "he" => "מְשׂוּכָּconvincingֶּ",
                "hi" => "प्रभावशाली",
                "hu" => "meggyőző",
                "is" => "sannfærandi",
                "id" => "meyakinkan",
                "it" => "persuasivo",
                "ja" => "説得力のある",
                "ko" => "설득력 있는",
                "lt" => "įtikinantis",
                "ms" => "memujuk",
                "no" => "overbevisende",
                "pl" => "przekonujący",
                "pt" => "persuasivo",
                "ro" => "persuasiv",
                "ru" => "убедительный",
                "sl" => "prepričljiv",
                "es" => "persuasivo",
                "sw" => "yenye nguvu",
                "sv" => "övertygande",
                "th" => "โน้มน้าว",
                "tr" => "ikna edici",
                "uk" => "переконливий",
                "vi" => "thuyết phục",
            ],
            'authoritative' => [
                "ar" => "موثوق",
                "bg" => "авторитетен",
                "zh-CN" => "权威的",
                "zh-TW" => "權威的",
                "hr" => "autoritativan",
                "cs" => "autoritativní",
                "da" => "autoritativ",
                "nl" => "gezaghebbend",
                "en" => "authoritative",
                "et" => "autoriteetne",
                "fi" => "asiantunteva",
                "fr" => "d'autorité",
                "de" => "autoritativ",
                "el" => "αρχόντισσα",
                "he" => "מְרַשֵּׁם",
                "hi" => "प्रामाणिक",
                "hu" => "tekintélyes",
                "is" => "valdhafi",
                "id" => "berwibawa",
                "it" => "autorevole",
                "ja" => "権威のある",
                "ko" => "권위있는",
                "lt" => "autoritetingas",
                "ms" => "berwibawa",
                "no" => "autoritativ",
                "pl" => "autorytatywny",
                "pt" => "autoritário",
                "ro" => "autoritar",
                "ru" => "авторитетный",
                "sl" => "avtoritativen",
                "es" => "autoritario",
                "sw" => "wenye mamlaka",
                "sv" => "auktoritativ",
                "th" => "เชื่อถือได้",
                "tr" => "yetkili",
                "uk" => "авторитетний",
                "vi" => "uy tín",
            ],
            'humorous' => [
                "ar" => "مضحك",
                "bg" => "забавен",
                "zh-CN" => "幽默的",
                "zh-TW" => "幽默的",
                "hr" => "šaljiv",
                "cs" => "humoristický",
                "da" => "humoristisk",
                "nl" => "humoristisch",
                "en" => "humorous",
                "et" => "humoorikas",
                "fi" => "hauska",
                "fr" => "humoristique",
                "de" => "lustig",
                "el" => "αστείος",
                "he" => "מַצְחִיק",
                "hi" => "हास्यपूर्ण",
                "hu" => "humoros",
                "is" => "skemmtilegur",
                "id" => "humoris",
                "it" => "umoristico",
                "ja" => "ユーモラスな",
                "ko" => "유머러스한",
                "lt" => "juokingas",
                "ms" => "kelakar",
                "no" => "humoristisk",
                "pl" => "humorystyczny",
                "pt" => "humorístico",
                "ro" => "umoristic",
                "ru" => "юмористический",
                "sl" => "humorno",
                "es" => "humorístico",
                "sw" => "kuchekesha",
                "sv" => "humoristisk",
                "th" => "ตลก",
                "tr" => "komik",
                "uk" => "гумористичний",
                "vi" => "hài hước",
            ]

        ];

        if (array_key_exists($request['editorial_tone'], $tone)) {
            if (array_key_exists($request['lang'], $tone[$request['editorial_tone']])) {
                return $tone[$request['editorial_tone']][$request['lang']];
            }
        }
        return $request['editorial_tone'];
    }
}
