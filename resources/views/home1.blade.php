<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>clinica Esmeralda</title>
    <link rel="stylesheet" href="{{asset('css/stilo.css')}}">
    <link href="{{asset('css/estilizacao.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/sidebar-vertical.css')}}" rel="stylesheet">
    <link href="{{asset('css/estilo-painel-controler.css')}}"rel="stylesheet">
    <link href="{{asset('css/admin-form-acesso-sistema.css')}}" rel="stylesheet">


    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <style>
        .carousel-item {
          transition: transform 2s ease, opacity .5s ease;
        }
      </style>


</head>
<body class="public-body">

    <!--inicio before menu-->
    <div class="before-menu">lOCALIZAÇÃO E CONTACTO</div>
    <!--fim before menu-->
    <!--inicio menu-->

    <nav class="navbar navbar-expand-lg navbar-light menu">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">SOBRE NÓS <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ESPECIALIDADE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">CONVÊNIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">CONTACTO</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--fim menu-->
    <!--Inicio Nossos serviços-->
    <div class="row slide-servico" >

    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
          <img src="{{asset('imagens/fundo00.jpg')}}" class="d-block w-75" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
      <div class="slide-servico1" style="margin-left: 260px">

<h3 class="slide-servico1-titulo">Medicamentos</h3>
<p class="descricao-slide-servico"><br>Consulte informações sobre medicamentos precritos pelo seu médico
</p>
<p><button type="button" class="btn btn-default botao-slide-servico">Ler mais</button></p>

</div>
<div class="slide-servico1" style="background-color: #23B979;">

<h3 class="slide-servico1-titulo">Medicamentos2</h3>
<p class="descricao-slide-servico"><br>Consulte informações sobre medicamentos precritos pelo seu médico
</p>
<p><button type="button" class="btn btn-default botao-slide-servico">Ler mais</button></p>

</div>
<div class="slide-servico1" style="background-color: #1B7B51;">

<h3 class="slide-servico1-titulo">Medicamentos3</h3>
<p class="descricao-slide-servico"><br>Consulte informações sobre medicamentos precritos pelo seu médico
</p>
<p><button type="button" class="btn btn-default botao-slide-servico">Ler mais</button></p>

</div>
      </div>
    </div>
    <div class="carousel-item">
    <img src="{{asset('imagens/fundo00.jpg')}} " class="d-block w-75" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
      <div class="slide-servico1" style="margin-left: 260px">

<h3 class="slide-servico1-titulo">Medicamentos</h3>
<p class="descricao-slide-servico"><br>Consulte informações sobre medicamentos precritos pelo seu médico
</p>
<p><button type="button" class="btn btn-default botao-slide-servico">Ler mais</button></p>

</div>
<div class="slide-servico1" style="background-color: #23B979;">

<h3 class="slide-servico1-titulo">Medicamentos2</h3>
<p class="descricao-slide-servico"><br>Consulte informações sobre medicamentos precritos pelo seu médico
</p>
<p><button type="button" class="btn btn-default botao-slide-servico">Ler mais</button></p>

</div>
<div class="slide-servico1" style="background-color: #1B7B51;">

<h3 class="slide-servico1-titulo">Medicamentos3</h3>
<p class="descricao-slide-servico"><br>Consulte informações sobre medicamentos precritos pelo seu médico
</p>
<p><button type="button" class="btn btn-default botao-slide-servico">Ler mais</button></p>

</div>
      </div>
    </div>
    <div class="carousel-item">
    <img src="{{asset('imagens/fundo00.jpg')}} " class="d-block w-75" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
      <div class="slide-servico1" style="margin-left: 260px">

<h3 class="slide-servico1-titulo">Medicamentos</h3>
<p class="descricao-slide-servico"><br>Consulte informações sobre medicamentos precritos pelo seu médico
</p>
<p><button type="button" class="btn btn-default botao-slide-servico">Ler mais</button></p>

</div>
<div class="slide-servico1" style="background-color: #23B979;">

<h3 class="slide-servico1-titulo">Medicamentos2</h3>
<p class="descricao-slide-servico"><br>Consulte informações sobre medicamentos precritos pelo seu médico
</p>
<p><button type="button" class="btn btn-default botao-slide-servico">Ler mais</button></p>

</div>
<div class="slide-servico1" style="background-color: #1B7B51;">

<h3 class="slide-servico1-titulo">Medicamentos3</h3>
<p class="descricao-slide-servico"><br>Consulte informações sobre medicamentos precritos pelo seu médico
</p>
<p><button type="button" class="btn btn-default botao-slide-servico">Ler mais</button></p>

