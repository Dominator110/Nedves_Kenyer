<?php



function ido($varos){



$cp=fopen("http://api.openweathermap.org/data/2.5/weather?q=".$varos."&units=metric&lang=hu&appid=cb9d90cacab0b7302686aab85a55f78b","r");

$adatok=fread($cp,1024);

$adatok_decod=json_decode($adatok);

$hofok=$adatok_decod->main->temp;
$para=$adatok_decod->main->humidity;
$szel=$adatok_decod->wind->speed;
$szel=$szel*3.6;
$szelirany = $adatok_decod->wind->deg;

$datum=date("Y-m-d");

print("<br>Város: ".$varos); 
print("<br>hőfok: ".$hofok."°C");
print("<br>Dátum: ".$datum."");
print("<br>Pára: ".$para."%");
print("<br>Szél: ".$szel."Km/h");
print("<br>Szélirány: ".$szelirany."<br>");

require("kapcs.inc.php");

$sql="INSERT INTO `idoj`(`varos`, `datum`, `hofok`, `para`, `szel`, `szelirany`) VALUES ('".$varos."','".$datum."','".$hofok."','".$para."','".$szel."','".$szelirany."')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$con->close();

}

$varos='Budapest,hu';
$varos2='Debrecen,hu';
$varos3='Gyor,hu';
$varos4='Miskolc,hu';


ido($varos);
ido($varos2);
ido($varos3);
ido($varos4);

?>