<!DOCTYPE html>
<html>

<head>
	<title></title>
</head>

<body>
<h1> Listes des Groupes </h1> <br />

	<table class="nostyle">
		<tbody>
			<?php foreach ($listGroupe as $groupe ) {?>
				<tr>
					<td>

									<h3><?php echo $groupe->getNom(); ?> </h3>

					</td>
					<td>
						<a href="?controller=Admin&action=deleteGroupe&id=<?php echo $groupe->getId(); ?>"> <img src="assetsAdmin/design/ico-delete.gif"/> </a>

					</td>

				</tr>

	<?php } ?>


			</tbody>
		</table>
</body>

</html>
