$(document).ready(function() {

	$( "#btnGetExtractEtatStock" ).click(function() {
		getExtractEtatStock();
	});
	$( "#btnGetExtractConso" ).click(function() {
		getExtractConso();
	});

	$('.pickadate').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 2, // Creates a dropdown of 15 years to control year
	    labelMonthNext: 'Mois suivant',
	    labelMonthPrev: 'Mois précédent',
	    labelMonthSelect: 'Selectionner le mois',
	    labelYearSelect: 'Selectionner une année',
	    monthsFull: [ 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' ],
	    monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec' ],
	    weekdaysFull: [ 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' ],
	    weekdaysShort: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
	    weekdaysLetter: [ 'D', 'S', 'T', 'Q', 'Q', 'S', 'S' ],
	    today: 'Aujourd\'hui',
	    clear: 'Réinitialiser',
	    close: 'Fermer',
	    format: 'dd/mm/yyyy'
	});
});


/**
 * [getExtractEtatStock description]
 * @return {[type]}    [description]
 */
 function getExtractEtatStock()
 {
 	var form = $("#formExtractEtatStock");
 	$.ajax(
 	{
 		url : form.attr('action'),
 		type: 'POST',
 		cache : false,
 		data : form.serialize(),
 		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
 		dataType : 'html',
 		success : function(code_html, statut)
 		{
 			var retour = code_html.trim();
 			var retourData = JSON.parse(retour);
 			if(retourData.success)
 			{
				//
				$("#divExtractEtatStock").html(retourData.html);
				//
				Materialize.toast('Extraction disponible', 1000);
				return true;
			}
			else
			{
				sweetAlert("Une erreur est survenue." , "warning");
				return false;
			}
		},
		error : function(resultat, statut, erreur){
			sweetAlert("Erreur", "Une erreur a été rencontrée.\n" + erreur, "error");
			displaySpinner('hide');
		},
		complete : function(resultat, statut){
		}
	});
 }

/**
 * [getExtractConso description]
 * @return {[type]}    [description]
 */
 function getExtractConso()
 {
 	var form = $("#formExtractConso");
 	$.ajax(
 	{
 		url : form.attr('action'),
 		type: 'POST',
 		cache : false,
 		data : form.serialize(),
 		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
 		dataType : 'html',
 		success : function(code_html, statut)
 		{
 			var retour = code_html.trim();
 			var retourData = JSON.parse(retour);
 			if(retourData.success)
 			{
				//
				$("#divExtractConso").html(retourData.html);
				//
				Materialize.toast('Extraction disponible', 1000);
				return true;
			}
			else
			{
				sweetAlert("Une erreur est survenue." , "warning");
				return false;
			}
		},
		error : function(resultat, statut, erreur){
			sweetAlert("Erreur", "Une erreur a été rencontrée.\n" + erreur, "error");
			displaySpinner('hide');
		},
		complete : function(resultat, statut){
		}
	});
 }