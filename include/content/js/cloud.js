function greetUser(){
    userName = readCookie("cloudUserName");
    if (userName){
        alert('Привет, '+userName+'! Я соскучился!');
    }else{
        userName = prompt('Как тебя зовут?','Введи сюда свое имя');
        writeCookie("cloudUserName", userName, 7);
        alert('Привет, '+userName+'! Рад знакомству!');
    }
    
}

function getRandomSec(min,max) {
    min *= 1000;
    max *= 1000;
    return Math.floor(Math.random()*(max - min)) + min;
}

function createCloud(mood){
    document.getElementById("cloudImg").src = "img/" + mood + ".png";
}

function saveCloudMood(){
    var i = 1;
    var string = '';
    var result = '';
    // получаю ссылку на изображение и записываю в строку
    var cloud = document.getElementById("cloudImg").src
    // извлекаю название файла из строки
    while(cloud.charAt(cloud.length - i) !== '/'){
        string += cloud.charAt(cloud.length - i);
        i++;
    }
    // переворачиваю название файла и убираю расширение    
    for (var u = string.length; u >= 4; u--){
        result += string.charAt(u);
    }
    
    return result;
}

function cloudHappy(){
    createCloud("happy");
    if (window.sadTimerID !== undefined){
        clearInterval(window.sadTimerID);
        window.sadTimerID = undefined;
    }
    window.sadTimerID = setTimeout(function(){
        createCloud("sad");
        if(userName) alert (userName+', Мне скучно, поиграй со мной!');
    }, 30*1000);
      
}

function angryStart(){
    if (window.angryTimerID !== undefined){
        clearInterval(window.angryTimerID);
        window.angryTimerID = undefined;
    }
        
    var angryTimerID = setInterval(function(){
        var cloud = saveCloudMood()
        createCloud('angry');
        if(userName) alert (userName+', Я злой! Сейчас расфигачу тут все!!!');
        setTimeout(function(){
            createCloud(cloud)
        }, getRandomSec(5, 7));
    }, getRandomSec(10, 15));
    
    return angryTimerID;
}

function angryStop(){
    
    clearInterval(window.angryTimerID);
    //    createCloud('happy');
    setTimeout(function(){ 
        window.angryTimerID = angryStart();
    }, getRandomSec(25, 30));
}
    
function showTimer(str, i, id){
    if (showTimerID !== undefined){
        clearInterval(showTimerID);
        showTimerID = undefined;
    }
    showTimerID = setInterval(
        function(){
            
            if(i == 0 || i < 0) clearInterval(showTimerID);
            else document.getElementById(id).innerHTML = str+i+' сек';
            i--;
        }, 1000);
}    

function resizeCloud(){
    document.getElementById('cloudImg').style.height = ((window.innerHeight - 100) * 0.8) + 'px';
}