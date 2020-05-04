@extends('layouts.admin')
@section('contenido')
    
<div class="row">
	<div class="clo-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Roles</h3>
        @include('seguridad.roles.search')
        

    </div>
</div>

<div class="row">
	<div class= "col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class= "table-responsive">
			<table class= "table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th>Estado</th>
				</thead>
                @foreach ($roles as $rol) 
				<tr>
					<td>{{$rol->id}}</td>
					<td>{{$rol->nombre}}</td>
					<td>{{$rol->descripcion}}</td>
					<td>{{$rol->estado}}</td>
	    			<td>
						
                        
					</td>
                
				</tr>
				@include('seguridad.roles.modal')
				@endforeach
			</table>
		</div>
		{{$roles->render()}}			
    </div>
</div>    

@endsection