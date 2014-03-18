@extends('layouts/admin.base')

@section('content') 
  <script type="text/javascript">

    function delete_img(url){
      //confirm
      //cancel
      bootbox.confirm("¿ Esta Seguro que desea eliminar la Imagen. ?", function(result) {
        if(result==true){
          location.replace(url);     
        }
        console.log(result);
      }); 
    }

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
        <p>
          <a href="{{action('ProductosController@getLista', $cat)}}" class="btn btn-info ">ATRAS</a>
          <a href="{{action('ProductosController@getAgregarImgProd', array($cat,$prod) )}}" class="btn btn-success">NUEVA IMAGEN</a>
        </p>

        <legend>Imagenes de este producto</legend>    
          <div id="content-area"> 
            <table id="listado">
              <thead>
                <tr>
                  <td class="titulo">Imagenes <i class="fa fa-sort"></i></td>
                  <td align="center" width="100" class="titulo">Opciones</td>
                </tr>
              </thead>
            </table>

            <ul id="listadoul" class="ui-sortable">
              @if(count($imgs) > 0)
                  @foreach($imgs as $img)
                    <li class="fila2" id="list_item_{{  $img->id_producto_imagen  }}|img"> 
                      <div class="data">
                        <img src="{{asset('img/uploads/'.$img->mini_thumb_img_categoria)}}" class="handle">
                      </div>
                      <div class="options">
                        @if(count($imgs) > 1)
                          <a class="tooltip1 move" original-title="Ordenar - Click + Arrastrar">
                            <img src="{{asset('img/admin/arrow-move.png')}}" class="handle">
                          </a>
                        @endif

                        @if($img->original_img_producto != 'original-no-disponible.jpg')
                          <a class="tooltip1" href="{{action('ProductosController@getEditImgProd',array($cat,$prod,$img->id_producto_imagen ) )}}" original-title="Editar">
                            <img src="{{asset('img/admin/button_edit.png')}}">
                          </a> &nbsp; 
                        @endif
                        @if(count($imgs) > 1)
                          <a class="tooltip1" href="#" onClick="delete_img('{{action('ProductosController@deleteImgProd',array($cat,$prod, $img->id_producto_imagen ))}}')" original-title="Eliminar">
                            <img src="{{asset('img/admin/button_drop.png')}}">
                          </a>&nbsp;  
                        @endif
                      </div>
                    </li>
                  @endforeach  
              @else
                 
              @endif
            </ul>
          </div>
      </div><!-- col-lg-12 -->
    </div><!-- /.row -->  
  </div><!-- /#page-wrapper -->  
@stop