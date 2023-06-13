<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À ma zone</title>
    <link rel="stylesheet" href="/style/main.css">
    <?php
    include('db.php');
    $is_connected = false;
    if (isset($_COOKIE['user_id'])){
        $user = getUser($_COOKIE['user_id'])->fetch_assoc();
        $is_connected = true;
        if ($user['balance'] < getTotalCart($user['user_id'])) {
            header("Location: /cart");
        }
    }else{
        header("Location: /login");
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
    <form class='validate' method=post>
        <h2>Validate Cart</h2>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="city" placeholder="City" required>
        <input type="text" name="zip_code" placeholder="Zip Code" required>
        <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
        <input type="submit" class='button' id='button_green' value="Checkout">
    </form>
    <?php
    if(isset($_POST['address']) && isset($_POST['city']) && isset($_POST['zip_code'])){
        if (!(InsertInvoice($user['user_id'],$_POST['address'],$_POST['city'],$_POST['zip_code']))) {
            echo 'Error creating Invoice';
            return;
        }
        if (!(UpdateBalance($user['user_id'],$user['balance'] - getTotalCart($user['user_id'])))) {
            echo 'Error updating Balance';
            return;
        }
        $items = getCart($user['user_id']);
        while ($item = $items->fetch_assoc()) {
            if (!(UpdateStock($item['item_id'],$item['stock_number']-$item['number']))) {
                echo 'Error updating Stock';
                return;
            }
            if (!(RemoveCart($user['user_id'],$item['item_id'],$item['number']))){
                echo 'Error while removing Cart';
                return;
            }
        }
        echo 'Invoice created. Thank for buying on our website !';
    }
    ?>
</body>
</html>