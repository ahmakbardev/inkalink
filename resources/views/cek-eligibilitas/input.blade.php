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
            // Open modal on page load
            openModal();

            let semesterCount = 0;

            function addSemester() {
                semesterCount++;
                const semesterHtml = `
                    <div class="semester-section mb-6 p-4 border rounded bg-gray-50">
                        <h4 class="text-lg font-semibold mb-3">Semester ${semesterCount}</h4>
                        <div class="grid grid-cols-3 gap-4">
                            ${['Bahasa Indonesia', 'Matematika', 'Bahasa Inggris', 'Sejarah Indonesia', 'Seni Budaya', 'Kimia', 'Biologi', 'Fisika', 'PAI', 'Prakarya dan KWU'].map(subject => `
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">${subject}</label>
                                                <input type="number" name="grades[${semesterCount}][${subject}]" class="grade-input mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Nilai" oninput="validateInput(this)">
                                            </div>
                                        `).join('')}
                        </div>
                    </div>
                `;
                $('#semestersContainer').append(semesterHtml);
                attachInputListeners();
            }

            function attachInputListeners() {
                $('.grade-input').on('input change', function() {
                    validateInput(this);
                    calculateAverage();
                });
            }

            function validateInput(input) {
                if (parseInt(input.value) > 100) {
                    input.value = 100; // Corrects the value if it's over 100
                } else if (parseInt(input.value) < 0) {
                    input.value = 0; // Prevents negative numbers
                }
            }

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

            $('#addSemesterButton').click(function() {
                addSemester();
            });

            // Initially load one semester
            addSemester();

            // Lottie Animation
            lottie.loadAnimation({
                container: document.getElementById('lottie-animation'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '{{ asset('assets/lottie/school.json') }}' // Change to your Lottie JSON file path
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
