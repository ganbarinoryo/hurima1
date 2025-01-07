<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
</head>
<body>

    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                <img src="{{ asset('images/logo.png') }}" alt="コーチテック" >
            </a>
            
            <!-- 検索バー -->
            <div class="search-bar">
                <input type="text" placeholder="なにをお探しですか？" class="search-input">
            </div>

            <nav class="nav">
                @guest
                    <a href="/login" class="nav__link__login">ログイン</a>
                    <a href="/register" class="nav__link__register">会員登録</a>
                @else
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="/mypage" class="nav__link__mypage">マイページ</a>
                @endguest
                <a href="/sell" class="nav__link__sell">出品</a>
            </nav>

        </div>
    </header>

        <div class="flex__profile-form__heading">
            <h1>プロフィール設定</h1>
        </div>

    <div class="flex__profile__content">

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="form__group">
            <div class="form__group-content">
                <div class="form__input--icon">
                    <!-- プレビュー画像表示エリア -->
                    <div class="icon">
                        <img id="user_icon_preview" src="" alt="選択された画像" style="display: none;" />
                    </div>
                    <!-- 画像選択ボタン -->
                    <div class="image-upload">
                        <input type="file" id="user_icon_input" name="user_icon" accept="image/*" class="file-input" />
                        <label for="user_icon_input" class="file-label">
                            画像を選択する
                        </label>
                    </div>
                    <div class="form__error">
                        @error('user_icon')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-content">
                <h2>ユーザー名</h2>
                <div class="form__input--text__user_name">
                    <input type="text" id="user_name" name="user_name" value="{{ old('user_name', $user->user_name) }}" class="@error('user_name') is-invalid @enderror" />
                </div>
                <div class="form__error">
                    @error('user_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-content">
                <h2>郵便番号</h2>
                <div class="form__input--text">
                    <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" class="@error('postal_code') is-invalid @enderror" />
                </div>
                <div class="form__error">
                    @error('postal_code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-content">
                <h2>住所</h2>
                <div class="form__input--text">
                    <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" class="@error('address') is-invalid @enderror" />
                </div>
                <div class="form__error">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-content">
                <h2>建物名</h2>
                <div class="form__input--text">
                    <input type="text" id="building_name" name="building_name" value="{{ old('building_name', $user->building_name) }}" class="@error('building_name') is-invalid @enderror" />
                </div>
                <div class="form__error">
                    @error('building_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>


    </div><!--register__contentの終わり-->

    <!-- JavaScriptコード -->
    <script>
    document.getElementById('user_icon_input').addEventListener('change', function(event) {
        const file = event.target.files[0];

        // 画像が選ばれた場合
        if (file) {
            // ファイルタイプをチェック
            if (!file.type.startsWith('image/')) {
                alert('画像ファイルを選択してください。');
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                // 画像をプレビューに設定
                const imgElement = document.getElementById('user_icon_preview');
                imgElement.src = e.target.result;
                imgElement.style.display = 'inline'; // プレビュー表示
            };

            reader.readAsDataURL(file); // ファイルを読み込む
        } else {
            // 画像が選択されなかった場合
            const imgElement = document.getElementById('user_icon_preview');
            imgElement.src = '';
            imgElement.style.display = 'none';
        }
    });
</script>


</body>
</html>