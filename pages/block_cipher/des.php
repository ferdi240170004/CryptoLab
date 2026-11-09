<?php

$result = '';
$error = '';

$inputText = '';
$key = '';
$mode = '';

// =========================
// KONFIGURASI DES
// =========================

$cipher = 'DES-CBC';


// =========================
// CEK CIPHER DES
// =========================

if (
    !in_array(
        strtolower($cipher),
        array_map(
            'strtolower',
            openssl_get_cipher_methods()
        )
    )
) {

    $error =
        'Cipher DES-CBC tidak tersedia pada OpenSSL PHP yang digunakan.';

}


// =========================
// PROSES FORM
// =========================

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $error === '') {

    $inputText =
        $_POST['text'] ?? '';

    $key =
        $_POST['key'] ?? '';

    $mode =
        $_POST['mode'] ?? '';


    if ($inputText === '') {

        $error =
            'Silakan masukkan text terlebih dahulu.';


    } elseif ($key === '') {

        $error =
            'Silakan masukkan key terlebih dahulu.';


    } else {


        /*
         * DES menggunakan key sepanjang 8 byte.
         * Input key diproses menggunakan SHA-256,
         * kemudian diambil 8 byte pertama.
         */

        $encryptionKey = substr(
            hash(
                'sha256',
                $key,
                true
            ),
            0,
            8
        );


        // =========================
        // ENKRIPSI
        // =========================

        if ($mode === 'encrypt') {


            /*
             * Mengambil panjang IV
             * sesuai dengan cipher DES.
             */

            $ivLength =
                openssl_cipher_iv_length($cipher);


            /*
             * Membuat IV secara acak.
             */

            $iv =
                random_bytes($ivLength);


            /*
             * Proses enkripsi DES-CBC.
             */

            $encrypted =
                openssl_encrypt(
                    $inputText,
                    $cipher,
                    $encryptionKey,
                    OPENSSL_RAW_DATA,
                    $iv
                );


            if ($encrypted === false) {

                $error =
                    'Terjadi kesalahan saat proses enkripsi DES.';


            } else {


                /*
                 * IV digabungkan dengan ciphertext,
                 * kemudian diubah menjadi Base64.
                 */

                $result =
                    base64_encode(
                        $iv . $encrypted
                    );

            }


        // =========================
        // DEKRIPSI
        // =========================

        } elseif ($mode === 'decrypt') {


            /*
             * Decode ciphertext dari Base64.
             */

            $decoded =
                base64_decode(
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
                 * Mengambil IV dari bagian awal data.
                 */

                $iv =
                    substr(
                        $decoded,
                        0,
                        $ivLength
                    );


                /*
                 * Mengambil data ciphertext
                 * setelah bagian IV.
                 */

                $encryptedData =
                    substr(
                        $decoded,
                        $ivLength
                    );


                /*
                 * Proses dekripsi DES-CBC.
                 */

                $result =
                    openssl_decrypt(
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
         INTRO DES
    ========================== -->

    <div class="algorithm-intro">


        <div class="algorithm-icon">
            🛡️
        </div>


        <div>

            <h1>DES (Data Encryption Standard)</h1>


            <p>
                DES merupakan algoritma kriptografi klasik jenis
                symmetric block cipher yang menggunakan satu kunci
                rahasia untuk melakukan proses enkripsi dan dekripsi data.
            </p>


            <div class="formula-box">


                <strong>Informasi:</strong>

                <br>

                <code>
                    Jenis: Symmetric Block Cipher
                </code>

                <br>

                <code>
                    Ukuran Block: 64-bit
                </code>

                <br>

                <code>
                    Key: 56-bit efektif
                </code>

                <br>

                <code>
                    Jumlah Putaran: 16
                </code>


            </div>

        </div>


    </div>


    <!-- =========================
         HEADER
    ========================== -->

    <div class="algorithm-header">


        <h2>
            🛡️ Simulasi DES-CBC
        </h2>


        <p>
            Masukkan plaintext atau ciphertext serta secret key untuk
            melakukan proses enkripsi dan dekripsi menggunakan
            algoritma DES dalam mode CBC.
        </p>


        <div class="alert alert-warning mb-0">


            <strong>Konfigurasi:</strong>

            <br><br>

            🔐 Algoritma: DES-CBC

            <br>

            🔑 Key: 8 byte

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
                    DES dalam format Base64.

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
                    placeholder="Contoh: DESKEY123"
                    required
                >


                <small class="text-muted">

                    Secret Key akan diproses untuk menghasilkan
                    key sepanjang 8 byte yang digunakan oleh DES.

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
                    🔐 Enkripsi DES
                </button>


                <button
                    type="submit"
                    name="mode"
                    value="decrypt"
                    class="btn btn-primary"
                >
                    🔓 Dekripsi DES
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
                        ? '🔐 Hasil Enkripsi DES (Base64)'
                        : '🔓 Hasil Dekripsi DES'
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