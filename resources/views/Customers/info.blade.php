@component('Components.main')
    @slot('title')
        Información del cliente
    @endslot

    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-customer-tab" data-toggle="pill" href="#v-pills-customer" role="tab" aria-controls="v-pills-customer" aria-selected="true">Cliente</a>
                <a class="nav-link" id="v-pills-device-tab" data-toggle="pill" href="#v-pills-device" role="tab" aria-controls="v-pills-device" aria-selected="false">Dispositivos</a>
                <a class="nav-link" id="v-pills-technician-tab" data-toggle="pill" href="#v-pills-technician" role="tab" aria-controls="v-pills-technician" aria-selected="false">Atendido por</a>
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-customer" role="tabpanel" aria-labelledby="v-pills-customer-tab">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $customer->name }}</td>
                        </tr>
                        <tr>
                            <th>Apellido</th>
                            <td>{{ $customer->last_name }}</td>
                        </tr>
                        <tr>
                            <th># identificación</th>
                            <td>{{ $customer->id_number }}</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>{{ $customer->email }}</td>
                        </tr>
                        <tr>
                            <th>Dirección</th>
                            <td>{{ $customer->address }}</td>
                        </tr>
                        <tr>
                            <th>Teléfono</th>
                            <td>{{ $customer->phone }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="v-pills-device" role="tabpanel" aria-labelledby="v-pills-device-tab">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Tipos de mantnimientos</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer->devices as $device)
                            <tr>
                                <td>{{ $device->description }}</td>
                                <td><span class="badge badge-pill badge-{{ config('status.'.$device->status) }}">{{ $device->status }}</span></td>
                                <td>
                                    <ul>
                                        @foreach($device->maintenances as $maintenance)
                                            <li>{{ $maintenance->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="v-pills-technician" role="tabpanel" aria-labelledby="v-pills-technician-tab">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>E-mail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer->devices as $device)
                            <tr>
                                <th>{{ $device->user->name }}</th>
                                <td>{{ $device->user->last_name }}</td>
                                <td>{{ $device->user->email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
        <i class="fas fa-undo"></i> Regresar
    </a>
@endcomponent
