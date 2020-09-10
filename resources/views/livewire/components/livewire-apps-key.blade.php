<div x-data="COMPONENT_APPS_KEYS_DATA()" x-cloak x-on:click.away="setActive(0)" class="flex flex-col border w-7/12 shadow">
    <div class="flex items-center justify-between border-b px-4 py-2 font-medium">
        <span>{{trans('apps.apps-api.index.development-keys-title')}}</span>
        <div x-on:click="setActive(1)" class="rounded-full p-2 hover:bg-gray-200 cursor-pointer">
            <x-heroicon-s-chevron-down x-show="active != 1" class="w-4 h-4 text-gray-500"/>
            <x-heroicon-s-chevron-up x-show="active == 1" class="w-4 h-4 text-gray-500"/>
        </div>
    </div>

    <template x-if="active == 1" > 
        <div class="my-4">
            <div class="px-4">
                <label for="">{{trans('apps.apps-api.index.public-keys-label')}}</label>
                <div class="flex">
                    <input x-bind:type="inputType == 'pk-test' ? 'text' : 'password'" disabled value="{{$appKeys->test_public_key}}" class="rounded-l h-8 px-2 border flex-1 bg-gray-200 cursor-not-allowed">
                    <button class="flex items-center justify-center bg-white h-8 w-8 border-t border-b border-r">
                        <x-heroicon-s-clipboard class="w-4 h-4 text-gray-500"/>
                    </button>
                    <button x-on:click="setInputType('pk-test')" class="flex items-center justify-center bg-white h-8 w-8 border-t border-b border-r rounded-r">
                        <x-heroicon-s-eye class="w-4 h-4 text-gray-500"/>
                    </button>
                </div>
            </div>

            <div class="px-4">
                <label for="">{{trans('apps.apps-api.index.secret-keys-label')}}</label>
                <div class="flex">
                    <input x-bind:type="inputType == 'sk-test' ? 'text' : 'password'" disabled value="{{$appKeys->test_secret_key}}" class="rounded-l h-8 px-2 border flex-1 bg-gray-200 cursor-not-allowed">
                    <button class="flex items-center justify-center bg-white h-8 w-8 border-t border-b border-r">
                        <x-heroicon-s-clipboard class="w-4 h-4 text-gray-500"/>
                    </button>
                    <button x-on:click="setInputType('sk-test')" class="flex items-center justify-center bg-white h-8 w-8 border-t border-b border-r rounded-r">
                        <x-heroicon-s-eye class="w-4 h-4 text-gray-500"/>
                    </button>
                </div>
            </div>
        </div>
    </template>

    <div class="flex items-center justify-between border-b px-4 py-2 font-medium border-t">
        <span>{{trans('apps.apps-api.index.production-keys-title')}}</span>
        <div x-on:click="setActive(2)" class="rounded-full p-2 hover:bg-gray-200 cursor-pointer">
            <x-heroicon-s-chevron-down x-show="active != 2" class="w-4 h-4 text-gray-500"/>
            <x-heroicon-s-chevron-up x-show="active == 2" class="w-4 h-4 text-gray-500"/>
        </div>
    </div>

    <template x-if="active == 2" >
        <div class="my-4">
            <div class="px-4">
                <label for="">{{trans('apps.apps-api.index.public-keys-label')}}</label>
                <div class="flex">
                    <input x-bind:type="inputType == 'pk' ? 'text' : 'password'" disabled value="{{$appKeys->public_key}}" class="rounded-l h-8 px-2 border flex-1 bg-gray-200 cursor-not-allowed">
                    <button class="flex items-center justify-center bg-white h-8 w-8 border-t border-b border-r">
                        <x-heroicon-s-clipboard class="w-4 h-4 text-gray-500"/>
                    </button>
                    <button x-on:click="setInputType('pk')" class="flex items-center justify-center bg-white h-8 w-8 border-t border-b border-r rounded-r">
                        <x-heroicon-s-eye class="w-4 h-4 text-gray-500"/>
                    </button>
                </div>
            </div>

            <div class="px-4">
                <label for="">{{trans('apps.apps-api.index.secret-keys-label')}}</label>
                <div class="flex">
                    <input x-bind:type="inputType == 'sk' ? 'text' : 'password'" disabled value="{{$appKeys->secret_key}}" class="rounded-l h-8 px-2 border flex-1 bg-gray-200 cursor-not-allowed">
                    <button class="flex items-center justify-center bg-white h-8 w-8 border-t border-b border-r">
                        <x-heroicon-s-clipboard class="w-4 h-4 text-gray-500"/>
                    </button>
                    <button x-on:click="setInputType('sk')" class="flex items-center justify-center bg-white h-8 w-8 border-t border-b border-r rounded-r">
                        <x-heroicon-s-eye class="w-4 h-4 text-gray-500"/>
                    </button>
                </div>
            </div>
        </div>
    </template>
    
</div>


<script>
    function COMPONENT_APPS_KEYS_DATA() {
        return {
            active: 0,
            inputType: "",
            setInputType(type) {
                console.warn(type);
                this.inputType = this.inputType == type ? "" : type;
            },
            setActive(index) {
                this.active = this.active == index ? 0 : index;
                this.inputType = ""
            },
        }
    }
</script>