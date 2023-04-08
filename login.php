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
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
$request_body = json_decode(file_get_contents('php://input'));
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $request_body->email;
    $password = $request_body->password;


    $sql = "SELECT id FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      
        ini_set('session.gc_maxlifetime', 86400); // 1 day
        session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['email'] = $email;
        
        $response = array('success' => true);
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Kimlik doğrulaması başarısız
        $response = array('success' => false);
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode($response);
      }
      
      
      
}




$conn->close();
?>