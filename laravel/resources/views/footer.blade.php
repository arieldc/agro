<footer ng-controller="newsleterController">
<div class="container footer-padding">
	<div class="col-md-6 col-xs-12 footer-element-padding">
		<div>
			<b>Conoce las últimas novedades</b>
		</div>
		<div>
		<form ng-submit="sendnew()">
			<input class="boletin" ng-disabled="nesleter_" type="text" placeholder="Registrate a nuestro Newsleter" ng-model="mailnewsleter">
			<button type="submit" class="button-newsleter" ng-if="nesleter_==false"><img src="{{asset('img/arrow_small.png')}}" alt=""></button>
		</form>
			
		</div>
		<div>
			<b>2016 AgroFans.com</b>
		</div>
	</div>
	<div class="col-md-3 col-xs-12 footer-element-padding">
		<ul>
			<li><b>Categorías</b></li>
			<li ng-repeat="cat in categorias"><a href="/categoria/@{{cat.name}}">@{{cat.name}}</a></li>
		</ul>
	</div>
	<div class="col-md-3 col-xs-12 footer-element-padding">
		<ul>
			<li><b>AgroFans</b></li>
			<li><a href="/quienes-somos">Quienes Somos</a></li>
			<li><a href="javascript:void(0);" ng-click="openmodal();">Contacto</a></li>
		</ul>
	</div>
</div>
</footer>
<script src="{{asset('js/angular.min.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/controllers.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
<script src="{{asset('js/loading.js')}}"></script>
<script src="{{asset('js/zoom.js')}}"></script>
<script src="{{asset('js/angular.filter.js')}}"></script>
<script src="{{asset('js/elevatezoom.js')}}"></script>