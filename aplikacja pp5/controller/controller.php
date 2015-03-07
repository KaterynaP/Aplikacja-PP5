<?php
if($_SESSION['login']){

    /************* Logout ************************/
    require_once("view/logout.php");

    if(isset($_POST) && $_POST['logout'] == 1){
        $_SESSION['login'] = "";
        echo "<script>window.location.href = 'http://".$_SERVER['HTTP_HOST']."'</script>";
    }
}else{
    if(isset($_POST)){

        $login = strip_tags(trim($_POST['login']));
        $pass = strip_tags(trim($_POST['pass']));

        require_once("view/authentication.php");

        /****************** Enter *******************/
        if($_POST['log_submit']){

            require_once("model/User.php");
            $user = new User();

            if($user->userVerification($login, md5($pass)) !== ""){
                $_SESSION['login'] = $login;
                echo "Enter success !";
                echo "<script>window.location.href = 'http://".$_SERVER['HTTP_HOST']."'</script>";
            }else{
                echo "Wrong Enter";
            }
        }
    }

}
/*********************** Routing **************************/
if(isset($_GET)){
    /************ Registration****************/
    require_once("model/Movie.php");
    $movie = new Movie();

    switch ($_GET['page']) {

        case "reg":
            require_once("view/reg.php");
            if($_POST['reg_submit']){

                $login = strip_tags(trim($_POST['login']));
                $pass = strip_tags(trim($_POST['pass']));
                $email = strip_tags(trim($_POST['email']));

                require_once("model/User.php");
                $user = new User();

                if(!$user->userVerification($login, md5($pass))){
                    $user->userRegistration($login, md5($pass), $email);
                    $_SESSION['login'] = $login;
                    echo "Well Done reg!";
                    echo "<script>window.location.href = 'http://".$_SERVER['HTTP_HOST']."'</script>";
                }else{
                    echo "Wrong reg";
                }
            }
            break;

        /************************ Main page ***************************/
        case "main":
            if($_GET['movie']){                                   // Movie item
                $movieItem = $movie->fetchById($_GET['movie']);
                require_once("view/movie.php");
                if($_POST && $_POST['comments'] || $_POST['sub_comment']){
                    require_once("view/comment.php");

                    if($_POST['sub_comment']){
                        $movie->insertComment($_POST['comment_text'], $_POST['movie_id']);
                    }
                }

            }else{                                               // Movie list
                require_once("model/Order.php");
                $order = new Order();
                $movies = $movie->fetchAll();
                $orderDesc = $order->selectOrdered();
                $commentDesc = $movie->selectCommented();
                require_once("view/movie_list.php");
            }
            if($_POST && $_POST['rent']){                   // Rent
                echo "<script>document.location.href = 'http://".$_SERVER['HTTP_HOST']."/?page=orders'</script>";
            }
            break;

        case "profile":
            /************************* Profile page *************************/
            if($_SESSION['login']){
                require_once("model/Order.php");
                require_once("model/User.php");
                $order = new Order();
                $user = new User();
                $userId = $user->getUserIdByLogin($_SESSION['login']);
                $orders = $order->selectUserOrder($userId[0]['id']);
                require_once("view/profile.php");
            }else{
                echo "Please register for enter your profile and see orders";
            }
            break;

        case "orders":
            /************************* Orders page *************************/
            if($_SESSION['login']){
                require_once("model/User.php");
                $user = new User();
                $userData = $user->getUserIdByLogin($_SESSION['login']);
                require_once("view/order.php");

                if($_POST['order']){                     // Insert order
                    require_once("model/Order.php");
                    $order = new Order();
                    $user_id = $user->getUserIdByLogin($userData[0]['login']);

                    if($order->insertOrder($user_id[0]['id'], $_COOKIE['movie'])){
                        $order->sendMail($userData[0]['email']);
                        echo "<script>document.location.href = 'http://".$_SERVER['HTTP_HOST']."/?page=profile'</script>";
                    }
                }
            }else{
                echo "Please register for enter your profile and see orders";
            }
            break;

        default:
            /*********** Default page same as main page ********************/
            if($_GET['movie']){                                   // Movie item
                $movieItem = $movie->fetchById($_GET['movie']);
                require_once("view/movie.php");
                if($_POST && $_POST['comments'] || $_POST['sub_comment']){
                    require_once("view/comment.php");

                    if($_POST['sub_comment']){
                        $movie->insertComment($_POST['comment_text'], $_POST['movie_id']);
                    }
                }

            }else{                                               // Movie list
                require_once("model/Order.php");
                $order = new Order();
                $movies = $movie->fetchAll();
                $orderDesc = $order->selectOrdered();
                $commentDesc = $movie->selectCommented();
                require_once("view/movie_list.php");
            }
            if($_POST && $_POST['rent']){                   // Rent
                echo "<script>document.location.href = 'http://".$_SERVER['HTTP_HOST']."/?page=orders'</script>";
            }
            break;
    }
}