@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>予約内容を変更する</h2>
        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="reservation_date">予約日</label>
                <input type="date" class="form-control" id="reservation_date" name="reservation_date" value="{{ $reservation->reservation_date }}" required>
            </div>
            <div class="form-group">
                <label for="reservation_time">予約時間</label>
                <input type="time" class="form-control" id="reservation_time" name="reservation_time" value="{{ $reservation->reservation_time }}" required>
            </div>
            <div class="form-group">
                <label for="party_size">人数</label>
                <input type="number" class="form-control" id="party_size" name="party_size" value="{{ $reservation->party_size }}" required>
            </div>
            <button type="submit" class="btn btn-primary">変更を保存する</button>
        </form>
    </div>
@endsection
