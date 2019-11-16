<!DOCTYPE html>
<html>

<head>
	<title>Demandes</title>
	<meta charset="utf-8">
</head>

<body>
	<div id="heading">
		<h1>Liste des Demandes</h1>
	</div>

	<section id="main" class="wrapper">
		<div class="inner">
			<div class="content">
				<?php if( count($listDemande) == 0 )
	{ ?>
				<H3> Vous n'avez aucune demande</H3>
				<H4> <a href = "?controller=Demande&action=add" class="button"> envoyer une ! </a></H4>
				<?php
	}
	else { ?>


					<div class="table-wrapper">
						<table>
							<thead>
								<th>Nom Superieur </th>
								<th>Prenom Superieur </th>
								<th>Date</th>
								<th>Etat</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php foreach ($listDemande as $demande) { ?>
								<tr>
									<td>
										<?php echo ucfirst($demande->findSuperieurById()->getNom());  ?> </td>
									<td>
										<?php echo ucfirst($demande->findSuperieurById()->getPrenom()); ?> </td>
									<td>
										<?php echo ucfirst($demande->getDateEnvoi()); ?>
									</td>
									<td>
										<?php echo ucfirst($demande->getEtat()); ?>
									</td>
									<td>

										<?php if($demande->getEtat() == "en_cours" ){ ?>
										<a href="?controller=Demande&action=delete&id=<?php echo $demande->getId(); ?> " class="button small"> Annuler</a>
										<?php } ?>

									</td>
								</tr>
								<?php }

			}

			?>
							</tbody>
						</table>

					</div>
			</div>
		</div>
	</section>
</body>

</html>
