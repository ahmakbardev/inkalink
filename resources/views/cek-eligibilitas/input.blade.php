@extends('layouts.layout')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="container mx-auto px-4">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Eligibilitas Nilai</h2>
                <h3 class="text-xl text-center text-gray-600 mb-10">Input nilai sesuai dengan hasil belajarmu dalam raport
                </h3>

                <form id="gradeInputForm" method="POST" action="{{ route('cek-eligibilitas.hasil') }}">
                    @csrf
                    <div id="semestersContainer">
                        <!-- Semester inputs will be added here dynamically -->
                    </div>

                    <div class="mt-4 text-center">
                        <button type="button" id="addSemesterButton"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Tambahkan Semester
                        </button>
                        <button type="button" id="addSubjectButton"
                            class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded mt-2">
                            Tambahkan Mata Pelajaran
                        </button>
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-4">
                            Cek Eligibilitas
                        </button>
                    </div>
                </form>
            </div>

            <!-- Average and Recommendation Section -->
            <div class="mt-10 p-4 bg-blue-700 text-white rounded-lg shadow flex justify-between items-center">
                <div>
                    <h4 class="font-semibold text-lg">Rata-Rata Nilai Keseluruhan</h4>
                    <p id="overallAverage" class="text-xl">—</p>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="welcomeModal"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center transition-opacity duration-500 opacity-0">
            <div
                class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl transform scale-90 transition-transform duration-500">
                <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <div class="text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Panduan Input Nilai</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">Lakukan input nilai untuk mengetahui peluang perguruan tinggi
                            berdasarkan nilai akademik kamu. Isikan nilai sesuai dengan nilai raport kamu.</p>
                        <p class="text-sm text-gray-500">Input nilai dapat dilakukan secara mandiri namun tetap dalam
                            pengawasan guru BK.</p>
                        <p class="text-sm text-gray-500">Tekan tombol "buat" untuk memulai input data nilai kamu.</p>
                    </div>
                    <div class="mt-4">
                        <div id="lottie-animation" class="mb-4 h-52 object-contain"></div>
                        <button onclick="closeModal()"
                            class="px-4 py-2 bg-primary-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-primary-700 transition-all ease-in-out">
                            Mulai
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.11/lottie.min.js"></script>

    <script>
        $(document).ready(function() {
            openModal(); // Open modal on page load

            let semesterCount = 0;
            let subjects = [];

            function addSemester() {
                semesterCount++;
                const cancelButton = semesterCount > 1 ?
                    `<button type="button" class="remove-semester bg-red-500 text-white px-4 py-1 rounded mb-3" data-semester-id="${semesterCount}">Cancel Semester</button>` :
                    ''; // Tidak menampilkan tombol cancel untuk semester 1

                const semesterHtml = `
                    <div class="semester-section mb-6 p-4 border rounded bg-gray-50" id="semester-${semesterCount}">
                        <h4 class="text-lg font-semibold mb-3">Semester ${semesterCount}</h4>
                        ${cancelButton}
                        <div class="grid grid-cols-3 gap-4" id="subjectsContainer-${semesterCount}">
                            ${generateSubjectInputs(semesterCount)}
                        </div>
                    </div>
                `;
                $('#semestersContainer').append(semesterHtml);
                calculateAverage();
            }


            // Generate subject inputs
            function generateSubjectInputs(semesterId) {
                if (subjects.length === 0) {
                    return '<p class="text-sm text-gray-500 col-span-3">Belum ada mata pelajaran yang ditambahkan. Silakan tambahkan mata pelajaran.</p>';
                }
                return subjects.map((subject, index) => `
            <div id="subject-${semesterId}-${index}" class="relative">
                <label class="block text-sm font-medium text-gray-700">${subject}</label>
                <input type="number" name="grades[${semesterId}][${subject}]" class="grade-input mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm" placeholder="Nilai" oninput="validateInput(this)">
                <button type="button" class="edit-subject absolute top-0 right-16 bg-yellow-500 text-white px-2 py-1 rounded" data-semester-id="${semesterId}" data-subject-index="${index}">Edit</button>
                <button type="button" class="remove-subject absolute top-0 right-0 bg-red-500 text-white px-2 py-1 rounded" data-semester-id="${semesterId}" data-subject-index="${index}">Hapus</button>
            </div>
        `).join('');
            }

            // Add custom subject to all semesters
            function addCustomSubject() {
                const newSubject = prompt("Masukkan nama mata pelajaran baru:");
                if (newSubject) {
                    subjects.push(newSubject); // Tambahkan mata pelajaran baru ke array
                    // Hanya tambahkan mata pelajaran baru ke setiap semester, tanpa menggandakan
                    $('.semester-section .grid').each(function(index, semester) {
                        const semesterId = index + 1;
                        $(semester).append(`
                    <div id="subject-${semesterId}-${subjects.length - 1}" class="relative">
                        <label class="block text-sm font-medium text-gray-700">${newSubject}</label>
                        <input type="number" name="grades[${semesterId}][${newSubject}]" class="grade-input mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm" placeholder="Nilai" oninput="validateInput(this)">
                        <button type="button" class="edit-subject absolute top-0 right-16 bg-yellow-500 text-white px-2 py-1 rounded" data-semester-id="${semesterId}" data-subject-index="${subjects.length - 1}">Edit</button>
                        <button type="button" class="remove-subject absolute top-0 right-0 bg-red-500 text-white px-2 py-1 rounded" data-semester-id="${semesterId}" data-subject-index="${subjects.length - 1}">Hapus</button>
                    </div>
                `);
                    });
                }
            }

            // Event delegation for dynamically created grade inputs
            $(document).on('input', '.grade-input', function() {
                validateInput(this);
                calculateAverage();
            });

            $(document).on('click', '.remove-semester', function() {
                const semesterId = $(this).data('semester-id');
                $(`#semester-${semesterId}`).remove();

                // Reorder remaining semesters
                reorderSemesters();
                calculateAverage();
            });


            function reorderSemesters() {
                // Mengambil semua elemen semester yang tersisa
                let remainingSemesters = $('.semester-section');

                // Reset semesterCount untuk mengatur ulang dari awal
                semesterCount = 0;

                // Loop melalui semua semester yang ada dan set ulang ID dan teks
                remainingSemesters.each(function(index) {
                    semesterCount = index + 1;
                    const semesterElement = $(this);

                    // Set ulang ID dan label semester
                    semesterElement.attr('id', `semester-${semesterCount}`);
                    semesterElement.find('h4').text(`Semester ${semesterCount}`);

                    // Update tombol Cancel Semester
                    const cancelButton = semesterCount > 1 ?
                        `<button type="button" class="remove-semester bg-red-500 text-white px-4 py-1 rounded mb-3" data-semester-id="${semesterCount}">Cancel Semester</button>` :
                        ''; // Tidak menampilkan tombol cancel untuk semester 1

                    semesterElement.find('.remove-semester').remove(); // Hapus tombol yang lama
                    if (cancelButton) {
                        semesterElement.prepend(cancelButton); // Tambahkan tombol cancel baru
                    }

                    // Update semua elemen subject yang ada dengan semester ID baru
                    semesterElement.find('.grade-input').each(function() {
                        const subjectIndex = $(this).closest('.relative').attr('id').split('-')[
                            2]; // Ambil index subject
                        $(this).attr('name', `grades[${semesterCount}][${subjects[subjectIndex]}]`);
                    });
                });
            }


            // Event delegation for editing subject
            $(document).on('click', '.edit-subject', function() {
                const semesterId = $(this).data('semester-id');
                const subjectIndex = $(this).data('subject-index');
                const newSubjectName = prompt("Edit nama mata pelajaran:", subjects[subjectIndex]);
                if (newSubjectName) {
                    subjects[subjectIndex] = newSubjectName;
                    $(`#subject-${semesterId}-${subjectIndex} label`).text(newSubjectName);
                    $(`#subject-${semesterId}-${subjectIndex} input`).attr('name',
                        `grades[${semesterId}][${newSubjectName}]`);
                }
            });

            // Event delegation for removing subject
            $(document).on('click', '.remove-subject', function() {
                const semesterId = $(this).data('semester-id');
                const subjectIndex = $(this).data('subject-index');
                subjects.splice(subjectIndex, 1); // Remove the subject from the array
                $(`#subject-${semesterId}-${subjectIndex}`).remove(); // Remove the subject element
                calculateAverage();
            });

            // Validate input
            function validateInput(input) {
                if (parseInt(input.value) > 100) {
                    input.value = 100;
                } else if (parseInt(input.value) < 0) {
                    input.value = 0;
                }
            }

            // Calculate average
            function calculateAverage() {
                let total = 0;
                let count = 0;
                $('.grade-input').each(function() {
                    const value = parseInt($(this).val());
                    if (!isNaN(value)) {
                        total += value;
                        count++;
                    }
                });
                const average = count > 0 ? (total / count).toFixed(2) : '—';
                $('#overallAverage').text(average);
            }

            // Attach listeners for input
            function attachInputListeners() {
                $('.grade-input').on('input change', function() {
                    validateInput(this);
                    calculateAverage();
                });
            }

            // Initialize with one semester
            $('#addSemesterButton').click(function() {
                addSemester();
            });

            $('#addSubjectButton').click(function() {
                addCustomSubject();
            });

            // Initially load one semester
            addSemester();

            // Lottie Animation
            lottie.loadAnimation({
                container: document.getElementById('lottie-animation'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '{{ asset('assets/lottie/school.json') }}'
            });
        });

        function openModal() {
            const modal = document.getElementById('welcomeModal');
            modal.style.opacity = 1;
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.querySelector('.transform').classList.remove('scale-90');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('welcomeModal');
            modal.querySelector('.transform').classList.add('scale-90');
            setTimeout(() => {
                modal.style.opacity = 0;
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 500);
            }, 300);
        }
    </script>
@endsection
