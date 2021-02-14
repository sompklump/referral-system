<?php
/*
//
// Author: Ole Anton Hagen
// Purpose and made for Requiem Community
//
*/

session_start();
require("php/msql.php");
require("php/functions.php");

$functions = new BasicFunctions;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
}
?>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Referral System - Requiem</title>

		<link rel="icon" type="image/png" href="assets/img/logo.png">

		<meta name="title" content="Requiem">
		<meta name="description" content="We provide a home for anyone and everyone looking for a relaxing place to play games and make new friends along the way.">
		<meta name="keywords" content="Requiem, Community, Gaming, Sea of Thieves, ARK, Minecraft, FiveM">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">

		<meta property="og:title" content="Requiem">
		<meta property="og:image" content="assets/img/logo.png">
		<meta property="og:description" content="We provide a home for anyone and everyone looking for a relaxing place to play games and make new friends along the way.">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="assets/fontawesome-free-5.14.0-web/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
		<link href="core/css/normalizer.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="assets/css/style.css?<?= filemtime("assets/css/style.css") ?>">
	</head>

	<body>
		<div class="navbar">
			<div class="content"> <a class="call-btn" href="">Login</a>  <a href="">How?</a>  <a href="">What?</a>  <a href="">Why?</a>
				<img href="#" class="logo" src="core/assets/img/logo.webp">
			</div>
		</div>
		<div class="header">
			<header>
				<div class="content">
					<h1 class="no head">Requiem</h1>
					<h1 class="head">Refer a friend</h1>
					<p class="under">Refer Friends, Get Rewarded!</p>
					<div class="button">
						<div class="button__bg"></div>
						<a href="">
							<div class="button__inner"> <i class="material-icons">navigate_next</i>
							</div>
						</a>
					</div>
				</div>
			</header>
			<div class="sec what">
				<div class="content">
					<h2>What?</h2><span>We’ve always been thankful for our loyal community members, and are constantly looking for new ways to thank those superstars. We started with giveaways, events, titles.. and now our next big step is here! We would like to invite you to be part of our never ending growth.</span>
				</div>
			</div>
			<div class="sec why"></div>
			<div class="sec how">
				<div class="content">
					<h2>How?</h2><span>When you login your Requiem dashboard, you'll be able able to create your own invite link. Anybody that uses your link to join our community will be counted as a referral</span>
					<div class="browser">
						<div class="browser-top">
							<div class="browser-buttons">
								<div class="browser-btn red"></div>
								<div class="browser-btn orange"></div>
								<div class="browser-btn green"></div>
							</div>
							<div class="search">
								<div style="cursor: pointer;" onclick="typerRefreshPage()">
									<i class="fas fa-redo-alt"></i>
								</div>
								&nbsp;
								&nbsp;
								<a id="randomLinkHeader" class="requiem-link" target="_blank" href="#"><span style="color:#aaaaaa;">https://</span><span style="color:white;">invite.requiem.gg/</span><span class="not-typing" id="randomLinkName" style="color:#e6c200;"></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="sec call"></div>
			<div class="cookie-banner" style="display: none">
				<p>By using our website, you agree to our <a href="#">cookie policy</a></p>
				<button onclick="cookieAccept()">Accept</button><button onclick="cookieDenied()">Deny</button>
			</div>
			<footer></footer>
			<script src="core/js/typewriter.js?<?= filemtime("core/js/typewriter.js") ?>"></script>
			<script src="core/js/cookie.js?<?= filemtime("core/js/cookie.js") ?>"></script>
		</div>
	</body>
</html>