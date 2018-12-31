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
    
    function __construct($_name, $_dni){
        $this->name = $_name;
        $this->dni = $_dni;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getDni(){
        return $this->dni;
    }
}

class Candidates extends Person{
    public $qualification;
    
    public function getQualification(){
        echo $this->qualification;
    }
    
    public function setQualification($qualification){
        $this->qualification = $qualification;
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/main.css" />     
        <!-- jQuery -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- jQuery Validation-->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
    </head>
    <body>
        <?php
        session_start();
        $candidate;
        
        if($_POST && isset($_POST["name"], $_POST["dni"])){
            if (isset($_COOKIE[$_POST["dni"]]) && !is_null($_COOKIE[$_POST["dni"]])){
                die("Su DNI ya ha sido calificado.");
            }
            $candidate = new Candidates($_POST["name"], $_POST["dni"]);
            $_SESSION['name']=$_POST['name'];
            $_SESSION['dni']=$_POST['dni'];
            /*$_SESSION['pregunta1']='x';
            $_SESSION['pregunta2']='x';
            $_SESSION['pregunta3']='x';
            $_SESSION['pregunta4']='x';
            $_SESSION['pregunta5']='x';
            $_SESSION['pregunta6']='x';
            $_SESSION['pregunta7']='x';
            $_SESSION['pregunta8']='x';
            $_SESSION['pregunta9']='x';
            $_SESSION['pregunta10']='x';*/
            
            
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
        
        <div id="wrapper">
            <hearder>
                <h1><?php echo "Nombre: ".$candidate->getName().", DNI: ".$candidate->getDni() ?><a href="index.php">Log out</a></h1>
                
            </hearder>
            <main>
                <form action="resultados.php" method="get">
                    <?php

                    $fp = fopen("questions.date", "r") or die("No se pudo abrir el archivo.");
                    $root = simplexml_load_file("answers.xml");
                    $i = 1;
                    foreach($root as $pregunta){
                        if (!feof($fp)){
                            $linea = fgets($fp);
                            ?>
                            <label for=<?php echo "pregunta".$i ?>><?php echo $i.' - '.$linea?></label>
                            <?php
                        }
                        ?>
                            <div class="block">
                                <input type="radio" name=<?php echo "pregunta".$i ?> value="a" id=<?php echo "pregunta".$i ?>><?php echo $a = $pregunta->a?>
                            </div>
                            <div class="block">
                                <input type="radio" name=<?php echo "pregunta".$i ?> value="b" id=<?php echo "pregunta".$i ?>><?php echo $b = $pregunta->b?>
                            </div>
                            <div class="block">
                                <input type="radio" name=<?php echo "pregunta".$i ?> value="c" id=<?php echo "pregunta".$i ?>><?php echo $c = $pregunta->c?>
                            </div>
                            <div class="block">
                                <input type="radio" name=<?php echo "pregunta".$i ?> value="d" id=<?php echo "pregunta".$i ?>><?php echo $d = $pregunta->d?>
                            </div>

                        <?php
                        $i++;
                    }

                    fclose($fp);
                    ?>
                            <input type="submit" value="Enviar respuestas" class="boton">
                </form>
            </main>
        </div>
        
        
        
        
    </body>
    <script type="text/javascript">
        $(document).ready(function() {
            $('form').submit(function(e){
        	//e.preventDefault();
        	//ourWeb, journals, socialNetwork, webOffers, others
        	
            }).validate({
        	debug: false,
        	rules: {
        		"pregunta1": {required: true},
                        "pregunta2": {required: true},
                        "pregunta3": {required: true},
                        "pregunta4": {required: true},
                        "pregunta5": {required: true},
                        "pregunta6": {required: true},
                        "pregunta7": {required: true},
                        "pregunta8": {required: true},
                        "pregunta9": {required: true},
                        "pregunta10": {required: true}
        	},
        	messages: {
        		"pregunta1": {required: "PENDIENTE DE RESPUESTA"},
                        "pregunta2": {required: "PENDIENTE DE RESPUESTA"},
                        "pregunta3": {required: "PENDIENTE DE RESPUESTA"},
                        "pregunta4": {required: "PENDIENTE DE RESPUESTA"},
                        "pregunta5": {required: "PENDIENTE DE RESPUESTA"},
                        "pregunta6": {required: "PENDIENTE DE RESPUESTA"},
                        "pregunta7": {required: "PENDIENTE DE RESPUESTA"},
                        "pregunta8": {required: "PENDIENTE DE RESPUESTA"},
                        "pregunta9": {required: "PENDIENTE DE RESPUESTA"},
                        "pregunta10": {required: "PENDIENTE DE RESPUESTA"}
        	}, 
                highlight: function(element) {
                    $(element).addClass('error');
                }, 
                unhighlight: function(element) {
                    $(element).removeClass('error');
                }
            });
        });
    </script>
</html>
