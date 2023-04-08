<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baum";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type');
$request_body = json_decode(file_get_contents('php://input'));
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori = $request_body->kategori;
    $icerik = $request_body->icerik;
    $email = $request_body->email;
    $donus =  $request_body->donus;
    $sql = "INSERT INTO sikayet(
    bilgilerim_email,
    bilgilerim_icerik,
    bilgilerim_donus,
    bilgilerim_konubasligi,
    bilgilerim_okundu) VALUES ('$email','$icerik','$donus','$kategori',0)";
    if (mysqli_query($conn, $sql)) {
        echo "Şikayet Gönderildi";
    } else {
        echo "Hata: " . $sql . "<br>" . mysqli_error($conn);
    }
      
      
      
}




$conn->close();
?>