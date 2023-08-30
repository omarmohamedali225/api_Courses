<?php
include 'config.php';
$arrVideo = [];
$req = $_SERVER["REQUEST_METHOD"];
$host = $_SERVER["HTTP_HOST"];
if ($req == "GET") {
    if (isset($_GET["token"])) {
        $token = mysqli_real_escape_string($con, $_GET["token"]);
        $query = mysqli_query($con, "SELECT * FROM users WhERE token='$token'");
        $fetch = mysqli_fetch_assoc($query);
        $codeUser = $fetch['code'];
        if (mysqli_num_rows($query) > 0) {
            if (isset($_GET["id"])) {
                $id = mysqli_real_escape_string($con, $_GET["id"]);


                $queryVideo = mysqli_query($con, "SELECT * FROM videos WHERE uid='$id'");
                $fetchVideo = mysqli_fetch_all($queryVideo, MYSQLI_ASSOC);


                $queryCourse = mysqli_query($con, "SELECT * FROM courses WHERE id='$id'");
                $fetchCourse = mysqli_fetch_all($queryCourse, MYSQLI_ASSOC);
                $codeCourse = $fetchCourse[0]['code'];

                $querySub = mysqli_query($con, "SELECT * FROM subscibe WHERE uid='$codeUser' AND courseid='$codeCourse'");
                $fetchSub = mysqli_fetch_all($querySub, MYSQLI_ASSOC);

                foreach ($fetchVideo as $key => $value) {
                    if ($fetchVideo[$key]['state'] == "pro" && mysqli_num_rows($querySub) >= 1) {
                        $arr = array(
                            'id' => $fetchVideo[$key]['id'],
                            'title' => $fetchVideo[$key]['title'],
                            'image' => 'http://' . $host . '/images/' . $fetchVideo[$key]['img'],
                            'state' => 'free',
                            'time' => $fetchVideo[$key]['time']
                        );
                    } else {
                        $arr = array(
                            'id' => $fetchVideo[$key]['id'],
                            'title' => $fetchVideo[$key]['title'],
                            'image' => 'http://' . $host . '/images/' . $fetchVideo[$key]['img'],
                            'state' => $fetchVideo[$key]['state'],
                            'time' => $fetchVideo[$key]['time']
                        );
                    }
                    array_push($arrVideo, $arr);
                }
                $arr = array(
                    "name" => $fetchCourse[0]['title'],
                    "data" => $arrVideo,
                    "state" => true
                );
                print_r(json_encode($arr));
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
