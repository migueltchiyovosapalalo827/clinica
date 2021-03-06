@extends('layouts.starter')
@section('title', 'Receita')

@section('content')
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4 class="page-header">
              <i class="brand-link">
                  <img src="{{asset('img/favicon.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-1"
                       style="opacity: .8">

                </i>
              <small class="float-right">Date: {{$medicamentos->prescricao->created_at}}</small>
            </h4>
          </div>
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
              <th>apresenta????o</th>
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
          <p class="lead">Obeserva????o:</p>

          <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
            {{$prescricao->descricao}}
          </p>
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</section>
@endsection
@section('script')
@parent

@endsection
