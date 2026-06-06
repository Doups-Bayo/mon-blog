<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family: Georgia, serif; color: #2C1810; font-size: 1.5rem; letter-spacing: 1px;">
            ✦ Gestion des utilisateurs
        </h2>
    </x-slot>

    <div style="background: #FAF3E8; min-height: 100vh; padding: 40px 0;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div style="background: #D4EDDA; border: 1px solid #C8956C; color: #2C1810; padding: 12px 20px; border-radius: 8px; margin-bottom: 24px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background: #FFFDF7; border-radius: 16px; padding: 32px; box-shadow: 0 4px 20px rgba(44,24,16,0.08); border: 1px solid #E8D5C0;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid #E8D5C0;">
                            <th style="text-align: left; padding: 12px; color: #2C1810; font-family: Georgia, serif;">Nom</th>
                            <th style="text-align: left; padding: 12px; color: #2C1810; font-family: Georgia, serif;">Email</th>
                            <th style="text-align: left; padding: 12px; color: #2C1810; font-family: Georgia, serif;">Rôle</th>
                            <th style="text-align: left; padding: 12px; color: #2C1810; font-family: Georgia, serif;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr style="border-bottom: 1px solid #E8D5C0;">
                            <td style="padding: 12px; color: #4A3728;">{{ $user->name }}</td>
                            <td style="padding: 12px; color: #4A3728;">{{ $user->email }}</td>
                            <td style="padding: 12px;">
                                <span style="background: {{ $user->isAdmin() ? '#2C1810' : '#E8D5C0' }}; color: {{ $user->isAdmin() ? '#F5E6D3' : '#4A3728' }}; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem;">
                                    {{ $user->isAdmin() ? 'Admin' : 'Utilisateur' }}
                                </span>
                            </td>
                            <td style="padding: 12px;">
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.role', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="role" value="{{ $user->isAdmin() ? 'user' : 'admin' }}">
                                    <button type="submit"
                                            style="background: {{ $user->isAdmin() ? '#FFF0EB' : '#2C1810' }}; color: {{ $user->isAdmin() ? '#C0392B' : '#F5E6D3' }}; padding: 6px 16px; border-radius: 20px; border: 1px solid {{ $user->isAdmin() ? '#E8B4B8' : '#2C1810' }}; cursor: pointer; font-size: 0.85rem;">
                                        {{ $user->isAdmin() ? 'Retirer admin' : 'Nommer admin' }}
                                    </button>
                                </form>
                                @else
                                    <span style="color: #C8956C; font-size: 0.85rem;">C'est vous</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>