<?php

return [
    'general_status' => [
        'active' => 1,
        'in_active' => 2,
    ],
    'user_status' => [
        'active' => 1,
        'in_active' => 2,
    ],
    'roles' => [
        'supper_admin' => 1
    ],
    'currency_position' => [
        2 => "[Amount][Currency]",
        1 => "[Currency][Amount]",
    ],
    'media_file_type' => [
        'pdf' => 'PDF',
        'zip' => 'ZIP',
        'video' => 'Video',
        'image' => 'Image'
    ],
    // Visibility Status List
    'visibility_status' => [
        'public', 'password', 'private'
    ],
    // Page Status Number
    'page_status' => [
        'publish' => '1',
        'draft' => '2',
        'trash' => '3',
    ],
    // Blog Status number
    'blog_status' => [
        'publish' => '1',
        'pending' => '2',
        'draft' => null,
    ],
    // Blog Comment Status list
    'blog_comment_status_name' => [
        'approve', 'pending', 'spam'
    ],
    // Blog Comment Status number
    'blog_comment_status' => [
        'approve' => '1',
        'pending' => '2',
        'spam' => '3',
        'trash' => '4'
    ],
    // Blog Comment Default Avatar name
    'blog_comment_default_avatar' => [
        'mystery', 'blank', 'gravatar', 'identicon', 'wavatar', 'monsterid', 'retro'
    ],

    //Need to check
    'media_type' => [
        'stuff' => '1',
        'system' => '3',
        'media_settings' => '4',
        'products' => '2'
    ],
    // discuss with kvai
    'email_template' => [
        'blog_comment_email_template' => 1, //do not change
        'reset_user_password' => 2,
    ],
    // --- blog & page --- //
    'media_settings_name' => [
        'placeholder_image',
        'chunk_size_upload_status',

        'large_thumb_image_width',
        'large_thumb_image_height',
        'medium_thumb_image_width',
        'medium_thumb_image_height',
        'small_thumb_image_width',
        'small_thumb_image_height'
    ],
    'social_media_settings_name' => [
        'google_client_id',
        'google_client_secret',
        'facebook_app_id',
        'facebook_app_secret',
        'twitter_client_id',
        'twitter_client_secret'
    ],
    'general_settings_name' => [
        'system_name',
        'black_background_logo',
        'white_background_logo',
        'favicon',
        'default_language',
        'default_timezone',
        'decimal_number_limit',
        'black_mobile_background_logo',
        'white_mobile_background_logo',
        'default_currency',
        'copyright_text',
        'sticky_mobile_background_logo',
        'sticky_background_logo',
        'sticky_black_mobile_background_logo',
        'sticky_black_background_logo',
    ],

    // Blog Comment General Settings name
    'blog_comment_general_settings_name' => [
        'default_comment_status',
        'require_name_email',
        'comment_registration',
        'close_comments_for_old_blogs',
        'thread_comments',
        'page_comments',
        'comments_notify_email',
        'comments_moderation_notify_email',
        'comment_moderation',
        'comment_previously_approved',
        'show_avatars',
    ],

    // Blog Comment Other Settings name
    'blog_comment_other_settings_name' => [
        'close_comments_days_old',
        'thread_comments_level',
        'comments_per_page',
        'comment_order',
        'comment_max_links',
        'comment_moderation_keys',
        'comment_disallowed_keys',
        'avatar_default',
    ],
    // menu positions
    'menu_position' => [
        'Header Bottom Middle Menu',
        'Header Top Left Menu',
        'Header Top Right Menu'
    ],

   
];