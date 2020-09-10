<div class="bg-gray-200 min-h-screen">

    <div class="bg-white border px-8 mx-auto w-full md:w-8/12 m-4 rounded">
        <div class='pt-6 pb-2'>
            <span class="text-lg text-pblue">{{trans('apps.apps-users.create.section-title')}}</span>
        </div>

        <div class="my-6">

            <div class="flex flex-col border-b mt-4 mb-4">
                <span>{{trans('apps.apps-users.create.section-desc-line-one')}}</span>
                <span>{{trans('apps.apps-users.create.section-desc-line-two')}}</span>
            </div>
            
            @foreach($members as $key => $member)
                <div class="flex flex-wrap mt-4 items-center">
                    <input 
                        wire:model="members.{{$key}}.email" type="text" class="border rounded h-8 px-2 w-full md:w-6/12" 
                        placeholder="{{trans('apps.apps-users.create.email-placeholder')}}">
                    <select wire:model="members.{{$key}}.role" class="mt-2 md:mt-0 md:ml-2 border rounded h-8 px-2 w-6/12 md:w-3/12">
                        <option value="">{{trans('apps.apps-users.create.member-role')}}</option>
                        <option value="admin">{{trans('apps.apps-users.create.role-admin')}}</option>
                        <option value="operation">{{trans('apps.apps-users.create.role-operation')}}</option>
                        <option value="developer">{{trans('apps.apps-users.create.role-developer')}}</option>
                        <option value="support">{{trans('apps.apps-users.create.role-support')}}</option>
                    </select>

                    @if($key > 0)
                        <button wire:click="removeRow({{$key}})" class="mt-2 md:mt-0 ml-2 rounded-full h-6 w-6 bg-gray-200 flex justify-center items-center text-xs font-light text-gray-600"> X </button>
                    @endif
                </div>
                <div class="flex flex-col">
                    @error("members.$key.email") <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error("members.$key.role") <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            @endforeach

            <button wire:click="addRow" class="mt-4 bg-gray-200 text-gray-600 rounded font-light px-4 h-8">{{trans('apps.apps-users.create.add-member')}}</button>

            <div class="flex flex-col border-t mt-4 mb-4 items-end">
                <button wire:click="sendInvites" class="mt-4 shadow bg-blue-500 text-white rounded font-light px-6 h-8">{{trans('apps.apps-users.create.submit-invite')}}</button>
            </div>

        </div>

    </div>


</div>