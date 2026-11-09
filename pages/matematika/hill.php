<?php

require_once __DIR__ . '/../../algorithms/hill.php';

$result = '';
$error = '';

$inputText = '';
$a = 3;
$b = 3;
$c = 2;
$d = 5;

$mode = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputText = $_POST['text'] ?? '';

    $a = (int)($_POST['a'] ?? 3);
    $b = (int)($_POST['b'] ?? 3);
    $c = (int)($_POST['c'] ?? 2);
    $d = (int)($_POST['d'] ?? 5);

    $mode = $_POST['mode'] ?? '';

    if ($inputText === '') {

        $error = 'Silakan masukkan text terlebih dahulu.';

    } elseif (!hillIsValidKey($a, $b, $c, $d)) {

        $error = 'Key matriks tidak valid. Determinan harus memiliki invers modulo 26.';

    } else {

        if ($mode === 'encrypt') {

            $result = hillEncrypt(
                $inputText,
                $a,
                $b,
                $c,
                $d
            );

        } elseif ($mode === 'decrypt') {

            $result = hillDecrypt(
                $inputText,
                $a,
                $b,
                $c,
                $d
            );

            if ($result === false) {

                $error = 'Ciphertext tidak valid untuk proses dekripsi.';
                $result = '';

            }
        }
    }
}

?>

<div class="algorithm-page">

    <!-- INTRO HILL CIPHER -->

    <div class="algorithm-intro">

        <div class="algorithm-icon">
            🔢
        </div>

        <div>

            <h1>Hill Cipher</h1>

            <p>
                Hill Cipher merupakan algoritma kriptografi klasik yang
                menggunakan operasi matriks dan aritmatika modulo untuk
                melakukan proses enkripsi dan dekripsi.
            </p>

            <div class="formula-box">

                <strong>Rumus:</strong>

                <br>

                Enkripsi:
                <code>C = K × P mod 26</code>

                <br>

                Dekripsi:
                <code>P = K⁻¹ × C mod 26</code>

            </div>

        </div>

    </div>


    <!-- HEADER -->

    <div class="algorithm-header">

        <h2>🔢 Simulasi Hill Cipher</h2>

        <p>
            Masukkan plaintext atau ciphertext, kemudian gunakan key matriks
            untuk melakukan proses enkripsi atau dekripsi.
        </p>

        <div class="alert alert-info mb-0">

            <strong>Contoh Key Matriks yang Valid:</strong>

            <br><br>

            <strong>
                [ 3 &nbsp; 3 ]
                &nbsp;&nbsp;
                [ 2 &nbsp; 5 ]
            </strong>

        </div>

    </div>


    <!-- FORM -->

    <div class="algorithm-card">

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
                    placeholder="Contoh: HALO"
                    required
                ><?= htmlspecialchars($inputText) ?></textarea>

                <small class="text-muted">

                    Hanya huruf A-Z yang digunakan. Spasi dan karakter khusus
                    akan dihapus oleh proses Hill Cipher.

                </small>

            </div>


            <!-- KEY MATRIX -->

            <label class="form-label fw-bold">

                🔢 Key Matriks 2 × 2

            </label>

            <div class="row mb-4">

                <div class="col-6 col-md-3 mb-2">

                    <input
                        type="number"
                        name="a"
                        class="form-control"
                        value="<?= htmlspecialchars($a) ?>"
                        required
                    >

                </div>


                <div class="col-6 col-md-3 mb-2">

                    <input
                        type="number"
                        name="b"
                        class="form-control"
                        value="<?= htmlspecialchars($b) ?>"
                        required
                    >

                </div>


                <div class="col-6 col-md-3 mb-2">

                    <input
                        type="number"
                        name="c"
                        class="form-control"
                        value="<?= htmlspecialchars($c) ?>"
                        required
                    >

                </div>


                <div class="col-6 col-md-3 mb-2">

                    <input
                        type="number"
                        name="d"
                        class="form-control"
                        value="<?= htmlspecialchars($d) ?>"
                        required
                    >

                </div>

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