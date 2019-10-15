<?php

if( isset($_POST["Resason"]) || isset($_POST["TextReason"])) {
$HtmlText ='';
$pass = '#'; // Add your key

$url = 'https://api.sendgrid.com/';

if($_POST["TextReason"]!=''){
$HtmlText  = " Resaon: "." " . $_POST["Resason"] ." <br> ". "Resaon Text:"." ". $_POST["TextReason"] ." <br> " . "User site url: ". " ". $_POST["SiteUrl"].
    " <br> " ."User Email: " . " ". $_POST['SiteAdminEmail'];
}
else{
    $HtmlText  = " Resaon: "." " . $_POST["Resason"] ." <br> ". "User site url: ". " ". $_POST["SiteUrl"].
    " <br> " ."User Email: " . " ". $_POST['SiteAdminEmail'];
}
$params = array(
    'to'        => 'info@spicethemes.com',     
    'subject'   => 'Spicepress Theme Feedback',
    'html'      => $HtmlText,
    'from'      => 'spicepress@spicethemes.com',
);



//"ITEMPURCHASED" => ($value != 0) ? array ("DVD", "Book", "Comic") : null

$request =  $url.'api/mail.send.json';
$headr = array();
// set authorization header
$headr[] = 'Authorization: Bearer '.$pass;

$session = curl_init($request);
curl_setopt ($session, CURLOPT_POST, true);
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// add authorization header
curl_setopt($session, CURLOPT_HTTPHEADER,$headr);

$response = curl_exec($session);
curl_close($session);
}
?>