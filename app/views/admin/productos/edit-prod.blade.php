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
        <legend>Editar Producto</legend>    
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
             
          {{ Form::open(   array(   'action' => array('ProductosController@updateProd', $parent,$prod)  )      ) }} 
            {{ Form::submit('ACTUALIZAR', array("class" => "btn btn-default")) }}
            <a href="{{action('ProductosController@getLista', $parent)}}" class="btn btn-danger ">Cancelar</a>
            </br>
            </br>
              <div class="form-group">
                <span class="label label-primary">Widgets :</span><br><br>
                <label class="checkbox-inline">
                <?php
                if($prods->novedad_producto == 0){
                  echo Form::checkbox('novedad_producto', $prods->novedad_producto, false)?> Novedad<br><?php
                }else{
                  echo Form::checkbox('novedad_producto', $prods->novedad_producto, true)?> Novedad<br><?php
                }?> 
                </label>
                <label class="checkbox-inline">
                <?php
                if($prods->destacado_producto == 0){
                  echo Form::checkbox('destacado_producto', $prods->destacado_producto, false)?> Destacado<br><?php
                }else{
                  echo Form::checkbox('destacado_producto', $prods->destacado_producto, true)?> Destacado<br><?php
                }?> 
                </label>
                <label class="checkbox-inline">
                 <?php
                if($prods->disponibilidad_producto == 0){
                  echo Form::checkbox('disponibilidad_producto', $prods->disponibilidad_producto, false)?> Disponibilidad<br><?php
                }else{
                  echo Form::checkbox('disponibilidad_producto', $prods->disponibilidad_producto, true)?> Disponibilidad<br><?php
                }?> 
                </label>

              </div>            



            @if(count($rows_idiomas) > 0)
                @foreach($rows_idiomas as $row_idioma)
                  
                  <div class="form-group">
                    <span class="label label-danger">Categoria</span>       
                    <img src="{{asset('img/admin/'.$row_idioma->imagen_idioma) }}" class="handle">
                    {{ Form::text('nombre_producto[]', $contenido[$row_idioma->id_idioma] ['nombre'] ,array("class" => "form-control") ) }}
                  </div>
                  <div class="form-group">
                    <span class="label label-danger">Descripción‎</span>       
                    <img src="{{asset('img/admin/'.$row_idioma->imagen_idioma) }}" class="handle">
                    {{ Form::text('descripcion_producto[]', $contenido[$row_idioma->id_idioma] ['descripcion'] ,array("class" => "form-control") ) }}
                  </div>
                  <div class="form-group">
                    <span class="label label-danger">Preparación</span>       
                    <img src="{{asset('img/admin/'.$row_idioma->imagen_idioma) }}" class="handle">
                    {{ Form::text('preparacion_producto[]', $contenido[$row_idioma->id_idioma] ['preparacion'] ,array("class" => "form-control") ) }}
                  </div>

                  </br>                      
                @endforeach  
            @endif  
          {{ Form::close() }}
      </div><!-- col-lg-12 -->
    </div><!-- /.row -->  
  </div><!-- /#page-wrapper -->  
@stop