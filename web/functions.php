<?php
function getTolVal($selected, $tols) {
    return [$selected, $tols];
}

function reqUrl($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,  [
        'Content-Type: application/json',
        'Accept: application/json',
    ]);
    // curl_setopt($ch, CURLOPT_ENCODING,"");

    header('Content-Type: text/html');
    $data = curl_exec($ch);
    return $data;
}

function sendFile($url, $file_path, $file) {
    // Persiapkan data untuk dikirim
    // $filePath = $file_path;
    $fileAbsolutePath = realpath($file_path);

    if (!$fileAbsolutePath) {
        die("File tidak ditemukan: $file_path");
    }

    // Inisialisasi cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,  [
        'Accept: application/json',
        'Content-Type: multipart/form-data'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'my_file' => new CURLFile($fileAbsolutePath, 'text/csv', basename($file_path))
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_VERBOSE, True);
    curl_setopt($ch, CURLOPT_STDERR, fopen('php://stderr', 'w'));
    // // Eksekusi cURL dan tangani respons
    $res = curl_exec($ch);

    // Periksa error cURL
    /*if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        // Tampilkan respons dari server
        echo 'Response:' . $res;
    }*/
    return $res;
    // curl_close($ch);
}
?>