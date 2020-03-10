@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-2 mb-1">
            <h2 align="center"><i class="fa fa-money"></i> Balance : <strong>Rp. {{ number_format($data->balance) }}</strong> </h2>
        </div>
        <div class="col-md-12 mb-2">
            <a href="{{ url('home') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Detail Account</div>

                <div class="card-body row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td width="250">Account Number</td>
                                    <td width="10">:</td>
                                    <td> {{ $data->account }}</td>
                                    <td width="250">Status</td>
                                    <td width="10">:</td>
                                    <td>
                                        @if($data->status == 1)
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                        @else
                                        <span class="badge badge-success">Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td> {{ $data->name }}</td>
                                    <td>Point</td>
                                    <td>:</td>
                                    <td> {{ number_format($data->point) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('transaction/balance') }}/{{ $data->account }}" class="btn btn-primary btn-block"><i class="fa fa-money"></i> Add Balance</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('transaction/transfer') }}/{{ $data->account }}" class="btn btn-primary btn-block"><i class="fa fa-handshake-o"></i> Transfer</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('transaction/pulsa') }}/{{ $data->account }}" class="btn btn-primary btn-block"><i class="fa fa-phone"></i> Buy Pulsa</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('transaction/point') }}/{{ $data->account }}" class="btn btn-primary btn-block"><i class="fa fa-money"></i> Change Point</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Transaksi -->
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    Detail Transaction : {{ $date }}
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Transaction Date</th>
                                <th scope="col">Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Ammount</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <th scope="row">{{ $transaction->id }}</th>
                                <td> {{ $transaction->transactionDate }}</td>
                                <td>{{ $transaction->type }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td>{{ $transaction->from }}</td>
                                <td>{{ $transaction->to }}</td>
                                <td align="right">Rp. {{ number_format($transaction->amount) }}</td>
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
