<?php


include 'config.php';
$arrVideo = [];
$req = $_SERVER["REQUEST_METHOD"];


if ($req == "GET") {
  if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($con, $_GET['token']);
    $query = mysqli_query($con, "SELECT * FROM users WhERE token='$token'");
    $fetch = mysqli_fetch_assoc($query);
    $codeUser = $fetch['code'];
    if (mysqli_num_rows($query) > 0) {
      if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($con, $_GET['id']);


        $queryVideo = mysqli_query($con, "SELECT * FROM videos WHERE id='$id'");
        $fetchVideo = mysqli_fetch_all($queryVideo, MYSQLI_ASSOC);


        if (mysqli_num_rows($queryVideo) >= 1) {
          $idVc = $fetchVideo[0]['uid'];
          $queryCourse = mysqli_query($con, "SELECT * FROM courses WHERE id='$idVc'");
          $fetchCourse = mysqli_fetch_all($queryCourse, MYSQLI_ASSOC);
          $codeCourse = $fetchCourse[0]['code'];
          $querySub = mysqli_query($con, "SELECT * FROM subscibe WHERE uid='$codeUser' AND courseid='$codeCourse'");
          $fetchSub = mysqli_fetch_all($querySub, MYSQLI_ASSOC);

          if ($fetchVideo[0]['state'] == "pro" && mysqli_num_rows($querySub) <= 0) {
            $arr = array(
              'id' => $fetchVideo[0]['id'],
              'video' => 'You are not authorized',
              'state' => false
            );
          } else {
            $arr = array(
              'id' => $fetchVideo[0]['id'],
              'video' => $fetchVideo[0]['video'],
              'title' => $fetchVideo[0]['title'],
              'state' => true
            );
          }
          print_r(json_encode($arr));
        } else {
          $arr = array("state" => false, "msg" => "The ID is wrong");
          print_r(json_encode($arr));
        }
      } else {
        $arr = array("state" => false, "msg" => "Please specify the course ID");
        echo json_encode($arr);
      }
    } else {
      $arr = array("state" => false, "msg" => "The token is wrong");
      echo json_encode($arr);
    }
  } else {
    $arr = array("state" => false, "msg" => "Enter the token correctly");
    echo json_encode($arr);
  }
} else {
  $arr = array("state" => false, "msg" => "Request type rejected");
  echo json_encode($arr);
}
