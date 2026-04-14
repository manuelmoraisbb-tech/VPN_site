<?php require_once __DIR__ . '/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VPNFiles | arquivos para unitel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: #0b0e14; color: white; font-family: sans-serif; }
        .card { background: rgba(30, 41, 59, 0.5); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.05); transition: 0.3s; }
        .card:active { transform: scale(0.98); }
    </style>
</head>
<body class="p-6 flex flex-col items-center min-h-screen">
    <header class="text-center py-12">
        <h1 class="text-5xl font-black italic text-blue-500 tracking-tighter">vpnfiles</h1>
        <p class="text-[9px] tracking-[0.4em] text-slate-500 uppercase font-bold mt-2">O site possui anúncios ,depois de seres redirecionado clica no botão de voltar</p>
    </header>

    <div class="w-full max-w-sm space-y-5">
        <a href="vpn.php?app=http_injector" class="card flex items-center p-6 rounded-[2.5rem] block border-l-4 border-l-blue-600">
            <img src="assets/icons/http_injector.png" class="w-14 h-14 rounded-2xl mr-4 shadow-xl shadow-blue-500/10">
            <div>
                <h2 class="text-xl font-bold italic">HTTP Injector</h2>
                <span class="text-[9px] bg-blue-600/20 text-blue-400 px-2 py-0.5 rounded font-black uppercase">6 Minutos Exp.</span>
            </div>
        </a>

        <a href="vpn.php?app=tcx_tunnel" class="card flex items-center p-6 rounded-[2.5rem] block border-l-4 border-l-orange-500">
            <img src="assets/icons/tcx_tunnel.png" class="w-14 h-14 rounded-2xl mr-4 shadow-xl shadow-orange-500/10">
            <div>
                <h2 class="text-xl font-bold italic">TCX Tunnel+</h2>
                <span class="text-[9px] bg-orange-600/20 text-orange-400 px-2 py-0.5 rounded font-black uppercase">1 Hora Exp.</span>
            </div>
        </a>
    </div>

    <p class="mt-auto text-slate-700 text-[10px] font-bold py-6 uppercase tracking-widest text-center">
        Arquivos atualizados<br>em cada 12 horas
    </p>
</body>
</html>