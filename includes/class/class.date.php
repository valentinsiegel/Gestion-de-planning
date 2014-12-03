<?php
class datee
{
//Recherche et affiche la date du premier jour de la semaine
function debutsem($year,$month,$day) {
 $num_day      = date('w', mktime(0,0,0,$month,$day,$year));
 $premier_jour = mktime(0,0,0, $month,$day-(!$num_day?7:$num_day)+1,$year);
 $datedeb      = date('d-m-Y', $premier_jour);
 echo $datedeb;
}
//Fonction qui retourne la date de début de semaine de la date entrée pour le début d'une formation
function datedeb($year,$month,$day) {
 $num_day      = date('w', mktime(0,0,0,$month,$day,$year));
 $premier_jour = mktime(0,0,0, $month,$day-(!$num_day?7:$num_day)+1,$year);
 $datedeb      = date('Y-m-d', $premier_jour);
 return $datedeb;
}
//Recherche et affiche le dernier jour de la semaine
function finsem($year,$month,$day) {
 $num_day      = date('w', mktime(0,0,0,$month,$day,$year));
 $dernier_jour = mktime(0,0,0, $month,7-(!$num_day?7:$num_day)+$day,$year);
 $datefin      = date('d-m-Y', $dernier_jour);
 echo $datefin;
}

//Comment utiliser fonction
//list($d, $m, $y) = explode('-', '26-02-2009'); 
//echo 'DEBUT : '.debutsem($y,$m,$d).' - FIN : '.finsem($y,$m,$d);

}
?>