<!DOCTYPE html>
<html>
<head>
	<title>Order Entry</title>
	<link rel="stylesheet" type="text/css" href="semantic.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
    $( document ).ready(function() {
        console.log( "document loaded" );
        $('#enduser').on('change', function() {
        if(this.value=='cisco'){
            $('.cisco').show().css('color','blue');
        }else{
            $('.cisco').hide();
        }
        });
        $('.cisco').hide();
    });

    </script>
</head>
<body>
	<br> <br>
	<div class="ui container">
		<div class="ui grid">
		<div class="two column row">
			<div class="column">
			
				<h3>REQUEST</h3>
<form class="ui form" action="index.php" method="post">
	<input type="hidden" name="flag" value="do">


  <div class="ui divider"></div>

  <h3>SHIP TO</h3>
  
  <!--<div class="field">
    <label>End User PO</label>
    <input name="enduserpo" placeholder="End User PO - EndUserPO" type="text">
  </div>-->
  <h3>End User PO</h3>
  <div class="field">
    <label>Selecciona End User PO</label>    
    <select id="enduser">
    	<option value="bdi" selected>BDI</option>
    	<option value="cisco">CISCO</option>
    </select>
  </div>
  <div class="field">
    <label>Nombre</label>
    <input name="nombre" placeholder="Nombre - ShipToAttention" type="text">
  </div>
  <div class="field">
    <label>Calle</label>
  <!--<label>Usuario Final</label>-->
    <input name="calle" placeholder="Calle - ShipToAddress1" type="text">
	<div class="cisco">Escribe CISCO - End User PO CISCO</div>
  </div>  
  <div class="field">
    <label>Colonia</label>
	<!--<label>Calle</label>-->
    <input name="colonia" placeholder="Colonia - ShipToAddress2" type="text">
	<div class="cisco">Escribe La Calle - End User PO CISCO</div>
  </div>

  <div class="field">
    <label>Teléfono</label>
	<!--<label>Colonia</label>-->
    <input name="telefono" placeholder="Telefono - ShipToAddress3" type="text">
	<div class="cisco">Escribe La Colonia - End User PO CISCO</div>
  </div>

  <div class="field">
    <label>Ciudad</label>
    <input name="ciudad" placeholder="Ciudad - ShipToCity " type="text">
  </div>
  <div class="field">
    <label>Estado</label>
    <input name="estado" placeholder="Estado - ShipToProvince" type="text">
  </div>
  <div class="field">
    <label>Código Postal</label>
    <input name="cp" placeholder="Código Postal - ShipToPostalCode" type="text">
  </div>

  <div class="ui divider"></div>

  <h3>ENVÍO Y PRODUCTO</h3>
  <div class="field">
    <label>Selecciona Mensajeria - CarrierCode</label>
    
    <select name="carriercode">
    	<option value="Q7">Fedex</option>
    	<option value="Q7">DHL</option>
    	<option value="MU">Metropolitano</option>
    </select>
  </div>  
  <div class="field">
    <label>Selecciona Sucursal - ShipFromBranches</label>
    
    <select name="branch">
    <option value="03">Branch 03</option>
    	<option value="05">Branch 05</option>
    	<option value="10">CDMX</option>
    	<option value="20">Puebla</option>
    	<option value="30">Mérida</option>
    	<option value="40">Monterrey</option>
    	<option value="50">León</option>
    	<option value="55">Querétaro</option>
    	<option value="60">Tijuana</option>
    	<option value="73">Branch 73</option>
    	<option value="80">Guadalajara</option>
    </select>
  </div>
  <!--<div class="field">
    <label>Usuario Final (Razón Social)</label>
    <input name="rfc" value="" type="text" placeholder="RFC">
  </div>-->
  <div class="field">
    <label>Customer PO</label>
    <input name="customerpo" value="BDI_" type="text" placeholder="pedido ml">
  </div>
  <div class="field">
    <label>SKU</label>
    <input name="sku" value="" type="text" placeholder="SKU">
  </div>
  <div class="field">
    <label>QTY</label>
    <input name="qty" value="1" type="text">
  </div>
 
  <button class="ui button" type="submit">Order Entry</button>
</form>
			</div>
			<div class="column">
				<h3>Response</h3>
<?php 

