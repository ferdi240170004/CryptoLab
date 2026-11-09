<?php

$currentPage = $_GET['page'] ?? 'home';

?>

<div class="sidebar">

    <!-- BRAND -->

    <div class="sidebar-brand">

        <div class="brand-icon">
            🔐
        </div>

        <div>
            <h2>CryptoLab</h2>
            <small>Cryptography Learning</small>
        </div>

    </div>


    <!-- MENU -->

    <div class="menu">


        <!-- DASHBOARD -->

        <a
            href="index.php?page=home"
            class="<?= $currentPage === 'home' ? 'active' : '' ?>"
        >
            🏠 Dashboard
        </a>


        <!-- DASAR MATEMATIKA -->

        <div class="menu-title">
            DASAR MATEMATIKA
        </div>


        <a
            href="index.php?page=caesar"
            class="<?= $currentPage === 'caesar' ? 'active' : '' ?>"
        >
            🔐 Caesar Cipher
        </a>


        <a
            href="index.php?page=vigenere"
            class="<?= $currentPage === 'vigenere' ? 'active' : '' ?>"
        >
            🔑 Vigenère Cipher
        </a>


        <a
            href="index.php?page=hill"
            class="<?= $currentPage === 'hill' ? 'active' : '' ?>"
        >
            🔢 Hill Cipher
        </a>


        <!-- FUNGSI UTAMA -->

        <div class="menu-title">
            FUNGSI UTAMA
        </div>


        <a
            href="index.php?page=substitution"
            class="<?= $currentPage === 'substitution' ? 'active' : '' ?>"
        >
            🔄 Substitution Cipher
        </a>


        <a
            href="index.php?page=transposition"
            class="<?= $currentPage === 'transposition' ? 'active' : '' ?>"
        >
            🔀 Transposition Cipher
        </a>


        <a
            href="index.php?page=hybrid"
            class="<?= $currentPage === 'hybrid' ? 'active' : '' ?>"
        >
            ⚡ Hybrid Cipher
        </a>


        <!-- STREAM CIPHER -->

        <div class="menu-title">
            STREAM CIPHER
        </div>


        <a
            href="index.php?page=rc4"
            class="<?= $currentPage === 'rc4' ? 'active' : '' ?>"
        >
            🌊 RC4
        </a>


        <!-- BLOCK CIPHER -->

        <div class="menu-title">
            BLOCK CIPHER
        </div>


        <a
            href="index.php?page=aes"
            class="<?= $currentPage === 'aes' ? 'active' : '' ?>"
        >
            🔷 AES
        </a>


        <a
            href="index.php?page=des"
            class="<?= $currentPage === 'des' ? 'active' : '' ?>"
        >
            🛡️ DES
        </a>


        <a
            href="index.php?page=triple_des"
            class="<?= $currentPage === 'triple_des' ? 'active' : '' ?>"
        >
            🔐 Triple DES
        </a>


        <!-- INFORMASI -->

        <div class="menu-title">
            INFORMASI
        </div>


        <a
            href="index.php?page=about"
            class="<?= $currentPage === 'about' ? 'active' : '' ?>"
        >
            ℹ️ About CryptoLab
        </a>


    </div>

</div>