<?php

require_once __DIR__ . '/../../algorithms/vigenere.php';

$result = '';
$inputText = '';
$key = '';
$mode = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputText = $_POST['text'] ?? '';
    $key = $_POST['key'] ?? '';
    $mode = $_POST['mode'] ?? '';

    if ($inputText !== '' && $key !== '') {

        if ($mode === 'encrypt') {
            $result = vigenereEncrypt($inputText, $key);
        }

        if ($mode === 'decrypt') {
            $result = vigenereDecrypt($inputText, $key);
        }

    }
}

?>

<div class="algorithm-intro">

    <div class="algorithm-icon">🔑</div>

    <div>

        <h1>Vigenère Cipher</h1>

        <p>
            Vigenère Cipher adalah algoritma kriptografi klasik yang
            menggunakan sebuah kata kunci untuk menentukan pergeseran
            setiap huruf pada plaintext.
        </p>

        <div class="formula-box">

            <strong>Rumus:</strong><br>

            Enkripsi:
            <code>Cᵢ = (Pᵢ + Kᵢ) mod 26</code>

            <br>

            Dekripsi:
            <code>Pᵢ = (Cᵢ - Kᵢ) mod 26</code>

        </div>

    </div>

</div>

<div class="algorithm-page">

    <div class="algorithm-header">

        <h1>🟢 Vigenère Cipher</h1>

        <p>
            Vigenère Cipher adalah algoritma kriptografi klasik yang
            menggunakan kata kunci untuk menentukan pergeseran setiap huruf.
        </p>

    </div>


    <div class="algorithm-card">

        <form method="POST">

            <div class="mb-3">

                <label class="form-label">
                    Masukkan Text
                </label>

                <textarea
                    name="text"
                    class="form-control"
                    rows="4"
                    placeholder="Contoh: HALO DUNIA"
                    required
                ><?= htmlspecialchars($inputText) ?></textarea>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Key / Kata Kunci
                </label>

                <input
                    type="text"
                    name="key"
                    class="form-control"
                    value="<?= htmlspecialchars($key) ?>"
                    placeholder="Contoh: KUNCI"
                    required
                >

            </div>


            <div class="d-flex gap-2">

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

        <?php endif; ?>

    </div>

</div>