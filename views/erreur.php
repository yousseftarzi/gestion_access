<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">

</head>

<body>
	<div id="heading">
		<h1>Connexion</h1>
	</div>

	<section id="main" class="wrapper">
		<div class="inner">
			<div class="content">

				<H2> Erreur : <?php echo $titreErreur; ?></H2>
				<H4> <?php   echo $messageErreur; ?> </H4>
				<?php if ($lienRetour != "") {
    ?>
				<H3> <a href="<?php echo $lienRetour?> "> Retour </a>
<?php
} ?>

</div>
</div>
</section>


</body>
</html>
