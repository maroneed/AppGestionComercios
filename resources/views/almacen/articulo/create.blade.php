@extends('layouts.admin')
@section('contenido')
    <dashboard :ruta="ruta"></dashboard>
    <div class = "row">
        <div class="col-lg-6 col-md-6 col-sm-6 cl-xs-12">
            <h3>Nueva Articulo</h3>
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
            {!!Form::open(array('url'=>'almacen/articulo','method'=>'POST', 'autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre </label>
                <input type= "text" name= "nombre" required value="{{old('nombre')}}" class= "form-control" placeholder="Nombre... ">
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Categoria</label>
                <select name ="categoriaID" class="form-control">
                    @foreach($categorias as $cat)
                    <option value="{{$cat->id}}">{{$cat->nombre}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Codigo </label>
                <input type= "text" name= "codigo" required value="{{old('codigo')}}" class= "form-control" placeholder="Codigo... ">
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Stock </label>
                <input type= "text" name= "stock" required value="{{old('stock')}}" class= "form-control" placeholder="Stock... ">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Descripcion </label>
                <input type= "text" name= "descripcion"  value="{{old('descripcion')}}" class= "form-control" placeholder="Descripcion... ">
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="imagen">Imagen </label>
                <input type= "file" name= "imagen"  class= "form-control" >
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <button class="btn btn-primary" type = "submit">Guardar </button>
                <button class="btn btn-danger" type = "reset">Cancelar </button>

            </div>
        </div>
    </div>


            
            

            {!!Form::close()!!}

        
@endsection