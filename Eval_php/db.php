<?php
$mysqli = new mysqli("localhost", "root", "", "php_exam_db"); 
function getAllItems(string $sortby = "item_id",string $order = "DESC",int $stock = 1) : mysqli_result {
    global $mysqli;
    $query = "SELECT * FROM item JOIN stock ON item.item_id = stock.item_id WHERE stock.number >= ? ORDER BY item." . $sortby. " " . $order;
    return $mysqli->execute_query($query,[$stock]);
}
function getItem(int $item_id) : mysqli_result {
    global $mysqli;
    $query = "SELECT *, stock.number AS 'number' FROM item JOIN stock ON item.item_id=stock.item_id WHERE item.item_id = ?";
    return $mysqli->execute_query($query, [$item_id]);
}
function getAllUsers() : mysqli_result {
    global $mysqli;
    $query = "SELECT * FROM user WHERE role = 'user'";
    return $mysqli->execute_query($query);
}
function getUser(int $user_id) : mysqli_result {
    global $mysqli;
    $query = "SELECT * FROM user WHERE user_id = ?";
    return $mysqli->execute_query($query,[$user_id]);
}
function getCart(int $user_id) : mysqli_result {
    global $mysqli;
    $query = "SELECT *,stock.number AS 'stock_number', count(cart.item_id) AS 'number', sum(item.price) AS 'total' FROM cart JOIN item on cart.item_id=item.item_id JOIN stock ON stock.item_id = item.item_id WHERE cart.user_id = ? GROUP BY cart.item_id";
    return $mysqli->execute_query($query,[$user_id]);
}
function getTotal(int $user_id): mysqli_result{
    global $mysqli;
    $query = "SELECT sum(item.price) AS 'total' FROM cart JOIN item on cart.item_id=item.item_id WHERE cart.user_id = ?";
    return $mysqli->execute_query($query,[$user_id]);
}
function getAllUserInvoices(int $user_id ,string $sortby = "invoice_id", string $order = "ASC") : mysqli_result {
    global $mysqli;
    $query = "SELECT * FROM invoice WHERE user_id = ? ORDER BY " . $sortby. " " . $order;
    return $mysqli->execute_query($query,[$user_id]);
}
function getStock(int $item_id) : int {
    global $mysqli;
    $query = "SELECT * FROM stock WHERE item_id = ?";
    return $mysqli->execute_query($query, [$item_id])->fetch_assoc()['number'];
}
function InsertUser(string $email, string $username, string $password): bool{
    global $mysqli;
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "SELECT user_id FROM user WHERE email = ? OR username = ?";
    if ($mysqli->execute_query($query,[$email,$username])->num_rows > 0) {
        return False;
    }
    $query = "INSERT INTO user (email, username, password, profile_picture, role, balance) VALUES (?, ?, ?, ?, ?, ?)";
    return $mysqli->execute_query($query,[$email,$username,$password,'default.jpg','user',0]);
}

function InsertItem(int $user_id,string $description, string $item_pic, string $name, float $price, int $stock): bool{
    global $mysqli;
    $publication_date = date("Y-m-d H:m:s");
    $query = "SELECT * FROM item WHERE name=? AND user_id=?";
    $result = $mysqli->execute_query($query,[$name,$user_id]);
    if ($result->num_rows > 0) {
        return False;
    }
    $query = "INSERT INTO item (description, item_picture, name, price, publication_date, user_id) VALUES (?,?,?,?,?,?)";
    if (!$mysqli->execute_query($query,[$description,$item_pic,$name,$price,$publication_date,$user_id])){
        return false;
    }
    return InsertStock($mysqli->insert_id, $stock);
}
function GetUserId(string $email): int{
    global $mysqli;
    $query = "SELECT user_id FROM user WHERE email=?";
    return $mysqli->execute_query($query,[$email])->fetch_assoc()['user_id'];
}
function InsertStock(int $item_id, int $stock): bool{
    global $mysqli;
    $query = "INSERT INTO stock (item_id, number) VALUES (?,?)";
    return $mysqli->execute_query($query,[$item_id,$stock]);
}
function InsertCart(int $user_id, int $item_id, int $quantity) : bool {
    global $mysqli;
    $query = "INSERT INTO cart (item_id, user_id) VALUES (?,?)";
    for ($i = 0; $i < $quantity;$i++){
        if (!$mysqli->execute_query($query, [$item_id, $user_id])){
            return false;
        }
    }
    return true;
}

