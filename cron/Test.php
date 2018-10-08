#!/usr/bin/php
<?php
$tiempoInicial = microtime(TRUE);
include 'loademDBAL.php';

echo "Finish \n";
$tiempoFinal = microtime(TRUE);
$tiempoTotal = round(($tiempoFinal - $tiempoInicial));
echo $tiempoTotal . "\n";
?>
