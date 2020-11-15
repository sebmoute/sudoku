<?php

// Définition des blocs
$blocs = array(
	1 => [0, 1, 2, 9, 10, 11, 18, 19, 20],
	2 => [3, 4, 5, 12, 13, 14, 21, 22, 23],
	3 => [6, 7, 8, 15, 16, 17, 24, 25, 26],

	4 => [27, 28, 29, 36, 37, 38, 45, 46, 47],
	5 => [30, 31, 32, 39, 40, 41, 48, 49, 50],
	6 => [33, 34, 35, 42, 43, 44, 51, 52, 53],

	7 => [54, 55, 56, 63, 64, 65, 72, 73, 74],
	8 => [57, 58, 59, 66, 67, 68, 75, 76, 77],
	9 => [60, 61, 62, 69, 70, 71, 78, 79, 80]
);

/**
* récupère toutes les clés de la grille pour une position
* @param int $position
* @return array
*/
function getCles($position)
{
	global $blocs;
	// echo 'position => ' . $position;
	// récupère les clés de la ligne
	$numLigne = floor($position / 9);
	$debutDeLigne = intval($numLigne * 9);
	$finDeLigne = $debutDeLigne + 8;
	$clesDeLigne = range($debutDeLigne, $finDeLigne);
	// var_dump($clesDeLigne);
	
	// récupère les clés de la colonne
	$debutDeColonne = $position % 9;
	$finDeColonne = 80 + $debutDeColonne;
	$clesDeColonne = range($debutDeColonne, $finDeColonne, 9);
	// var_dump($clesDeColonne);
	
	// récupère les clés du bloc
	foreach ($blocs as $bloc)
	{
		if (in_array($position, $bloc))
		{
			$clesDeBloc = $bloc;
			break;
		}
	}
	// var_dump($clesDeBloc);
	
	$cles = array_merge($clesDeLigne, $clesDeColonne);
	$cles = array_merge($cles, $clesDeBloc);
	// var_dump($cles);
	
	return $cles;
}


/**
*
* Retour en arrière en cas de blocage
* @param int $position
* @return int
*
*/
function shootLignes($position)
{
	// global $grille;
	$numLigne = floor($position / 9);
	
	if ($numLigne < 3) :
		$position = 0;
	else :
		$debutDeLigne = intval($numLigne * 9);
		$position = $debutDeLigne - 18;
	endif;
	
	return $position;
}


/**
* Génération et remplissage de la table html
* @param array $grille
* @return string
*/
function genererTable($grille)
{
	$table = '<table>';
	for ($y = 0; $y < 9; $y++) {
	
		$table .= '<tr>';
		for ($x = 0; $x < 9; $x++) {
			$z = $y * 9 + $x;
			$table .= '<td>' . $grille[$z] . '</td>';
		}
		$table .= '</tr>';
	}
	$table .= '</table>';
	
	return $table;
}