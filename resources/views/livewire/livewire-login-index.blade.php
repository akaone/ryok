<div class="bg-gray-ef h-screen flex flex-col sm:items-center">
    <div class="flex flex-row mx-auto mb-4 mt-8">
    <h3 class="font-ryok text-pblue text-2xl self-center">Ryok</h3>
    <span  class="text-pblue text-lg italic self-center ml-1">- {{ trans('login.title') }}</span>
    </div>

    <div class="sm:rounded flex flex-col bg-white sm:shadow-md sm:mx-auto sm:w-10/12 md:w-6/12 lg:w-5/12 pt-4">

        <div class="px-6">@component('components.alert')@endcomponent</div>

        <form wire:submit.prevent="login" class="flex flex-col">
            <div class="flex flex-col px-6 mt-2">
                <label class="font-thin text-gray-33 text-md" for="email">{{ trans('login.email') }}</label>
                <input
                class="border h-8 px-2 rounded border-gray-8e focus:outline-none focus:border-pblue"
                wire:model="email" type="text" id="email">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div class="flex flex-col px-6 mt-2">
                <label class="font-thin text-gray-33 text-md" for="password">{{ trans('login.password') }}</label>
                <input
                    class="border h-8 px-2 rounded border-gray-8e focus:outline-none focus:border-pblue"
                    wire:model="password" type="password" id="password">
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <button wire:loading.remove wire:target="login" class="mt-6 p-4 bg-pblue text-white font-light text-sm italic" type="submit">{{ trans('login.login_btn') }}</button>

            <button wire:loading wire:target="login" class="mt-6 p-4 text-black bg-gray-400 font-light text-sm italic cursor-not-allowed" type="submit">{{ trans('login.loading') }}</button>

        </form>
    </div>

    <div class="flex flex-row mx-auto my-4">
    <a href="{{ route('sign-up.index') }}" class="text-pblue text-md italic self-center ml-1 underline cursor-pointer">
        {{ trans('login.signup_link') }}
    </a>
    </div>
</div>