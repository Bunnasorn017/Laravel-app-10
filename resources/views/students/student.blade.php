<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js"
        integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-2xl" x-data="{ step: 1 }">
        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">
            <div class="px-8 py-6 bg-gradient-to-r from-blue-500 to-purple-600">
                <h3 class="text-2xl leading-6 font-semibold text-white">Student Registration</h3>
                <p class="mt-2 text-lg text-blue-100">Please fill in the student details</p>
            </div>
            <div class="px-8 py-6">
                @if (Session::has('student_add'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded"
                        role="alert">
                        <p class="font-bold text-lg">Success</p>
                        <p class="text-base">{{ Session::get('student_add') }}</p>
                    </div>
                @endif

                <form action="{{ route('student.store') }}" method="post" enctype="multipart/form-data"
                    class="space-y-8" x-ref="form">
                    @csrf
                    <div x-show="step === 1">
                        <div class="mb-6">
                            <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Name</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400 text-xl"></i>
                                </div>
                                <input type="text" name="name" id="name"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-12 pr-4 py-3 text-lg border-gray-300 rounded-lg"
                                    placeholder="John Doe" required>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="email" class="block text-lg font-medium text-gray-700 mb-2">Email</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400 text-xl"></i>
                                </div>
                                <input type="email" name="email" id="email"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-12 pr-4 py-3 text-lg border-gray-300 rounded-lg"
                                    placeholder="john@example.com" required>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" @click="step = 2"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-lg font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                                Next <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <div x-show="step === 2" x-cloak>
                        <div class="mb-6">
                            <label for="file" class="block text-lg font-medium text-gray-700 mb-2">Profile
                                Image</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-cloud-upload-alt fa-4x text-gray-400"></i>
                                    <div class="flex text-lg text-gray-600 mt-4">
                                        <label for="file"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file" name="file" type="file" class="sr-only"
                                                required>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-base text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button type="button" @click="step = 1"
                                class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-lg font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </button>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-lg font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                                <i class="fas fa-paper-plane mr-2"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Drag and drop functionality
        const dropzone = document.querySelector('form');
        const fileInput = document.getElementById('file');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropzone.classList.add('bg-indigo-100');
        }

        function unhighlight(e) {
            dropzone.classList.remove('bg-indigo-100');
        }

        dropzone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
        }
    </script>
</body>

</html>
