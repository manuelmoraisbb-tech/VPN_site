from flask import Flask, render_template, request, abort
from datetime import datetime
import os

app = Flask(__name__)

# Configuração dos Apps e Links Adfly
VPN_APPS = {
    'http_injector': {
        'name': 'HTTP Injector',
        'timer': 360, # 6 min
        'link': 'http://adf.ly/link_injector'
    },
    'tcx_tunnel': {
        'name': 'TCX Tunnel Plus',
        'timer': 3600, # 60 min
        'link': 'http://adf.ly/link_tcx'
    }
}

def get_config_path(app_id, is_pass=False):
    now = datetime.now()
    day = now.strftime("%d")
    slot = "1" if now.hour < 12 else "2"
    ext = "_pass.txt" if is_pass else ".txt"
    # Caminho: configs/day14/1/http_injector.txt
    return os.path.join('configs', f'day{day}', slot, f'{app_id}{ext}')

@app.route('/')
def index():
    return render_template('index.html', apps=VPN_APPS)

@app.route('/vpn/<app_id>')
def vpn_detail(app_id):
    if app_id not in VPN_APPS:
        abort(404)
    
    is_ready = request.args.get('ready') == '1'
    config_data = None
    password = "0000"

    if is_ready:
        path = get_config_path(app_id)
        pass_path = get_config_path(app_id, is_pass=True)
        
        if os.path.exists(path):
            with open(path, 'r') as f: config_data = f.read()
        if os.path.exists(pass_path):
            with open(pass_path, 'r') as f: password = f.read()

    return render_template('vpn.html', 
                           app=VPN_APPS[app_id], 
                           app_id=app_id,
                           is_ready=is_ready, 
                           config=config_data, 
                           password=password)

if __name__ == '__main__':
    app.run(debug=True)