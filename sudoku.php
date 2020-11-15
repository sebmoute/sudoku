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
$passage = array_fill(0, 81, null); // var_dump($grille);
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



/**
   * vérifie si le chiffre à placer est disponible
   * @param int $randomNumber
   * @param int $position
   * @return bool
   */
function checkNumber($randomNumber, $position) {
   global $grille;
   // teste si le chiffre est déjà dans la position
   if ($grille[$position] === $randomNumber)
      return false;

   ##### init des variables de la ligne à remplir #####
   // calcule le numéro de ligne
   $numLigne = floor($position / 9);
   // trouve la position de départ de la ligne
   $debutDeLigne = $numLigne * 9;
   // calcule la position de fin de la ligne
   $finDeLigne = $debutDeLigne + 8;
   // calcule le numéro de colonne
   $debutCol = $position % 9;
   
   // teste toute les clés de la ligne
   
   // $ligne = range($debutDeLigne, $position);
   // print_r($ligne);
   
   // if (in_array($randomNumber, $ligne))
   //    return false;
      
   for ($i = $debutDeLigne; $i <= $position; $i++) {
        if ($randomNumber === $grille[$i]) {
            return false;
        }
   }
   
   // teste toute les clés de la colonne
   // for ($j = $debutCol; $j <= 80; $j += 9) {
   //     if ($randomNumber === $grille[$j]) {
   //         return false;
   //     }
   // }

   return true;
}


// vérifie si le nb est dans la ligne
function checkLigne($randomNumber, $position)
{
    global $grille;
    $numLigne = floor($position / 9);
    $debutDeLigne = $numLigne * 9;
    $finDeLigne = $debutDeLigne + 8;
    $result = true;
    
    for ($i = $debutDeLigne; $i <= $finDeLigne; $i++) {
        echo '->i = '.$i;
        if ($randomNumber === $grille[$i]) {
            $result = false;
            break;
        }
    }
/////rajout de checkcol pour test//////
// $indexDebut = $position % 9;
// for ($j = $indexDebut; $j <= 80; $j += 9) {
//     echo '->j = '.$j;
//     if ($randomNumber === $grille[$j]) {
//         $result = false;
//         break;
//     }
// }

///////////
var_dump($result);
echo 'passage N°'.$position;
    return $result;
}

// vérifie si le nb est dans la colonne
function checkCol($randomNumber, $position)
{
    // echo 'checkCol';
    global $grille;
    $indexDebut = $position % 9;
    // $indexFin = 80 + $indexDebut;
    // $indexes = range($indexDebut, $indexFin, 9);
    // echo '<br>';print_r($indexes);echo '<br>';
    $result = true;
    // echo 'indexs->';var_dump($indexes);echo '<-indexs';//die;
    // // var_dump($grille);
    // foreach ($indexes as $index) {
    // 	// echo 'index = '.$index.' - valeur = '.$grille[$index].' - position = '.$position.' - rdmNumber = '.$randomNumber.'<br>';
    // 	// var_dump($grille[$index]);
    // 	if ($randomNumber === $grille[$index]) {
    // 		$result = false;
    //      break;
    // 	}
    //
    // }
    
    // on teste si la valeur ajoutée en construisant la ligne n'est pas déjà égale au nb aléatoire
    if (!$grille[$position] == $randomNumber) {
     

        for ($i = $indexDebut; $i <= 80; $i += 9) {
            // echo '->i = '.$i;
            // if ($grille[$i] == $position)
            
            if ($randomNumber === $grille[$i]) {
                $result = false;
                break;
            }
        }
   
   }
    // echo 'le résultat est ' . ($result)? 'true' : 'false';

    return $result;
}


/*
* check si la valeur est dans un bloc de 9 cases
* Structure :
*  1|2|3
*  4|5|6
*  7|8|9
*/
function checkBloc($randomNumber, $position)
{

    return true;
    // return in_array($chiffre, $bloc);
}


//remplis la grille
function generate()
{
    global $grille;
    global $passage;

    // parcours les 81 valeurs de la grille
    for ($i = 0; $i < 81; $i++) {
        // false tant qu'on a pas de correspondance
        // $good = false;

        // tant que $good est false
        while (is_null($passage[$i])) {

            $randomNumber = random_int(1, 9);
            
            if (checkNumber($randomNumber, $i)) {
            $grille[$i] = $randomNumber;
            $passage[$i] = 1;
            }
            
            // vérifie si le chiffre aléatoire est dans la ligne
            // $ligne = checkLigne($randomNumber, $i);
            // pareil avec la colonne
            // $col = checkCol($randomNumber, $i);
            // $col = true;
            // pareil avec le bloc
            // $bloc = checkbloc($randomNumber, $i);
            // var_dump($ligne);
            // $good = ($ligne && $col);// TODO rajouter le test du bloc
            // $good = $ligne;
            // if (checkLigne($randomNumber, $i)) {
            //             // $good = true;
            //             $grille[$i] = $randomNumber;
            //             $passage[$i] = 1;
            //         }

        
            // si good est toujours true on inscrit le chiffre et on passe à la case suivante
            // if ($good)
        	 //    $grille[$i] = $randomNumber;
        	 //    $passage[$i] = 1;
         }
     }
   }
   
// echo checkLigne(5, 17);die();
generate();
// var_dump($passage);
// $grille = range(0,80); // on écrase la grille pour debug

// génération et remplissage de la table html
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
    <?= ($grille[80]) ? $table : $table; //'Problème de génération de la grille :(';	 ?>
    <div id="new"><a href="javascript:location.reload(true)">nouvelle grille</a></div>
    <?php $end_time = array_sum(explode(' ', microtime())); ?>
    <br>Page générée en <?= round(($end_time - $begin_time), 4) ?> secondes
</div>
</body>
</html>