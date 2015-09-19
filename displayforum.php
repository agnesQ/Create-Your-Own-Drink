<?php
    include 'header.php';
    include 'forum_nav.php';
    require_once 'db_query.php';
    connectToDB();
    $sql = "SELECT
    topic_id,
    topic_name,
    topic_description,
    create_time,
    create_by
    FROM
    topics";
    
    $result = mysql_query($sql);
    closeDB();
    
    if(!$result)
    {
        echo 'The topics could not be displayed, please try again later.';
    }
    else
    {
        if(mysql_num_rows($result) == 0)
        {
            echo 'No topics defined yet.';
        }
        else
        {
            //prepare the table
            echo '<table border="1">
            <tr>
            <th>Category</th>
            <th>Last topic</th>
            </tr>';
            
            $rows = array();
            while($row = mysql_fetch_assoc($result))
            {
                echo '<tr>';
                echo '<td class="leftpart">';
                echo '<h3><a href="displaytopic.php?id=' . $row['topic_id'] . '">' . $row['topic_name'] . '</a></h3>' . $row['topic_description'];
                echo '</td>';
                echo '<td class="rightpart">';
                echo $row[create_by] . " on" . $row[create_time];
                echo '</td>';
                echo '</tr>';
                $rows[] = $row['topic_id'];
            }
            echo '</table>';
        }
    }
    
    include 'footer.php';
    
?>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                  setInterval(function(){
                              <?php for($i = 0, $size = count($rows); $i < $size; $i++) { ?>
                              <?php echo $i ?>
                              <?php echo $rows[$i] ?>
                              <?php } ?>
                              }, 1000);
                  }
                  );

                  
                  }
</script>