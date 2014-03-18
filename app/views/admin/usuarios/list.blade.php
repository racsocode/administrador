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

    function delete_fila(url){
      //confirm
      //cancel
      bootbox.confirm("¿ Esta Seguro que desea Eliminar el Registro ?", function(result) {
        if(result==true){
          location.replace(url);     
        }
        console.log(result);
      }); 
    }


    $(window).load(function () { 

        $("#listadoul").sortable({
            handle : '.handle',
            update : function () {
              var order = $('#listadoul').sortable('serialize');
              pintar();
            /*  $.get("ajax.php?"+order,{action:'ordenarCatProd'},function(data){

              });*/
            }
        });

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
              <a href="{{action('UsuariosController@addAction')}}" class="btn btn-success">NUEVO USUARIO</a>
            </p>

            <h4>» Cuentas y Accesos:</h4>
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th>Nombre <i class="fa fa-sort"></i></th>
                    <th>Apellidos <i class="fa fa-sort"></i></th>
                    <th>Login <i class="fa fa-sort"></i></th>
                    <th>Opciones <i class="fa fa-sort"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Oscar Javier</td>
                    <td>Rodriguez</td>
                    <td>admin</td>
                    <td align="center">
                      <a href="#" onclick="mantenimiento('usuarios.php',1,'edit')"  original-title="Editar">
                        <img src="{{asset('img/admin/button_edit.png')}}">
                      </a>&nbsp;
                      <a href="#" onclick="mantenimiento('usuarios.php',1,'delete')" original-title="Eliminar">
                        <img src="{{asset('img/admin/button_drop.png')}}">                  
                      </a>&nbsp;
                      <a href=""  original-title="Detalle">
                        <img src="http://www.pastasmavery.com/aplication/webroot/imgs/icons/index.gif">
                      </a>&nbsp;
                      <a href="" target="vista" title="Vista Previa">
                        <img src="http://www.pastasmavery.com/aplication/webroot/imgs/icons/view.gif">
                      </a>
                    </td>                
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /#page-wrapper -->
@stop