<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class SellController extends Controller
{
    public function sell()
        {
            return view('sell');
        }

    public function store(Request $request)
        {
            // バリデーション
            $validated = $request->validate([
                'product_name' => 'required|string|max:255',
                'category' => 'nullable|string|max:255', // 必須ではない場合
                'condition' => 'required|in:new,used', // enumで定義されている値を指定
                'product_description' => 'required|string',
                'price' => 'required|numeric|min:1|max:9999999.99',
            ]);

            // 商品データを保存
            $item = new Item();
            $item->user_id = Auth::id(); // ログイン中のユーザーIDを設定
            $item->item_name = $validated['product_name'];
            $item->condition = $validated['condition'];
            $item->description = $validated['product_description'];
            $item->price = $validated['price'];
            $item->status = 'available'; // 初期状態を設定（例: 'available'）
            $item->save();

            // 成功したらリダイレクト
            return redirect()->route('mypage');
        }
}
