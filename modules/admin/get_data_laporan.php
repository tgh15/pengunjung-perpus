<?php
// Mengecek AJAX Request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    // panggil file config.php untuk koneksi ke database
    require_once "../../config/config.php";
    // mengecek data get dari ajax
    if (isset($_GET['awal'])) {
        // variabel untuk nomor urut tabel
        $no = 1;
        // sql statement untuk menampilkan data dari tabel penjualan berdasarkan tanggal
        $query = "SELECT *
                  FROM pengunjung
                  WHERE timestamps BETWEEN ? AND ?";
        // membuat prepared statements
        $stmt = $mysqli->prepare($query);
        //cek query
        if (!$stmt) {
            die('Query Error: ' . $mysqli->errno . '-' . $mysqli->error);
        }

        // ambil data get dari ajax
        $tgl_awal  = date('Y-m-d', strtotime($_GET['awal']));
        $tgl_akhir = date('Y-m-d', strtotime($_GET['akhir']));
        // hubungkan "data" dengan prepared statements
        $stmt->bind_param("ss", $tgl_awal, $tgl_akhir);
        // jalankan query: execute
        $stmt->execute();
        // ambil hasil query
        $result = $stmt->get_result();
        // tampilkan hasil query
        while ($data = $result->fetch_assoc()) {
            echo "<tr>
                    <td >" . $no . "</td>
                    <td>" . date('j F Y', strtotime($data['timestamps'])) . "</td>
                    <td >" . $data['nama'] . "</td>
                    <td >" . $data['nim'] . "</td>
                    <td class='center' >" . $data['prodi'] . "</td>
                    <td class='center' >" . $data['semester'] . "</td>
                    <td  class='center'>" . $data['tujuan'] . "</td>
                </tr>";
            $no++;
        };

        // tutup statement
        $stmt->close();
    }
    // tutup koneksi
    $mysqli->close();
} else {
    // jika tidak ada ajax request, maka alihkan ke halaman index.php
    echo '<script>window.location="../../"</script>';
}
