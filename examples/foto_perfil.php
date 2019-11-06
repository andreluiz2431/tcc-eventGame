<?php
$fotoPerfilBarra = new Recompensa();

include 'condicaoCores2.php';

$xp2 = new Usuario();

$quantXP2 = $xp2->quantXP($_SESSION['idUsuario']);
?>
<html>
    <head>
        <style>
            #counter2{
                position: absolute;
                top:0%;
                left: 50%;
                transform: translate(-50%,-50%);
                z-index: 9;
            }
            #circle22{
                height: 125px;
                width: 125px;
                background-color: lightgray;
                border-radius: 50%;
                position: absolute;
                top:0%;
                left: 50%;
                transform: translate(-50%,-50%);
            }
            #circle32{
                height: 105px;
                width: 105px;
                border-radius: 50%;
                position: absolute;
                top: 0px;
                left: center;
                transform: translate(-50%,-50%);
            }
        </style>
    </head>
    <body>
        <div id="circle12"></div>
        <div id="circle22"></div>
        <div id="circle32"><img style="border-radius: 50%;position: absolute;margin-left: -41%;" src='foto/<?php
            echo $fotoPerfilBarra->fotoAplicada($_SESSION['idUsuario']);
            ?>'></div>
        <canvas height="200" width="200" id="counter2"/>
    </body>

    <?php
    echo '

<script type="application/javascript">
        var counter2 = document.getElementById("counter2").getContext("2d");
        var no2 = 0; // Starting Point
        var pointToFill2 = 4.72;  //Point from where you want to fill the circle
        var cw2 = counter2.canvas.width;  //Return canvas width
        var ch2 = counter2.canvas.height; //Return canvas height
        var diff2;   // find the different between current value (no) and trageted value (100)

        function fillCounter2(){
            diff2 = ((no2/100) * Math.PI*2*10);

            counter2.clearRect(0,0,cw2,ch2);   // Clear canvas every time when function is call

            counter2.lineWidth = 10;     // size of stroke

            counter2.fillStyle = "#fff";     // color that you want to fill in counter/circle

            counter2.strokeStyle = "'.$idCor.'";    // Stroke Color

            counter2.textAlign = "center";

            counter2.font = "180% monospace";    //set font size and face

            counter2.fillText(no2+"%",100,130);       //fillText(text,x,y);
            // counter2.fillText("'.$quantXP2.'",100,110);

            counter2.beginPath();
            counter2.arc(100,100,57,pointToFill2,diff2/10+pointToFill2);    //arc(x,y,radius,start,stop)

            counter2.stroke();   // to fill stroke

            // now add condition

            if(no2 >= '.$quantXP2.')
            {
                clearTimeout(fill2);     //fill is a variable that call the function fillcounter()
            }
            no2++;
        }

        //now call the function

        var fill2 = setInterval(fillCounter2,15);     //call the fillCounter function after every 50MS
    </script>

';
    ?>


</html>
