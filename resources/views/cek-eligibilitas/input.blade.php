@extends('layouts.layout')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="container mx-auto px-4">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Eligibilitas Nilai</h2>
                <h3 class="text-xl text-center text-gray-600 mb-10">Input nilai sesuai dengan hasil belajarmu dalam raport
                </h3>

                <form id="gradeInputForm">
                    <div id="semestersContainer">
                        <!-- Semester inputs will be added here dynamically -->
                    </div>

                    <div class="mt-4 text-center">
                        <button type="button" id="addSemesterButton"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Tambahkan Semester
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
                <button onclick="showRecommendations()"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                    Rekomendasi Inkalink...
                </button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
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
        });
    </script>
@endsection
