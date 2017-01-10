<body style="background-image:url({{asset('img/back-results.jpg')}})" ng-controller="HomeController">
	<div class="container">
	
	
	
	
	
		<!-- <div class="search-box">
			<form action="/buscar">
			<span>
				<input type="text" name="src" autocomplete="off" id="src" placeholder="¿Que precisa tu campo?">
				<button type="submit" class="icon-search"><img src="{{asset('img/icon-search.png')}}" alt=""></button>
			</span>
			
			
			</form>
		</div> -->
		
		<div class="row" style="margin-top:162px;margin-bottom:60px;">
		
			<div class="col-md-4" style="text-align:center;" ><img src="{{asset('img/logo-seguro.png')}}" alt=""></div>
			<div class="col-md-4" style="padding-top:5%;">
				<form action="/buscar">
				    <div class="input-group">
		
				      <input type="" class="form-control" placeholder="Buscar" name="src" autocomplete="off" id="src">
					 <span class="input-group-btn">
			        <button class="btn btn-default " type="submit"><span class="glyphicon glyphicon-search"></span></button>
			      </span>
				    </div>
		    		</form>
			</div>
			<div class="col-md-4"></div>
		
		</div>
	
		
		
		
		
		
		
		
		<div class="row">
			<div class="title-box">
				<h2>El portal de compra y venta del agro hecho por y para fanaticos</h2>
			</div>
			<div class="grid-products md-12 container">
				<div class="sub-title">
					<h3>Nuevos Ingresos</h3>
				</div>
				<a href="/publicacion/@{{publicacion.publicacion.titulo}}-@{{publicacion.publicacion.id}}" ng-repeat="publicacion in publicaciones">
					<div class="col-md-3">
						<div class="item" style="background-image:url('/@{{publicacion.images[0].ruta}}')">
							<div class="labels">
								<h4 class="price">
									<span ng-if="publicacion.publicacion.tipo_moneda==2">USD</span>
									<span ng-if="publicacion.publicacion.tipo_moneda==1">ARS</span>
									<span>@{{publicacion.publicacion.precio | number:2}}</span></h4>
								<h3>@{{publicacion.publicacion.titulo}}</h3>
							</div>
						</div>
					</div>
				</a>

			</div>
		</div>
	</div>
</body>
