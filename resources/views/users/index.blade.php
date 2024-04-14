<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                @if (session('success'))
                    <div x-data="{ isOpen: true }" x-show="isOpen" x-cloak x-transition.opacity.out.duration.300ms.in.duration.300ms
                        class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg shadow-md mb-8 relative" role="alert">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <strong class="font-bold">{{ __('Success!') }}</strong>
                            <span class="block sm:inline ml-2">{{ session('success') }}</span>
                        </div>
                        <button @click="isOpen = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.846 7.349 14.849a1.2 1.2 0 1 1-1.697-1.697l2.651-3.001-2.651-3.001a1.2 1.2 0 1 1 1.697-1.697L10 8.148l2.651-3.001a1.2 1.2 0 1 1 1.697 1.697L11.697 10l2.651 3.001a1.2 1.2 0 0 1 0 1.848z"/>
                            </svg>
                        </button>
                    </div>
                @endif

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Joined Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Block/Unblock
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Blocked on
                                </th>
                            </tr>
                        </thead>
                        @forelse ($users as $user)
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$user->name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$user->email}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$user->created_at->format('j M Y, g:i a')}}
                                    </td>
                                    <td class="px-6 py-4 {{$user->isBanned() ? 'text-red-500' : 'text-green-500'}}">
                                        {{$user->isBanned() ? 'Banned' : 'Active'}}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($user->isBanned())
                                            <form action="{{route('users.unblock', $user)}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <button type="submit">Unblock</button>
                                            </form>
                                        @else
                                            <form action="{{route('users.block', $user)}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <button type="submit">Block</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($user->banned_at)
                                            {{$user->banned_at->format('j M Y, g:i a')}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        @empty
                            <p>No users found.</p>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
