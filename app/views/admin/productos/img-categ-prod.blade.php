@extends('layouts/admin.base')

@section('content') 
  <script type="text/javascript">
      $(window).load(function () { 

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
        <p><a href="{{action('ProductosController@getLista', $cat)}}" class="btn btn-info ">Atras</a></p>

        <legend>Imagen</legend>    
          <div id="content-area"> 
            <table id="listado">
              <thead>
                <tr>
                  <td class="titulo">Categorias / Productos <i class="fa fa-sort"></i></td>
                  <td align="center" width="100" class="titulo">Opciones</td>
                </tr>
              </thead>
            </table>

            <ul id="listadoul" class="ui-sortable">
              @if(count($rows_cat) > 0)
                  @foreach($rows_cat as $row_cat)
                    <li class="fila2" id="list_item_2|cat"> 
                      <div class="data">
                        <img src="{{asset('img/uploads/'.$row_cat->mini_thumb_img_categoria)}}" class="handle">
                      </div>
                      <div class="options">
                        <a class="tooltip1 move" original-title="Ordenar - Click + Arrastrar">
                          <img src="{{asset('img/admin/arrow-move.png')}}" class="handle">
                        </a>

                        <a class="tooltip1" href="{{action('ProductosController@getEditImgCateg',$cat )}}" original-title="Editar">
                          <img src="{{asset('img/admin/button_edit.png')}}">
                        </a> &nbsp; 
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