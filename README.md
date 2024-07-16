# rese_v1
### アプリ名
Rese(リーズ)
飲食店予約サービス　
https://github.com/mao-p/rese_v1/blob/main/2024-07-15%20231639.png?raw=true

### 作成した目的
自社での予約サービスを所持するため

### アプリケーションURL
https://github.com/mao-p/rese_v1/blob/main/rese_v1/src/images/2024-07-16%20table1.png?raw=true

https://github.com/mao-p/rese_v1/blob/main/2024-07-16%20table2.png?raw=true

https://github.com/mao-p/rese_v1/blob/main/2024-07-16%20table3.png?raw=true

### 機能一覧
1.会員登録
2.ログイン
3.ログアウト
4.ユーザー情報取得
5.ユーザー飲食店お気に入り一覧取得
6.ユーザー飲食店予約情報取得
7.飲食店一覧取得
8.飲食店詳細取得
9.飲食店お気に入り追加
10.飲食店お気に入り削除
11.飲食店予約情報追加
12.飲食店予約情報削除
13.エリアで検索する
14.ジャンルで検索する
15.店名で検索する
16.予約変更
17.画像ストレージ保存

### 使用技術
PHP
laraver8
#### 外部ライブラリ
1. Bootstrap: Bootstrap 4.5.2
2. Font Awesome: Font Awesome 5.15.3

### テーブル設計
https://github.com/mao-p/rese_v1/blob/main/2024-07-16%20table1.png?raw=true

### ER図
https://github.com/mao-p/rese_v1/blob/main/2024-07-16%20ER.png?raw=true

### 環境構築
1.docker-compose exec php bash

2.laraverプロジェクトの作成
composer create-project "laravel/laravel=8.*" . --prefer-dist

3.Permission Denied エラーの解決方法
sudo chmod -R 777 src/*

4.CDN経由でBootstrap CSSをインストール
"https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"

5.CDN経由でFont Awesome CSSをインストール>
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 

6.CDN経由でBootstrap JavaScriptをインストール
"https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"

7.環境設定ファイルの作成
cp .env.example .env

8.環境設定ファイルの編集
.envファイルを開いて以下の設定を行う<br>
DB_CONNECTION=mysql<br>
DB_HOST=mysql<br>
DB_PORT=3306<br>
DB_DATABASE=laravel_db<br>
DB_USERNAME=laravel_user<br>
DB_PASSWORD=laravel_pass<br>

9.アプリケーションキーの生成<br>
php artisan key:generate<br>

10.Laravelの登録・ログイン機能のセットアップ<br>
php artisan ui vue --auth<br>
npm install && npm run dev<br>

11.マイグレーションファイル作成<br>
php artisan make:migration create_restaurants_table<br>
php artisan make:migration create_favorite_restaurants_table<br>
php artisan make:migration create_reservations_table<br>
php artisan make:migration create_reviews_table<br>
php artisan make:migration create_images_table<br>
マイグレーションファイル実行<br>
php artisan migrate<br>

12.シーダーファイルの作成<br>
php artisan make:seeder RestaurantSeeder<br>
シーダーファイルの実行<Br>
php artisan db:seed<br>

13.ビューファイル作成<br>
touch resources/views/detail.blade.php<br>
touch resources/views/done.blade.php<br>
touch resources/views/index.blade.php<br>
touch resources/views/mypage.blade.php<br>
touch resources/views/thanks.blade.php<br>
touch resources/views/update.blade.php<br>
touch resources/views/layouts/app.blade.php<br>


14.CSSファイル作成<br>
touch public/css/app.css<br>
touch public/css/detail.css<br>
touch public/css/index.css<br>
touch public/css/login.css<br>
touch public/css/mypage.css<br>
touch public/css/register.css<br>
外部よりインストール<br>
bootstrap.min.css

15.コントローラー作成<br>
php artisan make:controller FavoriteController<br>
php artisan make:controller MyPageController<br>
php artisan make:controller ReservationController<br>
php artisan make:controller RestaurantController<br>
php artisan make:controller StorageController<br>
php artisan make:controller UserReservationController<br>
php artisan make:controller ReviewController<br>
php artisan make:controller Auth/AuthenticatedSessionController<br>

16.モデルの作成<br>
php artisan make:model FavoriteRestaurant<br>
php artisan make:model Image<br>
php artisan make:model Reservation<br>
php artisan make:model Restaurant<br>
php artisan make:model User<br>
php artisan make:model Review<br>

17.バリデーション用リクエストフォームの作成<br>
php artisan make:request RegisterRequest<br>
php artisan make:request ReservationRequest<br>
php artisan make:request Auth/LoginRequest<br>

18.ストレージリンクの作成（画像をストレージへ保存する)<br>
php artisan storage:link<br>


##その他<br>
アカウントの種類<br>
テストユーザー（シーダーファイルに記載）<br>
            'name' => 'Test User'<br>
            'email' => 'test@example.com'<br>
            'password' => 'password'

        
