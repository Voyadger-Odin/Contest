from flask import Flask, request
from flask_cors import CORS
import json
from vendor import Process
from Languages import langs
from pprint import pprint
from threading import Thread
from flask_swagger_ui import get_swaggerui_blueprint

SWAGGER_URL = '/api/docs'  # URL for exposing Swagger UI (without trailing '/')
API_URL = '/static/swagger.yml'  # Our API url (can of course be a local resource)

app = Flask(__name__)

# Call factory function to create our blueprint
swaggerui_blueprint = get_swaggerui_blueprint(
    SWAGGER_URL,  # Swagger UI static files will be mapped to '{SWAGGER_URL}/dist/'
    API_URL,
    config={  # Swagger UI config overrides
        'app_name': "Test application"
    },
    # oauth_config={  # OAuth config. See https://github.com/swagger-api/swagger-ui#oauth2-configuration .
    #    'clientId': "your-client-id",
    #    'clientSecret': "your-client-secret-if-required",
    #    'realm': "your-realms",
    #    'appName': "your-app-name",
    #    'scopeSeparator': " ",
    #    'additionalQueryStringParams': {'test': "hello"}
    # }
)

app.register_blueprint(swaggerui_blueprint)


@app.route('/test', methods = ['GET'])
def test():
    return json.dumps('Python test')

@app.route('/', methods = ['GET'])
def index():
    return app.redirect('/api/docs')

@app.route('/send-solution', methods = ['POST'])
def check():
    try:
        data = request.json

        checkProcThread = Thread(target=Process.checkProc, kwargs={
            'code': data['code'],
            'lang': data['language'],
            'user': int(data['user_id']),
            'task': int(data['task_id']),
            'tests': data['tests'],
            'callback': {
                'url_save_solution': data['url_save_solution'],
                'url_set_solution_result': data['url_set_solution_result'],
            },
        })
        checkProcThread.start()
    except Exception:
        return 'params error'
    return 'ok'

@app.route('/compilers', methods = ['GET'])
def getLanguages():
    return json.dumps(langs)

def StartServer():
    CORS(app)
    app.run(debug=False, host='0.0.0.0')

if __name__ == '__main__':
    StartServer()