# example-laravel-breeze-blade
Laravel Breeze (bladeでの)サンプル作成 bladeでの製造でトマ取らないようにするため
## 環境
|項目|バージョン|
|:---|:---:|
|php|8.1|
|laravel|10|
|nginx|とりあえず最新（開発用なので）|
|postgres|13（都合上）|
## Laravel 環境の注意点
- Laravel Breeze 利用
- socialite ではなく ID/PW形式で一旦
- Laravel blade の画面 ( + alpinejs らしいデフォルト)
- bladeで考えるため 通信はMPA形式で考える(APIは使わないかと)

## Goal
blade + alpinejs on Breeze にて ログイン後の画面に 試合 登録画面(出場選手 + 選手の試合での成績)

## 環境構築時の手順
1. Docker 用意
1. コンテナ起動
1. appコンテナ起動
1. composer create-project laravel/laravel .
1. composer require laravel/breeze --dev
1. curl https://www.toptal.com/developers/gitignore/api/vim,vue,node,linux,macos,laravel,windows,composer,intellij,sublimetext,visualstudio,visualstudiocode >> .gitignore

## Laravel Breeze bladeとしての環境構築 (他でも作業できるように ここから別ブランチ作業)
1. php artisan breeze:install blade

※ php artisan breeze:install では bladeで行う
※ typescriptには対応していない... alpinejs