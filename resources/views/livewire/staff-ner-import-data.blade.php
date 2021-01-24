<div x-cloak x-data="STAFF_NER_IMPORT_DATA()"  x-init="setCompleteText" class="bg-gray-200 min-h-screen">
    @section('title', trans('ner.staff-ner.import-data.title'))

    <div class="bg-white border px-8 mx-auto w-full md:w-8/12 m-4 rounded">
        <div class='pt-6 pb-2'>
            <span class="text-lg text-pblue">{{ __('ner.staff-ner.import-data.title') }}</span>
        </div>

        <div class="my-6">

            <label class="cursor-pointer bg-gray-200 hover:bg-gray-300 rounded px-4 py-2 block w-4/12">
                <div class="flex justify-between items-center">
                    <span
                        wire:loading.attr="disabled"
                        wire:loading.class="text-gray-400"
                        wire:target="excelFile">
                        Click here to pick a file
                    </span>
                    <x-icon-spinner wire:loading wire:target="excelFile" class="animate-spin w-4 h-4 mr-3 text-gray-600" />
                </div>
                <input
                    wire:loading.attr="disabled"
                    wire:target="excelFile"
                    wire:model="excelFile" type="file" class="absolute opacity-0 -z-1">
            </label>
            @error('excelFile') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

            @if($currentSentence)
                <div class="mt-4 underline">Fetched data</div>

                <div class="flex flex-col mt-2 w-9/12">
                    <div class="flex space-x-2 items-start p-4 border">
                        <button x-on:click="addMarkedEntities('AMOUNT')" class="text-sm cursor-pointer border rounded px-2 bg-green-300 border-green-400">Amount</button>
                        <button x-on:click="addMarkedEntities('FEES')" class="text-sm cursor-pointer border rounded px-2 bg-pink-300 border-pink-400">Fees</button>
                        <button x-on:click="addMarkedEntities('BALANCE')" class="text-sm cursor-pointer border rounded px-2 bg-blue-300 border-blue-400">Balance</button>
                        <button x-on:click="addMarkedEntities('CURRENCY')" class="text-sm cursor-pointer border rounded px-2 bg-yellow-300 border-yellow-400">Currency</button>
                        <button x-on:click="addMarkedEntities('REFERENCE')" class="text-sm cursor-pointer border rounded px-2 bg-red-300 border-red-400">Reference</button>
                    </div>
                    <div class="text-sm flex flex-col border">
                    <div class="flex flex-col flex-1">
                        <div id="formattedText" class="p-4 hidden">{{ $currentSentence->text }}</div>
                        <div class="flex flex-wrap p-4" id="formattedText" x-html="renderTokenizedText()"></div>

                        <div class="hidden flex flex-wrap items-start border-t px-4 py-2">
                            <template x-for="(item, index) in markedEntities" :key="index">
                                <div x-on:click="removeEntity(index)" class="cursor-pointer flex border rounded m-1 pl-2">
                                    <span x-text="item.text"></span>
                                    <span class="ml-2 px-2 bg-gray-200 border-l" x-text="item.label"></span>
                                    <span class="text-xs" x-text="`${item.start} ${item.end}`"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="border-t flex justify-between">
                        <a href="{{ $currentSentencePaginate->previousPageUrl() }}" rel="prev" class="p-4 hover:bg-gray-100">
                            {!! __('pagination.previous') !!}
                        </a>
                        <button x-on:click="toNext" class="p-4 hover:bg-gray-100">
                            {!! __('pagination.next') !!}
                        </button>
                    </div>
                </div>

                </div>
            @endif

        </div>

    </div>

    <script>
        function STAFF_NER_IMPORT_DATA() {
            return {
                LABEL: "REFERENCE",
                completeText: "",
                markedEntities: [],
                markedIndexes: [],
                selectedTokens: [],
                setCompleteText() {
                    this.completeText = document.getElementById("formattedText").innerText;
                },
                addMarkedEntities(label) {
                    if(this.selectedTokens.length <= 0) return null;
                    const sortedRange = this.selectedTokens.sort((a, b) => {
                        return a.index - b.index
                    });
                    this.markedIndexes.push({
                        'isRange': true,
                        'start': sortedRange[0].index,
                        'end': sortedRange[sortedRange.length - 1].index,
                        'label': label
                    });

                    const sorted = this.selectedTokens.sort((a, b) => {
                        return a.end - b.end
                    });
                    const start = sorted[0].start;
                    const end = sorted[sorted.length - 1].end;
                    this.markedEntities.push({
                        'start': start,
                        'end': end,
                        'label': label,
                        'text': this.completeText.substring(start, end+1),
                    });
                    this.selectedTokens = [];
                },
                removeEntity(index, resetSelected = true) {
                    this.markedEntities.splice(index, 1);
                    this.markedIndexes.splice(index, 1);
                    if (resetSelected === true) {
                        this.selectedTokens = [];
                    }
                },
                toNext() {
                    if(this.markedEntities.length <= 0) return null;
                    @this.toNext(this.markedEntities);
                },
                toggleToken(token, rest, index, spanMarkedIndex, spanSelectedIndex) {
                    if(spanMarkedIndex >= 0) {
                        this.removeEntity(spanMarkedIndex, false);
                    }
                    if(spanSelectedIndex >= 0) {
                        this.selectedTokens.splice(spanSelectedIndex, 1);
                        return;
                    }
                    let regx = new RegExp('\\b' + token + '\\b');
                    let indexIs = this.completeText.indexOf(rest)
                    this.selectedTokens.push({
                        'label': token,
                        'start': indexIs,
                        'end': indexIs + token.length -1,
                        'index': index
                    });
                },
                renderTokenizedText: function () {
                    let htmlContent = "";
                    let splitText = this.completeText.split(/(\W)/);
                    splitText.forEach((element, position) => {
                        if (element === " " || element === "") return null;
                        let selectedClass = ""
                        let clickedClass = ""
                        let spanMarkedIndex = -1
                        let spanSelectedIndex = -1
                        try {
                            this.markedIndexes.forEach((el, counter) => {
                                if ((el.isRange && (position >= el.start && position <= el.end))) {
                                    spanMarkedIndex = counter;
                                    switch (el.label) {
                                        case "AMOUNT":
                                            selectedClass = "bg-green-300";
                                            break;
                                        case "CURRENCY":
                                            selectedClass = "bg-yellow-300";
                                            break;
                                        case "FEES":
                                            selectedClass = "bg-pink-300";
                                            break;
                                        case "BALANCE":
                                            selectedClass = "bg-blue-300";
                                            break;
                                        case "REFERENCE":
                                            selectedClass = "bg-red-300";
                                            break;
                                        default:
                                            selectedClass = "bg-indigo-400";
                                            break;

                                    }
                                }
                            });

                            this.selectedTokens.forEach((token, ii) => {
                                if (token.index == position) {
                                    spanSelectedIndex = ii;
                                    clickedClass = "border border-black"
                                }
                            });
                        } catch (e) {
                            console.warn('catch ' + element)
                        }

                        let partial = ""
                        for (let ii = position; ii < splitText.length; ii++) {
                            partial += splitText[ii]
                        }

                        htmlContent += `
                            <span
                                x-on:click="toggleToken('${element}', '${partial}', '${position}', '${spanMarkedIndex}', '${spanSelectedIndex}')"
                                class="hover:bg-gray-200 px-1 mb-1 cursor-pointer ${selectedClass} ${clickedClass}">
                                ${element}
                            </span>
                        `
                    })

                    return htmlContent;
                },
            }
        }
    </script>


</div>
