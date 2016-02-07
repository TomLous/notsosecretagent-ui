<?php
/**
 * @author      Tom Lous <tomlous@gmail.com>
 * @copyright   2016 Tom Lous
 * @package     package
 * Datetime:     07/02/16 09:35
 */
header('Access-Control-Allow-Origin: *');

$path = "/var/www/notsosecretagent-r/";
$text = $_REQUEST['content'];
$text = str_replace('"', "", $text);
$text = str_replace("'", "", $text);
$text = addslashes($text);
//$text = "ISIS, IS, the Islamic State, ISIL -- the international community can't seem to decide what to call the Islamic extremists who been terrorizing the Middle East, and now the French government has announced it will use yet another name for them, wh..";

$cmd = "/usr/bin/Rscript {$path}sentimentPredictionNaive.R \"$text\" \"$path\" 2>&1";
//echo $cmd;
$e = exec($cmd);
print $e;