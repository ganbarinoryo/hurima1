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
            // PRIMARY KEY
            $table->bigIncrements('id');

            // Usersテーブルのidに紐づけ
            $table->unsignedBigInteger('user_id');

            // 商品名
            $table->string('item_name', 255);

            // 商品状態をユーザーが自由に設定可能に
            $table->string('condition')->nullable();

            // 商品のステータスをユーザーが自由に設定可能に
            $table->string('status')->nullable();

            // 商品の説明
            $table->text('description');

            // 価格（小数点2桁）
            $table->decimal('price', 10, 2);

            // Created at (NOT NULL)
            $table->timestamp('created_at')->notNullable();

            // Updated at
            $table->timestamp('updated_at')->nullable();

            // 外部キー制約（ユーザーID）
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
