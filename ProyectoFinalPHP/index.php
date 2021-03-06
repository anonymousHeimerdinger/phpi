<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test</title>
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/main.css" />

        <!-- jQuery -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- jQuery Validation-->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
    </head>
    <body>
        <div id="wrapper">
            
            <?php
                session_start();
                session_destroy();
            ?>
            
            <form action="test.php" method="post">
                <div class="block">
                    <label>Nombre: </label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="block">
                    <label>DNI: </label>
                    <input type="text" name="dni" id="dni">
                </div>
                <input type="submit" value="Crear sesión" class="block" id="btn_create_sesion">
            </form>
        </div>
        
        
        <script type="text/javascript">
            //var dni = document.getElementById("dni").innerHTML;
        </script>
    </body>
    <script type="text/javascript">
        $(document).ready(function() {
            $.validator.addMethod('dni', function(value, element){
        	var re = /^[A-z]?\d{8}[A-z]$/;
        	return re.test(value);
            });
            
            $('form').submit(function(e){
        	//e.preventDefault();
        	//ourWeb, journals, socialNetwork, webOffers, others
        	
            }).validate({
        	debug: false,
        	rules: {
        		"name": {required: true},
        		"dni": {required: true,
        			dni: true}
        	},
        	messages: {
        		"name": {required: "el campo esta vacío"},
        		"dni": {required: "el campo esta vacío",
        		dni: "dni incorrecto"}
        	}
            });
        });
        
        //pattern="^((?=.*\d)|(?=.*[-.,;}{¿?*+_/=\)\(\)]))(?=.*[a-z])(?=.*[A-Z]).{8,}$"
    </script>
</html>
