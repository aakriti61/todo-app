<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Task
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('tasks.index') }}" class="text-sm text-blue-600 mb-4 inline-block">&larr; Back</a>

                @if ($errors->any())
                    <div class="text-red-600 mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label class="block font-medium dark:text-gray-200">Title</label>
                    <input type="text" name="title" value="{{ old('title', $task->title) }}"
                           class="w-full border rounded p-2 mt-1 mb-4 dark:bg-gray-700 dark:text-gray-200">

                    <label class="block font-medium dark:text-gray-200">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full border rounded p-2 mt-1 mb-4 dark:bg-gray-700 dark:text-gray-200">{{ old('description', $task->description) }}</textarea>

                    <label class="block font-medium dark:text-gray-200">Due Date</label>
                    <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}"
                           class="w-full border rounded p-2 mt-1 mb-4 dark:bg-gray-700 dark:text-gray-200">

                    <label class="block font-medium dark:text-gray-200 mb-1">Categories</label>
                    @if ($categories->count())
                        <div class="flex flex-wrap gap-3 mb-4">
                            @foreach ($categories as $category)
                                <label class="flex items-center gap-1 dark:text-gray-300">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                           {{ collect(old('categories', $selectedCategoryIds))->contains($category->id) ? 'checked' : '' }}>
                                    {{ $category->name }}
                                </label>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">No categories yet.</p>
                    @endif

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Update Task
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>