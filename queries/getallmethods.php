<style type="text/css">
    td a {
        color: green;
    }
</style>

<?php

    include 'connection.php';
        $sql = "SELECT * FROM service WHERE STATUS = 'ACTIVE'";

        $retrieve = $conn->query($sql)->fetchAll();

        if($retrieve) {
            foreach($retrieve as $row) {
                $name = $row['NAME'];
                $serviceid = $row['SRVCTYPE_ID'];
                $methodid = $row['SERVICE_ID'];
                $accountid = $row['ACCT_ID'];
                $price = $row['PRICE'];
                $rating = $row['RATE'];

                ?>
                    <tr style="width:100%">
                        <td style="width:25%;">
                            <?php echo $name; ?>
                        </td>
                        <td style="width:20%;">
                            <?php
                                $srvcsql = "SELECT * FROM service_type WHERE SRVCTYPE_ID = '$serviceid'";
                                $srvcret = $conn->query($srvcsql)->fetchAll();
                                if($srvcret) {
                                    foreach($srvcret as $srvcrow) {
                                        $servicetype = $srvcrow['SRVCTYPE'];
                                    }
                                }
                                echo $servicetype;
                            ?>
                        </td>
                        <td style="width:10%;">
                            <?php echo $price; ?>
                        </td>
                        <td style="width:10%;">
                            <?php echo $rating; ?>
                        </td>
                        <td style="width:20%;">
                            <a href="healer.php?accountid=<?php echo $accountid; ?>&ref=allHealers">
                                <?php
                                    $acctsql = "SELECT * FROM healer WHERE ACCT_ID = '$accountid'";
                                    $acctret = $conn->query($acctsql)->fetchAll();
                                    if($acctret) {
                                        foreach($acctret as $acctrow) {
                                            $name = $acctrow['LASTNAME']. ", " .$acctrow['FIRSTNAME'];
                                        }
                                    }
                                    echo $name;
                                ?>
                            </a>
                        </td>
                        <td style="width:25%;">
                            <a href="method.php?methodid=<?php echo $methodid; ?>&ref=allMethods">View</a>
                        </td>
                    </tr>
                <?php
            }
        }

?>
