<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id'); // PRIMARY KEY
            $table->unsignedBigInteger('user_id'); // Usersテーブルのidに紐づけ
            $table->string('item_name', 255); // 商品名
            $table->enum('condition', ['new', 'used', 'refurbished']); // 商品状態（例: 新品, 中古, 再生品）
            $table->enum('status', ['available', 'sold', 'unavailable']); // 商品のステータス（例: 販売中, 売却済み, 販売不可）
            $table->text('description'); // 商品の説明
            $table->decimal('price', 10, 2); // 価格（小数点2桁）
            $table->timestamp('created_at')->notNullable(); // Created at (NOT NULL)
            $table->timestamp('updated_at')->nullable(); // Updated at

            // 外部キー制約（ユーザーID）
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Usersテーブルのidに紐づけ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
