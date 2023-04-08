<?php 
  session_start();
  header('Content-type: application/json');
  header("Access-Control-Allow-Origin: *"); // cannot be a wildcard, you have to specify the name of the domain making the request here.
  header('Access-Control-Allow-Headers: Content-Type');
  header("Access-Control-Allow-Credentials: true"); // add this header

  if (isset($_GET['user_id'])) {
     $_SESSION['user_id'] = $_GET['user_id'];
     // echo  $_SESSION['username'];
  }

  if(!isset($_SESSION['email'])){
     echo json_encode(["success"=> false]);
 } else {
    echo json_encode(["success"=> true]);
     
     echo json_encode($_SESSION);
 }

  ?>