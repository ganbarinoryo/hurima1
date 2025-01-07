<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\ItemImages;  // 修正：ItemImagesに変更

class SellController extends Controller
{
    public function sell()
    {
        return view('sell');
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'item_image' => 'required|image|mimes:jpg,jpeg,png,gif',  // 画像のバリデーション
            'category' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
        ]);

        // 新しい出品データをitemsテーブルに保存
        $item = Item::create([
            'user_id' => Auth::id(),  // ログインユーザーのIDをセット
            'category' => $request->category,
            'condition' => $request->condition,
            'item_name' => $request->item_name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        // 画像がアップロードされている場合はitem_imagesテーブルに保存
        if ($request->hasFile('item_image')) {
            $imagePath = $request->file('item_image')->store('item_images', 'public'); // 画像をストレージに保存

            // item_imagesテーブルに画像データを保存
            ItemImages::create([
                'item_id' => $item->id,
                'image_path' => $imagePath,  // 画像のパスを保存
                'image_url' => asset('storage/' . $imagePath),  // 画像のURLを保存
            ]);
        }

        // 成功したらマイページへリダイレクト
        return redirect()->route('mypage');
    }

}
