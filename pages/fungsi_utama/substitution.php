<?php

$result = '';
$error = '';

$inputText = '';
$key = 'QWERTYUIOPASDFGHJKLZXCVBNM';
$mode = '';


function isValidSubstitutionKey($key) {

    $key = strtoupper($key);

    if (strlen($key) !== 26) {
        return false;
    }

    if (!ctype_alpha($key)) {
        return false;
    }

    return count(array_unique(str_split($key))) === 26;
}


function substitutionEncrypt($text, $key) {

    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $key = strtoupper($key);

    $result = '';

    for ($i = 0; $i < strlen($text); $i++) {

        $char = $text[$i];

        if (ctype_alpha($char)) {

            $isUpper = ctype_upper($char);

            $position = strpos(
                $alphabet,
                strtoupper($char)
            );

            $newChar = $key[$position];

            $result .= $isUpper
                ? $newChar
                : strtolower($newChar);

        } else {

            $result .= $char;

        }
    }

    return $result;
}


function substitutionDecrypt($text, $key) {

    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $key = strtoupper($key);

    $result = '';

    for ($i = 0; $i < strlen($text); $i++) {

        $char = $text[$i];

        if (ctype_alpha($char)) {

            $isUpper = ctype_upper($char);

            $position = strpos(
                $key,
                strtoupper($char)
            );

            $newChar = $alphabet[$position];

            $result .= $isUpper
                ? $newChar
                : strtolower($newChar);

        } else {

            $result .= $char;

        }
    }

    return $result;
}


/* =========================
   PROSES FORM
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputText = $_POST['text'] ?? '';
    $key = $_POST['key'] ?? '';
    $mode = $_POST['mode'] ?? '';

    $key = strtoupper(trim($key));

    if ($inputText === '') {

        $error = 'Silakan masukkan text terlebih dahulu.';

    } elseif (!isValidSubstitutionKey($key)) {

        $error = 'Key harus terdiri dari 26 huruf unik tanpa pengulangan.';

    } elseif ($mode === 'encrypt') {

        $result = substitutionEncrypt(
            $inputText,
            $key
        );

    } elseif ($mode === 'decrypt') {

        $result = substitutionDecrypt(
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
            🔄
        </div>

        <div>

            <h1>Substitution Cipher</h1>

            <p>
                Substitution Cipher adalah metode kriptografi klasik yang
                bekerja dengan menggantikan setiap karakter pada plaintext
                dengan karakter lain berdasarkan sebuah tabel atau key
                substitusi.
            </p>

            <div class="formula-box">

                <strong>Konsep:</strong>

                <br>

                <code>
                    Plaintext → Substitusi berdasarkan Key → Ciphertext
                </code>

            </div>

        </div>

    </div>


    <!-- =========================
         HEADER
    ========================== -->

    <div class="algorithm-header">

        <h2>🔄 Simulasi Substitution Cipher</h2>

        <p>
            Masukkan plaintext atau ciphertext dan gunakan key substitusi
            untuk melakukan proses enkripsi maupun dekripsi.
        </p>

        <div class="alert alert-info mb-0">

            <strong>Contoh Substitution Key:</strong>

            <br><br>

            <strong>Alphabet:</strong>

            <br>

            ABCDEFGHIJKLMNOPQRSTUVWXYZ

            <br>

            <strong>Key:</strong>

            <br>

            QWERTYUIOPASDFGHJKLZXCVBNM

        </div>

    </div>


    <!-- =========================
         FORM CARD
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

                    🔑 Key Substitution (26 Huruf)

                </label>


                <input
                    type="text"
                    name="key"
                    class="form-control"
                    value="<?= htmlspecialchars($key) ?>"
                    maxlength="26"
                    required
                >


                <small class="text-muted">

                    Key harus berisi tepat 26 huruf dan semua huruf
                    harus berbeda tanpa pengulangan.

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
             RESULT
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