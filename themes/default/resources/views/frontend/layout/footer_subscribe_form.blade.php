@php
    // Theme Option and Setting
    $subscribe_form = isset($subscribe['footer_subscribe_form']) && $subscribe['footer_subscribe_form'] == 1 ? true : false;
    $form_title = isset($subscribe['subscribe_form_title']) && $subscribe['subscribe_form_title'] != '' ? $subscribe['subscribe_form_title'] : front_translate('Subscribe Our Newsletter');
    
    $placeholder = isset($subscribe['subscribe_form_placeholder']) && $subscribe['subscribe_form_placeholder'] != '' ? $subscribe['subscribe_form_placeholder'] : front_translate('Enter Your Email');
    
    $button_text = isset($subscribe['subscribe_form_button_text']) && $subscribe['subscribe_form_button_text'] != '' ? $subscribe['subscribe_form_button_text'] : front_translate('Submit');
    
    $is_privacy = false;
    if (isset($subscribe['privacy_policy']) && $subscribe['privacy_policy'] == 1 && isset($subscribe['privacy_policy_page'])) {
        $is_privacy = true;
    }
@endphp

@php
    $title = front_translate('Get In Touch');
    $subtitle = front_translate('Whether you have a question, want to start a project or simply want to connect. Feel free to send me a message in the contact form');
    $name_placeholder = front_translate('Your Name');
    $email_placeholder = front_translate('Your Email');
    $company_email_placeholder = front_translate('Your Company Email');
    $phone_placeholder = front_translate('Your Phone');
    $company_placeholder = front_translate('Company Name');
    $subject_placeholder = front_translate('Subject');
    $message_placeholder = front_translate('Your Message');
    $btn_text = front_translate('Submit');
    $contact_image = true;
    $image_path = false;
    
    //contact page field
    if (isset($contact_option) && $contact_option['custom_contact_style'] == 1) {
        $title = isset($contact_option['contact_title']) ? front_translate($contact_option['contact_title']) : '';
        $subtitle = isset($contact_option['contact_subtitle']) ? front_translate($contact_option['contact_subtitle']) : '';
        $name_placeholder = isset($contact_option['contact_name_placeholder']) ? front_translate($contact_option['contact_name_placeholder']) : '';
        $email_placeholder = isset($contact_option['contact_email_placeholder']) ? front_translate($contact_option['contact_email_placeholder']) : '';
        $subject_placeholder = isset($contact_option['contact_subject_placeholder']) ? front_translate($contact_option['contact_subject_placeholder']) : '';
        $message_placeholder = isset($contact_option['contact_message_placeholder']) ? front_translate($contact_option['contact_message_placeholder']) : '';
        $btn_text = isset($contact_option['contact_button_text']) ? front_translate($contact_option['contact_button_text']) : '';
        if (isset($contact_option['contact_image_show']) && $contact_option['contact_image_show'] == 1) {
            if (isset($contact_option['custom_contact_image']) && $contact_option['custom_contact_image'] != null) {
                $contact_image = true;
                $image_path = asset(getFilePath($contact_option['custom_contact_image']));
            }
        } else {
            $contact_image = false;
        }
    }
    
    
@endphp



<style>
    
/* get in touch section css end */
.get-in-touch-section {
  display: flex;
  justify-content: center;
  background: rgb(255, 255, 255);
  /* align-items: center; */
  padding: 20px;
  border-radius: 30px;
  gap: 50px;
  margin: auto;
  margin-top: 50px;
  box-shadow: 0px 0px 19px #00000059;
}
.get-in-touch-section div {
  width: 50%;
}
.getin-touch-bg-img {
  background-image: url("{{ asset('themes/default/public/assets/images/getitouch-img.png') }}");
  background-position: center;
  background-repeat: no-repeat;
  background-size: 100% 100%;
  border-radius: 30px;
}
.get-in-touch-content-contaier input,
textarea {
  background: transparent;
  width: 100%;
  border: none;
  border-bottom: 1px solid #c9c9c9;
  margin-bottom: 20px;
  padding-bottom: 10px;
  color: var(--secondary-color);

  font-family: var(--font-family);
  font-weight: 400;
  font-size: 16px;
  padding-left: 0;
    padding-right: 0;
}
form {
  width: 85%;
  margin-top: 30px;
  margin-bottom: 30px;
}
.get-in-touch-content-contaier input::placeholder {
  color: #c9c9c9;
  font-style: italic;
}
.get-in-touch-content-contaier textarea::placeholder {
  color: #c9c9c9;
  font-style: italic;
}
.get-in-touch-content-contaier input:focus {
  outline: none;
  box-shadow: none;
}
.get-in-touch-content-contaier textarea:focus {
  outline: none;
  box-shadow: none;
}
.get-in-touch-content-contaier h2 {
  font-family: var(--font-family);
  font-weight: 700;
  color: var(--li-a-border-bottom);
  font-size: 35px;
  line-height: 40px;
  margin-bottom: 0px;
  margin-top: 20px;
}
.get-in-touch-content-contaier h2 span {
  color: var(--secondary-color);
}
.get-in-touch-content-contaier img {
  width: 230px;
  margin-top: 0px;
}

.newsletter-cover .nl-bg-ol {
    background: rgba(0, 0, 28, 1);
}
/* get in touch section css end */


