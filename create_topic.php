<?php
    include 'header.php';
    include 'forum_nav.php';
    require_once 'db_query.php';
    connectToDB();

    echo '<h2>Create a topic</h2>';
    if(!$uid_isset || !$uid_isvalid)
    {
        //the user is not signed in
        echo 'Sorry, you have to be <a href="/create_your_own_drink/login.php">signed in</a> to create a topic.';
    }
    else
    {
      if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
          $sql = "SELECT drink_id, drink_name FROM drinks WHERE create_by = '" . mysql_real_escape_string($user_id) . "'";
          $result = mysql_query($sql);
          echo '<form method="post" action="create_topic.php">
                    Category name: <input type="text" name="topic_name" /><br/>
                    Category description: <br/><textarea name="topic_description" /></textarea><br/>
                    Drink: <select name="drink_id">'

                    while($row = mysql_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['drink_id'] . '">' . $row['drink_name'] . '</option>';
                    }
                    echo '</select><br/>';

          echo '<input type="submit" value="Post a New Topic" />
                </form>';
        }
      else
      {
        //the form has been posted, so save it
            $sql = "INSERT INTO topics(topic_name, topic_description, drink_id, create_time, create_by)
            VALUES('" . mysql_real_escape_string($_POST['topic_name']) . "',
                   '" . mysql_real_escape_string($_POST['topic_description']) . "',
                   '".mysql_real_escape_string($_POST['drink_id'])."',
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
                $topic_id = mysql_insert_id();
                echo 'New Topic has been successfully added. <a href="displaytopic.php?id=' . $topic_id . '">Your new category</a>.';
               }
      }
            
        
    }
    
    include 'footer.php';
    closeDB();
?>
