@extends('layouts.app')

@section('content')

<div style="">
  <div class="row">
    <div style="" class = "col-lg-12 col-md-12 col-sm-12">



      <table style="width:100%">
      <tr>
        <th>numero de paginas</th>
        <th>valor</th>
        <th>imprentas</th>
        <th>borrar</th>

      </tr>

      @foreach ($precios as $precio)

        <tr>

          <td> {{ $precio->numero_de_impresiones }} </td>
          <td> {{ $precio->precio  }} </td>

          <td>
            <ul>

              @foreach ($precio->centrosDeCopiado()->get() as $centroDeCopiado)
              <li>{{$centroDeCopiado->nombre_del_punto_de_fotocopiado}}</li>
              @endforeach
            </ul>
          </td>

          <td>
            {!! Form::open(['route' => ['precios.destroy', $precio->id ], 'method' => 'DELETE', 'files' => false])!!}

                 {!! Form::submit('borrar', ['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-button--colored'])!!}

            {!! Form::close() !!}

          </td>
        </tr>

      @endforeach

      </table>

      <br>

      {!! Form::open(['route' => 'precios.store', 'method' => 'POST', 'files' => false])!!}

        <div class="row" style="">
          <div style="position: block; margin:0 auto;" class = "">
            <div class = "form-group">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="detalle" name="numero_de_impresiones" minlength="1" data-required>
                <label class="mdl-textfield__label" for="nombre">numero de paginanas a imprimir</label>

                <input class="mdl-textfield__input" type="text" id="detalle" name="precio" minlength="1" data-required>
                <label class="mdl-textfield__label" for="nombre">Precio</label>

                <ul>

                  @foreach ($centrosDeCopiado as $centroDeCopiado)

                    <li>

                      <input type="checkbox" name="imprentas[]" value="{{$centroDeCopiado->id}}" />
                      <label class="mdl-textfield__label" for="nombre">{{$centroDeCopiado->nombre_del_punto_de_fotocopiado}}</label>
                    </li>
                  @endforeach
                </ul>

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
