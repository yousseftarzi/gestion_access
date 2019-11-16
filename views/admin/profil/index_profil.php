<head>
	<title></title>
</head>

<body>
	<h1> Listes des Groupes </h1> <br />
	<table class="nostyle">
		<tbody>
			<?php foreach ($listProfil as $profil ) {?>
			<tr>
				<td>
					<h3><?php echo $profil->getNom(); ?> </td></h3>
				<td>
					<a href="?controller=Admin&action=deleteProfil&id=<?php echo $profil->getId(); ?>"> <img src="assetsAdmin/design/ico-delete.gif"/> </a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</body>

</html>
