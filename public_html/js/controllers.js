var app = angular.module('agroFan', ['angular-loading-bar','angular.filter'])
.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
	cfpLoadingBarProvider.includeSpinner = true;

}]);


app.controller('HomeController', ['$scope','$http', function($scope,$http) {
	$scope.publicaciones = [], respuesta='';

	$http.get('/api/features')
	.then(function(res){
		respuesta = res.data;
		$scope.publicaciones = respuesta; 
		console.log($scope.publicaciones);            
	});  


}]);

app.controller('menuController', ['$scope','$http','$rootScope', function($scope,$http,$rootScope) {
	respuesta='', $scope.categorias = [], $rootScope.history = [];

	$scope.openmodal = function(){
		$('.overlay').css('display','block');
		$rootScope.titulopublicacion = '';
	}

	$http.get('/api/categorias')
	.then(function(res){
		respuesta = res.data;
		$scope.categorias = respuesta;
		console.log(respuesta);           
	});
	
	$scope.verSubmenu = function($event,e)
	{
		console.log(e);
		console.log($event.target)
		$($event.target).parent().siblings().removeClass('open');
			$($event.target).parent().toggleClass('open');
	}  

}]);

app.controller('categorieController', ['$scope','$http','$rootScope', function($scope,$http,$rootScope) {
	respuesta='', $scope.categorias = [],$scope.publicaciones_all=[],$scope.pag = '', $scope.resultados = [],$rootScope.history = [], $scope.attr2 = [], $scope.publicaciones = [];

	$scope.nextpage = function(n){
		$http.get('/api/demo/'+$scope.inputSrc+'?page='+n)
		.then(function(res){
			respuesta = res.data;
			$scope.resultados = respuesta;     
		}); 
	}

	$scope.filter = function(id,valor,cat){
		$http.get('/api/atributospublic/'+id+'/'+valor+'/'+cat)
		.then(function(res){
			respuesta = res.data;
			$scope.resultados = respuesta;       
		});  	
	}

	/*$scope.$watch('inputSrc', function(src) {
		if (src) {
			$http.get('/api/categoria/'+src)
			.then(function(res){
				respuesta = res.data;
				$scope.resultados=respuesta;
				$scope.publicaciones = respuesta.publicaciones;				
				console.log(respuesta);  
				$rootScope.history = respuesta.publicacion_categoria;
				console.log($rootScope.history);
				if($scope.pag==''){
					$scope.pag = $scope.resultados.publicaciones.last_page;
				}				

				var aty = respuesta.atributos;
				for(a in respuesta.atributos){
					var arri = aty[a].publicaciones;
					for(b in arri){
		
							$scope.attr2.push({
										id_atributo:arri[b].pivot.id_atributo,
										parent_atributo:respuesta.atributos[arri[b].pivot.id_atributo].nombre,
										id_publicacion:arri[b].pivot.id_publicacion,
										valor:arri[b].pivot.valor_atributo
									});							
					}
				}




			});  		    	
		}
	});*/

/*NEWWWW*/
$scope.$watch('inputSrc', function(src) {
	if(src){
		$http.get('/api/demo/'+src)
		.then(function(res){
			respuesta = res.data;
			$scope.resultados = respuesta;   
			$rootScope.history = respuesta.publicacion_categoria;      
		});  
	};
});

/*FIN NEWWWW*/

}]);

app.controller('newsleterController', ['$scope','$http', function($scope,$http) {
	respuesta='', $scope.categorias = [], $scope.resultados = [], $scope.nesleter_=false;
	$scope.openmodal = function(){
		$('.overlay').css('display','block');
	}
	$scope.sendnew = function(){
			$http.post(
			'/api/newsleter',
				{
				    'mail':$scope.mailnewsleter
				}
			).then(function(res){ 
				$scope.nesleter_=true;

			}); 
	}

	$http.get('/api/categorias')
	.then(function(res){
		respuesta = res.data;
		$scope.categorias = respuesta;         
	});  	

}]);

