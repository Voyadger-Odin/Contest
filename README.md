# Contest (v 1.0.0)
https://voyadger-odin.github.io/Contest/


## Порядок запуска
1. Запустить сервер с компиляторами `Containers/src/main.py`
2. В директории `Server` прописать `docker-compose up -d nginx`

## Ссылки

[контесты](http://localhost:8000/)

[компиляторы](http://localhost:5000/)

## Описание
Разверните собственную contest-платформу для тестирования персонала или студентов.
Создавайте задания и настраивайте компиляторы и языки программирования, необходимые именно вам.

Данная версия включает в себя следующие языки программирования:

| #  | Язык         |   Версия   |   Компилятор |
|:--:|:-------------|:----------:|-------------:|
| 1  | Python       |    3.11    |  python-3.11 |
| 2  | C++          |    3.1     |     gcc-13.1 |
| 3  | Java         |     17     |      java-17 |

Ниже описан процесс добавления других языков программирования

### Решение задания на программирование

Решение задания на программирования. Отображается описания из MarkDown. Есть выбор языка с соответствующей подсветкой. Внизу есть список с предыдущими решениями, их статусе выполнения, содержанием.
![A+B.gif](docs%2Fstatic%2Fvideo%2Fgif%2FA%2BB.gif)

### Создание / редактирование задания

При редактировании задания, можно сразу видеть, как оно будет отображаться в правой части окна. Редактор подсвечивает синтаксис. Если при заполнении тестов допустить ошибку, редактор укажет на неё максимально информативно и не даст сохранить некорректное заполнение.
![task-edit.gif](docs%2Fstatic%2Fvideo%2Fgif%2Ftask-edit.gif)

### MarkDown + LaTeX

Пример отображение различных тегов MarkDown, а также формул
![markdown-view.gif](docs%2Fstatic%2Fvideo%2Fgif%2Fmarkdown-view.gif)

### PDF отображение

Любое задание можно открыть и скачать в формате PDF. Это может быть полезно для собеседования, или в качестве раздаточного материала студентам на олимпиадах.

***НЕ ПОДДЕРЖИВАЕТ ОТОБРАЖЕНИЕ ФОРМУЛ***
![PDFView.gif](docs%2Fstatic%2Fvideo%2Fgif%2FPDFView.gif)

## Настройка языков программирования

Порядок добавления языка программирования:
1. В `Containers/docker-compose.yml` создать новый сервис формата `container-{LANGUAGE}-{VERSION}`
2. Указать image необходимого компилятора
3. В entrypoint указать компиляцию и запуск. Перед запуском ОБЯЗАТЕЛЬНО должно стоять `echo 'starting'`
4. В директории `Containers/src/containers` создать новую директорию с именем сервиса. В ней создать директорию `src`. В ней создать пустой файл формата `main.{LANGUAGE}`
5. Зарегистрировать данный сервис. В файле `Containers/src/Languages.py` добавить запись:
    ```python
    '{YOUR LANGUAGE}': {
        'compiler': '{YOUR CONTAINER NAME}',
        'compiler-name': '{YOUR COMPILER NAME}',
        'language-name': '{YOUR LANGUAGE NAME}',
        'language-codemirror-name': '{CODEMIRROR LANGUAGE MODE}',
        'language-version': '{YOUR LANGUAGE VERSION}',
        'file-name': '{YOUR FILE NAME}'
    },
    ```
6. Чтобы язык программирования появился на сайте, необходимо зайти под администратором и сбросить кэш 