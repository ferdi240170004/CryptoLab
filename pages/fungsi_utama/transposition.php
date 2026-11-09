<?php

$result = '';
$error = '';

$inputText = '';
$key = '';
$mode = '';


/* =========================
   MEMBERSIHKAN KEY
========================= */

function transpositionCleanKey($key) {

    return preg_replace(
        '/[^A-Za-z0-9]/',
        '',
        $key
    );
}


/* =========================
   ENKRIPSI
========================= */

function transpositionEncrypt($text, $key) {

    $keyLength = strlen($key);

    if ($keyLength < 2) {
        return false;
    }


    $columns = array_fill(
        0,
        $keyLength,
        ''
    );


    $textLength = strlen($text);


    for ($i = 0; $i < $textLength; $i++) {

        $columnIndex = $i % $keyLength;

        $columns[$columnIndex] .= $text[$i];
    }


    $keyArray = str_split($key);

    $order = [];


    for ($i = 0; $i < $keyLength; $i++) {

        $order[] = [
            'key' => $keyArray[$i],
            'index' => $i
        ];

    }


    usort($order, function ($a, $b) {

        if ($a['key'] === $b['key']) {

            return $a['index'] <=> $b['index'];

        }

        return strcmp(
            $a['key'],
            $b['key']
        );

    });


    $result = '';


    foreach ($order as $item) {

        $result .= $columns[$item['index']];

    }


    return $result;
}


/* =========================
   DEKRIPSI
========================= */

function transpositionDecrypt($ciphertext, $key) {

    $keyLength = strlen($key);

    if ($keyLength < 2) {
        return false;
    }


    $length = strlen($ciphertext);


    $rows = (int) ceil(
        $length / $keyLength
    );


    $remainder = $length % $keyLength;


    $columnLengths = [];


    for ($i = 0; $i < $keyLength; $i++) {

        if ($remainder === 0) {

            $columnLengths[$i] = $rows;

        } else {

            $columnLengths[$i] =
                $i < $remainder
                    ? $rows
                    : $rows - 1;

        }

    }


    $keyArray = str_split($key);

    $order = [];


    for ($i = 0; $i < $keyLength; $i++) {

        $order[] = [
            'key' => $keyArray[$i],
            'index' => $i
        ];

    }


    usort($order, function ($a, $b) {

        if ($a['key'] === $b['key']) {

            return $a['index'] <=> $b['index'];

        }

        return strcmp(
            $a['key'],
            $b['key']
        );

    });


    $columns = array_fill(
        0,
        $keyLength,
        ''
    );


    $position = 0;


    foreach ($order as $item) {

        $index = $item['index'];

        $lengthColumn =
            $columnLengths[$index];


        $columns[$index] = substr(
            $ciphertext,
            $position,
            $lengthColumn
        );


        $position += $lengthColumn;

    }


    $result = '';


    for ($row = 0; $row < $rows; $row++) {

        for (
            $col = 0;
            $col < $keyLength;
            $col++
        ) {

            if (
                isset($columns[$col][$row])
            ) {

                $result .=
                    $columns[$col][$row];

            }

        }

    }


    return $result;
}


/* =========================
   PROSES FORM
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputText =
        $_POST['text'] ?? '';


    $key = transpositionCleanKey(
        $_POST['key'] ?? ''
    );


    $mode =
        $_POST['mode'] ?? '';


    if ($inputText === '') {

        $error =
            'Silakan masukkan text terlebih dahulu.';


    } elseif (strlen($key) < 2) {

        $error =
            'Key minimal terdiri dari 2 karakter.';


    } elseif ($mode === 'encrypt') {

        $result = transpositionEncrypt(
            $inputText,
            $key
        );


    } elseif ($mode === 'decrypt') {

        $result = transpositionDecrypt(
            $inputText,
            $key
        );

    }

}

?>


<div class="algorithm-page">


    <!-- =========================
         INTRO
    ========================== -->

    <div class="algorithm-intro">

        <div class="algorithm-icon">
            🔀
        </div>


        <div>

            <h1>Transposition Cipher</h1>


            <p>
                Transposition Cipher merupakan metode kriptografi klasik
                yang tidak mengganti karakter, tetapi mengubah posisi
                atau urutan karakter berdasarkan aturan tertentu.
            </p>


            <div class="formula-box">

                <strong>Konsep:</strong>

                <br>

                <code>
                    Plaintext → Pengubahan Posisi → Ciphertext
                </code>

            </div>

        </div>

    </div>


    <!-- =========================
         HEADER
    ========================== -->

    <div class="algorithm-header">


        <h2>
            🔀 Simulasi Transposition Cipher
        </h2>


        <p>
            Algoritma ini menggunakan metode
            <strong>Columnar Transposition Cipher</strong>
            untuk mengubah urutan karakter berdasarkan key.
        </p>


        <div class="alert alert-info mb-0">

            <strong>Metode:</strong>

            Columnar Transposition Cipher

            <br>

            <strong>Contoh Key:</strong>

            KUNCI

        </div>

    </div>


    <!-- =========================
         FORM
    ========================== -->

    <div class="algorithm-card">


        <form method="POST">


            <!-- TEXT -->

            <div class="mb-3">

                <label class="form-label fw-bold">

                    📝 Masukkan Plaintext / Ciphertext

                </label>


                <textarea
                    name="text"
                    class="form-control"
                    rows="4"
                    placeholder="Contoh: HALO DUNIA"
                    required
                ><?= htmlspecialchars($inputText) ?></textarea>

            </div>


            <!-- KEY -->

            <div class="mb-4">

                <label class="form-label fw-bold">

                    🔑 Key

                </label>


                <input
                    type="text"
                    name="key"
                    class="form-control"
                    value="<?= htmlspecialchars($key) ?>"
                    placeholder="Contoh: KUNCI"
                    required
                >


                <small class="text-muted">

                    Key digunakan untuk menentukan urutan
                    kolom dalam proses transposition.

                    Minimal terdiri dari 2 karakter.

                </small>

            </div>


            <!-- BUTTON -->

            <div class="d-flex gap-2 flex-wrap">


                <button
                    type="submit"
                    name="mode"
                    value="encrypt"
                    class="btn btn-success"
                >
                    🔐 Enkripsi
                </button>


                <button
                    type="submit"
                    name="mode"
                    value="decrypt"
                    class="btn btn-primary"
                >
                    🔓 Dekripsi
                </button>


 <a href="index.php?page=NAMA_HALAMAN" class="btn btn-secondary">
    🔄 Reset
</a>


            </div>


        </form>


        <!-- =========================
             ERROR
        ========================== -->

        <?php if ($error !== ''): ?>


            <div class="alert alert-danger mt-4">

                <?= htmlspecialchars($error) ?>

            </div>


        <?php endif; ?>


        <!-- =========================
             HASIL
        ========================== -->

        <?php if ($result !== ''): ?>


            <hr>


            <div class="result-box">


                <h4>

                    <?= $mode === 'encrypt'
                        ? '🔐 Hasil Enkripsi'
                        : '🔓 Hasil Dekripsi'
                    ?>

                </h4>


                <div class="result-text">

                    <?= htmlspecialchars($result) ?>

                </div>


                <button
                    type="button"
                    class="btn btn-outline-success btn-sm mt-3"
                    onclick="copyResult(this)"
                >
                    📋 Copy Hasil
                </button>


            </div>


        <?php endif; ?>


    </div>


</div>