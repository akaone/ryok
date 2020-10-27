<div class="flex flex-col px-4 pb-12">
    <div class="font-thin text-md text-blue-600 my-4">{{trans('apps.apps-users.show.section-title')}}</div>

    @component('components.alert')@endcomponent

    <div class="flex border rounded w-7/12 mt-4">
        
        <div class="flex-1 flex flex-col py-4 px-4  items-start ">
            <div class="flex flex-col mb-2">
                <span class="font-light text-black ">@lang('apps.apps-users.show.name')</span>
                <span class="text-lg bg-gray-ef px-4 py-1 text-gray-600 rounded">{{ $appUser->name }}</span>
            </div>
            <div class="flex flex-col mb-2">
                <span class="font-light text-black">@lang('apps.apps-users.show.email')</span>
                <span class="text-lg bg-gray-ef px-4 py-1 text-gray-600 rounded">{{ $appUser->email }}</span>
            </div>
            <div class="flex space-x-3">
                <div class="flex flex-col mb-2">
                    <span class="font-light text-black">@lang('apps.apps-users.show.invited_at')</span>
                    <span class="text-lg bg-gray-ef px-4 py-1 text-gray-600 rounded">{{ $appUser->created_at }}</span>
                </div>
                <div class="flex flex-col mb-2">
                    <span class="font-light text-black ">@lang('apps.apps-users.show.state')</span>
                    <span class="text-lg bg-gray-ef px-4 py-1 text-gray-600 rounded lowercase">{{ $appUser->state }}</span>
                </div>
                <div class="flex flex-col mb-2">
                    <span class="font-light text-black">@lang('apps.apps-users.show.role')</span>
                    <span class="text-lg bg-gray-ef px-4 py-1 text-gray-600 rounded">{{ $role }}</span>
                </div>
            </div>
            <button class="bg-green-400 text-white px-6 py-1 rounded mt-2">@lang('apps.apps-users.show.resend-invite')</button>
        </div>

    </div>

    <div class="font-thin text-md text-blue-600 my-4">@lang('apps.apps-users.show.actions-title')</div>
    
    <div class="space-y-4">
        <!-- Access rights -->
        <div class="flex flex-col border w-8/12">
            <div class="flex justify-between border-b py-3 px-4">
                <span>@lang('apps.apps-users.show.access-title')</span>
            </div>
            <div class="flex flex-col space-y-2 p-6">
                <span class="w-9/12 font-light">
                    @lang('apps.apps-users.show.access-description', ['email' => $appUser->email])
                </span>
                @error('newRole') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            
                <div class="flex space-x-4">
                    <select wire:model="newRole" class="border rounded h-8 px-2 w-6/12 md:w-4/12">
                        <option value="">@lang('apps.apps-users.create.member-role')</option>
                        <option value="admin">@lang('apps.apps-users.create.role-admin')</option>
                        <option value="operation">@lang('apps.apps-users.create.role-operation')</option>
                        <option value="developper">@lang('apps.apps-users.create.role-developer')</option>
                        <option value="support">@lang('apps.apps-users.create.role-support')</option>
                    </select>
                    <button
                        wire:loading.attr="disabled"
                        wire:loading.class="bg-gray-500 cursor-wait"
                        wire:loading.class.remove="bg-blue-400"
                        wire:target="updateUserRole"
                        wire:click="updateUserRole"
                        class="flex items-center bg-blue-400 text-white px-6 py-1 rounded">
                        <x-icon-spinner wire:loading wire:target="updateUserRole" class="animate-spin w-4 h-4 mr-3 text-white" />
                        <span>@lang('apps.apps-users.show.access-btn')</span>
                    </button>
                </div>
            </div>
        </div>

        @switch($appUser->state)
            @case('ACTIVATED')
                <!-- Deactivate user -->
                <div class="flex flex-col border border-red-600 w-8/12">
                    <div class="flex justify-between border-b border-red-600 py-3 px-4">
                        <span>@lang('apps.apps-users.show.deactivate-title')</span>
                    </div>
                    <div class="flex flex-col space-y-2 p-6">
                        <span class="w-9/12 font-light">
                            @lang('apps.apps-users.show.deactivate-description', ['email' => $appUser->email])
                        </span>
                    
                        <div class="flex space-x-4">
                            <button class="bg-red-600 text-white px-6 py-1 rounded ">@lang('apps.apps-users.show.deactivate-btn')</button>
                        </div>
                    </div>
                </div>.
                @break

            @default
                <!-- Reactivate user -->
                <div class="flex flex-col border w-8/12">
                    <div class="flex justify-between border-b py-3 px-4 cursor-pointer">
                        <span>@lang('apps.apps-users.show.activate-title')</span>
                    </div>
                    <div class="flex flex-col space-y-2 p-6">
                        <span class="w-9/12 font-light">
                            @lang('apps.apps-users.show.activate-description', ['email' => $appUser->email])
                        </span>

                        <div class="flex space-x-4">
                            <button class="bg-green-400 text-white px-6 py-1 rounded ">@lang('apps.apps-users.show.activate-btn')</button>
                        </div>
                    </div>
                </div>
                @break
        @endswitch
    
    </div>

</div>
