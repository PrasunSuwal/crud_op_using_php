<?php
include_once 'env.php';
include_once 'db.php';
include_once 'user.php';

function deleteUser($user, $id){
    $user->id = $id;
    if($user->delete()) {
        session_start();
        $_SESSION['success'] = "Deleted Successfully!!";
        header('Location:index.php');
        exit;
    } else {
        header('Location:form.php');
        exit;
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get database connection
    $database = new Database();
    $db = $database->getConnection();

    // Instantiate user object
    $user = new User($db);

    if(isset($_POST['_method']) && $_POST['_method'] == 'DELETE' ){
        deleteUser($user, htmlspecialchars(strip_tags($_POST['id'])));
    }

    
    // Set user property values
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->address = $_POST['address'];
    if ($_POST['status'] == 'on') {
        $user->status = 1;
    } else {
        $user->status = 0;
    }

    if(isset($_POST['id'])) {
        //update the user
        $user->id = htmlspecialchars(strip_tags($_POST['id']));
        if ($user->update()) {
            //phpinfo();
            unset($_SESSION['edit_user']);
            session_start();
            $_SESSION['success'] = "Updated Successfully!!";
            header('Location:index.php');
            exit;
           
        } else {
            header('Location:form.php');
            exit;
        }
    } else {
        //create the user
        $user->password = password_hash($_POST['confirm_password'], PASSWORD_DEFAULT);

        // Create the user
        if ($user->create()) {
            header('Location:index.php');
            exit;
        } else {
            header('Location:form.php');
            exit;
        }
    }
}



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->id = htmlspecialchars(strip_tags($_GET['id']));

    $stmt = $user->edit();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($result > 0) {
        $edit_user['id'] = $result['id'];
        $edit_user['name'] = $result['name'];
        $edit_user['email'] = $result['email'];
        $edit_user['address'] = $result['address'];
        $edit_user['status'] = $result['status'];
        session_start();
        $_SESSION['edit_user'] = $edit_user;
        //header('Location: form.php?id=' . urlencode($id) . '&name=' . urlencode($name));
        header('Location:form.php');
        exit;
    } else {
        header('Location:index.php');
        exit;
    }
}
