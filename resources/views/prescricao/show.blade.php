@extends('layouts.starter')
@section('title', 'Prescrição de medicamento')

@include ('layouts.sidebar')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Medicamentos prescrito</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Medicamentos prescrito</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">



            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4 class="page-header">
                    <i class="brand-link">
                        <img src="{{asset('img/favicon.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-1"
                             style="opacity: .8">

                      </i>
                    <small class="float-right">Date: {{$prescricao->created_at}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">

                  <address>
                    <strong>Clinica  29 de Novembro</strong><br>
                    Bairro 70  <br>
                    Benguela, Angola<br>
                    Telefone: +244 920 000 000<br>
                    Email: info@gmail.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Paciente
                  <address>
                    <strong>{{$prescricao->prontuario->paciente->user->dadosPessoais->nome}}</strong><br>
                    {{$prescricao->prontuario->paciente->user->dadosPessoais->bairro}}<br>
                    {{$prescricao->prontuario->paciente->user->dadosPessoais->municipio}},
                    {{$prescricao->prontuario->paciente->user->dadosPessoais->provincia}}<br>
                    Phone: {{$prescricao->prontuario->paciente->user->dadosPessoais->telefone}}<br>
                    Email: {{$prescricao->prontuario->paciente->user->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Receita #00{{$prescricao->id}}</b><br>
                  <br>

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>medicamento</th>
                      <th>apresentação</th>
                      <th>Unidade</th>
                      <th>Valor</th>
                      <th>posologia</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($prescricao->medicamentos as $item)
                    <tr>
                        <td>{{ $item->nome_medicamento }}</td>
                        <td>{{ $item->apresentacao }}</td>
                        <td>{{ $item->unidade }}</td>
                        <td>{{ $item->valor }}</td>
                        <td>{{ $item->posologia }}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Obeservação:</p>

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    {{$prescricao->descricao}}
                  </p>
                </div>
                <!-- /.col -->

                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="{{ route('prescricao.print', ['id'=>$prescricao->id]) }}" target="_blank" class="btn  float-right btn-success"><i class="fas fa-print"></i> imprimir</a>
                 <a href="{{ route('prescricao.pdf', ['id'=>$prescricao->id]) }}" class="btn btn-primary float-right" style="margin-right: 5px;" > <i class="fas fa-download"></i>PDF</a>

                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    @endsection
    @include ('layouts.datatable')
    @section('script')
    @parent
    @endsection
