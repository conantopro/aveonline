@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('home') }}" class="btn btn-primary mb-3"><i class="fa fa-chevron-left"></i> Volver</a>

            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Transacciones - {{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <table id="users" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Monto</th>
                                <th>Fecha de Creación</th>
                                <th style="text-align: right;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->type }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td style="text-align: right;">
                                    <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Ver Detalle</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Resumen de Cuenta</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 style="font-weight: bold;">Saldo Actual: {{ $balance }}</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success mr-2" data-toggle="modal" data-target="#depositModal"><i class="fa fa-plus"></i> Agregar Depósito</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#withdrawModal"><i class="fa fa-minus"></i> Realizar Retiro</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Deposit Modal -->
        <div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="depositModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="depositModalLabel">Agregar Depósito</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('deposit.store', $user->id) }}" method="POST">
                        @csrf

                        <div class="modal-body">
                            <input type="text" class="form-control" name="amount" placeholder="Monto del Depósito">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        <!-- Withdraw Modal -->
        <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="withdrawModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="withdrawModalLabel">Realizar Retiro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('withdraw.store', $user->id) }}" method="POST">
                        @csrf

                        <div class="modal-body">
                            <input type="text" class="form-control" name="amount" placeholder="Monto del Retiro">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
