<?php session_start();
require('core/joven.class.php');
$objJoven = new Joven;
//$caso = '1';
switch ($_POST['caso']) 
{
    case '0':

        $usern = $_SESSION['nombre'];
        $apPa = $_SESSION['paterno'];
        $amMa = $_SESSION['materno'];
        //$urol = $_SESSION['id'];
        if(!empty($_SESSION['id']))
            {
                $cons = $objJoven->check_perfil($_SESSION['id']);
                $datos = mysql_fetch_array($cons);
                echo '<div><h4>'.$usern.' '.$apPa.' '.$amMa.' Perfil: '.$datos[0].'</h4></div>';
            }
        exit;
    case '1'://Rol de Usuario
        if(!empty($_SESSION['id']))
    		{
    			$cons = $objJoven->check_perfil($_SESSION['id']);
    			$datos = mysql_fetch_array($cons);
                $numfields = mysql_num_fields($cons);
                $PERFIL = $datos[0];
    			for ( $i=0;   $i <$numfields ; $i++ ) 
                {
                    //$boton = mysql_field_name($cons, $i);
                    if($i != 0 && $datos[$i]=='1')
                       { echo "<li><a href='#' id=". mysql_field_name($cons, $i).">". mysql_field_name($cons, $i)."</a></li>";}
                }
    		}
        exit;
    case '2'://Busqueda de joven por nombre
     	$obj = $objJoven->countBuscaNombre($_POST['nom'],$_POST['apa'],$_POST['ama']);
        $resultados_cantidad=mysql_num_rows($obj);
        //$numfields = ;//mysql_num_rows
        if( $resultados_cantidad != null)
        {
            $evento = '';
            crearPaginacion($_POST['nom'],$_POST['apa'],$_POST['ama'],$_POST['caso'], $evento, $resultados_cantidad);
        }
        else
            {echo 'No se encontraron jovenes en Buscar por Nombre, valida los datos :(';}
        exit;
    case '3'://buscar jovenes en evento
		$cons = $objJoven->countBuscarEvento($_POST['find-evnt']);
        $resultados_cantidad=mysql_num_rows($cons);
        if( $resultados_cantidad != null)
        {
            $nom='';$apa='';$ama='';
            crearPaginacion($nom, $apa, $ama, $_POST['caso'], $_POST['find-evnt'],$resultados_cantidad);
            /*echo '<div class="header-find">ID</div>'.'<div class="header-find">NOMBRE</div>'.'<div class="header-find">A PATERNO</div>'.'<div class="header-find">A MATERNO</div>'.'<div class="header-find">GENERO</div>'.'<div class="header-find">MUNICIPIO</div>'.'<div class="header-find"></div>'.'<div class="header-find"></div>'.'<div class="header-find"></div>'.'<div class="header-find"></div>';
    		while( $rol = mysql_fetch_array($cons))
    		{
    			echo '<div>'.$rol[0].'</div><div>'.$rol[1].'</div><div>'.$rol[2].'</div><div>'.$rol[3].'</div><div>'.$rol[4].'</div><div>'.$rol[5].'</div>'.'<div><a class="detail" href="MetasG/detalle.php?young='.$rol[0].'" target="_blank"  >Detalles</a></div><div><a class="detail" href="MetasG/detalle.php?young='.$rol[0].'" target="_blank"  >Modificar</a></div><div><a class="detail" href="MetasG/detalle.php?young='.$rol[0].'" target="_blank">Eliminar</a></div><div><a class="detail" href="MetasG/detalle.php?young='.$rol[0].'" target="_blank" >Clasificar</a></div>';
    		}*/
        }
        else
            {echo 'No se encontraron jovenes en Buscar por Evento, valida los datos :(';}
        exit;
    case '4'://Registro de joven
        $bol = $objJoven->verificar_cierre($_POST['fechaEv']);
        $dato = mysql_fetch_array($bol);
        if ($dato[0]) {
            echo 'La actividad no puede ser capturada, mes se ha cerrado para la captura';
        }
        else{
    		$cons = $objJoven->registrar_Joven( $_POST['nombre'], $_POST['apa'], $_POST['ama'], $_POST['genero'], $_POST['segmento'], $_POST['fechaNac'], $_POST['edo'], $_POST['mun'], $_POST['curp'], $_POST['rfc'], $_POST['dom'], $_POST['col'], $_POST['telfijo'], $_POST['telcel'], $_POST['email'], $_POST['est'], $_POST['cat_ev'], $_POST['fechaEv'], $_POST['obs'], $_POST['evento'], $_POST['place'], $_POST['sector'] );
    		if($cons == '1')
    		{
    			echo '1';
    		}
    		else if($cons == '2')
    		{
    			echo '2';
    		}
    		else if($cons == '3')
    		{
    			echo '3';
    		}
    		else
    		{
    			echo '4';
    		}
        }
        exit;
    case '5'://Cosnulta de estados
            $cons = $objJoven->consulta_estado();
            echo '<option value="0">[ Selecciona Estado ]</option>';
         	while ($edo = mysql_fetch_array($cons)) {
         		echo '<option value='.$edo[0].'>'.$edo[1].'</option>';
         	}
            exit;
    case '6'://consulta Eventos
     	$cons = $objJoven->consulta_evento(0);
     	while ($edo = mysql_fetch_array($cons)) {
     		echo '<option value='.$edo[0].'>'.$edo[1].'</option>';
     	}
        exit;
    case '7'://consulta por responsable
     	$cons = $objJoven->consulta_responsable();
        echo '<option value="0">[ Selecciona Responsable ]</option>';
     	while ($resp= mysql_fetch_array($cons)) {
     		echo '<option value='.$resp[0].'>'.$resp[1].' '.$resp[2].' '.$resp[3].'</option>';
     	}
        exit;
    case '8'://Consulta municipios de GTO
     	$cons = $objJoven->consulta_mun();
     	while ($mun= mysql_fetch_array($cons)) {
     		echo '<option value='.$mun[0].'>'.$mun[1].'</option>';
     	}
        exit;
    case '9'://consulta municipios deaceurdo al estado
     	$cons = $objJoven->consulta_munxedo($_POST['estado']);
        echo '<option value="0">[ Selecciona Municipio ]</option>';
     	while ($mun= mysql_fetch_array($cons)) {
     		echo '<option value='.$mun[0].'>'.$mun[1].'</option>';
     	}
        exit;
    case '10'://consulta de segmetos
     	$cons = $objJoven->consulta_segmento();
     	while ($seg= mysql_fetch_array($cons)) {
     		echo '<option value='.$seg[0].'>'.$seg[1].'</option>';
     	}
        exit;
    case '11'://consulta usuarios paginacion
        $cons = $objJoven->consulta_usuario();
        echo '<div class="header-find searc-user">ID</div>'.'<div class="header-find searc-user">USUARIO</div>'.'<div class="header-find searc-user">ROL</div>'.'<div class="header-find searc-user">DETALLE</div>'.'<div class="header-find searc-user">MODIFICAR</div>'.'<div class="header-find searc-user">ELIMINAR</div>';
        while ($user = mysql_fetch_array($cons)) {
             echo '<div class="searc-user">'.$user[0].'</div><div class="searc-user">'.$user[1].'</div><div class="searc-user">'.$user[2].'</div>'.'<div class="searc-user"><a class="detail" href="detalle-user.html?user='.$user[0].'" target="_blank"  >Detalles</a></div><div class="searc-user"><a class="detail" href="modificar-user.html?user='.$user[0].'" target="_blank"  >Modificar</a></div><div class="searc-user"><a class="detail" href="#" id="'.$user[0].'" name="Eliminar">Eliminar</a></div>';//<div>'.$joven[3].'</div><div>'.$joven[4].'</div><div>'.$joven[5].'</div>'<div><a class="detail" href="MetasG/clasificar.php?young='.$joven[0].'" target="_blank" >Clasificar</a></div>';
        }
        exit;
    case '12'://consulta estados paginacion
        $cons = $objJoven->consulta_estado();
        echo '<div class="header-find searc-edo">ID</div><div class="header-find searc-edo">ESTADO</div><div class="header-find searc-edo">DETALLE</div>'.'<div class="header-find searc-edo">MODIFICAR</div><div class="header-find searc-edo">ELIMINAR</div>';
        while ($edo = mysql_fetch_array($cons)) {
            echo '<div class="searc-edo">'.$edo[0].'</div><div class="searc-edo">'.$edo[1].'</div><div class="searc-edo"><a class="detail" href="#">Detalles</a></div><div class="searc-edo"><a class="detail" href="templates/modificar-edo.html?estado='.$edo[0].'" target="_blank"  >Modificar</a></div><div class="searc-edo"><a class="detail" href="#" rel="Eliminar" id='.$edo[0].' name="Eliminar">Eliminar</a></div>';}
        exit;
    case '13'://consulta municipios grid
        $cons = $objJoven->consulta_Mun_Search();
        echo '<div class="header-find searc-mun">ID</div><div class="header-find searc-mun">MUNICIPIO</div><div class="header-find searc-mun">ESTADO</div><div class="header-find searc-mun">DETALLE</div><div class="header-find searc-mun">MODIFICAR</div><div class="header-find searc-mun">ELIMINAR</div>';
        while ($mun = mysql_fetch_array($cons)) {
            echo '<div class="searc-mun">'.$mun[0].'</div><div class="searc-mun">'.$mun[2].'</div><div class="searc-mun">'.$mun[1].'</div><div class="searc-mun"><a class="detail" href="#"  >Detalles</a></div><div class="searc-mun"><a class="detail" href="templates/modificar-mun.html?mun='.$mun[0].'" target="_blank"  >Modificar</a></div><div class="searc-mun"><a class="detail" href="#" rel="Eliminar" id='.$mun[0].' name="Eliminar">Eliminar</a></div>';}
        exit;
    case '14'://consulta evento grid
        $cons = $objJoven->consulta_Evento_Search();
        echo '<div class="header-find searc-evnt">ID</div><div class="header-find searc-evnt">EVENTO</div><div class="header-find searc-evnt">DETALLE</div><div class="header-find searc-evnt">MODIFICAR</div><div class="header-find searc-evnt">ELIMINAR</div>';
        while ($evnt = mysql_fetch_array($cons)) {
            echo '<div class="searc-evnt">'.$evnt[0].'</div><div class="searc-evnt">'.$evnt[1].'</div><div class="searc-evnt"><a class="detail" href="templates/detalle-evento.html?evento='.$evnt[0].'" target="_blank"  >Detalles</a></div><div class="searc-evnt"><a class="detail" href="templates/modificar-evnt.html?evento='.$evnt[0].'" target="_blank"  >Modificar</a></div><div class="searc-evnt"><a class="detail" href="#" rel="Eliminar"  name="Eliminar" id='.$evnt[0].'>Eliminar</a></div>';}
        exit;
    case '15'://consulta segmento grid
        $cons = $objJoven->consulta_segmento();
        echo '<div class="header-find searc-seg">ID</div><div class="header-find searc-seg">SEGMENTO</div><div class="header-find searc-seg">DETALLE</div>'.'<div class="header-find searc-seg">MODIFICAR</div><div class="header-find searc-seg">ELIMINAR</div>';
        while ($seg = mysql_fetch_array($cons)) {
            echo '<div class="searc-seg">'.$seg[0].'</div><div class="searc-seg">'.$seg[1].'</div><div class="searc-seg"><a class="detail" href="#"  >Detalles</a></div><div class="searc-seg"><a class="detail" href="templates/modificar-seg.html?segmento='.$seg[0].'" target="_blank"  >Modificar</a></div><div class="searc-seg"><a class="detail" href="#" rel="Eliminar" id='.$seg[0].' name="Eliminar">Eliminar</a></div>';}
        exit;
    case '16'://consulta talento grid
        $cons = $objJoven->consulta_talento();
        echo '<div class="header-find searc-talento">ID</div><div class="header-find searc-talento">TALENTO</div><div class="header-find searc-talento">DETALLE</div>'.'<div class="header-find searc-talento">MODIFICAR</div><div class="header-find searc-talento">ELIMINAR</div>';
        while ($talento = mysql_fetch_array($cons)) {
            echo '<div class="searc-talento">'.$talento[0].'</div><div class="searc-talento">'.$talento[1].'</div><div class="searc-talento"><a class="detail" href="#"  >Detalles</a></div><div class="searc-talento"><a class="detail" href="templates/modificar-tal.html?talento='.$talento[0].'" target="_blank"  >Modificar</a></div><div class="searc-talento"><a class="detail" href="#" rel="Eliminar" id='.$talento[0].' name="Eliminar">Eliminar</a></div>';}
        exit;
    case '17'://consulta roles grid
        $cons = $objJoven->consulta_roles();
        echo '<div class="header-find searc-rol">ID</div><div class="header-find searc-rol">ROL</div><div class="header-find searc-rol">DETALLE</div>'.'<div class="header-find searc-rol">MODIFICAR</div><div class="header-find searc-rol">ELIMINAR</div>';
        while ($rol = mysql_fetch_array($cons)) {
            echo '<div class="searc-rol">'.$rol[0].'</div><div class="searc-rol">'.$rol[1].'</div><div class="searc-rol"><a class="detail" href="#"  >Detalles</a></div><div class="searc-rol"><a class="detail" href="templates/modificar-rol.html?rol='.$rol[0].'" target="_blank"  >Modificar</a></div><div class="searc-rol"><a class="detail" href="#" rel="Eliminar" id='.$rol[0].' name="Eliminar">Eliminar</a></div>';}
        exit;
    case '18'://cosniulta de roles select
        $cons = $objJoven->consulta_roles();
        echo '<option value="0">[ Selecciona Rol ]</option>';
        while ($rol = mysql_fetch_array($cons)) {
            echo '<option value='.$rol[0].'>'.strtoupper($rol[1]).'</option>';
        }
        exit;
    case '19'://consulta municipios deaceurdo al estado menu usuarios
        $cons = $objJoven->consulta_munxedo($_POST['estado-User']);
        echo '<option value="0">[ Selecciona Municipio ]</option>';
        while ($mun= mysql_fetch_array($cons)) {
            echo '<option value='.$mun[0].'>'.$mun[1].'</option>';
        }
        exit;
    case '20'://guardar usuarios
        $check = $objJoven->verificar_username($_POST['usr-nomuser']);
        $id = mysql_fetch_array($check);
        if(!isset($id[0]))
        {
            $cons = $objJoven->alta_usuario($_POST['usr-resp'], $_POST['usr-nomuser'],$_POST['usr-pass'],$_POST['usr-nombre'],$_POST['usr-apa'],$_POST['usr-ama'],$_POST['usr-gen'],$_POST['fechaNacUser'],$_POST['usr-dom'],$_POST['usr-col'],$_POST['usr-mun'],$_POST['usr-edo'],$_POST['usr-cp'],$_POST['usr-rol'],$_POST['usr-tel'],$_POST['usr-telcel'], $_POST['usr-email']);
            if( $cons )
            {
                echo "Se ha guardado el Usuario correctamente :)";
            }
            else
            {
                echo 'No se guardo el Usuario :( ha courrido un error';
            }
        }
        else
            echo "3";
        exit;
    case '21'://guardar estado Catalogods
        $cons = $objJoven->alta_estado($_POST['cat-edo-save']);
         if( $cons )
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        exit;
    case '22'://guardar municipio Catalogods
        $cons = $objJoven->alta_mun($_POST['cat-mun-save'], $_POST['cat-edomun-save']);
         if( $cons )
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        exit;
    case '23'://guardar eventos Catalogods
        $check = $objJoven->verificar_eventoname($_POST['cat-evento-save'],$_POST['linea'],$_POST['estrategia'],$_POST['programa'],$_POST['tipo']);
        $id= mysql_fetch_array($check);
        if(!isset($id[0]))
        {
            $cons = $objJoven->alta_evento($_POST['cat-evento-save'],$_POST['linea'],$_POST['estrategia'],$_POST['programa'],$_POST['tipo']);
             if( $cons )
                {
                    echo 1;
                }
                else
                {
                    echo 0;
                }
        }
        else
        {
            echo "3";
        }
        
        exit;
    case '24'://guardar segmento Catalogods
        $cons = $objJoven->alta_segmento($_POST['cat-seg-save']);
         if( $cons )
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        exit;
    case '25'://guardar talento Catalogods
        $cons = $objJoven->alta_talento($_POST['cat-tal-save']);
         if( $cons )
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        exit;
    case '26'://guardar rol Catalogods
        $cons = $objJoven->alta_roles($_POST['cat-rol-save']);
         if( $cons )
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        exit;
    case '27'://Detalle Joven
        $cons = $objJoven->buscarJovenID($_POST['joven']);
        while ($detail = mysql_fetch_array($cons)) {
          echo ' <div class="page-wrap" >
                <h3> Datos Joven</h3>
                <div class="rowElem">
                   <div class="rowLabel"><label for="nom">Primer Nombre:</label></div>
                    <div class="rowInput"><input type="text" id="nom" value="'.$detail[1].'"  readonly="readonly"/></div>
                </div>
                
                <div class="rowElem">
                    <div class="rowLabel"><label for="ap">Apellido Paterno:</label></div>
                    <div class="rowInput"><input type="text" id="ap" value="'.$detail[2].'"  readonly="readonly"/></div>
                </div>
                
                <div class="rowElem">
                    <div class="rowLabel"><label for="am">Apellido Materno*:</label></div>
                    <div class="rowInput"><input type="text" id="am"  value="'.$detail[3].'"  readonly="readonly"/></div>
                </div>

                
                <div class="rowElem">
                    <div class="rowLabel"><label for="genero">Genero:</label></div>
                     <div class="rowInput"><input type="text" id="genero"  value="'.$detail[6].'"  readonly="readonly"/></div>
                </div>

                <div class="rowElem">
                    <div class="rowLabel"><label for="seg">Segmento:</label></div>
                    <div class="rowInput"><input type="text" id="seg"  value="';$seg=$objJoven->consulta_segmento_by_id($detail[13]);
                    $segmento=mysql_fetch_array($seg);echo $segmento[1];echo '"  readonly="readonly"/></div>
                </div>
                <div class="rowElem">
                    <div class="rowLabel"><label for="fecnac">Fehca de nacimiento:</label></div>
                    <div class="rowInput"><input type="text" name="datepicker1" id="datepicker1" readonly="readonly" size="10"  value="'.$detail[7].'"/>
                    </div>
                </div>
               
                <div class="rowElem">
                    <div class="rowLabel"><label for="edo">Estado de origen:</label></div>
                    <div class="rowInput"><input type="text" id="edo"  value="';$edo=$objJoven->consulta_estado_by_id($detail[11]);
                    $edojoven = mysql_fetch_array($edo);echo $edojoven[1];echo '" readonly="readonly"/></div>
                </div>
                <div class="rowElem">
                    <div class="rowLabel"><label for="mun-edo">Municipio de origen / de Residencia:</label></div>
                    <div class="rowInput"><input type="text" id="mun-edo"  value="';$mun=$objJoven->consulta_mun_by_id($detail[10]);
                    $munjoven = mysql_fetch_array($mun);echo $munjoven[1];echo '"  readonly="readonly"/></div>
                </div>
                <div class="rowElem">
                    <div class="rowLabel"><label for="cp">Codigo Postal*:</label></div>
                    <div class="rowInput"><input type="text" id="cp" name="req-name"  value="'.$detail[12].'" readonly="readonly" /></div>
                </div>
            </div>
            <div class="page-wrap">
                <h3>Datos Contacto Joven</h3>

                    <div class="rowElem">
                        <div class="rowLabel"><label for="curp">CURP:</label></div>
                        <div class="rowInput"><input type="text" id="curp" value="'.$detail[4].'"  readonly="readonly"/></div>
                    </div>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="rfc">RFC:</label></div>
                        <div class="rowInput"><input type="text" id="rfc" value="'.$detail[5].'"  readonly="readonly"/></div>
                    </div>
                     <div class="rowElem">
                        <div class="rowLabel"><label for="calle">Calle y numero:</label></div>
                        <div class="rowInput"><input type="text" id="calle" value="'.$detail[8].'"  readonly="readonly"/></div>
                    </div>
                    
                    <div class="rowElem">
                        <div class="rowLabel"><label for="col">Colonia:</label></div>
                        <div class="rowInput"><input type="text" id="col" value="'.$detail[9].'"  readonly="readonly"/></div>
                    </div>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="tel">Telefono Fijo:</label></div>
                        <div class="rowInput"><input type="text" id="tel" value="'.$detail[15].''.$detail[16].'"  readonly="readonly"/></div>
                    </div>
                    
                    <div class="rowElem">
                        <div class="rowLabel"><label for="tel-cel">Telefono Celular:</label></div>
                        <div class="rowInput"><input type="text" id="tel-cel" value="'.$detail[17].''.$detail[18].'"  readonly="readonly"/></div>
                    </div>

                    <div class="rowElem">
                        <div class="rowLabel"><label for="email">Email:</label></div>
                        <div class="rowInput"><input type="email" id="email" value="'.$detail[19].'"  readonly="readonly"/></div>
                    </div>

                    <div class="rowElem">
                        <div class="rowLabel"><label for="">El joven estudia actualmete:</label></div>
                        <div class="rowInput"><input type="email" id="email" value="';if($detail[14]==1)
                        {echo "Si";}else{echo "No";} echo'"  readonly="readonly"/></div>
                    </div>
          
            </div>';
        }

        exit;
    case '28'://Modificar Joven
        $cons = $objJoven->buscarJovenID($_POST['joven']);
        $detail = mysql_fetch_array($cons);
        echo $detail[1].'|'.$detail[2].'|'.$detail[3].'|'.$detail[4].'|'.$detail[5].'|'.$detail[6].'|'.$detail[7].'|'.$detail[8].'|'.$detail[9].'|'.$detail[10].'|'.$detail[11].'|'.$detail[12].'|'.$detail[13].'|'.$detail[14].'|'.$detail[15].'|'.$detail[16].'|'.$detail[17].'|'.$detail[18].'|'.$detail[19];
        exit;
    case '29'://Actualizar Joven
        $cons = $objJoven->update_joven( $_POST['joven'], $_POST['nombre'], $_POST['ap'], $_POST['am'], $_POST['genero'], $_POST['seg'], $_POST['fechaNac'], $_POST['edo'], $_POST['mun'], $_POST['curp'], $_POST['rfc'], $_POST['dom'], $_POST['col'], $_POST['telfijo'], $_POST['telcel'], $_POST['email'], $_POST['est']);
        if ( $cons ) {
            echo 1;
        }
        else
        {
            echo 0;
        }
        exit; 
    case '30'://Eliminar evento del joven
        // if( isset($auth[0]) || $_SESSION['user']=='administrador' )
        $res = substr($_POST['no_control'], 0, 3);
        $user = $objJoven->check_user($_SESSION['id']);
        $auth = mysql_fetch_array($user);
        if($auth[0] == $res or $_SESSION['id'] == 1){

            $fechaEv = substr($_POST['no_control'],10,10);
            $bol = $objJoven->verificar_cierre($fechaEv);
            $dato = mysql_fetch_array($bol);
            if ($dato[0]) {
                echo 'La actividad no puede ser eliminada, mes se ha cerrado para la captura. ';
               
            }
            else{
                $cons = $objJoven->eliminar_evento_joven($_POST['evento']);
                if( $cons )
                {
                    echo '1';
                }
                else
                {
                    echo 'Ha ocurrido un error comunicate con el area de T.I.';
                }
            }
        }
        else
        {
            echo 'El evento no puede ser elimminado, solo el responsable del evento puede realizar la eliminación.';
        }
            
        exit;
    case '31'://Eliminar Joven
        $cons = $objJoven->verficar_eventos_joven($_POST['joven']);
        $dato = mysql_fetch_array($cons);
        if( $dato[0] > 0 )
        {
            //echo $_SESSION['user'];
            echo '0';
        }
        else
        {
            $responsbale = $objJoven->verificar_res_jov($_POST['joven']);
            $dato_res = mysql_fetch_array($responsbale);
            if( $dato_res[0] == $_SESSION['user'] or $_SESSION['id'] == 1)
            {
                $delete = $objJoven-> eliminar_joven($_POST['joven']);
                if( $delete )
                {
                    echo '1';
                }
                else
                {
                    echo '2';
                }
                //$evento = mysql_fetch_array('$evento');
            }
            else
            {
                echo '3';
            }
        }
        //$cons = $objJoven->check_user($_SESSION['id']);
        exit;
    case '32'://Detalle Usuarios
        $cons = $objJoven->buscarUserID($_POST['user']);
        while ($detail = mysql_fetch_array($cons)) {
          echo 
          ' <div class="page-wrap" >
                <h3> Datos Usuario</h3>

                 <div class="rowElem">
                    <div class="rowLabel"><label for="seg">Responsable:</label></div>
                    <div class="rowInput"><input type="text" id="seg"  value="';$res=$objJoven->consulta_resposable_by_id($detail[0]);
                    $responsbale=mysql_fetch_array($res);echo $responsbale[1].' '.$responsbale[2].' '.$responsbale[3];echo '"  readonly="readonly"/></div>
                </div>
                <div class="rowElem">
                   <div class="rowLabel"><label for="nom">Nombre de Usiario:</label></div>
                    <div class="rowInput"><input type="text" id="nom" value="'.$detail[1].'"  readonly="readonly"/></div>
                </div>

                 <div class="rowElem">
                   <div class="rowLabel"><label for="nom">Nombre:</label></div>
                    <div class="rowInput"><input type="text" id="nom" value="'.$detail[2].'"  readonly="readonly"/></div>
                </div>
                
                <div class="rowElem">
                    <div class="rowLabel"><label for="ap">Apellido Paterno:</label></div>
                    <div class="rowInput"><input type="text" id="ap" value="'.$detail[3].'"  readonly="readonly"/></div>
                </div>
                
                <div class="rowElem">
                    <div class="rowLabel"><label for="am">Apellido Materno:</label></div>
                    <div class="rowInput"><input type="text" id="am"  value="'.$detail[4].'"  readonly="readonly"/></div>
                </div>
                <div class="rowElem">
                    <div class="rowLabel"><label for="genero">Genero:</label></div>
                     <div class="rowInput"><input type="text" id="genero"  value="'.$detail[5].'"  readonly="readonly"/></div>
                </div>
                <div class="rowElem">
                    <div class="rowLabel"><label for="fecnac">Fehca de nacimiento:</label></div>
                    <div class="rowInput"><input type="text" name="datepicker1" id="datepicker1" readonly="readonly" size="10"  value="'.$detail[6].'"/>
                    </div>
                </div>
                <div class="rowElem">
                    <div class="rowLabel"><label for="fecnac">Edad:</label></div>
                    <div class="rowInput"><input type="text" name="edad" id="edad-user" readonly="readonly" size="10"  value="'.$detail[7].'"/>
                    </div>
                </div>

                 <div class="rowElem">
                        <div class="rowLabel"><label for="seg">Rol:</label></div>
                        <div class="rowInput"><input type="text" id="seg"  value="';$seg=$objJoven->consulta_rol_by_id($detail[13]);
                        $segmento=mysql_fetch_array($seg);echo $segmento[1];echo '"  readonly="readonly"/></div>
                    </div>
            </div>
            <div class="page-wrap">
                <h3>Datos Usuario</h3>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="calle">Calle y numero:</label></div>
                        <div class="rowInput"><input type="text" id="calle" value="'.$detail[8].'"  readonly="readonly"/></div>
                    </div>
                    
                    <div class="rowElem">
                        <div class="rowLabel"><label for="col">Colonia:</label></div>
                        <div class="rowInput"><input type="text" id="col" value="'.$detail[9].'"  readonly="readonly"/></div>
                    </div>

                    <div class="rowElem">
                        <div class="rowLabel"><label for="edo">Estado de origen:</label></div>
                        <div class="rowInput"><input type="text" id="edo"  value="';$edo=$objJoven->consulta_estado_by_id($detail[11]);
                        $edouser = mysql_fetch_array($edo);echo $edouser[1];echo '" readonly="readonly"/></div>
                    </div>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="mun-edo">Municipio de origen:</label></div>
                        <div class="rowInput"><input type="text" id="mun-edo"  value="';$mun=$objJoven->consulta_mun_by_id($detail[10]);
                        $munuser = mysql_fetch_array($mun);echo $munuser[1];echo '"  readonly="readonly"/></div>
                    </div>
                     <div class="rowElem">
                        <div class="rowLabel"><label for="cp">Codigo Postal*:</label></div>
                        <div class="rowInput"><input type="text" id="cp" name="req-name"  value="'.$detail[12].'" readonly="readonly" /></div>
                    </div>                    
                    <div class="rowElem">
                        <div class="rowLabel"><label for="tel">Telefono Fijo:</label></div>
                        <div class="rowInput"><input type="text" id="tel" value="'.$detail[14].' '.$detail[15].'"  readonly="readonly"/></div>
                    </div>
                    
                    <div class="rowElem">
                        <div class="rowLabel"><label for="tel-cel">Telefono Celular:</label></div>
                        <div class="rowInput"><input type="text" id="tel-cel" value="'.$detail[16].' '.$detail[17].'"  readonly="readonly"/></div>
                    </div>

                    <div class="rowElem">
                        <div class="rowLabel"><label for="email">Email:</label></div>
                        <div class="rowInput"><input type="email" id="email" value="'.$detail[18].'"  readonly="readonly"/></div>
                    </div>
            </div>';
        }
        exit;
    case '33'://Modificar Usuarios
        $cons = $objJoven->buscarUserID($_POST['user']);
        while ($detail = mysql_fetch_array($cons)) {
          echo '<div class="page-wrap">
                <h3> Datos Usuario</h3>

                 <div class="rowElem">
                    <div class="rowLabel"><label for="res-user-up">Responsable:</label></div>
                    <div class="rowInput"><select id="res-user-up">';
                    $res=$objJoven->consulta_responsable();
                    while ($responsbale = mysql_fetch_array($res)) {
                       if ($responsbale[0] == $detail[0]) {
                          echo '<option value='.$responsbale[0].' selected>'.$responsbale[1].' '.$responsbale[2].' '.$responsbale[3].'</option>';
                       }
                       else
                        echo '<option value='.$responsbale[0].'>'.$responsbale[1].' '.$responsbale[2].' '.$responsbale[3].'</option>';
                    }
                    echo '</select></div>
                </div>
                <div class="rowElem">
                   <div class="rowLabel"><label for="nomuser-user-up">Nombre de Usiario:</label></div>
                    <div class="rowInput"><input type="text" id="nomuser-user-up" value="'.$detail[1].'"/></div>
                </div>
                 <div class="rowElem">
                   <div class="rowLabel"><label for="nom-user-up">Nombre:</label></div>
                    <div class="rowInput"><input type="text" id="nom-user-up" value="'.$detail[2].'"/></div>
                </div>
                
                <div class="rowElem">
                    <div class="rowLabel"><label for="ap-user-up">Apellido Paterno:</label></div>
                    <div class="rowInput"><input type="text" id="ap-user-up" value="'.$detail[3].'" /></div>
                </div>
                
                <div class="rowElem">
                    <div class="rowLabel"><label for="am-user-up">Apellido Materno:</label></div>
                    <div class="rowInput"><input type="text" id="am-user-up"  value="'.$detail[4].'" /></div>
                </div>
                <div class="rowElem">
                    <div class="rowLabel"><label for="genero-user-up">Genero:</label></div>
                    <div class="rowInput">';
                     if($detail[5]=='M'){
                        echo '<input type="radio" name="genero-user-up" id="h" value="M" checked/>M';
                        echo '<input type="radio" name="genero-user-up" id="m" value="F" />F';
                     }
                     else if($detail[5]=='F')
                     {
                        echo '<input type="radio" name="genero-user-up" id="h" value="M" />M';
                        echo '<input type="radio" name="genero-user-up" id="m" value="F" checked/>F';
                     }

                     echo '</div>
                </div>
                <div class="rowElem">
                    <div class="rowLabel"><label for="fecnac-user-up">Fehca de nacimiento:</label></div>
                    <div class="rowInput"><input type="text" name="datepicker1" id="datepicker5" size="10"  value="'.$detail[6].'"/>
                    </div>
                </div>
                <div class="rowElem">
                    <div class="rowLabel"><label for="edad-user-up">Edad:</label></div>
                    <div class="rowInput"><input type="text" name="edad-user-up" id="edad-user" readonly="readonly"  size="10"  value="'.$detail[7].'"/>
                    </div>
                </div>

                 <div class="rowElem">
                        <div class="rowLabel"><label for="rol-user-up">Rol:</label></div>
                        <div class="rowInput"><select id="rol-user-up">';
                        $rol=$objJoven->consulta_roles();
                        while ( $roles = mysql_fetch_array($rol)) {
                            if($roles[0] == $detail[13])
                            {
                                echo '<option value='.$roles[0].' selected>'.$roles[1].'</option>';
                            }
                            else
                                echo '<option value='.$roles[0].'>'.$roles[1].'</option>';
                        }
                       echo '" <select/></div>
                </div>
            </div>
            <div class="page-wrap">
                <h3>Datos Usuario</h3>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="calle-user-up">Calle y numero:</label></div>
                        <div class="rowInput"><input type="text" id="calle-user-up" value="'.$detail[8].'" /></div>
                    </div>
                    
                    <div class="rowElem">
                        <div class="rowLabel"><label for="col-user-up">Colonia:</label></div>
                        <div class="rowInput"><input type="text" id="col-user-up" value="'.$detail[9].'" /></div>
                    </div>

                    <div class="rowElem">
                        <div class="rowLabel"><label for="edo-user-up">Estado de origen:</label></div>
                        <div class="rowInput"><select id="edo-user-up"';
                        $edo=$objJoven->consulta_estado();
                        while ( $edos = mysql_fetch_array($edo)) {
                            if($edos[0] == $detail[11])
                            {
                                echo '<option value='.$edos[0].' selected>'.$edos[1].'</option>';
                            }
                            else
                                echo '<option value='.$edos[0].'>'.$edos[1].'</option>';
                        }
                        echo '<select/></div>
                    </div>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="mun-user-up">Municipio de origen:</label></div>
                        <div class="rowInput"><select id="mun-user-up"';
                        $mun=$objJoven->consulta_mun();
                        while ($muns = mysql_fetch_array($mun)) {
                        if($muns[0] == $detail[10])
                        {
                            echo '<option value='.$muns[0].' selected>'.$muns[1].'</option>';
                        }
                        else
                            echo '<option value='.$muns[0].'>'.$muns[1].'</option>';
                    }
                    echo '</select></div>
                    </div>
                     <div class="rowElem">
                        <div class="rowLabel"><label for="cp-user-up">Codigo Postal:</label></div>
                        <div class="rowInput"><input type="text" id="cp-user-up" name="req-name"  value="'.$detail[12].'" /></div>
                    </div>                    
                    <div class="rowElem">
                        <div class="rowLabel"><label for="tel-user-up">Telefono Fijo:</label></div>
                        <div class="rowInput"><input type="text" id="tel-user-up" value="'.$detail[14].' '.$detail[15].'" /></div>
                    </div>
                    
                    <div class="rowElem">
                        <div class="rowLabel"><label for="tel-cel-user-up">Telefono Celular:</label></div>
                        <div class="rowInput"><input type="text" id="tel-cel-user-up" value="'.$detail[16].' '.$detail[17].'" /></div>
                    </div>

                    <div class="rowElem">
                        <div class="rowLabel"><label for="email-user-up">Email:</label></div>
                        <div class="rowInput"><input type="email" id="email-user-up" value="'.$detail[18].'" /></div>
                    </div>
                    <div class="rowElem">
                    <div id="noti"></div> 
                      <div class="rowInput">
                        <input type="submit" id="update-user" value="Actualizar Usuario" /> </div>
                    </div>
            </div>
            <div class="page-wrap">
                <h3>Actualizar  Password</h3>
                <div id="noti-pass"></div> 
                 <div class="rowElem">
                   <div class="rowLabel"><label for="pass-user-up">Password:</label></div>
                    <div class="rowInput"><input type="password" id="pass-user-up" /></div>
                </div>
                <div class="rowElem">
                   <div class="rowLabel"><label for="pass1-user-up">Repite Password:</label></div>
                    <div class="rowInput"><input type="password" id="pass1-user-up" /></div>
                </div>
                <div class="rowElem">
                    <div class="rowInput"><a href="#">Actualizar</a></div>
                </div>
            </div>';
        }
        exit;
    case '34'://Actualizar Usuario
        $cons = $objJoven->update_user($_POST['user'],$_POST['res'],$_POST['username'], $_POST['nombre'], $_POST['ap'], $_POST['am'], $_POST['genero'], $_POST['rol'], $_POST['fechaNac'], $_POST['edo'], $_POST['mun'], $_POST['dom'], $_POST['col'],$_POST['cp'], $_POST['telfijo'], $_POST['telcel'], $_POST['email']);
        if( $cons )
            echo '1';
        else
            echo '0';
        exit;
    case '35'://Actualizar Usuario Password
        $cons = $objJoven->update_user_password($_POST['user'],$_POST['pass']);
        if( $cons )
            echo '1';
        else
            echo '0';
        exit;
    case '36'://Eliminar Usuario
        $cons = $objJoven->eliminar_user($_POST['user']);
        if( $cons )
            echo '1';
        else
            echo '0';
        exit;
    case '37'://Cosnulta de estados del joven para modificar
        $cons = $objJoven->consulta_estado();
        echo '<option value="0">[ Selecciona Estado ]</option>';
        while ($edo = mysql_fetch_array($cons)) {
            if($edo[0] == $_POST['edo']){
                echo '<option value='.$edo[0].' selected>'.$edo[1].'</option>';
            }
            else
                echo '<option value='.$edo[0].'>'.$edo[1].'</option>';
        }
        exit;
    case '38'://consulta municipios deaceurdo al estado
        $cons = $objJoven->consulta_munxedo($_POST['estado']);
        echo '<option value="0">[ Selecciona Municipio ]</option>';
        while ($mun= mysql_fetch_array($cons)) {
            if ($mun[0] == $_POST['mun']) {
                 echo '<option value='.$mun[0].' selected>'.$mun[1].'</option>';
            }
            else
                echo '<option value='.$mun[0].'>'.$mun[1].'</option>';
        }
        exit;
    case '39'://consulta de segmetos
        $cons = $objJoven->consulta_segmento();
        while ($seg= mysql_fetch_array($cons)) {
            if ($seg[0] == $_POST['seg']) {
               echo '<option value='.$seg[0].' selected>'.$seg[1].'</option>';
            }
            else
                echo '<option value='.$seg[0].'>'.$seg[1].'</option>';
        }
        exit;
    case '40'://Eventos del joven
        $event = $objJoven->busca_eventos_joven($_POST['joven']);
         echo '<div class="page-wrap"> <div id="noti2"></div><h3> Eventos del Joven</h3>';
         while ($evento = mysql_fetch_array($event)) {
            $resp = $objJoven-> busca_resp_by_id(substr($evento[0], 0, 3));
            $nombre_resp = mysql_fetch_array($resp);
            $mun  = $objJoven-> busca_mun_by_id(substr($evento[0], 3, 2));
            $nombre_mun = mysql_fetch_array($mun);
            $evt  = $objJoven->busca_evento_by_id(substr($evento[0], 5, 5));
            $nombre_evento = mysql_fetch_array($evt);
            echo 'Evento: '.$nombre_evento[0].'<br/>';
            echo 'Fecha Evento: '.substr($evento[0],10,10).'<br/>';
            echo 'Municipio: '.$nombre_mun[0].'<br/>';
            echo 'Edad del Joven: '.$evento[1].'</br>';
            echo 'Responsable: '.$nombre_resp[0].' '.$nombre_resp[1].' '.$nombre_resp[2].'<br/>';
            echo '<a href="#" id="'.$evento[2].'" name="'.$evento[0].'">Borrar Evento</a>'.'<br/><br/>';
            }
         echo '</div>';
        exit;
    case '41'://Select de Eventos Linea
        $cons = $objJoven->consulta_linea();
         echo '<option value="0">[ Selecciona Linea ]</option>';
        while ($edo = mysql_fetch_array($cons)) {
            echo '<option value='.$edo[0].'>'.$edo[1].'</option>';
        }
        
        exit;
    case '42'://Select de Eventos Programa
        $cons = $objJoven->consulta_programa();
         echo '<option value="0">[ Selecciona Programa ]</option>';
        while ($edo = mysql_fetch_array($cons)) {
            echo '<option value='.$edo[0].'>'.$edo[1].'</option>';
        }
       
        exit;
    case '43'://Select de Eventos Estrategia
        $cons = $objJoven->consulta_estrategia();
         echo '<option value="0">[ Selecciona Estrategia ]</option>';
        while ($edo = mysql_fetch_array($cons)) {
            echo '<option value='.$edo[0].'>'.$edo[1].'</option>';
        }
       
        exit;
    case '44'://DEtalle Evento
        $cons = $objJoven->buscarEventoID($_POST['evento']);
        while ($detail = mysql_fetch_array($cons)) {
        if($detail[1]==0){$state='Habilitada';}else{ $state='Deshabilitada';}
        $linea=$objJoven-> consulta_linea_by_id($detail[2]);
        $res= mysql_fetch_array($linea);
        $estrategia=$objJoven-> consulta_estrategia_by_id($detail[3]);
        $res1= mysql_fetch_array($estrategia);
        $programa=$objJoven-> consulta_programa_by_id($detail[4]);
        $res2= mysql_fetch_array($programa);
          echo ' <div class="page-wrap">
                <h3> Detalle del Evento</h3>
                <div class="rowElem">
                   <div class="rowLabel"><label for="nom">Evento:</label></div>
                    <div class="rowInput">
                    <textarea name="" id="" cols="30" rows="10" readonly="readonly">'.$detail[0].'</textarea>
                    </div>
                </div>
                
                <div class="rowElem">
                    <div class="rowLabel"><label for="ap">Estado:</label></div>
                    <div class="rowInput"><input type="text" id="ap" value="'.$state.'" /></div>
                </div>
                
                <div class="rowElem">
                    <div class="rowLabel"><label for="am">Linea:</label></div>
                    <div class="rowInput"><input type="text" id="am"value="'. $res[0].'"  /></div>
                </div>

                
                <div class="rowElem">
                    <div class="rowLabel"><label for="genero">Estrategia:</label></div>
                     <div class="rowInput"><input type="text" id="genero"  value="'.$res1[0].'"  /></div>
                </div>

               
                <div class="rowElem">
                    <div class="rowLabel"><label for="cp">Programa:</label></div>
                    <div class="rowInput"><input type="text" id="cp" name="req-name"  value="'.$res2[0].'"  /></div>
                </div>

                <div class="rowElem">
                    <div class="rowLabel"><label for="cp">Tipo:</label></div>
                    <div class="rowInput"><input type="text" id="cp" name="req-name"  value="'.$detail[5].'" readonly="readonly" /></div>
                </div>
            </div>';
           
        }
        exit;
    case '45'://Dato para update Estado Update
        $cons = $objJoven->consulta_estado_by_id($_POST['estado']);
        $edo = mysql_fetch_array($cons);
        echo $edo[1];
        exit;
    case '46'://Actualizar Estado
        $cons = $objJoven-> update_edo($_POST['estado'],$_POST['nombre']);
        if($cons)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
        exit;
    case '47'://Dato para update munucipio
        $cons = $objJoven->consulta_mun_by_id($_POST['mun']);
        $mun = mysql_fetch_array($cons);
        echo $mun[1].'|'.$mun[2];
        exit;
    case '48'://Actualizar Municipio
        $cons = $objJoven-> update_mun($_POST['id'],$_POST['mun'],$_POST['edo']);
        if($cons)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
        exit;
    case '49'://Dato para update evento
        $cons = $objJoven->buscarEventoID($_POST['evnt']);
        $evnt = mysql_fetch_array($cons);
        echo $evnt[0].'|'.$evnt[1].'|'.$evnt[2].'|'.$evnt[3].'|'.$evnt[4].'|'.$evnt[5];
        exit;
    case '50'://Select de Eventos Linea actualizar evento
        $cons = $objJoven->consulta_linea();
         echo '<option value="0">[ Selecciona Linea ]</option>';
        while ($linea = mysql_fetch_array($cons)) {
            if($linea[0] == $_POST['linea'])
                echo '<option value='.$linea[0].' selected>'.$linea[1].'</option>';
            else
                echo '<option value='.$linea[0].'>'.$linea[1].'</option>';
        }
        
        exit;
    case '51'://Select de Eventos Estrategia actualizar evento
        $cons = $objJoven->consulta_estrategia();
         echo '<option value="0">[ Selecciona Estrategia ]</option>';
        while ($estr = mysql_fetch_array($cons)) {
            if($estr[0] == $_POST['estrategia'])
                echo '<option value='.$estr[0].' selected>'.$estr[1].'</option>';
            else
                echo '<option value='.$estr[0].'>'.$estr[1].'</option>';
        }
        
        exit;
    case '52'://Select de Eventos Programa actualizar evento
        $cons = $objJoven->consulta_programa();
         echo '<option value="0">[ Selecciona Programa ]</option>';
        while ($prog = mysql_fetch_array($cons)) {
            if($prog[0] == $_POST['programa'])
                echo '<option value='.$prog[0].' selected>'.$prog[1].'</option>';
            else
                echo '<option value='.$prog[0].'>'.$prog[1].'</option>';
        }
        
        exit;
    case '53'://Select de Eventos TIpo actualizar evento
        $cons = $objJoven->consulta_tipo();
         echo '<option value="0">[ Selecciona Tipo ]</option>';
        while ($tipo = mysql_fetch_array($cons)) {
            if($tipo[0] == $_POST['tipo'])
                echo '<option value='.$tipo[0].' selected>'.$tipo[0].'</option>';
            else
                echo '<option value='.$tipo[0].'>'.$tipo[0].'</option>';
        }
        
        exit;
    case '54'://Actualizar Evento
        $cons = $objJoven->update_evento($_POST['id'],$_POST['evento'],$_POST['edo'],$_POST['linea'],$_POST['estrategia'],$_POST['programa'],$_POST['tipo']);
        if($cons)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
        exit;
    case '55'://Dato para update Segmento Update
        $cons = $objJoven->consulta_segmento_by_id($_POST['segmento']);
        $seg = mysql_fetch_array($cons);
        echo $seg[1];
        exit;
     case '56'://Actualizar Segmento
        $cons = $objJoven-> update_seg($_POST['id'],$_POST['segmento']);
        if($cons)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
        exit;
    case '57'://Dato para update Talento Update
        $cons = $objJoven->consulta_talento_by_id($_POST['talento']);
        $tal = mysql_fetch_array($cons);
        echo $tal[1];
        exit;
    case '58'://Actualizar Talento
        $cons = $objJoven->update_tal($_POST['id'],$_POST['talento']);
        if($cons)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
        exit;
     case '59'://Dato para update Rol Update
        $cons = $objJoven->consulta_rol_by_id($_POST['rol']);
        $rol = mysql_fetch_array($cons);
        echo $rol[1];
        exit;
    case '60'://Actualizar rol
        $cons = $objJoven->update_rol($_POST['id'],$_POST['rol']);
        if($cons)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
        exit;
    case '61'://Eliminar Estado
        $cons = $objJoven->eliminar_edo($_POST['edo']);
        if( $cons )
            echo 'Se ha eliminado correctamente el Estado';
        else
            echo 'Erorr al eliminar el Estado';
        exit;
    case '61'://Eliminar Estado
        $cons = $objJoven->eliminar_edo($_POST['edo']);
        if( $cons )
            echo 'Se ha eliminado correctamente el Estado';
        else
            echo 'Erorr al eliminar el Estado';
        exit;
    case '62'://Eliminar Estado
        $cons = $objJoven->eliminar_mun($_POST['mun']);
        if( $cons )
            echo 'Se ha eliminado correctamente el Municipio';
        else
            echo 'Erorr al eliminar el Municipio';
        exit;
    case '63'://Eliminar Estado
        $cons = $objJoven->eliminar_evnt($_POST['evnt']);
        if( $cons )
            echo 'Se ha eliminado correctamente el Evento';
        else
            echo 'Erorr al eliminar el Evento';
        exit;
    case '64'://Eliminar Estado
        $cons = $objJoven->eliminar_seg($_POST['seg']);
        if( $cons )
            echo 'Se ha eliminado correctamente el Segmento';
        else
            echo 'Erorr al eliminar el egmento';
        exit;
    case '65'://Eliminar Estado
        $cons = $objJoven->eliminar_tal($_POST['tal']);
        if( $cons )
            echo 'Se ha eliminado correctamente el Talento';
        else
            echo 'Erorr al eliminar el Talento';
        exit;
    case '66'://Eliminar Estado
        $cons = $objJoven->eliminar_rol($_POST['rol']);
        if( $cons )
            echo 'Se ha eliminado correctamente el Rol';
        else
            echo 'Erorr al eliminar el Rol';
        exit;
}
function crearPaginacion($nom, $ama, $apa, $tipo, $evento, $resultados_cantidad)
{
    //$objJoven = new Joven;
    $filas_pagina=10;
    $numero_pagina=1;
    
    if(isset($_POST["screen"]) )
    {
        sleep(1);
        $numero_pagina=$_POST["screen"];
    }
    $pages = ceil($resultados_cantidad / $filas_pagina);
    $campo_de_inicio=($numero_pagina-1)*$filas_pagina;
    $total_registros=ceil($resultados_cantidad/$filas_pagina);
    //Tipo 2 es iguala busncar por nombre
    if ( $tipo == '2' ) {
        $dato = 'Busqueda por Nombre';
        $cons = $GLOBALS['objJoven']->buscar_Nombre($_POST['nom'],$_POST['apa'],$_POST['ama'],$campo_de_inicio, $filas_pagina);
    }
    //Tipo 3 es igual abuscar po evento
    else if ($tipo == '3' ) {
        $dato = 'Busqueda por Evento';
        $cons = $GLOBALS['objJoven']->buscar_Evento($_POST['find-evnt'],$campo_de_inicio, $filas_pagina);
    }
    
    //consulta ala db por limites
    //$cons = $objJoven->buscar_Nombre($_POST['nom'],$_POST['apa'],$_POST['ama'],$campo_de_inicio, $filas_pagina);
    print($dato);
    echo '<br/> 
    <div class="header-find search">ID</div>'.'<div class="header-find search">NOMBRE</div>'.'<div class="header-find search">A PATERNO</div>'.'<div class="header-find search">A MATERNO</div>'.'<div class="header-find search">GENERO</div>'.'<div class="header-find search">MUNICIPIO</div>'.'<div class="header-find search">DETALLE</div>'.'<div class="header-find search">MODIFICAR</div>'.'<div class="header-find search">ELIMINAR</div>'.'<div class="header-find search">CLASIFICAR</div>';
    while( $joven = mysql_fetch_array($cons))//while ($modulos=mysql_fetch_array($consulta)) href=\'#prod2\' rel="modal:open"
    {
        
        echo '<div class="search">'.$joven[0].'</div><div class="search">'.$joven[1].'</div><div class="search">'.$joven[2].'</div><div class="search">'.$joven[3].'</div><div class="search">'.$joven[4].'</div><div class="search">'.$joven[5].'</div>'.'<div class="search"><a class="detail" href="detalle.php?young='.$joven[0].'" target="_blank"  >Detalles</a></div><div class="search"><a class="detail" href="modificar.php?young='.$joven[0].'" target="_blank"  >Modificar</a></div><div class="search"><a class="detail" href="#" rel="Eliminar" id="'.$joven[0].'" name="'.$tipo.'">Eliminar</a></div><div class="search"><a class="detail" href="#" target="_blank" >Clasificar</a></div>';
    }
    if ($total_registros>1)
    { 
        echo "<div class='pagination' align='center'>";
        if( $tipo == '2') {
            if ($numero_pagina!=1){
            echo "<a id='paginarname' data='".(1)."'>Primero</a> ";
            echo "<a id='paginarname' data='".($numero_pagina-1)."'>Anterior</a> ";}
        
            echo '<strong>' ."Encuesta ".($numero_pagina).' de '.$total_registros.' </strong>';
            if($numero_pagina!=$total_registros)
            {
                echo "<a id='paginarname' data='".($numero_pagina+1)."'>Siguiente</a>";
                echo "<a id='paginarname' data='".($pages)."'>Uitimo</a>";
            }
        }
        else if ( $tipo == '3') {
            if ($numero_pagina!=1){
            echo "<a id='paginarevt' data='".(1)."'>Primero</a> ";
            echo "<a id='paginarevt' data='".($numero_pagina-1)."'>Anterior</a> ";}
        
            echo '<strong>' ."Encuesta ".($numero_pagina).' de '.$total_registros.' </strong>';
            if($numero_pagina!=$total_registros)
            {
                echo "<a id='paginarevt' data='".($numero_pagina+1)."'>Siguiente</a>";
                echo "<a id='paginarevt' data='".($pages)."'>Uitimo</a>";
            }
        }
        echo "</div>";
    }
}
?>