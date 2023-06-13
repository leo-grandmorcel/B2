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
    if (!(isset($_COOKIE['user_id']))) {
        header('Location: /login');
    }
    if (!(isset($_POST['item_id']))) {
        header('Location: /index');
    }
    $user = getUser($_COOKIE['user_id'])->fetch_assoc();
    $is_connected = true;
    $item = getItem(intval($_POST['item_id']))->fetch_assoc();
    if (!($item['user_id'] == $user['user_id'] || $user['role'] == 'admin')) {
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
    <div class='modify'>
        <img class='detail_picture' src='/assets/item_picture/<?= $item['item_picture'] ?>' />
        <form method="post" action='/edit/' enctype="multipart/form-data">
            <div class='modify_content'>
                <div class='modify_form'>
                    <input type="hidden" name="item_id" value=<?= $item['item_id'] ?>>
                    <label>Name :</label>
                    <input type="text" name="item_name" placeholder="<?= $item['name'] ?>">
                    <label>Price :</label>
                    <input type="text" name="item_price" placeholder="<?= $item['price'] ?>">
                    <label>Description :</label>
                    <textarea maxlengt='1000' name="item_description" placeholder="<?= $item['description'] ?>"></textarea>
                    <input type="number" name="item_stock" placeholder="<?= $item['number'] ?>">
                    <input type='submit' class='button' id='button_edit' name="modify" value="Edit">
                </div>
                <div class='modify_picture'>
                    <input type="file" name="item_picture" id="item_picture">
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['modify'])) {    
            if(!(empty($_POST['item_name']))){
                $item['name'] = $_POST['item_name'];
                ModifyItemName($_POST['item_id'], $item['name']);
            }
            if(!(empty($_POST['item_price']))){
                $item['price'] = floatval($_POST['item_price']);
                ModifyItemPrice($_POST['item_id'], $item['price']);
            }
            if(!(empty($_POST['item_description']))){
                $item['description'] = $_POST['item_description'];
                ModifyItemDescription($_POST['item_id'], $_POST['item_description']);
            }
            if(!(empty($_POST['item_stock']))){
                $item['number'] = $_POST['item_stock'];
                UpdateStock($_POST['item_id'], $_POST['item_stock']);
            }
            if($_FILES['item_picture']['error'] == 0 && $_FILES['item_picture']['size'] > 0){
                $extension = pathinfo($_FILES['item_picture']['name'], PATHINFO_EXTENSION);
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if ($_FILES['item_picture']['size'] > 5 * 1024 * 1024) {
                    echo '<p>File must be less than 5MB.</p>';
                    return;
                }
                if (!(in_array($extension, $extensions_autorisees))) { ?>
                    <p>File must be jpg, jpeg, gif, or png.</p>
                    <?php return;
                }
                unlink('../assets/item_picture/' . $item['item_picture']);
                $item['item_picture'] = uniqid() . '.' . $extension;
                ModifyItemPicture($item['item_id'], $item['item_picture']);
                move_uploaded_file($_FILES['item_picture']['tmp_name'], '../assets/item_picture/' . $item['item_picture']);
            }
            header('Location: /detail?name=' .$item['name']. '&item_id='. $item['item_id']);
        }
        ?>
    </div>
</body>
</html>
