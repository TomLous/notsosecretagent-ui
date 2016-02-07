function setContent(){
    console.log($("#content").contents().html());
}

function getSentiment(content){
    console.log(content);
    $.get('http://178.62.232.68/notsosecretagent-ui/predict_sentiment.php', {"content": content}, function(data){
        console.log(data);
        if(!data){
            data = 'unknown';
        }
        $('#suggest_sentiment').html( data);

        if(data != 'unknown' && !data.match(/error/ig) && !data.match(/execution/ig)) {
            $('#suggest_sentiment').removeClass('loading').addClass('done');
        }
    })
}

function getAllignment(content){
    console.log(content);
    $.get('http://178.62.232.68/notsosecretagent-ui/predict_allignment.php', {"content": content}, function(data){
        console.log(data);
        if(data == 0){
            data = "neutral"
        }else if(data == -1){
            data = "anti"
        }else if(data == 1){
            data = "pro"
        }
        else{
            data = 'unknown';
        }

        $('#suggest_allignment').html( data);

        if(data != 'unknown' && !data.match(/error/ig) && !data.match(/execution/ig)) {
            $('#suggest_allignment').removeClass('loading').addClass('done');
        }
    })
}

function getPOI(content){
    console.log(content);
    $.get('http://178.62.232.68/notsosecretagent-ui/predict_poi.php', {"content": content}, function(data){
        console.log(data);
        if(data == 0){
            data = "no"
        }else if(data == 0.5){
            data = "unsure"
        }else if(data == 1){
            data = "yes"
        }
        else{
            data = 'unknown';
        }

        $('#suggest_poi').html( data);

        if(data != 'unknown' && !data.match(/error/ig) && !data.match(/execution/ig)) {
            $('#suggest_poi').removeClass('loading').addClass('done');
        }
    })
}

$("img").error(function(){$(this).hide();});