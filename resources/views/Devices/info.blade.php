@component('Components.main')
    @slot('title')
       Informacion del dispositivo
    @endslot
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-device-tab" data-toggle="pill" href="#v-pills-device" role="tab" aria-controls="v-pills-device" aria-selected="true">Dispositivo</a>
                <a class="nav-link" id="v-pills-customer-tab" data-toggle="pill" href="#v-pills-customer" role="tab" aria-controls="v-pills-customer" aria-selected="false">Cliente</a>
                <a class="nav-link" id="v-pills-technician-tab" data-toggle="pill" href="#v-pills-technician" role="tab" aria-controls="v-pills-technician" aria-selected="false">Técnico</a>
                <a class="nav-link" id="v-pills-maintenance-tab" data-toggle="pill" href="#v-pills-maintenance" role="tab" aria-controls="v-pills-maintenance" aria-selected="false">Servicios</a>
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-device" role="tabpanel" aria-labelledby="v-pills-device-tab">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th>Descripción</th>
                            <td>{{ $device->description }}</td>
                        </tr>
                        <tr>
                            <th>Estado</th>
                            <td><span class="badge badge-pill badge-{{ config('status.'.$device->status) }}">{{ $device->status }}</span></td>
                        </tr>
                        <tr>
                            <th>Fecha de entrada</th>
                            <td>{{ $device->entry_date }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de salida</th>
                            <td>{{ !empty($device->departure_date) ? $device->departure_date: '--' }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="v-pills-customer" role="tabpanel" aria-labelledby="v-pills-customer-tab">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th>Nombre del cliente</th>
                            <td>{{ $device->customer->name }}</td>
                        </tr>
                        <tr>
                            <th>Apellido del cliente</th>
                            <td>{{ $device->customer->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Número de identificación</th>
                            <td>{{ $device->customer->id_number }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="v-pills-technician" role="tabpanel" aria-labelledby="v-pills-technician-tab">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th>Nombre del Técnico</th>
                            <td>{{ is_null($device->user) ? 'Sin asignar' : $device->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Apellido del Técnico</th>
                            <td>{{ is_null($device->user) ? '--' : $device->user->last_name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="v-pills-maintenance" role="tabpanel" aria-labelledby="v-pills-maintenance-tab">
                    @if($device->maintenances->isEmpty()))
                    <h4> No tiene mantenimientos asignados </h4>
                    @else
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Tipo de Mantenimiento</th>
                            <th>Precio</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($device->maintenances as $maintenance)
                            <tr>
                                <th>{{ $maintenance->id }}</th>
                                <td>{{ $maintenance->name }}</td>
                                <td>{{ $maintenance->price }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('dispositivos.index') }}" class="btn btn-secondary">
        <i class="fas fa-undo"></i> Regresar
    </a>
@endcomponent
