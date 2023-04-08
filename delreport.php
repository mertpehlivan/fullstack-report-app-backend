<?php
try {
    $db=new PDO("mysql:host=localhost;dbname=baum;charset=utf8",'root','');
    
} catch (PDOException $e) {
    echo $e->getMessage();
}
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

try {
    $bilgilerim_id=$_GET['id'];

    $kaydet=$db->prepare("UPDATE sikayet set
        bilgilerim_okundu=:bilgilerim_okundu
        where bilgilerim_id={$bilgilerim_id}");
    
    $insert=$kaydet->execute(array(
    
        'bilgilerim_okundu' => 1,
        
    ));
    
} catch (Exception $e) {
    echo 'Hata Kodu' .$e->getMessage();
}
?>