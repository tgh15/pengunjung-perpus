<?php


require_once __DIR__ . '/vendor/autoload.php';

require_once "config/config.php";

$get = "SELECT * FROM pengunjung WHERE DATE(timestamps) = CURDATE() ORDER BY timestamps ASC";
$ambil = $mysqli->query($get);
$i = 1;

$data = '
<head>
<style>
body{
    font-family: sans-serif;
}
tr:nth-child(even){
    background-color: #dee2e6;
}
</style>
</head>
<body>
<h2 style="text-align: center;">Daftar Pengunjung Perpustakaan</h2>
<h4 style="text-align: center;">Politeknik Negeri Media Kreatif PSDKU Makassar</h4>
<h5 style="text-align: center;">Periode bulan ' . date('F') . '</h5>
<hr>
<br>
            <table autosize="2.4" border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse;
            font-size: 12px;
            font-weight: 700;
            margin-top: 5px; 
            border-top: 1px solid #777;
            width: 100%;">
                    <tr>
                        <th>No.</th>
                        <th>Waktu</th>
                        <th>Nama</th>
                        <th>Nim</th>
                        <th>Prodi</th>
                        <th>Semester</th>
                        <th>Tujuan</th>
                    </tr>';

while ($perorang = $ambil->fetch_assoc()) {
    $data .= '<tr>
                        <td>' . $i++ . '</td>
                        <td>' . date('j F Y', strtotime($perorang['timestamps'])) . '</td>
                        <td>' . $perorang['nama'] . '</td>
                        <td>' . $perorang['nim'] . '</td>
                        <td>' . $perorang['prodi'] . '</td>
                        <td>' . $perorang['semester'] . '</td>
                        <td>' . $perorang['tujuan'] . '</td>
                    </tr>';
}

$data .= '
            </table>
        </body>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output('laporan-pengunjung-' . date('j-F-Y') . '.pdf', 'D');
