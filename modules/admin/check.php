<?php
    session_start();
    //mengecek AJAX Request
    if(isset($_POST['login'])){

        // panggil file config.php untuk koneksi ke database
        require_once "../../config/config.php";

        //mengambil data yang dikirim
        $username = $mysqli->real_escape_string($_POST['username']); 
        $password = $mysqli->real_escape_string($_POST['password']);

        //melakukan query ke database
        $sql = $mysqli->query("SELECT id FROM admin WHERE username='$username' AND password='$password'");

        //mengecek apakah data yang dikirim ada atau tidak
        if($sql->num_rows > 0){
            $_SESSION['login'] = $username;
            exit('sukses');
        }
        // tutup koneksi
        $mysqli->close();   
    } else {
        // jika tidak ada ajax request, maka alihkan ke halaman index.php
        echo '<script>window.location="../../index.php"</script>';
    }