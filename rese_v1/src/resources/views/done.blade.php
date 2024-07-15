@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reservation Completed') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif



                    <a href="{{ url('/') }}" class="btn btn-primary mt-3">ホームに戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
