@extends('layouts/admin.base')

@section('content') 


  <script type="text/javascript">
    var ias;
    var imgcargada;

    function seleccionado(){
      var archivos = document.getElementById("archivos");//Damos el valor del input tipo file
      var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
      var texto = document.getElementById("texto").value;
      var data = new FormData();

      for(i=0; i<archivo.length; i++){
        data.append('archivo'+i,archivo[i]);  
      }
      data.append('texto',texto);

      $.ajax({
        url: {{$cat}}, //Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        contentType:false, //Debe estar en false para que pase el objeto sin procesar
        data:data, //Le pasamos el objeto que creamos con los archivos
        processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
        cache:false, //Para que el formulario no guarde cache
        beforeSend: function(){
          $.blockUI({ message: '<img src="{{asset('img/preload.gif') }}" /> Un Momento porfavor' }); 
        },       
        complete: function(data){

        },
        error: function(errors){
          $(".before").hide();
        }  
      }).done(function(data){
          if(data.message=="OK"){
    
          }else{
            bootbox.alert(data.message, function() {  
              $("#archivos").val(""); 
            });              
          }
          $.unblockUI();
          $('#thumbnail').attr("src",data.baseurl+"/img/uploads/"+ data.success );
          $('#img_big').val( data.success);
      }); 
    }

    function preview(img, selection) { 
      if(selection.x1>0){
        $("#save_thumb").show();
      }
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
      //$("#save_thumb").hide();

      ias = $('#thumbnail').imgAreaSelect({ aspectRatio:'400:300',fadeSpeed:false, instance: true,disable:true,onSelectChange: preview }); 
      ias.setOptions({ disable:false, x1: 0, y1: 0, x2: 400, y2: 300 ,minWidth:450,minHeight:350 });
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
             console.log("aaa "+ data.message);
            $("#save_thumb").hide(); 
            //$('#thumbnail').attr("src", data.success );
           
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

      $('#img_big').val("{{$imagen}}");
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
        
        <p><a href="{{action('ProductosController@getImgCateg', $cat)}}" class="btn btn-danger ">Cancelar</a></p>

        <legend> Imagen Categoria</legend>    
        <div id="subir">
          <input id="archivos" type="file" required="required" name="archivos[]" multiple="multiple" accept="image/jpeg, image/png" onchange="seleccionado();" />
          <input id="texto" type="hidden">


        </div>


        </br>
        <div id="create_thumb">
            <img src="{{asset('img/uploads/'.$imagen) }}" style="border: 1px solid #000;float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />                            
            <br style="clear:both;"/>
            <form name="ajaxform" id="ajaxform" action="{{$cat}}" method="POST">
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