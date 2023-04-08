<?php
    
try {
    $db=new PDO("mysql:host=localhost;dbname=baum;charset=utf8",'root','');
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");




$bilgilerimsor=$db->prepare("SELECT * from sikayet");
$bilgilerimsor->execute();
$alldata = array();

while($bilgilerimcek=$bilgilerimsor->fetch(PDO::FETCH_ASSOC)) {

    $dizi=array(

        "bilgilerim_id"=>$bilgilerimcek['bilgilerim_id'],
        "bilgilerim_email"=>$bilgilerimcek['bilgilerim_email'],
        "bilgilerim_icerik"=>$bilgilerimcek['bilgilerim_icerik'],
        "bilgilerim_donus"=>$bilgilerimcek['bilgilerim_donus'],
        "bilgilerim_tarih"=>$bilgilerimcek['bilgilerim_tarih'],
        "bilgilerim_konubasligi"=>$bilgilerimcek['bilgilerim_konubasligi'],
        "bilgilerim_okundu"=>$bilgilerimcek['bilgilerim_okundu']
    );
    array_push($alldata,$dizi);
}
		
    $myJSON = json_encode($alldata);
    print_r($myJSON);
?>
	