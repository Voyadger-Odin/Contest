
function httpRequest(url, type, data=null, synchronous=true, callback=null)
{
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.open( type, url, synchronous ); // false for synchronous request

    if (!synchronous){
        xmlHttp.onreadystatechange = function() {
            if (this.readyState !== 4) return;
            callback(this)
        }
    }

    xmlHttp.send(data);
}

function NumWord(value, words)
{
    value = Math.abs(value) % 100;
    var num = value % 10;
    if(value > 10 && value < 20) return words[2];
    if(num > 1 && num < 5) return words[1];
    if(num == 1) return words[0];
    return words[2];
}

function SecondsName(seconds)
{
    return NumWord(seconds, ['секунда', 'секунды', 'секунд'])
}
