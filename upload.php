<?php
require 'C:\xampp\htdocs\upload vmo\vendor\autoload.php';
use Vimeo\Vimeo;


$client = new Vimeo("59035cd78d37a8c58b6ac41646adf57bb", "yP5nLWM/FnlRUw0iY+YwEvIQSjK/LZKLXieuEtxJ95oXuaWMOiuDBQwvkHYVXmERCo51ps6gO95JCM3HHhIoK5GAJ+0KR+LvN7juODW9Zfh2KEdaVGXj7jwf2ta", "6fbb14a5f89fbee0ea7f2f99c8639");

$response = $client->request('/tutorial', array(), 'GET');
print_r($response);


$file_name = "C:\Users\o\Downloads\list.mp4";
$uri = $client->upload($file_name, array(
    "name" => "myvmo",
    "description" => "upload vdo"
));

echo "Your video URI is: " . $uri;

$response = $client->request($uri . '?fields=transcode.status');
if ($response['body']['transcode']['status'] === 'complete') {
  print 'Your video finished transcoding.';
} elseif ($response['body']['transcode']['status'] === 'in_progress') {
  print 'Your video is still transcoding.';
} else {
  print 'Your video encountered an error during transcoding.';
}

$response = $client->request($uri . '?fields=link');
echo "Your video link is: " . $response['body']['link'];