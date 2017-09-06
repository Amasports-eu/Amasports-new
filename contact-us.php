<?php
session_start();
error_reporting(1);
include("php/PHPMailer/PHPMailerAutoload.php");

// Step 1 - Enter your email address below.
$to =  'info@amasports.eu'; // Change where to send emails 

if(isset($_POST['emailSent'])) {

	$subject = $_POST['subject'];

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
				'text' => 'Phones',
				'val' => $_POST['phone']
			)
		);

		$message = "";

		foreach($fields as $field) {
			$message .= $field['text'].": " . htmlspecialchars($field['val'], ENT_QUOTES) . "<br>\n";
		}        
		$mail = new PHPMailer;
        
		$mail->IsSMTP();                                      // Set mailer to use SMTP
		$mail->SMTPDebug = 0;                                 // Debug Mode
        $mail->Port = 587;  //465; //587; 
		// Step 4 - If you don't receive the email, try to configure the parameters below:
		$mail->Host = 'smtp.gmail.com';//'mail.lcn.com';				  // Specify main and backup server
        $mail->SMTPAuth = true;                             // Enable SMTP authentication
		$mail->Username = 'info@amasports.eu';   //'info@bathwestfire.co.uk';  //   'mudassarmdmd@gmail.com';   //         		  
		$mail->Password ='orsetto10';        //  'Hea;  //                 // SMTP password
		$mail->SMTPSecure ='tsl';  // 'tsl';                          // Enable encryption, 'ssl' also accepted
		$mail->From = $email;
		$mail->FromName = $_POST['name'];
		$mail->AddAddress($to);
		$mail->AddReplyTo($email, $name);

		$mail->IsHTML(true);

		$mail->CharSet = 'UTF-8';

		$mail->Subject = $subject;
		$mail->Body    = $message;

		// Step 5 - If you don't want to attach any files, remove that code below
		if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
			$mail->AddAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
		}

		if($mail->Send()) {
			$arrResult = array('response'=> 'success');
            echo "Successfully sent";
		} else {
            $arrResult = array('response'=> 'error', 'error'=> $mail->ErrorInfo);
            echo $arrResult;
		}
            }

else {
echo "Error in connection";
}
?>