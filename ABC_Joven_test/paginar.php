<?php
//INCLUYO LA HOJA DE ESTILOS en el header si es posible
?>
<link href="css/paginacion.css" type="text/css" rel="stylesheet">
<?php
include_once('../clases/conexion.class.php');
$conn = new DBManager;
  
//AL PRINCIPIO COMPRUEBO SI HICIERON CLICK EN ALGUNA PÁGINA 
if(isset($_GET['page']))
{
    $page= $_GET['page'];
}
else
{
    //SI NO DIGO Q ES LA PRIMERA PÁGINA
    $page=1;
}
  
//ACA SE SELECCIONAN TODOS LOS DATOS DE LA TABLA
if($conn->conectar()){
$consulta = "SELECT * FROM detalle_joven";
$datos=mysql_query($consulta);}
  
//MIRO CUANTOS DATOS FUERON DEVUELTOS
$num_rows=mysql_num_rows($datos);
  
//ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR PÁGINA , EN EL EJEMPLO PONGO 15
$rows_per_page= 20;
  
//CALCULO LA ULTIMA PÁGINA
$lastpage= ceil($num_rows / $rows_per_page);
  
//COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA PÁGINA
$page=(int)$page;
 
if($page > $lastpage)
{
    $page= $lastpage;
}
 
if($page < 1)
{
    $page=1;
}
  
//CREO LA SENTENCIA LIMIT PARA AÑADIR A LA CONSULTA QUE DEFINITIVA
$limit= 'LIMIT '. ($page -1) * $rows_per_page . ',' .$rows_per_page;
  
//REALIZO LA CONSULTA QUE VA A MOSTRAR LOS DATOS (ES LA ANTERIO + EL $limit)
$consulta .=" $limit";
if($conn->conectar())
  $peliculas=mysql_query($consulta);
  
if(!$peliculas)
{
        //SI FALLA LA CONSULTA MUESTRO ERROR
        die('Invalid query: ' . mysql_error());
}
else
{
      //SI ES CORRECTA MUESTRO LOS DATOS 
      ?> <table>
            <thead>
                <tr><th>Titulo</th><th>Director</th><th> A&ntilde;o de producci&oacute;n</th></tr>
            </thead>
            <tbody>
    <?php while($row = mysql_fetch_assoc($peliculas))
          {  ?>
         
            <tr><td><?php echo $row['Nombre']; ?> </td><td> <?php echo $row['A_Paterno']; ?> </td><td> <?php echo $row['A_Materno']; ?> </td></tr>
   <?php  } ?>
            </tbody>
        </table>
<?php
    //UNA VEZ Q MUESTRO LOS DATOS TENGO Q MOSTRAR EL BLOQUE DE PAGINACIÓN SIEMPRE Y CUANDO HAYA MÁS DE UNA PÁGINA
      
    if($num_rows != 0)
    {
       $nextpage= $page +1;
       $prevpage= $page -1;
     
       ?><ul id="pagination-digg"><?php
           //SI ES LA PRIMERA PÁGINA DESHABILITO EL BOTON DE PREVIOUS, MUESTRO EL 1 COMO ACTIVO Y MUESTRO EL RESTO DE PÁGINAS
           if ($page == 1) 
           {
            ?>
              <li class="previous-off">&laquo; Previous</li>
              <li class="active">1</li> 
         <?php
              /*for($i= $page+1; $i<= $lastpage ; $i++)
              {?>
                <li><a href="paginar.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
        <?php }*/
           
           //Y SI LA ULTIMA PÁGINA ES MAYOR QUE LA ACTUAL MUESTRO EL BOTON NEXT O LO DESHABILITO
            if($lastpage >$page )
            {?>      
                <li class="next"><a href="paginar.php?page=<?php echo $nextpage;?>" >Next &raquo;</a></li><?php
            }
            else
            {?>
                <li class="next-off">Next &raquo;</li>
        <?php
            }
        } 
        else
        {
     
            //EN CAMBIO SI NO ESTAMOS EN LA PÁGINA UNO HABILITO EL BOTON DE PREVIUS Y MUESTRO LAS DEMÁS
        ?>
            <li class="previous"><a href="paginar.php?page=<?php echo $prevpage;?>">&laquo; Previous</a></li><?php
             /*for($i= 1; $i<= $lastpage ; $i++)
             {
                           //COMPRUEBO SI ES LA PÁGINA ACTIVA O NO
                if($page == $i)
                {
            ?>       <li class="active"><?php echo $i;?></li><?php
                }
                else
                {
            ?>       <li><a href="paginar.php?page=<?php echo $i;?>" ><?php echo $i;?></a></li><?php
                }
            }*/
             //Y SI NO ES LA ÚLTIMA PÁGINA ACTIVO EL BOTON NEXT     
            if($lastpage >$page )
            {   ?>   
                <li class="next"><a href="paginar.php?page=<?php echo $nextpage;?>">Next &raquo;</a></li><?php
            }
            else
            {
        ?>       <li class="next-off">Next &raquo;</li><?php
            }
        }     
    ?></ul></div><?php
    } 
}
 
?>