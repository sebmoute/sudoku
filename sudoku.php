<?php
/**
* @description Générateur de grilles de sudoku PHP
* Sébastien Debauche - sebastien.debauche@lapiscine.pro
* 2020
* CSS de Alexander Erlandsson https://codepen.io/alexerlandsson/pen/mPWgpO
* Pour le fun :o)
*/

/*
 ASTUCE
   en gros, si ça marche pas, tu effaces ta ligne et la recommence ;)
   ce que j'ai fait perso c'est un compteur et si ça marche pas x fois, je recommence la ligne, si ça marche pas j'efface les deux dernières lignes et recommence à partir de là 
   d'ou le fait que parfois ça revient plein de fois en arrière,
   ligne 1, 2, 3, 4, 5, 5, 5, 4, 4, 4, 3, 4, 5, ...
*/

include('sudoku-inc.php');


$begin_time = array_sum(explode(' ', microtime()));      // Départ du chrono
$steps = 0;                                              // init du nb d'étapes
$essai = 0;                                              // init de la valeur de départ
$test = false;                                           // init de la valeur de test
$position = 0;                                           // init de la position
$passage = $grille = array_fill(0, 80, null);            // init de la grille

// var_dump($grille);

////////////////////////////////////// Logique //////////////////////////////////
for ($position; $position < 81; $position++) 
{
   // on récupère les clés de la grille autour de la position
   $cles = getCles($position); // var_dump($cles);die();
     
   while (!in_array($randomNumber, $cles)) // tant que le chiffre est présent autour de la case
   {
      if ($essai > 18)
      {
         $position = shootLignes($position); //echo 'pouet';die();
         // $position -= 2;
         // if ($position < 0)
         //    $position = 0;
         $essai = 0;
         echo 'val > 9 - pos = ' . $position . '<br>';
         break;
      }
      $randomNumber = mt_rand(1, 9);
      
      $essai++;
      // $test = checkLigne($essai, $position);      
   }

   $grille[$position] = $randomNumber;
   $steps++;
   
   $essai = 0; // RAZ
   $test = false; // RAZ
   
}

// $grille = range(0,80); // pour écraser la grille pour debug

// génération de la table html
$table = genererTable($grille);

var_dump($grille);
?>


<!-- template -->
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>sudoku generator</title>
    <link rel="stylesheet" href="sudoku.css">
    <!-- <script src="sudoku.js"></script> -->
</head>
<body>
<div id="cadre">
    <h2>sudoku generator</h2>
    <?= ($grille[80]) ? $table : '💣 Problème de génération de la grille :(';	 ?>
    <div id="new"><a href="javascript:location.reload(true)">nouvelle grille</a></div>
    <?php $end_time = array_sum(explode(' ', microtime())); ?>
    <br>⏱️ Page générée en <?= round(($end_time - $begin_time), 4) ?> secondes et en <?= $steps ?> étapes
</div>
</body>
</html>