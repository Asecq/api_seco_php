<?php
require ("Connect.php");
if($conn){
$token = addslashes($_GET['token']);
$count_done = 0;
$count_back = 0;
$count_loading = 0;
$price_done;
$price_back;
$price_loading;
$total_done;
$total_ok;
$total_no;

if($token != null && $token != "none" && $token != ""){
    
    
    $query1 = "SELECT * FROM users where token = '$token' ";
    $r2 =  mysqli_query($conn,$query1) or die(mysql_error());
$response = array();
while($row1 = mysqli_fetch_array($r2)){
  $username = $row1['username'];
  $typ = $row1['type'];
}
if($typ == "مندوب"){
    
    $query = "SELECT * FROM data where agent='$username'";

}else{
      
    $query = "SELECT * FROM data where username='$username'";

}
   $r =  mysqli_query($conn,$query) or die(mysql_error());
$response = array();
while($row = mysqli_fetch_array($r)){
     
    if($typ == "مندوب"){
        $total_done += $row['mandop'] + $row['add_mandop'];
        if($row['stat_1'] =='no'){
             if($row['stat']=="واصل"){
        $count_done+=1;
        $price_done += $row['price'];
        $total_no += $row['mandop'] + $row['add_mandop'];
    }elseif($row['stat'] == "مرتجع"){
        $count_back +=1;
        $price_back += $row['price'];
    }elseif($row['stat'] == "قيد التسليم"){
        $count_loading +=1;
        $price_loading += $row['price'];
    }
        }else if($row['stat_1'] =='yes'){
            if($row['stat'] =="واصل" ){
       $total_ok += $row['mandop'] + $row['add_mandop'];
    }
        }
    
     
}else{
     $total_done += $row['price'];
     if($row['stat_2'] =='no'){
             if($row['stat']=="واصل"){
        $count_done+=1;
        $price_done += $row['price'];
        $total_no += $row['price'];
    }elseif($row['stat'] == "مرتجع"){
        $count_back +=1;
        $price_back += $row['price'];
    }elseif($row['stat'] == "قيد التسليم"){
        $count_loading +=1;
        $price_loading += $row['price'];
    }
     }else if($row['stat_2'] =='yes'){
        $total_ok += $row['price'];  
     }
  
}


    
  
    
    
  
}
  array_push($response,array("username"=>$username,"back" => $count_back , "done" => $count_done , "loading" => $count_loading ,"price_loading" => number_format($price_loading) , "price_done" => number_format($price_done), "price_back" => number_format($price_back),"total_all"=>number_format($total_done),"total_ok"=>number_format($total_ok),"total_no"=>number_format($total_no)));
echo json_encode($response , JSON_UNESCAPED_UNICODE);
}else {
    echo "Some Erorr";
}

}

 

?>