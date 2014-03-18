@extends('layouts.base')

@section('content')           
    <div class="product-most box productcarousel">
        <div class="box-heading">
            <h4><span>Menu Bravo</span></h4>
        </div>
        <div class="box-content">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">                                 
                    <div class="image">
                        <a class="img" href="">
                            <img src="{{asset('img/uploads/aji-de-gallina.jpg')}}" title="Aliquam tincidunt" alt="Aliquam tincidunt">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Aji de gallina</a>
                        </h3>
                        <div class="price">
                            S/.8.00
                        </div>
                    </div>
                </div>
            </div>
  
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">             
                    <div class="image">
                        <a class="img" href="">
                            <img src="{{asset('img/uploads/tallarin-rojo-con-pollo.jpg')}}" title="Donec" alt="purus">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Tallarin rojo con pollo</a>
                        </h3>
                        <div class="price">
                            S/.8.00
                        </div>
                    </div>
                </div>
            </div>
  
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">                         
                    <div class="image">
                        <a class="img" href="">
                            <img src="{{asset('img/uploads/sudado-de-pescado.jpg')}}" title="Fusce" alt="Fusce">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Sudado de Pescado</a>
                        </h3>
                        <div class="price">
                            S/.8.00
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">
                    <div class="image">
                        <a class="img" href="">
                            <img src="{{asset('img/uploads/pollo-con-champinones.jpg')}}" title="Mollicitudin" alt="Mollicitudin ">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Pollo con champiñones</a>
                        </h3>
                        <div class="price">
                            S/.8.00
                        </div>
                    </div>
                </div>
            </div>

            </div> 
    </div>

    <div class="dark box productcarousel">
        <div class="box-heading">
            <h4><span>Destacados</span></h4>
        </div>
        <div class="box-content">   
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">
                    <div class="image">
                        <a class="img" href="">
                            <img src="{{asset('img/uploads/pollo-brosther.jpg')}}" title="Donec" alt="Donec">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Pollo Brosther</a>
                        </h3>
                        <div class="price">
                            S/.8.00                                                                                      
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">
                    <div class="image">
                        <a class="img" href="">
                            <img src="{{asset('img/uploads/pollo-a-la-campesina.jpg')}}" title="Morbi" alt="Morbi">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Pollo a la campesina</a>
                        </h3>
                        <div class="price">
                            S/.8.00                                                                                     
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">                             
                        <div class="image">
                            <span class="product-label-special label">oFERTA</span>
                            <a class="img" href="">
                                <img src="{{asset('img/uploads/tallarin-saltado.jpg')}}" title="Mollis" alt="Mollis">
                            </a>
                        </div>
                        <div class="product-meta">
                            <h3 class="name">
                                <a href="">Tallarin saltado</a>
                            </h3>

                            <div class="price">
                                <span class="price-new">S/.8.00</span>
                            </div> 
                        </div>  
                </div>
            </div>
                                                                                
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">             
                    <div class="image">
                        <a class="img" href="{{url('servicios', array('params1','params2'), false) }}">
                            <img src="{{asset('img/uploads/picante-de-carne.jpg')}}" title="Mattis" alt="Mattis">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Picante de carne</a>
                        </h3>
                        <div class="price">
                            <span class="price-new">S/.8.00</span>                                                                                      
                        </div>  
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="dark box productcarousel">
        <div class="box-heading">
            <h4><span>Novedades</span></h4>
        </div>
        <div class="box-content">   
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">
                    <div class="image">
                        <a class="img" href="">
                            <img src="{{asset('img/uploads/higado-encebollado.jpg')}}" title="Donec" alt="Donec">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Higado encebollado</a>
                        </h3>
                        <div class="price">
                            <span class="price-new">S/.8.00</span>                                                                                      
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">
                    <div class="image">
                        <a class="img" href="">
                            <img src="{{asset('img/uploads/estofado-de-rez.jpg')}}" title="Morbi" alt="Morbi">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Estofado de rez</a>
                        </h3>
                        <div class="price">
                            <span class="price-new">S/.8.00</span>                                                                                   
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">                             
                        <div class="image">
                            <span class="product-label-special label">oFERTA</span>
                            <a class="img" href="">
                                <img src="{{asset('img/uploads/pollo-al-mani.jpg')}}" title="Mollis" alt="Mollis">
                            </a>
                        </div>
                        <div class="product-meta">
                            <h3 class="name">
                                <a href="">Pollo al mani</a>
                            </h3>

                            <div class="price">
                                <span class="price-new">S/.8.00</span> 
                            </div> 
                        </div>  
                </div>
            </div>
                                                                                
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">             
                    <div class="image">
                        <a class="img" href="{{url('servicios', array('params1','params2'), false) }}">
                            <img src="{{asset('img/uploads/seco-de-res-con-pallares.jpg')}}" title="Mattis" alt="Mattis">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Seco de res</a>
                        </h3>
                        <div class="price">
                            <span class="price-new">S/.8.00</span>                                                                                          
                        </div>  
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="dark box productcarousel">
        <div class="box-heading">
            <h4><span>Ofertas</span></h4>
        </div>
        <div class="box-content">   
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">
                    <div class="image">
                        <a class="img" href="">
                            <img src="{{asset('img/uploads/macarrones-de-carne.jpg')}}" title="Donec" alt="Donec">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Macarrones de carne</a>
                        </h3>
                        <div class="price">
                            <span class="price-new">S/.8.00</span>                                                                                      
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">
                    <div class="image">
                        <a class="img" href="">
                            <img src="{{asset('img/uploads/seco-a-la-nortena.jpg')}}" title="Morbi" alt="Morbi">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Seco a la nortena</a>
                        </h3>
                        <div class="price">
                            <span class="price-new">S/.8.00</span>                                                                                      
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">                             
                        <div class="image">
                            <span class="product-label-special label">oFERTA</span>
                            <a class="img" href="">
                                <img src="{{asset('img/uploads/papa-rellena.jpg')}}" title="Mollis" alt="Mollis">
                            </a>
                        </div>
                        <div class="product-meta">
                            <h3 class="name">
                                <a href="">Papa rellenad</a>
                            </h3>

                            <div class="price">
                                <span class="price-new">S/.8.00</span>  
                            </div> 
                        </div>  
                </div>
            </div>
                                                                                
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-block">             
                    <div class="image">
                        <a class="img" href="{{url('servicios', array('params1','params2'), false) }}">
                            <img src="{{asset('img/uploads/pollo-al-horno.jpg')}}" title="Mattis" alt="Mattis">
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3 class="name">
                            <a href="">Pollo al horno</a>
                        </h3>
                        <div class="price">
                            <span class="price-new">S/.8.00</span>                                                                                          
                        </div>  
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="content-bottom"> 
        <div class="box pav-block bloglatest">
            <div class="box-heading">
                <h4><span>Latest Blog</span></h4>
            </div>
            <div class="pavblog-latest clearfix">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pavblock">
                        <div class="blog-item">                 
                            <div class="blog-body clearfix">
                                <div class="image clearfix">
                                    <img src="{{asset('img/uploads/blog_2-376x153.jpg')}}" title="Donec" align="left">
                                </div>
                            
                                <h4 class="blog-title">
                                    <a href="" title="Donec">Donec tellus lorem elit tristique </a>
                                </h4>

                                <div class="description">
                                    <p>Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan</p>
                                </div>

                                <p>
                                    <a href="{{url('servicios', array('params1','params2'), false) }}" class="pull-right readmore">Read more<span class="icon-angle-right"></span></a>
                                </p> 
                            </div>  
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pavblock">
                        <div class="blog-item">                 
                            <div class="blog-body clearfix">
                                <div class="image clearfix">
                                    <img src="{{asset('img/uploads/blog_3-376x153.jpg')}}" title="Neque" align="left">
                                </div>
                                <h4 class="blog-title">
                                    <a href="{{url('servicios', array('params1','params2'), false) }}" title="Neque porro quisquam dolorem">Neque porro quisquam dolorem</a>
                                </h4>
                                <div class="description">
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium</p>
                                </div>
                                <p>
                                    <a href="{{url('servicios', array('params1','params2'), false) }}" class="pull-right readmore">Read more<span class="icon-angle-right"></span></a>
                                </p> 
                            </div>  
                        </div>
                    </div>
                                            
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pavblock">
                        <div class="blog-item">                 
                            <div class="blog-body clearfix">
                                <div class="image clearfix">
                                    <img src="{{asset('img/uploads/blog_1-376x153.jpg')}}" title="Commodo" align="left">
                                </div>
                                <h4 class="blog-title">
                                    <a href="{{url('servicios', array('params1','params2'), false) }}" title="Commodo laoreet semper lorem ">Commodo laoreet semper lorem </a>
                                </h4>
                                <div class="description">
                                    <p>Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur magna. Euismod euismod Sus</p>
                                </div>
                                <p>
                                    <a href="{{url('servicios', array('params1','params2'), false) }}" class="pull-right readmore">Read more<span class="icon-angle-right"></span></a>
                                </p> 
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop