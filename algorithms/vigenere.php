<?php

function vigenereEncrypt($text, $key) {

    $result = '';
    $key = strtoupper($key);
    $keyLength = strlen($key);
    $keyIndex = 0;

    for ($i = 0; $i < strlen($text); $i++) {

        $char = $text[$i];

        if (ctype_alpha($char)) {

            $shift = ord($key[$keyIndex % $keyLength]) - ord('A');

            if (ctype_upper($char)) {
                $base = ord('A');
            } else {
                $base = ord('a');
            }

            $result .= chr(
                (ord($char) - $base + $shift) % 26 + $base
            );

            $keyIndex++;

        } else {

            $result .= $char;

        }
    }

    return $result;
}


function vigenereDecrypt($text, $key) {

    $result = '';
    $key = strtoupper($key);
    $keyLength = strlen($key);
    $keyIndex = 0;

    for ($i = 0; $i < strlen($text); $i++) {

        $char = $text[$i];

        if (ctype_alpha($char)) {

            $shift = ord($key[$keyIndex % $keyLength]) - ord('A');

            if (ctype_upper($char)) {
                $base = ord('A');
            } else {
                $base = ord('a');
            }

            $result .= chr(
                (ord($char) - $base - $shift + 26) % 26 + $base
            );

            $keyIndex++;

        } else {

            $result .= $char;

        }
    }

    return $result;
}

?>