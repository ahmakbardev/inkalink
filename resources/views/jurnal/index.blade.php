@extends('layouts.layout')

@section('content')
    <!-- Guidance Modal -->
    <div id="guidanceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-10 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-xl transform scale-95 transition-transform duration-300">
            <h3 class="text-lg font-semibold mb-4">Panduan Mengisi Jurnal</h3>
            <div class="space-y-4">
                <p>Terdapat tiga template untuk merencanakan kariermu.</p>
                <ol class="list-decimal list-inside">
                    <li class="py-2"><b>Skill</b> - isikan mengenai kelebihan yang kamu miliki. <br><span class="font-semibold mt-4">Contoh</span>: menulis cerpen,
                        menari, membuat
                        desain grafis, dll. Kamu juga dapat menambahkan dokumentasi kelebihan kamu.</li>
                    <li class="py-2"><b>Goal Detail</b> - isikan mengenai tujuan yang ingin kamu capai, baik jangka pendek
                        maupun jangka
                        panjang beserta hal yang perlu dipersiapkan. <br><span class="font-semibold mt-4">Contoh</span>: SNBP UM - Kedokteran (Belajar IPA).</li>
                    <li class="py-2"><b>Kegiatan</b> - isikan dengan kegiatan yang kamu lakukan dalam mencapai goal detail
                        kamu. <br><span class="font-semibold mt-4">Contoh</span>:
                        mencari informasi bidang pekerjaan/prospek kerja jurusan (pada ruang kegiatan ini juga dapat
                        diberikan dengan dokumentasi kegiatan kamu).</li>
                </ol>
            </div>
            <div class="flex justify-end mt-4">
                <button onclick="closeModal('guidanceModal')"
                    class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded">Close</button>
            </div>
        </div>
    </div>

    <div class="min-h-screen bg-gray-50 py-10">
        <div class="container mx-auto px-4">
            <!-- Skill and Goal Detail Section -->
            <div class="flex flex-col md:flex-row gap-6 mb-10">
                <!-- Skill Section -->
                <div class="w-full md:w-1/2 bg-gradient-to-r from-blue-200 to-blue-300 p-6 rounded-lg shadow-lg relative">
                    <h3 class="text-xl font-semibold text-blue-900">Skill</h3>
                    <ul id="skillList" class="mt-4 flex items-center">
                        @foreach ($skills as $skill)
                            <li data-id="{{ $skill->id }}" class="w-fit">
                                <div class="relative w-fit group">
                                    <span
                                        class="inline-flex items-center px-3 py-1 mr-2 text-sm font-medium leading-5 text-blue-800 bg-blue-100 rounded-full">
                                        {{ $skill->content }}
                                    </span>
                                    <button
                                        class="absolute -top-2 -right-0 scale-0 transition-all ease-in-out group-hover:scale-100 rounded-full w-5 aspect-square bg-white flex items-center justify-center text-red-500 hover:text-red-700"
                                        onclick="removeEntry(this)">
                                        <i data-feather="x" class="w-3"></i>
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <button onclick="openModal('skillModal')"
                        class="absolute top-4 right-4 bg-blue-600 hover:bg-blue-700 text-white w-10 aspect-square flex justify-center items-center rounded-full shadow-lg transition transform hover:scale-110">
                        <i data-feather="plus"></i>
                    </button>
                </div>
                <!-- Goal Detail Section -->
                <div class="w-full md:w-1/2 bg-gradient-to-r from-green-200 to-green-300 p-6 rounded-lg shadow-lg relative">
                    <h3 class="text-xl font-semibold text-green-900">Goal Detail</h3>
                    <ul id="goalList" class="mt-4 flex items-center">
                        @foreach ($goals as $goal)
                            <li data-id="{{ $goal->id }}">
                                <div class="relative w-fit group">
                                    <span
                                        class="inline-flex items-center px-3 py-1 mr-2 text-sm font-medium leading-5 text-green-800 bg-green-100 rounded-full">
                                        {{ $goal->content }}
                                    </span>
                                    <button
                                        class="absolute -top-2 -right-0 scale-0 transition-all ease-in-out group-hover:scale-100 rounded-full w-5 aspect-square bg-white flex items-center justify-center text-red-500 hover:text-red-700"
                                        onclick="removeEntry(this)">
                                        <i data-feather="x" class="w-3"></i>
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <button onclick="openModal('goalModal')"
                        class="absolute top-4 right-4 bg-green-600 hover:bg-green-700 text-white w-10 aspect-square flex justify-center items-center rounded-full shadow-lg transition transform hover:scale-110">
                        <i data-feather="plus"></i>
                    </button>
                </div>
            </div>

            <!-- Todo List Section -->
            <div class="bg-gradient-to-r from-white to-white p-6 rounded-lg shadow-lg relative mb-10">
                <h3 class="text-xl font-semibold text-purple-900">Kegiatan</h3>
                <div class="max-h-[400px] overflow-auto" data-simplebar>
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
                            @foreach ($todos as $todo)
                                <tr data-id="{{ $todo->id }}"
                                    class="py-2 {{ $todo->completed_at ? 'line-through' : '' }}">
                                    <td class="text-center p-2">{{ $loop->iteration }}</td>
                                    <td class="text-center p-2">{{ $todo->date }}</td>
                                    <td class="text-center p-2">{{ $todo->content }}</td>
                                    <td class="text-center p-2">
                                        @if (!$todo->completed_at)
                                            <button class="text-green-500 hover:text-green-700 mr-2"
                                                onclick="markAsDone(this)">
                                                <i data-feather="check" class="w-5"></i>
                                            </button>
                                        @endif
                                        <button class="text-red-500 hover:text-red-700" onclick="removeEntry(this)">
                                            <i data-feather="x" class="w-5"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
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
        <div
            class="bg-white p-6 rounded-lg shadow-md w-full max-w-md transform scale-95 transition-transform duration-300">
            <h3 class="text-lg font-semibold mb-4">Add Todo</h3>
            <input type="date" id="newTodoDate" class="border border-gray-300 p-2 rounded w-full mb-4"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                $.post("{{ route('jurnal.store') }}", {
                    _token: '{{ csrf_token() }}',
                    type: 'skill',
                    content: skill
                }, function(data) {
                    const li = document.createElement('li');
                    li.classList.add('w-fit');
                    li.setAttribute('data-id', data.id);
                    li.innerHTML = `
                        <div class="relative w-fit group">
                            <span class="inline-flex items-center px-3 py-1 mr-2 text-sm font-medium leading-5 text-blue-800 bg-blue-100 rounded-full">
                                ${skill}
                            </span>
                            <button class="absolute -top-2 -right-0 scale-0 transition-all ease-in-out group-hover:scale-100 rounded-full w-5 aspect-square bg-white flex items-center justify-center text-red-500 hover:text-red-700" onclick="removeEntry(this)">
                                <i data-feather="x" class="w-3"></i>
                            </button>
                        </div>
                    `;
                    document.getElementById('skillList').appendChild(li);
                    document.getElementById('newSkill').value = '';
                    closeModal('skillModal');
                    showToast('Skill added successfully!');
                    feather.replace();
                });
            }
        }

        function addGoal() {
            const goal = document.getElementById('newGoal').value;
            if (goal) {
                $.post("{{ route('jurnal.store') }}", {
                    _token: '{{ csrf_token() }}',
                    type: 'goal',
                    content: goal
                }, function(data) {
                    const li = document.createElement('li');
                    li.classList.add('w-fit');
                    li.setAttribute('data-id', data.id);
                    li.innerHTML = `
                        <div class="relative w-fit group">
                            <span class="inline-flex items-center px-3 py-1 mr-2 text-sm font-medium leading-5 text-green-800 bg-green-100 rounded-full">
                                ${goal}
                            </span>
                            <button class="absolute -top-2 -right-0 scale-0 transition-all ease-in-out group-hover:scale-100 rounded-full w-5 aspect-square bg-white flex items-center justify-center text-red-500 hover:text-red-700" onclick="removeEntry(this)">
                                <i data-feather="x" class="w-3"></i>
                            </button>
                        </div>
                    `;
                    document.getElementById('goalList').appendChild(li);
                    document.getElementById('newGoal').value = '';
                    closeModal('goalModal');
                    showToast('Goal added successfully!');
                    feather.replace();
                });
            }
        }

        function addTodo() {
            const date = document.getElementById('newTodoDate').value;
            const activity = document.getElementById('newTodoActivity').value;
            if (date && activity) {
                $.post("{{ route('jurnal.store') }}", {
                    _token: '{{ csrf_token() }}',
                    type: 'todo',
                    content: activity,
                    date: date
                }, function(data) {
                    const row = document.createElement('tr');
                    row.setAttribute('data-id', data.id);
                    row.classList.add('py-2');
                    row.innerHTML = `
                        <td class="text-center p-2">${document.querySelectorAll('#todoList tr').length + 1}</td>
                        <td class="text-center p-2">${date}</td>
                        <td class="text-center p-2">${activity}</td>
                        <td class="text-center p-2">
                            <button class="text-green-500 hover:text-green-700 mr-2" onclick="markAsDone(this)">
                                <i data-feather="check" class="w-5"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-700" onclick="removeEntry(this)">
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
                });
            }
        }

        function removeEntry(button) {
            const entryId = button.closest('[data-id]').getAttribute('data-id');
            if (entryId) {
                $.ajax({
                    url: `/jurnal/${entryId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        button.closest('[data-id]').remove();
                        showToast('Entry removed successfully!');
                    },
                    error: function(xhr) {
                        showToast('Failed to remove entry!');
                    }
                });
            }
        }

        function markAsDone(button) {
            const row = button.closest('tr');
            const entryId = row.getAttribute('data-id');
            if (entryId) {
                $.ajax({
                    url: `/jurnal/${entryId}/done`,
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        row.classList.add('line-through');
                        button.remove();
                        showToast('Todo marked as done!');
                    },
                    error: function(xhr) {
                        showToast('Failed to mark as done!');
                    }
                });
            }
        }

        $(document).ready(function() {
            feather.replace();
        });

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.children[0].classList.remove('scale-95');
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('opacity-0');
            modal.children[0].classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Open the guidance modal when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            openModal('guidanceModal');
        });
    </script>
@endsection
