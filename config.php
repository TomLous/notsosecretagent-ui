<?php
/**
 * @author      Tom Lous <tomlous@gmail.com>
 * @copyright   2016 Tom Lous
 * @package     package
 * Datetime:     06/02/16 18:20
 */

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Europe/Amsterdam');
$ip = '178.62.232.68';
$mongoClient = new \MongoClient('mongodb://'.$ip);

$elasticCollection = $mongoClient->selectCollection('AIVD', 'elastic');



