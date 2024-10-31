<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Browse All Dreams
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Dream name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dreams as $dream)


                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $dream->id}}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ str($dream->content)->limit(25) }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $dream->created_at->diffForhumans() }}
                                    </td>

                                    {{-- <td class="px-6 py-4 text-right space-x-2">
                                        <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{ route('dreams.edit',$dream->id) }}">Edit</a>
                                        <form action="{{ route('dreams.destroy',$dream->id) }}" method="post" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="font-medium text-red-600 dark:text-blue-500 hover:underline">

                                    </td> --}}
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{ route('dreams.edit', $dream->id) }}">Edit</a>

                                        <!-- Make the Delete form independent -->
                                        <form action="{{ route('dreams.destroy', $dream->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="font-medium text-red-600 dark:text-blue-500 hover:underline">
                                        </form>
                                    </td>



                                </tr>

                                @empty
                                <tr>
                                    No Dreams Yet. Create a new Dream
                                </tr>

                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
