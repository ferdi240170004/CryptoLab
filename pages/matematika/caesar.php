<?php

require_once __DIR__ . '/../../algorithms/caesar.php';

$result = '';
$inputText = '';
$shift = 3;
$mode = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputText = $_POST['text'] ?? '';
    $shift = (int) ($_POST['shift'] ?? 3);
    $mode = $_POST['mode'] ?? '';

    if ($mode === 'encrypt') {
        $result = caesarEncrypt($inputText, $shift);
    }

    if ($mode === 'decrypt') {
        $result = caesarDecrypt($inputText, $shift);
    }
}
?>

<div class="algorithm-intro">

    <div class="algorithm-icon">
        🔐
    </div>

    <div>

        <h1>Caesar Cipher</h1>

        <p>
            Caesar Cipher adalah algoritma kriptografi klasik yang
            bekerja dengan cara menggeser setiap huruf pada plaintext
            berdasarkan jumlah pergeseran tertentu (shift/key).
        </p>

        <div class="formula-box">

            <strong>Rumus:</strong>

            <br>

            Enkripsi:
            <code>E(x) = (x + k) mod 26</code>

            <br>

            Dekripsi:
            <code>D(x) = (x - k) mod 26</code>

        </div>

    </div>

</div>

<div class="algorithm-page">

    <div class="algorithm-header">

        <div>
            <h1>🟢 Caesar Cipher</h1>

            <p>
                Caesar Cipher adalah metode kriptografi klasik dengan
                cara menggeser setiap huruf berdasarkan nilai kunci tertentu.
            </p>
        </div>

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
                    Key / Pergeseran
                </label>

                <input
                    type="number"
                    name="shift"
                    class="form-control"
                    value="<?= htmlspecialchars($shift) ?>"
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

  <a href="index.php?page=caesar" class="btn btn-secondary">
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

    </div>

<?php endif; ?>