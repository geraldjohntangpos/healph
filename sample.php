<?php
    require_once 'queries/connection.php';

//    if(isset($_REQUEST['accountid'])) {
//        $accountid = $_REQUEST['accountid'];
        $sql = "SELECT NAME FROM product WHERE ACCT_ID = '13' AND STATUS = 'ACTIVE'";

        $retrieve = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
        $json = array();

        if($retrieve) {
            $json['result'] = $retrieve;
        }


//        foreach($retrieve as $row) {
//
//            $name = $row['NAME'];
//            $productid = $row['PRODUCT_ID'];
//            $json['productname'][] = $row;
//            $json['productid'][] = $productid;
//
//            }
//    }
//    else {
//        $json["productid"]="No product ID";
//        $json["productname"]="No Product name";
//    }


    echo json_encode($json);
    exit(0);
?>

