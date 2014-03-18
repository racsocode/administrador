@extends('layouts.base')

@section('content')
    @if(count($servicios) > 0)
          @foreach($servicios as $item)
            <div class="blog_entry">
                <h3 class="heading">
                    <span>{{$item->nombre_servicio}}</span>
                </h3>
                <a href="{{url('servicios', array($ruta_categoria,$item->ruta_servicio), false) }}">    
                    <img src="{{ asset($item->portada_servicio) }}" alt="{{$item->nombre_servicio}}"/>
                </a>
                <p>{{$item->descripcion_servicio_corta}}</p>
                <div class="detalle_cat">
                    <a href="{{url('servicios', array($ruta_categoria,$item->ruta_servicio), false) }}">ver detalle</a>                    
                </div> 
                <div class="clear"></div>
            </div>
        @endforeach   
        {{$servicios->links()}}
    @else
        No hay artículos aún
    @endif
@stop