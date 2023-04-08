<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=baum;charset=utf8", 'root', '');
} catch (PDOException $e) {
    echo $e->getMessage();
}

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


use PHPMailer\PHPMailer\PHPMailer;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $request_body = json_decode(file_get_contents('php://input'));
    $email = $request_body->email;
    $konu = $request_body->emailKonu;
    $icerik =$request_body->emailIcerik;
    print_r($request_body);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = `${process.env.EMAIL}`;
    $mail->Password = `${process.env.PASSWORD}`;
    $mail->SMTPSecure = 'tls';
    $mail->Port = '587'; 
    $mail->setLanguage('tr', 'language/');
    $mail->CharSet = "UTF-8";

    $mail->setFrom(`${process.env.EMAIL}`,'Baum'); //gönderen mail adresi
    $mail->addAddress($email); //Gönderilmek istenen Mail adresi

    $mail->isHTML(true);
    $mail->Subject = $konu; // Konu Başlığı
    $mail->Body = $icerik; // Mesaj İçeriği olacacak

    $control = $mail->Send();
    
    echo "Başarılı";

    if ($control) {
        $bilgilerim_id = $_GET['id'];

        $kaydet = $db->prepare("UPDATE sikayet set
                bilgilerim_donus=:bilgilerim_donus
                where bilgilerim_id={$bilgilerim_id}");
    
        $insert = $kaydet->execute(array(
            'bilgilerim_donus' => 1,
        ));
    }
   
} catch (Exception $e) {
    echo "Hata: " . $e->getMessage();
}
