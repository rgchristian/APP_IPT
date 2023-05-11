<?php
session_start();
include('dbcon.php');

if(isset($_POST['update_user_profile']))
{
    $display_name = $_POST['display_name'];
    $phone = $_POST['phone'];
    $profile = $_FILES['profile']['name'];
    $random_no = rand(2222,8888);

    $uid = $_SESSION['verified_user_id'];
    $user = $auth->getUser($uid);

    $new_image = $random_no.$profile;
    $old_image = $user->photoUrl;

    if($profile != NULL)
    {
        $filename = 'uploads/'.$new_image;
    }
    else
    {
        $filename = $old_image;
    }

    $properties = [
    'displayName' => $display_name,
    'phoneNumber' => $phone,
    'photoUrl' => $filename,
    ];

    $updatedUser = $auth->updateUser($uid, $properties);

    if($updatedUser)
    {
        if($profile != NULL)
        {
            move_uploaded_file($_FILES['profile']['tmp_name'], "uploads/".$new_image);
            if($old_image != NULL)
            {
                unlink($old_image);
            }
        }
        $_SESSION['status'] = "User profile updated";
        header('Location: my-profile.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "User profile not updated";
        header('Location: my-profile.php');
        exit(0);
    }
}

if(isset($_POST['user_claims_btn']))
{
    $uid = $_POST['claims_user_id'];
    $roles = $_POST['role_as'];

    if($roles == 'admin')
    {
        $auth->setCustomUserClaims($uid, ['admin' => true]);
        $msg = "User added as Admin";
    }
    elseif($roles == 'norole')
    {
        $auth->setCustomUserClaims($uid, null);
        $msg = "User role is removed";
    }

    if($msg)
        {
            $_SESSION['status'] = "$msg";
            header("Location: user-edit.php?id=$uid");
            exit();
        }
        else
        {
            $_SESSION['status'] = "Password changed unsuccessful";
            header("Location: user-edit.php?id=$uid");
            exit();
        }
}

if(isset($_POST['change_password_btn']))
{
    $new_password = $_POST['new_passord'];
    $retype_passord = $_POST['retype_passord'];

    $uid = $_POST['change_pwd_user_id'];

    if($new_password == $retype_passord)
    {
        $updatedUser = $auth->changeUserPassword($uid, $new_password);
        if($updatedUser)
        {
            $_SESSION['status'] = "Password changed successfully";
            header('Location: user-list.php');
            exit();
        }
        else
        {
            $_SESSION['status'] = "Password changed unsuccessful";
            header('Location: user-list.php');
            exit();
        }
    }
    else
    {
        $_SESSION['status'] = "Passwords do not match";
        header("Location: user-edit.php?id=$uid");
        exit();
    }
}

if(isset($_POST['enable_disable_user_acc']))
{
    $disable_enable = $_POST['select_enable_disable'];
    $uid = $_POST['ena_dis_user_id'];

    if($disable_enable == "disable")
    {
        $updatedUser = $auth->disableUser($uid);
        $msg = "Account deactivated";
    }
    else
    {
        $updatedUser = $auth->enableUser($uid);
        $msg = "Account activated";
    }

    if($updatedUser)
    {
        $_SESSION['status'] = $msg;
        header('Location: user-list.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "Something went wrong";
        header('Location: user-list.php');
        exit();
    }
}


if(isset($_POST['reg_user_delete_btn']))
{
    $uid = $_POST['reg_user_delete_btn'];

    try{
        $auth->deleteUser($uid);

        $_SESSION['status'] = "User removed successfully";
        header('Location: user-list.php');
        exit();

    } catch(Exception $e) {
        $_SESSION['status'] = "No user found";
        header('Location: user-list.php');
        exit();
    }
}



if(isset($_POST['update_user_btn']))
{
    $displayName = $_POST['display_name'];
    $phone = $_POST['phone'];

    $uid = $_POST['user_id'];
    $properties = [
        'displayName' => $displayName,
        'phoneNumber' => $phone,
    ];

    $updatedUser = $auth->updateUser($uid, $properties);

    if($updatedUser)
    {
        $_SESSION['status'] = "User updated successfully";
        header('Location: user-list.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "User update unsuccessful";
        header('Location: user-list.php');
        exit();
    }
}


if(isset($_POST['register_btn']))
{
    $fullname = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userProperties = [
        'email' => $email,
        'emailVerified' => false, 
        'phoneNumber' => '+63'.$phone,
        'password' => $password,
        'displayName' => $fullname,
    ];       
    
    $createdUser = $auth->createUser($userProperties);

    if($createdUser)
    {
        $_SESSION['status'] = "User registered successfully";
        header('Location: register.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "User registration unsuccessful";
        header('Location: register.php');
        exit();
    }
}


if(isset($_POST['delete_btn']))
{
    $del_id = $_POST['delete_btn'];

    $ref_table = 'user/'.$del_id;
    $deletequery_result = $database->getReference($ref_table)->remove();

    if($deletequery_result)
        {
            $_SESSION['status'] = "User removed successfully";
            header('Location: index.php');
        }
        else
        {
            $_SESSION['status'] = "User remove unsuccessful";
            header('Location: index.php');
        }
}

if(isset($_POST['update_contact']))
{
    $key = $_POST['key'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $updateData = [
        'fname'=>$first_name,
        'lname'=>$last_name,
        'email'=>$email,
        'phone'=>$phone,
    ];

    $ref_table = 'user/'.$key;
    $updatequery_result = $database->getReference($ref_table)->update($updateData);

        if($updatequery_result)
        {
            $_SESSION['status'] = "User updated successfully";
            header('Location: index.php');
        }
        else
        {
            $_SESSION['status'] = "User update unsuccessful";
            header('Location: index.php');
        }
}



if(isset($_POST['save_contact']))
{
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $postData = [
        'fname'=>$first_name,
        'lname'=>$last_name,
        'email'=>$email,
        'phone'=>$phone,
    ];

    $ref_table = "user";
    $postRef_result = $database->getReference($ref_table)->push($postData);

        if($postRef_result)
        {
            $_SESSION['status'] = "User successfully added";
            header('Location: index.php');
        }
        else
        {
            $_SESSION['status'] = "User add unsuccessful";
            header('Location: index.php');
        }
}


?>