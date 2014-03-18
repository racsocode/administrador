@extends('layouts.base')

@section('content')
    @if(count($catgs_servs) > 0)
        @foreach($catgs_servs as $category)
            <div class="blog_entry">
                <h3 class="heading"><span><span>{{$category->nombre_categoria}}</span></span></h3>
                <a href="{{url('servicios', array($category->ruta_categoria), false) }}">
                    <img src="{{ asset($category->imagen_categoria) }}" alt="{{$category->nombre_categoria}}"/>
                </a>
                <p>{{$category->descripcion_categoria}}</p>
                <div class="detalle_cat">
                    <a href="{{url('servicios', array($category->ruta_categoria), false) }}">ver servicios</a>
                </div> 
            </div>
        @endforeach
    @else
        No hay artículos aún
    @endif
@stop