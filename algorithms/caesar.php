<?php

function caesarEncrypt($text, $shift) {
    $result = '';

    $shift = $shift % 26;

    for ($i = 0; $i < strlen($text); $i++) {

        $char = $text[$i];

        if (ctype_alpha($char)) {

            $ascii = ord($char);

            if (ctype_upper($char)) {
                $base = ord('A');
            } else {
                $base = ord('a');
            }

            $result .= chr(
                ($ascii - $base + $shift) % 26 + $base
            );

        } else {
            $result .= $char;
        }
    }

    return $result;
}


function caesarDecrypt($text, $shift) {

    $result = '';

    $shift = $shift % 26;

    for ($i = 0; $i < strlen($text); $i++) {

        $char = $text[$i];

        if (ctype_alpha($char)) {

            $ascii = ord($char);

            if (ctype_upper($char)) {
                $base = ord('A');
            } else {
                $base = ord('a');
            }

            $result .= chr(
                ($ascii - $base - $shift + 26) % 26 + $base
            );

        } else {
            $result .= $char;
        }
    }

    return $result;
}
?>