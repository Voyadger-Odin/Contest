<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        table, th, td {
            border: 1px solid;
        }
        td {
            padding: 5px 50px;
        }
        table {
            border-collapse: collapse;
        }

        .disable{
            display: none;
        }
    </style>
</head>
<body>
<center>
    <h1>CONTEST</h1>
    <h2><span class="disable" id="success-test">✓</span>Задание 1 - Умножатор</h2>
</center>
Написать программу, которая умножает число на 2

<br><br><br><br>
<hr>
<br><br>

Язык программирования -
<select name="language" id="language">
    <!--<option value="">Выберите язык программирования</option>-->
    <option value="python-3.11">python - 3.11</option>
    <option value="c++-13.1">c++ - 13.1</option>
    <option value="java-17">java - 17</option>
</select>
<br><br>
<textarea cols="100" rows="20" name="code" id="code">
a = int(input())
print(a * 2)</textarea>

<br><br>
<button onclick="sendCode()">Отправить</button>

<br><br>
<div class="disable" id="loader">На проверке...</div>
<table class="disable" id="table-result">
    <thead>
        <tr>
            <td>Test</td>
            <td>Status</td>
        </tr>
    </thead>
    <tbody id="table-result-data">
        <tr>
            <td>Test 1</td>
            <td>OK</td>
        </tr>
    </tbody>
</table>

<script>
    function httpPost(url, data, callback)
    {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "POST", url, true ); // false for synchronous request

        xmlHttp.onreadystatechange = function() {
            if (this.readyState != 4) return;
            callback(this.responseText)
        }

        xmlHttp.send(data);
    }

    function createTable(tests){
        let result = ''
        tests.forEach((element) => {
            result += '<tr><td>'
            result += element['test']
            result += '</td><td>'
            result += element['status']
            result += '</td></tr>'
        });
        return result
    }

    function sendCode(){
        document.getElementById('table-result').classList.add('disable')
        document.getElementById('loader').classList.remove('disable')

        let url = 'http://127.0.0.1:5000/check'
        let data = new FormData()
        data.append('language', document.getElementById('language').value)
        data.append('code', document.getElementById('code').value)
        httpPost(url, data, getResult)
    }

    function getResult(responseText){
        let result = JSON.parse(responseText)

        document.getElementById('loader').classList.add('disable')
        document.getElementById('table-result-data').innerHTML = createTable(result['tests'])
        document.getElementById('table-result').classList.remove('disable')
        if (result['success']){
            document.getElementById('success-test').classList.remove('disable')
        }else{
            document.getElementById('success-test').classList.add('disable')
        }
    }

</script>
</body>
</html>
