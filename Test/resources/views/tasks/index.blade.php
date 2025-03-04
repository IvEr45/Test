<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center py-6 md:py-12 px-4">
    <div class="container mx-auto w-full max-w-lg md:max-w-2xl lg:max-w-3xl bg-white shadow-2xl rounded-2xl overflow-hidden transition-all duration-300 ease-in-out hover:scale-[1.01]">
        <div class="bg-blue-600 text-white p-4 md:p-6 flex flex-col md:flex-row items-center justify-between">
            <h1 class="text-2xl md:text-3xl font-bold flex items-center mb-2 md:mb-0">
                <i class="fas fa-tasks mr-2 md:mr-4"></i>
                Task Manager
            </h1>
            <div class="text-sm opacity-75">
                Total Tasks: <span class="font-bold">{{ $tasks->count() }}</span>
            </div>
        </div>

        <div class="p-4 md:p-6">
            <!-- Create Task Form -->
            <form action="/tasks" method="POST" class="mb-6 md:mb-8 bg-gray-50 p-4 md:p-6 rounded-lg border border-gray-200">
                @csrf
                <div class="grid grid-cols-1 gap-3 md:gap-4">
                    <input type="text" name="title" placeholder="Task Title" required 
                           class="w-full px-3 py-2 md:px-4 md:py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300 text-sm md:text-base">
                    <textarea name="description" placeholder="Task Description" required 
                              class="w-full px-3 py-2 md:px-4 md:py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300 h-24 text-sm md:text-base"></textarea>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 md:px-6 md:py-3 rounded-lg hover:bg-blue-700 transition duration-300 flex items-center justify-center text-sm md:text-base">
                        <i class="fas fa-plus mr-2"></i>
                        Add Task
                    </button>
                </div>
            </form>

            <!-- Tasks List -->
            <div class="space-y-3 md:space-y-4">
                <h2 class="text-xl md:text-2xl font-semibold mb-2 md:mb-4 text-gray-800 border-b pb-2">
                    <i class="fas fa-list-ul mr-2 md:mr-3 text-blue-600"></i>
                    Your Tasks
                </h2>

                @if($tasks->isEmpty())
                    <div class="text-center text-gray-500 py-8">
                        <i class="fas fa-clipboard-list text-4xl md:text-6xl mb-4 text-gray-300"></i>
                        <p class="text-sm md:text-base">No tasks yet. Create your first task!</p>
                    </div>
                @else
                    @foreach($tasks as $task)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition duration-300 group">
                            <div class="p-4 md:p-5 flex flex-col md:flex-row justify-between items-start space-y-3 md:space-y-0">
                                <div class="flex-grow">
                                    <h3 class="text-base md:text-lg font-bold text-gray-800 mb-1 md:mb-2">{{ $task->title }}</h3>
                                    <p class="text-sm md:text-base text-gray-600">{{ $task->description }}</p>
                                </div>
                                <div class="flex space-x-2 w-full md:w-auto justify-end opacity-100 md:opacity-0 group-hover:opacity-100 transition duration-300">
                                    <button onclick="toggleEditForm({{ $task->id }})" class="text-blue-500 hover:text-blue-700 p-2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/tasks/{{ $task->id }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 p-2">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Edit Task Form (Hidden by Default) -->
                            <form id="edit-form-{{ $task->id }}" action="/tasks/{{ $task->id }}" method="POST" 
                                  class="hidden p-4 md:p-5 bg-gray-50 border-t" style="display: none;">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-1 gap-3 md:gap-4">
                                    <input type="text" name="title" value="{{ $task->title }}" required
                                           class="w-full px-3 py-2 md:px-4 md:py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 text-sm md:text-base">
                                    <textarea name="description" required
                                              class="w-full px-3 py-2 md:px-4 md:py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 h-24 text-sm md:text-base">{{ $task->description }}</textarea>
                                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                                        <button type="submit" class="w-full md:flex-1 bg-green-500 text-white px-4 py-2 md:px-6 md:py-3 rounded-lg hover:bg-green-600 transition duration-300 text-sm md:text-base">
                                            Update Task
                                        </button>
                                        <button type="button" onclick="toggleEditForm({{ $task->id }})" 
                                                class="w-full md:flex-1 bg-gray-300 text-gray-800 px-4 py-2 md:px-6 md:py-3 rounded-lg hover:bg-gray-400 transition duration-300 text-sm md:text-base">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Success Message (Optional) -->
    @if(session('success'))
        <div id="success-message" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg z-50">
            {{ session('success') }}
            <button onclick="this.parentElement.remove();" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                ✖
            </button>
        </div>
    @endif

    <script>
        function toggleEditForm(taskId) {
            const editForm = document.getElementById(`edit-form-${taskId}`);
            editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
        }

        // Optional: Success message auto-dismiss
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.classList.add('animate-fadeOut');
                setTimeout(() => successMessage.remove(), 500);
            }, 3000);
        }
    </script>
</body>
</html>