@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-2 mb-3">
            <h2 align="center"><i class="fa fa-bank"></i> e-Wallet Application</h2>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">List Account</div>

                <div class="card-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Account Number</th>
                                <th scope="col">Name</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Point</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                            <tr>
                                <th scope="row">{{ $data->id }}</th>
                                <td> {{ $data->account }}</td>
                                <td>{{ $data->name }}</td>
                                <td>Rp. {{ number_format($data->balance) }}</td>
                                <td>{{ number_format($data->point) }}</td>
                                <td>
                                    @if($data->status == 1)
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    @else
                                    <span class="badge badge-success">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                <a href="{{ url('account') }}/{{ $data->account }}" class="btn btn-sm btn-info text-light"><i class="fa fa-info"></i> Detail</a>
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
