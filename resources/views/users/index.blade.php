@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="#" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Agregar Usuario</a>

            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Usuarios</h3>
                </div>
                <div class="card-body">
                    <table id="users" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha de Creación</th>
                                <th style="text-align: right;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td style="text-align: right;">
                                    <a href="{{ route('transactions.show', $user->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Ver Transacciones</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