function UpdateStock(int $item_id, int $stock): bool{
    global $mysqli;
    $query = "UPDATE stock SET number = ? WHERE item_id = ?";
    return $mysqli->execute_query($query,[$stock,$item_id]);
}
function Login(string $email, string $password): bool{
    global $mysqli;
    $query = "SELECT Password FROM user WHERE email=?";
    $result = $mysqli->execute_query($query,[$email]);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            return True;
        }
    }
    return False;
}

function InsertInvoice(int $user_id,string $address, string $city, int $zip_code) : bool{
    global $mysqli;
    $transaction_date = date("Y-m-d H:m:s");
    $query = "INSERT INTO invoice (address, city, total, transaction_date, zip_code, user_id) VALUES (?,?,?,?,?,?)";
    return $mysqli->execute_query($query,[$address,$city,GetTotalCart($user_id),$transaction_date,$zip_code,$user_id]);
}
function RemoveCart(int $user_id, int $item_id, int $quantity) : bool {
    global $mysqli;
    $query = "DELETE FROM cart WHERE item_id = ? AND user_id = ? LIMIT 1";
    for ($i = 0; $i < $quantity;$i++){
        if (!$mysqli->execute_query($query, [$item_id, $user_id])){
            return false;
        }
    }
    return true;
}

function GetTotalCart(int $user_id) : float {
    global $mysqli;
    $query = "SELECT IFNULL(sum(item.price),0.0) AS 'total_price' FROM cart JOIN item ON cart.item_id=item.item_id WHERE cart.user_id=?";
    return $mysqli->execute_query($query,[$user_id])->fetch_assoc()['total_price'];
}
function GetUserItems(int $user_id,string $sortby = "item_id",string $order = "DESC"):mysqli_result {
    global $mysqli;
    $query = "SELECT * FROM item WHERE user_id=? ORDER BY " . $sortby. " " . $order;
    return $mysqli->execute_query($query,[$user_id]);
}

function ModifyUsername(int $user_id, string $username){
    global $mysqli;
    $query = "SELECT user_id FROM user WHERE username = ?";
    if ($mysqli->execute_query($query,[$username])->num_rows > 0) {
        return False;
    }
    $query = "UPDATE user SET username = ? WHERE user_id = ?";
    return $mysqli->execute_query($query, [$username, $user_id]);
}
function ModifyPassword(int $user_id, string $password){
    global $mysqli;
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE user SET password=? WHERE user_id = ?";
    return $mysqli->execute_query($query, [$password, $user_id]);
}
function ModifyEmail(int $user_id, string $email){
    global $mysqli;
    $query = "SELECT user_id FROM user WHERE email = ?";
    if ($mysqli->execute_query($query,[$email])->num_rows > 0) {
        return False;
    }
    $query = "UPDATE user SET email=? WHERE user_id = ?";
    return $mysqli->execute_query($query, [$email, $user_id]);
}
function ModifyProfilePicture(int $user_id, string $path){
    global $mysqli;
    $query = "UPDATE user SET profile_picture=? WHERE user_id = ?";
    return $mysqli->execute_query($query, [$path, $user_id]);
}
function UpdateBalance(int $user_id, float $money){
    global $mysqli;
    $query = "UPDATE user SET balance=? WHERE user_id=?";
    return $mysqli->execute_query($query, [$money, $user_id]);
}

