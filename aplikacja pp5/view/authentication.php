<form method="post">
    <input type="text" name="login" placeholder="login" /><br />
    <input type="password" name="pass" placeholder="password" /><br />
    <button name="log_submit" type="submit" value="1">enter</button>
    <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/?page=reg">registration</a>
</form>