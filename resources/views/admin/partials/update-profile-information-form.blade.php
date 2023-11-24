<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('user.update', ['id' => $user->id]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid md:grid-cols-2 md:gap-6">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 ">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 ">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div>
                <x-input-label for="phone_number" :value="__('Phone_Number')" />
                <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number', $user->phone_number)" required autofocus autocomplete="phone_number" />
                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
            </div>

            <div>
                <x-input-label for="age" :value="__('Age')" />
                <x-text-input id="age" name="age" type="text" class="mt-1 block w-full" :value="old('age', $user->age)" required autofocus autocomplete="age" />
                <x-input-error class="mt-2" :messages="$errors->get('age')" />
            </div>

            <div>
                <x-input-label for="height" :value="__('Height')" />
                <x-text-input id="height" name="height" type="text" class="mt-1 block w-full" :value="old('height', $user->height)" required autofocus autocomplete="height" />
                <x-input-error class="mt-2" :messages="$errors->get('height')" />
            </div>

            <div>
                <x-input-label for="weight" :value="__('Weight')" />
                <x-text-input id="weight" name="weight" type="text" class="mt-1 block w-full" :value="old('weight', $user->weight)" required autofocus autocomplete="weight" />
                <x-input-error class="mt-2" :messages="$errors->get('weight')" />
            </div>
            <div>
                <x-input-label for="role_id" :value="__('Role')" />
                <x-text-input id="role_id" name="role_id" type="text" class="mt-1 block w-full" :value="old('role_id', $user->role_id)" required autofocus autocomplete="role_id" />
                <x-input-error class="mt-2" :messages="$errors->get('role_id')" />
            </div>
            
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
