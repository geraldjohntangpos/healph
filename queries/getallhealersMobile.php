<?php

    include 'connection.php';

        $sql = "SELECT H.LASTNAME, H.FIRSTNAME, H.HEALER_ID, H.ACCT_ID, A.ACCT_ID, A.STATUS FROM healer as H INNER JOIN account AS A ON H.ACCT_ID = A.ACCT_ID WHERE A.STATUS = 'ACTIVE'";

        $retrieve = $conn->query($sql)->fetchAll();
        $json = array();

        if($retrieve) {
            foreach($retrieve as $row) {
                $lastname = $row['LASTNAME'];
                $firstname = $row['FIRSTNAME'];
                $json['healer'][]=$row;
            }
        }

     echo json_encode($json);
    exit(0);

?>
