<?php

include_once ("../config/conn.db.php");


class Admin extends DatabaseConnection
{
    public function validateUser(mysqli $conn)
    {

        extract($_POST);
        $res = array();
        $data = array();
            $sql = "SELECT *FROM $table WHERE email='$email'";

        if (!$conn)
            $res = array("error" => "there is an error in the connection");
        else {
            $result = $conn->query($sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    // $_SESSION['type']=$sess_rows['type'];
                    while ($rows = $result->fetch_assoc()) {
                        $data[] = $rows;
                    }
                    
                    $res = array("message" => "success", "data" => $data, "isFound" => true);
                } else
                    $res = array("message" => "success", "isFound" => false);
            } else {
                $res = array("error" => "there is an error");
            }
        }
        echo json_encode($res);
    }
    public function validateAuth(mysqli $conn)
    {

        extract($_POST);
        $res = array();
        $data = array();
        $sql = "SELECT * from users where 
        username='$tell' AND password='$password'";
        if (!$conn)
            $res = array("error" => "there is an error");
        else {
            $result = $conn->query($sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    // $sess_rows = $result->fetch_assoc();
                    // session_start();
                    // $_SESSION['username'] =$result.username;
                    // $_SESSION['type']=$sess_rows['type'];
                    while ($rows = $result->fetch_assoc()) {
                        $data[] = $rows;
                    }
                    // session_start();
                    // $_SESSION['username'] = $data[0]['username'];  // Storing username in session
                    // $_SESSION['image'] = $data[0]['image']; 
                    $res = array("message" => "success", "data" => $data, "isFound" => true);
                } else
                    $res = array("message" => "success", "isFound" => false);


            } else {
                $res = array("error" => "there is an error");
            }
        }
        echo json_encode($res);



    }
    public function checkEmail(mysqli $conn)
    {

        extract($_POST);
        $res = array();
        $data = array();
        $sql = "SELECT * from users where 
        email='$email'";
        if (!$conn)
            $res = array("error" => "there is an error");
        else {
            $result = $conn->query($sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    while ($rows = $result->fetch_assoc()) {
                        $data[] = $rows;
                    }
                    $res = array("message" => "success", "data" => $data, "isFound" => true);
                } else
                    $res = array("message" => "success", "isFound" => false);


            } else {
                $res = array("error" => "there is an error");
            }
        }
        echo json_encode($res);



    }
    public function fetchingOne($conn)
    {
        extract($_POST);
        $res = array();
        $data = array();
        $sql = "SELECT *from users where id='$id'";
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
    public function ReadUsers($_conn)
    {
        extract($_POST);
        $res = array();
        $data = array();
        $sql = "SELECT * FROM `users` ";
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

    public function readIndustries($_conn)
    {
        extract($_POST);
        $response = array();
        $data = array();

        $sql = "SELECT *FROM industry";
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
    public function readAdmins($_conn)
    {
        extract($_POST);
        $response = array();
        $data = array();

        $sql = "SELECT *FROM users";
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
    // public function count($_conn)
    // {
    //     extract($_POST);
    //     $response = array();
    //     $data = array();

    //     $sql = "SELECT industry.ind_name, COUNT(waste_request.ind_id) AS request_count
    //     FROM waste_request
    //     JOIN industry ON waste_request.ind_id = industry.ind_id
    //     GROUP BY waste_request.ind_id;";
    //     if (!$_conn)
    //         $response = array("error" => "There is an error connection ", "status" => false);
    //     else {
    //         try {
    //             $result = $_conn->query($sql);
    //             if ($result) {
    //                 while ($rows = $result->fetch_assoc()) {
    //                     $data[] = $rows;
    //                 }

    //                 $response = array("error" => "", "status" => true, "data" => $data);
    //             } else
    //                 $response = array("error" => "There is an error connection ", "status" => false);
    //         } catch (Exception $e) {
    //             $response = array(
    //                 "error" => "There is an error occured while executing..",
    //                 "message" => $e->getMessage(),
    //                 "status" => false
    //             );
    //         }
    //     }

    //     echo json_encode($response);
    // }
    public function countAddress($_conn)
    {
        extract($_POST);
        $response = array();
        $data = array();

        $sql = "SELECT address.district AS name, COUNT(citizen.cit_id) AS citizens
        FROM address
        LEFT JOIN citizen ON address.add_no = citizen.add_no
        GROUP BY address.add_no, address.district;
        ";
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
    public function readAddress($_conn)
    {
        extract($_POST);
        $response = array();
        $data = array();

        $sql = "SELECT *FROM address";
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
    public function readReports($_conn)
    {
        extract($_POST);
        $response = array();
        $data = array();

        $sql = "SELECT reporting.criminal_photo, reporting.date, reporting.status, reporting.description, citizen.name,citizen.image
        FROM reporting
        INNER JOIN citizen ON reporting.cit_id = citizen.cit_id
        WHERE reporting.cit_id = '$cit_id'";
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
    public function readPoints($_conn)
    {
        extract($_POST);
        $response = array();
        $data = array();

        $sql = "select citizen.name 'Citizen Name', round(sum((recycling.qty)*(recycling.rate)),2) Points from citizen,recycling where recycling.cit_id=citizen.cit_id and citizen.cit_id='$cit_id';";
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

    public function report($_conn)
    {
        extract($_POST);
        $response = array();
        $fileName = $_FILES['profile_image']['name'];
        $ext = explode(".", $fileName)[1];
        $temp = $_FILES['profile_image']['tmp_name'];
        $newName = rand() . "." . $ext;
        $uploadedPath = "../uploads/" . $newName;
        if (move_uploaded_file($temp, $uploadedPath)) {
            $sql = "INSERT INTO `reporting`(`cit_id`, `criminal_photo`, `description`) VALUES ('$cit_id','$newName','$description')";
            if (!$_conn) {
                $response = array("error" => "there is an error connection", "status" => false);
            } else {
                $result = $_conn->query($sql);
                if ($result) {
                    $response = array("message" => "your report successfully sent...", "status" => true);
                } else {
                    $response = array("error" => $result, "Status" => false);
                }
            }
        }




        echo json_encode($response);
    }



    public function createUsers($_conn)
    {
        extract($_POST);
        $response = array();
        // $fileName = $_FILES['profile_image']['name'];
        // $ext = explode(".", $fileName)[1];
        // $temp = $_FILES['profile_image']['tmp_name'];
        // $newName = rand() . "." . $ext;
        // $uploadedPath = "../uploads/" . $newName;
        $fileName = $_FILES['profile_image']['name'];
        $ext = explode(".", $fileName)[1];
        $temp = $_FILES['profile_image']['tmp_name'];
        $newName = rand() . "." . $ext;
        $uploadedPath = "../uploads/" . $newName;
        if (move_uploaded_file($temp, $uploadedPath)) {
            // $sql = "INSERT INTO `citizen` (`name`, `tell`, `image`,`password`, `email`,`home_number`,`add_no`,village`)VALUES('$username','$tell','$newName', '$password','$email','$h_number','$add_no','$village');";
            $sql = "INSERT INTO `users`(`name`, `email`, `username`, `password`,`Status`,`type`, `image`) VALUES ('$name','$email','$username','$password','$status','$type','$newName');";
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
        }




        echo json_encode($response);
    }

    public function requesting($_conn)
    {
        extract($_POST);
        $response = array();

        $sql = "INSERT INTO `waste_request`(`cit_id`, `ind_id`, `waste_id`,`schedule`) VALUES ('$cit_id','$ind_id','$waste_id','$date')";
        if (!$_conn)
            $response = array("error" => "There is an error connection ", "status" => false);
        else {
            try {
                $result = $_conn->query($sql);
                if ($result)
                    $response = array("message" => "user was created..", "status" => true);
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



    public function deleteUsers($_conn)
    {
        extract($_POST);
        $response = array();

        $sql = "DELETE FROM `users` WHERE `id`='$id';";
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

    public function updateUsers($conn)
    {
        extract($_POST);
        $response = array();
        // UPDATE `doctors` SET `dr_id`='[value-1]',`name`='[value-2]',`gender`='[value-3]',`mobile`='[value-4]',`address`='[value-5]',`email`='[value-6]',`password`='[value-7]',`profision_id`='[value-8]',`hospital_id`='[value-9]',`verified`='[value-10]',`description`='[value-11]',`profile_image`='[value-12]' WHERE 1
        if ($hasProfile == "true") {
            $fileName = $_FILES['profile_image']['name'];
            $ext = explode(".", $fileName)[1];
            $temp = $_FILES['profile_image']['tmp_name'];
            $newName = rand() . "." . $ext;
            $uploadedPath = "../uploads/" . $newName;
            if (move_uploaded_file($temp, $uploadedPath)) {
                $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`username`='$username',`password`='$password' ,`Status`='$status' ,`type`='$type',`image`='$newName' WHERE `id`='$id';";
                if (!$conn) {
                    $response = array("error" => "there is an error connection", "status" => false);
                } else {
                    $result = $conn->query($sql);
                    if ($result) {
                        $response = array("message" => "Doctor was updated", "status" => true);
                    } else {
                        $response = array("error" => "there is an error connection", "status" => false);
                    }
                }
            }
        } else {
            $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`username`='$username',`password`='$password' ,`Status`='$status' WHERE `id`='$id';";
            if (!$conn) {
                $response = array("error" => "there is an error connection", "status" => false);
            } else {
                $result = $conn->query($sql);
                if ($result) {
                    $response = array("message" => "Doctor was updated", "status" => true);
                } else {
                    $response = array("error" => "there is an error connection", "status" => false);
                }
            }
        }


        echo json_encode($response);
    }
    // public function updateUsers($_conn)
    // {
    //     extract($_POST);
    //     $response = array();

    //     $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`username`='$username',`password`='$password' ,`Status`='$status' WHERE `id`='$id';";
    //     if (!$_conn)
    //         $response = array("error" => "There is an error connection ", "status" => false);
    //     else {
    //         try {
    //             $result = $_conn->query($sql);
    //             if ($result)
    //                 $response = array("message" => "Admin was updated..", "status" => true);
    //             else
    //                 $response = array("error" => "There is an error connection ", "status" => false);
    //         } catch (Exception $e) {
    //             $response = array(
    //                 "error" => "There is an error occured while executing..",
    //                 "message" => $e->getMessage(),
    //                 "status" => false
    //             );
    //         }
    //     }

    //     echo json_encode($response);
    // }
    public function changePassword($_conn)
    {
        extract($_POST);
        $response = array();

        $sql = "UPDATE users set password='$password'  where email='$email';";
        if (!$_conn)
            $response = array("error" => "There is an error connection ", "status" => false);
        else {
            try {
                $result = $_conn->query($sql);
                if ($result)
                    $response = array("message" => "password was updated..", "status" => true);
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
}
$admin = new Admin;
// checking
switch ($_POST['action']) {
    // case "createCitezan":
    //     $admin->createCitezan(Admin::getConnection());
    //     break;
    case "readAdmins":
        $admin->readAdmins(Admin::getConnection());
        break;
    case "updateUsers":
        $admin->updateUsers(Admin::getConnection());
        break;
    case "deleteUsers":
        $admin->deleteUsers(Admin::getConnection());
        break;
    case "createUsers":
        $admin->createUsers(Admin::getConnection());
        break;

    case "validateUser":
        $admin->validateUser(Admin::getConnection());
        break;


    case "checkEmail":
        $admin->checkEmail(Admin::getConnection());
        break;
    case "readReports":
        $admin->readReports(Admin::getConnection());
        break;
    case "readIndustries":
        $admin->readIndustries(Admin::getConnection());
        break;
    case "fetchingOne":
        $admin->fetchingOne(Admin::getConnection());
        break;
    // case "fetchingOne":
    //     $admin->fetchingOne(Admin::getConnection());
    //     break;
    case "changePassword":
        $admin->changePassword(Admin::getConnection());
        break;
    case "validateAuth":
        $admin->validateAuth(Admin::getConnection());
        break;
    case "readAddress":
        $admin->readAddress(Admin::getConnection());
        break;
    case "count":
        $admin->count(Admin::getConnection());
        break;
    default:
        return;
}