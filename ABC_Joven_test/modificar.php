<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Datos Joven</title>
	<meta charset="utf-8" /></div>
	<link rel="stylesheet" href="css/normalize.min.css">
	<link rel="stylesheet" href="css/style.css" />
    <link href="css/custom-theme/jquery-ui-1.10.2.custom.css" rel="stylesheet"/>
    <script src="js/prefixfree.min.js"></script>
	<script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
</head>
<body>
	
	<div id="page-datail" class="page-wrap-detail">
	<!-- <div id="noti"><p></p></div> -->
		<div class="page-wrap" >
            <h3> Datos Joven</h3>
                <div class="rowElem">
                   <div class="rowLabel"><label for="nom">Primer Nombre:</label></div>
                    <div class="rowInput"><input type="text" id="nom" /></div>
                </div>
                
                <div class="rowElem">
                    <div class="rowLabel"><label for="ap">Apellido Paterno:</label></div>
                    <div class="rowInput"><input type="text" id="ap" /></div>
                </div>
                
                <div class="rowElem">
                    <div class="rowLabel"><label for="am">Apellido Materno:</label></div>
                    <div class="rowInput"><input type="text" id="am"  /></div>
                </div>

                
                <div class="rowElem">
                    <div class="rowLabel"><label for="genero">Genero:</label></div>
                     <div class="rowInput">
                    
                        <input type="radio" name="genero" id="h" value="M" />M
                       	<input type="radio" name="genero" id="m" value="F" />F
                     </div>
                </div>

                <div class="rowElem">
                    <div class="rowLabel"><label for="seg">Segmento:</label></div>
                    <div class="rowInput"><select id="seg">
                    </select></div>
                </div>
                <div class="rowElem">
                    <div class="rowLabel"><label for="fecnac">Fehca de nacimiento:</label></div>
                    <div class="rowInput"><input type="text" name="datepicker4" id="datepicker4" readonly="readonly" size="10"  >
                    </div>
                </div>
               
                <div class="rowElem">
                    <div class="rowLabel"><label for="edo">Estado de origen:</label></div>
                    <div class="rowInput"><select id="edo"></select></div>
                </div>
                <div class="rowElem">
                    <div class="rowLabel"><label for="mun-edo">Municipio de origen / de Residencia:</label></div>
                    <div class="rowInput"><select id="mun-edo"></select></div>
                </div>
                <div class="rowElem">
                    <div class="rowLabel"><label for="cp">Codigo Postal:</label></div>
                    <div class="rowInput"><input type="text" id="cp" name="req-name"   /></div>
                </div>
            </div>
            <div class="page-wrap">
                <h3>Datos Contacto Joven</h3>

                    <div class="rowElem">
                        <div class="rowLabel"><label for="curp">CURP:</label></div>
                        <div class="rowInput"><input type="text" id="curp" /></div>
                    </div>
                    <div class="rowElem">
                        <div class="rowLabel"><label for="rfc">RFC:</label></div>
                        <div class="rowInput"><input type="text" id="rfc" ></div>
                    </div>
                     <div class="rowElem">
                        <div class="rowLabel"><label for="calle">Calle y numero:</label></div>
                        <div class="rowInput"><input type="text" id="calle" /></div>
                    </div>
                    
                    <div class="rowElem">
                        <div class="rowLabel"><label for="col">Colonia:</label></div>
                        <div class="rowInput"><input type="text" id="col" ></div>
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
                    <div class="rowElem">
                    <div id="noti"></div> 
                      <div class="rowInput">
                        <input type="submit" id="update-young" value="Actualizar Joven" /> </div>
                    </div> 

            </div>
	</div>

	<div id="noti2"></div>
	<div id="dialog-confirm">
	</div>
	<script src="js/functions-modifi.ajax.js"></script>
</body>
</html>