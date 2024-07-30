<?php
	$jour=array("Mon"=>"Lundi", "Tue"=>"Mardi","Wed"=>"Mercredi","Thu"=>"Jeudi","Fri"=>"Vendredi","Sat"=>"Samedi","Sun"=>"Dimanche");
	$folakandro=array("Matin"=>"maraina", "Après-midi"=>"tolakandro");
	$month = array('Jan'=>"Janvier", 'Feb'=>"Février", 'Mar'=>"Mars", 'Apr'=>"Avril", 'May'=>"Mai", 'Jun'=>"Juin", 'Jul'=>"Juillet", 'Aug'=>"Août", 'Sept'=>"Septembre", 'Oct'=>"Octobre", 'Nov'=>"Novembre", 'Dec'=>"Décembre");
	$nyvolana = array('Jan'=>"Janoary", 'Feb'=>"Febroary", 'Mar'=>"Martsa", 'Apr'=>"Aprila", 'May'=>"May", 'Jun'=>"Jiona", 'Jul'=>"Jolay", 'Aug'=>"Aogositra", 'Sept'=>"Septambra", 'Oct'=>"Oktobra", 'Nov'=>"Novembra", 'Dec'=>"Desembra");
	$nyvolana2 = array('1'=>"Janoary", '2'=>"Febroary", '3'=>"Martsa", '4'=>"Aprila", '5'=>"May", '6'=>"Jiona", '7'=>"Jolay", '8'=>"Aogositra", '9'=>"Septambra", '10'=>"Oktobra", '11'=>"Novembra", '12'=>"Desembra");
	$month2 = array('1'=>"Janvier", '2'=>"Févreier", '3'=>"Mars", '4'=>"Avril", '5'=>"Mai", '6'=>"Juin", '7'=>"Juillet", '8'=>"Août", '9'=>"Septambre", '10'=>"Oktobre", '11'=>"Novembre", '12'=>"Décembre");
	$aujourdhui=$jour[date("D")];
	$mois=$month[date("M")];
	$volana=$nyvolana[date("M")];
	$j=date('d');
	$anne=date('Y');
	$heure=date('H');
	if ($heure > 12){
		$after='Après-midi';
	}else{
		$after='Matin';
	}
	$daty=('Y-m-d');
?>