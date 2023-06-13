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
    $is_owner = false;
    if (isset($_GET['item_id'])) {
        $item = getItem($_GET['item_id'])->fetch_assoc();
        $username = getUser($item['user_id'])->fetch_assoc()['username'];
        $stock = getStock($item['item_id']);
    }
    if (isset($_COOKIE['user_id'])) {
        $user = getUser($_COOKIE['user_id'])->fetch_assoc();
        $is_connected = true;
    }
    if ($is_connected && $user['user_id'] == $item['user_id']) {
        $is_owner = true;
    }
    if (isset($_POST['detail'])) {
        $item_id = $_POST['item_id'];
        $quantity = $_POST['quantity'];
        if (InsertCart($user['user_id'], $item_id, $quantity)) {
            header('Location: /index');
        } else {
            echo "Failed to add to cart";
        }
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
    <div class='detail'>
        <img class='detail_picture' src='/assets/item_picture/<?= $item['item_picture'] ?>' />
        <div class='detail_content'>
            <h1><?= $item['name'] ?></h1>
            <h3>Seller : 
                <a href="/account?username=<?= $username ?>&user_id=<?= $item['user_id'] ?>"><?= $username ?></a>
            </h3>
            <p><?= $item['description'] ?></p>
            <h3>Price : <?= $item['price'] ?>€</h3>
            <h3>Stock : <?= $stock ?></h3>
            <?php 
            if ($is_connected) {
                if ($is_owner) { ?>
                    <form action="/edit/" method="post">
                        <input type="hidden" name="item_id" value=<?= $item['item_id'] ?>>
                        <input type='submit' class='button' id='button_edit' name="edit" value='Edit'>
                    </form>
                <?php } else { ?>
                    <form method="post">
                        <input type='hidden' name="item_id" value=<?= $item['item_id'] ?>>
                        <input type='number' name="quantity" min="1" max=<?= $stock ?> value="1">
                        <input type='submit' class='button' id='button_green' name="detail" value='Add to cart'>
                    </form>
                <?php }
            } ?>
        </div>
    </div>
</body>
</html>