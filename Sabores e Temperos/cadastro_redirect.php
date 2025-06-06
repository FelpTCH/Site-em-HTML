<?php
ini_set('session.gc_maxlifetime', 86400); // 24 horas em segundos
session_set_cookie_params(86400); // Cookie válido por 24 horas

session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: perfil.php");
} else {
    header("Location: cadastro.html");
}
exit;
