<div class="bg-gray-ef min-h-screen flex flex-col sm:items-center">
    <div class="flex flex-row mx-auto mb-4 mt-8">
        <h3 class="font-ryok text-pblue text-2xl self-center">Ryok</h3>
        <span  class="text-pblue text-lg italic self-center ml-1">- {{ trans('signup.title') }}</span>
    </div>
    
    <div class="sm:rounded flex flex-col bg-white sm:shadow-md sm:mx-auto sm:w-10/12 md:w-6/12 lg:w-5/12">

        @component('components.alert')@endcomponent
        <form class="flex flex-col" wire:submit.prevent="createAccount">

            <div class="border border-gray-400 relative my-6">
                <span class="absolute bg-white ml-4 px-2 text-gray-600" style="bottom: -10px;">
                Info
                </span>
            </div>

            <div class="flex flex-col px-6">
                <label for="" class="font-thin text-gray-33 text-md">{{ trans('signup.email') }}</label>
                <input
                wire:model="email" type="text"
                class="border h-8 px-2 rounded border-gray-8e focus:outline-none focus:border-pblue mb-2">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                
                <div class="flex flex-col md:flex-row">
                <div class="flex flex-col md:w-8/12">
                    <label for="" class="font-thin text-gray-33 text-md">{{ trans('signup.name') }}</label>
                    <input
                    wire:model="name" type="text"
                    class="border h-8 px-2 rounded border-gray-8e focus:outline-none focus:border-pblue mb-2">
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex flex-col md:ml-2 flex-1">
                    <label for="" class="font-thin text-gray-33 text-md">{{ trans('signup.gender') }}</label>
                    <select wire:model="gender" class="h-8 border border-gray-8e bg-white" name="" id="">
                        <option value="M">{{ trans('signup.gender_male') }}</option>
                        <option value="F">{{ trans('signup.gender_female') }}</option>
                    </select>
                    @error('gender') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                </div>
            </div>

            <div class="border border-gray-400 relative my-6">
                <span class="absolute bg-white ml-4 px-2 text-gray-600" style="bottom: -10px;">
                {{ trans('signup.pass_info') }}
                </span>
            </div>

            <div class="flex flex-col px-6">
                <label for="" class="font-thin text-gray-33 text-md">{{ trans('signup.password') }}</label>
                <input
                wire:model="password"
                type="password" class="border h-8 px-2 rounded border-gray-8e focus:outline-none focus:border-pblue mb-2">
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                <label for="" class="font-thin text-gray-33 text-md">{{ trans('signup.confirm_password') }}</label>
                <input
                wire:model="confirmPassword" type="password"
                class="border h-8 px-2 rounded border-gray-8e focus:outline-none focus:border-pblue mb-2">
                @error('confirmPassword') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>


            <button
                wire:loading.attr="disabled"
                wire:loading.class="bg-gray-500 cursor-wait"
                wire:loading.class.remove="bg-pblue"
                wire:target="createAccount"
                class="flex items-center justify-center mt-6 p-4 bg-pblue text-white font-light text-sm italic"
                type="submit">
                <x-icon-spinner wire:loading wire:target="createAccount" class="animate-spin w-4 h-4 mr-3 text-white" />
                <span>@lang('signup.signup_btn')</span>
            </button>
            
        </form>
    </div>

    <div class="flex flex-row mx-auto my-4">
        <a href="{{ route('login') }}" class="text-pblue text-md italic self-center ml-1 underline cursor-pointer">
        {{ trans('signup.login_link') }}
        </a>
    </div>
    
</div>