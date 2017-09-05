<?php
session_start();
error_reporting(1);
include("PHPMailer/PHPMailerAutoload.php");

// Step 1 - Enter your email address below.
$to =  'info@amasports.eu'; //'info@bathwestfire.co.uk';

if(isset($_POST['emailSent'])) {

	// Step 2 - If you don't want a "captcha" verification, remove that IF.

		$name = $_POST['name'];
		$email = $_POST['email'];

		// Step 3 - Configure the fields list that you want to receive on the email.
		$fields = array(
			0 => array(
				'text' => 'Name',
				'val' => $_POST['name']
			),
			1 => array(
				'text' => 'Email address',
				'val' => $_POST['email']
			),
			2 => array(
				'text' => 'Message',
				'val' => $_POST['message']
			),
			3 => array(
				'text' => 'Phone',
				'val' => $_POST['phone']
			)
		);

		$message = "";

		foreach($fields as $field) {
			$message .= $field['text'].": " . htmlspecialchars($field['val'], ENT_QUOTES) . "<br>\n";
		}
    $mail = new PHPMailer;
	$mail->IsSMTP();                                         // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';				       // Specify main and backup server
	$mail->SMTPAuth = true;                                  // Enable SMTP authentication
	$mail->Username = 'info@amasports.eu';                    // SMTP username
	$mail->Password = 'orsetto10';                              // SMTP password
	$mail->SMTPSecure = 'tls';                               // Enable encryption, 'ssl' also accepted
	$mail->Port = 587;   								       // TCP port to connect to

	$mail->AddAddress($to);	 						       // Add another recipient

	$mail->SetFrom($email, $_POST['name']);
	$mail->AddReplyTo($_POST['email'], $_POST['name']);

	$mail->IsHTML(true);                                  // Set email format to HTML

	$mail->CharSet = 'UTF-8';

	$mail->Subject = $subject;
	$mail->Body    = $message;

	$mail->Send();

		if($mail->Send()) {
			$arrResult = array('response'=> 'success');
            echo "Successfully sent";
		} else {
			$arrResult = array('response'=> 'error', 'error'=> $mail->ErrorInfo);
            echo $arrResult;
		}

	}
?>
