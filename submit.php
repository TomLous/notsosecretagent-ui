<?php
/**
 * @author      Tom Lous <tomlous@gmail.com>
 * @copyright   2016 Tom Lous
 * @package     package
 * Datetime:     06/02/16 21:30
 */
require('config.php');
$id = new MongoId($_GET['mongoId']);
unset($_GET['mongoId']);

$cursor = $elasticCollection->find(array('_id' => $id));
$cursor->limit(1)->skip(0);

$document = $cursor->getNext();
$document['classification'] = $_GET;
unset($document['_id']);
$elasticCollection->update(array('_id'=> $id), array('$set'=>$document));


$classifiedCollection = $mongoClient->selectCollection('AIVD', 'classified');
$classifiedCollection->insert($document);




header("Location: cat.php");