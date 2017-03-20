<?php
    require_once 'connection.php';

    $response = array();
    $response["success"] = [];
    $response["accountid"] = [];
    $response["name"] = [];


    if(isset($_REQUEST['accountid'])) {

        $accountid = $_REQUEST['accountid'];
//        $name = $_REQUEST['name'];

        $sql = "SELECT * FROM product WHERE ACCT_ID = '$accountid' AND STATUS = 'ACTIVE'";

        $retrieve = $conn->query($sql)->fetchAll();
        if(count($retrieve)>0){
            foreach($retrieve as $row){
                $userid = $row['ACCT_ID'];
                $prodname = $row['NAME'];

                $response["success"][] = true;
                $response["accountid"][] = $userid;
                $response["name"][] = $prodname;
            }

        }
        else {
                $response["success"][] = false;
                $response["accountid"][] = "Walay accountid";
                $response["name"][] = "Walay name";
        }


    }

    echo json_encode($response);
    exit(0);
?>

