@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-2 mb-1 text-center">
            <h2><i class="fa fa-money"></i> Add Balance</h2>
            <h5>{{ $data->name }} Balance : <strong>Rp. {{ number_format($data->balance) }}</strong></h5>
        </div>
        <div class="col-md-12 mb-2">
            <a href="{{ url('account') }}/{{ $data->account }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
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
                                    <td> {{ $data->point }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    Add Balance
                </div>
                <div class="card-body">
                    <form action="{{ url('transaction/balance') }}/{{ $data->account }}" method="post">
                        @csrf

                        <div class="form-group row">
                            <label for="ammount" class="col-md-4 col-form-label text-md-right">Add Balance (Rp.)</label>

                            <div class="col-md-6">
                                <input id="ammount" type="ammount" class="form-control @error('ammount') is-invalid @enderror" name="ammount" value="{{ old('ammount') }}" required autocomplete="ammount" autofocus>

                                @error('ammount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection