<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div style="text-align: center; margin-bottom: 28px;">
        <h1 style="font-family: Georgia, serif; font-size: 1.8rem; color: #2C1810; letter-spacing: 2px;">✦ MON BLOG</h1>
        <p style="color: #C8956C; font-size: 0.9rem; margin-top: 6px;">Connecte-toi pour continuer</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   style="width: 100%; border: 1px solid #E8D5C0; border-radius: 12px; padding: 12px 16px; font-size: 1rem; color: #4A3728; background: #FAF3E8; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Mot de passe</label>
            <input id="password" type="password" name="password" required
                   style="width: 100%; border: 1px solid #E8D5C0; border-radius: 12px; padding: 12px 16px; font-size: 1rem; color: #4A3728; background: #FAF3E8; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Souviens-toi de moi -->
        <div style="margin-bottom: 24px;">
            <label style="display: flex; align-items: center; gap: 8px; color: #4A3728; cursor: pointer; font-size: 0.9rem;">
                <input type="checkbox" name="remember" style="accent-color: #2C1810;">
                Souviens-toi de moi
            </label>
        </div>

        <div style="display: flex; align-items: center; justify-content: space-between;">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   style="color: #C8956C; font-size: 0.85rem; text-decoration: none;">
                    Mot de passe oublié ?
                </a>
            @endif

            <button type="submit"
                    style="background: linear-gradient(135deg, #2C1810, #4A2C17); color: #F5E6D3; padding: 10px 28px; border-radius: 25px; font-weight: bold; border: none; cursor: pointer;">
                ✦ Se connecter
            </button>
        </div>

        <div style="text-align: center; margin-top: 20px; font-size: 0.9rem; color: #7A5C45;">
            Pas encore de compte ?
            <a href="{{ route('register') }}" style="color: #C8956C; font-weight: bold; text-decoration: none;">S'inscrire</a>
        </div>
    </form>
</x-guest-layout>