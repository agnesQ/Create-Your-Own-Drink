<?php
    include 'header.php';
    require_once 'db_query.php';
    connectToDB();
    
            //do a query for the topics
            $sql = "SELECT
            drink_name,
            drink_description,
            create_date,
            ingradients
            user_id,
            user_name,
            img_url
            FROM
            drinks
            WHERE
            drink_id = " . mysql_real_escape_string($_GET['drink_id']);
            
            $result = mysql_query($sql);
            
            if(!$result)
            {
                //echo 'The mix could not be displayed, please try again later 2.';
                echo $sql;
            }
            else
            {
                if(mysql_num_rows($result) == 0)
                {
                    echo 'The drink seems to be empty actually.';
                }
                else
                {
                    echo '<h3>Drink: ' . $row['drink_name'] . '</h3>';
                    //prepare the table
                    echo '<table class="zebra" border="1">
                    <tr>
                    <th>Description</th>
                    <th>Created at</th>
                    </tr>';
                    
                    $row = mysql_fetch_assoc($result)
                    
                        echo '<tr>';
                        echo '<td class="leftpart">';
                        //echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
                        echo '<h3>' . $row['drink_description'] . '</h3>';
                        echo '<img src="/create_your_own_drink/' 
                        echo $row['img_url'].'alt="coffee logo" height="150">';
                        echo '</td>';
                        echo '<td class="rightpart">';
                        echo date('d-m-Y', strtotime($row['create_date']));
                        echo '</td>';
                        echo '</tr>';
                        $ingredients['ingradients'];
            
                    echo '</table>';
                    echo '<div id="canvas_container"></div>';
                    echo '<div id="test"></div>';
                }
            }
        
    
    include 'footer.php';
    closeDB();
?>