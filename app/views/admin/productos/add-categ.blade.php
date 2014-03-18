@extends('layouts/admin.base')

@section('content')           
  <div id="page-wrapper">
    </br>
    </br>
    </br>
    <div class="row">
      <div class="col-lg-12">
        <ol class="breadcrumb">
          <li><a href="index.html"></i> Categoria</a></li>
          <li class="active"></i> TablA</li>
        </ol>
      </div>
    </div><!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <legend>Nueva Categoria</legend>    

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
        
        {{ Form::open(array('url' => 'admin/productos/add-cat/'.$parent, 'files' => true)) }}
          {{ Form::submit('INSERTAR', array("class" => "btn btn-default")) }}
          <a href="{{action('ProductosController@getLista', 0)}}" class="btn btn-danger ">Cancelar</a>
          </br></br>
          @if(count($rows_idiomas) > 0)
              @foreach($rows_idiomas as $row_idioma)
                </br>
                <div class="form-group">
                  <span class="label label-danger">Categoria</span>       
                  <img src="{{asset('img/admin/'.$row_idioma->imagen_idioma) }}" class="handle">
                  {{ Form::text('nombre_categoria[]', Input::old('nombre_categoria[]') ,array("class" => "form-control") ) }}
                </div>
                <div class="form-group">
                  <span class="label label-danger">Descripción‎</span>       
                  <img src="{{asset('img/admin/'.$row_idioma->imagen_idioma) }}" class="handle">
                  {{ Form::text('descripcion_categoria[]', Input::old('descripcion_categoria[]'),array("class" => "form-control") ) }}
                </div>
                </br>                      
              @endforeach  
          @endif  
        {{ Form::close() }}
      </div>
    </div><!-- /.row -->
  </div><!-- /#page-wrapper -->
@stop