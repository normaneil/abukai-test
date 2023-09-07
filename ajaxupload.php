<?php
include "config.php";

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'uploads/'; // upload directory

if(!empty($_POST['firstname']) || !empty($_POST['lastname']) || !empty($_POST['email']) || !empty($_POST['city']) || !empty($_POST['country']) || $_FILES['attachment'])
{

    $sql = "SELECT email FROM customers WHERE email='{$_POST['email']}';";
    $sth = $db_conn->prepare($sql);
    $sth->execute();
    $result = $sth->fetch();
    if ($result) {
        $email = $result['email'];
        echo json_encode([
            'success' => false,
            'errors' => "Email already exist!",
            'data' => $email
        ]);
        exit;
    }
    
    $img = $_FILES['attachment']['name'];
    $tmp = $_FILES['attachment']['tmp_name'];

    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;

    // check's valid format
    if(in_array($ext, $valid_extensions)) 
    { 
        $path = $path.strtolower($final_image); 

        if(move_uploaded_file($tmp,$path)) 
        {
            
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];

            $city = $_POST['city'];
            $country = $_POST['country'];
            $image_path = $path;
            $password = password_hash("thisisatest", PASSWORD_DEFAULT);
            $sql = "INSERT INTO customers (firstname, lastname ,email, city, country, password, image_path) VALUES ('{$firstname}', '{$lastname}', '{$email}', '{$city}', '{$country}', '{$password}', '{$image_path}')";
            $stmt = $db_conn->prepare($sql);
            $stmt->execute();
            $id = $db_conn->lastInsertId();

            echo json_encode([
                'success' => true,
                'path' => $path,
                'user_id' => $id
            ]);
        }
    } 
    else 
    {
        echo json_encode(['success' => false]);
    }
}
?>