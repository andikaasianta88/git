<?php
session_start();
    $host = 'cloud.hypercloudhost.com';
    $db = 'ppexbjum_smk06';
    $user = 'ppexbjum_dika06';
    $pass = 'f],J?7TUVT5T';

    $conn = new mysqli($host, $user, $pass, $db, 3306);


    if($conn->connect_error){
    die("connection failed:".$conn->connect_error);
}

// Query untuk mengambil jumlah absensi per siswa berdasarkan status
$query = $conn->query(
    "SELECT
        siswa.nisn,
        siswa.nama_siswa,
        COUNT(CASE WHEN tipe_absen.nama_absen = 'Sakit' THEN 1 END) AS sakit,
        COUNT(CASE WHEN tipe_absen.nama_absen = 'Izin' THEN 1 END) AS izin,
        COUNT(CASE WHEN tipe_absen.nama_absen = 'Alpa' THEN 1 END) AS alpa
    FROM absensi
    JOIN siswa ON absensi.nisn = siswa.nisn
    JOIN tipe_absen ON absensi.id_absen = tipe_absen.id_absen
    WHERE 
         absensi.tanggal_absensi BETWEEN '2025-02-28' AND '2025-07-30'
    GROUP BY siswa.nisn, siswa.nama_siswa
    ORDER BY siswa.nisn;"
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Data Absensi Siswa</h2>

<table border='1'>
    <tr>
        <th>NISN</th>
        <th>Nama Siswa</th>
        <th>Sakit</th>
        <th>Izin</th>
        <th>Alpa</th>
    </tr>

    <?php
    while ($row = $query->fetch_assoc()) {
        echo "<tr>
            <td>{$row['nisn']}</td>
            <td>{$row['nama_siswa']}</td>
            <td>{$row['sakit']}</td>
            <td>{$row['izin']}</td>
            <td>{$row['alpa']}</td>
        </tr>";
    }
    ?>
</table>

</body>
</html>
