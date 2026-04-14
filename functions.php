<?php
date_default_timezone_set('Africa/Luanda'); 

function getAdflyLink($app_id) {
    $links = [
        'http_injector' => 'http://adf.ly/link_do_injector',
        'tcx_tunnel'    => 'http://adf.ly/link_do_tcx'
    ];
    return $links[$app_id] ?? '#';
}

function getActivePath() {
    $dia = date('d'); 
    $hora = (int)date('H');
    $slot = ($hora < 12) ? '1' : '2';
    return "configs/day{$dia}/{$slot}/";
}

function lerConteudo($nome_vpn, $is_pass = false) {
    $path = getActivePath();
    $extensao = $is_pass ? "_pass.txt" : ".txt";
    $arquivo = __DIR__ . '/' . $path . $nome_vpn . $extensao;
    return file_exists($arquivo) ? file_get_contents($arquivo) : null;
}
?>