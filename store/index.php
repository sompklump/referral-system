<?php
session_start();
require("../php/msql.php");
require("../php/get_user_info.php");

$user_points = null;
$error_msg = null;
$error_class = null;

if(!isset($_SESSION['discord_userId'])){
  echo "<script>location.replace('../login');</script>";
  die;
}

$user_creds = $_SESSION['discord_userArr'];

$sql = "SELECT * FROM users WHERE discord_id = '{$user_creds->id}'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_array($result)){
    $user_points = $row['points'];
  }
}

$user_data = new userUserInfo;

$disc_userid = $_SESSION['discord_userId'];
$userid = $user_data->getUserRowId($disc_userid);

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $product_id = $_POST['buy-btn'];
  $sql = "SELECT * FROM products WHERE id = '$product_id'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)){
      $price = $row['price'];
      $name = $row['name'];
      if($user_points >= $price){
        $error_msg = "Successfully bought $name";
        $error_class = "success";
      }
      else{
        $error_msg = "You cannot afford $name";
        $error_class = "danger";
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
    <title>Store - Requiem Refferal System</title>
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
            <a href="?logout" style="float:right" class="user-creds-text requm-link">Logout <i class="fas fa-sign-out-alt"></i></a>
          </div>
          <nav class="navbar-expand-sm">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link requm-link requm-link-active" href="#">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link requm-link" href="../store/">Store</a>
              </li>
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
          <span class="store-header"><h4>Store</h4></span>
          <div class="container-fluid">
            <div class="row">
              <?php
              $sql = "SELECT * FROM products";
              $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                  echo "<div class=\"col-sm\">
                              <div class=\"store-item\">
                                <label for=\"price\">{$row['name']}</label>
                                &nbsp;
                                <br>
                                <span class=\"store-price\" name=\"price\">{$row['price']} points</span>
                                &nbsp;
                                <br>
                                <button type=\"submit\" class=\"btn btn-primary\" name=\"buy-btn\" value=\"{$row['id']}\">Buy</button>
                              </div>
                            </div>";
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