<?php
// include the access token
include 'accessToken.php';
date_default_timezone_set('Africa/Nairobi');
$processrequesturl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest   ';
$callbackurl = 'https:umeskiasoftwares.com/darajaapp/callback.php';
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BusinessShortCode ='174379';
$Timestamp = date('YmdHis');
$Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
$phone = '254711286968';
$money = '1';
$PartyA = $phone;
$PartyB = '254708153092';
$AccountReference = 'DERFOMISHAPI';
$TransactionDesc = 'stkpush test';
$Amount = $money;
$stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer '. $access_token];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $processrequesturl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader); //setting customer header
$curl_post_data = array(
    //fill in the request  parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Timestamp,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'customerPayBillonline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $callbackurl,
'AccountReference' => $AccountReference,
'TransactionDesc' => $TransactionDesc
);
$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);
//ECHO THE RESPONSE
echo $curl_response;