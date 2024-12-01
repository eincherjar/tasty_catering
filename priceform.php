<?php

$email_to = "kontakt@tastycatering.eu";
$email_subject = "Wycena";

$email_from = $_POST['email'];

$name = $_POST['name'];
$phone = $_POST['phone'];

$name = $_POST['name'];
$phone = $_POST['phone'];

$party_date = $_POST['party_date'];
$party_size = $_POST['party_size'];

if(!empty($_POST['check_list'])){
    // Loop to store and display values of individual checked checkbox.
    foreach($_POST['check_list'] as $selected){
        $offer .= $selected.", ";
    }
}

$message = $_POST['message'];

$email_message = "Treść zapytania:\n\n";

function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
}

$email_message .= "Imię i nazwisko: ".clean_string($name)."\n";
$email_message .= "Email: ".clean_string($email_from)."\n";
$email_message .= "Telefon: ".clean_string($phone)."\n";
$email_message .= "Data planowanej imprezy: ".clean_string($party_date)."\n";
$email_message .= "Przewidywana liczba gości: ".clean_string($party_size)."\n";
$email_message .= $offer."\n";
$email_message .= "Wiadomość: ".clean_string($message)."\n";


// create email headers
$headers = 'From: '.$email_to."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();

mail($email_to, $email_subject, $email_message, $headers) or die("Error!");
echo "Thank You!";
?>