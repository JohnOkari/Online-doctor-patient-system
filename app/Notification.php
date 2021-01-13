<?php

namespace App;
class Notification
{
     public function senMessage($msisdn, $message) 
     {
       $url = 'https://app.bongasms.co.ke/api/send-sms-v1';

       $post_data = http_build_query([
           "apiClientID" => 92,
           "key" => 'DDzpUwF8OrRyj00',
           "secret" => 'kIijHOduqBg36bPQVVaxAMlBKX67Fw',
           "txtMessage" => $message,
           "MSISDN" => $msisdn,
           "serviceID" => 1
       ]);

       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded '));
       curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $result = curl_exec($ch);
       $result = json_decode($result);
       return $result;
     }
     
}
