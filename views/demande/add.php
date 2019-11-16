<!DOCTYPE html>
<html>

<head>
	<title>Envoyer Demande</title>
	<meta charset="utf-8">
</head>

<body>

	<body>
		<div id="heading">
			<h1>Ajouter une demande</h1>
		</div>

		<section id="main" class="wrapper">
			<div class="inner">
				<div class="content">
					<form method="post" action="?controller=Demande&action=save">
						<div class="row">
							<?php if (!is_null($listProfil)) {
    ?>
							<?php foreach ($listProfil as $profil) {
        ?>
							<tr>
								<div class="col-6 col-12-small">

									<input type="checkbox" id="<?php echo $profil->getNom(); ?>" name="<?php echo $profil->getNom(); ?>">
									<label for="<?php echo $profil->getNom(); ?>"><?php echo $profil->getNom(); ?></label>
								</div>
							</tr>
							<?php
    } ?>
								<?php
} else {
        echo "vous avez envoyé des demandes pour tous les profils";
    } ?>
									<br /><br />
						</div>
						<br>

						<div class="row">
							<?php if (!is_null($listGroupe)) {
        ?>
							<?php foreach ($listGroupe as $groupe) {
            ?>
							<tr>
								<div class="col-6 col-12-small">
									<input type="checkbox" id="<?php echo $groupe->getNom(); ?>" name="<?php echo $groupe->getNom(); ?>">
									<label for="<?php echo $groupe->getNom(); ?>"><?php echo $groupe->getNom(); ?></label>
								</div>
							</tr>
							<?php
        } ?>
								<?php
    } else {
        echo "vous avez envoyé des demandes pour tous les groupes";
    } ?>
						</div> <br /> <br />

						<div class="col-12">
							<SELECT name="superieur">
<?php foreach ($listSuperieur as $superieur) {
        ?>
	<option value = <?php echo $superieur->getId() ?> > <?php echo $superieur->getNom()." ".$superieur->getPrenom(); ?>  </option>
<?php
    } ?>
</SELECT>
						</div>  <br /> <br />

						<div class="col-12">
							<ul class="actions">
								<li><input type="submit" value="Envoyer" class="primary"></li>
								<li><input type="reset" value="Annuler"></li>
							</ul>
						</div>
					</form>
				</div>
			</div>
		</section>
	</body>

	</html>
