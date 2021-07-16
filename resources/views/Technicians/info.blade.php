@inject('customers', 'App\Services\Customers')
@component('Components.main')
    @slot('title')
        Información del tecnico
    @endslot

    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-tech-tab" data-toggle="pill" href="#v-pills-tech" role="tab" aria-controls="v-pills-tech" aria-selected="true">Tecnico</a>
                <a class="nav-link" id="v-pills-device-tab" data-toggle="pill" href="#v-pills-device" role="tab" aria-controls="v-pills-device" aria-selected="false">Dispositivos</a>
                <a class="nav-link" id="v-pills-customers-tab" data-toggle="pill" href="#v-pills-customers" role="tab" aria-controls="v-pills-customers" aria-selected="false"> Clientes atendidos</a>
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-tech" role="tabpanel" aria-labelledby="v-pills-tech-tab">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $technician->name }}</td>
                        </tr>
                        <tr>
                            <th>Apellido</th>
                            <td>{{ $technician->last_name }}</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>{{ $technician->email }}</td>
                        </tr>
                        <tr>
                            <th>Avatar</th>
                            <td>
                                @if($technician->avatar == 'default')
                                    <img src="{{ asset('/storage/default.jpg') }}" alt="Avatar" class="img-thumbnail" width="50" height="50">
                                @else
                                    <img src="{{ asset('/storage/avatars/'.$technician->avatar) }}" alt="Avatar" class="img-thumbnail" width="50" height="50">
                                @endif
                            </td>
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
                        @foreach($technician->devices as $device)
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
                <div class="tab-pane fade" id="v-pills-customers" role="tabpanel" aria-labelledby="v-pills-customers-tab">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>E-mail</th>
                            <th>Ver mas info</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers->getCustomersFromDevice($technician) as $customer)
                            <tr>
                                <th>{{ $customer->name }}</th>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td><a href="{{ route('clientes.show',[$customer]) }}" target="_blank">Ver cliente</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('tecnicos.index') }}" class="btn btn-secondary">
        <i class="fas fa-undo"></i> Regresar
    </a>
@endcomponent
