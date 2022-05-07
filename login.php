 <?php
 function generateRandomString($length = 70) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$token = generateRandomString();
require ("Connect.php");
$phone = addslashes($_GET['phone']) ;
$password = addslashes($_GET['password']) ;
 $sql = "Select * from users where phone='$phone' and password='$password'";  
 $result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      $username = $row['username'];
    if($row['token'] == "none"){
        $sql1 = "UPDATE users SET token='$token' WHERE phone='$phone'";
        if ($conn->query($sql1) === TRUE) {
         $type =   $row['type'];
         echo json_encode(array('token'=>$token ,'type'=>$type,'id'=>$row['id'] ));
        } else {
        echo json_encode(array('Erorr'=>"Erorr Phone Or Password"));
        }
    }else {
      echo json_encode(array('Erorr'=>"Logined .!"));  
    }
  }
} else {
  echo json_encode(array('Erorr'=>"User Not Found .!!"));
}
 ?>