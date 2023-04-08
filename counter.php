<?php
try {
    $db=new PDO("mysql:host=localhost;dbname=baum;charset=utf8",'root','');
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
$veri= new stdClass();


    $bilgilerimsor=$db->prepare("SELECT COUNT(bilgilerim_id) as toplam FROM sikayet");
      
		$bilgilerimsor->execute();
        $toplamkayit= $bilgilerimsor->fetch(PDO::FETCH_ASSOC);
        $veri->toplamkayit = $toplamkayit;

    $bilgilerimdonus=$db->prepare("SELECT COUNT(bilgilerim_id) as toplam FROM sikayet WHERE bilgilerim_donus=0");
      
		$bilgilerimdonus->execute();
        $donus = $bilgilerimdonus->fetch(PDO::FETCH_ASSOC);
        $veri->donus = $donus;
    
    $bilgilerimcevapbekleyen=$db->prepare("SELECT COUNT(bilgilerim_id) as toplam FROM sikayet WHERE bilgilerim_okundu=0");
      
		$bilgilerimcevapbekleyen->execute();
        $okundu = $bilgilerimcevapbekleyen->fetch(PDO::FETCH_ASSOC);
        $veri->okundu = $okundu;
    

    $myJSON = json_encode($veri);
    print_r( $myJSON);
?>