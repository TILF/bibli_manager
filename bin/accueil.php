<?php

	ob_start('ob_gzhandler');
	session_start();

	include_once('bddacces.php');
	include_once('./fct.php');
	include_once('./BDD/g_book.php');
	include_once('./BDD/adherent.php');
	include_once('./BDD/location-livres.php');

	$accueil = getreservationAccueil();
	$retard = getreservationRetard(); //

	if (isset($_SESSION['ident'])) {
		$ident = $_SESSION['ident'];
	}
	else{
		header('Location: Bibli.php');
	}
	pageStart();

?>
<div id="Accueillant">
	<div id="ContentTest" class="container">
	
		<title>Accueil</title>

		<div>
			<h1>Locations en cours</h1>
				<table class="table">
					<thead>
						<tr>
							<th>Numéro réservation</th>
							<th>Date de début</th>
							<th>Date de fin</th>
							<th>Référence livre</th>
							<th>Titre</th>
							<th>Prénom</th>
							<th>Nom</th>
						</tr>
					</thead>

				<tbody>
					<?php while($ac = mysqli_fetch_assoc($accueil)) { ?>
						<tr>
							<td><?php echo htmlentities($ac['Id_emprunt']); ?></td>
							<td><?php echo htmlentities($ac['Date_debut']); ?></td>
							<td><?php echo htmlentities($ac['Date_fin']); ?></td>
							<td><?php echo htmlentities($ac['Reference']); ?></td>
							<td><?php echo htmlentities($ac['Titre']); ?></td>
							<td><?php echo htmlentities($ac['Prenom']); ?></td>
							<td><?php echo htmlentities($ac['Nom']); ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

		<div>
			<h1>Locations en retard</h1>
				<table class="table">
					<thead>
						<tr>
							<th>Numéro réservation</th>
							<th>Date de début</th>
							<th>Date de fin</th>
							<th>Référence livre</th>
							<th>Titre</th>
							<th>Prénom</th>
							<th>Nom</th>
						</tr>
					</thead>

					<tbody>
						<?php while($ret = mysqli_fetch_assoc($retard)) { ?>
							<tr>
								<td><?php echo htmlentities($ret['Id_emprunt']); ?></td>
								<td><?php echo htmlentities($ret['Date_debut']); ?></td>
								<td><?php echo htmlentities($ret['Date_fin']); ?></td>
								<td><?php echo htmlentities($ret['Reference']); ?></td>
								<td><?php echo htmlentities($ret['Titre']); ?></td>
								<td><?php echo htmlentities($ret['Prenom']); ?></td>
								<td><?php echo htmlentities($ret['Nom']); ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>

			<div>
	</div>
<?php pageEnd(); ?>