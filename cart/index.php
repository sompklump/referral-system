<?php
session_start();
require("../php/msql.php");
require("../php/get_user_info.php");

$user_points = null;
$error_msg = null;
$error_class = null;
$cart = array();

$user_data = new userUserInfo;
$user_creds = $_SESSION['discord_userArr'];
$disc_userid = $_SESSION['discord_userId'];
$userid = $user_data->getUserRowId($disc_userid);

if(!isset($_SESSION['discord_userId'])){
  echo "<script>location.replace('../login');</script>";
  die;
}

if(isset($_SESSION['requiem-cart'])){
  $cart = json_decode($_SESSION['requiem-cart']);
}

$sql = "SELECT * FROM users WHERE discord_id = '{$user_creds->id}'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_array($result)){
    $user_points = $row['points'];
  }
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(isset($_POST['buy-btn'])){
    $sql = "SELECT * FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result)){
      }
    }
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="assets/css/fontawesome-free-5.14.0-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style.css?<?= filemtime("../assets/css/style.css") ?>" rel="stylesheet" type="text/css">
    <link href="../assets/css/custom.css?<?= filemtime("../assets/css/custom.css") ?>" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <title>Cart - Requiem Refferal System</title>
  </head>
  <body>
    <div>
      <div class="pos-f-t">
        <!---<div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
        <button id="openSettings_btn" class="btn btn-primary">Settings</button>
        <br>
        </div>
        </div>--->
        <nav class="navbar navbar-dark bg-dark">
          <div class="user-creds">
            <img class="user-creds-avatar" src="https://cdn.discordapp.com/avatars/<?= $user_creds->id ?>/<?= $user_creds->avatar ?>.png" alt="profile avatar">
            <span class="user-creds-username user-creds-text"><p><?= $user_creds->username."#".$user_creds->discriminator ?></p></span>
            <font color="white"><span class="user-creds-text"><?= $user_points ?> points</span></font>
          </div>
          <nav class="navbar-expand-sm">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link requm-link" href="../dashboard/">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link requm-link" href="../store/">Store</a>
              </li>
              <li class="nav-item">
                <a class="nav-link requm-link requm-link-active" href="#">Cart</a>
              </li>
              <a href="?logout" class="navbar-brand requm-link">Logout <i class="fas fa-sign-out-alt"></i></a>
            </ul>
          </nav>
        </nav>
      </div>
      &nbsp;
      <div class="alert alert-<?= $error_class ?>" role="alert">
        <?= $error_msg ?>
      </div>
      <div class="store-shop">
        <form method="post">
          <span class="store-header"><h4>Cart</h4></span>
          <div class="container-fluid">
            <div class="row">
              <?php
              if(count($cart) > 0){
                $sql = "SELECT * FROM products";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_array($result)){
                    if(in_array($row['id'], $cart)){
                      echo "<div class=\"col-sm\">
                                  <div class=\"store-item\">
                                    <label for=\"price\">{$row['name']}</label>
                                    &nbsp;
                                    <br>
                                    <span class=\"store-price\" name=\"price\">{$row['price']} points</span>
                                  </div>
                                </div>";
                    }
                  }
                }
              }
              ?>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>