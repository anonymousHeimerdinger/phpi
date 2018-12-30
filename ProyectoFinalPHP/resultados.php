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
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/main.css" />

    </head>
    <body>  
        <?php
        session_start();
        $nota = 0;
        if($_GET && $_SESSION && isset($_SESSION["name"], $_SESSION["dni"]) ){
            $sql = new mysqli('localhost', 'root', '', 'exam');
            $sql->set_charset("utf8");
            /*$query = "SELECT * FROM candidates";
            $tabla = $sql->query($query) or die ("Error de aplicacion: sentencia SQL no valida");
            
            while ($row = mysqli_fetch_row($tabla)){
                if ($row[DNI]==$_POST["dni"]){
                    echo "<option value='".$row[0]."'>".$row[0]."</option>";
                }
            }*/
            
            $root = simplexml_load_file("solutions.xml");
            $i = 1;
            foreach($root as $pregunta){
                if ($pregunta->solution == $_GET["pregunta".$i]){
                    ++$nota;
                }
                ++$i;
            }
        
            echo "Has obtenido una nota de ".$nota;
        }else{
            die("No se ha recibido correctamente el test.");
        }
        session_destroy();
        
            
        ?>
    </body>
</html>
