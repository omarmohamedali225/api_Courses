<?php


include 'config.php';

$req = $_SERVER["REQUEST_METHOD"];
$http = $_SERVER[HTTP_X_FORWARDED_PROTO];
$host = $_SERVER[HTTP_HOST];

if ($req == "GET") {
  $arr = array();
  $query = mysqli_query($con, "SELECT * FROM courses");
  while ($fetch = mysqli_fetch_assoc($query)) {
    $course = array(
      "id" => $fetch['id'],
      "image" => $http.'://'.$host.'/images/'.$fetch['img'],
      "type" => $fetch['type'],
      "title" => $fetch['title'],
      "owner" => $fetch['owner'],
      "price" => array(
        "price_after" => $fetch['price'],
        "price_before" => $fetch['discount']
      )
    );
    $arr[] = $course;
  }
  $json = json_encode($arr);
  print_r($json);
} else {
  $arr = array("state" => false, "msg" => "نوع الطلب مرفوض");
  echo json_encode($arr);
}

?>