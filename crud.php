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
            //llamado a variables de conexion de la base de datos
            require_once 'login.php';
            
            //formulario de ingreso de clientes
            echo <<<_END
            <form method = "POST" action = "index.php">
                <table>
                    <tr>
                        <td><label>Numero de identificacion: </label><input type="text" style = "width: 100%;" name = "idcliente" required></td>
                    </tr>
                    <tr>
                        <td><label>Nombre: </label><input type="text" style = "width: 100%;" name = "nombre" required></td>
                    </tr>
                    <tr>
                        <td><label>Direccion: </label><input type="text" style = "width: 100%;" name = "direccion" required></td>
                    </tr>
                    <tr>
                        <td><label>Telefono: </label><input type="text" style = "width: 100%;" name = "telefono" required></td>
                    </tr>
                    <tr>
                        <td><label>Email: </label><input type="text" style = "width: 100%;" name = "email" required></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name = "registrar" value = "Guardar Registro" style = "margin: 0 auto;" required></td>
                    </tr>
                </table>
            </form>
_END;
            
            //constructor de la clase mysqli para la conexion a la base de datos
            $conn = new mysqli($hn, $un, $pw, $db);
            if($conn -> connect_error) die($conn -> connect_error);
            
            //realizacion de una consulta en la base de datos
            $query = 'select * from clientes';
            $resultado = $conn -> query($query);
            if(!$resultado) die ($conn -> connect_error);
            
            //calculo del numero de filas en la tabla busqueda
            $rows = $resultado -> num_rows;
            
            //impresion de datos de la busqueda de la base de datos
            for ($i = 0; $i < $rows; $i++){
                $resultado -> data_seek($i);
                echo 'nombre: ' . $resultado -> fetch_assoc()['nombre'] . '<br>';
                $resultado -> data_seek($i);
                echo 'direccion: ' . $resultado -> fetch_assoc()['direccion'] . '<br>';
                $resultado -> data_seek($i);
                echo 'telefono: ' . $resultado -> fetch_assoc()['telefono'] . '<br><br>';
            }
            
            //impresion de datos de la busqueda de la base de datos, refinamiento en un arreglo y adicion del boton eliminar
            for ($i = 0; $i < $rows; $i++){
                $resultado -> data_seek($i);
                $fila = $resultado -> fetch_array(MYSQLI_NUM);
                
                echo 'nombre: ' . $fila[1] . '<br>';
                echo 'direccion: ' . $fila[2] . '<br>';
                echo 'telefono: ' . $fila[3] . '<br><br>';
                
                echo <<<_END
                        <form method = "POST" action = "index.php">
                        <input type = "hidden" name = "idc" value = "$fila[0]">
                        <input type = "submit" name = "eliminar" value = "eliminar registro"></form>
                        <br><br>
_END;
            }
            
            $resultado -> close();
            $conn -> close();
            
            $conn = new mysqli($hn, $un, $pw, $db);
            if($conn -> connect_error) die($conn -> connect_error);
                 
            //sentencias para registrar nuevos clientes
            if(isset($_POST['registrar'])){
                $idcliente = get_post($conn, 'idcliente');
                $nombre = get_post($conn, 'nombre');
                $direccion = get_post($conn, 'direccion');
                $telefono = get_post($conn, 'telefono');
                $email = get_post($conn, 'email');
                
                $query = "insert into clientes values ($idcliente, '$nombre', '$direccion', $telefono, '$email')";
                $resultado = $conn -> query($query);
                
                if(!$resultado) echo "Hubo un fallo en el guardado: " . $conn -> error;
            }
            
            //sentencias para eliminar los clientes
            if(isset($_POST['eliminar'])){
                $idcliente = $_POST['idc'];
                $query = "delete from clientes where idcliente = $idcliente";
                $resultado = $conn -> query($query);
                if(!$resultado) echo "Hubo un fallo en el guardado: " . $conn -> error;
            }
            
            //metodo para eliminar caracteres o elementos extraños para las consultas sql
            function get_post ($conn, $var){
                return $conn -> real_escape_string($_POST[$var]);
            }

            function mysql_entities_fix_string($conn, $string)
            {
                return htmlentities(mysql_fix_string($conn, $string));
            }
            
            //sentencias para agregar una nueva tabla
            $query = "create table autor (id int auto_increment key, nombre varchar(50), direccion
            varchar(50), primary key(id))";
            $resultado = $conn -> query($query);
            if(!$resultado) echo "Hubo un fallo en la creacion de la tabla: " . $conn -> error;

            //sentencias para eliminar una tabla
            $query = "delete table autor";
            $resultado = $conn -> query($query);
            if(!$resultado)echo "Hubo un fallo en la eliminacion de la tabla: " . $conn -> error;

            //insertar valores en la tabla
            $query = "insert into autor values ('Sopo', 'Av los Remedios 12-15')";
            $resultado = $conn -> query($query);
            if (!$resultado) echo "Hubo un fallo en el ingreso de las filas: " . $conn -> error;

            //uso de placeholders para evitar inyeccion en ingreso a la base de datos
            $stmt = $conn -> prepare('INSERT INTO autor VALUES(?,?)');
            $stmt -> bind_param($nomautor, $dirautor);
            $nomautor = 'Emily Brontë';
            $dirautor = 'Wuthering Heights';

            $stmt->execute();
            printf("%d Fila insertada.\n", $stmt->affected_rows);

            //cierre de las conexiones hechas
            $stmt -> close();
            $conn -> close();
        ?>
    </body>
</html>
