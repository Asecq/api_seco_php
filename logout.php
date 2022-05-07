<?php
require("Connect.php");
$token = addslashes($_GET['token']) ;
if($token != null && $token != "" && $token != "none" ){
   $sql = "SELECT *  FROM `users` where token='$token'";
$result = $conn->query($sql);
$response = array();
if ($result->num_rows > 0) {
  // output data of each row
  $sq_logout = "Update `users` Set `token`='none' , `fcm`='none' where `token` = '$token'";
  $mysql_que = mysqli_query($conn , $sq_logout);
  if($mysql_que){
     
 echo json_encode(array('respnse'=>"done"));
  }
} else {
  echo json_encode(array('respnse'=>"Erorr in Token"));
}
$conn->close(); 
}

?>
