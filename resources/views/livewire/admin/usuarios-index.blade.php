<div>
        <div class="card">
            <div class="card-header">
                <input wire:model="search" placeholder="Ingrese el nombre o correo del usuario" class="form-control">
            </div>
            @if ($users->count())
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Rol</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->telefono}}</td>
                                    <td>{{$user->roles->first()->name}}</td>
                                    <td width="10px">
                                        @livewire('admin.usuarios-edit', ['usuario' => $user],key($user->id))
                                        {{-- <a href="#" class="btn btn-info btn-sm"><i class="fas fa-user-edit"></i></a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$users->links()}}
                </div>
            @else
                 <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
                
        </div>
</div>

