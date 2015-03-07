<table class="list">
    <tr>
        <th>Name</th>
        <th>Picture</th>
        <th>description</th>
        <th>actors</th>
        <th>Price</th>
        <th>Rent</th>
        <?php
        if($_SESSION['login']){
            echo "<th>Comments</th>";
        }
        ?>
    </tr>
    <?php
        echo "
        <tr>
            <td>".$movieItem[0]['name']."</td>
            <td><img src='".$movieItem[0]['picture']."' /></td>
            <td>".$movieItem[0]['description']."</td>
            <td>".$movieItem[0]['actors']."</td>
            <td>".$movieItem[0]['price']."</td>
            <td>
                <form method='post'>
                    <input type='submit' onclick=\"document.cookie = 'movie=".$_GET['movie']."';\" name='rent' value='rent' />
                </form>
            </td>";
            if($_SESSION['login']){
                echo "<td><form method='post'>
                    <input type='submit' name='comments' value='comment' />
                </form></td>";
            }
        echo "</tr>";
    ?>
</table>