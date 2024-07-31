@extends('layouts.layout')

@section('content')
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="container mx-auto px-4">
            <!-- Skill and Goal Detail Section -->
            <div class="flex flex-col md:flex-row gap-6 mb-10">
                <!-- Skill Section -->
                <div class="w-full md:w-1/2 bg-gradient-to-r from-blue-200 to-blue-300 p-6 rounded-lg shadow-lg relative">
                    <h3 class="text-xl font-semibold text-blue-900">Skill</h3>
                    <ul id="skillList" class="mt-4 space-y-2">
                        <!-- List of skills will be dynamically added here -->
                    </ul>
                    <button onclick="openModal('skillModal')"
                        class="absolute top-4 right-4 bg-blue-600 hover:bg-blue-700 text-white w-10 aspect-square flex justify-center items-center rounded-full shadow-lg transition transform hover:scale-110">
                        <i data-feather="plus"></i>
                    </button>
                </div>
                <!-- Goal Detail Section -->
                <div class="w-full md:w-1/2 bg-gradient-to-r from-green-200 to-green-300 p-6 rounded-lg shadow-lg relative">
                    <h3 class="text-xl font-semibold text-green-900">Goal Detail</h3>
                    <ul id="goalList" class="mt-4 space-y-2">
                        <!-- List of goals will be dynamically added here -->
                    </ul>
                    <button onclick="openModal('goalModal')"
                        class="absolute top-4 right-4 bg-green-600 hover:bg-green-700 text-white w-10 aspect-square flex justify-center items-center rounded-full shadow-lg transition transform hover:scale-110">
                        <i data-feather="plus"></i>
                    </button>
                </div>
            </div>

            <!-- Todo List Section -->
            <div class="bg-gradient-to-r from-purple-200 to-purple-300 p-6 rounded-lg shadow-lg relative mb-10">
                <h3 class="text-xl font-semibold text-purple-900">Kegiatan</h3>
                <div class="max-h-32 overflow-auto" data-simplebar>
                    <table class="w-full mt-4 table-fixed">
                        <thead class="sticky top-0">
                            <tr class="bg-purple-400 text-purple-900">
                                <th class="w-1/12 p-2">No</th>
                                <th class="w-3/12 p-2">Hari / Tanggal</th>
                                <th class="w-6/12 p-2">Kegiatan</th>
                                <th class="w-2/12 p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="todoList" class="text-purple-800">
                            <!-- List of todos will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
                <button onclick="openModal('todoModal')"
                    class="absolute top-4 right-4 bg-purple-600 hover:bg-purple-700 text-white w-10 aspect-square flex justify-center items-center rounded-full shadow-lg transition transform hover:scale-110">
                    <i data-feather="plus"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Skill Modal -->
    <div id="skillModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md transform scale-95 transition-transform duration-300">
            <h3 class="text-lg font-semibold mb-4">Add Skill</h3>
            <input type="text" id="newSkill" class="border border-gray-300 p-2 rounded w-full mb-4" placeholder="Skill">
            <div class="flex justify-end">
                <button onclick="closeModal('skillModal')"
                    class="bg-red-500 hover:bg-red-600 text-white p-2 rounded mr-2">Cancel</button>
                <button onclick="addSkill()" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Add</button>
            </div>
        </div>
    </div>

    <!-- Goal Modal -->
    <div id="goalModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md transform scale-95 transition-transform duration-300">
            <h3 class="text-lg font-semibold mb-4">Add Goal</h3>
            <input type="text" id="newGoal" class="border border-gray-300 p-2 rounded w-full mb-4" placeholder="Goal">
            <div class="flex justify-end">
                <button onclick="closeModal('goalModal')"
                    class="bg-red-500 hover:bg-red-600 text-white p-2 rounded mr-2">Cancel</button>
                <button onclick="addGoal()" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Add</button>
            </div>
        </div>
    </div>

    <!-- Todo Modal -->
    <div id="todoModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md transform scale-95 transition-transform duration-300">
            <h3 class="text-lg font-semibold mb-4">Add Todo</h3>
            <input type="text" id="newTodoDate" class="border border-gray-300 p-2 rounded w-full mb-4"
                placeholder="Date">
            <input type="text" id="newTodoActivity" class="border border-gray-300 p-2 rounded w-full mb-4"
                placeholder="Activity">
            <div class="flex justify-end">
                <button onclick="closeModal('todoModal')"
                    class="bg-red-500 hover:bg-red-600 text-white p-2 rounded mr-2">Cancel</button>
                <button onclick="addTodo()" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Add</button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-5 right-5 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg hidden">
        <span id="toastMessage"></span>
    </div>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.children[0].classList.remove('scale-95');
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.children[0].classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            toastMessage.textContent = message;
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }

        function addSkill() {
            const skill = document.getElementById('newSkill').value;
            if (skill) {
                const li = document.createElement('li');
                li.innerHTML = `
                    <div class="relative w-fit group">
                        <span class="inline-flex items-center px-3 py-1 mr-2 text-sm font-medium leading-5 text-blue-800 bg-blue-100 rounded-full">
                            ${skill}
                        </span>
                        <button class="absolute -top-2 -right-0 scale-0 transition-all ease-in-out group-hover:scale-100 rounded-full w-5 aspect-square bg-white flex items-center justify-center text-red-500 hover:text-red-700" onclick="removeSkill(this)">
                            <i data-feather="x" class="w-3"></i>
                        </button>
                    </div>
                `;
                document.getElementById('skillList').appendChild(li);
                document.getElementById('newSkill').value = '';
                closeModal('skillModal');
                showToast('Skill added successfully!');
                feather.replace();
            }
        }

        function addGoal() {
            const goal = document.getElementById('newGoal').value;
            if (goal) {
                const li = document.createElement('li');
                li.innerHTML = `
                    <div class="relative w-fit group">
                        <span class="inline-flex items-center px-3 py-1 mr-2 text-sm font-medium leading-5 text-green-800 bg-green-100 rounded-full">
                            ${goal}
                        </span>
                        <button class="absolute -top-2 -right-0 scale-0 transition-all ease-in-out group-hover:scale-100 rounded-full w-5 aspect-square bg-white flex items-center justify-center text-red-500 hover:text-red-700" onclick="removeGoal(this)">
                            <i data-feather="x" class="w-3"></i>
                        </button>
                    </div>
                `;
                document.getElementById('goalList').appendChild(li);
                document.getElementById('newGoal').value = '';
                closeModal('goalModal');
                showToast('Goal added successfully!');
                feather.replace();
            }
        }

        function addTodo() {
            const date = document.getElementById('newTodoDate').value;
            const activity = document.getElementById('newTodoActivity').value;
            if (date && activity) {
                const row = document.createElement('tr');
                row.classList.add('py-2');
                row.innerHTML = `
                    <td class="text-center p-2">${document.querySelectorAll('#todoList tr').length + 1}</td>
                    <td class="text-center p-2">${date}</td>
                    <td class="text-center p-2">${activity}</td>
                    <td class="text-center p-2">
                        <button class="text-green-500 hover:text-green-700 mr-2" onclick="markAsDone(this)">
                            <i data-feather="check" class="w-5"></i>
                        </button>
                        <button class="text-red-500 hover:text-red-700" onclick="removeTodo(this)">
                            <i data-feather="x" class="w-5"></i>
                        </button>
                    </td>
                `;
                document.getElementById('todoList').appendChild(row);
                document.getElementById('newTodoDate').value = '';
                document.getElementById('newTodoActivity').value = '';
                closeModal('todoModal');
                showToast('Todo added successfully!');
                feather.replace();
            }
        }

        function removeSkill(button) {
            button.closest('li').remove();
            showToast('Skill removed successfully!');
        }

        function removeGoal(button) {
            button.closest('li').remove();
            showToast('Goal removed successfully!');
        }

        function removeTodo(button) {
            button.closest('tr').remove();
            showToast('Todo removed successfully!');
            updateTodoNumbers();
        }

        function markAsDone(button) {
            const row = button.closest('tr');
            row.classList.add('line-through');
            button.remove();
            showToast('Todo marked as done!');
        }

        function updateTodoNumbers() {
            document.querySelectorAll('#todoList tr').forEach((row, index) => {
                row.children[0].textContent = index + 1;
            });
        }
    </script>
@endsection
