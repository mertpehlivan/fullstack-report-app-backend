<?php
    
try {
    $db=new PDO("mysql:host=localhost;dbname=baum;charset=utf8",'root','');
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");




$bilgilerimsor=$db->prepare("SELECT * from kategori");
$bilgilerimsor->execute();
$alldata = array();

while($bilgilerimcek=$bilgilerimsor->fetch(PDO::FETCH_ASSOC)) {

    $dizi=array(
        "kategori_ad"=>$bilgilerimcek['Kategori_ad'],
    );
    array_push($alldata,$dizi);
}
		
    $myJSON = json_encode($alldata);
    print_r($myJSON);
?>
	