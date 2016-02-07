<?php
/**
 * @author      Tom Lous <tomlous@gmail.com>
 * @copyright   2016 Tom Lous
 * @package     package
 * Datetime:     06/02/16 19:36
 */
require('config.php');

if(isset($_GET['id'])) {
    $cursor = $elasticCollection->find(array('_id'=>new MongoId($_GET['id'])));
}
else{
    $cursor = $elasticCollection->find(array('_type'=>'twitter', 'classification' => array('$exists' => false)));

}
$cursor->sort(array("_id" => -1));
$cursor->limit(1)->skip(rand(0, 1000));

$obj = $cursor->getNext();
$interaction = $obj['interaction'];
$language = $obj['language'];
$author = $interaction['author'];


?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body>

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="header-container">
    <header class="wrapper clearfix">
        <h1 class="title"><img src="https://d30y9cdsu7xlg0.cloudfront.net/png/36874-200.png" width="50">The "Not so secret agent" Classifier</h1>
        <nav>
            <ul>
<!--                <li><a href="#">nav ul li a</a></li>-->
<!--                <li><a href="#">nav ul li a</a></li>-->
<!--                <li><a href="#">nav ul li a</a></li>-->
            </ul>
        </nav>
    </header>
</div>

<div class="main-container">
    <div class="main wrapper clearfix">

        <article>
            <form method="get" action="submit.php" onsubmit="setContent()">
                <input type="hidden" value="<?=$obj['_id'];?>" name="mongoId">
                <input type="hidden" value="" name="content_translated" id="content_translated">

                <div><b>Terrorisme:</b></div><div class="suggest loading" id="suggest_allignment">Loading...</div>
                <input required="required" type="radio" name="allignment" id="allignment_anti" value="-1" id="mongoId"><label for="allignment_anti">Anti</label>
                <input required="required" type="radio" name="allignment" id="allignment_neutraal" value="0" id="mongoId"><label for="allignment_neutraal">Neutraal</label>
                <input required="required" type="radio" name="allignment" id="allignment_pro" value="1" id="mongoId"><label for="allignment_pro">Pro</label>

                <br> <div><b>Person of interest:</b></div><div class="suggest loading" id="suggest_poi">Loading...</div>
                <input required="required" type="radio" name="poi" id="poi_no" value="0" id="mongoId"><label for="poi_no">Nee</label>
                <input required="required" type="radio" name="poi" id="poi_maybe" value="0.5" id="mongoId"><label for="poi_maybe">?</label>
                <input required="required" type="radio" name="poi" id="poi_yes" value="1" id="mongoId"><label for="poi_yes">Ja</label>


                <br> <div><b>Sentiment:</b></div><div class="suggest loading" id="suggest_sentiment">Loading...</div>
                <input required="required" type="radio" name="sentiment" id="sentiment_neutraal" value="neutral" id="mongoId"><label for="sentiment_neutraal">Neutraal</label>
                <input required="required" type="radio" name="sentiment" id="sentiment_boos" value="angry" id="mongoId"><label for="sentiment_boos">Boos</label>
                <input required="required" type="radio" name="sentiment" id="sentiment_blij" value="happy" id="mongoId"><label for="sentiment_blij">Blij</label>
                <input  required="required" type="radio" name="sentiment" id="sentiment_verdrietig" value="unhappy" id="mongoId"><label for="sentiment_verdrietig">Verdrietig</label>
                <input required="required" type="radio" name="sentiment" id="sentiment_sarcastisch" value="sarcasm" id="mongoId"><label for="sentiment_sarcastisch">Sarcastisch</label>

                <br>
                <input type="submit" value="Opslaan en volgende">
            </form>

            <header>
                <h3><a target="_blank" href="<?=$interaction['link'];?>"> <?=isset($interaction['title'])?$interaction['title']:'link';?></a></h3>

                <p style="border: 1px solid grey; padding: 10px">
                    <iframe id="content" frameborder="0" src="content.php?language=<?=$language['tag'];?>&content=<?=urlencode($interaction['title'].'<br>'.$interaction['content']);?>" width="100%" height="400"></iframe>
<!--                    --><?//=$interaction['content'];?><!--</p>-->
<!--                <p><div id='MicrosoftTranslatorWidget' class='Dark' style='color:white;background-color:#555555'></div><script type='text/javascript'>setTimeout(function(){{var s=document.createElement('script');s.type='text/javascript';s.charset='UTF-8';s.src=((location && location.href && location.href.indexOf('https') == 0)?'https://ssl.microsofttranslator.com':'http://www.microsofttranslator.com')+'/ajax/v3/WidgetV3.ashx?siteData=ueOIGRSKkd965FeEGM5JtQ**&ctf=True&ui=true&settings=Manual&from=';var p=document.getElementsByTagName('head')[0]||document.documentElement;p.insertBefore(s,p.firstChild); }},0);</script></p>-->
                </p>
            </header>



        </article>

        <aside>
            <section>
                <h2>User</h2>
                <p><a target="_blank" href="<?=$author['link'];?>"><img src="<?=$author['avatar'];?>"><?=$author['name'];?> (<?=$author['username'];?>)</a> </p>
                <p>User language: <?=$author['language'];?> </p>
            </section>

            <?php if(isset($interaction['geo'])){
//                print_r($interaction['geo']);
                $coord = $interaction['geo']['latitude'].','.$interaction['geo']['longitude']; ?>
            <p >
                <a target="_blank" href="https://www.google.nl/maps/@<?=$coord;?>,15z?hl=nl"><img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$coord;?>&zoom=9&size=320x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C<?=$coord;?>"></a>
            </p>
            <?php } ?>
            <section>
                <h2>Details</h2>
                <p><b><?=$obj['_type'];?></b> : <?=$interaction['source'];?></p>
                <p><b>Date:</b> <?=$interaction['created_at'];?></p>
                <p><b>Language:</b> <?=$language['tag'];?></p>
            </section>
            <h4>info</h4>
            <p>
                <ul>
                <li><b>MongoId:</b><a href="cat.php?id=<?=$obj['_id'];?>"><?=$obj['_id'];?></a></li>
                <li><b>Elastic:</b><?=$obj['_index'];?>/<?=$obj['_type'];?>/<?=$obj['elastic_id'];?> </li>
                <li><b>File:</b><?=basename($obj['filename']);?></li>

            </ul>

            </p>
        </aside>

    </div> <!-- #main -->
</div> <!-- #main-container -->

<div class="footer-container">
    <footer class="wrapper">
        <h3></h3>
    </footer>
</div>
<pre>
<!--    --><?php //print_r($obj); ?>

</pre>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="js/main.js"></script>


<script>
    getSentiment(<?=json_encode($interaction['content']);?>);
    getAllignment(<?=json_encode($interaction['content']);?>);
    getPOI(<?=json_encode($interaction['content']);?>);


</script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
//    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
</body>
</html>

