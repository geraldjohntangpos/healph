<?php

    include 'connection.php';
        $sql = "SELECT NAME FROM product WHERE STATUS = 'ACTIVE'";

        $retrieve = $conn->query($sql)->fetchAll();
        $json = array();

        if($retrieve) {
            foreach($retrieve as $row) {
                $name = $row['NAME'];
                $json['product'][] = $row;
            }
        }

    echo json_encode($json);
    exit(0);
?>
