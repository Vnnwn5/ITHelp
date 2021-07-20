@inject('customers','App\Services\Customers')
@inject('technicians', 'App\Services\Technicians')
@inject('maintenances', 'App\Services\Maintenances')
@inject('status', 'App\Services\Status')

@component('Components.main')

    @slot('title')
        {{ !empty($device) ? 'Editar ' : 'Crear ' }} Dispositivo
    @endslot

    @if(!empty($device))
        {!! Form::model($device, ['route' => ['dispositivos.update', $device->id], 'method' => 'put']) !!}
    @else
        {!! Form::open(['route' => 'dispositivos.store', 'method' =>'post']) !!}
    @endif
        <div class="form-group">
            {!!Form::label('customer_id','cliente') !!}
            {!! Form::select('customer_id', $customers->get(), null, [
            'placeholder' => 'Seleccione un cliente',
            'class'=>'form-control '.(!empty($errors->first('customer_id')) ? 'is-invalid' : '')])
            !!}
            @error('customer_id')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    <div class="form-group">
        @if(auth()->user()->isAdmin())
        {!! Form::label('user_id', 'Técnico') !!}
        {!! Form::select('user_id', $technicians->get(), null, [
            'placeholder' => 'Seleccione un técnico',
            'class' => 'form-control '.(!empty($errors->first('user_id')) ? 'is-invalid' : '')])
        !!}
            @error('user_id')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('maintenance', 'Seleccione los tipos de mantenimientos') !!}
        {!! Form::select('maintenances[]', $maintenances->get(), null, [
            'id' => 'maintenance',
            'class' => 'form-control '.(!empty($errors->first('maintenances')) ? 'is-invalid' : ''),
            'multiple' => true,
            'size' => 10 ])
        !!}
        @error('maintenances')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Descripción') !!}
        {!! Form::textarea('description', null, [
            'placeholder' => 'Ingresa una descripción',
            'class' => 'form-control '.(!empty($errors->first('description')) ? 'is-invalid' : '')]);
        !!}
        @error('description')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>

    @if(!empty($device))
        <div class="form-group">
            {!! Form::label('status', 'Estado del dispositivo') !!}
            {!! Form::select('status', $status->get(), null, [
                'placeholder' => 'Seleccione un Estado',
                'class' => 'form-control '.(!empty($errors->first('status')) ? 'is-invalid' : '')])
            !!}
            @error('status')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    @endif

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>  {{ !empty($device) ? 'Actualizar ' : ' Guardar ' }}
        </button>
        <a href="{{ route('dispositivos.index') }}" class="btn btn-secondary">
            <i class="fas fa-undo"></i> Ir al listado
        </a>
    </div>
    {!! Form::close() !!}
@endcomponent

