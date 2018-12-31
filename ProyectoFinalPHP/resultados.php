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
        <div id="wrapper">
            <?php
            session_start();
            $nota = 0;
            ?>
            <div id="btn_volver_login">
                <a href="index.php">Volver a log in</a>
            </div>
            
            
            <?php
            if($_GET && $_SESSION && isset($_SESSION["name"], $_SESSION["dni"]) ){
                $sql = new mysqli('localhost', 'root', '', 'exam');
                $sql->set_charset("utf8");
                $query = "SELECT * FROM candidates";
                $tabla = $sql->query($query) or die ("Error de aplicacion: sentencia SQL no valida");

                while ($row = mysqli_fetch_row($tabla)){
                    if ($row[1]==$_SESSION["dni"]){
                        die("Su DNI ya ha sido calificado.");
                    }
                }

                $root = simplexml_load_file("solutions.xml");
                $i = 1;
                foreach($root as $pregunta){
                    if ($pregunta->solution == $_GET["pregunta".$i]){
                        ++$nota;
                    }
                    ++$i;
                }
                setcookie($_SESSION["dni"], $nota);
                echo "Has obtenido una nota de ".$nota;
                $query = "INSERT INTO candidates (Nombre, DNI) Values ('".$_SESSION['name']."','".$_SESSION['dni']."')";
                $sql->query($query) or die ("Error al insertar en tabla candidatos: sentencia SQL no valida");
                $query = "INSERT INTO qualifications (DNI, Qualification) Values ('".$_SESSION['dni']."','".$nota."')";
                $sql->query($query) or die ("Error al insertar en tabla qualification: sentencia SQL no valida");
            }else{
                die("No se ha recibido correctamente el test.");
            }
            session_destroy();


            ?>
        </div>
        
    </body>
</html>
