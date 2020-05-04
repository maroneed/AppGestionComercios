@extends('layouts.admin')
@section('contenido')
    <div class = "row">
    	<div class="col-lg-6 col-md-6 col-sm-6 cl-xs-12">
    		<h3>Nueva Categoria</h3>
    		@if (count($errors)>0)
    		<div class="alert alert-danger">
    			<h3>Ambos campos deben ser completados</h3>
    			<ul>
    			@foreach ($errors->all as $error)	
    			    <li>{{$error}}</li>
                @endforeach
    			</ul>

    		</div>
            @endif
            {!!Form::open(array('url'=>'almacen/categoria','method'=>'POST', 'autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombre </label>
            	<input type= "text" name= "nombre" class= "form-control" placeholder="Nombre... ">
            </div>
            <div class="form-group">
            	<label for="descripcion">Descripcion </label>
            	<input type= "text" name= "descripcion" class= "form-control" placeholder="Descripcion... ">
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type = "submit">Guardar </button>
            	<button class="btn btn-danger" type = "reset">Cancelar </button>

            </div>

            {!!Form::close()!!}

    	</div>
@endsection