var mailregex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
var phoneregex = /^(06|07|04)[0-9]{8}$/;
var hourregex = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
var icomregex = /^[0-9]{5}$/;

function switchDiv(rep, div1, div2){
	if ($('#'+rep).is(':checked')){
		$('#'+div1).show();
		$('#'+div2).hide();
	} else {
		$('#'+div2).show();
		$('#'+div1).hide();
	}
}
function checkText(id, nb){
	if ($("#"+id).val().length < 2 || $("#"+id).val().length > nb){
		$("#"+id).css('border', '#F80000    2px solid');
		return false;
		} else {
		$("#"+id).css('border','#33CC00 2px solid');
		return true;
	}
}
function checkNumber(id, limit){
	if($("#"+id).val()<1 || $("#"+id).val()>'limit'){
		$("#"+id).css('border', '#F80000    2px solid');
		return false;
	} else {
		$("#"+id).css('border','#33CC00 2px solid');
		return true;
	}
}
function checkRegExp(id, reg){
		if(!reg.test($("#"+id).val())){
		$("#"+id).css('backgroundColor', '#fba');
		return false;
	 } else {
		$("#"+id).css('backgroundColor','');
		return true;
	}
}
function show(rep, div){
	if($('#'+rep).is(':checked')){
		$('#'+div).show();
	} else {
		$('#'+div).hide();
	}
}	
function checkFormation(){
	var Lib=checkText('LIBELLE','32');
	var Inter=checkText('INTERVENANT','32');
	var Ojb=checkText('OBJECTIF','500');
	var Cont=checkText('CONTENU','500');
	var Preq=checkText('PREREQUIS','500');
	var DateDeb=checkDate('DATE_DEB');
	var DateFin=checkDate('DATE_FIN');
	var HeureDeb=checkRegExp('HEURE_DEB', hourregex);
	var HeureFin=checkRegExp('HEURE_FIN', hourregex);
	var NbPlace=checkNumber('NOMBRE_PLACE', '20');
	if ($("#PRIX_REPAS").is(':checked')){	
		var repas=checkNumber('PRIX_REPAS', '50'); 
	} else { 
		var repas=true; 
	}
	if (Lib && Inter && Ojb && Cont && Preq && DateDeb && DateFin && HeureDeb && HeureFin && repas && NbPlace){
		alert("Yes");
		return true;
	} else {
		alert("No");
		return false;
	}
}
function checkMembre(){
	if ($("#assoc_y").is(':checked')){
		var searchNOM=checkText('searchNOM', '32');
		var checkMemNom=true;
		var chechMemICOM=true;
		var checkMemTel=true
	} else {
		var searchNOM=true;
		var checkMemNom=checkText('NOM', '32');
		var chechMemICOM=checkICOM();
		var checkMemTel=checkPhone('TELEPHONE');
	}
	var checkMemNomM=checkText('NOM_M','32');
	var checkMemPrenom=checkText('PRENOM_M','32');

	if ($("#rp_y").is(':checked')){
		var checkMemMailRP=checkMail('MAIL_RP');
		var checkMemPhoneRP=checkPhone('TEL_RP');	
		var checkMemFaxRP=checkPhone('FAX_RP');
	} else {
		var checkMemMailRP=true;	
		var checkMemFaxRP=true;		
		var checkMemPhoneRP=true;
	}
	if (searchNOM && checkMemNom && checkMemTel && checkMemNomM && checkMemPrenom && checkMemMailRP && checkMemPhoneRP && checkMemFaxRP){
		alert("yes");
		return true;
		} else	{
		alert("no");
		return false;
	}
}
function checkDate(id)
{
  var currVal = $("#"+id).val();
  if(currVal == ''){
    	$("#"+id).css('backgroundColor', '#fba');
      return false;}
  
  //Declare Regex  
  var rxDatePattern = /^(\d{4})(\/|-)(\d{1,2})(\/|-)(\d{1,2})$/;
  var dtArray = currVal.match(rxDatePattern); // is format OK?

  if (dtArray == null){
    	$("#"+id).css('backgroundColor', '#fba');
       return false;}
 
  //Checks for mm/dd/yyyy format.
  dtYear = dtArray[1];
  dtDay= dtArray[6];
  dtMonth = dtArray[9]; 

  if (dtMonth < 1 || dtMonth > 12){
    	$("#"+id).css('backgroundColor', '#fba');
        return false;}
  else if (dtDay < 1 || dtDay> 31){
  	$("#"+id).css('backgroundColor', '#fba');
      return false;}
  else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31){
    	$("#"+id).css('backgroundColor', '#fba');
        return false;}
  else if (dtMonth == 2)
  {
     var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
     if (dtDay> 29 || (dtDay ==29 && !isleap)){
          	$("#"+id).css('backgroundColor', '#fba');
               return false;}
  }
  $("#"+id).css('backgroundColor','');
  return true;
}
function showmenu(id){
	$("#"+id).show();	
}
function hidemenu(id){
	$("#"+id).hide();
}