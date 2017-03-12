<?php 
    if($_POST){
        //Archivo para los intervalos de tiempo
        file_put_contents("time.txt", JSON_encode($_POST)); 
    }
?>
<html>
<head>
    <title>Administrador</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style>
        body{
            background: #ccc;
        }
        div{
            margin: 10px;
            margin-left: 15%;
            font-family: Verdana;
            font-size: 20px;
        }
        
        input{
            background: #8ED1F0;
        }
        
        button{
            width: 40%;
            height: 50px;
            margin: 0px 0px 0px 70px;
            font-family: Verdana;
            font-size: 26px;
            border: solid 1px #555554;
            border-radius: 10px;
        }
        
        #r{
            /*Div rojo*/
            color: red;
        }
        
        #y{
            /*Div amarillo*/
            color: #C1C800;
        }
        
        #g{
            /*Div verde*/
            color: green;
        }
        
    </style>
</head>
<body>
    <div id="container">
        <div>
            <h2>Administrador de tiempo</h2>
        </div>
        <div id="r">
            Tiempo en rojo <input id="red" type="number"/> <em>segundos</em>
        </div>
        <div id="y">
            Tiempo en amarillo <input id="yellow" type="number"/> <em>segundos</em>
        </div>
        <div id="g">
            Tiempo en verde <input id="green" type="number"/> <em>segundos</em>
        </div>
        <div>
            <button onclick="setTime();" type="button">Ingresar</button>
        </div><div>
            <a href="index.php"><button type="button">Regresar</button></a>
        </div>
    
    </div>
    
    <script>
        
        //Propiedad dentro del arreglo
        function prop(red,yellow, green){
            this.yellow = yellow;
            this.green = green;
        }
        
        //Limpiar campos
        function clean(){
            document.getElementById("red").value ="";
            document.getElementById("yellow").value ="";
            document.getElementById("green").value = "";
        }
        function setTime(){
            red = document.getElementById("red").value;
            yellow = document.getElementById("yellow").value;
            green  =document.getElementById("green").value;
            
            if(red != "" && yellow != "" && green != ""){
            $.ajax({
                url: "admin.php",
                method: "post",
                data: {"red": red, "yellow": yellow, "green": green}
            });
            clean();
            }
            else{
                alert("No puedes dejar campos vacios");
            }
        }
        
    </script>
</body>

</html>