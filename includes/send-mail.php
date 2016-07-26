<?php
// send-mail.php
// Download Mandrill PHP library from
// https://bitbucket.org/mailchimp/mandrill-api-php/get/master.zip
require_once 'Mandrill.php';

try {
    // See https://mandrillapp.com/api/docs/index.php.html
    $mandrill = new Mandrill('RzlOhh12BBrpGhR0BXk41g');

    // Build the message body
    $body     = array(
        '<strong>Name:</strong> ' + $_POST['Name'],
        '<strong>Phone number:</strong> ' + isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : 'n/a',
        '<strong>Message:</strong> ',
        $_POST['message'],
    );
    $body     = implode('<br/>', $body);

    $message  = array(
        'html'       => $body,
        'subject'    => 'Contact form from' + $_POST['Name'],
        'from_email' => $_POST['email'],
        'from_name'  => $_POST['Name'],
        'to'         => array(
            array(
                'email' => 'office@mprds.org',
                'name'  => 'Ministerio Profetico Roca de Salvacion',
                'type'  => 'to'
            )
        ),
        'headers'    => array(
            'Reply-To' => 'message.reply@example.com'
        ),
    );
    $async  = false;
    $result = $mandrill->messages->send($message, $async);

    echo json_encode(array(
        'result' => 'ok'
    ));
} catch(Mandrill_Error $e) {
    echo json_encode(array(
        'result' => 'error', 'message' => $e->getMessage()
    ));
}
