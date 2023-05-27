<?php

use App\Enums\Gender;
use App\Enums\Organization;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // テーブルが存在していれば 何もしない
        if (Schema::hasTable('player_profiles')) return;
        // 選手プロフィール テーブル 作成
        Schema::create('player_profiles', function (Blueprint $table) {
            // PK
            $table->id()->comment('選手プロフィールID');
            // フィールド
            $table->string('player_code')->unique()->comment('選手コード'); // TODO: PKにするか？
            $table->string('last_name')->comment('姓');
            $table->string('first_name')->comment('名');
            $table->string('last_name_kana')->comment('せい');
            $table->string('first_name_kana')->comment('めい');
            $table->enum('gender', collect(Gender::cases())->map(fn($e) => $e->name)->all())->comment('性別');
            $table->date('birthday')->nullable()->comment('誕生日'); //年がわからない人はnull
            $table->string('date_of_birth')->comment('誕生日 月日'); //誕生日 月日だけ文字(MM/dd) ※ 年が不明な選手いるので こちらを必須
            $table->enum('organization', collect(Organization::cases())->map(fn($e) => $e->name)->all())->comment('所属団体'); // Mリーガーのいる分だけ ChatGPTで物理名決めた
            // deleted_at
            $table->softDeletes();
            // created_at, updated_at
            $table->timestamps();
            // テーブル名
            $table->comment('選手プロフィール');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_profiles');
    }
};
