<?php


function ido($varos){
    $cp = fopen("http://api.openweathermap.org/data/2.5/weather?q=".$varos.".hu&units=metric&lang=hu&appid=cb9d90cacab0b7302686aab85a55f78b" , "r");

    $adatok = fread($cp, 1024);

    $adatok_decod=json_decode($adatok);

    $hofok = $adatok_decod->main->temp;

    $datum = date("Y-m-d");
    $para = $adatok_decod->main->humidity;
    $szel = $adatok_decod->wind->speed;
    $szel = $szel * 3.6;
    $szelirany = $adatok_decod->wind->deg;

    print("<br>város: ". $varos);
    print("<br>hőfok: ". $hofok. "°C");
    print("<br>dátum: ". $datum);
    print("<br>páratartalom: ". $para. "%");
    print("<br>szélerősség: ". $szel. "km/h");
    print("<br>szélirány: ". $szelirany. " °<br><br>");

    require("kapcs.php");

    
    $sql="INSERT INTO `idoj`(`varos`, `datum`, `hofok`, `para`, `szel`, `szelirany`) VALUES ('".$varos."','".$datum."','".$hofok."','".$para."','".$szel."','".$szelirany."')";

    if ($con->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
  
    $con->close();
  
}



$varos = "Budapest,hu";
$varos2 = "Debrecen,hu";
$varos3 = "Győr,hu";
$varos4 = "Miskolc,hu";

ido($varos);
ido($varos2);
ido($varos3);
ido($varos4);
?>