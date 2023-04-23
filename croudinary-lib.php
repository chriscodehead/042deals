<?php
require __DIR__ . '/vendor/autoload.php';

// Use the Configuration class 
use Cloudinary\Configuration\Configuration;
use Cloudinary\Cloudinary;

 // Use the UploadApi class for uploading assets
use Cloudinary\Api\Upload\UploadApi;

// Configure an instance of your Cloudinary cloud


function cloud_upload($file, $type){
  $config = Configuration::instance([
  'cloud' => [
    'cloud_name' => 'djkhhz6kf', 
    'api_key' => '829879227996165', 
    'api_secret' => 'TGv0H_ySPf0NKW4bWDQB8ECXO-4'],
  'url' => [
    'secure' => false]
    ]);
// Upload the image
  $cloudinary = new Cloudinary($config);
   // $upload = new UploadApi();
    $cloudinary->uploadApi()->upload($file, [
     'resource_type' => 'image'
    ]);
}