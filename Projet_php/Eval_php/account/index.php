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
    if (isset($_COOKIE['user_id'])){
        $user = getUser($_COOKIE['user_id'])->fetch_assoc();
        $is_connected = true;
    }
    if(isset($_GET['user_id'])){
        $visited_user = getUser($_GET['user_id'])->fetch_assoc();
    } elseif ($is_connected) {
        header('Location: /account/?username='.$user['username'].'&user_id='.$user['user_id']);
    }else{
        header('Location: /index');
    }
    if ($is_connected && $user['user_id'] == $visited_user['user_id']){
        $is_owner = true;
    }
    if(isset($_POST['balance'])) {
        UpdateBalance($user['user_id'], floatval($_POST['money']) + $user['balance']);
        header('Location: '.$_SERVER['REQUEST_URI']);
    }
    if (isset($_POST['account'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $profile_pic = $_FILES['picture'];
        $picture_name = $profile_pic['name'];
        $picture_tmp_name = $profile_pic['tmp_name'];
        $extension = pathinfo($picture_name, PATHINFO_EXTENSION);
        $picture_new_name = uniqid().'.' . $extension;
        $picture_destination = '../assets/profile_picture/' . $picture_new_name;
        if (!empty($email)) {
            ModifyEmail($user['user_id'],$email);
        }
        if (!empty($username)) {
            ModifyUsername($user['user_id'], $username);
            $user['username'] = $username;
        }
        if (!empty($password)) {
            ModifyPassword($user['user_id'], $password);
            
        }
        if(!($profile_pic['size']==0 && $profile_pic['error']==0)){
            echo "bite";
            ModifyProfilePicture($user['user_id'], $picture_new_name);
            move_uploaded_file($picture_tmp_name, $picture_destination);
        }
        header('Location: /account/?username='.$user['username'].'&user_id='.$user['user_id']);
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
    <div class='profile'>
        <img class='profile_picture' src='/assets/profile_picture/<?=$visited_user['profile_picture']?>'>
        <div class='profile_content'>
            <h1><?=$visited_user['username']?></h1>
            <?php 
            if ($is_owner) { ?>
                <h3>Balance : <?=$user['balance']?>€</h3>
                <form method='post'>
                    <input type="number" name='money' required>
                    <input type='submit' class='button' id='button_green'  name="balance" value="Add">
                </form>
                <form method='post'>
                    <label>Email:</label>
                    <input type='email' name='email' placeholder=<?=$user['email']?>>
                    <label>Username:</label>
                    <input type='text' name='username' placeholder=<?=$user['username']?>>
                    <label>Password:</label>
                    <input type='password' name='password'>
                    <input type='submit' class='button' id='button_green' name='account' value='Update'>
                </form>
                <form action="/logout" method="get">
                    <input class='button' id='button_logout' type="submit" name="logout" value="Logout">
                </form>
            <?php } else { ?>
                <h3>Email : <?=$visited_user['email']?></h3>
                <h3>Balance : <?=$visited_user['balance']?>€</h3>
            <?php } ?>
        </div>
    </div>
    <?php
    $items = GetUserItems($visited_user['user_id']);
    if ($items->num_rows > 0){ ?>
        <div>
            <h2>Items for sale : </h2>
            <div class='items'>
                <?php while($row = $items->fetch_assoc()){ ?>
                    <form class='item' action='/detail' method='get'>
                        <input type='hidden' name='name' value=<?=$row['name']?>>
                        <button class='item' name='item_id' value=<?=$row['item_id']?>>
                            <img class='item_picture' src='/assets/item_picture/<?=$row['item_picture']?>'/>
                            <h1> <?=$row['name']?></h1>
                            <h3><?=$row['price']?>€</h3>
                        </button>
                    </form>
                <?php 
                } ?>
            </div>
        </div>
    <?php }
    if ($is_owner) {
        $invoices = getAllUserInvoices($user['user_id']);
        if ($invoices->num_rows > 0) { ?>
        <div>
            <h2>Invoices</h2>
            <div class="invoices">      
                <?php while($row = $invoices->fetch_assoc()) { ?>
                    <div class='invoice'>
                        <h3>Transaction date: <?=$row['transaction_date']?></h3>
                        <h3>Billing address: <?=$row['address']?></h3>
                        <h3>Billing city: <?=$row['city']?></h3>
                        <h3>Zip code: <?=$row['zip_code']?></h3>
                        <h3>Total: <?=$row['total']?>€</h3>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php }
    } ?>
</body>
</html>