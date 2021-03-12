@extends('layouts.app')

@section('content')

<div style="">
  <div class="row">
    <div style="" class = "col-lg-12 col-md-12 col-sm-12">



      <table style="width:100%">
      <tr>
        <th>Nombre del centro de copiado</th>
        <th>Dueno</th>


      </tr>

      @foreach ($centrosDeCopiado as $centroDeCopiado)

        <tr>

          <td> {{ $centroDeCopiado->nombre_del_punto_de_fotocopiado }} </td>
          <td> {{ $centroDeCopiado->dueno()->name  }} </td>

          <td>
            {!! Form::open(['route' => ['centrodecopiado.show', $centroDeCopiado->id ], 'method' => 'GET', 'files' => false])!!}

                 {!! Form::submit('VER CENTRO', ['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-button--colored'])!!}

            {!! Form::close() !!}

          </td>

        </tr>

      @endforeach

      </table>

      <br>

      {!! Form::open(['route' => 'centrodecopiado.create', 'method' => 'GET', 'files' => false])!!}

        {!! Form::submit('CREAR CENTRO', ['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-button--colored'])!!}
      {!! Form::close() !!}
    </div>
  </div>
</div>


@endsection
