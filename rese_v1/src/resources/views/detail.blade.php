@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="back-link d-flex align-items-center mb-3">
                <form action="{{ session('previous_url', url()->previous()) }}" method="GET" class="d-inline">
                    <button type="submit" class="btn btn-outline-secondary btn-sm">
                        <span class="fas fa-arrow-left"></span>
                    </button>
                </form>
                <h1 class="mb-0 ms-3" style="font-size: 1rem;">{{ $restaurant->name }}</h1>
            </div>
            <img src="{{ asset($restaurant->image) }}" alt="{{ $restaurant->name }}" class="img-fluid">
            <p>{{ $restaurant->description }}</p>

            <!-- 画像アップロードフォーム -->
            <form action="{{ route('images.upload.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="form-group">
                    <label for="image">お店の画像アップロード</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">アップロード</button>
                </div>
            </form>

            <!-- フラッシュメッセージ -->
            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <div class="col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">予約</h5>
                    <form action="{{ route('reservations.store') }}" method="POST" novalidate class="rounded-form">
                        @csrf
                        <div class="form-group">
                            <label for="reservation_date"></label>
                            <input type="date" class="form-control form-control-no-border" id="reservation_date" name="reservation_date" value="{{ old('reservation_date', session('reservation_data.reservation_date')) }}" required>
                            @if ($errors->has('reservation_date'))
                                <span class="text-danger">{{ $errors->first('reservation_date') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="reservation_time"></label>
                            <select class="form-control form-control-no-border" id="reservation_time" name="reservation_time" required>
                                <option value="">-- 選択してください --</option>
                                @for ($i = 0; $i < 24; $i++)
                                    @for ($j = 0; $j < 60; $j += 30)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}" {{ old('reservation_time', session('reservation_data.reservation_time')) == str_pad($i, 2, '0', STR_PAD_LEFT) . ':' . str_pad($j, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}
                                        </option>
                                    @endfor
                                @endfor
                            </select>
                            @if ($errors->has('reservation_time'))
                                <span class="text-danger">{{ $errors->first('reservation_time') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="party_size"></label>
                            <select class="form-control form-control-no-border" id="party_size" name="party_size" required>
                                <option value="">-- 選択してください --</option>
                                @for ($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}" {{ old('party_size', session('reservation_data.party_size')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @if ($errors->has('party_size'))
                                <span class="text-danger">{{ $errors->first('party_size') }}</span>
                            @endif
                        </div>
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

                        <!-- 予約確認カード -->
                        <div id="reservation-confirmation" class="card mt-4 card-confirmation" style="display: none; border-radius: 25px; background-color: #339af0; color: white;">
                            <div class="card-body">
                                <p>shop: <strong>{{ $restaurant->name }}</strong></p>
                                <p>date: <strong id="confirm-date"></strong></p>
                                <p>time: <strong id="confirm-time"></strong></p>
                                <p>member: <strong id="confirm-party-size"></strong></p>
                            </div>
                        </div>

                        <!-- 予約ボタン -->
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary btn-primary-custom">予約する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('reservation_date');
    const timeInput = document.getElementById('reservation_time');
    const partySizeInput = document.getElementById('party_size');
    const confirmationCard = document.getElementById('reservation-confirmation');
    const confirmDate = document.getElementById('confirm-date');
    const confirmTime = document.getElementById('confirm-time');
    const confirmPartySize = document.getElementById('confirm-party-size');

    function updateConfirmation() {
        confirmDate.textContent = dateInput.value;
        confirmTime.textContent = timeInput.value;
        confirmPartySize.textContent = partySizeInput.value;

        if (dateInput.value && timeInput.value && partySizeInput.value) {
            confirmationCard.style.display = 'block';
        } else {
            confirmationCard.style.display = 'none';
        }
    }

    dateInput.addEventListener('input', updateConfirmation);
    timeInput.addEventListener('input', updateConfirmation);
    partySizeInput.addEventListener('input', updateConfirmation);

    // 初期表示の更新
    updateConfirmation();
});
</script>
@endsection
