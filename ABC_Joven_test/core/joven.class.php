<?php 
include_once("../clases/conexion.class.php");

class Joven 
{
 //constructor	
 	var $con;
 	function Joven()
 	{
 		$this->con = new DBManager;
 	}

 	//Funcion Perifil de usuario, obtener nombre y  obtener el Rol para los menus
 	function check_perfil($id_user)
 	{
 		if($this->con->conectar()==true)
 		{
 			return mysql_query("SELECT cat_Rol.Rol,cat_Rol.busquedas,cat_Rol.altas,cat_Rol.usuarios,cat_Rol.catalogos FROM cat_rol INNER JOIN usuarios ON cat_Rol.Id_Rol = usuarios.Id_Rol WHERE usuarios.Id_Usuario='".$id_user."'");

 			//return mysql_query("SELECT Rol,busquedas,altas,bajas,modificar,tableros,talentos,usuarios,catalogos FROM cat_rol WHERE Id_Rol='$id_rol'");
 		}
 		$this->con->cerrar_conexion();
 	}
 	// Funcion Verificcar Responsable y Usuario
 	function check_user($id_user)
 	{
 		if($this->con->conectar()==true)
 		{
 			return mysql_query("SELECT Id_Responsable from usuarios where Id_Usuario = '".$id_user."'");
 		}
 		$this->con->cerrar_conexion();
 	}
 	//Buscar Joven
 	function buscarJovenID($id)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query("SELECT detalle_joven.Id_Joven, detalle_joven.Nombre, detalle_joven.A_Paterno,detalle_joven.A_Materno,detalle_joven.CURP,detalle_joven.RFC,detalle_joven.Genero,detalle_joven.Fecha_Nac,detalle_joven.Calle_Num,detalle_joven.Colonia,detalle_joven.Id_Municipio,detalle_joven.Id_Estado,detalle_joven.CP,detalle_joven.Id_Segmento,detalle_joven.Escuela,datos_contacto.Lada_Fijo, datos_contacto.Tel_Fijo, datos_contacto.Lada_Cel, datos_contacto.Tel_Cel,datos_contacto.E_mail FROM detalle_joven INNER JOIN datos_contacto ON detalle_joven.Id_Joven = datos_contacto.Id_Persona WHERE detalle_joven.Id_Joven= '".$id."' LIMIT 1");

