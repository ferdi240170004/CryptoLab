<?php

// ========================================
// TAMPILKAN ERROR PHP
// ========================================
error_reporting(E_ALL);
ini_set('display_errors', 1);


// ========================================
// AMBIL HALAMAN DARI URL
// ========================================
$page = $_GET['page'] ?? 'home';


// ========================================
// DAFTAR HALAMAN
// ========================================
$allowedPages = [

    'dashboard',
    'home',

    // DASAR MATEMATIKA
    'caesar',
    'vigenere',
    'hill',

    // FUNGSI UTAMA
    'substitution',
    'transposition',
    'hybrid',

    // STREAM CIPHER
    'rc4',

    // BLOCK CIPHER
    'aes',
    'des',
    'triple_des',

    // INFORMASI
    'about'
];


// ========================================
// VALIDASI HALAMAN
// ========================================
if (!in_array($page, $allowedPages)) {
    $page = 'home';
}


// ========================================
// HEADER
// ========================================
include __DIR__ . '/includes/header.php';


// ========================================
// SIDEBAR
// ========================================
include __DIR__ . '/includes/sidebar.php';

?>

<!-- =====================================
     KONTEN UTAMA
===================================== -->

<div style="
    margin-left: 250px;
    padding: 50px;
    min-height: 100vh;
    background: white;
    color: black;
    display: block;
    position: relative;
    z-index: 10;
">

<?php

// ========================================
// ROUTING HALAMAN
// ========================================

switch ($page) {


    // ========================================
    // DASHBOARD
    // ========================================
    case 'dashboard':

        include __DIR__ . '/pages/dashboard.php';

        break;


    // ========================================
    // HOME
    // ========================================
    case 'home':

        include __DIR__ . '/pages/home.php';

        break;


    // ========================================
    // DASAR MATEMATIKA
    // ========================================

    case 'caesar':

        include __DIR__ . '/pages/matematika/caesar.php';

        break;


    case 'vigenere':

        include __DIR__ . '/pages/matematika/vigenere.php';

        break;


    case 'hill':

        include __DIR__ . '/pages/matematika/hill.php';

        break;


    // ========================================
    // FUNGSI UTAMA
    // ========================================

    case 'substitution':

        include __DIR__ . '/pages/fungsi_utama/substitution.php';

        break;


    case 'transposition':

        include __DIR__ . '/pages/fungsi_utama/transposition.php';

        break;


    case 'hybrid':

        include __DIR__ . '/pages/fungsi_utama/hybrid.php';

        break;


    // ========================================
    // STREAM CIPHER
    // ========================================

    case 'rc4':

        include __DIR__ . '/pages/stream_cipher/rc4.php';

        break;


    // ========================================
    // BLOCK CIPHER
    // ========================================

    case 'aes':

        include __DIR__ . '/pages/block_cipher/aes.php';

        break;


    case 'des':

        include __DIR__ . '/pages/block_cipher/des.php';

        break;


    case 'triple_des':

        include __DIR__ . '/pages/block_cipher/triple_des.php';

        break;


    // ========================================
    // ABOUT
    // ========================================

    case 'about':

        include __DIR__ . '/pages/about.php';

        break;


    // ========================================
    // DEFAULT
    // ========================================
    default:

        include __DIR__ . '/pages/home.php';

        break;
}

?>

</div>


<?php

// ========================================
// FOOTER
// ========================================
include __DIR__ . '/includes/footer.php';

?>