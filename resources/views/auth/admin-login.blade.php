<x-guest-layout>

    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <div class="mb-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800">
            Admin Panel Login
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            For administrators and staff only
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('admin.login.store') }}">
        @csrf

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700
                    px-4 py-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p class="text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />

            @error('email')
                <span class="text-danger text-sm mt-1 block">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div style="position: relative;">
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" style="padding-right: 42px;" />

                <button type="button" onclick="togglePassword('password', 'eyeIcon1')" tabindex="-1"
                    style="position: absolute;
                       right: 10px;
                       top: 50%;
                       transform: translateY(-50%);
                       background: none;
                       border: none;
                       cursor: pointer;
                       color: #6B7280;
                       padding: 0;
                       line-height: 1;">
                    <i class="fa fa-eye" id="eyeIcon1"></i>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600
                           shadow-sm focus:ring-indigo-500"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full justify-center">
                Sign in to Admin Panel
            </x-primary-button>
        </div>

    </form>

    <script>
        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>


</x-guest-layout>
