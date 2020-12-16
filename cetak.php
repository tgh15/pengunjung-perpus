<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once "config/config.php";


if (isset($_GET['awal'])) {
    $no = 1;
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
    <h5 style="text-align: center;">Periode tanggal ' . $tgl_awal . ' - ' . $tgl_akhir . '</h5>
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

    while ($perorang = $result->fetch_assoc()) {
        $data .= '<tr>
                    <td >' . $no++ . '</td>
                    <td >' . date('j F Y', strtotime($perorang['timestamps'])) . '</td>
                    <td>' . $perorang['nama'] . '</td>
                    <td>' . $perorang['nim'] . '</td>
                    <td >' . $perorang['prodi'] . '</td>
                    <td >' . $perorang['semester'] . '</td>
                    <td >' . $perorang['tujuan'] . '</td>
                </tr>';
    }

    $data .= '
                </table>
            </body>';


    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($data);
    $mpdf->Output('laporan-pengunjung-periode-' . date('j F Y', strtotime($_GET['awal'])) . ' sampai ' . date('j F Y', strtotime($_GET['akhir'])) . '.pdf', 'D');
}

if (isset($_GET['cetak'])) {
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
}
