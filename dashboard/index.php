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
    <title>Dashboard - Requiem Refferal System</title>
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
            <!--<button style="float:left;margin-right: 20px;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>--->
            <img class="user-creds-avatar" src="https://cdn.discordapp.com/avatars/<?= $user_creds->id ?>/<?= $user_creds->avatar ?>.png" alt="profile avatar">
            <span class="user-creds-username user-creds-text"><p><?= $user_creds->username."#".$user_creds->discriminator ?></p></span>
            <font color="white"><span class="user-creds-text"><?= $user_points ?> points</span></font>
          </div>
          <nav class="navbar-expand-sm">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link requm-link requm-link-active" href="#">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link requm-link" href="../store/">Store</a>
              </li>
              <li class="nav-item">
                <a class="nav-link requm-link" href="../cart/">Cart</a>
              </li>
              <a href="?logout" class="navbar-brand requm-link">Logout <i class="fas fa-sign-out-alt"></i></a>
            </ul>
          </nav>
          
        </nav>
      </div>
      &nbsp;
      <?php
          $sql = "SELECT * FROM invites WHERE user = '$userid'";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) <= 0){
            echo "<h3>You don't have any refferal links</h3>";
          }
          else{
            echo "<h3>Your invite links!</h3>
        <table>
          <tr>
            <th>Date created</th>
            <th>Last used</th>
            <th>Total uses</th>
            <th>Link</th>
          </tr>
          <tr>";
            $sql = "SELECT * FROM invites WHERE user = '$userid'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_array($result)){
                $created_date = date("d/m/Y", strtotime($row['date_created']));
                echo "<td>$created_date</td>";
                if(!empty($row['last_used'])){
                  $last_used_date = date("d/m/Y", strtotime($row['last_used']));
                  echo "<td>$last_used_date</td>";
                }
                else{
                  echo "<td>Null</td>";
                }
                echo "<td>{$row['uses']}</td>";
                echo "<td><a target='_blank' href='../openreferral?ref=". urlencode($row['referral_link']) ."'>{$row['referral_link']}</a></td>";
              }
            }
            echo "
            </tr>
        </table>
        ";
          }
      ?>
    </div>
  </body>
</html>
