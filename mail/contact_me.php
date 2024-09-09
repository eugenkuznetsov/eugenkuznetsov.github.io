<?php
$email_address = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !$email_address)
   {
	echo "No arguments Provided!";
	return false;
   }

$name = $_POST['name'];
if ($email_address === FALSE) {
    echo 'Invalid email';
    exit(1);
}
$phone = $_POST['phone'];
$message = $_POST['message'];

if (empty($_POST['_gotcha'])) { // If hidden field was filled out (by spambots) don't send!
    // Create the email and send the message
    $to = 'e.kuznetsov@freeuni.edu.ge'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
    $email_subject = "Website Contact Form:  $name";
    $email_body = "New message from your website contact form.\n\n"."Details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
    $headers = "From: noreply@@freeuni.edu.ge\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
    return true;
}
echo "Gotcha, spambot!";
return false;
?>
