<?php

$user = "htsthvir";

$source = "/home/$user/repositories/ci4-siakad-pkbm/writable/uploads";
$target = "/home/$user/repositories/ci4-siakad-pkbm/public/uploads";

// CEK dulu
if (is_link($target) || file_exists($target)) {
    die("Skip: uploads sudah ada");
}

// BUAT SYMLINK
if (symlink($source, $target)) {
    echo "Symlink uploads BERHASIL";
} else {
    echo "Symlink uploads GAGAL (kemungkinan diblok hosting)";
}


echo "<br>";

$source = '/home/' . $user . '/repositories/ci4-siakad-pkbm/public';
$target   = '/home/' . $user . '/public_html';

$items = scandir($source);

foreach ($items as $item) {
    if ($item === '.' || $item === '..') {
        continue;
    }

    $from = $source . '/' . $item;
    $to   = $target . '/' . $item;

    // Skip kalau sudah ada
    if (file_exists($to)) {
        echo "Skip: $item sudah ada<br>";
        continue;
    }

    if (symlink($from, $to)) {
        echo "OK: $item<br>";
    } else {
        echo "GAGAL: $item<br>";
    }
}
