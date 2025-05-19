<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

</body>
</html>
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

function getHariIndonesia($tanggal) {
  $hariInggris = date('l', strtotime($tanggal)); // Nama hari dalam bahasa Inggris
  $hariIndonesia = [
      'Monday' => 'Senin',
      'Tuesday' => 'Selasa',
      'Wednesday' => 'Rabu',
      'Thursday' => 'Kamis',
      'Friday' => 'Jumat',
      'Saturday' => 'Sabtu',
      'Sunday' => 'Minggu',
  ];
  return $hariIndonesia[$hariInggris];
}

/*$query="SELECT siswa.nama_siswa,absensi.id_absen,absensi.tanggal_absensi,siswa.nisn,tipe_absen1.nama_absen
FROM absensi
JOIN siswa ON absensi.nisn =siswa.nisn
JOIN tipe_absen1 ON absensi.id_absen=tipe_absen1.id_absen
ORDER BY absensi.tanggal_absensi DESC";*/
$query=$conn->query(
  "SELECT absensi.nisn,absensi.id_absen,siswa.nama_siswa,
tipe_absen.nama_absen,absensi.tanggal_absensi
FROM absensi 
JOIN siswa ON absensi.nisn=siswa.nisn
JOIN tipe_absen ON absensi.id_absen=tipe_absen.id_absen
WHERE tanggal_absensi=CURDATE();");



echo "<h2>daftar absen siswa</h2>";
  echo  "<table border='1'>
        <th>nama siswa</th>
        <th>nisn</th>
         <th>keterangan</th>
          <th>hari</th>
           <th>tanggal absen</th>";
 if($query->num_rows > 0 ){
while($row=$query->fetch_assoc()){
          $tanggal=$row['tanggal_absensi'];
          $hari=$tanggal ? getHariIndonesia($tanggal):'-';

            echo" <tr>
            <td>{$row['nama_siswa']}</td>
              <td>{$row['nisn']}</td>
                <td>{$row['nama_absen']}</td>
                <td>".getHariIndonesia($row['tanggal_absensi'])."</td>
                  <td>{$row['tanggal_absensi']}</td>
                    </tr>";
        }

          echo" </table>";
      }
      
      
