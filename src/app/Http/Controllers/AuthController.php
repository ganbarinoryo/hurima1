<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Userモデルをインポート
use Illuminate\Support\Facades\Auth; // Authファサードをインポート
use Illuminate\Support\Facades\Hash; // Hashファサードをインポート

class AuthController extends Controller
{
    // 会員登録ページの表示
    public function register()
    {
        return view('auth.register');
    }

    public function registerSubmit(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // 新しいユーザーを作成
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 登録後、ログインページにリダイレクト
        return redirect()->route('login');  // ログインページにリダイレクト
    }

    // ログインページの表示
    public function login()
    {
        return view('auth.login');
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();  // ログアウト

        $request->session()->invalidate();  // セッションの無効化

        $request->session()->regenerateToken();  // セキュリティ対策

        return redirect('/');  // トップページにリダイレクト
    }
}
