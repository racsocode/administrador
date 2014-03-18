@extends('layouts/admin.base')

@section('content')           
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <ol class="breadcrumb">
          <li><a href="index.html"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active"><i class="fa fa-table"></i> Tables</li>
        </ol>
      </div>
    </div><!-- /.row -->

    <div class="row">
      <div class="col-lg-12">
        <legend> Editar Categoria</legend>    
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
          
          {{ Form::open(   array(   'action' => array('ProductosController@updateCategProd', $parent,$cat), 'files' => true  )      ) }} 
            {{ Form::submit('ACTUALIZAR', array("class" => "btn btn-default")) }}
            <a href="{{action('ProductosController@getLista', $parent)}}" class="btn btn-danger ">Cancelar</a>

            </br></br>
            @if(count($rows_idiomas) > 0)
                @foreach($rows_idiomas as $row_idioma)
                  </br>
                  <div class="form-group">
                    <span class="label label-danger">Categoria</span>       
                    <img src="{{asset('img/admin/'.$row_idioma->imagen_idioma) }}" class="handle">
                    {{ Form::text('nombre_categoria[]', $contenido[$row_idioma->id_idioma] ['nombre'] ,array("class" => "form-control") ) }}
                  </div>
                  <div class="form-group">
                    <span class="label label-danger">Descripción‎</span>       
                    <img src="{{asset('img/admin/'.$row_idioma->imagen_idioma) }}" class="handle">
                    {{ Form::text('descripcion_categoria[]', $contenido[$row_idioma->id_idioma] ['descripcion'] ,array("class" => "form-control") ) }}
                  </div>
                  </br>                      
                @endforeach  
            @endif  
          {{ Form::close() }}
      </div><!-- col-lg-12 -->
    </div><!-- /.row -->  
  </div><!-- /#page-wrapper -->  
@stop