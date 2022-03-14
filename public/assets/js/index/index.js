var lastSelSemaine;
var lastSelEdition;

$(document).ready(function()
{
	//
	$('a[href!=#]').on('click', function () {
		if($('#is_modified').val() == 1)
		{
			$(window).off('beforeunload');
			return confirm('Attention, vous n\'avez pas validé vos modifications.\nEtes-vous sur de vouloir quitter cette page ?');
		}
		$(window).on('beforeunload', function(event){
			if($('#is_modified').val() == 1)
				return 'Attention, vous n\'avez pas validé vos modifications.\nEtes-vous sur de vouloir quitter cette page ?';
		});
	});
	 //
	 $(window).on('beforeunload', function(){
	 	if($('#is_modified').val() == 1) return 'Attention, vous n\'avez pas validé vos modifications.\nEtes-vous sur de vouloir quitter cette page ?';
	 });
	//
	$( "#semaine" ).change(function(e) {
		if($('#is_modified').val() == 1)
		{
			/*e.preventDefault();
			e.stopPropagation();
			e.stopImmediatePropagation();*/
			$(this).val(lastSelSemaine);
			$(this).material_select();
			//lastSelSemaine.attr("selected", true);
			sweetAlert("Attention", "Vous n\'avez pas validé vos modifications.\nCeci est obligatoire avant de passer sur un autre BAT.", "warning");
			return false;
		}
		else
		{
			lastSelSemaine = $(this).val();
			getEdition($(this).val());
		}
	});
	//
	$( "#btnValidateRefus" ).click(function() {
		//getEdition($(this).val());
		refusImage();
	});
	//
	$( "#btnSaveEdition" ).click(function() {
		//getEdition($(this).val());
		saveEdition();
	});
	//
	$( "#btnSaveEditionAllEnCours" ).click(function() {
		//getEdition($(this).val());
		saveEditionAllEnCours();
	});
	//
	$( "#btnRefresh" ).click(function() {
		getBAT();
	});
	//
	$("#divResEdition").hide();
	//
	$().UItoTop({ easingType: 'easeOutQuart' });

	//
	var ds_to_go = $( "#ds_to_go" ).val();
	var de_to_go = $( "#de_to_go" ).val();
	if(ds_to_go != "")
	{
		$( "#semaine" ).val(ds_to_go);
		$( "#semaine" ).material_select();
		if(de_to_go != "")
		{
			console.log("getEdition("+ds_to_go+");");
			getEdition(ds_to_go);
		}
		else
		{
			console.log("getBAT();");
			getBAT();
		}
	}
});

