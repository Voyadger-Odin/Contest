function inputIMG(data){
    console.log(data)
    document.getElementById('tasks-group-img').setAttribute('src', data)
}

function deleteTasksGroup(tasksGroupTitle, csrf, delete_tasks_group_url){
    let result = confirm('Вы уверены, что хотите удалить группу ' + tasksGroupTitle)
    if (result){
        let data = new FormData()
        data.append('_token', csrf)
        httpRequest(delete_tasks_group_url, 'POST', data=data, synchronous=false, callback=function (response) {
            if (response.status === 200){
                location.reload()
            }else{
                response = JSON.parse(response.responseText)
                alert(response['response'])
            }
        })
    }
}
