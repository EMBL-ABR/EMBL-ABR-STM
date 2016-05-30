<!doctype html>

<!--Copyright 2015 Vasileios Lapatas

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an "AS IS" BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License.
-->

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="EMBL Australian Bioinformatics Resource - Search for Training Materials">

	<title>EMBL-ABR STM</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="http://digg.googlecode.com/files/Class-0.0.2.js"></script>
	<script type="text/javascript" src="js/search.js"></script>

	<script type="text/javascript">

		$(function() {
			$('#menu').load('menu.html');
		});

		var s = 5;
		$(document).ready( function() {

			$('#countdown').html(s);
			setInterval(function() {
				s--;
				$('#countdown').html(s);
				if(s == 0) {
					window.location.replace("sources.html");
				}
			}, 1000);
		});

	</script>

</head>
<?php

$email    = $_GET['email'];
$url      = $_GET['url'];
$reason   = $_GET['reason'];


$json = '{"email": "'.$email.'", "url": "'.$url.'", "reason: "'.$reason.'"}';

$requests = json_decode(file_get_contents('requests.json'), true);

array_push($requests, $json);

file_put_contents('requests.json', json_encode($requests));


?>

<body>

<div id="layout">
	<!-- Menu toggle -->
	<a href="#menu" id="menuLink" class="menu-link">
		<!-- Hamburger icon -->
		<span></span>
	</a>

	<div id="menu"></div>

	<div id="main">
		<div class="header">
			<img src="img/logo.png"></img>
			<h2>EMBL-ABR Search for Training Materials</h2>
		</div>

		<div class="content">
			<h2 class="content-subhead">Request Sent Successfully</h2>
			<p>
				Thank you for your interest in EMBL-ABR STM. We will process your request and get back to you.
			</p>
			<p>
				redirecting in: <span id="countdown"></span>
			</p>
		</div>
	</div>
</div>
</body>
