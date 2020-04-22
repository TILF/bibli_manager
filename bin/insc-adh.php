<?php

	ob_start('ob_gzhandler');
	session_start();

	include_once('fct.php');
	include_once('./BDD/adherent.php');

	// Réupération de l'ensemble des adhérents pour affichage sur la page
	$adh = getAllAdherents();

	
	if (isset($_SESSION['ident'])) {
		$ident = $_SESSION['ident'];
	}
	else{
		header('Location: Bibli.php');
	}

	// On Regarde le bouton qui a forcé l'arrivée sur la page pour savoir quelle action réaliser
	// Ensuite on fait le traitement et on force le rechargement de la page
	// -----------------------------------  Si le bouton d'arrivé est une inscription -----------------------
	if(isset($_POST['valid-btn']) && $_POST['valid-btn'] === 'inscript'){
		insertAdherent($_POST['nom'], $_POST['pnom'], $_POST['age'], $_POST['tel'], $_POST['nrue'], $_POST['zcode'], $_POST['vi']);
		header('Location:insc-adh.php');
	}  
	// --------------------------------- Si c'est une modification d'un existant -------------------------
	else if(isset($_POST['valid-btn']) && $_POST['valid-btn'] === 'modif'){
		updateAdherent($_POST['nom'], $_POST['pnom'], $_POST['age'], $_POST['tel'], $_POST['nrue'], $_POST['zcode'], $_POST['vi'], $_POST['IdAdherent']);
		header('Location:insc-adh.php');
	} 
	// --------------------------------- Si le bouton d'arrivée est une suppression
	else if(isset($_POST['valid-btn']) && $_POST['valid-btn'] === 'supp'){
		deleteAdherent(date('Ymd'), $_POST['IdAdherent']);
		header('Location:insc-adh.php');
	}
	// ---------------------------------- Si c'est une demande pour peupler la table de modification ------
	else if(isset($_GET['fkAdherent'])){ 
		$infosAdh = getAdherentById($_GET['fkAdherent']);
	}

	// Chargement de l'etête de page
	pageStart();
?>



<div id="contentPage">
	<div id="ContentTest" class="container">

	<!--------------------------- Tableau des adhérents ----------------------------------------->
	<h1>Gestion des adhérents</h1>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Date de Naissance</th>
				<th>Téléphone</th>
				<th>Adresse</th>
				<th>Localité</th>
				<th>Cotisation</th>
				<th>Modifier</th>
			</tr>
		</thead>

		<tbody>
			<?php while($t = mysqli_fetch_assoc($adh)) { ?>
				<tr>
					<td><?php echo htmlentities($t['Id']); ?></td>
					<td><?php echo htmlentities($t['Nom']); ?></td>
					<td><?php echo htmlentities($t['Prenom']); ?></td>
					<td><?php echo htmlentities($t['Age']); ?></td>
					<td>(+33)<?php echo htmlentities($t['Telephone']); ?></td>
					<td><?php echo htmlentities($t['Adresse']); ?></td>
					<td><?php echo htmlentities($t['CP'] . " " . $t['Ville']); ?></td>
					<td><?php echo htmlentities($t['Cotisation']); ?></td>
					<td><a href="insc-adh.php?fkAdherent=<?php echo htmlentities($t['Id']); ?>" class="btn btn-info"><i class="fas fa-user-edit"></i> Modifier</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<!--------------------------- Tableau des adhérents ----------------------------------------->

	<!--------------------------- Bloc d'ajout / Modification  ----------------------------------------->
	<div class="row justify-content-center">
		<form class="bloc-form col-md-8" action="insc-adh.php" method="post" >

			<!-- Si c'est vide c'est une inscription, sinon c'est une modification et on garde l'Id de la personne dans un champ caché -->
			<?php if(empty($infosAdh)) : ?>
				<h3>Ajouter un Ahdérent</h3>
			<?php else : ?>
				<h3>Modifier l'Adhérent</h3>
				<input type="hidden" name="IdAdherent" value="<?php echo htmlentities($infosAdh['Id']) ?>">
			<?php endif; ?>


			<div class="row">
				<div class="form-group col-md-3">
					<label>Nom</label>
					<input type="text" name="nom" required="required" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosAdh) ? $infosAdh['Nom'] : ''); ?>">
				</div>
				<div class="form-group col-md-3">
					<label>Prénom</label>
					<input type="text" name="pnom" required="required" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosAdh) ? $infosAdh['Prenom'] : ''); ?>">
				</div>
				<div class="form-group col-md-3">
					<label>Age</label>
					<input type="number" name="age" required="required" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosAdh) ? $infosAdh['Age'] : ''); ?>">
				</div>
				<div class="form-group col-md-3">
					<label>Téléphone</label>
					<input type="number" name="tel" required="required" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosAdh) ? $infosAdh['Telephone'] : ''); ?>">
				</div>
			</div>
			
			<div class="row">
				<div class="form-group col-md-3">
					<label>Numéro et rue</label>
					<input type="text" name="nrue" required="required" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosAdh) ? $infosAdh['Adresse'] : ''); ?>">
				</div >
				<div class="form-group col-md-3">
					<label>Code postal</label>
					<input type="number" name="zcode" required="required" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosAdh) ? $infosAdh['CP'] : ''); ?>">
				</div>
				<div class="form-group col-md-3">
					<label>Ville</label>
					<input type="text" name="vi" required="required" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosAdh) ? $infosAdh['Ville'] : ''); ?>">
				</div>
			</div>

			<!-------- Ajout des boutons en fonction de la situation Ajout / Modif  -------->
			<?php if(empty($infosAdh)) : ?>
				<div class="row justify-content-center">
					<button input type="submit" name="valid-btn" value="inscript" class="btn btn-success">Inscrire !</button>
				</div>
			<?php else : ?>
				<div class="row justify-content-center">
					<button input type="submit" name="valid-btn" value="modif" class="btn btn-info">Modifier </button>
					<button input type="submit" name="valid-btn" value="supp" class="btn btn-danger">Supprimer </button>
				</div>
			<?php endif; ?>

			
		</form>
	</div>
</div>
<!--------------------------- Bloc d'ajout / Modification  ----------------------------------------->


<!-- Chargement du pied de page -->
<?php pageEnd(); ?>

<script>
	$('.table').dataTable();
</script>