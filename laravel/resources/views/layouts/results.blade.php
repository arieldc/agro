<body style="background-image:url({{asset('img/back-results.jpg')}})" ng-controller="SearchController">
	<input type="hidden" id="src_string" ng-init="inputSrc='{{$src}}'" ng-model="inputSrc">
	<div class="container main-container layout-search" >
		<div class="col-md-12 in-container">
			<div class="col-md-3">
			<div>
				<form action="/buscar" id="formulario-buscar">
				<!-- <span style="display:flex">
					<input class="search-input" name="src" id="src" type="text" placeholder="Buscar" autocomplete="off">
					<button type="submit" class="icon-search"><img src="{{asset('img/icon-search.png')}}" alt=""></button>					
				</span> -->
				
				
			 <div class="input-group">
			      <input  class="form-control" placeholder="Buscar" name="src"  id="src" type="text" placeholder="Buscar" autocomplete="off">
			      <span class="input-group-btn">
			        <button class="btn btn-default " type="submit"><span class="glyphicon glyphicon-search"></span></button>
			      </span>
			  </div>
				
				
				</form>
			</div>
			<div style="">
				<div ng-repeat="att in resultados.atributos track by $index" style="padding-left:2%;">
					<h4 class="parent-cat">@{{att.nombre}}</h4>
					<ul class="list-cat">
						<li ng-repeat="a in resultados.valores[att.id] | unique:'valor'" ng-init="filter_len = (resultados.valores[att.id] | filter: { id_atributo : att.id,valor:a.valor }).length" >
	
								<a href="javascript:void(0)" ng-click="filter(a.id_atributo,a.valor,a.cat)">@{{a.valor}} (@{{filter_len}})</a>
							
						</li>
					</ul>			
				</div>
				<div class="logo-security-layout">
					<img src="/img/logo-seguro.png" style="width: 140px;" alt="">
				</div>
			</div>
			</div>
			<div class="col-md-9">
				<a href="/publicacion/@{{res.titulo}}-@{{res.id}}" ng-repeat="res in resultados.publicaciones.data">
					<div class="col-md-4" ng-show="resultados.imagen[res.id_producto][0].ruta.length>1">
						<div class="item" style="background-image:url('/@{{resultados.imagen[res.id_producto][0].ruta}}')">
							<div class="labels">
								<h4 class="price">
								<span ng-if="res.tipo_moneda==2">USD</span>
								<span ng-if="res.tipo_moneda==1">ARS</span>
								<span>@{{res.precio | number:2}}</span>
								</h4>
								<h3>@{{res.titulo}}</h3>
							</div>					
						</div>
					</div>	
					<div class="col-md-4" ng-show="resultados.imagen[res.id][0].ruta.length>1">
						<div class="item" style="background-image:url('/@{{resultados.imagen[res.id][0].ruta}}')">
							<div class="labels">
								<h4 class="price">
								<span ng-if="res.tipo_moneda==2">USD</span>
								<span ng-if="res.tipo_moneda==1">ARS</span>
								<span>@{{res.precio | number:2}}</span>
								</h4>
								<h3>@{{res.titulo}}</h3>
							</div>					
						</div>
					</div>					
				</a>
				<div class="col-md-12">
				  <ul class="pagination" ng-if="resultados.pagination.last_page>0">
				    <li class="page-item">
				      <a class="page-link" href="#" aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				        <span class="sr-only">Previous</span>
				      </a>
				    </li>

				    <li ng-repeat="n in [] | range:(resultados.pagination.last_page)" class="page-item" ng-click="nextpage(n+1)"><a class="page-link" href="#">@{{n+1}}</a></li>

				    <li class="page-item">
				      <a class="page-link" href="#" aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				        <span class="sr-only">Next</span>
				      </a>
				    </li>
				  </ul>					
				</div>				
			</div>
		</div>
	</div>
</body>

