<!DOCTYPE html>
<html lang="en">
<head>
	
  <meta http-equiv="Refresh" content="60;url=http://autorizacion.cruzrojabogota.org.co" charset="UTF-8" >
	<title>inicio</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="tabla.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
</head>



<body>


 <?php
   

// crear conexion con oracle
 $db_test = '(DESCRIPTION=( ADDRESS_LIST= (ADDRESS= (PROTOCOL=TCP) (HOST=192.168.61.8) (PORT=1581)))( CONNECT_DATA= (SID=BASDAT) ))';
 $conn = oci_connect("basdat", "basdat", $db_test);

 if (!$db_test) {    
  $m = oci_error();    
  echo $m['message'], "n";    
  exit; 
} else {    
  echo ""; } 



?>



<div class="container-fluid">
<div class="row">
<table class="table table-hover table-bordered rwd_auto " style="font-size:13px">

<thead class="">
<tr >


<th>HISTORIA</th>
<th>NUMERO</th>
<th>NOMBRE</th>
<th>NUMERO ORDEN</th>
<th>AUTOCER</th>
<th>ASEGURADOR</th>
<th>ASEGURADOR NUEVO</th>
<th>PACMRECER</th>
<th>TIPO DE ORDEN</th>
<th>NOMBRE LAB.</th>
<!-- <th>AUTOCAC</th> -->
<th>ACTIVIDAD</th>
<th>ESTADO ORDEN</th>
<th>EST. NOMBRE</th>
<th>AUTORIZACION ACTIVIDAD</th>
<th>CTEDETDES</th>
<th>AUTORIZAR</th>
<th>RECHAZAR</th> 


</tr>

</thead>

<tbody>


<?php

$codigounico="3225";

?>
<?php


$stid = oci_parse($conn, "SELECT AUTODOC, AUTOLIN, AUTOFUE, AUTOHIS ,AUTONUM,AUTONOM|| ' ' ||AUTOAP1|| ' ' ||AUTOAP2 AS NOMPRE_PACIENTE,AUTOFUE|| '-'||AUTODOC|| '-' ||AUTOLIN AS N_ORDEN,AUTOCER,AUTORES,PACMRECER,PACMRERES,AUTOTIP,TIPNOM,AUTOCAC,AUTODES,AUTOEST,ESTNOM,AUTOAUT,CTEDETDES
FROM basdat.TAB_AUTO,basdat.INPACMRE,basdat.ORTIP, basdat.OREST, basdat.SICTEDET
WHERE AUTOHIS=PACMREHIS
AND AUTONUM=PACMRENUM
AND PACMREIND='P'
AND AUTOTIP=TIPCOD
AND AUTOEST=ESTCOD
AND CTEDETCOD='ESTAUT'
AND AUTOAUT=CTEDETPAR");
oci_execute($stid);

while (($fila = oci_fetch_array($stid, OCI_BOTH)) != false)  {

echo "<tr>";

echo "<td>";
echo $fila['AUTOHIS'];
echo "</td>";

echo "<td>";
echo $fila['AUTONUM'];
echo "</td>";

echo "<td>";
echo $fila['NOMPRE_PACIENTE'];
echo "</td>";

echo "<td>";
echo $fila['N_ORDEN'];
echo "</td>";

echo "<td>";
echo $fila['AUTOCER'];
echo "</td>";

echo "<td>";
echo $fila['AUTORES'];
echo "</td>";

echo "<td>";
echo $fila['PACMRERES'];
echo "</td>";

echo "<td>";
echo $fila['PACMRECER'];
echo "</td>";


echo "<td>";
echo $fila['AUTOTIP'];
echo "</td>";


echo "<td>";
echo $fila['TIPNOM'];
echo "</td>";


echo "<td>";
echo $fila['AUTODES'];
echo "</td>";

echo "<td>";
echo $fila['AUTOEST'];
echo "</td>";

echo "<td>";
echo $fila['ESTNOM'];
echo "</td>";

echo "<td>";
if($fila['AUTOAUT'] == ""){
echo "Sin dato";
}else{
echo $fila['AUTOAUT'];
}
echo "</td>";

echo "<td>";
echo $fila['CTEDETDES'];
echo "</td>";

$autodoc = $fila['AUTODOC'];
$autolin = $fila['AUTOLIN'];
$autofue = $fila['AUTOFUE'];




echo "<td>";
echo "<button  name='nombre' type='submit' class='btn btn-success' onclick='accion( \"{$autofue}\", \"{$autodoc}\", \"{$autolin}\");'> Autorizar</button>";
echo "</td>";


echo "<td>";
echo "<button name='nombre' type='submit' class='btn btn-danger' onclick='rechazar(\"{$autofue}\", \"{$autodoc}\", \"{$autolin}\");'>Rechazar</button>";
echo "</td>";



echo "</tr>";

}


?>


</tbody>
</table>
</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
    
<script type="text/javascript" >

  function accion(a,b,c) {
    var url= "autorizar.php";
    $.ajax({
      type: 'POST',
      url:url,
      data: 'a='+a+'&b='+b+'&c='+c,
      
      success:function(dd){
        alert(dd);
        location.reload();
      }
    })
  }

  function rechazar(a,b,c) {
    var url= "rechazar.php";
    $.ajax({
      type: 'POST',
      url:url,
      data: 'a='+a+'&b='+b+'&c='+c,
      
      success:function(dd){
        alert(dd);
        location.reload();
      }
    })
  }

</script>




<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js" ></script> -->



</body>





</html>

