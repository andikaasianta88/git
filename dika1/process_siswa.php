<?php
$host = 'cloud.hypercloudhost.com';
$db = 'ppexbjum_smk06';
$user = 'ppexbjum_dika06';
$pass = 'f],J?7TUVT5T';

$conn = new mysqli($host, $user, $pass, $db, 3306);


if($conn->connect_error){
    die("conection failed:".$conn->connect_error);
}

$nisn=$_GET['nisn'];
$sql="SELECT * FROM siswa WHERE nisn='$nisn'";
$result=$conn->query($sql);
$student=$result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>proses absensi</title>
</head>
<body>
    <h2> absensi untuk <?php echo $student['nama_siswa']?></h2>
    <form method="POST" action="submit_absensi.php">
        <input type="hidden" name="nisn" value="<?php echo $student['nisn'];?>">
        <label><input type="radio"name="status" value="1">sakit</label><br>
        <label><input type="radio"name="status" value="2">izin</label><br>
        <label><input type="radio"name="status" value="3">alpa</label><br>
        <button type="submit">submit</button>
</form>
</body>
</html>
<?php $conn->close();?>