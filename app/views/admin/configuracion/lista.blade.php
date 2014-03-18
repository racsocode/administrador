@extends('layouts/admin.base')

@section('content')   



  <script type="text/javascript">

    function pintar(){
      $("#listadoul li").each(function(x) {
        $(this).removeClass("fila1").removeClass("fila2");
        var w = 0;
        if(x%2==0){ w = 2;}else{ w = 1;}
        $(this).addClass("fila"+w);
      });
    }

    $(window).load(function () { 
        pintar();
    });
  </script>


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

        <p>
          <a href="{{action('ConfiguracionController@listConfiguration')}}" class="btn btn-success">Cancelar</a>
        </p>
    


            <div id="content-area"> 
              <table id="listado">
                <thead>
                  <tr>
                    <td class="titulo">Nombre <i class="fa fa-sort"></i></td>
                    <td class="titulo">Valor <i class="fa fa-sort"></i></td>
                    <td align="center" width="100" class="titulo">Opciones</td>
                  </tr>
                </thead>
              </table>

              <ul id="listadoul" class="ui-sortable">

                @if(count($configs) > 0)

                    @foreach($configs as $config)

                      <li class="fila2" id="list_item_{{$config['id_configuracion']}}|cat"> 
                        <div class="data">
                          {{$config["nombre_configuracion"]}}  
                        </div>                        
                        <div class="data">
                          {{$config["valor_configuracion"]}}  
                        </div>
                        <div class="options">
                          <a class="tooltip1" href="{{action('ConfiguracionController@editConfiguration', array($config['id_configuracion']) )}}" original-title="Editar">
                            <img src="{{asset('img/admin/button_edit.png')}}">
                          </a> &nbsp;                         
                        </div>
                      </li>
                    @endforeach  
                @else
                   
                @endif

              </ul>

            </div>


          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->
@stop