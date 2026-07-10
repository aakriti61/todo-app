<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            My Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('categories.create') }}"
                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded mb-4">
                    + Add Category
                </a>

                @if (session('success'))
                    <p class="text-green-600 mb-4">{{ session('success') }}</p>
                @endif

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b dark:border-gray-700">
                            <th class="text-left py-2 dark:text-gray-200">Name</th>
                            <th class="text-left py-2 dark:text-gray-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2 dark:text-gray-300">{{ $category->name }}</td>
                                <td class="py-2">
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                       class="text-green-600 mr-2">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Are you sure?')"
                                                class="text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-2 dark:text-gray-300">No categories yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>