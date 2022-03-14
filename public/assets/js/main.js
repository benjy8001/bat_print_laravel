var darkoverlay = $(".dark-overlay");
var loadingspinner = $(".loading-spinner");

function displaySpinner(mode)
{
	if(mode == 'show')
	{
		$('body').removeClass('loaded');
	}
	if(mode == 'hide')
	{
		$('body').addClass('loaded');
	}
}

var VK_BSPACE=8,VK_F5=116;function isFromEdit(a){if(window.event)a=window.event;a=a.target?a.target:a.srcElement;return"INPUT"==a.tagName&&("text"==a.type||"password"==a.type)||"TEXTAREA"==a.tagName}function blocBadTouche(a){if(window.event)a=window.event;var b=window.event?a.keyCode:a.which;if(b==VK_BSPACE&&!isFromEdit(a)||b==VK_F5){if(a.keyCode)a.keyCode=0;return!1}return!0};
$(document).ready(function()
{
	document.onkeydown = blocBadTouche;
	displaySpinner('hide');

	console.log("%cCopyright PLUG-IT", "color: blue; font-size: x-large");
	console.log("%cIl s’agit d’une fonctionnalité de navigateur conçue pour les développeurs. Si vous avez été invité(e) à copier-coller quelque chose ici pour activer une fonctionnalité ou pirater le compte d’un tiers, c’est une escroquerie.", "color: red; font-size: 16px;");
});

function deleteThis(id)
{
	sweetAlert({
		title: "Voulez vous vraiment supprimer cette ligne ?",
		text: "Cette action est irreversible!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Oui, supprimer!",
		cancelButtonText: "Non, annuler!",
		closeOnConfirm: false
	},
	function(){
		$('#pk_id_to_delete').val(id);
		$('#formDelete').submit();
	});
}

function getPdf(type, id)
{
	document.getElementById('download-container').src = '_getPdf.php?type='+type+'&id='+id;
}
function getXLS(type, id)
{
	document.getElementById('download-container').src = '_getXLS.php?type='+type+'&id='+id;
}

function goToPage(page, pk_id)
{
	document.formNav.pageNav.value = page;
	if(typeof(pk_id) != 'undefined') document.formNav.pk_id.value = pk_id;
	$('#formNav').submit();
}


/*************************************************************************/
function checkPwdStrength(pswd)
{
	var retour = true;
	if(typeof(pswd) != 'undefined')
	{
					//validate the length
					if ( pswd.length < 8 ) {
						$('#length').removeClass('valid').addClass('invalid');
						retour = false;
					} else {
						$('#length').removeClass('invalid').addClass('valid');
					}
					//validate letter
					if ( pswd.match(/[A-z]/) ) {
						$('#letter').removeClass('invalid').addClass('valid');
					} else {
						$('#letter').removeClass('valid').addClass('invalid');
						retour = false;
					}
					//validate capital letter
					if ( pswd.match(/[A-Z]/) ) {
						$('#capital').removeClass('invalid').addClass('valid');
					} else {
						$('#capital').removeClass('valid').addClass('invalid');
						retour = false;
					}
					//validate number
					if ( pswd.match(/\d/) ) {
						$('#number').removeClass('invalid').addClass('valid');
					} else {
						$('#number').removeClass('valid').addClass('invalid');
						retour = false;
					}
				}
				else
				{
					if ($('#inputPasswordConfirm').val() != $('#inputPassword').val())
					{
						$('#same').removeClass('valid').addClass('invalid');
						retour = false;
					}
					else
					{
						$('#same').removeClass('invalid').addClass('valid');
					}
				}
				return retour;
			}
			/*************************************************************************/

			/*************************************************************************/
			function checkFormPwd(form)
			{
				if(checkPwdStrength(form.inputPassword.value) && checkPwdStrength())
				{
					console.log('ok3');
					var donnees = $(form).serialize();
					form.btnformpwd.disabled = true;
					form.btnformpwd.innerHTML = 'Enregistrement ...';

					$.ajax({
						url : 'ajax/main/_setNewPwd.php', // La ressource ciblée
						type : 'POST', // Le type de la requête HTTP.
						data : donnees,
						dataType : 'html',
						success : function(code_html, statut){ // success est toujours en place, bien sûr !
							$('#bodyModalPwd').html(code_html);
						}
					});
				}
				return false;
			}
			/*************************************************************************/


			/**********************************************************************/
			function setHideReleaseNote(id_user, hide)
			{
				if(hide) hide = 1;
				else hide = 0;

				$.ajax({
					url : '_ajax_setHideReleaseNote.php', // La ressource ciblée
					type : 'POST', // Le type de la requête HTTP.
					data : 'id_ressource=' + id_user + '&hide=' + hide
				});
			}
			/**********************************************************************/