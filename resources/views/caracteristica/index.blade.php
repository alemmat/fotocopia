@extends('layouts.app')

@section('content')

<div style="text-align:center;">
  <div class="row">
    <div style="position: block; margin:0 auto;" class = "col-lg-8 col-md-8 col-sm-8">

      {!! Form::open(['route' => 'caracteristicas.store', 'method' => 'POST', 'files' => false])!!}

        <div class="row" style="">
          <div style="position: block; margin:0 auto;" class = "col-lg-6 col-md-6 col-sm-6">
            <div class = "form-group">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="detalle" name="detalle" minlength="2" data-required>
                <label class="mdl-textfield__label" for="nombre"></label>
              </div>
            </div>
          </div>
        </div>

        {!! Form::submit('Guardar', ['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-button--colored'])!!}

      {!! Form::close() !!}

      <table style="width:100%">
      <tr>
        <th>Detalle</th>

      </tr>

      @foreach ($caracteristicas as $caracteristica)

        <tr>

          <td> {{ $caracteristica->detalle }} </td>

        </tr>

      @endforeach

      </table>
    </div>
  </div>
</div>


@endsection
