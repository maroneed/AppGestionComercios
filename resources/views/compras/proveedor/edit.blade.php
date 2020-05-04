@extends('layouts.admin')
@section('contenido')
    <div class = "row">
    	<div class="col-lg-6 col-md-6 col-sm-6 cl-xs-12">
    		<h3>Editar Proveedor: {{$persona->nombre}}</h3>
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
        </div>    
    </div>        

            {!!Form::model($persona,['method'=>'PATCH','route'=>['proveedor.update',$persona->id]])!!}
            {{Form::token()}}
            <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre </label>
                <input type= "text" name= "nombre" required value="{{$persona->nombre}}" class= "form-control" placeholder="Nombre... ">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="direccion">Direccion </label>
                <input type= "text" name= "direccion"  value="{{$persona->direccion}}" class= "form-control" placeholder="Direccion... ">
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Documento</label>
                <select name ="tipo_documento" class="form-control">
                   @if($persona->tipo_documento=="dni")
                      <option value="DNI" selected>DNI </option>
                      <option value="CUIL">CUIL </option>
                   @else($persona->tipo_documento=="cuil")
                      <option value="DNI" >DNI </option>
                      <option value="CUIL" selected>CUIL </option>
                   @endif
                    
                </select>
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="num_documento">Numero de documento </label>
                <input type= "text" name= "num_documento" value="{{$persona->num_documento}}" class= "form-control" placeholder="numero de documento... ">
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="telefono">Telefono </label>
                <input type= "text" name= "telefono"  value="{{$persona->telefono}}" class= "form-control" placeholder="Telefono... ">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">Mail </label>
                <input type= "text" name= "email"  value="{{$persona->email}}" class= "form-control" placeholder="Mail... ">
            </div>
        </div>
        
        <

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <button class="btn btn-primary" type = "submit">Guardar </button>
                <button class="btn btn-danger" type = "reset">Cancelar </button>

            </div>
        </div>
    </div>

            {!!Form::close()!!}

    	
@endsection