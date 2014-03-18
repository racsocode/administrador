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
          <a href="{{action('ProductosController@addCateg', $parent)}}" class="btn btn-success">NUEVA CATEGORIA</a>
          <a href="{{action('ProductosController@addProd', $parent)}}" class="btn btn-primary">NUEVO PRODUCTO</a>
        </p>
    


            <div id="content-area"> 
              <table id="listado">
                <thead>
                  <tr>
                    <td class="titulo">Categoria / imagenes <i class="fa fa-sort"></i></td>
                    <td align="center" width="100" class="titulo">Opciones</td>
                  </tr>
                </thead>
              </table>

              <ul id="listadoul" class="ui-sortable">

                @if(count($cats) > 0)

                    @foreach($cats as $cat)

                      <li class="fila2" id="list_item_{{$cat['id_categoria']}}|cat"> 
                        <div class="data">
                          <img src="{{asset('img/admin/icon-campaign.gif')}}" class="handle"> {{$cat["nombre_categoria"]}}  
                        </div>
                        <div class="options">
                          <a class="tooltip1 move" original-title="Ordenar - Click + Arrastrar">
                            <img src="{{asset('img/admin/arrow-move.png')}}" class="handle">
                          </a>
                          <a class="tooltip1" href="{{action('ProductosController@editCategProd', array($parent,$cat['id_categoria']) )}}" original-title="Editar">
                            <img src="{{asset('img/admin/button_edit.png')}}">
                          </a> &nbsp; 
                          <a class="tooltip1" onClick="delete_fila('{{action('ProductosController@deleteCateg',array($parent, $cat['id_categoria']))}}')" href="#" original-title="Eliminar">
                            <img src="{{asset('img/admin/button_drop.png')}}">
                          </a>&nbsp;
                          <a class="tooltip1" href="{{action('ProductosController@getLista',$cat['id_categoria'] )}}" original-title="Ver Productos">
                            <img src="{{asset('img/admin/zoom.png')}}">
                          </a>&nbsp;
                          <a class="tooltip1" href="{{action('ProductosController@getImgCateg',$cat['id_categoria'] )}}" original-title="Ver Imagenes">
                            <img src="{{asset('img/admin/photo_upload.png')}}">
                          </a>&nbsp;                          
                        </div>
                      </li>
                    @endforeach  
                @else
                   
                @endif


                @if(count($prods) > 0)
                  @foreach($prods as $prod)
                    <li class="fila2" id="list_item_{{$prod['id_producto']}}|prod"> 
                      <div class="data">
                        <img src="{{asset('img/admin/ps.gif')}}" class="handle"> {{$prod["nombre_producto"]}}  
                      </div>
                      <div class="options">
                        <a class="tooltip1 move" original-title="Ordenar - Click + Arrastrar">
                          <img src="{{asset('img/admin/arrow-move.png')}}" class="handle">
                        </a>
                        <a class="tooltip1" href="{{action('ProductosController@editProd', array($parent,$prod['id_producto']) )}}" original-title="Editar">
                          <img src="{{asset('img/admin/button_edit.png')}}">
                        </a> &nbsp; 
                        <a class="tooltip1"  onClick="delete_fila('{{action('ProductosController@deleteProd',array($parent, $prod['id_producto']))}}')" original-title="Eliminar">
                          <img src="{{asset('img/admin/button_drop.png')}}">
                        </a>&nbsp;
                        <a class="tooltip1" href="{{action('ProductosController@getImgProd', array($parent, $prod['id_producto'])  )}}"  original-title="Ver Imagenes">
                          <img src="{{asset('img/admin/photo_upload.png')}}">
                        </a>&nbsp;
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