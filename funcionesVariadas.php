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
            //uso de printf para expresar variables
            $nombre = "Edward";
            $edad = 33;
            printf("Mi nombre es %s. Tengo %d años lo que es %X en hexadecimal", $nombre, $edad, $edad);
            
            //uso de printf para reemplazar atributos
            printf("<p style= \"color: #%X%X%X\"> Lorem ipsum ad reculorum </p>", 200, 100, 100);
            
            //uso de funcion para asignar cadena a una variable
            $datoVariable = sprintf("Altura del señor es %.2f", 300/7);
            echo $datoVariable . "<br><br>";
            
            //uso de funciones de tiempo para saber lo transcurrido desde una fecha
            //hora minuto segundo dia mes año
            echo mktime(0, 0, 0, 1, 1, 2010) . "<br><br>";
            
            //uso de la funcion date para mostrar una fecha determinada
            echo date("D d M Y H:i:s") . "<br><br>";
            
            //uso de funcion checkdate para saber si la fecha es correcta
            $dia = 12;
            $mes = 2;
            $año = 2010;
            echo checkdate($mes, $dia, $año) ?  "La fecha es correcta" . "<br><br>" : "La fecha es incorrecta" . "<br><br>";
            
            //creacion de archivos en php
            $fh = fopen("testfile.txt", 'w') or die("Fallo al crear el archivo");
            $text = <<<_END
            Line 1
            Line 2
            Line 3
_END;
            fwrite($fh, $text) or die("No se pudo escribir el archivo");
            fclose($fh);
            echo "Archivo escrito con exito" . "<br><br>";
            
            //lectura de archivos en php, cambiar atributo en fopen a lectura
            $fh = fopen("testfile.txt", 'r') or die("Fallo al crear el archivo");
            $lectura = fread($fh, 200);
            echo $lectura . "<br><br>";
            fclose($fh);
            
            //forma de subir archivos a nuestra pagina web y cargarlos en ella, en este caso imagenes
            echo <<<'END'
            <form method = 'POST' action = 'index.php' enctype = 'multipart/form-data'>
            Selecciona el archivo : <input type = 'file' name = 'archivo' size = '10'>
            <input type = 'submit' name = 'cargar'> 
            </form>
END;
            
            if($_FILES){
                $name = $_FILES['archivo']['name'];
                
                //sentencia para evitar nombres de archivos maliciosos
                //$name = strtolower(ereg_replace("[^A-Za-z0-9.]", "", $name));
                
                //validacion del archivo para que sea de un tipo de imagen conocido
                switch($_FILES['archivo']['type'])
                {
                    case 'image/jpeg': $ext = 'jpg'; break;
                    case 'image/gif': $ext = 'gif'; break;
                    case 'image/png': $ext = 'png'; break;
                    case 'image/tiff': $ext = 'tif'; break;
                    default: $ext = ''; break;
                }
                
                if($ext){
                    $n = "image.$ext";
                    
                    move_uploaded_file($_FILES['archivo']['tmp_name'], $n);
                    echo "Cargar imagen $name como $n <br> <img src = '$n' style = 'width : 10%; height : auto; margin : 10px auto; display : block;'>";
                }
                else echo "$name no es una imagen valida" . "<br><br>"; 
            }
            else echo "No se ha cargado ninguna imagen" . "<br><br>";
            
            //sentencias para ejecutar comandos de consola
            $cmd = "dir c:";
            exec(escapeshellcmd($cmd), $output, $status);
            
            if ($status) echo "Exec command failed";
            else
            {
                echo "<pre>";
                foreach($output as $line) echo htmlspecialchars("$line\n");
                echo "</pre>";
            }
        ?>
    </body>
</html>
