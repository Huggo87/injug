<?php

    /*session_start();
    
    function getRealIp() {
       if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
         $ip=$_SERVER['HTTP_CLIENT_IP'];
       } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
         $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
       } else {
         $ip=$_SERVER['REMOTE_ADDR'];
       }
       return $ip;
    }

    function writeLog($where) {
    
    	$ip = getRealIp(); // Get the IP from superglobal
    	$host = gethostbyaddr($ip);    // Try to locate the host of the attack
    	$date = date("d M Y");
    	
    	// create a logging message with php heredoc syntax
    	$logging = <<<LOG
    		\n
    		<< Start of Message >>
    		There was a hacking attempt on your form. \n 
    		Date of Attack: {$date}
    		IP-Adress: {$ip} \n
    		Host of Attacker: {$host}
    		Point of Attack: {$where}
    		<< End of Message >>
LOG;
// Awkward but LOG must be flush left
    
            // open log file
    		if($handle = fopen('hacklog.log', 'a')) {
    		
    			fputs($handle, $logging);  // write the Data to file
    			fclose($handle);           // close the file
    			
    		} else {  // if first method is not working, for example because of wrong file permissions, email the data
    		
    			$to = 'ADMIN@gmail.com';  
            	$subject = 'HACK ATTEMPT';
            	$header = 'From: ADMIN@gmail.com';
            	if (mail($to, $subject, $logging, $header)) {
            		echo "Sent notice to admin.";
            	}
    
    		}
    }

    function verifyFormToken($form) {
        
        // check if a session is started and a token is transmitted, if not return an error
    	if(!isset($_SESSION[$form.'_token'])) { 
    		return false;
        }
    	
    	// check if the form is sent with token in it
    	if(!isset($_POST['token'])) {
    		return false;
        }
    	
    	// compare the tokens against each other if they are still the same
    	if ($_SESSION[$form.'_token'] !== $_POST['token']) {
    		return false;
        }
    	
    	return true;
    }
    
    function generateFormToken($form) {
    
        // generate a token from an unique value, took from microtime, you can also use salt-values, other crypting methods...
    	$token = md5(uniqid(microtime(), true));  
    	
    	// Write the generated token to the session variable to check it against the hidden field when the form is sent
    	$_SESSION[$form.'_token'] = $token; 
    	
    	return $token;
    }
    
    // VERIFY LEGITIMACY OF TOKEN
    if (verifyFormToken('form1')) {
    
        // CHECK TO SEE IF THIS IS A MAIL POST
        if (isset($_POST['URL-main'])) {
        
            // Building a whitelist array with keys which will send through the form, no others would be accepted later on
            $whitelist = array('token','req-name','req-email','typeOfChange','urgency','URL-main','addURLS', 'curText', 'newText', 'save-stuff', 'mult');
            
            // Building an array with the $_POST-superglobal 
            foreach ($_POST as $key=>$item) {
                    
                    // Check if the value $key (fieldname from $_POST) can be found in the whitelisting array, if not, die with a short message to the hacker
            		if (!in_array($key, $whitelist)) {
            			
            			writeLog('Unknown form fields');
            			die("Hack-Attempt detected. Please use only the fields in the form");
            			
            		}
            }
            
            
            
            
            
            
            // Lets check the URL whether it's a real URL or not. if not, stop the script
            
            if(!filter_var($_POST['URL-main'],FILTER_VALIDATE_URL)) {
            			writeLog('URL Validation');
            		die('Hack-Attempt detected. Please insert a valid URL');
            }
    
    
    
    
    
            // SAVE INFO AS COOKIE, if user wants name and email saved
            
            $saveCheck = $_POST['save-stuff'];
            if ($saveCheck == 'on') {
                setcookie("WRCF-Name", $_POST['req-name'], time()+60*60*24*365);
                setcookie("WRCF-Email", $_POST['req-email'], time()+60*60*24*365);
            }
            
            
            
            
            // PREPARE THE BODY OF THE MESSAGE

			$message = '<html><body>';
			$message .= '<img src="http://css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" /></div>';
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['req-name']) . "</td></tr>";
			$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['req-email']) . "</td></tr>";
			$message .= "<tr><td><strong>Type of Change:</strong> </td><td>" . strip_tags($_POST['typeOfChange']) . "</td></tr>";
			$message .= "<tr><td><strong>Urgency:</strong> </td><td>" . strip_tags($_POST['urgency']) . "</td></tr>";
			$message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>" . $_POST['URL-main'] . "</td></tr>";
			$addURLS = $_POST['addURLS'];
			if (($addURLS) != '') {
			    $message .= "<tr><td><strong>URL To Change (additional):</strong> </td><td>" . strip_tags($addURLS) . "</td></tr>";
			}
			$curText = htmlentities($_POST['curText']);           
			if (($curText) != '') {
			    $message .= "<tr><td><strong>CURRENT Content:</strong> </td><td>" . $curText . "</td></tr>";
			}
			$message .= "<tr><td><strong>NEW Content:</strong> </td><td>" . htmlentities($_POST['newText']) . "</td></tr>";
			$message .= "</table>";
			$message .= "</body></html>";
			
			
			
			
			//  MAKE SURE THE "FROM" EMAIL ADDRESS DOESN'T HAVE ANY NASTY STUFF IN IT
			
			$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i"; 
            if (preg_match($pattern, trim(strip_tags($_POST['req-email'])))) { 
                $cleanedFrom = trim(strip_tags($_POST['req-email'])); 
            } else { 
                return "The email address you entered was invalid. Please try again!"; 
            } 
			
			
            
            
            //   CHANGE THE BELOW VARIABLES TO YOUR NEEDS
             
			$to = 'JUNKKKKK@gmail.com';
			
			$subject = 'Website Change Reqest';
			
			$headers = "From: " . $cleanedFrom . "\r\n";
			$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            if (mail($to, $subject, $message, $headers)) {
              echo 'Your message has been sent.';
            } else {
              echo 'There was a problem sending the email.';
            }
            
            // DON'T BOTHER CONTINUING TO THE HTML...
            die();
        
        }
    } else {
    
   		if (!isset($_SESSION[$form.'_token'])) {
   		
   		} else {
   			echo "Hack-Attempt detected. Got ya!.";
   			writeLog('Formtoken');
   	    }
   
   	}*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" /></div>
    <title>Captura Jovenes</title>
	<link rel="stylesheet" href="css/normalize.min.css">
	<link rel="stylesheet" href="css/style.css" />
    <link href="css/custom-theme/jquery-ui-1.10.2.custom.css" rel="stylesheet"/>
    <script src="js/prefixfree.min.js"></script>
	<script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
</head>
<?php// generate a new token for the $_SESSION superglobal and put them in a hidden field//$newToken = generateFormToken('form1');   ?>
<body>
    <div id="header">
        <div id="logo">
            <img src="../img/gto-logo.png" alt="ABC Jovenes" >
        </div>
        <div id="titulo_nav">
            <div id="nav">
                <ul id="menu"></ul>
            </div>
        </div>
        <div id="user-perfil">
            
        </div>
    </div>
    <section>
        <div id="page">
            <div id="altas-page" class="page-wrap-evn">
                <div class="wrap-evento">
                    <h2>Registro Evento</h2>
                    <div  class="rowElem">
                        <div class="rowLabel"><label for="evnt">Nombre del Programa/ Evento*: </label></div>
                        <div class="rowInput">
                            <select id="evnt"><option value="0">[ Selecciona Evento ]</option></select></div>
                    </div>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="res">Ejecutor/ Responsable*:</label></div>
                        <div class="rowInput"><select id="res"></select></div>
                    </div>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="place">Lugar donde se realiza el evento :</label></div>
                        <div class="rowInput"><input type="text" id="place" value="" size="50"/></div>
                    </div>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="mun">Municipio donde se realizo el evento*: </label></div>
                        <div class="rowInput"><select id="mun"><option value="0">[ Selecciona Municipio ]</option></select></div>
                    </div>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="sector">Sector*: </label></div>
                        <div class="rowInput">
                            <input type="radio" name="sector" value="URBANO" id="urb">Urbano
                            <input type="radio" name="sector" value="RURAL" id="rur">Rural
                        </div>
                    </div>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="datepicker">Fecha del Evento*:</label></div>
                        <div class="rowInput"><input type="text" id="datepicker" readonly="readonly" /></div>
                    </div>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="hour">Hora del Evento*: </label></div>
                        <div class="rowInput"><select id="hour" onChange="">
                            <option value="0">[Selecciona Hora]</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option>
                            <option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option>
                            <option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option><option>24:00</option></select>
                        </div>
                    </div>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="obs">Observaciones</label></div>
                        <div class="rowInput">
                            <textarea cols="5" rows="3" name="obs" id="obs"></textarea>
                        </div>
                    </div>
                </div>
                <div class="nota">
                    <h2>Recuerda la captura se realiza sin acentos (á, é, í, ó, ú) y cambia Ñ, ñ por N, n.</h2>
                </div>
                <div id="noti-red"><p></p></div>
                <div id="noti-blue"><p></p></div>
                <div id="noti-green"><p></p></div>
                <div class="page-wrap clear-jov">
                    <h3>Registro Joven</h3>
                        <div class="rowElem">
                           <div class="rowLabel"><label for="nom">Primer Nombre*:</label></div>
                            <div class="rowInput"><input type="text" id="nom"  /></div>
                        </div>
                        
                        <div class="rowElem">
                            <div class="rowLabel"><label for="ap">Apellido Paterno*:</label></div>
                            <div class="rowInput"><input type="text" id="ap"  /></div>
                        </div>
                        
                        <div class="rowElem">
                            <div class="rowLabel"><label for="am">Apellido Materno*:</label></div>
                            <div class="rowInput"><input type="text" id="am"   /></div>
                        </div>

                        
                        <div class="rowElem">
                            <div class="rowLabel"><label for="genero">Genero:</label></div>
                            <div class="rowInput">
                                <input type="radio" name="genero" id="m" value="F" />F
                                <input type="radio" name="genero" id="h" value="M" />M
                            </div>
                        </div>

                        <div class="rowElem">
                            <div class="rowLabel"><label for="seg">Segmento:</label></div>
                            <div class="rowInput">
                                <select id="seg">
                                </select>
                        </div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="fecnac">Fehca de nacimiento*:</label></div>
                            <div class="rowInput"><input type="text" name="datepicker1" id="datepicker1" readonly="readonly" size="10" /></div>
                        </div>
                       
                        <div class="rowElem">
                            <div class="rowLabel"><label for="edo">Estado de origen*:</label></div>
                            <div class="rowInput">
                                <select id="edo">
                            </select></div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="mun-edo">Municipio de origen / de Residencia*:</label></div>
                            <div class="rowInput"><select id="mun-edo"></select>
                            </div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="cp">Codigo Postal:</label></div>
                            <div class="rowInput"><input type="text" id="cp" name="req-name"   /></div>
                        </div>
                </div>
                <div class="page-wrap clear-jov">
                    <h3>Registro Datos Contacto</h3>

                        <div class="rowElem">
                            <div class="rowLabel"><label for="curp">CURP:</label></div>
                            <div class="rowInput"><input type="text" id="curp"    /></div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="rfc">RFC:</label></div>
                            <div class="rowInput"><input type="text" id="rfc" /></div>
                        </div>
                         <div class="rowElem">
                            <div class="rowLabel"><label for="calle">Calle y numero:</label></div>
                            <div class="rowInput"><input type="text" id="calle"  /></div>
                        </div>
                        
                        <div class="rowElem">
                            <div class="rowLabel"><label for="col">Colonia:</label></div>
                            <div class="rowInput"><input type="text" id="col" /></div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="tel">Telefono Fijo:</label></div>
                            <div class="rowInput"><input type="text" id="tel" /></div>
                        </div>
                        
                        <div class="rowElem">
                            <div class="rowLabel"><label for="tel-cel">Telefono Celular:</label></div>
                            <div class="rowInput"><input type="text" id="tel-cel" /></div>
                        </div>

                        <div class="rowElem">
                            <div class="rowLabel"><label for="email">Email:</label></div>
                            <div class="rowInput"><input type="email" id="email" /></div>
                        </div>

                        <div class="rowElem">
                            <div class="rowLabel"><label for="">El joven estudia actualmete:</label></div>
                            <div class="rowInput">
                                <input type="radio" name="est" id="si" value="1" />Si
                                <input type="radio" name="est" id="no" value="0" />No
                            </div>
                        </div>
                        <div class="rowElem">
                          <div class="rowInput">
                            <input type="submit" id="save" value="Guardar Joven" /></div>
                        </div>             
                    <!--<input type="date" name="bday">-->
                </div>
            </div>
            <div id="busquedas-page" class="page-wrap-evn">
                <div id="seach">
                    <div class="page-wrap busqueda-jov">
                        <h3>Buscar por Nombre</h3>
                        <div class="rowElem">
                               <div class="rowLabel"><label for="search-name">Primer Nombre:</label></div>
                                <div class="rowInput"><input type="text" id="search-name"  required  /></div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="search-ap">Apellido Paterno:</label></div>
                            <div class="rowInput"><input type="text" id="search-ap"  /></div>
                        </div>
                        
                        <div class="rowElem">
                            <div class="rowLabel"><label for="search-am">Apellido Materno:</label></div>
                            <div class="rowInput"><input type="text" id="search-am"   /></div>
                        </div>
                         <div class="rowElem">
                            <div class="rowInput">
                                <input type="submit" id="sea-jov" value="Buscar" /></div>
                        </div> 
                         <div class="rowElem">
                            <div class="rowInput">
                            <input type="reset" id="reset-jov" value="Limpiar" /></div>
                         </div> 
                    </div>
                    <div class="page-wrap busqueda-evento">
                        <h3>Buscar por Evento</h3>
                        <div  class="rowElem">
                            <div class="rowLabel"><label for="evnt-bus">Nombre del Programa/ Evento: </label></div>
                            <div class="rowInput">
                                <select id="evnt-bus"><option value="0">[ Selecciona Evento ]</option></select></div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="res-bus">Ejecutor/ Responsable:</label></div>
                            <div class="rowInput"><select id="res-bus"></select></div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="mun-bus">Municipio donde se realizo el evento: </label></div>
                            <div class="rowInput"><select id="mun-bus"><option value="0">[ Selecciona Municipio ]</option></select></div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="datepicker3">Fecha del Evento:</label></div>
                            <div class="rowInput"><input type="text"  id="datepicker3" readonly="readonly" /></div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="hour-bus">Hora del Evento: </label></div>
                            <div class="rowInput"><select id="hour-bus" onChange="">
                                <option value="0">[Selecciona Hora]</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option>
                                <option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option>
                                <option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option><option>24:00</option></select>
                            </div>
                        </div>
                         <div class="rowElem">
                              <div class="rowInput">
                                <input type="submit" class="save" id="sea-eve" value="Buscar" /></div>
                        </div> 
                         <div class="rowElem">
                            <div class="rowInput">
                            <input type="reset" id="reset-event" value="Limpiar" /></div>
                         </div> 
                    </div>
                    <div class="class-wrapp"> 
                        <div id="noti-red-find"><p></p></div>
                        <div id="noti-blue-find"><p></p></div>
                        <div id="noti-green-find"><p></p></div>
                        <div id="dialog-confirm-delete-young" ></div>
                    </div>
                   
                    <div id="find" class="page-wrap-search">
                    </div>
                </div>
            </div>
            <div id="usuarios-page" class="page-wrap-evn">
                <div id="users">
                    <div id="dialog-confirm-delete-user"></div>
                    <div id="noti-del-user"></div>
                    <div class="page-wrap">
                        <h3>Usuarios</h3>
                        <div id="user-find" class=" page-wrap-search">
                          
                        </div>
                    </div>
                    <div class="page-wrap clear-user">
                        <div>
                            <h3>Nuevo usuario</h3>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-resp-input">Responsable:</label></div>
                                <div class="rowInput"><select id="usr-resp-input" ><select><option value="0">[ Selecciona Responsable ]</option></select> </div></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-nomuser-input">Nombre de usuario*:</label></div>
                                <div class="rowInput"><input type="text" id="usr-nomuser-input"  /></div></div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-pass-input">Contraseña*:</label></div>
                                <div class="rowInput"><input type="text" id="usr-pass-input"  /></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-rol-input">Rol*:</label></div>
                                <div class="rowInput"><select id="usr-rol-input" ></select></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-nombre-input">Nombre*:</label></div>
                                <div class="rowInput"><input type="text" id="usr-nombre-input"  /></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-apa-input">A. Paterno*:</label></div>
                                <div class="rowInput"><input type="text" id="usr-apa-input"  /></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-ama-input">A. Materno:</label></div>
                                <div class="rowInput"><input type="text" id="usr-ama-input"  /></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-gen-input">Genero:</label></div>
                                <div class="rowInput">
                                <input type="radio" name="usr-gen-input" id="m" value="F" />F
                                <input type="radio" name="usr-gen-input" id="h" value="M" />M</div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="datepicker2">Fecha Nacimiento:</label></div>
                                <div class="rowInput"><input type="text" id="datepicker2"  readonly="readonly"/></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-dom-input">Calle y numero</label></div>
                                <div class="rowInput"><input type="text" id="usr-dom-input"  /></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-col-input">Colonia:</label></div>
                                <div class="rowInput"><input type="text" id="usr-col-input"  /></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-edo-input">Estado*:</label></div>
                                <div class="rowInput"><select id="usr-edo-input"></select></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-mun-input">Municipio*:</label></div>
                                <div class="rowInput"><select id="usr-mun-input"> </select></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-cp-input">C.P:</label></div>
                                <div class="rowInput"><input type="text" id="usr-cp-input"  /></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-tel-input">Telefono Fijo:</label></div>
                                <div class="rowInput"><input type="text" id="usr-tel-input"  /></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-telcel-input">Telefono Celular:</label></div>
                                <div class="rowInput"><input type="text" id="usr-telcel-input"  /></div>
                            </div>
                            <div class="rowElem">
                                <div class="rowLabel"><label for="usr-email-input">Email*:</label></div>
                                <div class="rowInput"><input type="text" id="usr-email-input" /></div>
                            </div>
                            <div class="rowElem">
                            <div class="rowInput"><input type="submit" class="boton-form" id="save-user" value="Guardar" /></div></div>
                        </div> 
                </div>
            </div>
            
            <div id="catalogos-page" class="page-wrap-evn">
                <div id="cat-nav" class="nav">
                    <ul id="cat-menu">
                        <li><a href="#" id="catmenu-edo">Estados</a></li>
                        <li><a href="#" id="catmenu-mun">Municipios</a></li>
                        <li><a href="#" id="catmenu-evento">Eventos</a></li>
                        <li><a href="#" id="catmenu-seg">Segmentos</a></li>
                        <li><a href="#" id="catmenu-tal">Talentos</a></li>
                        <li><a href="#" id="catmenu-rol">Roles</a></li>
                    </ul>
                </div>
                <div id="cat-edo">
                    <div class="page-wrap">
                        <h3>Estados</h3>
                        <div id="cat-find-edo" class=" page-wrap-search">
                            
                        </div>
                    </div>
                    <div class="page-wrap"><h3>Nuevo Estado</h3>
                        <div id="noti-edo-cat"></div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="cat-edo-input">Estado:</label></div>
                            <div class="rowInput"><input type="text" id="cat-edo-input"  /></div>
                        </div>
                        <div class="rowElem"><div class="rowInput">
                            <input type="submit" class="boton-form" id="save-edo" value="Guardar" /></div></div>
                    </div>
                </div>
                <div id="cat-mun">
                    <div class="page-wrap">
                         <h3>Municipios</h3>
                        <div id="cat-find-mun" class=" page-wrap-search">
                           
                        </div>
                    </div>
                    
                    <div class="page-wrap"> <h3>Nuevo Municipio</h3>
                         <div id="noti-mun-cat"></div>
                        <div class="rowElem">
                           
                            <div class="rowLabel"><label for="cat-edomun-input">Estado:</label></div>
                            <div class="rowInput"><select id="cat-edomun-input"></select></div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="cat-mun-input">Municipio:</label></div>
                            <div class="rowInput"><input type="text" id="cat-mun-input"  /></div>
                        </div>
                         <div class="rowElem">
                            <div class="rowInput"><input type="submit" class="boton-form" id="save-cat-mun" value="Guardar" /></div>
                        </div>
                    </div>
                </div>
                <div id="cat-evt">
                    <div class="page-wrap">
                         <h3>Eventos</h3>
                        <div id="cat-find-evt" class=" page-wrap-search">
                           
                        </div>
                    </div>
                    <div class="page-wrap clear-evento">
                        <h3>Nuevo Evento</h3>
                         <div id="noti-evnt-cat"></div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="cat-evento-input">Evento:</label></div>
                            <div class="rowInput"><input type="text" id="cat-evento-input"  /></div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="even-linea">Linea:</label></div>
                            <div class="rowInput"><select name="even-linea" id="even-linea"></select> </div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="even-estr">Estrategia:</label></div>
                            <div class="rowInput"><select name="even-estr" id="even-estr"></select> </div> 
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="even-prog">Programa:</label></div>
                            <div class="rowInput"><select name="even-prog" id="even-prog"></select> </div>
                        </div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="evento-tipo">Tipo:</label></div>
                            <div class="rowInput"><input type="text" id="evento-tipo" maxlength="1" /></div>
                        </div>    
                        <div class="rowElem">
                            <div class="rowInput"><input type="submit" class="boton-form" id="save-evento" value="Guardar" /></div>
                        </div>
                       
                    </div> 
                </div>
                <div id="cat-seg">
                    <div class="page-wrap">
                         <h3>Segmentos</h3>
                        <div id="cat-find-seg" class="page-wrap-search">
                           
                        </div>
                    </div>
                    <div class="page-wrap">
                        <h3>Nuevo Segmento</h3>
                         <div id="noti-seg-cat"></div>
                        <div class="rowElem">
                            <div class="rowLabel"><label for="cat-seg-input">Segmento:</label></div>
                            <div class="rowInput"><input type="text" id="cat-seg-input"  /></div>
                        </div>
                        <div class="rowElem">
                            <div class="rowInput"><input type="submit" class="boton-form" id="save-seg" value="Guardar" /></div>
                        </div>
                    </div> 
                </div>
                <div id="cat-tal">
                    <div class="page-wrap">
                         <h3>Talentos</h3>
                        <div id="cat-find-tal" class=" page-wrap-search">
                           
                        </div>
                    </div>
                    <div class="page-wrap">
                        <h3>Nuevo Talento</h3>
                         <div id="noti-tal-cat"></div>
                        <div class="rowElem">
                        <div class="rowLabel"><label for="cat-tal-input">Talento:</label></div>
                        <div class="rowInput"><input type="text" id="cat-tal-input"  /></div></div>
                        <div class="rowElem">
                        <div class="rowInput"><input type="submit" class="boton-form" id="save-tal" value="Guardar" /></div></div>
                    </div>    
                </div>
                <div id="cat-rol">
                    <div class="page-wrap">
                         <h3>Roles</h3>
                        <div id="cat-find-rol" class=" page-wrap-search">
                          
                        </div>
                    </div>
                    <div class="page-wrap">
                        <h3>Nuevo Rol</h3>
                         <div id="noti-rol-cat"></div>
                        <div class="rowElem">
                        <div class="rowLabel"><label for="cat-rol-input">Rol:</label></div>
                        <div class="rowInput"><input type="text" id="cat-rol-input"  /></div></div>
                        <div class="rowElem">
                        <div class="rowInput"><input type="submit" class="boton-form" id="save-rol" value="Guardar" /></div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/functions.ajax.js"></script>
</body>
</html>