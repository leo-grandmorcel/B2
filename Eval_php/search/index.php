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
        $is_connected = true;
    } else {
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
    <div class='items'>
        <?php
        $result = GetSearchedItems($_GET['search']);
        while ($item = $result->fetch_assoc()) { ?>
        <form action="/detail" method="get">
                <input type='hidden' name='name' value=<?= str_replace(' ', '', $item['name']); ?>>
                <button class='item' name='item_id' value=<?= $item['item_id'] ?>>
                    <img class='item_picture' src='/assets/item_picture/<?= $item['item_picture'] ?>' />
                    <h1><?= $item['name'] ?></h1>
                    <h3><?= $item['price'] ?>€</h3>
                </button>
        </form>
        <?php }
        ?>
    </div>
</body>