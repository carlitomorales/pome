<?php
require_once "Mail.php";
 
$from = "<tamu@esdm.go.id>";
$to = "ajie <ajitekom@gmail.com>";
$subject = "dari Cikini \r\n\r\n";
$body = "ini adalah test emaul dari EBTKE";
 
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
