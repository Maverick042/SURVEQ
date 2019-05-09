<?php
ob_start();
require "dbconnect.php";

if(isset($_POST['email']) && isset($_POST['password']))
{
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {
        $db->select(
            'first_name, last_name, email, password,userID',
            'user',
            'email = ? AND password = ?',
            array($_POST['email'], $_POST['password'])
            );

        $record = $db->returned_rows;
        $user_data = $db->fetch_assoc();
        $_SESSION['user_name'] = $user_data['first_name'];
        $user_data = $user_data["userID"];


        if($record == 1)
        {
            date_default_timezone_set("Asia/Dhaka");
            $_SESSION['email'] = $_POST['email'];
            $db->update(
                'user',
                array(
                    'Logged_In' => date("Y-m-d H:i:s"),
                    ),
                'email = ?',
                array($_POST['email']));
            $_SESSION['ID'] = $user_data;

            header('Location: homepage.php');
        }
        else
        {
            header('Location: index.php');
        }
        //$record = $db->fetch_assoc_all(); */

    }
    else
    {
        header('Location: index.php');
    }
}
else
{
    header('Location: index.php');
}

