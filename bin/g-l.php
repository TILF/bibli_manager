<?php

	ob_start('ob_gzhandler');
	session_start();

	include_once('fct.php');
	include_once('./BDD/g_book.php');

	
	if (isset($_SESSION['ident'])) {
		$ident = $_SESSION['ident'];
	}
	else{
		header('Location: Bibli.php');
	}


	$book = get_allbooks();


	if(isset($_POST['valid-btn']) && $_POST['valid-btn'] === 'ajouter'){
		addbook($_POST['refe'], $_POST['tl'], $_POST['au'], $_POST['ap'], $_POST['emp'], $_POST['et'], $_POST['exem'], $_POST['appart']);
		header('Location: g-l.php');
	}  
	// --------------------------------- Si c'est une modification d'un existant -------------------------
	else if(isset($_POST['valid-btn']) && $_POST['valid-btn'] === 'modif'){
		updatebook($_POST['exem'], $_POST['refBook']);
		header('Location: g-l.php');
	} 
	// --------------------------------- Si le bouton d'arrivée est une suppression
	else if(isset($_POST['valid-btn']) && $_POST['valid-btn'] === 'supp'){
		removebook($_POST['refBook']);
		header('Location: g-l.php');
	}
	// ---------------------------------- Si c'est une demande pour peupler la table de modification ------
	else if(isset($_GET['fkLivres'])){
		$infosbook = get_bookbyrefe($_GET['fkLivres']); 
	}

	pageStart();

?>

<div id="contentPage">
	<div id="ContentTest" class="container">

		<h1>Gestion livres</h1>
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
					<th>Modifer</th>
				</tr>
			</thead>

			<tbody>
				<?php while($b = mysqli_fetch_assoc($book)) { ?>
					<tr>
						<td><?php echo htmlentities($b['Reference']); ?></td>
						<td><?php echo htmlentities($b['Titre']); ?></td>
						<td><?php echo htmlentities($b['Auteur']); ?></td>
						<td><?php echo htmlentities($b['Annee_parution']); ?></td>
						<td><?php echo htmlentities($b['Emplacement']); ?></td>
						<td><?php echo htmlentities($b['Etat_actuel']); ?></td>
						<td><?php echo htmlentities($b['Exemplaires']); ?></td>
						<td><?php echo htmlentities($b['Bibli_media']); ?></td>
						<td><a href="g-l.php?fkLivres=<?php echo htmlentities($b['Reference']); ?>" class="btn btn-info">Modifier</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		
		<form action="g-l.php" classe="col-md-12" method="post" >

			<!-- Si c'est vide c'est une inscription, sinon c'est une modification et on garde l'Id de la personne dans un champ caché -->
			<?php if(empty($infosbook)) : ?>
				<h3>Ajouter un Livre</h3>
			<?php else : ?>
				<h3>Modifier un livre</h3>
				<input type="hidden" name="refBook" value="<?php echo htmlentities($infosbook['Reference']) ?>">
			<?php endif; ?>

			<div>
				<label>Titre</label>
				<input type="text" name="tl" required="required" class="form-control input-sm" value="<?php echo htmlentities(isset($infosbook['Titre']) ? $infosbook['Titre'] : '') ?>">
			</div>
			<div>
				<label>Auteur</label>
				<input type="text" name="au" required="required" class="form-control input-sm" value="<?php echo htmlentities(isset($infosbook['Auteur']) ? $infosbook['Auteur'] : '') ?>">
			</div>
			<div>
				<label>Référence</label>
				<input type="number" name="refe" required="required" class="form-control input-sm" value="<?php echo htmlentities(isset($infosbook['Reference']) ? $infosbook['Reference'] : '') ?>">
			</div>
			<div>
				<label>Année parution</label>
				<input type="number" name="ap" required="required" class="form-control input-sm" value="<?php echo htmlentities(isset($infosbook['Annee_parution']) ? $infosbook['Annee_parution'] : '') ?>">
			</div>
			<div>
				<label>Emplacement</label>
				<input type="text" name="emp" required="required" class="form-control input-sm" value="<?php echo htmlentities(isset($infosbook['Emplacement']) ? $infosbook['Emplacement'] : '') ?>">
			</div>
			<div>
				<label for="sel1">Exemplaires</label>
				<input type="number" name="exem" required="required" class="form-control input-sm" value="<?php echo htmlentities(isset($infosbook['Exemplaires']) ? $infosbook['Exemplaires'] : '') ?>">
			</div>
			<div>
				<label>Etat</label>
				<input type="text" name="et" required="required" class="form-control" value="<?php echo htmlentities(isset($infosbook['Etat_actuel']) ? $infosbook['Etat_actuel'] : '') ?>">
			</div>
			<div>
				<label>Appartenance</label>
				<input type="radio" name="appart" value="Bibliothèque" class="radio-inline" <?php echo htmlentities(isset($infosbook['Bibli_media']) &&  $infosbook['Bibli_media'] === 'Bibliothèque' ? 'checked' : '') ?> >Bibliothèque
				<input type="radio" name="appart" value="Médiathèque" class="radio-inline" <?php echo htmlentities(isset($infosbook['Bibli_media']) &&  $infosbook['Bibli_media'] === 'Médiathèque' ? 'checked' : '') ?>>Médiathèque
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

<script>
	$('.table').dataTable();
	$('.search').addClass('form-control');
</script>