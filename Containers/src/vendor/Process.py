import subprocess, shlex
import requests
from Languages import langs
import json
from pprint import pprint

'''
-1 - In process
0 - OK
1 - Runtime error
2 - Timeout error
3 - Wrong answer
'''

# Запускает процесс в контейнере
def StartProcess(lang, code):
    script_path = f'./src/containers/{lang["compiler"]}/src/{lang["file-name"]}'
    command = f'docker-compose run {lang["compiler"]}'

    f = open(script_path, 'w')
    f.write(code)
    f.close()

    # Запуск выполнения скрипта
    process = subprocess.Popen(
        shlex.split(command),
        stdout=subprocess.PIPE,
        stderr=subprocess.PIPE,
        stdin=subprocess.PIPE,
    )

    # Проверка ожидания ввода
    process_line = b''
    while True:
        process_line += process.stdout.read(1)
        if (not(process.poll() is None) or process_line.decode() == 'starting'):
            break

    return process


# Выполняет тесты
def RunTime(lang, code, stdin, stdout, maxtime):

    stdin = f'{stdin}\n'.encode()
    result = ''
    resultcode = 0

    process = StartProcess(lang=lang, code=code)

    # Ввод данных
    try:
        process.communicate(input=stdin, timeout=maxtime)
        result = process.communicate()
        resultcode = process.returncode
    except subprocess.TimeoutExpired as e:
        resultcode = 2
        process.terminate()


    if (resultcode == 0):
        if (result[0].decode()[:-1] != stdout):
            resultcode = 3

    return resultcode

def saveSolution(code, lang, user, task, callback):
    data = {
        'code': code,
        'lang': lang,
        'user_id': user,
        'task_id': task,
        'status': -1,
    }
    res = requests.post(callback, data=data)
    return res.json()['id']

# Устанавливает результат попытки после прохождения тестов
def setSolutionResult(solution_id, solution_status, tests_result, callback):
    data = {
        'solution_id': solution_id,
        'solution_status': solution_status,
        'result': json.dumps(tests_result),
    }
    res = requests.post(callback, data=data)
    print(res)

# Вызывает выполнение процесса для каждого теста
def checkProc(
        code,
        lang,
        user,
        task,
        tests,
        callback
):
    solution_id = saveSolution(
        code=code,
        lang=lang,
        user=user,
        task=task,
        callback=callback['url_save_solution']
    )

    tests_result = []
    solution_status = -1
    for i in range(len(tests['tests'])):
        print('Test', (i+1))
        result_code = RunTime(
            lang=langs[lang],
            code=code,
            stdin=tests['tests'][i]['stdin'],
            stdout=tests['tests'][i]['stdout'],
            maxtime=tests['maxtime']
        )

        tests_result.append({'test': f'{i + 1}', 'status': result_code})
        solution_status = result_code

        if (result_code != 0):
            break

    setSolutionResult(
        solution_id=solution_id,
        solution_status=solution_status,
        tests_result=tests_result,
        callback=callback['url_set_solution_result']
    )