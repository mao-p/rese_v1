<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    @yield('styles')
    <link href="/css/app.css" rel="stylesheet">
    

</head>
<body>
    <!-- ナビゲーションバー -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-custom">
        <!-- タイトルアイコン -->
        <a href="#myModal" class="navbar-brand text-primary"><i class="fas fa-align-left mr-3"></i>Rese</a>
    </nav>

    <!-- モーダル -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="fas fa-window-close"><i class="fas fa-window"></i></a>
            </div>
            <div class="modal-body">
                <ul>
                    @auth
                        <li><a href="{{ route('restaurants.index') }}">Home</a></li>
                        <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-link">Logout</button>
                        </form>
                            </li>

                        <li><a href="{{ route('mypage') }}">Mypage</a></li>
                    @else
                        <li><a href="{{ route('restaurants.index') }}">Home</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>

    <!-- 店舗一覧画面 -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- ログアウトメッセージ表示 -->
    @if(session('status'))
        <div class="alert alert-success" role="alert" style="position: absolute; top: 10px; right: 10px;">
            {{ session('status') }}
        </div>
    @endif

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
