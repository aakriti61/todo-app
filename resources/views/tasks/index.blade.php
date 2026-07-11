<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            My Tasks
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between mb-4">
                    <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                        + Add Task
                    </a>
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded">
                        Manage Categories
                    </a>
                </div>

                @if (session('success'))
                    <p class="text-green-600 mb-4">{{ session('success') }}</p>
                @endif

                @forelse ($tasks as $task)
                    <div class="border dark:border-gray-700 rounded p-4 mb-3 {{ $task->completed ? 'opacity-50' : '' }}">
                        <div class="flex items-start justify-between">
                            <div>
                                <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox"
                                               onchange="this.form.submit()"
                                               {{ $task->completed ? 'checked' : '' }}>
                                        <span class="font-semibold dark:text-gray-200 {{ $task->completed ? 'line-through' : '' }}">
                                            {{ $task->title }}
                                        </span>
                                    </label>
                                </form>

                                @if ($task->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $task->description }}</p>
                                @endif

                                @if ($task->due_date)
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Due: {{ $task->due_date }}</p>
                                @endif

                                @if ($task->categories->count())
                                    <div class="mt-2 flex gap-2 flex-wrap">
                                        @foreach ($task->categories as $category)
                                            <span class="text-xs bg-blue-100 dark:bg-blue-900 dark:text-blue-200 px-2 py-1 rounded">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="flex gap-2 whitespace-nowrap">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-green-600">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="dark:text-gray-300">No tasks yet. Add your first one!</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>