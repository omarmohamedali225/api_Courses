<?php
include('config.php');

$req = $_SERVER["REQUEST_METHOD"];
// $file = file_get_contents('php://input');
// $data = json_decode($file);
$data = $_POST;
if(isset($data['email'])&&isset($data['password'])){
  $email = mysqli_real_escape_string($con,$data['email']);
  $password = mysqli_real_escape_string($con,$data['password']);
  $passwordhash = md5($password);
  if($req=="POST"){
    if(empty($email)&&empty($password)){
      $arr = array("state"=>false,"msg"=>"جميع الحقول مطلوبة");
      echo json_encode($arr);
    }else if(empty($email)){
      $arr = array("state"=>false,"msg"=>"حقل البريد الألكتروني مطلوب");
      echo json_encode($arr);
    }else if(empty($password)){
      $arr = array("state"=>false,"msg"=>"حقل كلمة السر مطلوب");
      echo json_encode($arr);
    }else{
      $sql = "SELECT * FROM users WHERE email='$email' AND password='$passwordhash'";
      $query = mysqli_query($con,$sql);
      if(mysqli_num_rows($query)<=0){
        $arr = array("state"=>false,"msg"=>"البريد الألكتروني او كلمة السر خطأ");
        echo json_encode($arr);
      }
      else{
        $fetch = mysqli_fetch_assoc($query);
        $arr = array("state"=>true,"token"=>$fetch['token'],"data"=>[
          "name"=>$fetch['name'],
          "email"=>$fetch['email'],
          "image"=>$fetch['img'],
          "time"=>$fetch['time'],
          "role"=>$fetch['role'],
        ]);
        echo json_encode($arr);
      }
    }
  }else{
    $arr = array("state"=>false,"msg"=>"نوع الطلب مرفوض");
    echo json_encode($arr);
  }
}else{
  echo 'API LOGIN WITH OMAR😎';
}

?>