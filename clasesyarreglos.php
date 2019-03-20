<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
      
            //uso de clases en PHP
            class user{
                public $name, $surname;
                
                //funcion que retorna variables de la clase
                function returnName(){
                    return $this->name;
                }
                
                //manejo de constructor en php
                function __construct($a, $b){
                    $this->name = $a;
                    $this->surname = $b;
                }
                
                //manejo metodos estaticos
                static function funcionEstatica(){
                    echo "Ya veras";
                }
            }
            
            //clase que hereda de otra clase
            class empleado extends user{
                public $sede, $direccion;
                
                function __construct($a, $b, $c, $d) {
                    parent::__construct($a, $b);
                    
                    $this->sede = $c;
                    $this->direccion = $d;
                }
            }
            
            //creacion de una instancia de clase
            $newUser = new user("Edward", "Guzman");
            print_r($newUser);
            
            //cambio de los parametros de la clase.
            $newUser->name = "Edna";
            $newUser->surname = "Olivar";
            print_r($newUser);
            
            echo $newUser->returnName();
            
            //llamada funcion estatica
            User::funcionEstatica();
            
            //uso de constructor de una clase heredada
            $newEmpleado = new empleado("Oscar", "Quiroz", "La carbonera", "Av los olmos");
            print_r($newEmpleado);
            
            echo "<br>";
            //uso de arrays
            $arreglo = array('usuario' => "belengerkuma",
                'nombre' => "Edward",
                'ciudad' => "Palmira");
            $ciudad = array ("Palmira", "Cali", "Bogota", "Ibague");
            
            //recorrido de arreglo por referencia
            foreach ($arreglo as $item => $descripcion){
                echo "$item" . " -> " . "$descripcion" . "<br>";
            }
            
            echo is_array($ciudad)? "Es un arreglo"."<br>" : "No es un arreglo"."<br>";
            echo "El numero de elementos del arreglo ciudad es: " . count($ciudad) . "<br>";
            
            //organiza arreglo de forma ascendente
            sort($ciudad, SORT_STRING);
            print_r($ciudad);
            
            echo "<br>";
            
            //organiza arreglo de forma descendente
            rsort($ciudad, SORT_STRING);
            print_r($ciudad);
            
            echo "<br>";
            
            //randomiza el lugar de los elementos del arreglo
            shuffle($ciudad);
            print_r($ciudad);
            
            echo "<br>";
            
            //crea arreglo a partir de una cadena de caracteres
            $cadena = "El Dios de los hindues es Buda, un actor importante";
            $arrayCadena = explode(' ', $cadena);
            print_r($arrayCadena);
        ?>
    </body>
</html>
