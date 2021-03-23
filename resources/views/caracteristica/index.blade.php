@extends('layouts.app')

@section('content')

<div style="">
  <div class="row">
    <div style="" class = "col-lg-12 col-md-12 col-sm-12">



      <table style="width:100%">
      <tr>
        <th>detalle</th>
        <th>valor</th>
        <th>imprenta</th>
        <th>borrar</th>

      </tr>

      @foreach ($caracteristicas as $caracteristica)

        <tr>

          <td> {{ $caracteristica->detalle }} </td>
          <td> {{ $caracteristica->precio  }} </td>



          <td>
            <ul>

              @foreach ($caracteristica->centrosDeCopiado()->get() as $centroDeCopiado)
              <li>{{$centroDeCopiado->nombre_del_punto_de_fotocopiado}}</li>
              @endforeach
            </ul>


          </td>



          <td>
            {!! Form::open(['route' => ['caracteristicas.destroy', $caracteristica->id ], 'method' => 'DELETE', 'files' => false])!!}

                 {!! Form::submit('borrar', ['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-button--colored'])!!}

            {!! Form::close() !!}

          </td>



        </tr>

      @endforeach

      </table>

      <br>

      {!! Form::open(['route' => 'caracteristicas.store', 'method' => 'POST', 'files' => false])!!}

        <div class="row" style="">
          <div style="position: block; margin:0 auto;" class = "">
            <div class = "form-group">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="detalle" minlength="1" data-required>
                <label class="mdl-textfield__label" for="nombre">detalle</label>

                <input class="mdl-textfield__input" type="text" name="precio" minlength="1" data-required>
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
