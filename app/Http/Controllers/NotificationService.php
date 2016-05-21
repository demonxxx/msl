<?php

namespace App\Http\Controllers;

trait NotificationService
{
    public function pushOrderNotification($order) {
        // just for test apple remote notification

        /////////////////////////////////////////////////////////////////
        // Put your device token here (without spaces):
        $deviceToken = '5b89726d88914849d2c7534a91bf6f1c1bbd4cc799abb3ed879b6c24f55ad495';

        // Put your private key's passphrase here:
        $passphrase = '';

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', base_path('server/') . IOS_CERTIFICATE_FILE);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        $fp = stream_socket_client(
          'ssl://gateway.sandbox.push.apple.com:2195', $err,
          $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        if ($fp) {
          // Create the payload body
          $url = 'http://13.76.129.137';
          $body['aps'] = array(
            'alert' => $order->name,
            'sound' => 'default',
            'link_url' => $url,
            'category' => "NEWS_CATEGORY",
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
}
