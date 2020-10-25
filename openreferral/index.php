<?php
session_start();
require("../php/msql.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="assets/css/fontawesome-free-5.14.0-web/css/all.min.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <title>Open link - Requiem Refferal</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-180654987-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-180654987-2');
    </script>
  </head>
  <body>
    <?php
    if(isset($_GET['ref'])){
      $discord_link = null;
      $sql = "SELECT discord_link FROM invites WHERE referral_link = '".mysqli_real_escape_string($conn, $_GET['ref'])."'";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
          $discord_link = $row['discord_link'];
        }
      }
      if(!empty($discord_link)){
        echo "<script>location.replace('{$discord_link}');</script>";
      }
    }
    ?>
  </body>
</html>