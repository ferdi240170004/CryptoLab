<?php
?>

<div class="algorithm-page">

    <!-- HEADER ABOUT -->
    <div class="algorithm-header">

        <h1>ℹ️ Tentang CryptoLab</h1>

        <p>
            CryptoLab adalah aplikasi simulasi kriptografi yang dirancang
            untuk membantu pengguna memahami konsep dasar enkripsi dan
            dekripsi melalui berbagai algoritma kriptografi.
        </p>

    </div>


    <!-- INTRO -->
    <div class="algorithm-intro">

        <div class="algorithm-icon">
            🔐
        </div>

        <div>

            <h1>Bimbingan Aplikasi Kriptografi</h1>

            <p>
                CryptoLab menyediakan media pembelajaran interaktif untuk
                mempelajari bagaimana sebuah pesan atau data dapat diamankan
                menggunakan proses enkripsi dan dikembalikan ke bentuk semula
                menggunakan proses dekripsi.
            </p>

            <div class="formula-box">

                <strong>Alur Kriptografi:</strong>

                <br><br>

                <code>
                    Plaintext → Enkripsi → Ciphertext → Dekripsi → Plaintext
                </code>

            </div>

        </div>

    </div>


    <!-- PROJECT INFORMATION -->
    <div class="algorithm-card">

        <h3 class="mb-4">
            📋 Informasi Project
        </h3>

        <div class="row g-4">

            <div class="col-md-6">

                <div class="border rounded p-4 h-100">

                    <h5>📌 Nama Aplikasi</h5>

                    <p class="mb-0">
                        <strong>CryptoLab</strong>
                    </p>

                    <small class="text-muted">
                        Aplikasi Simulasi Kriptografi
                    </small>

                </div>

            </div>


            <div class="col-md-6">

                <div class="border rounded p-4 h-100">

                    <h5>🎯 Tujuan Project</h5>

                    <p class="mb-0">
                        Membantu pengguna memahami proses enkripsi dan
                        dekripsi menggunakan berbagai algoritma kriptografi.
                    </p>

                </div>

            </div>


            <div class="col-md-6">

                <div class="border rounded p-4 h-100">

                    <h5>💻 Teknologi</h5>

                    <p class="mb-0">
                        PHP, HTML, CSS, JavaScript, dan Bootstrap.
                    </p>

                </div>

            </div>


            <div class="col-md-6">

                <div class="border rounded p-4 h-100">

                    <h5>🔐 Fokus Pembelajaran</h5>

                    <p class="mb-0">
                        Memahami konsep dasar algoritma kriptografi klasik,
                        modern, stream cipher, dan block cipher.
                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- ALGORITHM LIST -->
    <div class="algorithm-card">

        <h3 class="mb-4">
            🔢 Algoritma yang Tersedia
        </h3>

        <div class="row g-3">

            <div class="col-md-4">
                <div class="border rounded p-3 h-100">
                    🔐 <strong>Caesar Cipher</strong>
                    <br>
                    <small class="text-muted">
                        Enkripsi dengan metode pergeseran karakter.
                    </small>
                </div>
            </div>


            <div class="col-md-4">
                <div class="border rounded p-3 h-100">
                    🔑 <strong>Vigenère Cipher</strong>
                    <br>
                    <small class="text-muted">
                        Enkripsi menggunakan key berupa karakter.
                    </small>
                </div>
            </div>


            <div class="col-md-4">
                <div class="border rounded p-3 h-100">
                    🔢 <strong>Hill Cipher</strong>
                    <br>
                    <small class="text-muted">
                        Enkripsi menggunakan operasi matriks modulo.
                    </small>
                </div>
            </div>


            <div class="col-md-4">
                🔄 <strong>Substitution Cipher</strong>
                <br>
                <small class="text-muted">
                    Mengganti karakter berdasarkan key substitusi.
                </small>
            </div>


            <div class="col-md-4">
                🔀 <strong>Transposition Cipher</strong>
                <br>
                <small class="text-muted">
                    Mengubah posisi karakter tanpa mengubah nilainya.
                </small>
            </div>


            <div class="col-md-4">
                ⚡ <strong>Hybrid Cipher</strong>
                <br>
                <small class="text-muted">
                    Kombinasi Caesar Cipher dan Vigenère Cipher.
                </small>
            </div>


            <div class="col-md-4">
                🌊 <strong>RC4</strong>
                <br>
                <small class="text-muted">
                    Algoritma Stream Cipher menggunakan keystream.
                </small>
            </div>


            <div class="col-md-4">
                🔷 <strong>AES</strong>
                <br>
                <small class="text-muted">
                    Algoritma Block Cipher modern untuk keamanan data.
                </small>
            </div>


            <div class="col-md-4">
                🛡️ <strong>DES</strong>
                <br>
                <small class="text-muted">
                    Algoritma Block Cipher dengan struktur enkripsi simetris.
                </small>
            </div>


            <div class="col-md-12">
                <div class="border rounded p-3">

                    🔐 <strong>Triple DES (3DES)</strong>

                    <br>

                    <small class="text-muted">
                        Pengembangan DES yang melakukan proses enkripsi
                        sebanyak tiga kali.
                    </small>

                </div>
            </div>

        </div>

    </div>


    <!-- FOOTER INFORMATION -->
    <div class="algorithm-card text-center">

        <h3>🎓 Project Pembelajaran Kriptografi</h3>

        <p class="mb-2">

            CryptoLab dibuat sebagai media pembelajaran untuk memahami
            konsep dasar keamanan informasi dan algoritma kriptografi.

        </p>

        <p class="text-muted mb-0">

            © <?= date('Y') ?> CryptoLab — Aplikasi Simulasi Kriptografi

        </p>

    </div>

</div>