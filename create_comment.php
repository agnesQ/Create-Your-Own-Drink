<?php
    include 'header.php';
    include 'forum_nav.php';
    require_once 'db_query.php';
    connectToDB();

    echo '<h2>Create a comment</h2>';
    if(!$uid_isset || !$uid_isvalid)
    {
        //the user is not signed in
        echo 'Sorry, you have to be <a href="/create_your_own_drink/login.php">signed in</a> to create a topic.';
    }
    else
    {
        $sql = "INSERT INTO comments(comment_topic, comment_content, post_date, post_by)
            VALUES('" . mysql_real_escape_string($_POST['id']) . "',
                   '" . mysql_real_escape_string($_POST['comment_content']) . "',
                   NOW(),
                   '".$user_id")";
                   
            $result = mysql_query($sql);
               if(!$result)
               {
               //something went wrong, display the error
               echo 'Error' . mysql_error();
               }
               else
               {
                echo 'New comment has been successfully made. <a href="displaytopic.php?id=' . $_POST['id'] . '">Your new category</a>.';
               }
    }
include 'footer.php';
    closeDB();
?>
