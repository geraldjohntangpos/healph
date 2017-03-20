<?php
    include 'connection.php';

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "UPDATE inquiries SET STATUS = 'ACCEPTED' WHERE INQUIRY_ID = '$id'";
        $update = $conn->query($sql);
        if($update) {
            header('Location: ../adminPages/viewinquiries.php?acceptsuccessful');
        }
        else {
            header('Location: ../adminPages/viewinquiries.php?acceptfailed');
        }
    }
    else {
                $sql = "SELECT * FROM inquiries WHERE STATUS = 'ACTIVE'";
                $retrieve = $conn->query($sql)->fetchAll();
                if($retrieve) {
                    foreach($retrieve as $row) {
                        $id = $row['INQUIRY_ID'];
                        $name = $row['NAME'];
                        $email = $row['EMAIL'];
                        $request = $row['REQUEST'];
                        $addedat = $row['ADDED_AT'];
                        echo '<tr style="width:100%;">';
                            echo '<td style="width:100%; color: black; text-align: left;">';
                                echo '<h3>Name: <u>' .$name. '</u></h3>';
                                echo '<h3>Email: <u>' .$email. '</u></h3>';
                                echo '<p>Message: ' .$request. '</p>';
                                echo '<i style="font-size:12px;">Sent: ' .$addedat. '</i><br /><a href="../queries/manageinquiries.php?id=' .$id. '" style="color: blue;">Accept Inquiry</a>';
                                echo '<hr><hr><hr>';
                            echo '</td>';
                        echo '</tr>';
                    }
                }
                else {
                        echo '<tr style="width:100%;">';
                            echo '<td style="width:100%; color: black; text-align: left;">';
                                echo 'No available inquiry';
                            echo '</td>';
                        echo '</tr>';
                }
    }
?>
