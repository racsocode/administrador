@extends('layouts.base')

@section('content')
    <div id="navegador">
        <a href="productos.php?cat=0">
            <img src="{{ asset('img/arrow_ltr.gif') }}" alt="flecha"/>
            <b>Servicios</b>
        </a>»
        <a href="productos.php?cat=2" style="text-decoration:none">EMPANADAS</a>»
        Ají de Gallina                        
    </div>


    @if(count($servicio) > 0)
        <script type="text/javascript" src="{{ URL::asset('js/jquery.cycle.all.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.servicio_imagenes').cycle();
            });
        </script>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=239757219500133";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
        </script>
        <script type="text/javascript" src="https://apis.google.com/js/platform.js">
          {lang: 'es'}
        </script>
        <script src="http://platform.tumblr.com/v1/share.js"></script>
        <script src="//platform.linkedin.com/in.js" type="text/javascript">
            lang: es_ES
        </script>

        <div class="beneficios_container">
            <h3 class="heading"><span><span>Características</span></span></h3>
            <div class="servicio_imagenes">       
                @foreach($imagenes_servicios as $img)
                    @if($img->tipo_imagen==1 )
                        {{ HTML::image($img->imagen_servicio, $servicio["nombre_servicio"]) }}
                    @endif    
                @endforeach    
            </div> 
            <div class="container-caracteristicas">
                <ul class="caracteristicas">
                    @foreach($caracteristicas as $caracteristica)
                        @if($caracteristica->tipo_caracteristica==1 )
                            <li>{{ $caracteristica->caracteristica }}</li>
                        @endif
                    @endforeach  
                </ul>
            </div> 
        </div>

        <div class="beneficios_container">
            <h3 class="heading"><span><span>Ventajas</span></span></h3>
            <div class="servicio_imagenes">       
                @foreach($imagenes_servicios as $img)
                    @if($img->tipo_imagen==2 )
                        {{ HTML::image($img->imagen_servicio, $servicio["nombre_servicio"]) }}
                    @endif    
                @endforeach    
            </div> 
            <div class="container-caracteristicas">
                <ul class="caracteristicas">
                    @foreach($caracteristicas as $caracteristica)
                        @if($caracteristica->tipo_caracteristica==2 )
                            <li>{{ $caracteristica->caracteristica }}</li>
                        @endif
                    @endforeach  
                </ul>
            </div> 
        </div>

        <div class="beneficios_container">
            <h3 class="heading"><span><span>Beneficios</span></span></h3>            
            <div class="servicio_imagenes">       
                @foreach($imagenes_servicios as $img)
                    @if($img->tipo_imagen==3 )
                        {{ HTML::image($img->imagen_servicio, $servicio["nombre_servicio"]) }}
                    @endif    
                @endforeach    
            </div> 
            <div class="container-caracteristicas">
                <ul class="caracteristicas">
                    @foreach($caracteristicas as $caracteristica)
                        @if($caracteristica->tipo_caracteristica==3 )
                            <li>{{ $caracteristica->caracteristica }}</li>
                        @endif
                    @endforeach  
                </ul>
            </div> 
        </div>     
<?php
//echo app_path();
//echo base_path();
//echo public_path();
//echo storage_path();
//echo link_to("servicios/detalle/1", "LINK");
// echo $_SERVER['PHP_SELF'];
// echo  URL::current();
?>
<div class="marcador_social">
    <div class="social">
        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>            
    </div>
    <div class="social">
        <a href="http://www.tumblr.com/share/photo?source=<?php echo urlencode("INSERT_SOURCE_HERE") ?>&caption=<?php echo urlencode("INSERT_CAPTION_HERE") ?>&clickthru=<?php echo urlencode("INSERT_CLICK_THRU_HERE") ?>" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:61px; height:20px; background:url('http://platform.tumblr.com/v1/share_2.png') top left no-repeat transparent;">Share on Tumblr</a>
    </div>
    <div class="social">
        <a href="https://twitter.com/share" class="twitter-share-button" data-url="{{URL::current()}}" data-text="tituloinstagram" data-lang="es" data-count="horizontal">Twittear</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    </div>
    <div class="social">
        <script type="IN/Share" data-url="{{URL::current()}}" data-counter="right"></script>
    </div>
    <div class="social">
        <?php $paramsPint = 'url=' . urlencode('{{URL::current()}}') . '&media=' . urlencode('media') . '&description=' . urlencode('description')  ?>
        <a data-pin-config="beside" href="//pinterest.com/pin/create/button/?<?php echo $paramsPint ?>" data-pin-do="buttonPin" >
        <img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
    </div>
    <div class="social">
        <div class="g-plusone"></div>
    </div>

</div>  
<div class="comentariosFacebookBottom">                                                                 
    <fb:comments class="fb_iframe_widget" width="" num_posts="10" href="{{URL::current()}}" fb-xfbml-state="rendered"> </fb:comments>                            
</div>

    @else
        No hay detalle aún
    @endif
@stop