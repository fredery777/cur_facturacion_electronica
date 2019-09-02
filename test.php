<?php

include("HTTPRequester.php");

if(!defined('BASE_URL_API_BILLING'))define('BASE_URL_API_BILLING', 'https://api.soenac.com/api/ubl2.1/');
if(!defined('BILLING_DEBUG'))define('BILLING_DEBUG', true);//TEST
if(!defined('TEST_SET_ID_DEBUG'))define('TEST_SET_ID_DEBUG', 'YOUR testSetId');//TEST
if(!defined('TOKEN_BILLING'))define('TOKEN_BILLING', 'YOUR TOKEN');

 $url=(BILLING_DEBUG)?BASE_URL_API_BILLING.'invoice/'.BASE_URL_API_BILLING :BASE_URL_API_BILLING.'invoice';

$json_send="Your Data";
$token=TOKEN_BILLING;
$response = HTTPRequester::HTTPPost($url, json_decode(json_send,true),$token,true);
$arr_response= json_decode($response,true);
print_r($arr_response);exit;
