<?php 
require_once __DIR__ . '/functions.php';
$app = $_GET['app'] ?? 'http_injector';
$is_ready = isset($_GET['ready']); 
$conteudo = lerConteudo($app);
$senha = lerConteudo($app, true) ?? "0000";
$adfly_link = getAdflyLink($app);

// Define tempo em segundos: HTTP = 360s (6m), TCX = 3600s (1h)
$tempo_limite = ($app == 'http_injector') ? 360 : 3600;
$nome_display = ($app == 'http_injector') ? 'HTTP Injector' : 'TCX Tunnel Plus';
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Http injector/TCX tunnel plus configs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b0e14] text-white p-6 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-sm bg-slate-900/50 border border-slate-800 rounded-[3rem] p-8 text-center shadow-2xl backdrop-blur-md">
        <a href="index.php" class="text-slate-600 text-[10px] font-black uppercase mb-6 block tracking-widest italic">← Voltar</a>
        
        <img src="assets/icons/<?= $app ?>.png" class="w-20 h-20 mx-auto mb-4 rounded-3xl shadow-2xl">
        <h1 class="text-2xl font-black italic mb-8 uppercase text-blue-500"><?= $nome_display ?></h1>

        <?php if (!$is_ready): ?>
            <p class="text-slate-400 text-sm mb-8 leading-relaxed px-4">Esta configuração será exposta apenas por tempo limitado ,nesse caso tens 6 minutos para exportação do arquivo para http injector e 60 minutos para exportação do arquivo para TCX tunnel plus.</p>
            <a href="<?= $adfly_link ?>" class="bg-blue-600 block w-full py-5 rounded-2xl font-black shadow-lg shadow-blue-600/30">
                Baixar agora
            </a>
 <p class="text-slate-400 text-sm mb-8 leading-relaxed px-4">ao clicar em baixar arquivos serás redirecionado a um anuncio .</p>

        <?php else: ?>
            <div id="secure-box">
                <div class="border-2 border-red-500/50 p-3 rounded-2xl mb-6 text-red-500 font-mono font-black text-xl">
                    EXPIRA: <span id="timer">--:--</span>
                </div>

                <div class="text-left mb-6">
                    <span class="text-[9px] font-black text-blue-500 uppercase ml-4 tracking-widest">Código:</span>
                    <div id="key" class="mt-1 bg-black/60 p-5 rounded-[2rem] border border-white/5 break-all font-mono text-[10px] text-slate-500 h-32 overflow-y-auto">
                        <?= htmlspecialchars($conteudo) ?>
                    </div>
                </div>

                <button onclick="copyKey()" class="bg-green-600 block w-full py-4 rounded-2xl font-black mb-3 active:scale-95 transition">COPIAR CHAVE</button>
                <button onclick="alert('Senha: <?= $senha ?>')" class="bg-slate-700 block w-full py-4 rounded-2xl font-black opacity-50">VER SENHA</button>
            </div>

            <div id="expired" class="hidden py-10">
                <h2 class="text-red-500 font-black text-2xl italic uppercase">Tempo Expirado!</h2>
                <p class="text-slate-500 text-xs mt-2">A chave foi removida por segurança.</p>
                <a href="index.php" class="mt-6 inline-block bg-blue-600 px-6 py-3 rounded-xl font-bold">Tentar de Novo</a>
            </div>
        <?php endif; ?>
    </div>

    <script>
        <?php if ($is_ready): ?>
        let seconds = <?= $tempo_limite ?>;
        const timerDisplay = document.getElementById('timer');
        const secureBox = document.getElementById('secure-box');
        const expiredDiv = document.getElementById('expired');

        const countdown = setInterval(() => {
            let m = Math.floor(seconds / 60);
            let s = seconds % 60;
            timerDisplay.textContent = `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
            
            if (seconds <= 0) {
                clearInterval(countdown);
                secureBox.style.display = 'none';
                expiredDiv.style.display = 'block';
            }
            seconds--;
        }, 1000);

        function copyKey() {
            const text = document.getElementById('key').innerText;
            navigator.clipboard.writeText(text);
            alert("Copiado! Importe agora.");
        }
        <?php endif; ?>
    </script>
</body>
</html>