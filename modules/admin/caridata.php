<?php
// Mengecek AJAX Request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) : ?>


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cari Data</h1>
    </div>

    <form id="formCari" action="cetak.php" method="get">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <div class="form-group">
                    <input type="text" name="awal" id="awal" class="form-control date-picker" placeholder="Tanggal Awal" data-date-format="dd-mm-yyyy" autocomplete="off" required>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <input type="text" name="akhir" id="akhir" class="form-control date-picker" placeholder="Tanggal Akhir" data-date-format="dd-mm-yyyy" autocomplete="off" required>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <button type="button" name="cari" id="tampil" class="btn btn-primary form-control">Cari</button>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <input type="submit" value="cetak" name="cetak" id="cetak" class="btn btn-success form-control">
                </div>
            </div>
        </div>
    </form>
    <div class="table-responsive pt-5">
        <table id="pengunjung" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Waktu</th>
                    <th>Nama</th>
                    <th>Nim</th>
                    <th>Prodi</th>
                    <th>Semester</th>
                    <th>Tujuan</th>
                </tr>
            </thead>
            <tbody id="tableData">

            </tbody>
        </table>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true
            });

            $('#cetak').hide();
            $('#pengunjung').hide();

            $('#tampil').click(function() {
                if ($('#awal').val() == "") {
                    // focus ke input tanggal awal
                    $("#awal").focus();
                    // tampilkan peringatan data tidak boleh kosong
                    swal("Peringatan!", "Tanggal awal tidak boleh kosong.", "warning");
                }
                // jika tanggal akhir kosong
                else if ($('#akhir').val() == "") {
                    // focus ke input tanggal akhir
                    $("#akhir").focus();
                    // tampilkan peringatan data tidak boleh kosong
                    swal("Peringatan!", "Tanggal akhir tidak boleh kosong.", "warning");
                    // jika semua tanggal sudah diisi, jalankan perintah untuk menampilkan data
                }
            });

            $('#tampil').click(function() {
                // Validasi form input
                // jika tanggal awal kosong
                if ($('#awal').val() == "") {
                    // focus ke input tanggal awal
                    $("#awal").focus();
                    // tampilkan peringatan data tidak boleh kosong
                    swal("Peringatan!", "Tanggal awal tidak boleh kosong.", "warning");
                }
                // jika tanggal akhir kosong
                else if ($('#akhir').val() == "") {
                    // focus ke input tanggal akhir
                    $("#akhir").focus();
                    // tampilkan peringatan data tidak boleh kosong
                    swal("Peringatan!", "Tanggal akhir tidak boleh kosong.", "warning");
                    // jika semua tanggal sudah diisi, jalankan perintah untuk menampilkan data
                } else {
                    // membuat variabel untuk menampung data dari form filter
                    var data = $('#formCari').serialize();

                    $.ajax({
                        type: "GET", // mengirim data dengan method GET 
                        url: "modules/admin/get_data_laporan.php", // proses get data penjualan berdasarkan tanggal
                        data: data, // data yang dikirim
                        success: function(data) { // ketika sukses get data
                            // menampilkan tabel laporan
                            $('#pengunjung').show();
                            // menampilkan data penjualan
                            $('#tableData').html(data);
                            // menampilkan tombol export
                            $('#cetak').show();

                            swal("Sukses!", "Data berhasil ditemukan.", "success");
                        }
                    });
                }
            });
        });
    </script>

<?php else :
    echo '<script>window.location="../../"</script>';
endif;
