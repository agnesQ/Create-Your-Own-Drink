<?php
    include 'header.php';
    include 'forum_nav.php';
    require_once 'db_query.php';
    connectToDB();
    //first select the category based on $_GET['cat_id']
    $sql = "SELECT topic_id, topic_name, drink_id FROM topics WHERE topic_id = '" . mysql_real_escape_string($_GET['topic_id']) . "'";
    
    $result = mysql_query($sql);
    
    if(!$result)
    {
        echo 'The topic could not be displayed, please try again later.' . mysql_error();
    }
    else
    {
        if(mysql_num_rows($result) == 0)
        {
            echo 'This topic does not exist.';
        }
        else
        {
            //display category data
            $row = mysql_fetch_assoc($result);
            echo '<h2>' . $row['topic_name'] . '</h2>';
            //do a query for the topics
            $sql = "SELECT img_url FROM drinks WHERE drink_id = $drink_id";
            $result = mysql_query($sql);
            echo '<h3><a href="displaydrink.php?id=' . $row['drink_id'] . '>'. '<img src="/create_your_own_drink/'. $result['img_url'].'alt="coffee logo" height="150"></a></h3>'
            $sql = "SELECT
            comments.comment_topic,
            comments.comment_content,
            comments.post_date,
            comments.post_by,
            users.user_id,
            users.user_name
            FROM
            comments
            LEFT JOIN
            users
            ON
            comments.post_by = users.user_id
            WHERE
            comments.comment_topic = " . mysql_real_escape_string($_GET['topic_id']);
            
            $result = mysql_query($sql);
            
            if(!$result)
            {
                echo 'The comments could not be displayed, please try again later.';
            }
            else
            {
                if(mysql_num_rows($result) == 0)
                {
                    echo 'There are no comments in this topic yet.';
                }
                else
                {
                    //prepare the table
                    echo '<table border="1">
                    <tr>
                    <th>Comments</th>
                    <th>Created at</th>
                    </tr>';
                    
                    while($row = mysql_fetch_assoc($result))
                    {
                        echo '<tr>';
                        echo '<td class="leftpart">';
                        echo '<h3>' . $row['comment_content'] . '</h3>';
                        echo '</td>';
                        echo '<td class="rightpart">';
                        echo date('d-m-Y', strtotime($row['post_date']));
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                }
                $form_reply = '<form method="post" action="creat_comment.php?id=' . $_GET['topic_id'] . '">
                <textarea name="comment_content"></textarea>
                <input type="submit" value="Submit reply" />
                </form>';
                echo '<br/>';
                echo $form_reply;
            }
        }
    }
    
    include 'footer.php';
    closeDB();
?>