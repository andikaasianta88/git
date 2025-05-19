<?php
$host = 'cloud.hypercloudhost.com';
$db = 'ppexbjum_smk06';
$user = 'ppexbjum_dika06';
$pass = 'f],J?7TUVT5T';

$conn = new mysqli($host, $user, $pass, $db, 3306);

if($conn->connect_error){
    die("connection failed:".$conn->connect_error);
}

$sql ="SELECT * FROM siswa";


$search = isset($_GET['search']) ? $_GET['search']:'';
$sql="SELECT * FROM siswa  WHERE nama_siswa LIKE '%$search%'";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>daftar siswa</h2>
<div class="atas">
<form method="GET" action="index.php">
    <input type="text" name="search" placeholder="cari nama siswa">
    <button type="submit">cari</button>
</form>
<a href="rekap_absen.php"><button>absensi</button></a>
<a href="rekap_rapot.php"><button>rekap rapot</button></a>
<a href="jurnal.php"><button>jurnal</button></a>
</div>


<table border="1">
    <thead>
        <tr>
        <th>NISN</th>
        <th>nama</th>
        <th>Jurusan</th>
        <th>aksi</th>
        </tr>
    </thead>

<tbody>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>{$row['nisn']}</td>
            <td>{$row['nama_siswa']}</td>
            <td>{$row['jurusan']}</td>
            <td><button onclick=\"processSiswa('{$row['nisn']}')\">Proses</button></td>
            </tr>";
        }
    }else{
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
    ?>
</tbody>
</table>

<script>
function processSiswa(nisn) {
    window.location.href = 'process_siswa.php?nisn=' + nisn;
}
</script>
</body>
</html>

<?php $conn->close(); ?>