<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À ma zone</title>
    <link rel="stylesheet" href="/style/main.css">
    <?php
    include ('../db.php');
    $is_connected = false;
    if (isset($_COOKIE['user_id'])) {
        header('Location: /index');
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
    </header>
    <div class='login'>
        <h1>Login</h1>
        <form method="post">
            <label>Email :</label>
            <input type="email" name="email" required>
            <label>Password :</label>
            <input type="password" name="password" required>
            <br>
            <input type="submit" class='button' id='button_green' name="login" value="login">
        </form>
        <?php
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (Login($email, $password)) {
                $u_id = GetUserId($email);
                setcookie("user_id", $u_id, time() + (86400 * 30), "/");
                header('Location: /index');
            } else {
                echo "Error: bad credentials.";
            }
        }
        ?>
    </div>
</body>
</html>