</style>


    <div class="modal fade" id="getInTouch" tabindex="-1" role="dialog" aria-labelledby="getInTouchLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <!-- Newsletter Form -->
                        <div class="get-in-touch-section aos-init aos-animate" data-aos="fade-up">
                            <div class="getin-touch-bg-img"></div>
                            <div class="get-in-touch-content-contaier">
                              <h2><span>Get</span> In Touch</h2>
                              <img src="{{ asset('themes/default/public/assets/images/divider.png') }}" alt="">
                              <form class="my-contact-form" id="demo-form">
                                 @csrf
                                <input type="text" name="name" placeholder="{{ $name_placeholder }}"
                                required>
                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                                
                                <div class="position-relative w-100">
                                <input type="email" name="company_email" required
                                placeholder="{{ $company_email_placeholder }}" >
                                <p class="text-danger position-absolute" id="company_email_error" style="top: 35px;"></p>
                                </div>
                                
                                <input type="tel" name="phone" 
                                placeholder="{{ $phone_placeholder }}" required>
                                @if ($errors->has('phone'))
                                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                                @endif
                                <input type="text" name="company" required
                                placeholder="{{ $company_placeholder }}" >
                                @if ($errors->has('company'))
                                    <p class="text-danger">{{ $errors->first('company') }}</p>
                                @endif
                                <textarea name="message" placeholder="{{ $message_placeholder }}"></textarea>
                                @if ($errors->has('message'))
                                    <p class="text-danger">{{ $errors->first('message') }}</p>
                                @endif
                                
                                <button class="custom-theme-btn ml-0" type="submit">Submit Now</button>
                              </form>
                            </div>
                          </div>
                        <!-- End of Newsletter Form -->
        </div>
      </div>
    </div>


@if ($subscribe_form)
    <!-- Newsletter -->
    <section class="footer-newsletter newsletter-cover">
        <!-- Overlay -->
        <div class="nl-bg-ol"></div>
        <div class="container">
            <div class="py-5">
                
                <!-- End of Section title -->
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <!-- Newsletter Form -->
                        <div class="get-in-touch-section aos-init aos-animate" data-aos="fade-up">
                            <div class="getin-touch-bg-img"></div>
                            <div class="get-in-touch-content-contaier">
                              <h2><span>Get</span> In Touch</h2>
                              <img src="{{ asset('themes/default/public/assets/images/divider.png') }}" alt="">
                              <form class="my-contact-form" action="{{ route('theme.default.send.message') }}" method="post">
                                 @csrf
                                <input type="text" name="name" placeholder="{{ $name_placeholder }}"
                                required>
                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                                <input type="email" name="email"
                                placeholder="{{ $email_placeholder }}" required>
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                                <input type="tel" name="phone" 
                                placeholder="{{ $phone_placeholder }}" required>
                                @if ($errors->has('phone'))
                                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                                @endif
                                <input type="text" name="company"
                                placeholder="{{ $company_placeholder }}" required>
                                @if ($errors->has('company'))
                                    <p class="text-danger">{{ $errors->first('company') }}</p>
                                @endif
                                <textarea name="message" placeholder="{{ $message_placeholder }}" required></textarea>
                                @if ($errors->has('message'))
                                    <p class="text-danger">{{ $errors->first('message') }}</p>
                                @endif
                                
                                <button class="custom-theme-btn ml-0" type="submit">Submit Now</button>
                              </form>
                            </div>
                          </div>
                        <!-- End of Newsletter Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Newsletter -->
@endif

<script>

let restricted_domains = [];
const company_email = document.querySelector('[name="company_email"]');
const company_email_error = document.getElementById('company_email_error');
const demoForm = document.getElementById('demo-form');
const submitBtn = document.querySelector('#demo-form [type="submit"]')

const getRegex = str => {
    // Step 1: Replace commas and optional spaces with '|'
    let domainPattern = str.replace(/,\s*/g, '|');
    
    // Step 2: Escape the dots (.)
    domainPattern = domainPattern.replace(/\./g, '\\.');

    // Step 3: Form the complete regular expression
    const regexPattern = new RegExp(`@(${domainPattern})$`, 'i');

    return regexPattern;
}
const checkEmailDomain = email => {
    
    const domainsNotAllowed = restricted_domains;
    
    const domainList = getRegex(domainsNotAllowed);

    // Test if the email contains one of the allowed domains
    if (domainList.test(email)) {
        return false
    }
    return true;
}
const fetchRestrictedDomains = async () => {
    
    const myHeaders = new Headers();
    
    const formdata = new FormData();
    formdata.append("id", "contact");
    
    const requestOptions = {
      method: "POST",
      headers: myHeaders,
      body: formdata,
      redirect: "follow"
    };
    
    try {
        
        const response = await fetch("{{ route('api.theme.option') }}", requestOptions);
        const json = await response.json();
        restricted_domains = json.value;
        
    } catch (error) {
        console.error('Error fetching data:', error);
        throw error; // Re-throw the error if you want to handle it higher up
    }  
}

fetchRestrictedDomains();

company_email.addEventListener('keyup', (e) => {
    company_email_error.innerHTML = ''
})
demoForm.onsubmit = (event) => {
    event.preventDefault();
    
    if(checkEmailDomain(company_email.value)) {
        
        const form = event.target;
        const formdata = new FormData(form);
      
    
        const requestOptions = {
          method: "POST",
          body: formdata,
          redirect: "follow"
        };
        submitBtn.innerHTML = 'Sending..'
        
        fetch('{{ route('lead.signup') }}', requestOptions)
          .then((response) => response.json())
          .then((result) => {
              if(result.status === 'success'){
                  demoForm.reset();
                  $('#getInTouch').modal('hide')
                  toastr.success(result.message, "Success!");
                  submitBtn.innerHTML = 'Submit Now'
              }
          })
          .catch((error) => toastr.error(error, "Error!"));
          
          
    } else {
        company_email_error.innerHTML = '<small class="mb-4 d-block">* Please use your company email.</small>';
    }
}

</script>

