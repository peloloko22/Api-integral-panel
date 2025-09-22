<?php

$ch = curl_init("https://oauth2.googleapis.com/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo '❌ Error: ' . curl_error($ch);
} else {
    echo '✅ Conexión CURL exitosa';
}

curl_close($ch);
