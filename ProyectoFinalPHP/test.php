<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
class Person{
    public $name;
    private $dni;
    
    function _construct($_name, $_dni){
        $this->name = $_name;
        $this->dni = $_dni;
    }
    
    function getName(){
        return Person::$name;
    }
    
    function getDni(){
        return $this->dni;
    }
}

class Candidates extends Person{
    public $qualification;
    
    function getQualification(){
        return $this->qualification;
    }
    
    function setQualification($qualification){
        $this->qualification = $qualification;
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        //session_destroy();
        $sql = new mysqli('localhost', 'root', '', 'exam');
        $sql->set_charset("utf8");
        if($_POST && isset($_POST["name"], $_POST["dni"])){
            /*$query = "SELECT * FROM candidates";
            $tabla = $sql->query($query) or die ("Error de aplicacion: sentencia SQL no valida");
            
            while ($row = mysqli_fetch_row($tabla)){
                if ($row[DNI]==$_POST["dni"]){
                    echo "<option value='".$row[0]."'>".$row[0]."</option>";
                }
            }*/
            $candidate = new Candidates($_POST["name"], $_POST["dni"]);
            $_SESSION['name']=$_POST['name'];
            $_SESSION['dni']=$_POST['dni'];
            $_SESSION['pregunta1']='x';
            $_SESSION['pregunta2']='x';
            $_SESSION['pregunta3']='x';
            $_SESSION['pregunta4']='x';
            $_SESSION['pregunta5']='x';
            $_SESSION['pregunta6']='x';
            $_SESSION['pregunta7']='x';
            $_SESSION['pregunta8']='x';
            $_SESSION['pregunta9']='x';
            $_SESSION['pregunta10']='x';
            
            
        } else {
            if ($_SESSION && isset($_SESSION["name"], $_SESSION["dni"])){
                $candidate = new Candidates($_SESSION["name"], $_SESSION["dni"]);
                //Pending cambiar preguntas y respuestas en función de lo que ya estaba contestado
            } else {
                //Falta hacer error
                die("No se ha recibido nombre y DNI.");
            }
        }
        ?>
        
        
        
        <form action="resultados.php" method="post">
            <label></label>
            <input type="radio" name="pregunta1a" value="">
            <input type="radio" name="pregunta1b">
            <input type="radio" name="pregunta1c">
            <input type="radio" name="pregunta1d">
            <label></label>
            <input type="radio" name="pregunta2a">
            <input type="radio" name="pregunta2b">
            <input type="radio" name="pregunta2c">
            <input type="radio" name="pregunta2d">
            <label></label>
            <input type="radio" name="pregunta3a">
            <input type="radio" name="pregunta3b">
            <input type="radio" name="pregunta3c">
            <input type="radio" name="pregunta3d">
            <label></label>
            <input type="radio" name="pregunta4a">
            <input type="radio" name="pregunta4b">
            <input type="radio" name="pregunta4c">
            <input type="radio" name="pregunta4d">
            <label></label>
            <input type="radio" name="pregunta5a">
            <input type="radio" name="pregunta5b">
            <input type="radio" name="pregunta5c">
            <input type="radio" name="pregunta5d">
            <label></label>
            <input type="radio" name="pregunta6a">
            <input type="radio" name="pregunta6b">
            <input type="radio" name="pregunta6c">
            <input type="radio" name="pregunta6d">
            <label></label>
            <input type="radio" name="pregunta7a">
            <input type="radio" name="pregunta7b">
            <input type="radio" name="pregunta7c">
            <input type="radio" name="pregunta7d">
            <label></label>
            <input type="radio" name="pregunta8a">
            <input type="radio" name="pregunta8b">
            <input type="radio" name="pregunta8c">
            <input type="radio" name="pregunta8d">
            <label></label>
            <input type="radio" name="pregunta9a">
            <input type="radio" name="pregunta9b">
            <input type="radio" name="pregunta9c">
            <input type="radio" name="pregunta9d">
            <label></label>
            <input type="radio" name="pregunta10a">
            <input type="radio" name="pregunta10b">
            <input type="radio" name="pregunta10c">
            <input type="radio" name="pregunta10d">
            <input type="submit" value="Enviar respuestas">
        </form>
        
        <?php
        // put your code here
        ?>
    </body>
</html>
