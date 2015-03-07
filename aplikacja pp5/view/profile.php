<h1><?php echo $_SESSION['login']; ?> profile</h1>

<table>
    <tr>
        <th>№</th>
        <th>Movie</th>
        <th>Date of order</th>
        <th>Status</th>
    </tr>
    <?php
    if(count($orders)){
        foreach($orders as $item){
            $name = $movie->fetchNameById($item['film_id']);
            echo "
            <tr>
                <td>".$item['id']."</td>
                <td>".$name[0]['name']."</td>
                <td>".$item['order_date']."</td>
                <td>".$item['status']."</td>
            </tr>
        ";
        }
    }else{
        echo "<td colspan='3'>You don't have any orders</td>";
    }
    ?>
</table>