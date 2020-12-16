<?php
// Mengecek AJAX Request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) :
    // panggil file config.php untuk koneksi ke database
    require_once "../../config/config.php";

    $get = "SELECT * FROM pengunjung WHERE DATE(timestamps) = CURDATE() ORDER BY timestamps ASC";
    $ambil = $mysqli->query($get);
    $i = 1;
    while ($perorang = $ambil->fetch_assoc()) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= date('j F Y', strtotime($perorang['timestamps'])); ?></td>
            <td><?= $perorang['nama']; ?></td>
            <td><?= $perorang['nim']; ?></td>
            <td><?= $perorang['prodi']; ?></td>
            <td><?= $perorang['semester']; ?></td>
            <td><?= $perorang['tujuan']; ?></td>
        </tr>
<?php $i++;
    endwhile;
else :
    // jika tidak ada ajax request, maka alihkan ke halaman index.php
    echo '<script>window.location="../../"</script>';
endif;
