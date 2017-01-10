<div class="overlay" style="display:none" ng-controller="modalCoontroller">
	
	<div class="col-xs-12 col-md-6 contact-modal">
		<span class="close-modal" ng-click="closemodal();">X</span>
		<h1>Contactar @{{titulopublicacion | limitTo:20}}</h1>
		<form class="form-contact" ng-submit="enviar(id_prod_hid);">

			<input type="hidden" name="id_product"  ng-model="id_prod_hid">
			<fieldset><input type="text" placeholder="Nombre" ng-model="nombre"></fieldset>
			<fieldset><input type="text" placeholder="Email" ng-model="email"></fieldset>
			<fieldset><input type="text" placeholder="Telefono" ng-model="telefono"></fieldset>
			<fieldset>
				<textarea name="" id="" cols="30" rows="5" placeholder="Mensaje" ng-model="descripcion"></textarea>
			</fieldset>
			<div ng-show="titulopublicacion.length== 0"><small>Matias Mussetta |Tel: 03472-15447836 | Dirección: Lardizabal 1537 | Marcos Juárez - Cordoba </small></div>
			<fieldset>
				<button ng-if="send==false" class="button-contact" type="submit">@{{enviar_msj}}</button>
				<span ng-if="send==true" style="font-size: 1.4em;">Mensaje Enviado!</span>
			</fieldset>
		</form>
	</div>
</div>