<?php
include('config.php');

$req = $_SERVER["REQUEST_METHOD"];
$host = $_SERVER["HTTP_HOST"];
$data = $_POST;
if (isset($data['name']) && isset($data['email']) && isset($data['password'])) {
  $name = mysqli_real_escape_string($con, $data['name']);
  $email = mysqli_real_escape_string($con, $data['email']);
  $password = mysqli_real_escape_string($con, $data['password']);
  $passwordhash = md5($password);
  $role = 'user';
  $img = 'http://' . $host . '/images/img_default.webp';
  $code = md5($email);
  $token = md5($email . $passwordhash);
  if ($req == "POST") {
    if (empty($name) && empty($email) && empty($password)) {
      $arr = array("state" => false, "msg" => "جميع الحقول مطلوبة");
      echo json_encode($arr);
    } else if (empty($name)) {
      $arr = array("state" => false, "msg" => "حقل الأسم مطلوب");
      echo json_encode($arr);
    } else if (empty($email)) {
      $arr = array("state" => false, "msg" => "حقل البريد الألكتروني مطلوب");
      echo json_encode($arr);
    } else if (empty($password)) {
      $arr = array("state" => false, "msg" => "حقل كلمة السر مطلوب");
      echo json_encode($arr);
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $arr = array("state" => false, "msg" => "صيغة البريد خطأ");
      echo json_encode($arr);
    } else if (strlen($password) < 6) {
      $arr = array("state" => false, "msg" => "كلمة السر اقل من 6 حروف");
      echo json_encode($arr);
    } else {
      $sql = "SELECT * FROM users WHERE email='$email'";
      $query = mysqli_query($con, $sql);
      if (mysqli_num_rows($query) <= 0) {
        mysqli_query($con, "INSERT INTO users (name,email,password,img,token,code,role) VALUES ('$name','$email','$passwordhash','$img','$token','$code','$role')");
        $arr = array("state" => true, "msg" => "تم إنشاء الحساب بنجاح");
        echo json_encode($arr);
      } else {
        $arr = array("state" => false, "msg" => "الحساب مسجل بالفعل");
        echo json_encode($arr);
      }
    }
  } else {
    $arr = array("state" => false, "msg" => "نوع الطلب مرفوض");
    echo json_encode($arr);
  }
} else {
  echo 'API REGISTER WITH OMAR😎';
}
