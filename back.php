<?php
require ("Connect.php");
if($conn){
$token = addslashes($_GET['token']);
if($token != null & $token != "" && $token != "none"){
    $query1 = "SELECT * FROM users where token = '$token' ";
    $r2 =  mysqli_query($conn,$query1) or die(mysql_error());
$response = array();
while($row1 = mysqli_fetch_array($r2)){
  $username = $row1['username'];
  $type = $row1['type'];
}
    $query = "SELECT * FROM data where username='$username' and stat='مرتجع' ORDER BY id ASC";
   $r =  mysqli_query($conn,$query) or die(mysql_error());
$response = array();
while($row = mysqli_fetch_array($r)){
       if($row['mrtja_user'] == "yes"){
           array_push($response,array('number'=>$row['number'],'total'=>number_format($row['total'] ),'price'=>number_format($row['price'] ),'date'=>$row['date'],'phone'=>$row['phone'],'stat'=>$row['stat'],'city'=>$row['city'],'address'=>$row['address']));
       }
}
echo json_encode($response , JSON_UNESCAPED_UNICODE);
}else {
    echo "Some Erorr";
}

}
?>