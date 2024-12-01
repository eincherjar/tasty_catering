<?php
if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "kontakt@tastycatering.eu";
    $email_subject = "Formularz kontaktowy";

    function died($error) {
        // your error code can go here
        echo "W formularzu wykryliśmy poniższe błędy, prosimy o ich poprawienie.<br /><br />";
        echo $error."<br /><br />";
        echo "Prosimy wrócić do poprzedniej strony i poprawić błędy.<br /><br />";
        die();
    }


    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('W formularzu wykryliśmy błędy, prosimy o ich poprawienie.');
    }



    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $message = $_POST['message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Wylgąda na to że adres Email jest nie poprawny.<br />';
  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$name)) {
    $error_message .= 'Musi zostać wpisane imię i nazwisko.<br />';
  }

  if(strlen($message) < 2) {
    $error_message .= 'Wiadomość musi zawierać więcej niż 3 znaki.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }

    $email_message = "Treść formularza kontaktowego:\n\n";


    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }



    $email_message .= "Imię i nazwisko: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Wiadomość: ".clean_string($message)."\n";

// create email headers
$headers = 'From: '.$email_to."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();

mail($email_to, $email_subject, $email_message, $headers);
?>

<!-- include your own success html here -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tasty Catering</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css" />
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <section class="hero is-large"">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Dziękujemy za wiadomość, postaramy się odpowiedzieć na nią jak najszybciej.
          </h1>
        </div>
      </div>
    </section>
  </body>
</html>

<?php

}
?>