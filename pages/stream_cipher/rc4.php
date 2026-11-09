<?php

require_once __DIR__ . '/../../algorithms/rc4.php';

$result = '';
$error = '';

$inputText = '';
$key = '';
$mode = '';


// ========================================
// PROSES FORM
// ========================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputText = $_POST['text'] ?? '';
    $key = $_POST['key'] ?? '';
    $mode = $_POST['mode'] ?? '';

    if ($inputText === '') {

        $error = 'Silakan masukkan text terlebih dahulu.';

    } elseif ($key === '') {

        $error = 'Silakan masukkan key terlebih dahulu.';

    } elseif ($mode === 'encrypt') {

        $result = rc4Encrypt($inputText, $key);

        if ($result === false) {

            $error = 'Terjadi kesalahan saat proses enkripsi.';
            $result = '';
        }

    } elseif ($mode === 'decrypt') {

        $result = rc4Decrypt($inputText, $key);

        if ($result === false) {

            $error = 'Ciphertext Base64 tidak valid atau terjadi kesalahan.';
            $result = '';
        }
    }
}

?>



<div class="algorithm-page">


    <!-- HEADER -->

    <div class="algorithm-header">

        <h1>🔶 RC4 Stream Cipher</h1>

        <p>
            RC4 adalah algoritma Stream Cipher yang mengenkripsi data
            menggunakan aliran kunci (keystream) yang dihasilkan dari key.
        </p>


        <div class="alert alert-info mb-0">

            <strong>Proses RC4:</strong>

            <br>

            1. Key Scheduling Algorithm (KSA)

            <br>

            2. Pseudo Random Generation Algorithm (PRGA)

            <br>

            3. XOR antara data dan keystream

        </div>

    </div>



    <!-- INTRO RC4 -->

    <div class="algorithm-intro">

        <div class="algorithm-icon">
            🌊
        </div>


        <div>

            <h1>RC4 Stream Cipher</h1>

            <p>
                RC4 adalah algoritma stream cipher yang menghasilkan
                keystream berdasarkan sebuah key. Keystream tersebut
                digunakan untuk melakukan operasi XOR terhadap data.
            </p>


            <div class="formula-box">

                <strong>Konsep:</strong>

                <br>

                <code>
                    Ciphertext = Plaintext XOR Keystream
                </code>

                <br>

                <code>
                    Plaintext = Ciphertext XOR Keystream
                </code>

            </div>

        </div>

    </div>



    <!-- CARD -->

    <div class="algorithm-card">


        <!-- FORM -->

        <form method="POST">


            <!-- TEXT INPUT -->

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

                    Untuk dekripsi, masukkan ciphertext hasil enkripsi RC4
                    dalam format Base64.

                </small>

            </div>



            <!-- KEY -->

            <div class="mb-4">

                <label class="form-label fw-bold">

                    🔑 Key RC4

                </label>


                <input
                    type="text"
                    name="key"
                    class="form-control"
                    value="<?= htmlspecialchars($key) ?>"
                    placeholder="Contoh: CRYPTOLAB"
                    required
                >

            </div>



            <!-- BUTTON -->

            <div class="d-flex gap-2 flex-wrap">


                <button
                    type="submit"
                    name="mode"
                    value="encrypt"
                    class="btn btn-success"
                >
                    🔐 Enkripsi RC4
                </button>



                <button
                    type="submit"
                    name="mode"
                    value="decrypt"
                    class="btn btn-primary"
                >
                    🔓 Dekripsi RC4
                </button>



                <!-- RESET -->

                <a
                    href="index.php?page=rc4"
                    class="btn btn-secondary"
                >
                    🔄 Reset
                </a>


            </div>


        </form>



        <!-- ERROR -->

        <?php if ($error !== ''): ?>

            <div class="alert alert-danger mt-4">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>



        <!-- RESULT -->

        <?php if ($result !== ''): ?>

            <hr>


            <div class="result-box">


                <h4>

                    <?= $mode === 'encrypt'
                        ? '🔐 Hasil Enkripsi RC4 (Base64)'
                        : '🔓 Hasil Dekripsi RC4'
                    ?>

                </h4>



                <div class="result-text">

                    <?= htmlspecialchars($result) ?>

                </div>



                <!-- COPY RESULT -->

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