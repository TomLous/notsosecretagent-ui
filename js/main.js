function setContent(){
    console.log($("#content").contents().html());
}

function getSentiment(content){
    $.get('http://178.62.232.68/notsosecretagent-ui/predict_sentiment.php', {"content": content}, function(data){
        console.log(data);
    })
}