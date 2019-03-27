<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            //crear una cookie dentro del sitio web
            setcookie('username', 'Hanna', time() + 60 * 60 *24 * 7, '/');

            //accesar a una cookie
            if (isset($_COOKIE['username'])) echo $_COOKIE['username'];

            //destruir una cookie dandole tiempo negativo de activacion
            setcookie('username', 'Hanna', time() - 2592000, '/');

            //autentificacion html dentro del documento
            $username = 'administrador';
            $password = '123456';
            if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
            {
                if($_SERVER['PHP_AUTH_USER']===$username && $_SERVER['PHP_AUTH_PW']=== $password){
                    echo "Bienvenido usuario: " . $_SERVER['PHP_AUTH_USER'];
                }
                else {
                    goto clave;
                    echo "Usuario y contraseñas erroneos...";
                }  
            }
            else
            {
                clave:
                header('WWW-Authenticate: Basic realm="Restricted Section"');
                header('HTTP/1.0 401 Unauthorized');
                die("Por favor ingrese su usuario y contraseña");
            }

            //creacion y destruccion de sesiones en php
            function destroy_session_and_data()
            {
                session_start();
                $_SESSION = array();
                setcookie(session_name(), '', time() - 2592000, '/');
                session_destroy();
            }
            
            //sentencia que limita el tiempo de ejecucion de una sesion
            ini_set('session.gc_maxlifetime', 60 * 60 * 24);

            //sentencia que evalua la ip de un equipo cliente
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

            //sentencia que verifica las diferentes versiones del equipo cliente
            $_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];

            //sentencia para forzar el uso de cookies en el sitio
            ini_set('session.use_only_cookies', 1);

            //sentencia para cambiar el sitio de almacenamiento de las sesiones
            ini_set('session.save_path', '/home/user/myaccount/sessions');
        ?>
    </body>
</html>
