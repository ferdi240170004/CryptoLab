<?php

$result = '';
$error = '';

$inputText = '';
$key = '';
$mode = '';

$cipher = 'AES-256-CBC';


/* =========================
   PROSES FORM
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputText = $_POST['text'] ?? '';
    $key = $_POST['key'] ?? '';
    $mode = $_POST['mode'] ?? '';


    if ($inputText === '') {

        $error = 'Silakan masukkan text terlebih dahulu.';


    } elseif ($key === '') {

        $error = 'Silakan masukkan key terlebih dahulu.';


    } else {

        /*
         * Membuat key 32 byte menggunakan SHA-256
         * untuk AES-256
         */

        $encryptionKey = hash(
            'sha256',
            $key,
            true
        );


        /* =========================
           ENKRIPSI
        ========================= */

        if ($mode === 'encrypt') {

            /*
             * AES-CBC membutuhkan IV.
             * Panjang IV disesuaikan dengan cipher.
             */

            $iv = random_bytes(
                openssl_cipher_iv_length($cipher)
            );


            $encrypted = openssl_encrypt(
                $inputText,
                $cipher,
                $encryptionKey,
                OPENSSL_RAW_DATA,
                $iv
            );


            if ($encrypted === false) {

                $error =
                    'Terjadi kesalahan saat proses enkripsi.';

            } else {

                /*
                 * IV dan ciphertext digabungkan,
                 * kemudian diubah ke format Base64.
                 */

                $result = base64_encode(
                    $iv . $encrypted
                );

            }


        /* =========================
           DEKRIPSI
        ========================= */

        } elseif ($mode === 'decrypt') {

            /*
             * Mengubah Base64 kembali menjadi data asli
             */

            $decoded = base64_decode(
                $inputText,
                true
            );


            if ($decoded === false) {

                $error =
                    'Ciphertext Base64 tidak valid.';


            } else {

                $ivLength =
                    openssl_cipher_iv_length($cipher);


                /*
                 * Mengambil IV dari bagian awal data
                 */

                $iv = substr(
                    $decoded,
                    0,
                    $ivLength
                );


                /*
                 * Mengambil ciphertext setelah IV
                 */

                $encryptedData = substr(
                    $decoded,
                    $ivLength
                );


                /*
                 * Proses dekripsi AES
                 */

                $result = openssl_decrypt(
                    $encryptedData,
                    $cipher,
                    $encryptionKey,
                    OPENSSL_RAW_DATA,
                    $iv
                );


                if ($result === false) {

                    $error =
                        'Gagal mendekripsi. Pastikan key yang digunakan benar.';

                    $result = '';

                }

            }

        }

    }

}

?>


<div class="algorithm-page">


    <!-- =========================
         INTRO AES
    ========================== -->

    <div class="algorithm-intro">

        <div class="algorithm-icon">
            🔷
        </div>


        <div>

            <h1>AES-256-CBC</h1>


            <p>
                AES (Advanced Encryption Standard) adalah algoritma
                kriptografi modern jenis symmetric block cipher yang
                digunakan secara luas untuk melindungi data.
            </p>


            <div class="formula-box">

                <strong>Informasi:</strong>

                <br>

                <code>
                    Jenis: Symmetric Block Cipher
                </code>

                <br>

                <code>
                    Ukuran Block: 128-bit
                </code>

                <br>

                <code>
                    Key: AES-256 (256-bit)
                </code>

                <br>

                <code>
                    Mode: CBC
                </code>

            </div>

        </div>

    </div>


    <!-- =========================
         HEADER
    ========================== -->

    <div class="algorithm-header">


        <h2>
            🔷 Simulasi AES-256-CBC
        </h2>


        <p>
            Masukkan plaintext atau ciphertext serta secret key untuk
            melakukan proses enkripsi dan dekripsi menggunakan
            algoritma AES-256-CBC.
        </p>


        <div class="alert alert-info mb-0">

            <strong>Konfigurasi:</strong>

            <br><br>

            🔐 Algoritma: AES-256-CBC

            <br>

            🔑 Key: SHA-256 dari Secret Key

            <br>

            📦 Output Enkripsi: Base64

            <br>

            🔢 IV: Dibuat secara acak setiap proses enkripsi

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


                <small class="text-muted">

                    Untuk proses dekripsi, masukkan hasil ciphertext
                    AES dalam format Base64.

                </small>

            </div>


            <!-- KEY -->

            <div class="mb-4">

                <label class="form-label fw-bold">

                    🔑 Secret Key

                </label>


                <input
                    type="text"
                    name="key"
                    class="form-control"
                    value="<?= htmlspecialchars($key) ?>"
                    placeholder="Contoh: CRYPTOLAB2026"
                    required
                >


                <small class="text-muted">

                    Secret Key akan diproses menggunakan SHA-256
                    untuk menghasilkan key AES 256-bit.

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
                    🔐 Enkripsi AES
                </button>


                <button
                    type="submit"
                    name="mode"
                    value="decrypt"
                    class="btn btn-primary"
                >
                    🔓 Dekripsi AES
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
                        ? '🔐 Hasil Enkripsi AES (Base64)'
                        : '🔓 Hasil Dekripsi AES'
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