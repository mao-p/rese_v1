@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">会員登録ありがとうございます。</h1>
            <a href="{{ route('login') }}" class="btn btn-primary">ログインする</a>
        </div>
    </div>
</div>
@endsection


