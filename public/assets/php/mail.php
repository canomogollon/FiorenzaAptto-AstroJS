<?php
//@ini_set('display_errors', 0);
//@ini_set('track_errors', 0);
/* =====================================================
 * change $email_to and $email_form
 * ===================================================== */
$email_to = "saladeventas@fiorenzaapartamentos.com"; // the email address to which the form sends submissions
//$email_to = "elkincano@gmail.com";
$email_from = "saladeventas@fiorenzaapartamentos.com"; // the email address used as "From" when submissions are sent to the $email_to above (important that it has the same domain as the domain of your site - unless you have configured your server's mail settings)
$email_subject = "-- Contacto desde la Web -- : ";

//Form Submit via  JSON DATA 
//$data = json_decode(file_get_contents('php://input'), true);


function return_error($error)
{
    echo json_encode($error);
    die();
}

if (isset($_POST['email'])) {

    // check for empty required fields
    if (
        !isset($_POST['fullname']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telefono'])
    ) {
        return_error('Datos Incompletos, por favor verifiquelos');
    }

    // form field values
    $name = $_POST['fullname']; // required
    $email = $_POST['email']; // required
    $contact_number = $_POST['telefono']; // required
    $ingresos = $_POST['ingresos'];
    $politicadatos = $_POST['politicadatos'];
    //$message = $data['message']; // required

    $jsondata = array();

    // form validation
    $error_message = "";

    // name
    $name_exp = "/^[a-z0-9 .\-]+$/i";
    if (!preg_match($name_exp, $name)) {
        $this_error = 'Por favor ingrese un nombre valido.';
        $error_message .= ($error_message == "") ? $this_error : "<br/>" . $this_error;
    }

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if (!preg_match($email_exp, $email)) {
        $this_error = 'Por favor ingrese un Correo Electronico valido.';
        $error_message .= ($error_message == "") ? $this_error : "<br/>" . $this_error;
    }

    // if there are validation errors
    if (strlen($error_message) > 0) {
        $jsondata["estado"] = false;
        $jsondata["message"] = $error_message;
        return_error($jsondata);
    }

    // prepare email message
    $email_message = "Detalles del mensaje a continuaci贸n.\n\n";
    $email_subject = $email_subject . $name;

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Nombre: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Numero de Contacto: " . clean_string($contact_number) . "\n";
    $email_message .= "ingresos: " . clean_string($ingresos) . "\n";
    $email_message .= "Politica datos: " . clean_string($politicadatos) . "\n";
    //$email_message .= "Mensaje: ".clean_string($message)."\n";

    // create email headers
    $headers = 'From: ' . $email_from . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    //$success = mail($email_to, $email_subject, $email_message, $headers);
    $success = false;
    if (!$success) {
        //$errorMessage = error_get_last()['message'];
        $jsondata["estado"] = false;
        $jsondata["message"] = 'No se pudo enviar el correo, reintente por favor.';
        //return_error('No se pudo enviar el correo, reintente por favor.');// . $errorMessage);
        return_error($jsondata);
    } else {
        $jsondata["estado"] = true;
        $jsondata["message"] = "Hemos recibido sus datos";
        //echo json_decode('Hemos recibido sus datos');
        //header("Location: https://www.fiorenzaapartamentos.com/gracias.html", true, 301);
        return_error($jsondata);
    }
} else {
    //return_error('Datos incompletos, por favor verifique la informacion ingresada');
    $jsondata["estado"] = false;
    $jsondata["message"] = 'Datos incompletos, por favor verifique la informacion ingresada';
    return_error($jsondata);

}


?>