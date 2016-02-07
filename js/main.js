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

        if(data != 'unknown' && !data.match(/error/ig)) {
            $('#suggest_sentiment').removeClass('loading').addClass('done');
        }
    })
}