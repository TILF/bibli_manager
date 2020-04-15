<?php

	ob_start('ob_gzhandler');
	session_start();

	include_once('fct.php');
	include_once('bddacces.php');

	pageStart();

?>

<div id="contentPage">
	<table class="table">
		<thead>
			<tr>
				<th>Référence</th>
				<th>Titre</th>
				<th>Auteur</th>
				<th>Année de parution</th>
				<th>Emplacement</th>
				<th>Etat actuel</th>
				<th>Exemplaires</th>
				<th>Appartenance</th>
			</tr>
		</thead>

		<tbody>
			<?php while($b = mysqli_fetch_assoc($book)) { ?>
				<tr>
					<td><?php echo $b['Reference']; ?></td>
					<td><?php echo $b['Titre']; ?></td>
					<td><?php echo $b['Auteur']; ?></td>
					<td><?php echo $b['Annee_parution']; ?></td>
					<td><?php echo $b['Emplacement']; ?></td>
					<td><?php echo $b['Etat_actuel']; ?></td>
					<td><?php echo $b['Exemplaires']; ?></td>
					<td><?php echo $b['Bibli_media']; ?></td>
					<td><a href="g-l.php?fkLivres=<?php echo $b['Reference']; ?>" class="btn btn-info"><i class="fas fa-user-edit"></i> Modifier</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<h1>Gestion livres</h1>

	<div class="row justify-content-center">
		<form class="bloc-form col-md-8" action="g-l.php" method="post" >

			<div>
				<label>Titre</label>
				<input type="text" name="tl" required="required" class="form-control input-sm">
			</div>
			<div>
				<label>Auteur</label>
				<input type="text" name="au" required="required" class="form-control input-sm">
			</div>
			<div>
				<label>Référence</label>
				<input type="number" name="refe" required="required" class="form-control input-sm">
			</div>
			<div>
				<label>Année parution</label>
				<input type="number" name="ap" required="required" class="form-control input-sm">
			</div>
			<div>
				<label>Emplacement</label>
				<input type="text" name="emp" required="required" class="form-control input-sm">
			</div>
			<div>
				<label>Exemplaires</label>
				<input type="number" name="exem" required="required" class="form-control input-sm">
			</div>
			<div>
				<label>Etat</label>
				<input type="text" name="et" required="required" class="form-control input-sm">
			</div>
			<div>
				<label>Appartenance</label>
				<input type="radio" name="appart" value="bi">Bibliothèque
				<input type="radio" name="appart" value="me">Médiathèque
			</div>

			<?php if(empty($infosAdh)) : ?>
				<div class="row justify-content-center">
					<button input type="submit" name="valid-btn" value="inscript" class="btn btn-success">Ajouter</button>
				</div>
			<?php else : ?>
				<div class="row justify-content-center">
					<button input type="submit" name="valid-btn" value="modif" class="btn btn-info">Modifier</button>
					<button input type="submit" name="valid-btn" value="supp" class="btn btn-danger">Supprimer</button>
				</div>
			<?php endif; ?>

		</form>
	</div>
</div>
<?php

	pageEnd();
?>