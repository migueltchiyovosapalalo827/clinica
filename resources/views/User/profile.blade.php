@extends('layouts.starter')
@section('title', 'Usuarios')

@include ('layouts.sidebar')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perfil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Perfil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">
<div class="row">
    <div class="col-md-6">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{asset('dist/img/avatar.png')}}"
                        alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{$user->name}}</h3>
                <p class="text-muted text-center"><i class="far fa-fw fa-envelope"></i>{{$user->email}}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>{{'Nacionalidade :'}}</b>
                        <a class="float-right">
                        {{ $user->dadosPessoais->nacionalidade }}
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>{{'Data de Nascimento :'}}</b>
                        <a class="float-right">
                        {{ $user->dadosPessoais->data_nasc }}
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>{{'Bi numero :'}}</b>
                        <a class="float-right">
                        {{ $user->dadosPessoais->bi }}
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>{{'Sexo :'}}</b>
                        <a class="float-right">
                        {{ $user->dadosPessoais->sexo }}
                        </a>
                    </li>
                </ul>
            </div>


            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->

                <!-- /.col -->
                <div class="col-md-6">
        <div class="card card-outline">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Endereços / contactos</a></li>
                    <li class="nav-item"><a class="nav-link " href="#info" data-toggle="tab">informação profissional</a></li>

                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="tab-pane active" id="settings">
                    <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>{{'Provincia :'}}</b>
                        <a class="float-right">
                        {{ $user->dadosPessoais->provincia }}
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>{{'Municipio:'}}</b>
                        <a class="float-right">
                        {{ $user->dadosPessoais->municipio }}
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>{{'Bairro :'}}</b>
                        <a class="float-right">
                        {{ $user->dadosPessoais->bairro }}
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>{{'Telefone :'}}</b>
                        <a class="float-right">
                        {{ $user->dadosPessoais->telefone }}
                        </a>
                    </li>

                    <li class="list-group-item">
                        <b>{{'Telefone secundario :'}}</b>
                        <a class="float-right">
                        {{ $user->dadosPessoais->telefone_secundario }}
                        </a>
                    </li>
                </ul>
                    </div>


                    <div class="tab-pane " id="info">
                        @if ( is_null($user->funcionario))

                        @else
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>{{'Profissão :'}}</b>
                                <a class="float-right">
                                {{ $user->funcionario->dadosProfissionais->profissao }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>{{'Especialidade :'}}</b>
                                <a class="float-right">
                                {{ $user->funcionario->dadosProfissionais->especialidade }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>{{'Tipo conselho :'}}</b>
                                <a class="float-right">
                                {{  $user->funcionario->dadosProfissionais->tipo_conselho }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>{{'numero registro :'}}</b>
                                <a class="float-right">
                                {{  $user->funcionario->dadosProfissionais->numero_registro }}
                                </a>
                            </li>
                        </ul>
                        @endif

                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
</section>
@endsection
