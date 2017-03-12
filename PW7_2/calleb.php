<html>
<head>
    <title>Calle B</title>
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
        var tiempo = 0;
        var aut = "<?php echo file_get_contents("aut.txt"); ?>";
    
        
    function cargar(){
        $.ajax({
                url: "server.php",
                method: "get",
                success: function(r){
                    aut = r;
                }
            });
        if(aut == "yes"){
            if(color == "red" && tiempo > <?php echo $tiempo["red"] ?>){
                document.getElementById("main").style.background = "green";
                color = "green";
                tiempo = 0;
                
            }
            else if(color == "green" && tiempo > <?php echo $tiempo["green"] ?>){
                document.getElementById("main").style.background = "yellow";
                color = "yellow";
                tiempo = 0;
                
            }
            else if(color == "yellow" && tiempo > <?php echo $tiempo["yellow"] ?>){
                //En este momento la luz ya se pone roja, el ciclo termina y le digo a la calle A que dejé de ser autorizado
                document.getElementById("main").style.background = "red";
                color = "red";
                toServer("no");
                tiempo = 0;
            }
        }
        tiempo++;
    }
        
        function toServer(autorization){
            $.ajax({
                url: "server.php",
                method: "post",
                data: {"autorization": autorization}
            });
        }
            
            setInterval(cargar, 1000);
    </script>
</body>
</html>