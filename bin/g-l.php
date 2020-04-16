<?php

	ob_start('ob_gzhandler');
	session_start();

	include_once('fct.php');
	include_once('bddacces.php');
	include_once('./BDD/g_book.php');

	$book = get_allbooks();

	if ((isset($_POST['refe'])) && (isset($_POST['tl'])) && (isset($_POST['au'])) && (isset($_POST['ap'])) && (isset($_POST['emp'])) && (isset($_POST['et'])) && (isset($_POST['exem'])) && (isset($_POST['appart']))) {

		$refe = $_POST['refe'];
		$tl = $_POST['tl'];
		$au = $_POST['au'];
		$ap = $_POST['ap'];
		$emp = $_POST['emp'];
		$et = $_POST['et'];
		$exem = $_POST['exem'];
		$appart = $_POST['appart'];
	}

	if(isset($_POST['valid-btn']) && $_POST['valid-btn'] === 'ajouter'){

		addbook($_POST['refe'], $_POST['tl'], $_POST['au'], $_POST['ap'], $_POST['emp'], $_POST['et'], $_POST['exem'], $_POST['appart']);
		header('Location: g-l.php');
	}  
	// --------------------------------- Si c'est une modification d'un existant -------------------------
	else if(isset($_POST['valid-btn']) && $_POST['valid-btn'] === 'modif'){

		updatebook($_POST['exem']);
		header('Location: g-l.php');
	} 
	// --------------------------------- Si le bouton d'arrivée est une suppression
	else if(isset($_POST['valid-btn']) && $_POST['valid-btn'] === 'supp'){

		removebook($_POST['tl']);
		header('Location: g-l.php');
	}
	// ---------------------------------- Si c'est une demande pour peupler la table de modification ------
	else if(isset($_GET['refe'])){

		$infosbook = get_bookbyauteur($_GET['tl']);
	}

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
				<label for="sel1">Exemplaires</label>
				<select type="number" name="exem" required="required" class="form-control input-sm">
				<?php if(!empty($infosbook)) : ?>
					<option>0</option>
				<?php endif; ?>
					<option>1</option>
    				<option>2</option>
    				<option>3</option>
    				<option>4</option>
    			</select>
			</div>
			<div>
				<label>Etat</label>
				<input type="text" name="et" required="required" class="form-control">
			</div>
			<div>
				<label>Appartenance</label>
				<input type="radio" name="appart" value="Bibliothèque" class="radio-inline">Bibliothèque
				<input type="radio" name="appart" value="Médiathèque" class="radio-inline">Médiathèque
			</div>

			<?php if(empty($infosbook)) : ?>
				<div class="row justify-content-center">
					<button input type="submit" name="valid-btn" value="ajouter" class="btn btn-success">Ajouter</button>
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