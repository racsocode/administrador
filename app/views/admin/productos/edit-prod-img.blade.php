@extends('layouts/admin.base')

@section('content') 
  <script type="text/javascript">
    var ias;
    var imgcargada;


    function preview(img, selection) { 
      $('#x1').val(selection.x1);
      $('#y1').val(selection.y1);
      $('#x2').val(selection.x2);
      $('#y2').val(selection.y2);
      $('#w').val(selection.width);
      $('#h').val(selection.height);
    }

    $(window).load(function () { 
       //   $(document).ajaxStop($.unblockUI); 
      $(".before").hide();
      $('#img_big').val("{{ $img['original_img_producto'] }}");

      var _x1 = {{ $img['x1'] }};
      var _x2 = {{ $img['x2'] }};
      var _y1 = {{ $img['y1'] }};
      var _y2 = {{ $img['y2'] }};
      
      ias = $('#thumbnail').imgAreaSelect({ aspectRatio:'400:300',fadeSpeed:false, instance: true,disable:true,onSelectChange: preview }); 
      ias.setOptions({ disable:false, x1: _x1, y1: _y1, x2: _x2, y2: _y2 ,minWidth:405,minHeight:305 });
      ias.update();   

      $("#ajaxform").submit(function(e){
        var form = $("#ajaxform");
        var postData = form.serialize();
        console.log('postData '+postData);
        var formURL = form.attr("action");

        $.ajax({
          url : formURL,
          type: "POST",
          data : postData,
          beforeSend: function(){
            // demos http://malsup.com/jquery/block/#demos
            $.blockUI({ message: '<img src="{{asset('img/preload.gif') }}" /> Un Momento porfavor' }); 
          },              
          success:function(data, textStatus, jqXHR){
            ias.cancelSelection();
            $.unblockUI();
            window.location = data.url_parent;
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('error   '+jqXHR);
          }
        })
          e.preventDefault(); //STOP default action
      });       
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
        
        <p><a href="{{action('ProductosController@getImgProd', array($cat,$prod))}}" class="btn btn-danger ">Cancelar</a></p>

        <legend> Editar el recorte de Imagen al producto</legend>    
        <div id="create_thumb">
            <img src="{{asset('img/uploads/'.$img['original_img_producto'] ) }}" style="border: 1px solid #000;float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />                            
            <br style="clear:both;"/>
            <form name="ajaxform" id="ajaxform" action="{{action('ProductosController@postEditImgProd', array($cat,$prod,$img->id_producto_imagen))}}" method="POST">
              <input type="hidden" name="x1" value="" id="x1" />
              <input type="hidden" name="y1" value="" id="y1" />
              <input type="hidden" name="x2" value="" id="x2" />
              <input type="hidden" name="y2" value="" id="y2" />
              <input type="hidden" name="w" value="" id="w" />
              <input type="hidden" name="h" value="" id="h" />
              <input type="hidden" name="img_big" value="" id="img_big" />
              </br>
              <input type="submit" name="upload_thumbnail" value="Guardar" id="save_thumb" />
            </form>
        </div>
        </br>
      </div><!-- col-lg-12 -->
    </div><!-- /.row -->  
  </div><!-- /#page-wrapper -->  
@stop