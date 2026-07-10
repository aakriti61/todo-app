<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('categories.index') }}" class="text-sm text-blue-600 mb-4 inline-block">&larr; Back</a>

                @if ($errors->any())
                    <div class="text-red-600 mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <label class="block font-medium dark:text-gray-200">Category Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border rounded p-2 mt-1 mb-4 dark:bg-gray-700 dark:text-gray-200">

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Save Category
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>