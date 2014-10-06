<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$mandrill = new Mandrill('');

$app->get('/', function () use ($app, $mandrill) {

    echo "Send a normal email: <a href='index.php/send_normal'>Send Now</a><br />\n";
    echo "Send a template email: <a href='index.php/send_template'>Send Now</a><br />\n";

    return '';
});

/**
 * Send a normal email
 */
$app->get('/send_normal', function () use ($app, $mandrill) {

    $recipient_email_address = 'ADD_RECIPIENT_EMAIL_ADDRESS';
    $recipient_name = 'ADD_RECIPIENT_NAME';

    $message = array(
        'html' => '<p>Example HTML content</p>',
        'text' => 'Example text content',
        'subject' => 'A normal email',
        'from_email' => $recipient_email_address,
        'from_name' => $recipient_name,
        'to' => array(
            array(
                'email' => $recipient_email_address,
                'name' => $recipient_name,
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => $recipient_email_address),
        'important' => false,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'bcc_address' => '',
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'global_merge_vars' => null,
        'merge_vars' => null,
        'tags' => array('password-resets'),
        'subaccount' => null,
        'google_analytics_domains' => array(''),
        'google_analytics_campaign' => '',
        'metadata' => null,
        'recipient_metadata' => null,
        'attachments' => array(),
        'images' => array()
    );

    $async = false;
    $ip_pool = 'Main Pool';
    $send_at = '';

    $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);

    print_r($result);

    return '';

});

/*
 * Sends an email using a MailChip template
 */
$app->get('/send_template', function () use ($app, $mandrill) {

    $recipient_email_address = 'ADD_RECIPIENT_EMAIL_ADDRESS';
    $recipient_name = 'ADD_RECIPIENT_NAME';
    $template_name = 'murrion test 1';

    $template_content = array(
        array(
            'name' => 'example name',
            'content' => 'example content'
        )
    );
    $message = array(
        'html' => '<p>Example HTML content</p>',
        'text' => 'Example text content',
        'subject' => 'An email using a Template',
        'from_email' => $recipient_email_address,
        'from_name' => $recipient_name,
        'to' => array(
            array(
                'email' => $recipient_email_address,
                'name' => $recipient_name,
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => $recipient_email_address),
        'important' => false,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'bcc_address' => null,
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'global_merge_vars' => array(
            array(
                'name' => 'my_heading',
                'content' => 'Great Template'
            )
        ),
        'merge_vars' => array(
            array(
                'rcpt' => $recipient_email_address,
                'vars' => array(
                    array(
                        'name' => 'fname',
                        'content' => $recipient_name
                    )
                )
            )
        ),
        'tags' => array('password-resets'),
        'subaccount' => null,
        'google_analytics_domains' => null,
        'google_analytics_campaign' => null,
        'metadata' => array('website' => 'www.example.com'),
        'recipient_metadata' => null,
        'attachments' => null,
        'images' => null,
    );
    $async = false;
    $ip_pool = 'Main Pool';
    $send_at = '';

    $result = $mandrill->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool, $send_at);

    print_r($result);

    return '';

});


$app->run();