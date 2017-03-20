<?php
    session_start();
    require_once 'connection.php';
    $response = array();
    $response["success"] = false;
    $response["username"] = "walay username";
    $response["password"] = "walay password";
    $response["type"] = "walay type";

    if(isset($_REQUEST['username']) && isset($_REQUEST['password'])) {

        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $sql = "SELECT * FROM account WHERE USERNAME = '$username' AND PASSWORD = '$password'";
        $retlogin = $conn->query($sql)->fetchAll();
        if(count($retlogin)>0) {
            foreach($retlogin as $row) {
                $userid = $row['ACCT_ID'];
                $username = $row['USERNAME'];
                $password = $row['PASSWORD'];

                $type = $row['TYPE'];

                $response["success"] = true;
                $response["userid"] = $userid;
                $response["username"] = $username;
                $response["password"] = $password;
                $response["type"] = $type;
            }

            if($type == "Client") {
                $sql = "SELECT * FROM client WHERE ACCT_ID = '$userid'";
            }
            else  if($type == "Healer") {
                $sql = "SELECT * FROM healer WHERE ACCT_ID = '$userid'";
            }
            else {
                $sql = "SELECT * FROM admin WHERE ACCT_ID = '$userid'";
            }

            $retdata = $conn->query($sql)->fetchAll();
            if(count($retdata)>0) {
                foreach($retdata as $row) {
                    $name = $row['LASTNAME']. ", " .$row['FIRSTNAME'];
                }
            }
            else {
                session_destroy();

            }

            $_SESSION['USERID'] = $userid;
            $_SESSION['USERNAME'] = $username;
            $_SESSION['NAME'] = $name;
            $_SESSION['TYPE'] = $type;

        }
        else {
            session_destroy();

        }
    }


    echo json_encode($response);
    exit(0);

?>
