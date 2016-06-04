<?php
 require_once "Mail.php";
 
 $from = "Ajie <ajie@ebtke.esdm.go.id>";
 $to = "ajitekom <ajitekom@gmail.com>";
 $subject = "ebtke ke-1";
 $body = "Hi,\n\nHow are you?";
 
 $host = "mail.ebtke.esdm.go.id";
 $username = "manajemen.energi@ebtke.esdm.go.id";
 $password = "konservasi2014";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $body);
 
 if (PEAR::isError($mail)) {
   echo("<p>" . $mail->getMessage() . "</p>");
  } else {
   echo("<p>Message successfully sent!</p>");
  }
 ?>
