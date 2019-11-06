<?php

$fotoPerfil = new Recompensa();

include 'condicaoCores2.php';


$xp = new Usuario();

$quantXP = $xp->quantXP($_SESSION['idUsuario']);
?>
<html>
    <head>
        <style>
            #counter{
                position: absolute;
                top:30%;
                left: 50%;
                transform: translate(-50%,-50%);
                z-index: 9;
            }
            #circle2{
                height: 40px;
                width: 40px;
                background-color: lightgray;
                border-radius: 50%;
                position: absolute;
                top:30%;
                left: 50%;
                transform: translate(-50%,-50%);
            }
            #circle3{
                height: 30px;
                width: 30px;
                border-radius: 50%;
                position: absolute;
                top:30%;
                left: 50%;
                transform: translate(-50%,-50%);
            }
        </style>
    </head>
    <body>
        <div id="circle1"></div>
        <div id="circle2"></div>
        <div id="circle3"><img style="width: 30px;border-radius: 50%;position: absolute;" src='foto/<?php
            echo $fotoPerfil->fotoAplicada($_SESSION['idUsuario']);
            ?>'></div>
        <canvas height="200" width="200" id="counter"/>
    </body>

    <?php
    echo '

<script type="application/javascript">
        var counter = document.getElementById("counter").getContext("2d");
        var no = 0; // Starting Point
        var pointToFill = 4.72;  //Point from where you want to fill the circle
        var cw = counter.canvas.width;  //Return canvas width
        var ch = counter.canvas.height; //Return canvas height
        var diff;   // find the different between current value (no) and trageted value (100)

        function fillCounter(){
            diff = ((no/100) * Math.PI*2*10);

            counter.clearRect(0,0,cw,ch);   // Clear canvas every time when function is call

            counter.lineWidth = 5;     // size of stroke

            counter.fillStyle = "#fff";     // color that you want to fill in counter/circle

            counter.strokeStyle = "'.$idCor.'";    // Stroke Color

            counter.textAlign = "center";

            counter.font = "100% monospace";    //set font size and face

            // counter.fillText(no+"%",100,110);       //fillText(text,x,y);
            counter.fillText("'.$quantXP.'",100,110);

            counter.beginPath();
            counter.arc(100,100,17,pointToFill,diff/10+pointToFill);    //arc(x,y,radius,start,stop)

            counter.stroke();   // to fill stroke

            // now add condition

            if(no >= '.$quantXP.')
            {
                clearTimeout(fill);     //fill is a variable that call the function fillcounter()
            }
            no++;
        }

        //now call the function

        var fill = setInterval(fillCounter,15);     //call the fillCounter function after every 50MS
    </script>

';
    ?>


</html>
