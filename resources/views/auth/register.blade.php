<x-guest-layout>
    <div style="text-align: center; margin-bottom: 28px;">
        <h1 style="font-family: Georgia, serif; font-size: 1.8rem; color: #2C1810; letter-spacing: 2px;">✦ MON BLOG</h1>
        <p style="color: #C8956C; font-size: 0.9rem; margin-top: 6px;">Crée ton compte pour rejoindre la communauté</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom -->
        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Nom</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   style="width: 100%; border: 1px solid #E8D5C0; border-radius: 12px; padding: 12px 16px; font-size: 1rem; color: #4A3728; background: #FAF3E8; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
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

        <!-- Confirmer mot de passe -->
        <div style="margin-bottom: 28px;">
            <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   style="width: 100%; border: 1px solid #E8D5C0; border-radius: 12px; padding: 12px 16px; font-size: 1rem; color: #4A3728; background: #FAF3E8; outline: none; box-sizing: border-box;">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div style="display: flex; align-items: center; justify-content: space-between;">
            <a href="{{ route('login') }}"
               style="color: #C8956C; font-size: 0.85rem; text-decoration: none;">
                Déjà un compte ?
            </a>

            <button type="submit"
                    style="background: linear-gradient(135deg, #2C1810, #4A2C17); color: #F5E6D3; padding: 10px 28px; border-radius: 25px; font-weight: bold; border: none; cursor: pointer;">
                ✦ S'inscrire
            </button>
        </div>
    </form>
</x-guest-layout>