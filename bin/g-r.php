<?php

	ob_start('ob_gzhandler');
	session_start();

	include_once('fct.php');
	include_once('./BDD/location-livres.php');

	// Réupération de l'ensemble des réservations pour affichage sur la page
	$re = reservation_courante();

	if (isset($_SESSION['ident'])) {
		$ident = $_SESSION['ident'];
	}
	else{
		header('Location: Bibli.php');
	}


	$date_d = DateStringToDb($_POST['date_d']);
	$date_f = DateStringToDb($_POST['date_f']);
	$livre = $_POST['id_livre'];
	$nom = $_POST['idAdh'];


	// On Regarde le bouton qui a forcé l'arrivée sur la page pour savoir quelle action réaliser
	// Ensuite on fait le traitement et on force le rechargement de la page
	// -----------------------------------  Si le bouton d'arrivé est une inscription -----------------------
	if(isset($_POST['valid-btn']) && $_POST['valid-btn'] === 'reserver'){
		reserver($date_d, $date_f, $livre, $nom);
		header('Location:g-r.php');
	}  
	// --------------------------------- Si c'est une modification d'un existant -------------------------
	else if(isset($_POST['valid-btn']) && $_POST['valid-btn'] === 'maj'){
		update_location($date_r , $etat);
		header('Location:g-r.php');
	} 
	// ---------------------------------- Si c'est une demande pour peupler la table de modification ------
	else if(isset($_GET['fkEmprunts_livres'])){ 
		$infosloc = getReservationById($_GET['fkEmprunts_livres']);
	}
	pageStart();
?>

<div id="contentPage">
	<div id="ContentTest" class="container">
	<!--------------------------- Tableau des réservations ----------------------------------------->
	<h1>Gestion des réservations</h1>
	<table class="table">
		<thead>
			<tr>
				<th>Date de début</th>
				<th>Date de fin</th>
				<th>Livre</th>
				<th>Adhérent</th>
				<th>Date de rendu</th>
				<th>Etat</th>
				<th>Modifier</th>
			</tr>
		</thead>
			
		<tbody>
			<?php while($r = mysqli_fetch_assoc($re)) { ?>
				<tr>
					<td><?php echo htmlentities($r['Date_debut']); ?></td>
					<td><?php echo htmlentities($r['Date_fin']); ?></td>
					<td><?php echo htmlentities($r['fk_Livres.Titre']); ?></td>
					<td><?php echo htmlentities($r['fk_adherents.Nom']); ?></td>
					<td><?php echo htmlentities($r['Date_rendu']); ?></td>
					<td><?php echo htmlentities($r['Etat']); ?></td>
					<td><a href="g-l.php?fkEmprunts_livres=<?php echo htmlentities($r['Id_emprunt']); ?>" class="btn btn-info"><i class="fas fa-user-edit"></i> Modifier</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<div class="row justify-content-center">
		<form class="bloc-form col-md-8" action="g-r.php" method="post" >

			<!-- Si c'est vide c'est une inscription, sinon c'est une modification et on garde l'Id de la personne dans un champ caché -->
			<?php if(empty($infosloc)) : ?>
				<h3>Faire une réservation</h3>
			<?php else : ?>
				<h3>Mettre à jour la réservation</h3>
				<input type="hidden" name="Idlocation" value="<?php echo htmlentities($infosloc['Id_emprunt']) ?>">
			<?php endif; ?>

			<input type="hidden"  name="idAdh" id="idAdh" value="">

			<div class="row">
				<div class="form-group col-md-3">
					<label>Date de début</label>
					<input type="date" name="date_d" required="required" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosloc) ? $infosloc['Date_debut'] : ''); ?>">
				</div>
				<div class="form-group col-md-3">
					<label>Date de fin</label>
					<input type="date" name="date_f" required="required" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosloc) ? $infosloc['Date_fin'] : ''); ?>">
				</div>
				<div class="form-group col-md-3">
					<label>ID Livre</label>
					<input type="text" id="searchBook" name="id_livre" required="required" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosloc) ? $infosloc['fk_Livres'] : ''); ?>">
				</div>
				<div class="form-group col-md-3">
					<label>ID Adhérent</label>
					<input type="text" name="id_adh" id="searchAdherent" required="required" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosloc) ? $infosloc['fk_adherents'] : ''); ?>">
				</div>
			</div>
			
			

			<!-------- Ajout des boutons en fonction de la situation Ajout / Modif  -------->
			<?php if(empty($infosloc)) : ?>
				<div class="row justify-content-center">
					<button input type="submit" name="valid-btn" value="reserver" class="btn btn-success">Réserver</button>
				</div>
			<?php else : ?>
				<div class="row">
				<div class="form-group col-md-3">
					<label>Date de rendu</label>
					<input type="date" name="date_r" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosloc) ? $infosloc['Date_rendu'] : ''); ?>">
				</div >
				<div class="form-group col-md-3">
					<label>Etat</label>
					<input type="text" name="etat" class="form-control input-sm" value="<?php echo htmlentities(!empty($infosloc) ? $infosloc['Etat'] : ''); ?>">
				</div>
			</div>
				<div class="row justify-content-center">
					<button input type="submit" name="valid-btn" value="maj" class="btn btn-info">Mettre à jour </button>
				</div>
			<?php endif; ?>

			
		</form>
	</div>
</div>



<?php

	pageEnd();

?>


<script src="../js/typeahead.js"></script>
<script>

	// Recherche des patters marquant avec la saisie du livre ---------
	$('#searchBook').typeahead({
	    delay : 500,
	     source: function (query, process) {
	        return $.ajax({
	            url: './BDD/ajax_book.php',
	            type: 'post',
	            dataType: 'json',
	            data: { pattern: query, demand: 'byTitle' },
	            success: function (jsonResult) {
	                if(typeof jsonResult == 'undefined'){
	                	return false;
	                }else{
	                	return process(jsonResult);
	                }
	            }
	        });
	    },
	    updater: function (item) {
	    	return item;
	    },
	    minLength: 2
    });

    // IDM au dessus mais avec l'adhérent
	$('#searchAdherent').typeahead({
	    delay : 500,
	     source: function (query, process) {
	        return $.ajax({
	            url: './BDD/ajax_adherent.php',
	            type: 'post',
	            dataType: 'json',
	            data: { pattern: query, demand: 'byName' },
	            success: function (jsonResult) {
	                if(typeof jsonResult == 'undefined'){
	                	return false;
	                }else{
	                	return process(jsonResult);
	                }
	            }
	        });
	    },
	    updater: function (item) {
	    	searchAdherentInfos(item);
	    	return item;
	    },
	    minLength: 2
    });

    function searchAdherentInfos(item){
    	 $.ajax({
            url: './BDD/ajax_adherent.php',
            type: 'post',
            dataType: 'json',
            data: { pattern: item, demand: 'fullInfos' },
            success: function (jsonResult) {
            	$('#idAdh').val(jsonResult.Id);
            }
        });
    }

</script>

