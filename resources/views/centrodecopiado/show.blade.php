@extends('layouts.app')

@section('content')

<div style="">
  <div class="row">
    <div style="" class = "col-lg-12 col-md-12 col-sm-12">



      <table style="width:100%">
      <tr>
        <th>numero de trabajo</th>
        <th>Dueno</th>


      </tr>

      @foreach ($centroDeCopiado->trabajos()->get() as $trabajo)

        <tr>

          <td> {{ $trabajo->id }} </td>
          <td> {{ $trabajo->id }} </td>

          <td>
            {!! Form::open(['route' => ['trabajos.show', $trabajo->id ], 'method' => 'GET', 'files' => false])!!}

                 {!! Form::submit('VER TRABAJO', ['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-button--colored'])!!}

            {!! Form::close() !!}

          </td>

        </tr>

      @endforeach

      </table>




    </div>
  </div>
</div>


@endsection
