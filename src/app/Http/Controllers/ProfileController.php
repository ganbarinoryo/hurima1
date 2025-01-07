<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        // 現在ログインしているユーザーの情報を取得
        $user = Auth::user();

        return view('mypage.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // バリデーション
        $request->validate([
            'user_name' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'building_name' => 'nullable|string|max:255',
            'user_icon' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',  // フォームのフィールド名に合わせる
        ]);

        // 現在ログインしているユーザーを取得
        $user = Auth::user();

        // フォームの入力内容をユーザー情報に保存
        $user->user_name = $request->input('user_name');
        $user->postal_code = $request->input('postal_code');
        $user->address = $request->input('address');
        $user->building_name = $request->input('building_name');

        // ユーザーアイコンのアップロード処理
        if ($request->hasFile('user_icon')) {
            // 古い画像があれば削除
            if ($user->user_icon) {
                Storage::disk('public')->delete($user->user_icon);
            }

            // 新しい画像ファイルをアップロード
            $imagePath = $request->file('user_icon')->store('user_icons', 'public');
            $user->user_icon = $imagePath; // 画像パスをデータベースに保存
        }

        // ユーザー情報を保存
        $user->save();

        // 更新後にリダイレクトしてメッセージを表示
        return redirect()->route('profile.form')->with('success', 'プロフィールが更新されました。');
    }


}
