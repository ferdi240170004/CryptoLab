<?php

require_once __DIR__ . '/../../algorithms/caesar.php';
require_once __DIR__ . '/../../algorithms/vigenere.php';

$result = '';
$error = '';

$inputText = '';
$shift = 3;
$key = 'KUNCI';
$mode = '';


/* =========================
   PROSES FORM
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputText = $_POST['text'] ?? '';

    $shift = (int) ($_POST['shift'] ?? 3);

    $key = trim($_POST['key'] ?? '');

    $mode = $_POST['mode'] ?? '';


    if ($inputText === '') {

        $error = 'Silakan masukkan text terlebih dahulu.';


    } elseif ($key === '') {

        $error = 'Silakan masukkan key Vigenère.';


    } else {

        /* =========================
           ENKRIPSI
        ========================= */

        if ($mode === 'encrypt') {

            // Tahap 1: Caesar Cipher
            $step1 = caesarEncrypt(
                $inputText,
                $shift
            );

            // Tahap 2: Vigenère Cipher
            $result = vigenereEncrypt(
                $step1,
                $key
            );


        /* =========================
           DEKRIPSI
        ========================= */

        } elseif ($mode === 'decrypt') {

            // Tahap 1: Dekripsi Vigenère
            $step1 = vigenereDecrypt(
                $inputText,
                $key
            );

            // Tahap 2: Dekripsi Caesar
            $result = caesarDecrypt(
                $step1,
                $shift
            );

        }

    }

}

?>


<div class="algorithm-page">


    <!-- =========================
         INTRO
    ========================== -->

    <div class="algorithm-intro">

        <div class="algorithm-icon">
            ⚡
        </div>


        <div>

            <h1>Hybrid Cipher</h1>


            <p>
                Hybrid Cipher merupakan metode kriptografi yang
                menggabungkan lebih dari satu algoritma dalam satu
                proses enkripsi untuk menghasilkan mekanisme keamanan
                yang lebih kompleks.
            </p>


            <div class="formula-box">

                <strong>Alur Enkripsi:</strong>

                <br>

                <code>
                    Plaintext → Caesar Cipher → Vigenère Cipher → Ciphertext
                </code>

                <br><br>

                <strong>Alur Dekripsi:</strong>

                <br>

                <code>
                    Ciphertext → Vigenère Cipher → Caesar Cipher → Plaintext
                </code>

            </div>

        </div>

    </div>


    <!-- =========================
         HEADER
    ========================== -->

    <div class="algorithm-header">


        <h2>
            ⚡ Simulasi Hybrid Cipher
        </h2>


        <p>
            Algoritma Hybrid Cipher ini menggabungkan
            <strong>Caesar Cipher</strong> dan
            <strong>Vigenère Cipher</strong>
            dalam satu proses pengamanan data.
        </p>


        <div class="alert alert-info mb-0">

            <strong>Metode yang digunakan:</strong>

            <br><br>

            1️⃣ Caesar Cipher

            <br>

            2️⃣ Vigenère Cipher

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


            <!-- CAESAR KEY -->

            <div class="mb-3">

                <label class="form-label fw-bold">

                    🔢 Key Caesar / Pergeseran

                </label>


                <input
                    type="number"
                    name="shift"
                    class="form-control"
                    value="<?= htmlspecialchars($shift) ?>"
                    required
                >


                <small class="text-muted">

                    Contoh: 3 berarti setiap huruf akan
                    digeser sebanyak 3 posisi.

                </small>

            </div>


            <!-- VIGENERE KEY -->

            <div class="mb-4">

                <label class="form-label fw-bold">

                    🔑 Key Vigenère

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

                    Key ini digunakan pada tahap kedua
                    proses Hybrid Cipher.

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
                    🔐 Enkripsi Hybrid
                </button>


                <button
                    type="submit"
                    name="mode"
                    value="decrypt"
                    class="btn btn-primary"
                >
                    🔓 Dekripsi Hybrid
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
                        ? '🔐 Hasil Enkripsi Hybrid'
                        : '🔓 Hasil Dekripsi Hybrid'
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