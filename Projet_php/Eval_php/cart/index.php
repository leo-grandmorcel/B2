<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À ma zone</title>
    <link rel="stylesheet" href="/style/main.css">
    <?php
    include('../db.php');
    $is_connected = false;
    if (isset($_COOKIE['user_id'])){
        $user = getUser($_COOKIE['user_id'])->fetch_assoc();
        $result = getCart($_COOKIE['user_id']);
        $is_connected = true;
        $total = getTotalCart($user['user_id']);
    }else{
        header('Location: /login');
    }
    ?>
</head>
<body>
    <header role='banner' class='header'>
        <a class="button_header" id='button_home' href='/index'>Home</a>
        <div class="buttons">
            <?php
            if ($is_connected) {
                if ($user['role']=='admin') { ?>
                    <a class='button_header' href='/admin'>Admin</a>
                <?php } ?>
                <a class='button_header' href='/cart'>Cart</a>
                <a class='button_header' href='/sell'>Sell</a>
                <a class='account' href="/account?username=<?= $user['username'] ?>&user_id=<?= $user['user_id'] ?>">
                    <img class="account_img" src="/assets/profile_picture/<?= $user['profile_picture'] ?>">
                    <p id='username'><?= $user['username'] ?></p>
                </a>
            <?php } else { ?>
                <a class='button_header' href='/login'>Login</a>
                <a class='button_header' href='/register'>Register</a>
            <?php }
            ?>
        </div>
    </header>
    <div class='cart'>
        <div class='total'>
            <h3>Balance : <?=$user['balance']?>€</h3>
            <h3>Total : <?=$total?>€</h3>
            <?php if ($user['balance'] >= $total && $result->num_rows > 0) { ?>
                <form action='/validate' method='post'>
                    <input type='submit' class='button' id='button_green' name='validate' value='Validate'>
                </form>
            <?php } ?>
        </div>
        <h2>My Cart</h2>
        <?php
        while ($row = $result->fetch_assoc()) { ?>
            <div class='cart_item'>
                <img class='item_picture' src='../assets/item_picture/<?=$row['item_picture']?>'>
                <div>
                    <a href='/detail?name=<?= str_replace(' ', '', $row['name'])?>&item_id=<?= $row['item_id']?>'>
                        <h1 class='name'><?=$row['name']?></h1>
                    </a>
                    <p><?=$row['description']?></p>
                    <h3><?=$row['price']?>€</h3>
                    <h4> X<?=$row['number']?></h4>
                    <h4> Total : <?=$row['total']?>€</h4>
                </div>
                <form class='button_cart' method='post'>
                    <input type='hidden' name='item_id' value=<?=$row['item_id']?>>
                    <input type='hidden' name='number' value=<?=$row['number']?>>
                    <input type='submit' class='button' id='button_red' name='delete_button' value='Delete'>
                    <input type='submit' class='button' id='button_green' name='add_button' value='+'>
                    <input type='submit' class='button' id='button_red' name='sub_button' value='-'>
                </form>
                <?php 
                if(isset($_POST['add_button'])){
                    $item_id = $_POST['item_id'];
                    $number = $_POST['number'];
                    if (getStock($item_id) == $number) {
                        echo '<p> Maximum stock reached </p>';
                    } elseif (InsertCart($user['user_id'],$item_id,1)) {
                        header('Location: /cart');
                    } else {
                        echo '<p>Failed to add to cart </p>';
                    }
                }
                if(isset($_POST['sub_button'])){
                    $item_id = $_POST['item_id'];
                    if (RemoveCart($user['user_id'],$item_id,1)) {
                        header('Location: /cart');
                    } else {
                        echo '<p>Failed to add to cart </p>';
                    }
                }
                if(isset($_POST['delete_button'])){
                    $item_id = $_POST['item_id'];
                    $number = $_POST['number'];
                    for ($i=0; $i < $number; $i++) { 
                        if (!RemoveCart($user['user_id'],$item_id,1)){
                            echo '<p>Failed to remove from cart </p>';
                        }
                    }
                    header('Location: /cart');
                }
                ?>
            </div>
        <?php } ?>
    </div>
</body>
</html>