<?php
    require_once 'global.php';
    require 'db_query.php';
    $cookie_name = "user_id";
    $uid_isset = false;
    $uid_isvalid = false;
    if(!isset($_COOKIE[$cookie_name])) {
        $uid_isset = false;
    } else {
        $uid_isset = true;
        connectToDB();
        $table_name = 'users';
        $user_id = $_COOKIE[$cookie_name];
        $user_name = $_COOKIE["user_name"];
        $uid_isvalid = checkUsersWithID($user_id);
        closeDB();
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Create life like you create your innovative drinks!</title>
        <link rel="stylesheet" href="/create_your_own_drink/CSS/main.css">
        <link href='http://fonts.googleapis.com/css?family=Sigmar+One|Monoton|Pinyon+Script|Rock+Salt|Kaushan+Script|Julius+Sans+One|Kranky|Coming+Soon' rel='stylesheet' type='text/css'>
    </head>

    <body>
        <header id="index-header">
            <?php
                if($uid_isset && $uid_isvalid) {
                    echo '<div id="reg-log">
                    <p id="greeting">Hi, ' . $user_name . '!</p> <a href="create_your_own_drink/forum.php">Forum</a></li>/changesetting.php">settings</a> <a href="/ztea/logout.php">logout</a>
                    </div>';
                } else {
                    echo '<div id="reg-log">
                    <a href="/create_your_own_drink/register.php">register</a>
                    <a href="/create_your_own_drink/login.php">login</a>
                    </div>';
                }
            ?>

            <ul>
                <li><a href="/create_your_own_drink/index.php">Home</a></li>
                <li><a href="/create_your_own_drink/drinkCreated.php">Drink Created</a></li>
                <li><a id="toplogo" href="/create_your_own_drink/index.php">
                    <img src="/create_your_own_drink/images/coffee.gif" alt="coffee logo" height="150">
                        </a></li>
                <li><a href="/create_your_own_drink/forum.php">Forum</a></li>
                <li><a href="/create_your_own_drink/logout.php">Logout</a></li>
            </ul>
        </header>
        <br/><br/>
        <section>