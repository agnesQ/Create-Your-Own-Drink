<?php
    include 'header.php';
    
    // already signed in
    if ($uid_isset && $uid_isvalid) {
        echo "Hi $user_name! You are already signed in. To register for a new user, please first sign out";
        //header("Location: localhost:8888/ztea");
    }
    else {
        // form not posted
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            $form_signup = <<<EOD
            <div class="body-title-font">
            <h3 class="body-title-font">Post Drink</h3>
            <form method="post" action="">
            <input class="type-in" name="drink_name" type="text" size=50 placeholder="Drink Name"/><br/>
            <input class="type-in" name="drink_description" type="text" size=50 placeholder="Brief Description"/><br/>
            <input class="type-in" name="drink_ingradients" type="text" size=50 placeholder="Ingradients"/><br/>
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input id="submit-form" type="submit" value="Post"/>
            </form>
            </div>
EOD;
            echo $form_post;
        }
        // form has been posted
        else {
            /* so, the form has been posted, we'll process the data in three steps:
             1.  Check the data
             2.  Let the user refill the wrong fields (if necessary)
             3.  Varify if the data is correct and return the correct response
             */
            $errors = array(); /* declare the array for later use */
            
            
            if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
            {
                echo 'Uh-oh.. a couple of fields are not filled in correctly..';
                echo '<ul>';
                foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
                {
                    echo '<li>' . $value . '</li>'; /* this generates a nice error list */
                }
                echo '</ul>';
            }
            else {
                //the form has been posted without errors, so save it
                include 'uppload.php';
                require_once 'db_query.php';
                connectToDB();
                $sql = "INSERT INTO drinks(drink_name, drink_description, create_by, create_date, ingradients, img_url) 
                VALUES ('" . mysql_real_escape_string($drink_name) . "', 
                    '" . mysql_real_escape_string($drink_description) . "',
                    " . $create_by . ", 
                    NOW(),
                    " . $drink_ingradients .",
                    '".$target_file."')'";
            
            $result = mysql_query($sql);
            
            if(!$result)
            {
                //something went wrong, display the error
                echo 'An error occured while inserting your post. Please try again later.' . mysql_error();
            }
            else
            {
                //after a lot of work, the query succeeded!
                echo 'You have successfully created a drink!';
                echo 'Do you want to share it with your friends?';
                echo '<form method="post" action="create_topic.php">
                    Category name: <input type="text" name="topic_name" /><br/>
                    Category description: <br/><textarea name="topic_description" /></textarea><br/>
                    Drink ID: <input type="text" name="drink_id" /><br/>
                    <input type="submit" value="Post a New Topic" />
                    </form>';
            }
                closeDB();
            }
            
        }
    }
    
    require 'footer.php';
?>