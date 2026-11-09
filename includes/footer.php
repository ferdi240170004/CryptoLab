    </div>

    <script>

function copyResult(button) {

    // Cari result box terdekat
    const resultBox = button.closest('.result-box');

    if (!resultBox) {
        alert('Hasil tidak ditemukan!');
        return;
    }

    // Ambil teks hasil
    const resultText = resultBox.querySelector('.result-text');

    if (!resultText) {
        alert('Teks hasil tidak ditemukan!');
        return;
    }

    const text = resultText.innerText;

    navigator.clipboard.writeText(text)
        .then(() => {

            const originalText = button.innerHTML;

            button.innerHTML = '✅ Berhasil Disalin';

            setTimeout(() => {
                button.innerHTML = originalText;
            }, 2000);

        })
        .catch(() => {

            alert('Gagal menyalin hasil.');

        });

}

</script>

</body>
</html>