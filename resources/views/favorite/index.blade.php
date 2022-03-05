<x-layout>
    <div class="mx-auto flex flex-col items-center shrink-0">
    <h1 class="mb-6 mt-10 text-2xl">
        Your Favorites
    </h1>
    <div class="w-2/5 shrink-0">
    <x-panel>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($favorites as $favorite)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                        {{ $favorite->post->title }}"
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form method="POST" action="favorites/{{ $favorite->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="text-gray-400 text-xs">
                                                @if($favorite->read) 
                                                Mark as Unread
                                                @else
                                                Mark as Read
                                                @endif
                                            </button>
                                        </form> 
                                    </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form method="POST" action="favorites/{{ $favorite->post->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-gray-400 text-xs">
                                                Delete
                                            </button>
                                        </form> 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </x-panel>
    </div>
</x-layout>