<!DOCTYPE html>
<html>

<head>
	<title>Ajouter Groupe</title>
</head>

<body>
	<h1> Ajouter un Groupe </h1> <br />

	<form method="post" action="?controller=Admin&action=saveGroupe">

		<table class="nostyle">
			<tbody>
				<tr>
					<td style="width:80px;">
						Nom Groupe:
					</td>
					<td>
						<input type="text" name="nom" id="nom" class="input-text" required> <br /><br />
					</td>

				</tr>
				<tr>
					<td colspan="2" class="t-right">
						<button type="submit" class="input-submit"> Ajouter </button>
					</td>
				</tr>
			</tbody>

		</table>

	</form>
</body>

</html>