/**
 * [getEdition description]
 * @param  {[type]} week [description]
 * @return {[type]}      [description]
 */
 function getEdition(week)
 {
 	displaySpinner('show');
 	$.ajax(
 	{
 		url : 'ajax/main/index/_ajax.getEdition.php',
 		type: 'POST',
 		cache : false,
 		data : "s=" + week + "&i=" +$("#id_user").val(),
 		dataType : 'html',
 		success : function(code_html, statut)
 		{
 			var html = code_html.trim();
 			$("#divResEdition").html(html);
 			if(html=='')
 			{
 				$("#divResEdition").hide();
 				//Pas d'edition, appel de l'affichage
 				getBAT();
 			}
 			else
 			{
 				//
 				var de_to_go = $( "#de_to_go" ).val();
				//
				$("#divResPages").html('');
				$("#divResBAT").html('<div id="card-alert" class="card light-blue lighten-5"><div class="card-content light-blue-text"><p>Choisissez une edition.</p></div></div>');
				$("#divResEdition").show();
				if(de_to_go != "")
				{
					$('#edition').val(de_to_go);
					getBAT();
				}
				$('#edition').material_select();
				$( "#edition" ).change(function(e) {
					if($('#is_modified').val() == 1)
					{
 						/*e.preventDefault();
 						e.stopPropagation();
 						e.stopImmediatePropagation();*/
 						//lastSelEdition.attr("selected", true);
 						$(this).val(lastSelEdition);
 						$(this).material_select();
 						sweetAlert("Attention", "Vous n\'avez pas validé vos modifications.\nCeci est obligatoire avant de passer sur un autre BAT.", "warning");
 						return false;
 					}
 					else
 					{
 						lastSelEdition = $(this).val();
 						getBAT();
 					}
 				});
				//
				displaySpinner('hide');
			}
                        //Passage en mode modifié
                        //setIsModified();
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
 * [getEdition description]
 * @param  {[type]} week [description]
 * @return {[type]}      [description]
 */
 function getBAT()
 {
 	displaySpinner('show');
 	$("#divResPages").html('');
 	//
 	var week = $( "#semaine" ).val();
 	var edition = $( "#edition" ).val();
 	if(typeof(edition)=='undefined') edition = '';
 	//
 	$.ajax(
 	{
 		url : 'ajax/main/index/_ajax.getBAT.php',
 		type: 'POST',
 		cache : false,
 		data : "s=" + week + "&e=" + edition + "&i=" +$("#id_user").val(),
 		dataType : 'html',
 		success : function(code_html, statut)
 		{
 			var html = code_html.trim();
 			$("#divResBAT").html(html);
 			var nbFichiers = $( "#nbFichiers" ).val();
 			if(typeof(nbFichiers)!='undefined') $("#divResPages").html('<h4>'+$("#nbFichiers").val() + ' pages</h4>');
 			//
 			addEventListener();
 			//
 			displaySpinner('hide');
                        //Passage en mode modifié
                        //setIsModified();
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
 * [addEventListener description]
 */
 function addEventListener()
 {
	//
	$(".fbImg").fancybox({
		openEffect	: 'elastic',
		closeEffect	: 'elastic',

		helpers : {
			title : {
				type : 'inside'
			}
		}
	});
	//
	$( ".btnRefusImg" ).click(function(e) {
		e.stopPropagation();
		e.stopImmediatePropagation();
		//
		var idfic = $(this).attr('idfic');
		$('#modalRefusImg').openModal();
		$('#iFormModalRefusImg').val(idfic);
		$('#uFormModalRefusImg').val($("#id_user").val());
		$('#motif_refus').val('');
		//console.log(idfic);
	});
	//
	$( ".btnAcceptImg" ).click(function(e) {
		e.stopPropagation();
		e.stopImmediatePropagation();
		//
		var idfic = $(this).attr('idfic');
		//console.log(idfic);
		validateImage(idfic);
	});
	//
	$( ".btnDownloadImg" ).click(function(e) {
		e.stopPropagation();
		e.stopImmediatePropagation();
		//
		var idfic = $(this).attr('idfic');
		getImage(idfic);
	});
	//
	$( ".btnInfosRefusImg" ).click(function(e) {
		e.stopPropagation();
		e.stopImmediatePropagation();
		//
		var idfic = $(this).attr('idfic');
		infosRefusImage(idfic);
	});
	//
	$( ".btnEnCoursImg" ).click(function(e) {
		e.stopPropagation();
		e.stopImmediatePropagation();
		//
		var idfic = $(this).attr('idfic');
		enCoursImage(idfic);
	});
}

/**
 * [validateImage description]
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
 function validateImage(idfic)
 {
 	$.ajax(
 	{
 		url : 'ajax/main/index/_ajax.setValidateImage.php',
 		type: 'POST',
 		cache : false,
 		data : "i=" + idfic + "&u=" +$("#id_user").val(),
 		dataType : 'html',
 		success : function(code_html, statut)
 		{
 			var html = code_html.trim();
 			//
 			$("#fic" + idfic).addClass('img_ok');
 			$("#btnRefusImg" + idfic).unbind( "click" );
 			$("#btnRefusImg" + idfic).addClass('disabled');
 			$("#btnRefusImg" + idfic).hide();
 			//
 			$("#btnAcceptImg" + idfic).unbind( "click" );
 			$("#btnAcceptImg" + idfic).addClass('disabled');
 			$("#btnAcceptImg" + idfic).hide();
 			//
 			Materialize.toast('Image validée', 4000);
	                        //Passage en mode modifié
	                        setIsModified();
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
 * [enCoursImage description]
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
 function enCoursImage(idfic)
 {
 	$.ajax(
 	{
 		url : 'ajax/main/index/_ajax.setEnCoursImage.php',
 		type: 'POST',
 		cache : false,
 		data : "i=" + idfic + "&u=" +$("#id_user").val(),
 		dataType : 'html',
 		success : function(code_html, statut)
 		{
 			var html = code_html.trim();
 			//
 			$("#fic" + idfic).addClass('img_encours');
 			//
 			$("#btnEnCoursImg" + idfic).unbind( "click" );
 			$("#btnEnCoursImg" + idfic).addClass('disabled');
 			$("#btnEnCoursImg" + idfic).hide();
 			//
 			Materialize.toast('Image en cours', 4000);
 			//
	                        //Passage en mode modifié
	                        setIsModifiedAdmin();
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
 * [refusImage description]
 * @return {[type]}    [description]
 */
 function refusImage()
 {
 	var idfic = $('#iFormModalRefusImg').val();
 	var motif_refus = $('#motif_refus').val();
 	if(motif_refus == "")
 	{
 		sweetAlert("Erreur", "Merci de saisir le motif de votre refus.", "error");
 	}
 	else
 	{
 		$.ajax(
 		{
 			url : 'ajax/main/index/_ajax.setRefusImage.php',
 			type: 'POST',
 			cache : false,
 			data : $("#formModalRefusImg").serialize(),
 			dataType : 'html',
 			success : function(code_html, statut)
 			{
 				var html = code_html.trim();
	 			//
	 			$("#fic" + idfic).addClass('img_refus');
	 			$("#btnRefusImg" + idfic).unbind( "click" );
	 			$("#btnRefusImg" + idfic).addClass('disabled');
	 			$("#btnRefusImg" + idfic).hide();
	 			//
	 			$("#btnAcceptImg" + idfic).unbind( "click" );
	 			$("#btnAcceptImg" + idfic).addClass('disabled');
	 			$("#btnAcceptImg" + idfic).hide();
	 			//
	 			$("#btnInfosRefusImg" + idfic).show();
	 			//
	 			$('#modalRefusImg').closeModal();
	 			$('#iFormModalRefusImg').val('');
	 			$('#uFormModalRefusImg').val('');
				//
				Materialize.toast('Image refusée', 4000);
		                        //Passage en mode modifié
		                        setIsModified();
		                    },
		                    error : function(resultat, statut, erreur){
		                    	sweetAlert("Erreur", "Une erreur a été rencontrée.\n" + erreur, "error");
		                    	displaySpinner('hide');
		                    },
		                    complete : function(resultat, statut){
		                    }
		                });
 	}
 }

/**
 * [infosRefusImage description]
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
 function infosRefusImage(idfic)
 {
 	$("#modalInfosRefusImg").openModal();
 	$("#divModalInfosRefusImg").html( '' );
 	$.ajax(
 	{
 		url : 'ajax/main/index/_ajax.getInfosRefusImage.php',
 		type: 'POST',
 		cache : false,
 		data : "i=" + idfic + "&u=" +$("#id_user").val(),
 		dataType : 'html',
 		success : function(code_html, statut)
 		{
 			var html = code_html.trim();
 			//
 			$("#divModalInfosRefusImg").html( html );
 			$('#motif_refus_view').trigger('autoresize');
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
 * [saveEdition description]
 * @return {[type]} [description]
 */
 function saveEdition()
 {
 	displaySpinner('show');
 	var week = $( "#semaine" ).val();
 	var edition = $( "#edition" ).val();
 	if(typeof(edition)=='undefined') edition = '';
 	$.ajax(
 	{
 		url : 'ajax/main/index/_ajax.setSaveEdition.php',
 		type: 'POST',
 		cache : false,
 		data : "s=" + week + "&e=" + edition + "&i=" +$("#id_user").val(),
 		dataType : 'html',
 		success : function(code_html, statut)
 		{
 			var html = code_html.trim();
 			//
 			getBAT();
 			setIsNotModified();
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
 * [saveEditionAllEnCours description]
 * @return {[type]} [description]
 */
 function saveEditionAllEnCours()
 {
 	sweetAlert({
 		title: "Voulez vous vraiment indiquer au client que toutes les pages ont été traités ?",
 		text: "Un mail sera envoyé au client!",
 		type: "warning",
 		showCancelButton: true,
 		confirmButtonColor: "#DD6B55",
 		confirmButtonText: "Oui",
 		cancelButtonText: "Non",
 		closeOnConfirm: true
 	},
 	function(){
 		//displaySpinner('show');
 		var week = $( "#semaine" ).val();
 		var edition = $( "#edition" ).val();
 		if(typeof(edition)=='undefined') edition = '';
 		$.ajax(
 		{
 			url : 'ajax/main/index/_ajax.setSaveEditionAllEnCours.php',
 			type: 'POST',
 			cache : false,
 			data : "s=" + week + "&e=" + edition + "&i=" +$("#id_user").val(),
 			dataType : 'html',
 			success : function(code_html, statut)
 			{
 				var html = code_html.trim();
 			//
 			getBAT();

 			setIsNotModifiedAdmin();
 		},
 		error : function(resultat, statut, erreur){
 			sweetAlert("Erreur", "Une erreur a été rencontrée.\n" + erreur, "error");
 			displaySpinner('hide');
 		},
 		complete : function(resultat, statut){
 		}
 	});
 	});


 }

/**
 * [getImage description]
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
 function getImage(idfic)
 {
 	setTimeout(function(){displaySpinner('show');},500);
 	document.getElementById('download-container').src = '_getDocument.php?i='+idfic;
 	setTimeout(function(){displaySpinner('hide');},5000);
 }

/**
 * [setIsModified description]
 */
 function setIsModified()
 {
      //Passage en mode modifié
      $('#is_modified').val(1);
      $('#callout_is_modified').show();
  }

/**
 * [setIsModifiedAdmin description]
 */
 function setIsModifiedAdmin()
 {
      //Passage en mode modifié
      $('#is_modified').val(1);
      $('#callout_all_en_cours').show();
  }
/**
 * [setIsNotModified description]
 */
 function setIsNotModified()
 {
      //Passage en mode modifié
      $('#is_modified').val(0);
      $('#callout_is_modified').hide();
  }
/**
 * [setIsNotModifiedAdmin description]
 */
 function setIsNotModifiedAdmin()
 {
      //Passage en mode modifié
      $('#is_modified').val(0);
      $('#callout_all_en_cours').hide();
  }