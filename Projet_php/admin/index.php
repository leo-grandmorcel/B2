<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À ma zone</title>
    <link rel="stylesheet" href="/style/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <?php
    include('../db.php');
    $is_connected = false;
    if (!(isset($_COOKIE['user_id']))){
        header('Location: /login');
    }
    $user = getUser($_COOKIE['user_id'])->fetch_assoc();
    $is_connected = true;
    if ($user['role'] != 'admin'){
        header('Location: /index');
    }

    if (isset($_POST['remove_item'])) {
        DeleteItem($_POST['item_id']);
        header('Location: '.$_SERVER['REQUEST_URI']);
    }
    if (isset($_POST['remove_user'])) {
        DeleteUser($_POST['user_id']);
        header('Location: '.$_SERVER['REQUEST_URI']);
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
  <div class="all_tables">
      <h2>Items</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = getAllItems();
          while ($item = $result->fetch_assoc()) { ?>
            <tr>
              <td>
                <a href="/detail?name=<?= str_replace(' ', '', $item['name']); ?>&item_id=<?= $item['item_id'] ?>">
                    <img class="admin_picture" src="/assets/item_picture/<?= $item['item_picture'] ?>">
                </a>
              </td>
              <td>
                <?= $item['name'] ?>
              </td>
              <td>
                <?= $item['price'] ?>€
              </td>
              <td>
                <form method='post'>
                  <input type='hidden' name='item_id' value=<?= $item['item_id'] ?>>
                  <input type='submit' class='button' id='button_red' name='remove_item' value='Remove'>
                </form>
                <br>
                <form action="/edit/" method="post">
                    <input type="hidden" name="item_id" value=<?= $item['item_id'] ?>>
                    <input type='submit' class='button' id='button_yellow' name="edit" value='Edit'>
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <h2>Users</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Profile picture</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = getAllUsers();
        while ($user = $result->fetch_assoc()) { ?>
          <tr>
            <td>
              <a href="/account?username=<?= $user['username'] ?>&user_id=<?= $user['user_id'] ?>">
                  <img class="admin_picture" src="/assets/profile_picture/<?= $user['profile_picture'] ?>">
              </a>
            </td>
            <td>
              <?= $user['username'] ?>
            </td>
            <td>
              <?= $user['email'] ?>
            </td>
            <td>
              <form method='post'>
                <input type='hidden' name='user_id' value=<?= $user['user_id'] ?>>
                <input type='submit' class='button' id='button_red' name='remove_user' value='Remove'>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>