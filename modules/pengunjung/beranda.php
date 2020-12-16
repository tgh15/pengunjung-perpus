<div class="container">
    <div class="content-header">
        <!-- <div class="col-md-12"> -->
        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle title-icon"></i> Silahkan isi daftar pengunjung dahulu.
        </div>
        <!-- </div> -->
    </div>
    <div class="row">
        <div class="col-md-4">
            <img src="assets/img/perpus.jpg" class='img-fluid' width="90%">
        </div>
        <div class="col-md-8">
            <form id='form'>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input name="nim" type="text" class="form-control" onKeyPress="return goodchars(event,'0123456789.',this)" id="nim" placeholder="NIM">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="prodi">Prodi</label>
                        <select name="prodi" class="form-control" id="prodi">
                            <option value="0">Prodi..</option>
                            <option value="Multimedia">Multimedia</option>
                            <option value="Desain Grafis">Desain Grafis</option>
                            <option value="Periklanan">Periklanan</option>
                            <option value="Teknik Grafika">Teknik Grafika</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="semester">Semester</label>
                        <select name="semester" class="form-control" id="semester">
                            <option value="0">Semester..</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="alumnus">Alumnus</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tujuan">Tujuan</label>
                    <input name="tujuan" type="text" class="form-control" id="tujuan" placeholder="Tujuan">
                </div>
                <button type="button" id="simpan" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#simpan').click(function() {
        // Validasi form input
        // jika nama kosong
        if ($('#nama').val() == "") {
            // focus ke input provider pulsa
            $("#nama").focus();
            // tampilkan peringatan data tidak boleh kosong
            swal("Peringatan!", "Nama tidak boleh kosong.", "warning");
        }
        // jika nim kosong atau 0 (nol)
        else if ($('#nim').val() == "" || $('#nim').val() == 0) {
            // focus ke input nominal
            $("#nim").focus();
            // tampilkan peringatan data tidak boleh kosong
            swal("Peringatan!", "NIM tidak boleh kosong.", "warning");
        }
        // jika prodi kosong
        else if ($('#prodi').val() == "" || $('#prodi').val() == 0) {
            // focus ke input harga
            $("#prodi").focus();
            // tampilkan peringatan data tidak boleh kosong
            swal("Peringatan!", "Prodi tidak boleh kosong.", "warning");
        }
        // jika semester kosong atau 0 (nol)
        else if ($('#semester').val() == "" || $('#semester').val() == 0) {
            // focus ke input nominal
            $("#semester").focus();
            // tampilkan peringatan data tidak boleh kosong
            swal("Peringatan!", "Semester tidak boleh kosong.", "warning");
        }
        // jika tujuan kosong
        else if ($('#tujuan').val() == "") {
            // focus ke input harga
            $("#tujuan").focus();
            // tampilkan peringatan data tidak boleh kosong
            swal("Peringatan!", "Tujuan harus diisi.", "warning");
        }
        // jika semua data sudah terisi, jalankan perintah simpan data
        else {
            // membuat variabel untuk menampung data dari form entri data
            var data = $('#form').serialize();

            $.ajax({
                type: "POST", // mengirim data dengan method POST 
                url: "modules/pengunjung/add.php", // proses insert data
                data: data, // data yang dikirim
                success: function(result) { // ketika sukses menyimpan data
                    if (result === "sukses") {
                        // reset form
                        $('#form')[0].reset();
                        // tampilkan pesan sukses simpan data
                        swal("Sukses!", "Terima Kasih Telah Mengisi Daftar Pengunjung.", "success");
                    } else {
                        // tampilkan pesan gagal simpan data
                        swal("Gagal!", "Data tidak berhasil disimpan.", "error");
                    }
                }
            });
            return false;
        }
    });
</script>