<?php
	session_start();
	if(isset($_SESSION['login'])){
		// header("Location: admin.php");
		echo "<script> $('.content').load('modules/admin/admin.php');</script>";
	}
?>
<div class="container">
<div class="content-header">
	<div class="row justify-content-md-center">
		<div class="col-md-4">
			<img src="assets/img/admin.png" width="100" class="mx-auto d-block mb-4 rounded-circle">
			<form id="loginForm">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" class="form-control" id="username" placeholder="Username">
				</div>
				<div class="form-group">
					<label for="Password">Password</label>
					<input type="password" name="password" class="form-control" id="password" placeholder="Passwordr">
				</div>
				<button type="button" id="login" class="btn-block btn btn-primary">Login</button>
			</form>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
$('#login').click(function(){
        // Validasi form input
        // jika username kosong
        if ($('#username').val()==""){
            // focus ke input
            $( "#username" ).focus();
            // tampilkan peringatan data tidak boleh kosong
            swal("Peringatan!", "Username tidak boleh kosong.", "warning");
        }
        // jika password kosong atau 0 (nol)
        else if ($('#password').val()==""){
            // focus ke input
            $( "#password" ).focus();
            // tampilkan peringatan data tidak boleh kosong
            swal("Peringatan!", "Password tidak boleh kosong.", "warning");
        }
        // jika semua data sudah terisi, jalankan perintah simpan data
        else {
            // membuat variabel untuk menampung data dari form entri data
            // var data = $('#loginForm').serialize();

			var Username = $('#username').val();
			var Password = $('#password').val();

            $.ajax({
                type : "POST",                              // mengirim data dengan method POST 
                url  : "modules/admin/check.php",          // proses insert data
                data : {
					login : 1,
					username : Username,
					password : Password
				},                                // data yang dikirim
                success: function(response){
					if(response==="sukses"){

						$('.content').load('modules/admin/admin.php');

					}else{
						swal("Gagal!", "Login tidak berhasil, silahkan cek user dan password anda.", "error");
					}
                },
				dataType: 'text'
            });
        }
});      
</script>