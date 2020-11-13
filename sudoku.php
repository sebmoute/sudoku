<?php
/*
* Générateur de grilles de sudoku PHP
* Sébastien Debauche - sebastien.debauche@lapiscine.pro
* 2020
* CSS de Alexander Erlandsson https://codepen.io/alexerlandsson/pen/mPWgpO
* Pour le fun :o)
*/

// Départ du chrono
$begin_time = array_sum(explode(' ', microtime()));

// init de la position
// $position = array('col' => 0, 'line' => 0, 'bloc' => 0);
$position = 0;
// var_dump($position);
// init de la grille
$grille = array_fill(0, 81, null); // var_dump($grille);
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
// print_r($blocs);echo '<hr>';// TODO à dégager
// création de la suite de chiffres
// $numbers3 = $numbers1 = $numbers2 = range(0, 9);
// // on mélange
// shuffle($numbers1);
// shuffle($numbers2);

// var_dump($numbers1);

//
// function nextline($numbers){
// 	// global $numbers2;
// 	for ($i = 0; $i <= 2; $i++) {
// 		$randomKey = array_rand($numbers, 1);
// 		unset($numbers[$randomKey]);
// 	}
// 	shuffle($numbers);
// 	// var_dump($numbers);
// 	return $numbers;
// }
// 
// 
// $numbers2 = nextline($numbers2);
// $numbers = nextline($numbers1);





// vérifie si le nb est dans la ligne
function checkLigne($randomNumber, $position){
	global $grille;
	$numLigne = floor($position / 9);
	$debutDeLigne = $numLigne * 9;
	$finDeLigne = $debutDeLigne + 8;
	$result = true;
	for ($i = $debutDeLigne; $i <= $finDeLigne; $i++){
		if ($randomNumber === $grille[$i]) {
			$result = false;
		}
	}

	return $result;
}

// vérifie si le nb est dans la colone
function checkCol($randomNumber, $position) {
	echo 'checkCol';
	global $grille;
	$indexDebut = $position % 9;
	$indexFin = 80 + $indexDebut;
	$indexes = range($indexDebut, $indexFin, 9);
	echo '<br>';print_r($indexes);echo '<br>';
	$result = true;
	// echo 'indexs->';var_dump($indexes);echo '<-indexs';//die;
	// var_dump($grille);
	// foreach ($indexes as $index) {
	// 	echo 'index = '.$index.' - valeur = '.$grille[$index].' - position = '.$position.' - rdmNumber = '.$randomNumber.'<br>';
	// 	var_dump($grille[$index]);
	// 	if ($randomNumber === $grille[$index]) {
	// 		$result = false;
	// 		
	// 	}
	// 	
	// }
	echo 'le résultat est ' . ($result)? 'true' : 'false';
	
	for ($i = $indexDebut; $i <= 80; $i += 9){
		// echo '->i = '.$i;
		if ($randomNumber === $grille[$i]) {
			$result = false;
		}
	}
	
	
		if ($position >= 15){
		// 	var_dump($grille);
		echo 'le résultat est ' . ($result)? 'true' : 'false';

			// die;
		}
	// echo 'result => ' . $result . PHP_EOL;
	// var_dump($result);
	return $result;
}

//check si la valeur est dans un bloc de 9 cases
/*
Structure :
  1|2|3
  4|5|6
  7|8|9
*/
function checkBloc($randomNumber, $bloc){
	
	return true;
	// return in_array($chiffre, $bloc);
}

// définit la position
// function setPosition($pos){
// 	global $position;
// 	
// 	switch ($position) {
// 	case $pos <0:
// 	$position['line'] = 0;
// 	$position['col'] = $pos;
// 	break;
// 	case $pos <19:
// 	$position['line'] = 1;
// 	$position['col'] = $pos - 9;
// 	break;
// 	case $pos <28:
// 	$position['line'] = 2;
// 	$position['col'] = $pos - 18;
// 	break;
// 	case $pos <37:
// 	$position['line'] = 3;
// 	$position['col'] = $pos - 27;
// 	break;
// }
// 	//etc
// }
//remplis la grille
function generate() {
	global $grille;
	// global $position; 
	
	for ($i = 0; $i < 81; $i++) {
	$good = false;
	
	while (!$good) {
		
		$randomNumber = random_int(1, 9);
		
		// vérifie si le chiffre aléatoire est dans la ligne
		// $ligne = checkLigne($randomNumber, $i);
		// pareil avec la colone
		// $col = checkCol($randomNumber, $i);
		// pareil avec le bloc
		// $bloc = checkbloc($randomNumber, $i);
		
		// $good = ($ligne && $col);// TODO rajouter le test du bloc
		
		
		
		// --------------
		
		if (!checkLigne($randomNumber, $i)) {
			$good = false;
			continue;
		}
		else if (!checkCol($randomNumber, $i)) {
			$good = false;
			continue;	
		}
		
		$good = true;
	}	
	// si good est toujours true on inscrit le chiffre et on passe à la case suivante
	if ($good)
		$grille[$i] = $randomNumber;
	}	
		
}
generate();

// $grille = range(0,80); // on écrase la grille pour debug

// génération et remplissage de la table html
$table = '<table>';
for ($y = 0; $y < 9; $y++){
	
	$table .= '<tr>';
	for ($x = 0; $x < 9; $x++){
		$z =  $y * 9 + $x;
		$table .= '<td>' . $grille[$z] . '</td>';
	}	
$table .= '</tr>';
}
$table .= '</table>';

// print_r($grille);

?>


<!-- template -->
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>sudoku</title>
  <link rel="stylesheet" href="sudoku.css">
  <!-- <script src="sudoku.js"></script> -->
</head>
<body>
	<div id="cadre">
		<h2>sudoku generator</h2>
		<?= $table	?>
		<div id="new"><a href="javascript:location.reload(true)">nouvelle grille</a></div>
		<?php 	$end_time = array_sum(explode(' ', microtime()));?>
		<br>Page générée en <?= round(($end_time - $begin_time), 4) ?> secondes</br>
	</div>
</body>
</html>