if (isset($_POST["flag"]) && $_POST["flag"]=="do") {
			$branch = $_POST["branch"];
			/*switch ($branch) {
    			case '05': $sender = "Blue Diamond Retail"; $login="ReTcO4gDb"; $password="LuIaN093019"; break;
    			case '10': $sender = "Blue Diamond"; $login="MeRlI4gDb";$password="LuIaN060618"; break;
    			case '73': $sender = "Blue Diamond CLS"; $login="ChIcE4gDb"; $password="LuIaN092419"; break;
  			}*/			
  			$sender   = "Blue Diamond";
  			$login    = "MeRlI4gDb";
  			$password = "LuIaN060618";

			$nombre = $_POST["nombre"];
			$calle = $_POST["calle"];
			$colonia = $_POST["colonia"];
			
			$telefono = $_POST["telefono"];
			$ciudad   = $_POST["ciudad"];
			$estado   = $_POST["estado"];
			$cp = $_POST["cp"];
			$comment_line = $_POST["comment_line"];
			

			$customerpo = $_POST["customerpo"];
			$enduserpo = $_POST["enduserpo"];
			
			$carriercode = $_POST["carriercode"];
			$sku = $_POST["sku"];
			$qty = $_POST["qty"];
					$xml_ingram = "<OrderRequest>
							<Version>2.0</Version>";
						$xml_ingram .= "<TransactionHeader>
									<SenderID>".$sender."</SenderID>
									<ReceiverID>INGRAM MICRO</ReceiverID>
									<CountryCode>MX</CountryCode>
									<LoginID>".$login."</LoginID>
									<Password>".$password."</Password>
									<TransactionID>{8C1C3C30-63CD-4638-A623-AC888856E3CC}</TransactionID>
									</TransactionHeader>";
							$xml_ingram .= "<OrderHeaderInformation>
										<BillToSuffix>000</BillToSuffix>
										<AddressingInformation>
											<CustomerPO>".$customerpo."</CustomerPO>
											<ShipToAttention>".$nombre."</ShipToAttention>
											
											<ShipTo>
												<Address>
													<ShipToAddress1>"./*((!empty($_POST["rfc"]))?$_POST["rfc"]." - ":"").*/$calle."</ShipToAddress1>
													<ShipToAddress2>".$colonia."</ShipToAddress2>
													<ShipToAddress3>".$telefono."</ShipToAddress3>
													<ShipToCity>".$ciudad."</ShipToCity>
													<ShipToProvince>".$estado."</ShipToProvince>
													<ShipToPostalCode>".$cp."</ShipToPostalCode>
												</Address>
											</ShipTo>
										</AddressingInformation>";
							$xml_ingram .= "	<ProcessingOptions>
											<CarrierCode>".$carriercode."</CarrierCode>
											<AutoRelease>0</AutoRelease>
											<ShipmentOptions>
												<BackOrderFlag>Y</BackOrderFlag>
												<SplitShipmentFlag>Y</SplitShipmentFlag>
												<SplitLine>N</SplitLine>
												<ShipFromBranches>".$branch."</ShipFromBranches>
											</ShipmentOptions>
										</ProcessingOptions>
									</OrderHeaderInformation>
									<OrderLineInformation>";	

	
								
								$xml_ingram .=	"
										<ProductLine>
											<SKU>".$sku."</SKU> 
											<Quantity>".$qty."</Quantity> 
											<CustomerLineNumber/> 
										</ProductLine>
										";				
							
										$xml_ingram .= "<CommentLine>
													<CommentText>NO ENTREGAR FACTURA USUARIO FINAL</CommentText>
												</CommentLine>";
							$xml_ingram .= "</OrderLineInformation>
									<ShowDetail>1</ShowDetail>
								</OrderRequest>";
								
							$url = 'https://newport.ingrammicro.com/MUSTANG';
							$strRequest = utf8_encode($xml_ingram);			
						
						$doc1 = new DOMDocument();
						$doc1->loadXML(utf8_decode($strRequest));
						$OReq = $customerpo."-request.xml";
						$doc1->save("$OReq");
$headers = array(
    "Content-type: text/xml",
    "Content-length: " . strlen($strRequest),
    "Connection: close",
);
						$ch=curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_POST, 1) ;
						curl_setopt($ch, CURLOPT_POSTFIELDS, $strRequest);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						$result = curl_exec($ch);
						// var_dump($strRequest);
						// var_dump($result);

						$doc = new DOMDocument();
						$doc->loadXML(utf8_decode($result));
						$OResp = $customerpo."-response.xml";
						$doc->save("$OResp");	
						curl_close($ch);

								$ErrorStatus = $doc->getElementsByTagName("ErrorStatus");
								$ErrorNumber = $ErrorStatus->item(0)->getAttribute("ErrorNumber");
								if(strlen($ErrorNumber)<=0){
									$BranchOrderNumber = $doc->getElementsByTagName( "BranchOrderNumber" );
									$order_from_ingram = $BranchOrderNumber->item(0)->nodeValue;


							    	$mensaje_error = "
										<div class=\"ui success message\">
										  <i class=\"close icon\"></i>
										  <div class=\"header\">
										    ORDEN GRABADA CON EXITO
										  </div>
										  <p>".$order_from_ingram."</p>
										</div>
							    	 ";							
								}elseif($ErrorNumber!='20079'){
								    
								    $mensaje_error = "
									<div class=\"ui negative message\">
									  <i class=\"close icon\"></i>
									  <div class=\"header\">
									    ERROR FATAL registrando orden de compras, contactar a administradores
									  </div>
									  </div>";	
								}
								echo $mensaje_error;

}							
?>
			</div>
		</div>
	</div>
    
</body>
</html>