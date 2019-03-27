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
        <!-- Forma de agregar multiples valores a una variable POST para un checkbox, arreglo ice[] -->
        <table>
            <form method = "POST" autocomplete = 'on'> 
                <tr><td><label>Vainilla: <input type = "checkbox" name = "ice[]" value = "Vainilla" autofocus = 'autofocus'><br></label></td></tr>
                <tr><td><label>Cereza: <input type = "checkbox" name = "ice[]" value = "Cereza"><br></label></td></tr>
                <tr><td><label>Chicle: <input type = "checkbox" name = "ice[]" value = "Chicle"><br></label></td></tr>
                <tr><td><input type = "submit" name = "enviar" value = "enviar opciones"></td></tr>
            </form>
        </table>

        <?php
            if (isset($_POST['ice'])){
                $arreglo = $_POST['ice'];
                foreach ($arreglo as $i){
                    echo $i . "<br>";
                }
            }
            
            //para deshacerse de inyecciones en SQL
            $variable = $connection->real_escape_string($variable);

            //para deshacerse de slashes indeseados
            $variable = stripslashes($variable);

            //para eliminar valores html no deseados
            $variable = htmlentities($variable);
            $variable = strip_tags($variable);

            //funcines para esterilizar la informacion, y evitar ataques no deseados
            function sanitizeString($var)
            {
                $var = stripslashes($var);
                $var = strip_tags($var);
                $var = htmlentities($var);
                return $var;
            }

            function sanitizeMySQL($connection, $var)
            {
                $var = $connection->real_escape_string($var);
                $var = sanitizeString($var);
                return $var;
            }

            $var = sanitizeString($_POST['user_input']);
            $var = sanitizeMySQL($connection, $_POST['user_input']);

        ?>
    </body>
</html>
