<?php

namespace App\Http\Controllers;

use App\Configs;
use Illuminate\Support\Facades\Response;
trait NotificationService {

    public function pushOrderNotification($order) {
        // just for test apple remote notification
        /////////////////////////////////////////////////////////////////
        // Put your device token here (without spaces):
//        $deviceToken = '104f93b8f6323e24eff605bb15e860ffc919642b1f1fdf99aa6b36ddb6765f7b';
//
//        // Put your private key's passphrase here:
//        $passphrase = 'Abc@@123';
//
//        $ctx = stream_context_create();
//        stream_context_set_option($ctx, 'ssl', 'local_cert', base_path('server/') . IOS_CERTIFICATE_FILE);
//        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
//
//        $fp = stream_socket_client(
//                'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
//        if ($fp) {
//            // Create the payload body
//            $url = 'http://13.76.129.137';
//            $body['aps'] = array(
//                'alert' => $order->code,
//                'sound' => 'default',
//                'link_url' => $url,
//                'category' => "NEWS_CATEGORY",
//            );
//
//            // Encode the payload as JSON
//            $payload = json_encode($body);
//
//            // Build the binary notification
//            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
//
//            // Send it to the server
//            $result = fwrite($fp, $msg, strlen($msg));
//
//            // Close the connection to the server
//        }
//        fclose($fp);
    }

    public function pushStatusOrder($deviceToken, $message, $order_id = null) {
        $passphrase = '123456';
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', base_path('server/') . IOS_CERTIFICATE_FILE);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        $fp = stream_socket_client(
            'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if ($fp) {
            // Create the payload body
            $url = 'http://13.76.129.137';

            $body['aps'] = array(
                'alert' => $message,
                'sound' => 'default',
                'link_url' => $url,
                'order_id' => $order_id
            );

            // Encode the payload as JSON
            $payload = json_encode($body);

            // Build the binary notification
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));

            // Close the connection to the server
        }
        fclose($fp);
    }

    /**
     * Sending Push Notification
     * $registatoin_ids an array id of user who get notification
     * $message message push to user
     */
    public function send_gcm_notification($registatoin_ids, $message) {
        // Set POST variables
        $config = new Configs;
        $gcm_config = $config->get_gcm_config();
        $url = $gcm_config->url;

        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => array("message" => $message)
        );

        $headers = array(
            'Authorization: key=' . $gcm_config->description,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            return FALSE;
        }

        // Close connection
        curl_close($ch);
        return $result;
    }

}
