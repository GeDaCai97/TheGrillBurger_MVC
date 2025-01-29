<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path) : bool {
    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path) ? true : false;
}
function is_auth() : bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['nombre']) && !empty($_SESSION);
}
function is_admin() : bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}
function is_adminAdv() {
    if(!isset($_SESSION)) {
        session_start();
    }
    if(isset($_SESSION['userLevel']) && !empty($_SESSION['userLevel'])) {
        $nivel = $_SESSION['userLevel'];
        return ($nivel === '2' || $nivel === '3') ? true : false;
        // $resultado = false;
        // if($nivel === '2' || $nivel === '3') {
        //     $resultado = true;
        // } else {
        //     $resultado = false;
        // }
        
        // return $resultado;
    }
}


//muestra las alertas
function mostrarNotificacion($codigo) {
    switch($codigo) { 
        case 1:
            $mensaje = 'Creado correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}