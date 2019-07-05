
<?php

$db_test = '(DESCRIPTION=( ADDRESS_LIST= (ADDRESS= (PROTOCOL=TCP) (HOST=192.168.61.8) (PORT=1581)))( CONNECT_DATA= (SID=BASDAT) ))';
 $conn = oci_connect("basdat", "basdat", $db_test);

 if (!$db_test) {    
  $m = oci_error();    
  echo $m['message'], "n";    
  exit; 
} else {    
  echo ""; } 

$a=$_POST["a"];
$b=$_POST["b"];
$c=$_POST["c"];
echo "Registro Rechazado: ".$a;


$stid =  oci_parse($conn, "DELETE FROM TAB_AUTO
where autofue= '$a'
and autodoc= '$b'
and autolin= $c");
oci_execute($stid);



?>