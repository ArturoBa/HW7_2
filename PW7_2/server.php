<?php 

    if($_POST){
        //Archivo para la autorizacion
        $putAut = $_POST["autorization"];
        file_put_contents("aut.txt", $putAut);
    }
    else{
        $autorization = file_get_contents("aut.txt");
        echo $autorization;
    }
?>