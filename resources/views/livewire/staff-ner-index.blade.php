<div x-cloak x-data="STAFF_NER_INDEX()" class="flex flex-col px-4 pb-16">
    @section('title', trans('ner.staff-ner.index.title'))

    <div class="font-thin text-md text-blue-600 my-4">@lang('ner.staff-ner.index.title')</div>

    <div class="flex w-full .px-4 pt-2 mb-4 font-light text-gray-600 border-b sticky top-0 bg-white">
        <div
            x-on:click="changeTab('data')"
            x-bind:class="{'border-b-2 text-green-800 border-green-600': activeTab == 'data' }"
            class="cursor-pointer bg-white py-2 px-6 flex">
            Data
        </div>
        <div
            x-on:click="changeTab('test')"
            x-bind:class="{'border-b-2 text-green-800 border-green-600': activeTab == 'test' }"
            class="cursor-pointer bg-white py-2 px-6 flex">
            Test model
        </div>
    </div>

    <div x-show="activeTab == 'data'" class="flex flex-col .px-4">
        <div class="mb-1 flex space-x-2">
            <a href="{{ route('dashboard.staff.ner.import-data') }}">
                <div class="flex items-center justify-center px-4 h-8 shadow bg-blue-500 rounded text-white font-light">
                    <span>Import data</span>
                </div>
            </a>

            <button class="flex items-center justify-center px-4 h-8 shadow bg-yellow-500 rounded text-white font-light">
                <span>Launch model training</span>
            </button>
        </div>

        <table class="my-2 bg-gray-200 rounded border w-full">
            <tr class="border-b text-black">
                <th class="text-sm py-3 px-2 font-light text-left w-8/12">Labeled text</th>
                <th class="text-sm py-3 px-2 font-light text-left w-4/12">Action</th>
            </tr>
        </table>
    </div>


    <script>
        function STAFF_NER_INDEX() {
            return {
                activeTab: "data",
                changeTab(tab) {
                    this.activeTab = tab
                },
            }
        }
    </script>

</div>
