<?php

$data = $argv[1];                     //data to be encrypted
$cipher = "aes-128-gcm";
$key = $argv[2];                      //key for encryption and decryption
$option = 0;
$ivlen = openssl_cipher_iv_length($cipher);
$iv = openssl_random_pseudo_bytes($ivlen);

$encryptedData = openssl_encrypt($data, $cipher, $key, $option, $iv, $tag);      //encrypts data
echo 'ciphertext: ' . $encryptedData . PHP_EOL;

$decryptedData = openssl_decrypt($encryptedData, $cipher, $key, $option, $iv, $tag);    //decrypts data
echo 'origineletext: ' . $decryptedData;

?>