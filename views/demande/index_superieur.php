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

				<?php if( !count($listDemande)>0 )
	{ ?>
				<p> Vous n'avez aucune demande à traiter </p>
				<?php
	}
	else { ?>


					<div class="wrapper">
						<table>
							<thead>
								<th>Nom</th>
								<th>Prenom</th>
								<th>Date</th>
							</thead>
							<tbody>
								<?php foreach ($listDemande as $demande) { ?>
								<tr>
									<td>
										<?php echo $demande->findUserById()->getNom();  ?> </td>
									<td>
										<?php echo $demande->findUserById()->getPrenom(); ?> </td>
									<td>
										<?php echo $demande->getDateEnvoi(); ?>
									</td>
									<td> <a href="?controller=Demande&action=details&id=<?php echo $demande->getId(); ?> " class="button small"> Details </a> </td>
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