 			//return mysql_query("SELECT detalle_joven.Id_Joven, detalle_joven.Nombre, detalle_joven.A_Paterno,detalle_joven.A_Materno,detalle_joven.CURP,detalle_joven.RFC,detalle_joven.Genero,detalle_joven.Fecha_Nac,detalle_joven.Calle_Num,detalle_joven.Colonia,detalle_joven.Id_Municipio,detalle_joven.Id_Estado,detalle_joven.CP,detalle_joven.Id_Segmento,detalle_joven.Escuela,datos_contacto.Lada_Fijo, datos_contacto.Tel_Fijo, datos_contacto.Lada_Cel, datos_contacto.Tel_Cel,datos_contacto.E_mail FROM detalle_joven INNER JOIN datos_contacto WHERE detalle_joven.Id_Joven= '".$id."' LIMIT 1");


 		}
 		$this->con->cerrar_conexion();
 	}

 	function buscarUserID($id)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT Id_Responsable,Nombre_Usuario,Nombre,A_Paterno,A_Materno,Genero, Fecha_Nac,Edad,Calle_Num,Colonia,Id_Municipio,Id_Estado,CP,Id_Rol,Lada_Fijo,Tel_Fijo,Lada_Cel,Tel_Cel,E_mail FROM usuarios WHERE Id_Usuario="'.$id.'"');
 		}
 		$this->con->cerrar_conexion();

 	}
 	function actualizar_Joven($id, $nombre, $apa, $ama, $genero, $segmento, $fechaNac, $tal, $mun, $curp, $rfc, $dom, $cp, $col, $tel, $telcel, $email, $est)
 	{
 		if($this->con->conectar())
 		{
 			$edad = edadJoven($fechaNac);
 			if(mysql_query('UPDATE detalle_joven SET Nombre=$nombre, A_Paterno=$apa, A_Materno=$ama, CURP=$curp, RFC=$rfc, Genero=$genero, Fecha_Nac=$fechaNac, Edad=$edad, Calle_Num=$dom, Colonia=$col, Id_Municipio=$mun, Id_Estado=$edo, CP=$cp, Id_Segmento=$segmento, Escuela=$est WHERE Id_Joven = $id '))
 			{
 				return mysql_query('UPDATE datos_contacto SET Tel_Fijo =$tel, Tel_Cel=$telcel, E_mail= $email WHERE Id_Persona=$id');
 			}
 		}
 		$this->con->cerrar_conexion();
 	}
 	/* BUSCAR *********************************/
 	function countBuscaNombre($nom, $apa, $ama)
 	{
 		if($this->con->conectar())
 		{
 			//solo nombre
	 		if(isset($nom) && $apa==null && $ama==null)
	 		{
	 			return  mysql_query("SELECT Id_Joven FROM detalle_joven WHERE Nombre='$nom' ORDER BY Id_Joven ");
	 		}
	 		//solo a. paterno
	 		else if($nom==null && isset($apa) and $ama==null)
	 		{
	 			return  mysql_query("SELECT Id_Joven FROM detalle_joven WHERE A_Paterno='".$apa."' ORDER BY Id_Joven ");
	 		}
	 		//solo a materno
	 		else if($nom==null && $apa==null and isset($ama))
	 		{
	 			return  mysql_query("SELECT Id_Joven FROM detalle_joven WHERE A_Materno='".$ama."' ORDER BY Id_Joven ");
	 		}
	 		//nombre y a.paterno
	 		else if(isset($nom) && isset($apa) and $ama==null)
	 		{
	 			return  mysql_query("SELECT Id_Joven FROM detalle_joven WHERE Nombre='".$nom."' AND A_Paterno='".$apa."' ORDER BY Id_Joven ");
	 		}
	 		//nombre  a. materno
	 		else if(isset($nom) && $apa==null && isset($ama))
	 		{
	 			return  mysql_query("SELECT Id_Joven FROM detalle_joven WHERE Nombre='".$nom."' AND A_Materno='".$ama."' ORDER BY Id_Joven ");
	 		}
	 		//a. paterno y a. materno
	 		else if ($nom==null && isset($apa) && isset($ama))
	 		{
	 			return  mysql_query("SELECT Id_Joven FROM detalle_joven WHERE A_Paterno='".$apa."' AND A_Materno='".$ama."' ORDER BY Id_Joven ");
	 		}
	 		//nombre completo
	 		if(isset($nom) && isset($apa) && isset($ama))
	 		{
	 			return  mysql_query("SELECT Id_Joven FROM detalle_joven WHERE Nombre='$nom' AND A_Paterno='$apa' AND A_Materno='$ama' ORDER BY Id_Joven ");
	 		}
 		}
 		$this->con->cerrar_conexion();
 	}

 	function buscar_Nombre($nom, $apa, $ama, $position, $limit)
 	{
 		if($this->con->conectar())
 		{
 			//solo nombre
	 		if(isset($nom) && $apa==null && $ama==null)
	 		{
	 			return  mysql_query("SELECT detalle_joven.Id_Joven,detalle_joven.Nombre,detalle_joven.A_Paterno,detalle_joven.A_Materno,detalle_joven.Genero,cat_municipio.Nombre FROM detalle_joven INNER JOIN cat_municipio ON detalle_joven.Id_Municipio = cat_municipio.Id_Municipio WHERE detalle_joven.Nombre='$nom' ORDER BY detalle_joven.A_Paterno LIMIT ".$position.", ".$limit."");
	 		}
	 		//solo a. paterno
	 		else if($nom==null && isset($apa) and $ama==null)
	 		{
	 			return  mysql_query("SELECT detalle_joven.Id_Joven,detalle_joven.Nombre,detalle_joven.A_Paterno,detalle_joven.A_Materno,detalle_joven.Genero,cat_municipio.Nombre FROM detalle_joven INNER JOIN cat_municipio ON detalle_joven.Id_Municipio = cat_municipio.Id_Municipio WHERE detalle_joven.A_Paterno='$apa' ORDER BY detalle_joven.A_Paterno LIMIT ".$position.", ".$limit."");
	 		}
	 		//solo a materno
	 		else if($nom==null && $apa==null and isset($ama))
	 		{
	 			return  mysql_query("SELECT detalle_joven.Id_Joven,detalle_joven.Nombre,detalle_joven.A_Paterno,detalle_joven.A_Materno,detalle_joven.Genero,cat_municipio.Nombre FROM detalle_joven INNER JOIN cat_municipio ON detalle_joven.Id_Municipio = cat_municipio.Id_Municipio WHERE detalle_joven.A_Materno='$ama' ORDER BY detalle_joven.A_Paterno LIMIT ".$position.", ".$limit."");
	 		}
	 		//nombre y a.paterno
	 		else if(isset($nom) && isset($apa) and $ama==null)
	 		{
	 			return  mysql_query("SELECT detalle_joven.Id_Joven,detalle_joven.Nombre,detalle_joven.A_Paterno,detalle_joven.A_Materno,detalle_joven.Genero,cat_municipio.Nombre FROM detalle_joven INNER JOIN cat_municipio ON detalle_joven.Id_Municipio = cat_municipio.Id_Municipio WHERE detalle_joven.Nombre='$nom' AND detalle_joven.A_Paterno='$apa' ORDER BY detalle_joven.A_Paterno LIMIT ".$position.", ".$limit."");
	 		}
	 		//nombre  a. materno
	 		else if(isset($nom) && $apa==null && isset($ama))
	 		{
	 			return  mysql_query("SELECT detalle_joven.Id_Joven,detalle_joven.Nombre,detalle_joven.A_Paterno,detalle_joven.A_Materno,detalle_joven.Genero,cat_municipio.Nombre FROM detalle_joven INNER JOIN cat_municipio ON detalle_joven.Id_Municipio = cat_municipio.Id_Municipio WHERE detalle_joven.Nombre='$nom' AND A_Materno='$ama' ORDER BY detalle_joven.A_Paterno LIMIT ".$position.", ".$limit."");
	 		}
	 		//a. paterno y a. materno
	 		else if ($nom==null && isset($apa) && isset($ama))
	 		{
	 			return  mysql_query("SELECT detalle_joven.Id_Joven,detalle_joven.Nombre,detalle_joven.A_Paterno,detalle_joven.A_Materno,detalle_joven.Genero,cat_municipio.Nombre FROM detalle_joven INNER JOIN cat_municipio ON detalle_joven.Id_Municipio = cat_municipio.Id_Municipio WHERE detalle_joven.A_Paterno='$apa' AND detalle_joven.A_Materno='$ama' ORDER BY detalle_joven.A_Paterno LIMIT ".$position.", ".$limit."");
	 		}
	 		//nombre completo
	 		if(isset($nom) && isset($apa) && isset($ama))
	 		{
	 			return  mysql_query("SELECT detalle_joven.Id_Joven,detalle_joven.Nombre,detalle_joven.A_Paterno,detalle_joven.A_Materno,detalle_joven.Genero,cat_municipio.Nombre FROM detalle_joven INNER JOIN cat_municipio ON detalle_joven.Id_Municipio = cat_municipio.Id_Municipio WHERE detalle_joven.Nombre='$nom' AND detalle_joven.A_Paterno='$apa' AND detalle_joven.A_Materno='$ama' ORDER BY detalle_joven.A_Paterno LIMIT ".$position.", ".$limit."");
	 		}
 		}
 		$this->con->cerrar_conexion();
 	}
 	function countBuscarEvento($evento)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query("SELECT Id_Joven FROM asist_eventos WHERE No_control='".$evento."'");
 		}
 		$this->con->cerrar_conexion();
 	}
 	function buscar_Evento($evento,  $position, $limit)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query("SELECT detalle_joven.Id_Joven,detalle_joven.Nombre,detalle_joven.A_Paterno,detalle_joven.A_Materno,detalle_joven.Genero,cat_municipio.Nombre FROM asist_eventos INNER JOIN detalle_joven  ON asist_eventos.Id_Joven = detalle_joven.Id_Joven INNER JOIN cat_municipio ON detalle_joven.Id_Municipio = cat_municipio.Id_Municipio WHERE asist_eventos.No_control='$evento' ORDER BY detalle_joven.A_Paterno LIMIT ".$position.", ".$limit."");
 		}
 		$this->con->cerrar_conexion();
 		//
 	}
 	/* ALTAS************************************/
 	/*function registrar_Evento()
 	{
 	}*/
 	function edadJoven($dateN)
	{
		$aFecha = explode( '-', $dateN);
		$dateNac = floor(( (date("Y") - $aFecha[0] ) * 372 + ( date("m") - $aFecha[1] ) * 31 + Date("d" ) - $aFecha[2] )/372) ;
		return $dateNac;
	}
	function validarFecha($fEvento)
	{
		$feV=$fEvento;
        $mifecha=date("Y-m-d");//echo $mifecha;
        $fechaComparacion = strtotime("$feV");
        $calculo= strtotime("7 days", $fechaComparacion);
        if($mifecha > date("Y-m-d",$calculo))
           	return true;
        
        else
           	return false;  
	}
 	function verificar_Joven($nom, $apa, $ama, $mun, $fechaNac)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query("SELECT Id_Joven FROM detalle_joven WHERE Nombre = '".strtoupper($nom)."' && A_Paterno = '".strtoupper($apa)."' && A_Materno ='".strtoupper($ama)."' && Fecha_Nac='".$fechaNac."' && Id_Municipio='".$mun."' ");
 			//falta cerra conexion
 		}
 		$this->con->cerrar_conexion();
 	}
 	function verifica_jovenEvento($idjov, $noControl)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query("SELECT Id_Joven FROM asist_eventos WHERE Id_Joven = '".$idjov."' AND No_control = '".$noControl."'");
 		}
 		$this->con->cerrar_conexion();
 	}
 	function registrar_Joven( $nombre, $apa, $ama, $genero, $segmento, $fechaNac, $edo, $mun, $curp, $rfc, $dom, $col, $tel, $telcel, $email, $est, $cat_ev, $fechaEv, $obs, $evento, $place, $sector)
 	{
 		$dateV = $this->validarFecha($fechaEv);
 		$date=date('Y-m-d H:i:s');
 		//verifica si el joven ya existe en la tabla 
 		$user = $this->verificar_Joven($nombre, $apa, $ama, $mun, $fechaNac);
 		//si el joven ya existe en la tabla
 		if ( mysql_num_rows($user) > 0 )
 		{
 			//se extrae el id del joven 
 			$iduser = mysql_fetch_array($user);
 			$id = $iduser["Id_Joven"];
 			//se verifica si el joven en el evnento
 			$userEv = $this->verifica_jovenEvento($id, $evento);
 			if ( mysql_num_rows($userEv) == 0 || mysql_num_rows($userEv) == null)
 			{
 				return $this->registro_jovenEvento($cat_ev, $id, $fechaEv, $obs, $fechaNac, $evento, $place, $sector, $date, $dateV);
 			}
 			else
 			{
 				return '3';
 			}
 		}
 		//si en joven no existe en la tabla 
 		else
 		{
 			 return $this->registro_Joven($nombre, $apa, $ama, $genero, $segmento, $fechaNac, $edo, $mun, $curp, $rfc, $dom, $col, $tel, $telcel, $email, $est, $cat_ev, $fechaEv, $obs, $evento, $place, $sector, $date, $dateV);
 		}
 		$this->con->cerrar_conexion();
 	}
 	function registro_Joven($nombre, $apa, $ama, $genero, $segmento, $fechaNac, $edo, $mun, $curp, $rfc, $dom, $col, $tel, $telcel, $email, $est, $cat_ev, $fechaEv, $obs, $evento, $place, $sector, $date, $dateV)
 	{
 		if($this->con->conectar())
 		{
 			$edad = $this->edadJoven($fechaNac);
 			//Guardar Joven en detalle Joven
 			if(mysql_query("INSERT INTO detalle_joven(Nombre,A_Paterno,A_Materno,CURP,RFC,Genero,Fecha_Nac,Edad,Calle_Num,Colonia,Id_Municipio,Id_Estado,Id_Segmento,fecha,User,Escuela) VALUES ('".trim(strtoupper($nombre))."','".trim(strtoupper($apa))."','".trim(strtoupper($ama))."','".strtoupper($curp)."','".strtoupper($rfc)."','".$genero."','".$fechaNac."','".$edad."','".strtoupper($dom)."','".strtoupper($col)."','".$mun."','".$edo."','".$segmento."','".$date."','".($_SESSION['user'])."','".$est."')"))
 			{

 			//Seleccionar ID de Jovne guardado 
	 			$resultd = $this->verificar_Joven($nombre, $apa, $ama, $mun, $fechaNac);
				$rowE = mysql_fetch_array($resultd);

				//Guardar DAtos  de contacto al joven
			   if(mysql_query("INSERT INTO datos_contacto (Id_Persona,Tel_Fijo,Tel_Cel,E_mail,No_control) VALUES ('".$rowE[0]."','".$tel."','".$telcel."','".strtolower($email)."','".$evento."')"))
			   {
				   //Guardar Evento al joven
		 		   if(mysql_query("INSERT INTO asist_eventos (Cat_Ev,Id_Joven,Fecha_Part,Observaciones,Edad,No_control,Lugar,Sector,ouTime,FechaCap) VALUES('".$cat_ev."','".$rowE[0]."','".$fechaEv."','".strtoupper($obs)."','".$edad."','".$evento."','".strtoupper($place)."','".$sector."','".$dateV."','".$date."')"))
		 		   {
		 		   		return '1';
		 		   }
		 		}
 		    }
 		}
 		$this->con->cerrar_conexion();
 	}
 	function registro_jovenEvento($cat_ev, $id, $fechaEv, $obs, $edad, $evento, $place, $sector, $date, $dateV)
 	{
 		if($this->con->conectar())
 		{
 			$edad = $this->edadJoven($fechaNac);
 			if(mysql_query("INSERT INTO asist_eventos (Cat_Ev,Id_Joven,Fecha_Part,Observaciones,Edad,No_control,Lugar,Sector,ouTime,FechaCap) 
        		VALUES('".$cat_ev."','".$id."','".$fechaEv."','".strtoupper($obs)."','".$edad."','".$evento."','".strtoupper($place)."','".$sector."','".$dateV."','".$date."')"))
 			{
 				return '2';
 			}
 		}
 		$this->con->cerrar_conexion();
 	}

 	function verificar_cierre($fechaEv)
 	{

 		if($this->con->conectar())
 		{
 			$cierreFecha = explode( '-', $fechaEv);
 			return mysql_query("SELECT cierre FROM fecha_cierre WHERE anio='".$cierreFecha[0]."' AND mes='".$cierreFecha[1]."'");

 		}
 		$this->con->cerrar_conexion();
 	}
 	function verificar_responsbale()
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query("SELECT");
 		}
 	}
 	/* ADMIN CATALOGOS ******/
 	function update_edo($edo, $nombre)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('UPDATE cat_estado SET Nombre="'.$nombre.'" WHERE Id_Estado="'.$edo.'"');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function alta_estado($estado)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('INSERT INTO cat_estado (Nombre) VALUES("'.trim(strtoupper($estado)).'")');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_estado()
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT Id_Estado, Nombre FROM cat_estado ORDER BY Nombre');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_estado_by_id($id_edo)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT Id_Estado, Nombre FROM cat_estado WHERE Id_Estado='.$id_edo.'');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function alta_mun($mun, $edo)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('INSERT INTO cat_municipio (Id_Estado, Nombre) VALUES("'.$edo.'", "'.trim(strtoupper($mun)).'")');
 		}
 		$this->con->cerrar_conexion();
 	}
 	//Consulta de munuicipio en catalogos
 	function update_mun($id,$mun,$edo)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('UPDATE cat_municipio SET Nombre="'.$mun.'", Id_Estado="'.$edo.'" WHERE Id_Municipio="'.$id.'"');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_Mun_Search()
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT cat_municipio.Id_Municipio, cat_estado.Nombre, cat_municipio.Nombre FROM cat_municipio INNER JOIN cat_estado ON cat_municipio.Id_Estado = cat_estado.Id_Estado ORDER BY cat_estado.Id_Estado, cat_municipio.Nombre');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_mun()
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT Id_Municipio, Nombre FROM cat_municipio WHERE Id_Estado=1 ORDER BY Nombre');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_mun_by_id($id_mun)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT Id_Municipio, Nombre, Id_Estado FROM cat_municipio WHERE Id_Municipio='.$id_mun.'');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_munxedo($id_edo)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT Id_Municipio, Nombre FROM cat_municipio WHERE Id_Estado="'.$id_edo.'" ORDER BY Nombre');
 		}
 		$this->con->cerrar_conexion();
 	}
 
 	//consulta de Evento en catalogos

 	function consulta_Evento_Search()
 	{
 		if($this->con->conectar())
 		{
 			//if($id_tipo == 0)
 			return mysql_query('SELECT Id_Evento,Nombre_Evento,Deshabilitada,Tipo FROM cat_evento ORDER BY Nombre_Evento');
 			//else
 				//return mysql_query('SELECT Id_Evento, Nombre_Evento FROM cat_evento ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function alta_evento($nombreEvento,$linea,$estrategia,$programa,$tipo)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('INSERT INTO cat_evento (Nombre_Evento,Deshabilitada,Id_linea,Id_Estrategia,Id_programa,Tipo) VALUES("'.trim(strtoupper($nombreEvento)).'","'.false.'","'.$linea.'","'.$estrategia.'","'.$programa.'","'.$tipo.'")');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function update_evento($id, $evento, $edo, $linea, $estrategia, $programa, $tipo)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('UPDATE cat_evento SET Nombre_Evento="'.$evento.'", Deshabilitada="'.$edo.'", Id_linea="'.$linea.'", Id_Estrategia="'.$estrategia.'", Id_Programa="'.$programa.'", Tipo="'.$tipo.'" WHERE Id_Evento="'.$id.'" ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function verificar_eventoname($name,$linea,$estrategia,$programa,$tipo)
 	{
 		if($this->con->conectar())
 		{
 			$edad = $this->edadJoven($fecha);
 			return mysql_query('SELECT Id_Evento FROM cat_evento WHERE Nombre_Evento="'.$name.'" AND  Id_linea="'.$linea.'" AND Id_Estrategia = "'.$estrategia.'" AND Id_programa = "'.$programa.'" AND Tipo = "'.$tipo.'" ');
 		}
 		$this->con->cerrar_conexion();
 	}	
 	function consulta_evento($id_tipo)
 	{
 		if($this->con->conectar())
 		{
 			//if($id_tipo == 0)
 			return mysql_query('SELECT Id_Evento,Nombre_Evento FROM cat_evento WHERE  Deshabilitada=0 AND Tipo=1 ORDER BY Nombre_Evento');
 			//else
 				//return mysql_query('SELECT Id_Evento, Nombre_Evento FROM cat_evento ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_linea()
 	{
 		if($this->con->conectar())
 		{
 			//if($id_tipo == 0)
 			return mysql_query('SELECT Id_linea, Descripcion FROM cat_linea ORDER BY Descripcion');
 			//else
 				//return mysql_query('SELECT Id_Evento, Nombre_Evento FROM cat_evento ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_programa()
 	{
 		if($this->con->conectar())
 		{
 			//if($id_tipo == 0)
 			return mysql_query('SELECT Id_programa, Programa FROM cat_programa ORDER BY Programa');
 			//else
 				//return mysql_query('SELECT Id_Evento, Nombre_Evento FROM cat_evento ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_estrategia()
 	{
 		if($this->con->conectar())
 		{
 			//if($id_tipo == 0)
 			return mysql_query('SELECT Id_estrategia, Estrategia FROM cat_estrategia ORDER BY Estrategia');
 			//else
 				//return mysql_query('SELECT Id_Evento, Nombre_Evento FROM cat_evento ');
 		}
 		$this->con->cerrar_conexion();
 	}


 	function update_seg($id, $segmento)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('UPDATE cat_segmento SET Segmento="'.$segmento.'" WHERE Id_Segmento="'.$id.'" ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function alta_segmento($segmento)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('INSERT INTO cat_segmento (Segmento) VALUES("'.trim(strtoupper($segmento)).'")');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_segmento()
 	{
 		if($this->con->conectar())
 		{
 			//if($id_tipo == 0)
 			return mysql_query('SELECT Id_Segmento, Segmento FROM cat_segmento');
 			//else
 				//return mysql_query('SELECT Id_Evento, Nombre_Evento FROM cat_evento ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_segmento_by_id($idseg)
 	{
 		if($this->con->conectar())
 		{
 			//if($id_tipo == 0)
 			return mysql_query('SELECT Id_Segmento, Segmento FROM cat_segmento WHERE Id_Segmento='.$idseg.'');
 			//else
 				//return mysql_query('SELECT Id_Evento, Nombre_Evento FROM cat_evento ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function update_tal($id, $talento)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('UPDATE cat_talentos SET Nombre="'.$talento.'" WHERE Id_Talento='.$id.' ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function alta_talento($talento)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('INSERT INTO cat_talentos (Nombre) VALUES("'.trim(strtoupper($talento)).'")');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_talento()
 	{
 		if($this->con->conectar())
 		{
 			//if($id_tipo == 0)
 			return mysql_query('SELECT Id_Talento, Nombre FROM cat_talentos');
 			//else
 				//return mysql_query('SELECT Id_Evento, Nombre_Evento FROM cat_evento ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_talento_by_id($id)
 	{
 		if($this->con->conectar())
 		{
 			//if($id_tipo == 0)
 			return mysql_query('SELECT Id_Talento, Nombre FROM cat_talentos WHERE Id_Talento='.$id.'');
 			//else
 				//return mysql_query('SELECT Id_Evento, Nombre_Evento FROM cat_evento ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_rol_by_id($id_rol)
 	{
 		if($this->con->conectar())
 		{
 			//if($id_tipo == 0)
 			return mysql_query('SELECT Id_Rol, Rol FROM cat_rol WHERE Id_Rol ="'.$id_rol.'"');
 			//else
 				//return mysql_query('SELECT Id_Evento, Nombre_Evento FROM cat_evento ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function update_rol($id, $rol)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('UPDATE cat_rol SET Rol="'.$rol.'" WHERE Id_Rol='.$id.' ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function alta_roles($rol)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('INSERT INTO cat_rol (Rol) VALUES("'.trim(strtoupper($rol)).'")');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_roles()
 	{
 		if($this->con->conectar())
 		{
 			//if($id_tipo == 0)
 			return mysql_query('SELECT Id_Rol, Rol FROM cat_rol');
 			//else
 				//return mysql_query('SELECT Id_Evento, Nombre_Evento FROM cat_evento ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	/* RESPONSABLES **/
 	function consulta_resposable_by_id($idres)
 	{
 		if($this->con->conectar())
 		{
 			//if($id_tipo == 0)
 			return mysql_query('SELECT Id_Responsable, Nombre, A_Paterno, A_Materno FROM cat_responsable WHERE Id_Responsable='.$idres.'');
 			//else
 				//return mysql_query('SELECT Id_Evento, Nombre_Evento FROM cat_evento ');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_responsable()
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT Id_Responsable, Nombre, A_Paterno, A_Materno FROM cat_responsable WHERE Deshabilitado=0 ORDER BY Nombre');
 		}
 		$this->con->cerrar_conexion();
 	}
 	/* USUARIOS *****/
 	function verificar_username($username)
 	{
 		if($this->con->conectar())
 		{
 			$edad = $this->edadJoven($fecha);
 			return mysql_query('SELECT Id_Usuario FROM usuarios WHERE Nombre_Usuario="'.$username.'"');
 		}
 		$this->con->cerrar_conexion();
 	}	
 	function alta_usuario($res, $nomuser, $pass, $nombre, $apa, $ama, $genero, $fecha, $calle, $col, $mun, $edo, $cp, $rol, $tel, $telcel, $email)
 	{
 		if($this->con->conectar())
 		{
 			$edad = $this->edadJoven($fecha);
 			return mysql_query('INSERT INTO usuarios (Id_Responsable,Nombre_Usuario,Password,Nombre,A_Paterno,A_Materno,Genero,Fecha_Nac,Edad,Calle_Num,Colonia,Id_Municipio,Id_Estado,CP,Id_Rol,Tel_Fijo,Tel_Cel,E_mail) VALUES("'.$res.'", "'.$nomuser.'", "'.$pass.'", "'.trim(strtoupper($nombre)).'", "'.trim(strtoupper($apa)).'", "'.trim(strtoupper($ama)).'", "'.$genero.'","'.$fecha.'", "'.$edad.'", "'.trim(strtoupper($calle)).'", "'.trim(strtoupper($col)).'", "'.$mun.'", "'.$edo.'", "'.$cp.'", "'.$rol.'", "'.$tel.'", "'.$telcel.'", "'.$email.'")');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_usuario()
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT usuarios.Id_Usuario, usuarios.Nombre_Usuario, cat_rol.Rol FROM usuarios INNER JOIN cat_rol ON usuarios.Id_Rol = cat_Rol.Id_Rol ORDER BY Id_Usuario');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function update_user($user, $res, $username, $nombre, $apa, $ama, $genero, $rol, $fechaNac, $edo, $mun, $dom, $cp, $col, $tel, $telcel, $email)
 	{
 		if($this->con->conectar())
 		{
 			$edad = $this->edadJoven($fechaNac);
 			return mysql_query("UPDATE usuarios SET Id_Responsable ='".$res."', Nombre_Usuario='".trim(strtoupper($username))."', Nombre = '".trim(strtoupper($nombre))."', A_Paterno = '".trim(strtoupper($apa))."', A_Materno = '".trim(strtoupper($ama))."',  Genero =  '".$genero."', Fecha_Nac = '".$fechaNac."', Edad = '".$edad."', Calle_Num = '".$dom."', Colonia = '".$col."', Id_Municipio = '".$mun."', Id_Estado = '".$edo."', CP='".trim(strtoupper($cp))."',Tel_Fijo='".trim(strtoupper($tel))."',Tel_Cel='".trim(strtoupper($telcel))."',E_mail='".$email."' WHERE Id_Usuario = '".$user."'");
 		}
 		$this->con->cerrar_conexion();
 	}
 	function update_user_password($user, $pass)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query("UPDATE usuarios SET Password ='".$pass."' WHERE Id_Usuario = '".$user."'");
 		}
 		$this->con->cerrar_conexion();
 	}
 	function update_joven($joven, $nombre, $apa, $ama, $genero, $segmento, $fechaNac, $edo, $mun, $curp, $rfc, $dom, $col, $tel, $telcel, $email, $est )
 	{
 		if($this->con->conectar())
 		{
 			$edad = $this->edadJoven($fechaNac);
 			$date=date('Y-m-d H:i:s');
 			if( mysql_query("UPDATE detalle_joven SET Nombre = '".trim(strtoupper($nombre))."', A_Paterno = '".trim(strtoupper($apa))."', A_Materno = '".trim(strtoupper($ama))."', CURP = '".trim(strtoupper($curp))."', RFC = '".trim(strtoupper($rfc))."', Genero =  '".$genero."', Fecha_Nac = '".$fechaNac."', Edad = '".$edad."', Calle_Num = '".trim(strtoupper($dom))."', Colonia = '".trim(strtoupper($col))."', Id_Municipio = '".$mun."', Id_Estado = '".$edo."', Id_Segmento = '".$segmento."', FechaM='".$date."', Escuela= '".$est."' WHERE Id_Joven = '".$joven."'") )
 			{
 				if( mysql_query('UPDATE datos_contacto SET Tel_Fijo = "'.$tel.'", Tel_Cel = "'.$telcel.'", E_mail = "'.$email.'"  WHERE Id_Persona = "'.$joven.'"'))
 				{
 					return true;
 				}
 				else
 				{
 					return false;
 				}
 			}

 		}
 	}
 	function busca_eventos_joven($joven)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query("SELECT No_control, Edad, Id_Eventos FROM asist_eventos WHERE Id_Joven = '".$joven."'");
 		}
 		$this->con->cerrar_conexion();
 		
 	}
 	function busca_resp_by_id($res)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query("SELECT Nombre, A_Paterno, A_Materno FROM cat_responsable WHERE Id_Responsable = '".$res."'");
 		}
 		$this->con->cerrar_conexion();
 	}
 	function busca_mun_by_id($mun)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query("SELECT Nombre FROM cat_municipio WHERE Id_Municipio = '".$mun."' ");
 		}
 		$this->con->cerrar_conexion();
 	}
 	function busca_evento_by_id($evento)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query("SELECT Nombre_Evento FROM cat_evento WHERE Id_Evento = '".$evento."' ");
 		}
 		$this->con->cerrar_conexion();

 	}
 	function eliminar_evento_joven($id)
 	{
 		if($this->con->conectar())
 		{
	 		return mysql_query("DELETE FROM asist_eventos WHERE Id_Eventos = '".$id."'");
	 	}
 		$this->con->cerrar_conexion();
 	}
 	function verficar_eventos_joven($id)
 	{
 		if($this->con->conectar())
 		{
	 		return mysql_query("SELECT COUNT(Id_Eventos) FROM asist_eventos WHERE Id_Joven = '".$id."'");
	 	}
 		$this->con->cerrar_conexion();
 	}

 	function verificar_res_jov($id)
 	{
 		if($this->con->conectar())
 		{
	 		return mysql_query("SELECT User FROM detalle_joven WHERE Id_Joven ='".$id."'");
	 	}
 		$this->con->cerrar_conexion();
 	}
 	function eliminar_joven($id)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('DELETE FROM detalle_joven WHERE Id_Joven = "'.$id.'"');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function eliminar_user($id)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('DELETE FROM usuarios WHERE Id_Usuario = "'.$id.'"');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function buscarEventoID($id)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT Nombre_Evento, Deshabilitada, Id_linea, Id_Estrategia, Id_programa, Tipo FROM cat_evento WHERE Id_Evento="'.$id.'"');
 		}
 		$this->con->cerrar_conexion();
 	}

 	function consulta_linea_by_id($id)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT Descripcion FROM cat_linea WHERE Id_linea="'.$id.'"');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_estrategia_by_id($id)
 	{

 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT Estrategia FROM cat_estrategia WHERE Id_Estrategia="'.$id.'"');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_programa_by_id($id)
 	{

 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT Programa FROM cat_programa WHERE Id_programa="'.$id.'"');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function consulta_tipo()
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('SELECT Tipo FROM cat_evento GROUP BY Tipo ORDER BY Tipo');
 		}
 		$this->con->cerrar_conexion();
 	}

 	function eliminar_edo($edo)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('DELETE FROM cat_estado WHERE Id_Estado = '.$edo.'');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function eliminar_mun($mun)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('DELETE FROM cat_municipio WHERE Id_Municipio = '.$mun.'');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function eliminar_evnt($evnt)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('DELETE FROM cat_evento WHERE Id_Evento = '.$evnt.'');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function eliminar_seg($seg)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('DELETE FROM cat_segmento WHERE Id_Segmento = '.$seg.'');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function eliminar_tal($tal)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('DELETE FROM cat_talentos WHERE Id_Talento = '.$tal.'');
 		}
 		$this->con->cerrar_conexion();
 	}
 	function eliminar_rol($rol)
 	{
 		if($this->con->conectar())
 		{
 			return mysql_query('DELETE FROM cat_rol WHERE Id_Rol = '.$rol.'');
 		}
 		$this->con->cerrar_conexion();
 	}

 }

 ?>