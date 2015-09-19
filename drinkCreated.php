<?php
    include 'header.php';
    require_once 'db_query.php';
    connectToDB();
    
    if(!$uid_isset || !$uid_isvalid)
    {
        //the user is not signed in
        echo '<a href="./login.php">Sign in</a> to view more.';
    }
    else
    {
        echo '<p class="body-title-font">Coupons!</p>';
        echo '<a class="body-title-font" href="/create_your_own_drink/postDrink.php">Post a drink you created!</a>';
        echo '<p class="body-title-font">List of all your creations</p>';
        $sql = "SELECT drink_id, drink_name, drink_description FROM drinks WHERE create_by = '" . mysql_real_escape_string($user_id) . "'";
        $result = mysql_query($sql);
        
        if(!$result)
        {
            echo 'The drinks could not be displayed, please try again later.';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                echo 'No drinks created yet.';
            }
            else
            {
                //prepare the table
                echo '<table class="zebra" border="1">
                <tr>
                <th>Drink Name</th>
                <th>Description</th>
                </tr>';
                
                $rows = array();
                while($row = mysql_fetch_assoc($result))
                {
                    echo '<tr>';
                    echo '<td class="leftpart">';
                    echo '<h3><a href="displaydrinks.php?id=' . $row['drink_id'] . '">' . $row['drink_name'] . '</a></h3>';
                    echo '</td>';
                    echo '<td class="rightpart">';
                    echo $row['drink_description'];
                    echo '</td>';
                    echo '</tr>';
                    $rows[] = $row['drink_id'];
                }
                echo '</table>';
            }
        }
    }
    
    include 'footer.php';
    closeDB();
?>
