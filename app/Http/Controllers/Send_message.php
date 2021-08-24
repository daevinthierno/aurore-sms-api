<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Send_message extends Controller
{
    function send_sms(Request $request){

        $number = $request->input('number');
        $body =   $request->input('message');

        $basic  = new \Vonage\Client\Credentials\Basic("9154b1d8", "1nnF1k74vDBluyGS");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($number, 'Aurore', $body)
        );
        
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            return json_encode("The message was sent successfully\n");
        } else {
            return json_encode("The message failed with status: " . $message->getStatus() . "\n");
        }
    }
}
