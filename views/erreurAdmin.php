<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title></title>
</head>

<body>

	<H2> Erreur : <?php echo $titreErreur; ?></H2>
	<H4> <?php   echo $messageErreur; ?> </H4>
	<?php if ($lienRetour != "") {
?>
	<H3> <a href="<?php echo $lienRetour?> "> Retour </a>
<?php
} ?>

	</body>
</html>
