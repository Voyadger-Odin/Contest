let taskDescriptionView = null
let taskDescription = null
let md = window.markdownit()
let taskMaxSeconds = null
let taskMaxMemory = null
let taskBtnSave = null
let taskError = null
let editorTaskDescription = null
let editorTaskTest = null
let taskTitle = null

$(document).ready(function () {
    // Find elements
    taskDescriptionView = document.getElementById('task-description-view')
    taskDescription = document.getElementById('task-description')
    taskMaxSeconds = document.getElementById('task-max-seconds')
    taskMaxMemory = document.getElementById('task-max-memory')
    taskBtnSave = document.getElementById('task-btn-save')
    taskError = document.getElementById('task-error')
    taskTitle = document.getElementById('task-title')

    // Description
    let inputDescription = $('#task-description')[0]
    inputDescription.value = descriptionUnFormater(inputDescription.value)
    let modeDescription = 'text/x-markdown';
    editorTaskDescription = new CodeMirror.fromTextArea(inputDescription, {
        lineNumbers: true,
        mode: modeDescription,
    })
    editorTaskDescription.on("change", function(ev){
        createMarkdownDescription(editorTaskDescription.getValue())
    });

    // Tests
    let inputTests = $('#task-tests')[0]
    let modeTests = 'application/json';
    editorTaskTest = new CodeMirror.fromTextArea(inputTests, {
        lineNumbers: true,
        mode: modeTests,
    })
    editorTaskTest.on("change", function(ev){
        createTestsDescription(editorTaskTest.getValue())
    });

    // Set value elements
    createMarkdownDescription(taskDescription.value)
    createTestsDescription(editorTaskTest.getValue())
});

function editTaskTitle(data){
    taskTitle.innerHTML = data
}

function descriptionFormater(data){
    return data.replaceAll('\\\\', '\\\\\\\\')
}
function descriptionUnFormater(data){
    return data.replaceAll('\\\\\\\\', '\\\\')
}

function createMarkdownDescription(data){
    data = descriptionFormater(data);
    let result = md.render(data).replaceAll("&amp;", "&");
    taskDescriptionView.innerHTML = result
    MathJax.typeset()
}

function deleteTask(taskTitle, csrf, delete_task_url){
    let result = confirm('Вы уверены, что хотите удалить задание ' + taskTitle)
    if (result){
        let data = new FormData()
        data.append('_token', csrf)
        httpRequest(delete_task_url, 'POST', data=data, synchronous=false, callback=function (response) {
            if (response.status === 200){
                location.reload()
            }else{
                response = JSON.parse(response.responseText)
                alert(response['response'])
            }
        })
    }
}


function createTestsDescription(data){
    try {
        // Проверка корректности тестов

        let testsData = null
        try {
            testsData = JSON.parse(data)
        }catch (e){
            throw new Error('Неверный формат JSON');
        }

        // maxtime
        if (testsData['maxtime'] === undefined){
            throw new Error('Не найден параметр maxtime');
        }
        if (typeof testsData['maxtime'] !== "number"){
            throw new Error('Параметр maxtime должен быть числом');
        }
        if (testsData['maxtime'] <= 0 ){
            throw new Error('Параметр maxtime должен быть больше 0');
        }

        // memory_size
        if (testsData['memory_size'] === undefined){
            throw new Error('Не найден параметр memory_size');
        }
        if (typeof testsData['memory_size'] !== "number"){
            throw new Error('Параметр memory_size должен быть числом');
        }
        if (testsData['memory_size'] <= 0 ){
            throw new Error('Параметр memory_size должен быть больше 0');
        }

        // tests
        if (testsData['tests'] === undefined){
            throw new Error('Не найден параметр tests');
        }
        if (typeof testsData['tests'] !== "object"){
            throw new Error('Параметр tests должен быть массивом');
        }
        if (testsData['tests'][0] === undefined){
            throw new Error('Нет ни одного теста');
        }

        for(let i=0; i<testsData['tests'].length; i++){
            if (testsData['tests'][i]['stdin'] === undefined){
                throw new Error('Параметр stdin в тесте ' + (i + 1) + ' не найден');
            }
            if (testsData['tests'][i]['stdout'] === undefined){
                throw new Error('Параметр stdout в тесте ' + (i + 1) + ' не найден');
            }
        }

        // Заполнение параметров на странице
        taskMaxSeconds.innerHTML = testsData['maxtime'] + ' ' + SecondsName(testsData['maxtime'])
        taskMaxMemory.innerHTML = testsData['memory_size']

        taskBtnSave.disabled = false
        taskError.classList.add('disabled')
    }catch (e){
        taskBtnSave.disabled = true
        taskError.innerHTML = 'Ошибка при заполнении тестов: ' + e.message
        taskError.classList.remove('disabled')
    }
}

function saveChange(saveUrl, csrf){
    let active = (document.getElementsByName('taskActive')[0].checked) ? 1 : 0
    let taskTitle = document.getElementsByName('taskTitle')[0].value
    let taskDescription = descriptionFormater(editorTaskDescription.getValue())
    let taskTest = editorTaskTest.getValue()

    let data = new FormData()
    data.append('_token', csrf)
    data.append('taskActive', active)
    data.append('taskTitle', taskTitle)
    data.append('taskDescription', taskDescription)
    data.append('taskTest', taskTest)

    httpRequest(saveUrl, 'POST', data, false, callback=function (response) {
        location.reload()
    })
}