</div>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



    </div>
    <!--Fim Nossos serviços-->

    <!--Inicio div Agendar consulta-->
    <div class="row">
        <div class="col-md-12 card-agendar" style="background-color: #9155A7; padding-top: 10px;">
            <div class="col-md-12 conteudo " style="background-color: #9155A7; padding-bottom: 10px; padding-top: 5px;">
                <p class="col-md-10 slide-servico1-titulo" style="font-size: 24px; font-weight: 400;">»Agende a sua
                    consulta online</p>
                <p class=" btn btn-default" style=" background-color: #7C5193; color: white; margin-right: 75px;">Ler
                    mais</p>

            </div>

        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <p class="col-md-10 slide-servico2-titulo" style="font-size: 24px; font-weight: 750; color: #33BB81;">Cuide bem
            da sua saúde</p>
    </div>
    <!--fim div Agendar consulta-->
    <br>
    <br>
    <div class="outros-servicos">

        <div class="desc-outros-servicos">
            <div class="outros-servicos1">


                <img src="{{asset('imagens/avatar1.png')}}" alt="Avatar" class="avatar">
                <h3 class="titulo-servico1">Medicamentos</h3>
                <p class="descricao-slide-servico desc"><br>Consulte informações sobre medicamentos precritos pelo seu
                    médico
                </p>
                <p><a class=" botao-outro-servico" href="#">» Saber mais</a></p>

            </div>

            <div class="outros-servicos1">


                <img src="{{asset('imagens/avatar2.png')}}" alt="Avatar" class="avatar">
                <h3 class="titulo-servico1">Medicamentos</h3>
                <p class="descricao-slide-servico desc"><br>Consulte informações sobre medicamentos precritos pelo seu
                    médico
                </p>
                <p><a class=" botao-outro-servico" href="#">» Saber mais</a></p>

            </div>

            <div class="outros-servicos1">


                <img src="{{asset('imagens/avatar3.png')}}" alt="Avatar" class="avatar">
                <h3 class="titulo-servico1">Medicamentos</h3>
                <p class="descricao-slide-servico desc"><br>Consulte informações sobre medicamentos precritos pelo seu
                    médico
                </p>
                <p><a class=" botao-outro-servico" href="#">» Saber mais</a></p>

            </div>
        </div>


    </div>

    <br>
    <br>
    <div class="row">

        <div class="newsletter">
            <br>
            <br>
            <p class=" slide-servico2-titulo" style="font-size: 24px; font-weight: 750; color: #33BB81;">Receba nossa
                newsletter</p>
            <p class=" slide-servico2-titulo">Sou um subtítulo. Clique aqui para editar e contar aos seus clientes um
                pouco sobre você.</p>
            <br>
            <div class=" formulario">
                <form class="searchform">

                    <input type="search" id="search-box" placeholder="Insira o seu email  aqui!" />

                    <button type="button" class="btn btn-lg btnnewsletter">Enviar</button>
                </form>

            </div>

        </div>



        <div class="rodape">
            <div class="col-md-5 texto-rodape">
                <p>@ 2022 Por Sua Empresa. Todos os direitos reservados a Programador</p>
                <p><i class="fa fa-map-marker" aria-hidden="true"></i> Bairro do 70, Rua nº 01 - Benguela, BG | <i
                        class="fa fa-phone" aria-hidden="true"></i> 900
                    000 000/ 900 000 000</p>
            </div>
            <div class="col-md-2 texto-rodape">
                <p> <i class="fa fa-instagram fa-2x" style="padding: 8px;" aria-hidden="true"></i>
                    <i class="fa fa-facebook-square fa-2x" style="padding: 8px;" aria-hidden="true"></i>
                    <i class="fa fa-twitter-square fa-2x" style="padding: 8px;" aria-hidden="true"></i>
                </p>
            </div>

        </div>
    </div>




</body>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script>
            $(function() {
              var t0, t1;

              // Test to show that the carousel doesn't slide when the current tab isn't visible
              // Test to show that transition-duration can be changed with css
              $('#carousel-example-generic').on('slid.bs.carousel', function(event) {
                t1 = performance.now()
                console.log('transition-duration took' + (t1 - t0) + 'ms, slid at ', event.timeStamp)
              }).on('slide.bs.carousel', function() {
                t0 = performance.now()
              })
            })
          </script>
</html>
