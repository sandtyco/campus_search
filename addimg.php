<?php 
// koneksi database
$koneksi = mysqli_connect("localhost","educolla_dev","forbidenz.1","educolla_dev");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
//Fungsi mencegah tidak sesuai karakter input
function input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}
 
// menangkap data yang di kirim dari form
if ($_SERVER["REQUEST_METHOD"]== "POST") {

	$siteUrl = input($_POST['siteUrl']);
	$imageUrl = input($_POST['imageUrl']);
	$alt = input($_POST['alt']);
	$title = input($_POST['title']);
	$clicks = input($_POST['clicks']);
	$broken = input($_POST['broken']);
 
	// menginput data ke database
	$sql="insert into images (siteUrl,imageUrl,alt,title,clicks,broken) values ('$siteUrl','$imageUrl','$alt','$title','$clicks','$broken')";
	$hasil=mysqli_query($koneksi,$sql);
 
// mengalihkan halaman kembali ke index.php
if ($hasil) {
	header("location:index.php");
	}
	else {
		echo "<div class='alert alert-danger'>Data gagal disimpan!</div>";
		}
	}
?>