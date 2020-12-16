<?php
// Mengecek AJAX Request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) : ?>


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="row pb-5">
        <div class="col-md-3 col-sm-3">
            <div class="alert alert-danger">
                <h5 class="text-center"> <strong>Pengunjung hari ini</strong> </h5>
                <h2 class="text-center" id="getPengunjung"></h2>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="alert alert-info">
                <h5 class="text-center"> <strong>Pengunjung kemarin</strong> </h5>
                <h2 class="text-center" id="getPengunjungKemarin"></h2>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="alert alert-warning">
                <h5 class="text-center"><strong>Pengunjung pekan ini</strong></h5>
                <h2 class="text-center" id="getPengunjungWeek"></h2>
            </div>
        </div>
    </div>

    <button onclick="cetak();" name="cetak_hari_ini" class="btn btn-success float-right"> <i class="fas fa-print"></i> cetak</button>
    <h2 class="pb-3">Daftar pengunjung hari ini</h2>
    <div class="table-responsive">
        <table id="pengunjungHariIni" class="table table-striped table-bordered" style="width:100%">
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
            <tbody id="table">

            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            // load file untuk menampilkan jumlah data pada masing-masing id
            $('#table').load('modules/admin/data.php');
            $('#getPengunjung').load('modules/admin/getPengunjung.php');
            $('#getPengunjungKemarin').load('modules/admin/getPengunjungKemarin.php');
            $('#getPengunjungWeek').load('modules/admin/getPengunjungWeek.php');
        });

        function cetak() {
            document.location = "cetak.php?cetak=harini";
        }
    </script>

<?php else :
    echo '<script>window.location="../../"</script>';
endif;
