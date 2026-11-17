<?php

$server = "localhost";
$user = "root";
// Password bisa dioverride lewat environment variable (mis. DB_PASSWORD)
// untuk pengembangan lokal. Default "kopi" tetap dipakai di shared hosting.
$password = getenv("DB_PASSWORD") !== false ? getenv("DB_PASSWORD") : "kopi";
$nama_database = "pendaftaran_siswa";

$db = mysqli_connect($server, $user, $password, $nama_database);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>
