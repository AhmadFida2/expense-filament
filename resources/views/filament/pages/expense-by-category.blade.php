<x-filament-panels::page>

    <div class="container bg-white border-2 rounded-xl md:w-48 p-3 shadow-lg flex d-print-none">
        <form wire:submit="create" class="space-y-2">
            {{ $this->form }}

            <x-filament::button type="submit">
                Get Report
            </x-filament::button>
        </form>
        <x-filament-actions::modals/>
    </div>

    @if(isset($expenses))

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <p class="w-full text-center text-xl font-black py-3">Expense Statement -</p>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Sr. No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Transaction Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Amount
                    </th>
                </tr>
                </thead>
                <tbody>
                @if($expenses)
                    <tr>
                        <td colspan="5"><b>Expenses</b></td>
                    </tr>
                    @foreach($expenses as $expense)

                        @if($loop->odd)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$loop->iteration}}
                                </th>
                                <td class="px-6 py-4">
                                    Expense
                                </td>
                                <td class="px-6 py-4">
                                    {{$expense->expense_date}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$expense->expense_category->category_name}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$expense->expense_amount}}
                                </td>
                            </tr>
                        @else
                            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$loop->iteration}}
                                </th>
                                <td class="px-6 py-4">
                                    Expense
                                </td>
                                <td class="px-6 py-4">
                                    {{$expense->expense_date}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$expense->expense_category->category_name}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$expense->expense_amount}}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                @endif
                </tbody>
            </table>
        </div>

    @endif


</x-filament-panels::page>
