@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <div class="container">
        <!-- ユーザーのログイン状況を右側に配置 -->
        <div class="user-info row mb-4 justify-content-end">
            <div class="col-md-3 text-right">
                <p class="user-name">ログイン中: {{ Auth::user()->name }}</p>
            </div>
        </div>

        <!-- 予約状況とお気に入りのタイトルを左寄せで横並びに配置 -->
        <div class="section-titles row mb-4">
            <div class="col-md-6">
                <h2 class="section-title">予約状況</h2>
            </div>
            <div class="col-md-6 text-md-left">
                <h2 class="section-title">お気に入り</h2>
            </div>
        </div>

        <div class="content-row row">
            <!-- 予約一覧セクション -->
            <div class="reservation-section col-md-6 mb-4">
                @if ($reservations->isEmpty())
                    <p>予約はありません。</p>
                @else
                    <div id="accordion">
                        @foreach ($reservations as $key => $reservation)
                            <div class="card mb-4 bg-primary text-white">
                                <div class="card-header d-flex justify-content-between align-items-center" id="heading{{ $key }}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
                                            <i class="fas fa-clock mr-2"></i> 予約番号: {{ $key + 1 }}
                                        </button>
                                    </h5>
                                    <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div id="collapse{{ $key }}" class="collapse" aria-labelledby="heading{{ $key }}" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>予約日: {{ $reservation->reservation_date }}</p>
                                        <p>予約時間: {{ $reservation->reservation_time }}</p>
                                        <p>人数: {{ $reservation->party_size }}</p>
                                        <p>店舗名: {{ $reservation->restaurant->name }}</p>
                                        <form action="{{ route('reservation.delete', $reservation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="custom-delete-button">予約をキャンセルする</button>
                                        </form>
                                        <!-- 予約内容を変更するボタン -->
                                        <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn update-btn-primary">予約内容変更</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- お気に入りセクション -->
            <div class="favorites-section col-md-6 mb-4">
                @if ($favorites->isEmpty())
                    <p>お気に入りの店舗はありません。</p>
                @else
                    <div class="row">
                        @foreach ($favorites as $favorite)
                            <div class="col-12 col-md-6 mb-4">
                                <div class="card favorite-card">
                                    <img src="{{ $favorite->image }}" class="card-img-top" alt="{{ $favorite->name }}">
                                    <div class="card-body favorite-card-body">
                                        <h5 class="card-title favorite-card-title">{{ $favorite->name }}</h5>
                                        <div class="favorite-card-details">
                                            <p class="card-text favorite-card-text">#{{ $favorite->genre }}</p>
                                            <p class="card-text favorite-card-text">#{{ $favorite->area }}</p>
                                        </div>
                                        <div class="favorite-card-actions d-flex justify-content-between">
                                            <a href="{{ route('restaurants.detail', $favorite->id) }}" class="btn btn-primary">詳しく見る</a>
                                            <form action="{{ route('favorite.toggle', $favorite->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="favorite-button">
                                                    @if($favorite->favoritedBy->contains(Auth::user()))
                                                        <i class="fas fa-heart" style="color: red;"></i>
                                                    @else
                                                        <i class="far fa-heart"></i>
                                                    @endif
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>



<!-- JavaScript -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


@endsection
