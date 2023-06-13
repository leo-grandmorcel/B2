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
    <div class="sell">
        <h1>Sell</h1>
        <form method="post" enctype="multipart/form-data">
            <label>Name :</label>
            <input type="text" name="item_name" maxlength="255" required>
            <label>Price :</label>
            <input type="number" step="0.01" name="item_price" required>
            <label>Stock :</label>
            <input type="number" name="stock" value="1" required>
            <label>Description :</label>
            <textarea name="item_description" maxlength="1000" required></textarea> 
            <label for="pictures">Select a picture :</label>
            <input type="file" name="pictures" value="upload" required>
            <input type='submit' class='button' id='button_sell' name="sell" value="sell">
        </form>
        <?php
        if (isset($_POST['sell']) && $_FILES['pictures']['error'] == 0){
            if ($_FILES['pictures']['size'] <= 5 * 1024 * 1024) {
                $extension = pathinfo($_FILES['pictures']['name'], PATHINFO_EXTENSION);
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                $picture_new_name = uniqid() . '.' . $extension;
                if (!(in_array($extension, $extensions_autorisees))) {
                    echo '<p>File must be jpg, jpeg, gif, or png.</p>';
                    return;
                }
                if (InsertItem($user['user_id'], $_POST['item_description'], $picture_new_name, $_POST['item_name'], $_POST['item_price'], $_POST['stock'])) {
                    move_uploaded_file($_FILES['pictures']['tmp_name'], '../assets/item_picture/' . $picture_new_name);
                    header("Location: /index");
                } else {
                    echo '<p>Error: item already in use, please choose another one. </p>';
                }
            }else {
                echo '<p>File must be less than 5MB.p>';
            }
        }
        ?>
    </div>
</body>
</html>