function SetAdmin(int $user_id) : bool {
    global $mysqli;
    $query = "UPDATE user SET role='admin' WHERE user_id=?";
    return $mysqli->execute_query($query,[$user_id]);
}

function DeleteItem(int $item_id) : bool {
    global $mysqli;
    $query = 'SELECT item_picture FROM item WHERE item_id = ?';
    $result = $mysqli->execute_query($query,[$item_id])->fetch_assoc();
    if (file_exists('../assets/item_picture/'.$result['item_picture'])){
        unlink('../assets/item_picture/'.$result['item_picture']);
    }
    $query = "DELETE FROM stock WHERE item_id = ?";
    if (!$mysqli->execute_query($query,[$item_id])){
        return false;
    }
    $query = "DELETE FROM cart WHERE item_id = ?";
    if (!$mysqli->execute_query($query,[$item_id])){
        return false;
    }
    $query = "DELETE FROM item WHERE item_id = ?";
    return $mysqli->execute_query($query,[$item_id]);
}


function DeleteUser(int $user_id) : bool {
    global $mysqli;
    $query = 'SELECT item_picture FROM item WHERE user_id = ?';
    $result = $mysqli->execute_query($query,[$user_id]);
    while ($item = $result->fetch_assoc()){
        if (!DeleteItem($item['item_id'])){
            return false;
        }
    }
    $query = 'SELECT profile_picture FROM user WHERE user_id = ?';
    $result = $mysqli->execute_query($query,[$user_id])->fetch_assoc();
    if (file_exists('../assets/profile_picture/'.$result['profile_picture'])){
        unlink('../assets/profile_picture/'.$result['profile_picture']);
    }
    $query = "DELETE FROM cart WHERE user_id = ?";
    if (!$mysqli->execute_query($query,[$user_id])){
        return false;
    }
    $query = "DELETE FROM user WHERE user_id = ?";
    return $mysqli->execute_query($query,[$user_id]);
}

function ModifyItemName(int $item_id, string $name){
    global $mysqli;
    $query = "UPDATE item SET name = ? WHERE item_id = ?";
    return $mysqli->execute_query($query, [$name, $item_id]);
}
function ModifyItemPrice(int $item_id, float $price){
    global $mysqli;
    $query = "UPDATE item SET price = ? WHERE item_id = ?";
    return $mysqli->execute_query($query, [$price, $item_id]);
}
function ModifyItemDescription(int $item_id, string $description){
    global $mysqli;
    $query = "UPDATE item SET description = ? WHERE item_id = ?";
    return $mysqli->execute_query($query, [$description, $item_id]);
}
function ModifyItemPicture(int $item_id, string $path){
    global $mysqli;
    $query = "UPDATE item SET item_picture = ? WHERE item_id = ?";
    return $mysqli->execute_query($query, [$path, $item_id]);
}

function GetSearchedItems(string $search, string $sortby = "item_id", string $order = "DESC") : mysqli_result {
    global $mysqli;
    $query = "SELECT * FROM item WHERE name LIKE ? ORDER BY " . $sortby . " " . $order;
    if ($search == ""){
        return getAllItems();
    }
    return $mysqli->execute_query($query,["%".$search."%"]);
}
function IsAdmin(int $user_id) : bool {
    global $mysqli;
    $query = "SELECT role FROM user WHERE user_id = ?";
    $result = $mysqli->execute_query($query,[$user_id]);
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if ($row['role'] == "admin"){
            return True;
        }
    }
    return False;
}
function FilterItems(string $sortby, string $order="DESC" , int $stock =1) : mysqli_result {
    global $mysqli;
    $query = "SELECT * FROM item JOIN stock ON item.item_id = stock.item_id WHERE stock.number >= ? ORDER BY item." . $sortby. " " . $order;
    return $mysqli->execute_query($query,[$stock]);;
}
?>
