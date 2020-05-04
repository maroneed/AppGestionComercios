<dashboard :ruta="ruta"></dashboard>
{!! Form::open(array('url'=> 'almacen/articulo','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class="form-group">
	<div class= "input-group">  
		<input type= "text" class= "form-control" name="searchtext" placeholder = "Buscar..." value = "{{$searchtext}}">
        <span class="input-group-btn">
        	<button type = "submit" class= "btn btn-primary"> Buscar </button>
        </span>	
    </div>
</div>

{{Form::close()}} 