app.controller('SearchController', ['$scope','$http', function($scope,$http) {
	$scope.resultados = [], respuesta='',$scope.pag = '', $scope.attr = [], $scope.attr2=[], $scope.attr_tmp = [], tmp='',$scope.found=false;
	
	$scope.nextpage = function(n){
		$http.get('/api/buscar/'+$scope.inputSrc+'?page='+n)
		.then(function(res){
			respuesta = res.data;
			$scope.resultados = respuesta;     
		}); 
	}

	$scope.filter = function(id,valor,src){
		$http.get('/api/atributospublic/src/'+id+'/'+valor+'/'+src)
		.then(function(res){
			respuesta = res.data;
			$scope.resultados = respuesta;       
		});  	
	}

	$scope.$watch('inputSrc', function(src) {
		if (src) {
			$http.get('/api/buscar/'+src)
			.then(function(res){
				$scope.found=false
				respuesta = res.data;
				$scope.resultados = respuesta; 
				$scope.attr = respuesta.atributos;
				if($scope.pag==''){
					$scope.pag = $scope.resultados.publicaciones.last_page;
				}
				
				var aty = respuesta.atributos;
				for(a in respuesta.atributos){
					var arri = aty[a].publicaciones;
					for(b in arri){
		
							$scope.attr2.push({
										id_atributo:arri[b].pivot.id_atributo,
										parent_atributo:respuesta.atributos[arri[b].pivot.id_atributo].nombre,
										id_publicacion:arri[b].pivot.id_publicacion,
										valor:arri[b].pivot.valor_atributo
									});							
					}
				}

				if(respuesta.publicaciones.data.length<1){
					$scope.found=true;
				}
					console.log($scope.attr);
			});  		    	
		}
	});




}]);

app.controller('PublicacionController', ['$scope','$http','$rootScope', function($scope,$http,$rootScope) {
	$scope.publicacion = [], respuesta='',zoom=false, $scope.imgmain = '',$scope.recomendados = [],$scope.recomendados_publi = [], $rootScope.titulopublicacion = '';
	
	$scope.chan = function(rut){
		$scope.imgmain = rut
	}
	$scope.openmodal = function(id,nombre){
		$('.overlay').css('display','block');
		$scope.id_prod_hid = id;
		$rootScope.titulopublicacion = nombre;
	}
	$scope.zoom = function(){
		console.log('zom');
	}

	$(".miniaturas").delegate("img", "click", function ( event ) {
		console.log('hover');
		$('#main_img').ezPlus();
	});
	$('#main_img').hover(function(){
		$('#main_img').ezPlus();
	});
	$scope.$watch('inputId', function(id) {
		if (id) {
			$http.get('/api/publicaciones/'+id)
			.then(function(res){
				respuesta = res.data;
				$scope.publicacion = respuesta; 
				$scope.imgmain = respuesta.publicacion_imagen[0].ruta; 
				console.log(respuesta);
				$rootScope.history = respuesta.publicacion_categoria;

				
				/*RECOMENDADOS*/
					$http.get('/api/recomendados/'+$scope.publicacion.publicacion_categoria[0].id)
					.then(function(res){
						respuesta = res.data;
						$scope.recomendados = respuesta;
						console.log(respuesta);
			
						for(var i = 0;i<5;i++){
	
							$http.get('/api/publicaciones/'+$scope.recomendados[i].id_producto)
							.then(function(res){
								$scope.recomendados_publi.push(res.data);
								console.log($scope.recomendados_publi);          
							}); 						

						}

					}); 				
				/*FIN*/				
			});  		    	
		}
	});

}]);

app.controller('modalCoontroller', ['$scope','$http', function($scope,$http) {
	$scope.enviar_msj='Enviar' ,$scope.publicacion = [], respuesta='',zoom=false, $scope.imgmain = '', $scope.send=false;

	$scope.closemodal = function(){
		$('.overlay').css('display','none');
		$scope.send=false;
		$scope.nombre='';
		$scope.email='';
		$scope.nombre='';
		$scope.telefono='';
		$scope.descripcion='';
	}	

	$scope.enviar = function(id){

		$scope.enviar_msj = 'Enviando...';
           $http.post(
                '/admin/mensajes',
                    {
                        'nombre':$scope.nombre,
                        'email':$scope.email,
                        'id_publicacion':id,
                        'apellido':$scope.nombre,
                        'telefono':$scope.telefono,
                        'descripcion':$scope.descripcion
                    }
                ).then(function(res){ 
                	$scope.send = true;
					$scope.enviar_msj = 'Enviar';   
            });       	
	}

}]);