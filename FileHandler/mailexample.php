<?php

$to="gauravalpha0@gmail.com";
$subject="New to PHP mail function";
$message="Hi this is my first mail using php mail() function.";
$headers =  "MIME-Version: 1.0" . "\r\n";
$headers .= "From: icon.gaurav806@gmail.com" . "\r\n";
$headers .= "Content-type: text/plain text;"; 
echo mail($to, $subject, $message, $headers);