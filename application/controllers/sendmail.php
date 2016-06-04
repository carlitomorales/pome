<?php

        require_once "Mail.php";

//        require("smtp.php");

		ini_set('display_errors',1);
		error_reporting(~0);


		if (isset($_GET["from"])){
            $from = $_GET["from"];
            $to = $_GET["to"];
            $subject = $_GET["subject"];
            $message = $_GET["message"];


            $body = "Hi,\n\nHow are you?";

            $headers = array(
                'From' => $from,
                'To' => $to,
                'Subject' => $subject
            );

            $smtp = Mail::factory('smtp', array(
                'host' => 'ssl://smtp.gmail.com',
                'port' => '465',
                'auth' => true,
                'username' => 'angkrang222@gmail.com',
                'password' => 'hompimpa123'
            ));

            $mail = $smtp->send($to, $headers, $subject);

            if (PEAR::isError($mail)) {
                echo('<p>' . $mail->getMessage() . '</p>');
            } else {
                echo('<p>Message successfully sent!</p>');
            }







//
//            $mail->IsSMTP(); // telling the class to use SMTP
//            $mail->Host       = "mail.cariku.com"; // SMTP server
//            $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
//            // 1 = errors and messages
//            // 2 = messages only
//            $mail->SMTPAuth   = true;                  // enable SMTP authentication
//            $mail->Host       = "mail.cariku.com"; // sets the SMTP server
//            $mail->Port       = 26;                    // set the SMTP port for the GMAIL server
//            $mail->Username   = "smtp@cariku.com"; // SMTP account username
//            $mail->Password   = "darkvortex123@#$";        // SMTP account password
//
//            $mail->SetFrom($from, 'First Last');
//            $mail->AddReplyTo($from,"First Last");
//            $mail->Subject    = $subject;
//
//            if (isset($_GET["alterbody"])){
//                $alterbody = $_GET["alterbody"];
//                $mail->AltBody    = $alterbody;
//            } // optional, comment out and test}
//
//            $mail->MsgHTML($message);
//            $mail->AddAddress($to, "John Doe");
//            if(isset($_GET["attachment"])){
//                $attachment = $_GET["attachment"];
//                $mail->AddAttachment("images/phpmailer.gif");      // attachment
//                $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
//            }
//            if(!$mail->Send()) {
//                echo "Mailer Error: " . $mail->ErrorInfo;
//            } else {
//                echo "Message sent!";
//            }

        } elseif (isset($_POST["from"])) {
				$from = $_POST["from"]; // sender
				$to = $_POST["to"];
				$subject = $_POST["subject"];
				$message = $_POST["message"];
                $host = "mail.example.com";
                $username = "smtp_username";
                $password = "smtp_password";
				// message lines should not exceed 70 characters (PHP rule), so wrap it
				//$message = wordwrap($message, 70);
				// send mail
				if(mail($to,$subject,$message,"From: $from\n")){echo "post success";}
                else{echo "post failed";}
        }else {echo "failed to send";}



?>



