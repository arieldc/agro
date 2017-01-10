<body style="background-image:url({{asset('img/back-results.jpg')}})" ng-controller="PublicacionController">
	<input type="hidden" id="src_string" ng-init="inputId='{{$id}}'" ng-model="inputId">
	<div class="container main-container layout-search">
		<div class="col-md-12 in-container">
			<div class="col-md-6">
				<div class="gallery">
					<div class="precio-label-main">
					<span ng-if="publicacion.tipo_moneda==2">USD</span>
					<span ng-if="publicacion.tipo_moneda==1">ARS</span>	
					@{{publicacion.precio | number:2}}</div>
					<img class="main-img" id="main_img" ezp-options="{scrollZoom: true, easing: true,zoomType:Lens}"  ng-src="/@{{imgmain}}" alt="">
					<ul class="miniaturas col-md-12">
						<li ng-click="chan(thum.ruta)" class="col-md-3" ng-repeat="thum in publicacion.publicacion_imagen">
							<img src="/@{{thum.ruta}}" alt="">
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<h2>@{{publicacion.titulo}}</h2>
				<button class="button-contact" ng-click="openmodal({{$id}},publicacion.titulo);">Contactar al vendedor</button>
				<h3 class="sub-title-item">Descripción</h3>
				<p class="descripcion-item">@{{publicacion.descripcion | limitTo:550}}</p>
				<h3 class="sub-title-item">Caracteristicas</h3>
				<div>
					<div class="col-md-12">
						<div class="col-md-6" ng-repeat="att in publicacion.publicacion_atributos">
							<h5 class="sub-title-description">@{{att.nombre}}</h5>
							<p>@{{att.pivot.valor_atributo}}</p>						
						</div>


					</div>
				</div>
			</div>
			<div class="col-md-12">
				<h3 class="sub-title-item">Publicaciones Similares</h3>
				<a ng-repeat="i in recomendados_publi" href="/publicacion/@{{i.titulo}}-@{{i.id}}"><div class="col-md-3">
					<div class="item" style="background-image:url('/@{{i.publicacion_imagen[0].ruta}}')">
						<div class="labels">
							<h4 class="price">
							<span ng-if="i.tipo_moneda==2">USD</span>
							<span ng-if="i.tipo_moneda==1">ARS</span>								
							<span class="ng-binding">@{{i.precio}}</span>
							</h4>
							<h3 class="ng-binding">@{{i.titulo}}</h3>
						</div>
					</div>
				</div>
			</a></div>
		</div>

	</div>
</body>