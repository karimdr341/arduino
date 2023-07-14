<?php



header("Access-Control-Allow-Origin: *");

$api = "QZWC6S82D87Z1Z2A";
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    $input = file_get_contents('php://input');
    if ($input != "") {
        $json = json_decode($input, true);
        $api_key = $json['api_key'];
        if ($api == $api_key) {
            require "./connection.php";
            $action = $json['action'];
            if ($action == "read") {
                $sql = "SELECT * FROM `data`";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $output = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $output[] = $row;
                    }
                    echo json_encode(array("status" => "success", "data" => $output));
                    mysqli_close($conn);
                }
            } elseif ($action == "update") {
                $update_field = $json['update_field'];
                $update_value = $json['update_value'];
                $sql = "UPDATE `data` SET `$update_field`='$update_value' WHERE `data`.`slno`=9";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo json_encode(array("status" => "success"));
                    mysqli_close($conn);
                } else {
                    echo json_encode(array("status" => "error"));
                    mysqli_close($conn);
                }
            }
        } else {
            echo "key not match";
        }
    } else {
        echo json_encode("Api Key not found");
    }
} elseif ($method == "GET") {
    require "./connection.php";
    if (isset($_GET['api_key']) != "") {
        $api_key = $_GET['api_key'];
        if ($api == $api_key) {

            $action = $_GET["action"];


            if ($action == "read") {
                $sql = "SELECT * FROM `data`";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $output = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $output[] = $row;
                    }
                    echo json_encode(array("status" => "success", "data" => $output));
                    mysqli_close($conn);
                }
            } elseif (isset($_GET["api_key"]) && $action == "update" && isset($_GET["field1"])) {
                $data = $_GET["field1"];
                $sql = "UPDATE `data` SET `led1`='$data' WHERE `data`.`slno`=9";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo json_encode(array("status" => "success"));
                    mysqli_close($conn);
                } else {
                    echo json_encode(array("status" => "error"));
                    mysqli_close($conn);
                }
            } elseif (isset($_GET["api_key"]) && $action == "update" && isset($_GET["field2"])) {
                $data = $_GET["field2"];
                $sql = "UPDATE `data` SET `led2`='$data' WHERE `data`.`slno`=9";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo json_encode(array("status" => "success"));
                    mysqli_close($conn);
                } else {
                    echo json_encode(array("status" => "error"));
                    mysqli_close($conn);
                }
            } else {
                echo "Please Enter all Things to work Properly(Enter:Api Key,Action,Field Name)";
            }
        } else {
            echo json_encode(array("status" => "Not Match"));
        }
    } else {
        echo "Enter api Key";
    }
} else {
    echo "Use Only GET & POST Request";
}
