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
          
          {{ Form::open( array( 'action' => array('ConfiguracionController@updateConfiguration', $id ) ) ) }} 
            {{ Form::submit('ACTUALIZAR', array("class" => "btn btn-default")) }}
            <a href="{{action('ConfiguracionController@listConfiguration')}}" class="btn btn-danger ">Cancelar</a>
            </br>
            </br>    
            <div class="form-group">
              <span class="label label-danger">{{ $configs->nombre_configuracion}}</span>     
              {{ Form::text('valor_configuracion[]', $configs->valor_configuracion ,array("class" => "input form-control") ) }}
            </div>
            </br>                      
          {{ Form::close() }}
      </div><!-- col-lg-12 -->
    </div><!-- /.row -->  
  </div><!-- /#page-wrapper -->  
@stop