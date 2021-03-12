@extends('layouts.app')

@section('content')

<div style="text-align:left;">
  <div class="row">
    <div style="position: block; margin:0 auto;" class = "col-lg-6 col-md-6 col-sm-6">

      {!! Form::open(['route' => 'centrodecopiado.store', 'method' => 'POST', 'files' => false])!!}

        <div class="row" style="">
          <div style="position: block; margin:0 auto;" class = "col-lg-12 col-md-12 col-sm-12">
            <div class = "form-group">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                <input class="mdl-textfield__input" type="text" id="detalle" name="nombre_del_punto_de_fotocopiado" minlength="2" data-required>
                <label class="mdl-textfield__label" for="nombre">Nombre del centro</label>
              </div>
            </div>
          </div>
        </div>

        <div class="row" style="">
          <div style="position: block; margin:0 auto;" class = "col-lg-12 col-md-12 col-sm-12">
            <div class = "form-group">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                <input class="mdl-textfield__input" type="text" id="detalle" name="direccion" data-required>
                <label class="mdl-textfield__label" for="nombre">Direccion</label>
              </div>
            </div>
          </div>
        </div>

        <div class="row" style="">
          <div style="position: block; margin:0 auto;" class = "col-lg-12 col-md-12 col-sm-12">
            <div class = "form-group">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                <input class="mdl-textfield__input" type="text" id="detalle" name="nombre_proprietario" minlength="1" data-required>
                <label class="mdl-textfield__label" for="nombre">nombre del proprietario</label>
              </div>
            </div>
          </div>
        </div>

        <div class="row" style="">
          <div style="position: block; margin:0 auto;" class = "col-lg-12 col-md-12 col-sm-12">
            <div class = "form-group">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                <input class="mdl-textfield__input" type="text" id="detalle" name="email_proprietario" minlength="1" data-required>
                <label class="mdl-textfield__label" for="nombre">email del proprietario</label>
              </div>
            </div>
          </div>
        </div>


        {!! Form::submit('Guardar', ['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-button--colored'])!!}

      {!! Form::close() !!}
    </div>

  </div>
</div>


@endsection
