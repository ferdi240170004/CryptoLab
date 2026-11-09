<?php

function mod26($number) {
    return (($number % 26) + 26) % 26;
}

function hillCleanText($text) {
    return strtoupper(preg_replace('/[^A-Z]/i', '', $text));
}

function hillParseKey($a, $b, $c, $d) {
    return [
        (int)$a,
        (int)$b,
        (int)$c,
        (int)$d
    ];
}

function hillDeterminant($a, $b, $c, $d) {
    return ($a * $d) - ($b * $c);
}

function hillModInverse($number, $mod = 26) {

    $number = mod26($number);

    for ($i = 1; $i < $mod; $i++) {
        if (mod26($number * $i) === 1) {
            return $i;
        }
    }

    return null;
}

function hillIsValidKey($a, $b, $c, $d) {

    $det = hillDeterminant($a, $b, $c, $d);
    $inverse = hillModInverse($det);

    return $inverse !== null;
}

function hillEncrypt($text, $a, $b, $c, $d) {

    $text = hillCleanText($text);

    if (strlen($text) % 2 !== 0) {
        $text .= 'X';
    }

    $result = '';

    for ($i = 0; $i < strlen($text); $i += 2) {

        $x1 = ord($text[$i]) - 65;
        $x2 = ord($text[$i + 1]) - 65;

        $y1 = mod26(($a * $x1) + ($b * $x2));
        $y2 = mod26(($c * $x1) + ($d * $x2));

        $result .= chr($y1 + 65);
        $result .= chr($y2 + 65);
    }

    return $result;
}

function hillDecrypt($text, $a, $b, $c, $d) {

    $text = hillCleanText($text);

    if (strlen($text) % 2 !== 0) {
        return false;
    }

    $det = hillDeterminant($a, $b, $c, $d);

    $detInverse = hillModInverse($det);

    if ($detInverse === null) {
        return false;
    }

    $invA = mod26($detInverse * $d);
    $invB = mod26($detInverse * (-$b));
    $invC = mod26($detInverse * (-$c));
    $invD = mod26($detInverse * $a);

    $result = '';

    for ($i = 0; $i < strlen($text); $i += 2) {

        $y1 = ord($text[$i]) - 65;
        $y2 = ord($text[$i + 1]) - 65;

        $x1 = mod26(($invA * $y1) + ($invB * $y2));
        $x2 = mod26(($invC * $y1) + ($invD * $y2));

        $result .= chr($x1 + 65);
        $result .= chr($x2 + 65);
    }

    return $result;
}

?>