@extends('layouts.app')

@section('content')

<div style="">
  <div class="row">
    <div style="" class = "col-lg-12 col-md-12 col-sm-12">



      <table style="width:100%">
      <tr>
        <th>comentarios</th>
        <th>desde</th>
        <th>hasta</th>
        <th>numero de impresiones</th>
        <th>archivo</th>

      </tr>

      @foreach ($trabajo->archivos as $archivo)

        <tr>

          <td> {{ $archivo->comentarios }} </td>
          <td> {{ $archivo->desde  }} </td>
          <td> {{ $archivo->hasta  }} </td>
          <td> {{ $archivo->hasta -  $archivo->desde  }} </td>
          <td> {{ $archivo->nombre  }} </td>

        </tr>

      @endforeach

      </table>


    </div>
  </div>
</div>


@endsection
