<?php
/**
 * @author      Tom Lous <tomlous@gmail.com>
 * @copyright   2016 Tom Lous
 * @package     package
 * Datetime:     07/02/16 09:35
 */

$text = "ISIS, IS, the Islamic State, ISIL -- the international community can't seem to decide what to call the Islamic extremists who been terrorizing the Middle East, and now the French government has announced it will use yet another name for them, wh..";

$e = exec("/usr/bin/Rscript /root/notsosecretagent-r/sentimentPredictionNaive.R \"$text\"");
var_dump($e);