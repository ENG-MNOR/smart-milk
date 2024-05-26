<?php

include_once ("../config/conn.db.php");


class Admin extends DatabaseConnection
{
    
    public function fetchingOne($conn)
    {
        extract($_POST);
        $res = array();
        $data = array();
        $sql = "SELECT *from transactions where id='$id'";
        if (!$conn)
            $res = array("error" => "there is an error");
        else {
            $result = $conn->query($sql);
            if ($result) {
                while ($rows = $result->fetch_assoc()) {
                    $data[] = $rows;
                }
                $res = array("message" => "success", "data" => $data);
            } else {
                $res = array("error" => "there is an error");
            }
        }
        echo json_encode($res);
    }
    public function readTransactions($_conn)
    {
        extract($_POST);
        $response = array();
        $data = array();

        $sql = "SELECT * FROM transactions";
        if (!$_conn)
            $response = array("error" => "There is an error connection ", "status" => false);
        else {
            try {
                $result = $_conn->query($sql);
                if ($result) {
                    while ($rows = $result->fetch_assoc()) {
                        $data[] = $rows;
                    }

                    $response = array("error" => "", "status" => true, "data" => $data);
                } else
                    $response = array("error" => "There is an error connection ", "status" => false);
            } catch (Exception $e) {
                $response = array(
                    "error" => "There is an error occured while executing..",
                    "message" => $e->getMessage(),
                    "status" => false
                );
            }
        }

        echo json_encode($response);
    }
    public function count($conn)
    {
        extract($_POST);
        $res = array();
        $sql = "SELECT COUNT(*) as counter from $table";
        if (!$conn)
            $res = array("error" => "there is an error");
        else {
            $result = $conn->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                $res = array("message" => "success", "rowNumber" => $row['counter']);
            } else {
                $res = array("error" => "there is an error");
            }
        }

        echo json_encode($res);
    }
    public function createTransactions($_conn)
    {
        extract($_POST);
        $response = array();
        $sql = "INSERT INTO `transactions`(`quantity`, `amount`, `total`) VALUES ('$quantity', '$amount', '$quantity' * '$amount')";

            // $sql = "INSERT INTO `transactions`(`quantity`,`amount`, `total`) VALUES ('$quantity','$amount','$quantity*$amount')";
            if (!$_conn) {
                $response = array("error" => "there is an error connection", "status" => false);
            } else {
                $result = $_conn->query($sql);
                if ($result) {
                    $response = array("message" => "successfully ragestered...", "status" => true);
                } else {
                    $response = array("error" => $_conn->error, "Status" => false);
                }
            }  
             echo json_encode($response);
    }




     
    
    public function deleteTransactions($_conn)
    {
        extract($_POST);
        $response = array();

        $sql = "DELETE FROM `transactions` WHERE `id`='$id';";
        if (!$_conn)
            $response = array("error" => "There is an error connection ", "status" => false);
        else {
            try {
                $result = $_conn->query($sql);
                if ($result)
                    $response = array("message" => "Admin was deleted..", "status" => true);
                else
                    $response = array("error" => "There is an error connection ", "status" => false);
            } catch (Exception $e) {
                $response = array(
                    "error" => "There is an error occured while executing..",
                    "message" => $e->getMessage(),
                    "status" => false
                );
            }
        }

        echo json_encode($response);
    }
    public function updateTransactions($conn)
    {
        extract($_POST);
        $response = array();
        // UPDATE `doctors` SET `dr_id`='[value-1]',`name`='[value-2]',`gender`='[value-3]',`mobile`='[value-4]',`address`='[value-5]',`email`='[value-6]',`password`='[value-7]',`profision_id`='[value-8]',`hospital_id`='[value-9]',`verified`='[value-10]',`description`='[value-11]',`profile_image`='[value-12]' WHERE 1
            $sql = "UPDATE `transactions` SET `quantity`='$quantity',`amount`='$amount',`total`='$quantity' * '$amount'  WHERE `id`='$id';";
            if (!$conn) {
                $response = array("error" => "there is an error connection", "status" => false);
            } else {
                $result = $conn->query($sql);
                if ($result) {
                    $response = array("message" => "Tank was updated", "status" => true);
                } else {
                    $response = array("error" => "there is an error connection", "status" => false);
                }
            }
        


        echo json_encode($response);
    }
  
}
$admin = new Admin;
// checking
switch ($_POST['action']) {
    // case "createCitezan":
    //     $admin->createCitezan(Admin::getConnection());
    //     break;
    case "readTransactions":
        $admin->readTransactions(Admin::getConnection());
        break;
    case "updateTransactions":
        $admin->updateTransactions(Admin::getConnection());
        break;
    case "deleteTransactions":
        $admin->deleteTransactions(Admin::getConnection());
        break;
    case "createTransactions":
        $admin->createTransactions(Admin::getConnection());
        break;
    case "fetchingOne":
        $admin->fetchingOne(Admin::getConnection());
        break;

    default:
        return;
}