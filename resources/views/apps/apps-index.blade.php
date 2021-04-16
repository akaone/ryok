<div class="flex flex-col mb-6">
    @section('title', trans('apps.index.title'))

    <div class="border-b pb-12 pt-6 px-4">
        stats graph
    </div>

    <div class="flex">
        <div class="flex flex-col gap-y-3 p-4 w-4/12">

            <div class="flex flex-col shadow-lg">
                <span class="bg-blue-600 text-white text-md p-2">Total disponible sur le compte</span>
                <span class="bg-blue-500 text-white p-4 text-2xl font-medium">145.000.000,00
                    <span class="text-sm font-bold absolute mt-1 ml-1 italic">XOF</span>
                </span>
            </div>

            <div class="flex flex-col shadow-lg">
                <span class="bg-green-500 text-white text-md p-2">Total récupéré</span>
                <span class="bg-green-400 text-white p-4 text-2xl font-medium">
                    390.058.000,00
                    <span class="text-sm font-bold absolute mt-1 ml-1 italic">XOF</span>
                </span>
            </div>

        </div>

        <div class="flex flex-col p-4 w-8/12 border-l">

            <div class="dark:text-gray-300 flex items-center justify-between">
                <span>Liste des retraits effectues</span>

                <a href="#" class="self-end flex items-center justify-center px-4 h-8 shadow bg-blue-500 rounded text-white font-light">
                    <span>Effectuer un retrait</span>
                </a>
            </div>

            <table class="my-2 dark:bg-gray-900 dark:border-gray-900 bg-gray-200 rounded border">
                    <tr class="border-b dark:text-gray-300 text-black">
                    <th class="text-sm py-3 px-2 font-light text-left w-4/12">Montant</th>
                    <th class="text-sm py-3 px-2 font-light text-left w-4/12">Date</th>
                    <th class="text-sm py-3 px-2 font-light text-left w-4/12">Etat</th>
                </tr>

                <tr class="border-b hover:bg-gray-100 cursor-default dark:bg-gray-200 bg-white text-gray-600">
                    <td class="py-3 flex items-center px-2 text-sm">-----</td>
                    <td class="py-3 px-2 text-sm font-medium">--------------</td>
                    <td class="py-3 px-2 text-sm">----------</td>
                </tr>
            </table>

        </div>
    </div>

</div>
