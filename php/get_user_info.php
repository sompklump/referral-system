<?php
class userUserInfo{
  function getUserDiscordId($rowid){
    require("msql.php");
    $userid = null;
    $sql = "SELECT * FROM users WHERE id = '$rowid'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_array($result)){
        $userid = $row['discord_id'];
      }
    }
    return $userid;
  }
  function getUserRowId($discordid){
    require("msql.php");
    $userid = null;
    $sql = "SELECT * FROM users WHERE discord_id = '$discordid'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_array($result)){
        $userid = $row['id'];
      }
    }
    return $userid;
  }
}
?>