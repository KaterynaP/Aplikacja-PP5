<?php
if($_POST['sub_comment']){
    echo "Your comment successful added<br />";
    echo "<a href='index.php'>Back to main page</a>";
}else{
    echo "<form method=\"post\">
        <textarea name=\"comment_text\" required></textarea><br />
        <input type='hidden' name='movie_id' value='".$_GET['movie']."' />
        <input type=\"submit\" name=\"sub_comment\" value=\"comment\" />
    </form>";
}?>