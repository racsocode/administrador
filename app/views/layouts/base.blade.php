<!DOCTYPE HTML>
<html lang="en">
    <head>
        @include('layouts/header')
    </head>
    <body>
        <section id="page" class="offcanvas-pusher" role="main">
            <section id="header">
                <section id="topbar">
                   @include('layouts/idioma')
                </section>

                <section id="header-main">
                    @include('layouts/logo')
                </section>
               <section id="pav-mass-bottom">
                    @include('layouts/widgets')
                </section> 
                <section id="pav-mainnav">
                    @include('layouts/navigation')
                </section>
            </section>

            <section id="pav-slideshow" class="pav-slideshow">
                @include('layouts/banner')
            </section>

            <section id="columns" class="offcanvas-siderbars">
                <div class="container">
                    <div class="row">
                        <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">         
                            <div id="content">                
                                @yield('content')
                            </div>
                        </section>
                    </div>
                </div>
            </section>
            
            <section id="footer">
                @include('layouts/footer')
            </section>
        </section>
    </body>
</html>