#アプリ名
Rese(リーズ)
飲食店予約サービス

##作成した目的
自社での予約サービスを所持するため
##アプリケーションURL

##機能一覧
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

##使用技術
PHP8.1.2
laraver8
javascript
外部ライブラリ
1.Bootstrap: Bootstrap 4.5.2
2.Font Awesome: Font Awesome 5.15.3
バージョンなど
##テーブル設計
画像
##ER図
画像
#環境構築
1.docker-compose exec php bash
2.laraverプロジェクトの作成
composer create-project "laravel/laravel=8.*" . --prefer-dist

4.Permission Denied エラーの解決方法
sudo chmod -R 777 src/*

5.CDN経由でBootstrap CSSをインストール
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
6.CDN経由でFont Awesome CSSをインストール>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
7.CDN経由でBootstrap JavaScriptをインストール
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

8.環境設定ファイルの作成
cp .env.example .env

9.環境設定ファイルの編集
.envファイルを開いて以下の設定を行う
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

9.アプリケーションキーの生成
php artisan key:generate

10.Laravelの登録・ログイン機能のセットアップ
php artisan ui vue --auth
npm install && npm run dev

11.マイグレーションファイル作成
php artisan make:migration create_restaurants_table
php artisan make:migration create_favorite_restaurants_table
php artisan make:migration create_reservations_table
php artisan make:migration create_reviews_table
php artisan make:migration create_images_table
マイグレーションファイル実行
php artisan migrate

12.シーダーファイルの作成
php artisan make:seeder RestaurantSeeder
シーダーファイルの実行
php artisan db:seed

13.ビューファイル作成
touch resources/views/detail.blade.php
touch resources/views/done.blade.php
touch resources/views/index.blade.php
touch resources/views/mypage.blade.php
touch resources/views/thanks.blade.php
touch resources/views/update.blade.php
touch resources/views/layouts/app.blade.php

14.CSSファイル作成
touch public/css/app.css
touch public/css/detail.css
touch public/css/index.css
touch public/css/login.css
touch public/css/mypage.css
touch public/css/register.css
外部よりインストール
bootstrap.min.css

15.コントローラー作成
php artisan make:controller FavoriteController
php artisan make:controller MyPageController
php artisan make:controller ReservationController
php artisan make:controller RestaurantController
php artisan make:controller StorageController
php artisan make:controller UserReservationController
php artisan make:controller Auth/AuthenticatedSessionController

16.モデルの作成
php artisan make:model FavoriteRestaurant
php artisan make:model Image
php artisan make:model Reservation
php artisan make:model Restaurant
php artisan make:model User

17.バリデーション用リクエストフォームの作成
php artisan make:request RegisterRequest
php artisan make:request ReservationRequest
php artisan make:request Auth/LoginRequest

18.ストレージリンクの作成（画像をストレージへ保存する）
php artisan storage:link


##その他
アカウントの種類
テストユーザー（シーダーファイルに記載）
