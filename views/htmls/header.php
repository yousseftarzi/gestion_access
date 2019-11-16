<!DOCTYPE HTML>
<!--
	Industrious by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>

<head>
	<title>Generic Page - Industrious by TEMPLATED</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" href="assets/css/main.css" />
</head>

<body class="is-preload">

	<!-- Header -->
	<header id="header">
		<a class="logo" href="index.html">Industrious</a>
		<nav>
			<a href="#menu">Menu</a>
		</nav>
	</header>

	<!-- Nav -->


	<?php
	if( isset($_SESSION['roleUser']) ){ 
		if( $_SESSION['roleUser'] == 'visiteur'){ ?>

		<nav id="menu">
		<ul class="links">
			<li><a href="?controller=Home&action=homeVisiteur"> Acceuil </a> </li>
			<li> <a href="?controller=Home&action=logout"> logout</a> </li>
		</ul>
	</nav>

<?php
		}
?>

<?php

	 if ($_SESSION['roleUser'] == 'employe') { ?>
	 <nav id="menu">
		<ul class="links">

		 	<li><a href="?controller=Home&action=homeEmploye"> Acceuil </a> </li>
			<li> <a href="?controller=Home&action=logout"> logout</a> </li>

		</ul>
	</nav>

<?php
	}
?>

	<?php
	 if($_SESSION['roleUser'] == 'superieur'){ ?>
	
<nav id="menu">
		<ul class="links">

			<li><a href="?controller=Home&action=homeSuperieur"> Acceuil </a> </li>
			<li> <a href="?controller=Home&action=logout"> logout</a> </li>


</ul>
	</nav>
<?php
 	} 
}
	else{ ?>
 	<nav id="menu">
		<ul class="links">
		<li><a href="?controller=Home&action=index"> Acceuil </a> </li>
</ul>
</nav>

	<?php
	} ?>

	<!-- Heading -->
	<!-- Main -->