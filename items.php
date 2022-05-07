<?php
require ("Connect.php");
if($conn){
$stat = addslashes($_GET['stat']);
$token = addslashes($_GET['token']);
if($token != null){
    $query1 = "SELECT * FROM users where token = '$token' ";
    $r2 =  mysqli_query($conn,$query1) or die(mysql_error());
$response = array();
if(mysqli_num_rows($r2) >= 1){
   while($row1 = mysqli_fetch_array($r2)){
  $username = $row1['username'];
  $typ = $row1['type'];
} 
}
if($typ == "مندوب"){
    $query = "SELECT * FROM data where stat_1='no' and stat='$stat' and  agent='$username' order by id desc ";
}else{
    $query = "SELECT * FROM data where stat_2='no' and stat='$stat' and  username='$username' order by id desc ";
}
   $r =  mysqli_query($conn,$query) or die(mysql_error());
$response = array();

while($row = mysqli_fetch_array($r)){
    array_push($response,array('number'=>$row['number'],'username'=>$row['username'],'total'=>number_format($row['total'] ),'price'=>number_format($row['price'] ),'date'=>$row['date'],'phone'=>$row['phone'],'stat'=>$row['stat'],'city'=>$row['city'],'address'=>$row['address']));
    
   
}

echo json_encode($response , JSON_UNESCAPED_UNICODE);
}else {
    echo "Some Erorr";
}

}

 

?>