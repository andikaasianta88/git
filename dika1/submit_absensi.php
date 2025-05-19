<?php

$host = 'cloud.hypercloudhost.com';
$db = 'ppexbjum_smk06';
$user = 'ppexbjum_dika06';
$pass = 'f],J?7TUVT5T';

$conn = new mysqli($host, $user, $pass, $db, 3306);


if ($conn->connect_error) {
  die("conection failed:" . $conn->connect_error);
}

$nisn = $_POST['nisn'];
$status = $_POST['status'];
$date = date('y-m-d');

$sql = "INSERT INTO absensi (nisn,id_absen,tanggal_absensi)VALUES('$nisn','$status','$date')";

if ($conn->query($sql) === TRUE) {
  header("location:index.php");
} else {
  echo "error:" . $sql . "<br>" . $conn->error;
}
$conn->close();
?>

<!-- Back Button -->
<br>
<a href=" index.php">
  <button style="padding: 10px; background-color:rgb(6, 238, 255); color: black; border: none; border-radius: 5px; cursor: pointer;">
    Home
  </button>
</a>