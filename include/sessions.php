<?php
// fungsi kode berikut  memudahkan tampilan pesan error dan pesan sukses kepada pengguna di situs web
session_start(); // Memulai atau melanjutkan sesi PHP

function Message(){
    if(isset($_SESSION["ErrorMessage"])){
        $Output="<div class=\"alert alert-danger\">" ; // Membuat div dengan class CSS "alert alert-danger"
        $Output.=htmlentities($_SESSION["ErrorMessage"]); // Menampilkan pesan error setelah di-escape untuk keamanan
        $Output.="</div>"; // Menutup elemen div
        $_SESSION["ErrorMessage"]=null; // Mengosongkan pesan error yang telah ditampilkan
        return $Output; // Mengembalikan pesan error yang telah dibuat
    }
}

function SuccessMessage(){
    if(isset($_SESSION["SuccessMessage"])){
        $Output="<div class=\"alert alert-success\">" ; // Membuat div dengan class CSS "alert alert-success"
        $Output.=htmlentities($_SESSION["SuccessMessage"]); // Menampilkan pesan sukses setelah di-escape untuk keamanan
        $Output.="</div>"; // Menutup elemen div
        $_SESSION["SuccessMessage"]=null; // Mengosongkan pesan sukses yang telah ditampilkan
        return $Output; // Mengembalikan pesan sukses yang telah dibuat
    }
}

?>