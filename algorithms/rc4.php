<?php

function rc4Process($data, $key) {

    $keyLength = strlen($key);

    if ($keyLength === 0) {
        return false;
    }

    // Inisialisasi S-Box
    $s = [];

    for ($i = 0; $i < 256; $i++) {
        $s[$i] = $i;
    }

    // Key Scheduling Algorithm (KSA)
    $j = 0;

    for ($i = 0; $i < 256; $i++) {

        $j = (
            $j
            + $s[$i]
            + ord($key[$i % $keyLength])
        ) % 256;

        $temp = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $temp;
    }

    // Pseudo Random Generation Algorithm (PRGA)
    $i = 0;
    $j = 0;

    $result = '';

    for ($x = 0; $x < strlen($data); $x++) {

        $i = ($i + 1) % 256;
        $j = ($j + $s[$i]) % 256;

        $temp = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $temp;

        $k = $s[
            ($s[$i] + $s[$j]) % 256
        ];

        $result .= chr(
            ord($data[$x]) ^ $k
        );
    }

    return $result;
}


function rc4Encrypt($plaintext, $key) {

    $encrypted = rc4Process($plaintext, $key);

    if ($encrypted === false) {
        return false;
    }

    // Base64 agar ciphertext mudah ditampilkan
    return base64_encode($encrypted);
}


function rc4Decrypt($ciphertext, $key) {

    $decoded = base64_decode($ciphertext, true);

    if ($decoded === false) {
        return false;
    }

    return rc4Process($decoded, $key);
}

?>