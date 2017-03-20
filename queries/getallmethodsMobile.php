<?php

    include 'connection.php';
        $sql = "SELECT NAME FROM service WHERE STATUS = 'ACTIVE'";

        $retrieve = $conn->query($sql)->fetchAll();
         $json = array();

        if($retrieve) {
            foreach($retrieve as $row) {
                $name = $row['NAME'];
                $json['service'][] = $row;

            }
        }

        echo json_encode($json);
    exit(0);

?>
