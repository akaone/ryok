<div class="flex flex-col px-4">
    <div class="font-thin text-md text-blue-600 my-4">{{trans('apps.apps-users.index.section-title')}}</div>

    @component('components.alert')@endcomponent

    <div class="mt-6 mb-1 flex justify-between">
        <input type="text" class="border bg-gray-200 rounded h-8 px-2 w-4/12" placeholder="{{trans('apps.apps-users.index.search')}}">
        <x-user-can acl="app-users-create" :id="$appId">
            <a href="{{ route('dashboard.apps.users.create', ['appId' => $appId ]) }}">
                <button class="flex items-center justify-center px-4 h-8 shadow bg-blue-500 rounded text-white font-light">
                    <span>{{trans('apps.apps-users.index.invite')}}</span>
                </button>
            </a>
        </x-user-can>
    </div>

    <table class="my-2 bg-gray-200 rounded border">
        <tr class="border-b text-black">
            <th class="text-sm py-3 px-2 font-light text-left w-3/12">{{trans('apps.apps-users.index.user-name')}}</th>
            <th class="text-sm py-3 px-2 font-light text-left w-1/12">{{trans('apps.apps-users.index.user-role')}}</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">{{trans('apps.apps-users.index.user-added')}}</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">{{trans('apps.apps-users.index.user-state')}}</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">{{trans('apps.apps-users.index.user-app-state')}}</th>
            <th class="text-sm py-3 px-2 font-light text-left w-2/12">{{trans('apps.apps-users.index.user-action')}}</th>
        </tr>
        
        @foreach($appsUsersList as $key => $user)
            <tr class="border-b hover:bg-gray-100 cursor-default bg-white text-gray-600">
                <td class="py-3 flex items-center px-2 text-sm">{{ $user->name }}</td>
                <td class="py-3 px-2 text-sm">{{ $user->role_name }}</td>
                <td class="py-3 px-2 text-sm">{{ $user->apps_users_created_at }}</td>
                <td class="py-3 px-2 text-sm">
                    <span class="lowercase border rounded py-1 px-2 lowercase">{{ $user->state }}</span>
                </td>
                <td class="py-3 px-2 text-sm">
                    <span class="lowercase border rounded py-1 px-2 lowercase">{{ $user->apps_users_state }}</span>
                </td>
                <td class="py-3 px-2 text-sm">
                    <button class="w-full bg-gray-200 text-black px-2 py-1 rounded font-light">
                        {{trans('apps.apps-users.index.user-details')}}
                    </button>
                </td>
            </tr>
        @endforeach()

    </table>
</div>
