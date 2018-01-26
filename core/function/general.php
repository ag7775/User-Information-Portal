<?php
function email($to,$subject,$body)
{
	require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'arunka7775@gmail.com';          // SMTP username
$mail->Password = 'shivam.7775'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to

$mail->setFrom('arunka7775@gmail.com', 'Test_Project');
$mail->addReplyTo('arunka7775@gmail.com', 'Test_Project');
$mail->addAddress($to);   // Add a recipient
$mail->addCC('');
$mail->addBCC('');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = $message;
$bodyContent .= $body;

$mail->Subject = $subject;
$mail->Body    = $bodyContent;

	if(!$mail->send()) {
    	echo 'Message could not be sent.';
    	echo 'Mailer Error: ' . $mail->ErrorInfo;
	} 	else {
    	echo 'Mail has been sent';
	}
}
function already_logged_in()
{
	if(logged_in()==true){		
		header('Location: index.php');
	}
}
function protect_page()
{
	if(logged_in()==false)
	{
		header('Location:protected.php');
		exit();
	}
}
function array_sanitize(&$item)
{
	$item=htmlentities(strip_tags(mysql_real_escape_string($item)));
}
function sanitize($data)
{
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}
function output_errors($errors)
{
	return '<ul><li>'. implode('</li><li>',$errors) . '</li></ul>';
}

?>