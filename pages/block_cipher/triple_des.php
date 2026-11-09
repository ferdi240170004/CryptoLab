<?php

$result = '';
$error = '';

$inputText = '';
$key = '';
$mode = '';


// =========================
// KONFIGURASI TRIPLE DES
// =========================

$cipher = 'DES-EDE3-CBC';


// =========================
// CEK CIPHER OPENSSL
// =========================

$availableCiphers = array_map(
    'strtolower',
    openssl_get_cipher_methods()
);


if (
    !in_array(
        strtolower($cipher),
        $availableCiphers
    )
) {

    $error =
        'Cipher Triple DES (DES-EDE3-CBC) tidak tersedia pada OpenSSL PHP yang digunakan.';

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


    // =========================
    // VALIDASI INPUT
    // =========================

    if ($inputText === '') {

        $error =
            'Silakan masukkan text terlebih dahulu.';


    } elseif ($key === '') {

        $error =
            'Silakan masukkan key terlebih dahulu.';


    } else {


        /*
         * Triple DES menggunakan key sepanjang
         * 24 byte (192-bit).
         *
         * Input Secret Key diproses menggunakan
         * SHA-256, kemudian diambil 24 byte.
         */

        $encryptionKey = substr(
            hash(
                'sha256',
                $key,
                true
            ),
            0,
            24
        );


        // =========================
        // ENKRIPSI
        // =========================

        if ($mode === 'encrypt') {


            /*
             * Mengambil panjang IV sesuai cipher.
             */

            $ivLength =
                openssl_cipher_iv_length($cipher);


            /*
             * Membuat IV secara acak.
             */

            $iv =
                random_bytes($ivLength);


            /*
             * Proses enkripsi Triple DES.
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
                    'Terjadi kesalahan saat proses enkripsi Triple DES.';


            } else {


                /*
                 * IV digabungkan dengan ciphertext,
                 * kemudian diubah ke format Base64.
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
             * Mengubah Base64 kembali menjadi data.
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
                 * Mengambil ciphertext setelah IV.
                 */

                $encryptedData =
                    substr(
                        $decoded,
                        $ivLength
                    );


                /*
                 * Proses dekripsi Triple DES.
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
                        'Gagal mendekripsi. Pastikan Secret Key yang digunakan benar.';

                    $result = '';

                }

            }

        }

    }

}

?>


<div class="algorithm-page">


    <!-- =========================
         INTRO TRIPLE DES
    ========================== -->

    <div class="algorithm-intro">


        <div class="algorithm-icon">
            🔐
        </div>


        <div>

            <h1>Triple DES (3DES)</h1>


            <p>
                Triple DES atau 3DES merupakan pengembangan dari
                Data Encryption Standard (DES) yang melakukan
                proses enkripsi sebanyak tiga tahap untuk meningkatkan
                keamanan dibandingkan DES biasa.
            </p>


            <div class="formula-box">


                <strong>Konsep:</strong>

                <br>

                <code>
                    Encrypt → Decrypt → Encrypt (EDE)
                </code>

                <br>

                <code>
                    Jenis: Symmetric Block Cipher
                </code>

                <br>

                <code>
                    Algoritma: DES-EDE3
                </code>

                <br>

                <code>
                    Key: 24 Byte
                </code>


            </div>

        </div>


    </div>


    <!-- =========================
         HEADER
    ========================== -->

    <div class="algorithm-header">


        <h2>
            🔐 Simulasi Triple DES (3DES)
        </h2>


        <p>
            Masukkan plaintext atau ciphertext serta secret key untuk
            melakukan proses enkripsi dan dekripsi menggunakan
            algoritma Triple DES dalam mode CBC.
        </p>


        <div class="alert alert-warning mb-0">


            <strong>Konfigurasi:</strong>

            <br><br>

            🔐 Algoritma: Triple DES / DES-EDE3-CBC

            <br>

            🔑 Key: 24 Byte

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


            <!-- =========================
                 INPUT TEXT
            ========================== -->

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
                    Triple DES dalam format Base64.

                </small>


            </div>


            <!-- =========================
                 SECRET KEY
            ========================== -->

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

                    Secret Key akan diproses untuk menghasilkan
                    key sepanjang 24 byte yang digunakan oleh Triple DES.

                </small>


            </div>


            <!-- =========================
                 BUTTON
            ========================== -->

            <div class="d-flex gap-2 flex-wrap">


                <button
                    type="submit"
                    name="mode"
                    value="encrypt"
                    class="btn btn-success"
                >
                    🔐 Enkripsi 3DES
                </button>


                <button
                    type="submit"
                    name="mode"
                    value="decrypt"
                    class="btn btn-primary"
                >
                    🔓 Dekripsi 3DES
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
                        ? '🔐 Hasil Enkripsi Triple DES (Base64)'
                        : '🔓 Hasil Dekripsi Triple DES'
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