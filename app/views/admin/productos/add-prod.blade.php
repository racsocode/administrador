@extends('layouts/admin.base')

@section('content')           
  <div id="page-wrapper">
    </br>
    </br>
    </br>
    <div class="row">
      <div class="col-lg-12">
        <ol class="breadcrumb">
          <li><a href="index.html"></i> Productos</a></li>
          <li class="active"></i> TablA</li>
        </ol>
      </div>
    </div><!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <legend>Nuevo Producto</legend>    

        @if($errors->has())
          <div class="alert alert-dismissable alert-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Warning!</h4>
              @foreach ($errors->all('<p>:message</p>') as $message)
                  <p>{{ $message }}</p>
              @endforeach              
          </div>
        @endif
        
        @if(Session::has('confirm'))
          <div class="alert alert-dismissable alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
              {{ Session::get('confirm') }}
          </div>                    
        @endif
        
        {{ Form::open(array('url' => 'admin/productos/add/'.$parent, 'files' => true)) }}
          {{ Form::submit('INSERTAR', array("class" => "btn btn-default")) }}
          <a href="{{action('ProductosController@getLista', $parent)}}" class="btn btn-danger ">Cancelar</a>
          </br></br>
          <div class="form-group">
            <span class="label label-primary">Widgets :</span><br><br>
            <label class="checkbox-inline">
              {{Form::checkbox('novedad_producto', 0, false)}} Novedad<br>
            </label>
            <label class="checkbox-inline">
              {{Form::checkbox('destacado_producto', 0, false)}} Destacado<br>
            </label>
            <label class="checkbox-inline">
              {{Form::checkbox('disponibilidad_producto', 1, true)}} Disponibilidad<br>
            </label>
          </div>   

          @if(count($rows_idiomas) > 0)
              @foreach($rows_idiomas as $row_idioma)
                </br>
                <div class="form-group">
                  <span class="label label-danger">Nombre producto</span>       
                  <img src="{{asset('img/admin/'.$row_idioma->imagen_idioma) }}" class="handle">
                  {{ Form::text('nombre_producto[]', Input::old('nombre_producto[]') ,array("class" => "form-control") ) }}
                </div>
                <div class="form-group">
                  <span class="label label-danger">Descripcion producto</span>       
                  <img src="{{asset('img/admin/'.$row_idioma->imagen_idioma) }}" class="handle">
                  {{ Form::text('descripcion_producto[]', Input::old('descripcion_producto[]'),array("class" => "form-control") ) }}
                </div>

                <div class="form-group">
                  <span class="label label-danger">Preparacion producto</span>       
                  <img src="{{asset('img/admin/'.$row_idioma->imagen_idioma) }}" class="handle">
                  {{ Form::text('preparacion_producto[]', Input::old('preparacion_producto[]'),array("class" => "form-control") ) }}
                </div>
                </br>                      
              @endforeach  
          @endif  

        {{ Form::close() }}
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
@stop