<?php
    class Vista extends Controllers{
        function inicio(){
           
            require VW . DF . "head.html";
            $this->view->render($this, "inicio");
            
        }
        function  Preserva(){
            require VW . DF . "headPR.html";
            $this->view->render($this, "preserva");
            $cedula = $_SESSION['cedula'];
            $hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database);   
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
                }else{
                //print("entro");
                
             } 
			$query="SELECT * FROM reserva where cedulaU='".$cedula."'";  
            $consulta = mysqli_query($conexion,$query);

			echo "<div class='container'>";

            while($arry3= mysqli_fetch_array($consulta)){
               
                $query="SELECT * FROM vuelos where id='".$arry3['idVuelo']."'"; 
                $consulta10 = mysqli_query($conexion,$query);
            while($arry = mysqli_fetch_array($consulta10)){
						echo "<div class='card'>";
                        echo "<img src='http://127.0.0.1:9000/Resources/img/reserva1.jpg'>";
                        echo "<div class='conten'>";
                        echo "<div class='id'>";
                        echo "<h4>Id de la Reserva: </h4>";
                        echo "<h4 id='idR' name='idR'>".$arry3['id']."</h4>";
                        echo "</div>";
                        echo "<div class='id'>";
                        echo "<h6>Vuelo Id: </h4>";
                        echo "<h6 id='idV' name='idV'>".$arry['id']."</h4>";
                        echo "</div>";
                        echo "<h6>Fecha: ".$arry['fecha']."</h6>";
                        $cod=$arry['CodAO'];
                        $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                        $arry2=mysqli_fetch_array($consulta2);
                        echo "<h6>Ciudad de Origen: ".$arry2['ciudad']."</h6>";
                        $cod=$arry['CodAD'];
                        $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                        $arry2=mysqli_fetch_array($consulta2);
                        echo "<h6>Ciudad de Destino: ".$arry2['ciudad']."</h6>";
                        if($arry3['idEquipaje']!=""){
                            $query="SELECT tipo_maleta FROM equipaje where id ='".$arry3['idEquipaje']."'";
                            $consulta3 = mysqli_query($conexion,$query);
                            $arry4=mysqli_fetch_array($consulta3);
                            echo "<h6>Tipo de Equipaje: ".$arry4['tipo_maleta']."</h6>";
                        }else{
                            echo "<h6>No tiene Equipaje</h6>";
                        }
                        
                        if($arry3['Estado_reserva']=="no pago"){
                            echo "<h6>Estado de la Reserva:</h6>";

                            echo "<div class='npagado'>";
                            
                            echo "<h2>No Pagado</h2>";
                            
                            echo "</div>";
                            
                            
                        }else{
                            echo "<h6>Estado de la Reserva:</h6>";
                            echo "<div class='pagado'>";
                            echo "<h2>Pagado </h2>";
                            echo "</div>";
                        }
                        echo "</div>";
                        echo "</div>";			                
            }
				
        }
        echo "</div>";





        }

        function pasajero(){
            require VW . DF . "headP.html";
            $this->view->render($this, "pasajero");
 $hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database);   
            $paginacion=1;
            if(empty($_POST['pagina'])){
                $paginacion=1;
            }else{
                $paginacion=(int) $_POST['pagina'];
            }
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
                }else{
                //print("entro");
                
             } 
			$query="SELECT * FROM vuelos";  
            $consulta2 = mysqli_query($conexion,$query);
            

					echo "<div class='container'>";
  
             $contador=0;
             $pagina=1;
             while($arry2 = mysqli_fetch_array($consulta2)){
                $contador=$contador+1;
                if($contador==6){
                    $pagina=$pagina+1;
                    $contador=0;
                }		                
    }
    $contador=0;

    $total1=(int)($paginacion*6)-6;
    
    $query="SELECT * FROM vuelos";  
    $consulta = mysqli_query($conexion,$query);
            $posision=(int)$total1+6-1;
            $contador=(int)0;
            
            while($arry = mysqli_fetch_array($consulta)){
                
                if(($contador >= $total1) && $contador<=$posision ){
                    
                    echo "<div class='card'>";
                echo "<img src='http://127.0.0.1:9000/Resources/img/vuelos1.jpg'>";
                echo "<div class='conten'>";
                echo "<div class='id'>";
                echo "<h4>Vuelo Id: </h4>";
                echo "<h4 id='idV' name='idV'>".$arry['id']."</h4>";
                echo "</div>";
                echo "<h6>Fecha: ".$arry['fecha']."</h6>";
                $cod=$arry['CodAO'];
                $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                $arry2=mysqli_fetch_array($consulta2);
                echo "<h6>Ciudad de Origen: ".$arry2['ciudad']."</h6>";
                $cod=$arry['CodAD'];
                $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                $arry2=mysqli_fetch_array($consulta2);
                echo "<h6>Ciudad de Destino: ".$arry2['ciudad']."</h6>";
                $espacios=50;
                $diferencia=(int) $arry['puestos'];
                $total=$espacios-$diferencia;
                echo "<h6>Puestos Disponibles: ".$total."</h6>";
                echo "</div>";
                echo "</div>";	
                }
                
                $contador=$contador+1;
                          
    }
            


				echo "</div>";
                echo "<div class='contenerdorr'>";
                echo "<form action='pasajero' method='POST' class='paginacion'>";
                echo "<ul>";
                $i=0;
                while($i<$pagina){
                    echo"<li><input type='submit' id='pagina' name='pagina' class='active' value='".($i+1)."'></input></li>";
                    $i=$i+1;
                }
               
                
                echo"</ul>";
                echo" </form>";


                echo "</div>";
            
                




        }
        function recepcionista(){

            require VW . DF . "headR.html";
            
            $this->view->render($this, "recepcionista");
                    
        }
        function pagar(){
            $idR = $_POST['id'];
            $cuenta = $_POST['cuenta'];
            $banco = $_POST['banco'];
            $mpago = $_POST['fpago'];
            $hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database);   
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
                }else{
             } 
			$query="SELECT id FROM pago order by id desc limit 1";
			$consulta = mysqli_query($conexion,$query);
            $arry=mysqli_fetch_array($consulta);
            $idpago=(int) $arry['id'];
            $idpago=$idpago+1;
            $monto=700000;
            $query="INSERT INTO  pago(id,formadepago,cuenta,bancoApagar,monto) values('".$idpago."','".$mpago."','".$cuenta."','".$banco."','".$monto."')";
            
            $consulta2 = mysqli_query($conexion,$query) or die ("Error2");

            $query="update reserva set Estado_reserva = 'pago',idPago='".$idpago."' where id='".$idR."'";
            $consulta3 = mysqli_query($conexion,$query) or die ("Error");


            echo 1;








        }
        function registrarReserva(){
			$hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database);   
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
                }else{
                //print("entro");
                
             } 
			$query="SELECT id FROM equipaje order by id desc limit 1";
			$consulta = mysqli_query($conexion,$query);
            $arry=mysqli_fetch_array($consulta);

            $idEquipaje=(int) $arry['id'];


            $idV = $_POST['idV'];
            $cedula = $_POST['cedula'];
            $equipaje = $_POST['Equipaje'];
            //update vuelos set puestos = where id=
            if($equipaje!=""){
                $idEquipaje=$idEquipaje+1;
                $query="INSERT INTO  equipaje(id,tipo_maleta) values('".$idEquipaje."','".$equipaje."')";
                $consulta2 = mysqli_query($conexion,$query) or die (mysqli_error());
                
                $query="INSERT INTO  reserva(cedulaU,idEquipaje,idVuelo) values('".$cedula."','".$idEquipaje."','".$idV."')";
                $consulta3 = mysqli_query($conexion,$query) or die (mysqli_error());
                $query="SELECT puestos FROM vuelos where id ='".$idV."'";
                $consulta4 =mysqli_query($conexion,$query);
                $arry=mysqli_fetch_array($consulta4);
                $puestos=(int)$arry['puestos'];
                $puestos=$puestos+1;
                $query="update vuelos set puestos = '".$puestos."' where id='".$idV."'";
                $consulta5=mysqli_query($conexion,$query);

            }else{
                $query="INSERT INTO reserva(cedulaU,idVuelo) values('".$cedula."','".$idV."')";
                $consulta3 = mysqli_query($conexion,$query) or die (mysqli_error());
				$query="SELECT puestos FROM vuelos where id ='".$idV."'";
                $consulta4 =mysqli_query($conexion,$query);
                $arry=mysqli_fetch_array($consulta4);
                $puestos=(int)$arry['puestos'];
                $puestos=$puestos+1;
                $query="update vuelos set puestos = '".$puestos."' where id='".$idV."'";
                $consulta5=mysqli_query($conexion,$query);
			
            }
            echo 1;
            
        }

        function EReserva(){
            $id = $_POST['id'];
			$hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database);   
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
                }else{
                //print("entro");
                
             } 
            $query="SELECT * FROM reserva where id='".$id."'"; 
            $consulta2 = mysqli_query($conexion,$query);
            $arry3= mysqli_fetch_array($consulta2);
            $idE=(int)$arry3['idEquipaje'];
            $query="SELECT * FROM vuelos where id='".$arry3['idVuelo']."'"; 
            $consulta10 = mysqli_query($conexion,$query);
            $arry = mysqli_fetch_array($consulta10);
            $puestos=(int)$arry['puestos'];
            $puestos=$puestos-1;
            $query="update vuelos set puestos = '".$puestos."' where id='".$arry3['idVuelo']."'";
            $consulta5=mysqli_query($conexion,$query);
			$query="DELETE FROM reserva where id='".$id."'";  
            $consulta = mysqli_query($conexion,$query);
            $consultaE="delete from equipaje where id = '".$idE."'";
            mysqli_query($conexion,$consultaE) or die ("Error en Consulta");
            echo 1;
        }
        function Rbalance(){
            $hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database);   
            
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
                }else{
                //print("entro");
                
             } 
            require VW . DF . "headRB.html";
            $this->view->render($this, "balance");

					echo "<div class='container'>";
  
             
   
    
    $query="SELECT vuelos.id,fecha,CodAO,CodAD,puestos,reserva.id as idR FROM vuelos inner join reserva on vuelos.id=reserva.idVuelo where Estado_reserva='pago' order by vuelos.id";  
    $consulta = mysqli_query($conexion,$query);
            
    $idVuelos="";
            
            while($arry = mysqli_fetch_array($consulta)){


                if($idVuelos!=$arry['id']){
                    $idVuelos=$arry['id'];
                    
                echo "<div class='card'>";
                echo "<img src='http://127.0.0.1:9000/Resources/img/vuelos1.jpg'>";
                echo "<div class='conten'>";
                echo "<div class='id'>";
                echo "<h4>Vuelo Id: </h4>";
                echo "<h4 id='idV' name='idV'>".$arry['id']."</h4>";
                echo "</div>";
                echo "<h6>Fecha: ".$arry['fecha']."</h6>";
                $cod=$arry['CodAO'];
                $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                $arry2=mysqli_fetch_array($consulta2);
                echo "<h6>Ciudad de Origen: ".$arry2['ciudad']."</h6>";
                $cod=$arry['CodAD'];
                $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                $arry2=mysqli_fetch_array($consulta2);
                echo "<h6>Ciudad de Destino: ".$arry2['ciudad']."</h6>";
                $consultaP=mysqli_query($conexion,"SELECT COUNT(vuelos.id) as PPagados FROM vuelos inner join reserva on vuelos.id=reserva.idVuelo where Estado_reserva='pago' and vuelos.id='".$arry['id']."'");
                $arryP=mysqli_fetch_array($consultaP);

                echo "<h6>Puestos Pagados: ".$arryP['PPagados']."</h6>";
                echo"<input type='checkbox' id='btn-modal'>";
                echo "<label for='btn-modal' class='lbl-modal' onclick='Ppagos(".$arryP['PPagados'].")'>Hacer el Balance Financiero</label>";
                echo "</div>";
                echo "</div>";	
                }
              
             }
            


		echo "</div>";
                
                

					    
        }

            
            
        function Rpagos(){
            require VW . DF . "headRP.html";
            $this->view->render($this, "pagos");
            $hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database); 
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
            }else{
                //print("entro");
            } 
            $query="SELECT pago.id as idPago,formadepago,cuenta,bancoApagar,monto,reserva.id,cedulaU,idVuelo  FROM pago inner join reserva on pago.id=reserva.idPago"; 
            $consulta = mysqli_query($conexion,$query);
            echo "<div class='container'>";

            while($arry3= mysqli_fetch_array($consulta)){
               
                $query="SELECT * FROM vuelos where id='".$arry3['idVuelo']."'"; 
                $consulta10 = mysqli_query($conexion,$query);
            while($arry = mysqli_fetch_array($consulta10)){
						echo "<div class='card'>";
                        echo "<img src='http://127.0.0.1:9000/Resources/img/pago.jpg'>";
                        echo "<div class='conten'>";
                        
                        echo "<div class='id'>";
                        echo "<h4>Id de Pago: </h4>";
                        echo "<h4 id='idR' name='idR'>".$arry3['idPago']."</h4>";
                        echo "</div>";
                        echo "<h6>Metodo de Pago: ".$arry3['formadepago']."</h6>";
                        echo "<h6>Cuenta: ".$arry3['cuenta']."</h6>";
                        echo "<h6>Banco: ".$arry3['bancoApagar']."</h6>";
                        echo "<h6>Monto: ".$arry3['monto']."</h6>";
                        echo "<h6>Id de la Reserva: ".$arry3['id']."</h6>";
                        echo "<div class='id'>";
                        echo "<h6>Vuelo Id: </h4>";
                        echo "<h6 id='idV' name='idV'>".$arry['id']."</h4>";
                        echo "</div>";
                        echo "<h6>Fecha: ".$arry['fecha']."</h6>";
                        $cod=$arry['CodAO'];
                        $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                        $arry2=mysqli_fetch_array($consulta2);
                        echo "<h6>Ciudad de Origen: ".$arry2['ciudad']."</h6>";
                        $cod=$arry['CodAD'];
                        $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                        $arry2=mysqli_fetch_array($consulta2);
                        echo "<h6>Ciudad de Destino: ".$arry2['ciudad']."</h6>";
                        
                        echo "</div>";
                        echo "</div>";			                
            }
				
        }
        echo "</div>";


            




        }

        function reservasM(){
            require VW . DF . "headRV.html";
            $this->view->render($this, "reservasR");
            $cedula = $_POST['Cedula'];
            $hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database);   
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
                }else{
                //print("entro");
                
             } 
			$query="SELECT * FROM reserva where cedulaU='".$cedula."'";  
            $consulta = mysqli_query($conexion,$query);

			echo "<div class='container'>";

            while($arry3= mysqli_fetch_array($consulta)){
               
                $query="SELECT * FROM vuelos where id='".$arry3['idVuelo']."'"; 
                $consulta10 = mysqli_query($conexion,$query);
            while($arry = mysqli_fetch_array($consulta10)){
						echo "<div class='card'>";
                        echo "<img src='http://127.0.0.1:9000/Resources/img/reserva1.jpg'>";
                        echo "<div class='conten'>";
                        echo "<div class='id'>";
                        echo "<h4>Id de la Reserva: </h4>";
                        echo "<h4 id='idR' name='idR'>".$arry3['id']."</h4>";
                        echo "</div>";
                        echo "<div class='id'>";
                        echo "<h6>Vuelo Id: </h4>";
                        echo "<h6 id='idV' name='idV'>".$arry['id']."</h4>";
                        echo "</div>";
                        echo "<h6>Fecha: ".$arry['fecha']."</h6>";
                        $cod=$arry['CodAO'];
                        $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                        $arry2=mysqli_fetch_array($consulta2);
                        echo "<h6>Ciudad de Origen: ".$arry2['ciudad']."</h6>";
                        $cod=$arry['CodAD'];
                        $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                        $arry2=mysqli_fetch_array($consulta2);
                        echo "<h6>Ciudad de Destino: ".$arry2['ciudad']."</h6>";
                        if($arry3['idEquipaje']!=""){
                            $query="SELECT tipo_maleta FROM equipaje where id ='".$arry3['idEquipaje']."'";
                            $consulta3 = mysqli_query($conexion,$query);
                            $arry4=mysqli_fetch_array($consulta3);
                            echo "<h6>Tipo de Equipaje: ".$arry4['tipo_maleta']."</h6>";
                        }else{
                            echo "<h6>No tiene Equipaje</h6>";
                        }
                        
                        if($arry3['Estado_reserva']=="no pago"){
                        echo "<h6>Estado de la Reserva: ".$arry3['Estado_reserva']."</h6>";
                        echo "<div class='inpu'>";
                        echo"<input type='checkbox' id='btn-modal'>";
                        echo "<label for='btn-modal' class='btn btn-outline-primary btt' onclick='pagar(".$arry3['id'].")'>Pagar</label>";
                        echo "<label onclick='eliminarR(".$arry3['id'].")'class='btn btn-outline-primary btt1'>Eliminar</label>";
                        echo "</div>";
                        }else{
                            echo "<h6>Estado de la Reserva:</h6>";
                            echo "<div class='pagado'>";
                            echo "<h2>Pagado </h2>";
                            echo "</div>";
                        }
                        echo "</div>";
                        echo "</div>";			                
            }
				
        }
        echo "</div>";





        }

        function reservasR(){
			require VW . DF . "headRV.html";
			$this->view->render($this, "reservasR");
        }
        function Vrecepcionista(){
            $hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database);   
            $paginacion=1;
            if(empty($_POST['pagina'])){
                $paginacion=1;
            }else{
                $paginacion=(int) $_POST['pagina'];
            }
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
                }else{
                //print("entro");
                
             } 
			$query="SELECT * FROM vuelos";  
            $consulta2 = mysqli_query($conexion,$query);
            require VW . DF . "headVR.html";
            $this->view->render($this, "recepcionista");

					echo "<div class='container'>";
  
             $contador=0;
             $pagina=1;
             while($arry2 = mysqli_fetch_array($consulta2)){
                $contador=$contador+1;
                if($contador==6){
                    $pagina=$pagina+1;
                    $contador=0;
                }		                
    }
    $contador=0;

    $total1=(int)($paginacion*6)-6;
    
    $query="SELECT * FROM vuelos";  
    $consulta = mysqli_query($conexion,$query);
            $posision=(int)$total1+6-1;
            $contador=(int)0;
            
            while($arry = mysqli_fetch_array($consulta)){
                
                if(($contador >= $total1) && $contador<=$posision ){
                    
                    echo "<div class='card'>";
                echo "<img src='http://127.0.0.1:9000/Resources/img/vuelos1.jpg'>";
                echo "<div class='conten'>";
                echo "<div class='id'>";
                echo "<h4>Vuelo Id: </h4>";
                echo "<h4 id='idV' name='idV'>".$arry['id']."</h4>";
                echo "</div>";
                echo "<h6>Fecha: ".$arry['fecha']."</h6>";
                $cod=$arry['CodAO'];
                $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                $arry2=mysqli_fetch_array($consulta2);
                echo "<h6>Ciudad de Origen: ".$arry2['ciudad']."</h6>";
                $cod=$arry['CodAD'];
                $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                $arry2=mysqli_fetch_array($consulta2);
                echo "<h6>Ciudad de Destino: ".$arry2['ciudad']."</h6>";
                $espacios=50;
                $diferencia=(int) $arry['puestos'];
                $total=$espacios-$diferencia;
                echo "<h6>Puestos Disponibles: ".$total."</h6>";
                echo"<input type='checkbox' id='btn-modal'>";
                echo "<label for='btn-modal' class='lbl-modal' onclick='idV(".$arry['id'].")'>Hacer una Reserva</label>";
                echo "</div>";
                echo "</div>";	
                }
                
                $contador=$contador+1;
                          
    }
            


				echo "</div>";
                echo "<div class='contenerdorr'>";
                echo "<form action='Vrecepcionista' method='POST' class='paginacion'>";
                echo "<ul>";
                $i=0;
                while($i<$pagina){
                    echo"<li><input type='submit' id='pagina' name='pagina' class='active' value='".($i+1)."'></input></li>";
                    $i=$i+1;
                }
               
                
                echo"</ul>";
                echo" </form>";


                echo "</div>";
            
                

					    
        }

            
            

        function cerrar(){
            session_destroy();
            require VW . DF . "head.html";
            $this->view->render($this, "inicio");
        }


        function login(){
            $hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database);   
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
                }else{
                //print("entro");
                
             }       
            $usuario = $_POST['usuario'];
            $clave= $_POST['clave'];
            $query="SELECT * FROM usuario inner join persona on usuario.cedula=persona.cedula where usuario = '".$usuario."' and contraseña ='".$clave."'";
            $consulta = mysqli_query($conexion,$query);
            $consulta2 = mysqli_query($conexion,$query);


            $arry3=mysqli_fetch_array($consulta2);
            $_SESSION['cedula']=$arry3['cedula'];

            while($arry = mysqli_fetch_array($consulta)){
                $flag[]=$arry;
            }
            $control=false;
            foreach ($flag as &$valor){
                foreach($valor as &$valor1){
                    $control=true;
                    $roll=$valor1;
                    
                }
            }
            
            if($control){
                $_SESSION['usuario'] = $usuario;
                $_SESSION['roll'] = $roll;
                if($roll=="pasajero"){
                    
                    $this->pasajero();
                }else{
                    $this->Vrecepcionista();
                }


            }else{
                require VW . DF . "head.html";
                $this->view->render($this, "inicioe");


            }
        }
    }
?>