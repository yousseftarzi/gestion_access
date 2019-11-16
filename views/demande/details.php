<!DOCTYPE html>
<html>

<head>
	<title>Details</title>
	<meta charset="utf-8">
</head>

<body>
	<div id="heading">
		<h1>Page Superieur</h1>
	</div>

	<section id="main" class="wrapper">
		<div class="inner">
			<div class="content">

					<form method="post" action="?controller=Demande&action=traiter&idDemande=<?php echo $idDemande; ?>">
						<div class="col-6 col-12-small">
						<h2> Details Utilisateur</h2>
					<ul>

						<li> <b> Nom : </b>
							<?php echo $user->getNom(); ?> </li>
						<br />
						<li> <b>Prenom : </b>
							<?php echo $user->getPrenom(); ?>
						</li>
						<br />
						<li> <b> Matricule : </b>
							<?php echo $user->getMatricule(); ?>
						</li>
						<br />
						<li><b> Login : </b>
							<?php echo $user->getLogin(); ?>
						</li>
						<br />
						<li><b> Fonction : </b>
							<?php echo $user->getFonction(); ?>
						</li>
						<br />
						<li><b> Departement : </b>
							<?php echo $user->getDepartement(); ?>
						</li>
						<br />
						<li><b> Emplacement : </b>
							<?php echo $user->getEmplacement(); ?>
						</li>
						<br />
						<li><b> Numero téléphone : </b>
							<?php echo $user->getNumTel(); ?>
						</li>

						<br />
						<h4> List des profils demandés </h4>
						<?php foreach ($listProfil as $profil) {
	 ?>
						<li>
							<?php echo $profil->getNom(); ?>
						</li>
						<br />
						<?php
} ?>

							<h4> List des groupes demandés </h4>
							<?php foreach ($listGroupe as $groupe) {
	 ?>
							<li>
								<?php echo $groupe->getNom(); ?> </li><br />
							<?php
} ?>
					</ul>
					</div>
						<br>
						<div class="col-12">
							<ul class="actions">
								<li><button type="submit" name="accepter" value="Accepter" class="primary">Accepter</button></li>
								<li><button type="submit" name="refuser" value="Refuser" class="button">Refuser</button></li>
							</ul>
						</div>

					</form>

			</div>
	</section>
</body>

</html>
