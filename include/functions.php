<?php require_once("koneksi.php"); ?>
<?php require_once("sessions.php"); ?>

<?php
//fungsi ini digunakan untuk mengarahkan pengguna ke lokasi baru dengan mengatur header HTTP yang tepat 
function Redirect_to($New_Location){
    // Mendefinisikan fungsi dengan nama "Redirect_to" yang menerima satu parameter: $New_Location (alamat URL tujuan)
    header("Location:" . $New_Location);
    // Mengirim header HTTP untuk mengarahkan pengguna ke alamat yang ditentukan.
    exit;
    // Menghentikan eksekusi skrip PHP lebih lanjut setelah mengirim header.
}


?>