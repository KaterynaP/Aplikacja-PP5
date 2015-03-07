<h2>Most rented films</h2>
<table class="list">
    <tr>
        <th>Name</th>
        <th>Picture</th>
        <th>Price</th>
        <th>Category</th>
    </tr>
    <?php
    for($i = 0; $i < count($orderDesc); $i++){
        $item = $movie->fetchById($orderDesc[$i]['film_id']);
        echo "<tr>
                <td><a href='http://".$_SERVER['HTTP_HOST']."?page=main&movie=".$item[0]['id']."'>".$item[0]['name']."</a></td>
                <td><a href='http://".$_SERVER['HTTP_HOST']."?page=main&movie=".$item[0]['id']."'><img src='".$item[0]['picture']."' /></a></td>
                <td>".$item[0]['price']."</td>
                <td>".$item[0]['type']."</td>
            </tr>";
    }
    ?>
</table>

<h2>Most commented films</h2>
<table class="list">
    <tr>
        <th>Name</th>
        <th>Picture</th>
        <th>Price</th>
        <th>Category</th>
    </tr>
    <?php
    for($i = 0; $i < count($commentDesc); $i++){
        $item = $movie->fetchById($commentDesc[$i]['movie_id']);
        echo "<tr>
                <td><a href='http://".$_SERVER['HTTP_HOST']."?page=main&movie=".$item[0]['id']."'>".$item[0]['name']."</a></td>
                <td><a href='http://".$_SERVER['HTTP_HOST']."?page=main&movie=".$item[0]['id']."'><img src='".$item[0]['picture']."' /></a></td>
                <td>".$item[0]['price']."</td>
                <td>".$item[0]['type']."</td>
            </tr>";
    }
    ?>
</table>

<h2>All films</h2>
<table class="list">
    <tr>
        <th>Name</th>
        <th>Picture</th>
        <th>Price</th>
        <th>Category</th>
    </tr>
    <?php
    foreach($movies as $item){
        echo "<tr>
                <td><a href='http://".$_SERVER['HTTP_HOST']."?page=main&movie=".$item['id']."'>".$item['name']."</a></td>
                <td><a href='http://".$_SERVER['HTTP_HOST']."?page=main&movie=".$item['id']."'><img src='".$item['picture']."' /></a></td>
                <td>".$item['price']."</td>
                <td>".$item['type']."</td>
            </tr>";
    }
    ?>
</table>