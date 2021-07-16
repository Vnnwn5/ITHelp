{!! Form::model(request()->all(), ['route' => 'tecnicos.index', 'method' => 'GET', 'class' => 'form-inline']) !!}

    {!! Form::label('tech_data', ' Dato del tecnico ', ['class' => 'mr-sm-2']) !!}
    {!! Form::text('tech_data', null, [
        'placeholder' => 'Ingresa el nombre, apellido o email',
        'class' => 'form-control mr-sm-2 col-md-4']);
    !!}

    <button type="submit" class="btn btn-primary mr-sm-2">
        <i class="fas fa-search"></i> Filtrar
    </button>
    <a href="{{ route('tecnicos.index') }}" class="btn btn-dark">
        <i class="fas fa-sync-alt"></i> Reiniciar
</a>
{!! Form::close() !!}<br>
