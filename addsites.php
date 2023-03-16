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

	$url = input($_POST['url']);
	$title = input($_POST['title']);
	$description = input($_POST['description']);
	$keywords = input($_POST['keywords']);
	$clicks = input($_POST['clicks']);
 
	// menginput data ke database
	$sql="insert into sites (url,title,description,keywords,clicks) values ('$url','$title','$description','$keywords','$clicks')";
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