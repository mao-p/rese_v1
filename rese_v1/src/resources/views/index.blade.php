@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="custom-container">
        <div class="row">
            <div class="col-md-12">

                @if (Auth::check())
                    <p>ログイン中です。テスト中</p>
                @else
                    <p>ログインしていません。</p>
                @endif

                <!-- 検索フォーム -->
                <div class="filters">
                    <form id="searchForm" action="{{ route('restaurants.index') }}" method="GET" class="form-inline">
                        <div class="form-group">
                            <label for="area" class="sr-only">エリア</label>
                            <select name="area" id="area" class="form-control form-control-sm" onchange="document.getElementById('searchForm').submit()">
                                <option value="">All area</option>
                                <option value="北海道">北海道</option>
                                <option value="青森県">青森県</option>
                                <option value="岩手県">岩手県</option>
                                <option value="宮城県">宮城県</option>
                                <option value="秋田県">秋田県</option>
                                <option value="山形県">山形県</option>
                                <option value="福島県">福島県</option>
                                <option value="茨城県">茨城県</option>
                                <option value="栃木県">栃木県</option>
                                <option value="群馬県">群馬県</option>
                                <option value="埼玉県">埼玉県</option>
                                <option value="千葉県">千葉県</option>
                                <option value="東京都">東京都</option>
                                <option value="神奈川県">神奈川県</option>
                                <option value="新潟県">新潟県</option>
                                <option value="富山県">富山県</option>
                                <option value="石川県">石川県</option>
                                <option value="福井県">福井県</option>
                                <option value="山梨県">山梨県</option>
                                <option value="長野県">長野県</option>
                                <option value="岐阜県">岐阜県</option>
                                <option value="静岡県">静岡県</option>
                                <option value="愛知県">愛知県</option>
                                <option value="三重県">三重県</option>
                                <option value="滋賀県">滋賀県</option>
                                <option value="京都府">京都府</option>
                                <option value="大阪府">大阪府</option>
                                <option value="兵庫県">兵庫県</option>
                                <option value="奈良県">奈良県</option>
                                <option value="和歌山県">和歌山県</option>
                                <option value="鳥取県">鳥取県</option>
                                <option value="島根県">島根県</option>
                                <option value="岡山県">岡山県</option>
                                <option value="広島県">広島県</option>
                                <option value="山口県">山口県</option>
                                <option value="徳島県">徳島県</option>
                                <option value="香川県">香川県</option>
                                <option value="愛媛県">愛媛県</option>
                                <option value="高知県">高知県</option>
                                <option value="福岡県">福岡県</option>
                                <option value="佐賀県">佐賀県</option>
                                <option value="長崎県">長崎県</option>
                                <option value="熊本県">熊本県</option>
                                <option value="大分県">大分県</option>
                                <option value="宮崎県">宮崎県</option>
                                <option value="鹿児島県">鹿児島県</option>
                                <option value="沖縄県">沖縄県</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="genre" class="sr-only">ジャンル</label>
                            <select name="genre" id="genre" class="form-control form-control-sm" onchange="document.getElementById('searchForm').submit()">
                                <option value="">All genre</option>
                                <option value="寿司">寿司</option>
                                <option value="焼き肉">焼き肉</option>
                                <option value="イタリアン">イタリアン</option>
                                <option value="居酒屋">居酒屋</option>
                                <option value="ラーメン">ラーメン</option>
                            </select>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label for="name" class="sr-only">店舗</label>
                            <div class="d-flex align-items-center">
                            <i class="fas fa-search text-muted"></i>
                            <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="search" oninput="document.getElementById('searchForm').submit()">
                            </div>
                        </div>
                    </form>
                </div>

                <!-- 店舗カードの表示 -->
                <div class="row mt-4">
                    @foreach($restaurants as $restaurant)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card mb-4">
                                <img src="{{ $restaurant->image }}" class="card-img-top" alt="{{ $restaurant->name }}">
                                <div class="card-body">
                                <h5 class="card-title">{{ $restaurant->name }}</h5>
                                <div class="details">
                                    <p class="card-text"># {{ $restaurant->genre }}</p>
                                    <p class="card-text"># {{ $restaurant->area }}</p>
                                </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                    <a href="/restaurants/{{ $restaurant->id }}" class="btn btn-primary">詳しく見る</a>
                                    <!-- お気に入りボタンのフォーム -->
                                    @auth
                                    <form action="{{ route('favorite.toggle', $restaurant->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary" style="background-color: transparent; border: none;">
                                            @if($restaurant->favoritedBy->contains(Auth::user()))
                                                <i class="fas fa-heart" style="color: red;"></i>
                                            @else
                                                <i class="far fa-heart" style="color: #ccc;"></i>
                                            @endif
                                        </button>
                                    </form>
                                    @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
