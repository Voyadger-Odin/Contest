let editor = null

let stautsCode = {
    '-1': 'In process',
    '0': 'OK',
    '1': 'Runtime error',
    '2': 'Timeout error',
    '3': 'Wrong answer',
}


$(document).ready(function () {
    // MarkDown
    let md = window.markdownit()
    let result = md.render(markdowntext);
    $('#MarkDownWindow').html(result)
    MathJax.typeset()

    // Code
    let input = $('#editor-area')[0]
    editor = new CodeMirror.fromTextArea(input, {
        lineNumbers: true,
        mode: mode,
    })
});


function languageSelect(data){
    editor.setOption('mode', languages[data])
}


function sendCode(csrf, send_solution_url, user_id, task_id)
{
    let data = new FormData()
    data.append('_token', csrf)
    data.append('language', document.getElementById('language').value)
    data.append('code', editor.getValue())
    data.append('user_id', user_id)
    data.append('task_id', task_id)

    httpRequest(send_solution_url, 'POST', data, false, callback=function () {
        location.reload()
    })
}


function getSolution(get_solution_result_url)
{
    httpRequest(get_solution_result_url, 'GET', null, false, callback=getSolutionCallback)
}
function createSolutionTableResult(solutionTableResult)
{
    let result = ''
    solutionTableResult.forEach((element) => {
        result += '<tr><td>'
        result += element['test']
        result += '</td><td>'
        result += stautsCode[element['status']]
        result += '</td></tr>'
    });
    return result
}
function getSolutionCallback(data)
{
    if (data.status === 200){
        data = JSON.parse(data.responseText)

        $('#solution-id').html(data['id'])
        $('#solution-language').html(data['language'])
        $('#solution-status').html(stautsCode[data['status']])
        $('#solution-area').html(data['code'])

        if (data['status'] !== '-1'){
            $('#solution-table-result').html(createSolutionTableResult(data['result']))
        }
        $('#solution-modal').modal('show')
    }
}
