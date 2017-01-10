  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


        
        <script>
        

        
            (function($){
	$(document).ready(function(){
		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
	});
})(jQuery);
        </script>
  
  <nav class="navbar navbar-default" ng-controller="menuController">
      <div class="container-fluid" style="height: 100%;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="#">
            	<img class="agro-logo" src="http://agrofans.com/img/logo-agro.png">
              <img src="http://agrofans.com/img/background-top-logo.png">
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
                 <li><a href="/">Inicio</a></li>
            	<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Maquinarias<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                      
                           
				
				
				
				
				
				
                        <li  ng-repeat="cat in categorias" ng-class="cat.subscat.length >0 ? 'dropdown dropdown-submenu' : 'dropdown'">
                            	

                            	
                            	
                            	<a href="/categoria/@{{cat.name}}" class="dropdown-toggle"  ng-mouseover="verSubmenu($event,this)" >@{{cat.name}}</a>
				
				
				<ul class="dropdown-menu" ng-if="cat.subscat.length >0">
					<li ng-repeat="subcat in cat.subscat">
					<a href="/categoria/@{{subcat.nombre}}">@{{subcat.nombre}}</a></li>
					

				</ul>
			</li>
							
							

                        </ul>
                    </li>
             
           <li><a href="/quienes-somos">Quienes Somos</a></li>
                <li><a href="javascript:void(0);" ng-click="openmodal();">Contacto</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
		

    <div>
            <div class="cat-menu-sub" ng-show="history.length>0">
            <ul>
                <li ng-repeat="cat in history"> 
                	<ins>@{{cat.nombre}}</ins> 
                	<span  ng-hide="$index+1==history.length" > > </span>
                </li>
            </ul>
        </div>
        
        </div>