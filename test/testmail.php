<?
/*************************/
/* Check IMAP Connection */
/*************************/
$cfgServer = "mail.ebtke.esdm.go.id";
$cfgPort = 143;
$cfgTimeOut = 10;

/* get date and time first */
$date = date("Ymd H:i:s,");
$time1 = microtime();
$time1 = explode(" ", $time1);
echo "IMAP,$date";
/* open a socket */
$mail_handle = fsockopen($cfgServer, $cfgPort, &$errno, &$errstr, $cfgTimeOut);

if(!$mail_handle) {
$status = "DOWN:$errno:$errstr";
}
else {
$status = "UP";
fclose($mail_handle);
}
$time2 = microtime();
$time2 = explode(" ", $time2);
$timediff0 = $time2[0] - $time1[0];
$timediff1 = $time2[1] - $time1[1];
$timediff = $timediff1 + $timediff0;
echo "$status,$timediff\n";
echo "<br>";
?>
