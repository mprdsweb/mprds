<?php
// send-mail.php
// Download Mandrill PHP library from
// https://bitbucket.org/mailchimp/mandrill-api-php/get/master.zip

require_once 'Mandrill.php';

try {
    $mandrill = new Mandrill('RzlOhh12BBrpGhR0BXk41g');
    $body     = array(
        '<strong>Name:</strong> ' + $_POST['Name'],
        '<strong>Phone number:</strong> ' + isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : 'n/a',
        '<strong>Message:</strong> ',
        $_POST['message'],
    );
    $body     = implode('<br/>', $body);
    $message = array(
        'html' => $body,
        'subject' => 'Contact form',
        'from_email' => $_POST['email'],
        'from_name'  => $_POST['Name'],
        'to' => array(
            array(
                'email' => 'office@mprds.org',
                'name' => 'Ministerio Profetico Roca de Salvacion',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => 'message.reply@example.com'),
        'tags' => array('contact')
    );
    $async = false;
    $result = $mandrill->messages->send($message, $async);
    
    if($result[0]["status"] == "rejected")
        throw new Exception("Email got rejected");

    echo json_encode(array(
        'result' => 'ok', 'message' => $result
    ));

} catch(Exception $e) {
    echo json_encode(array(
        'result' => 'error', 'message' => $e->getMessage()
    ));
    // Mandrill errors are thrown as exceptions
    //echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    //throw $e;
}
?>
