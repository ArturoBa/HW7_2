<html>
<head>
    <title>Calle A</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style>
        #main{
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="main"></div>
    
    <script>
        <?php 
            $tiempo = JSON_decode(file_get_contents("time.txt"),1);
        ?>
        
        var color = "red";
        var aut = "<?php echo file_get_contents("aut.txt"); ?>";
        var tiempo = 0;
        
        //Llamado del div
        function getDiv(div){
            return document.getElementById(div);
        }
        
        //Llamado del Local Storage
        function localS(name, data){
            return localStorage.setItem(name, data);
        }
        
        //Control de luces
        function controlFlow(){
            $.ajax({
                url: "server.php",
                method: "get",
                success: function(r){
                    aut = r;
                }
            });
            if(aut == "no"){    
                if(color == "red" && tiempo > <?php echo $tiempo["red"] ?>){
                    getDiv("main").style.background = "green";
                    color = "green";
                    tiempo = 0;
                }
                else if(color == "yellow" && <?php echo $tiempo["yellow"] ?>){
                    //En este momento la luz ya se pone roja, el ciclo termina y le digo que autorize a la calle b a comenzar
                    getDiv("main").style.background = "red";
                    color = "red";
                    toServer("yes");
                    tiempo = 0;
                }
                else if(color == "green" && tiempo > <?php echo $tiempo["green"] ?>){
                    getDiv("main").style.background = "yellow";
                    color = "yellow";
                    tiempo = 0;
                }
            }
            tiempo++;
        }
        
        //Datos de utorizacion al servidor
        function toServer(autorization){
            $.ajax({
                url: "server.php",
                method: "post",
                data: {"autorization": autorization}
            });
        }
        
        setInterval(controlFlow, 1000);
    </script>
</body>
</html>