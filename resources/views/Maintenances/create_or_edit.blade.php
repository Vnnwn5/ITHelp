@component('Components.main')
    @slot('title')
        {{ !empty($maintenance) ? 'Editar ' : 'Crear ' }} Tipo de mantenimiento
    @endslot

    @if(!empty($maintenance))
        {!! Form::model($maintenance, ['route' => ['mantenimientos.update', $maintenance->id], 'method' => 'put']) !!}
    @else
        {!! Form::open(['route' => 'mantenimientos.store', 'method' => 'post']) !!}
    @endif


    <div class="form-group">
        {!! Form::label('name', 'Nombre') !!}
        {!! Form::text('name', null, [
            'placeholder' => 'Ingresa el nombre del tipo de mantenimiento',
            'class' => 'form-control '.(!empty($errors->first('name')) ? 'is-invalid' : '')]);
        !!}
        @error('name')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('price', 'Precio') !!}
        {!! Form::text('price', null, [
            'placeholder' => 'Ingresa el precio del tipo de mantenimiento',
            'class' => 'form-control '.(!empty($errors->first('price')) ? 'is-invalid' : '')]);
        !!}
        @error('price')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> {{ !empty($maintenance) ? 'Actualizar ' : 'Guardar ' }}
        </button>
        <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">
            <i class="fas fa-undo"></i> Ir al listado
        </a>
    </div>
    {!! Form::close() !!}
@endcomponent
