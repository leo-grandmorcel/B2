<?php
include('../db.php');
if (isset($_GET['item_id'])) {
    $input = $_GET['item_id'];
    $item = getItem($input)->fetch_assoc();
    $username = getUser($item['user_id'])->fetch_assoc()['username'];
    $stock = getStock($item['item_id']);
}
if (isset($_COOKIE['user_id'])) {
    $user = getUser($_COOKIE['user_id'])->fetch_assoc();
}
?>
<html>

<head>
    <title>À ma zone</title>
    <link rel="stylesheet" href="../style/modify.css">
</head>
<header>
    <div class='header'>
        <button class="button_header" style="margin-left: 1vw;" onclick="window.location.href='../index'">Home</button>
        <div class="buttons">
            <?php
            if (isset($_COOKIE['user_id'])) {
                $user = getUser($_COOKIE['user_id'])->fetch_assoc();
                if (IsAdmin($_COOKIE['user_id'])) { ?>
                    <form method="get">
                        <button class="button_header" name="admin">Admin</button>
                    </form>
                <?php } ?>
                <form method="get">
                    <button class="button_header" name="sell">Sell</button>
                </form>
                <form method=get action='../account'>
                    <input type='hidden' name='username' value=<?= $user['username'] ?>>
                    <button class="account" name="user_id" value="<?= $user["user_id"] ?>"> <img class="account_img"
                            src="../assets/profile_picture/<?= $user['profile_picture'] ?>">
                        <p class="username">
                            <?= $user['username'] ?>
                        </p>
                    </button>
                </form>
            <?php } else { ?>
                <form method="get">
                    <button class="button_header" name='login'>Login</button>
                </form>
                <form method="get">
                    <button class="button_header" name='register'>Register</button>
                </form>
            <?php }
            ?>
            <form method="get">
                <button class="button_header" name="cart">Cart</button>
            </form>
        </div>
    </div>
</header>

<body>
<form method="post" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="item_name" maxlength="255" value="<?=$item['name'] ?>" required>
    <label>Price:</label>
    <input type="number" name="item_price" step="0.01" value="<?=$item['price']?>" required>
    <label>Stock:</label>
    <input type="number" name="stock" value="<?=getStock($item['item_id'])?>" required>
    <label>Description:</label>
    <textarea name="item_description" maxlength="1000" required><?=$item['description']?></textarea> 
    <label for="pictures">Select a picture:</label>
    <input type="file" name="pictures" value="upload">
    <input type="submit" name="modify" value="modify">
</form>
</body>
</html>
<?php
if (isset($_POST['modify'])) {
    $name = $_POST['item_name'];
    $price = $_POST['item_price'];
    $description = $_POST['item_description'];
    $picture = $_FILES['pictures'];
    $picture_name = $picture['name'];
    $picture_tmp_name = $picture['tmp_name'];
    $extension = pathinfo($picture_name, PATHINFO_EXTENSION);
    $picture_new_name = uniqid().'.' . $extension;
    $picture_destination = '../assets/item_picture/' . $picture_new_name;
    $stock = $_POST['stock'];
    if(!empty($name)){
        ModifyItemName($item_id, $name);
    }
    if(!empty($price)){
        ModifyItemPrice($item_id, $price);
    }
    if(!empty($description)){
        ModifyItemDescription($item_id, $description);
    }
    if($picture['size'] == 0 && $picture['error'] == 0){
        ModifyItemPicture($item_id, $picture_new_name);
        move_uploaded_file($picture_tmp_name, $picture_destination);
    }
    if(!empty($stock)){
        UpdateStock($item_id, $stock);
    }
    header('Location: '.$_SERVER['REQUEST_URI']);
}

if (isset($_GET['sell'])) {
    header('Location: ../sell');
} else if (isset($_GET['cart'])) {
    header('Location: ../cart');
} else if (isset($_GET['login'])) {
    header('Location: ../login');
} else if (isset($_GET['register'])) {
    header('Location: ../register');
} else if (isset($_GET['admin'])) {
    header('Location: ../admin');
}
?>
