<!DOCTYPE html>Add commentMore actions
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Tailwind / DaisyUI / Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="bg-main w-full">

    <div class="max-w-4xl mx-auto py-6 md:py-10 px-4 sm:px-6 text-white">
        <!-- Progress indicator -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-2">
                <div class="text-sm font-medium text-amber-400">Step 3 of 3</div>
                <div class="text-sm font-medium">Confirmation</div>
            </div>
            <div class="w-full bg-gray-700 rounded-full h-2.5">
                <div class="bg-amber-500 h-2.5 rounded-full" style="width: 100%"></div>
            </div>
        </div>

        <h2 class="text-3xl font-bold mb-6 text-center">Review Your Order</h2>

        <!-- Success message placeholder (would appear after submission) -->
        <div class="hidden bg-green-900/50 border border-green-500 rounded-lg p-4 mb-6 transition-all duration-300 ease-in-out">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">Payment received! Your tickets have been booked.</span>
            </div>
        </div>

        <div class="bg-gray-800/80 backdrop-filter backdrop-blur-sm rounded-xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2 gap-8 p-6 md:p-8 border border-gray-700/50">
            <!-- Movie Poster and Info -->
            <div class="flex flex-col">
                <div class="flex flex-col items-center text-center mb-6">
                    <img src="{{ asset('storage/' . $showtime->film->poster) }}" alt="{{ $showtime->film->title }}" class="w-48 h-64 object-cover rounded-lg shadow-lg mb-4 transform hover:scale-105 transition-transform duration-300" loading="lazy">
                    <h3 class="text-2xl font-bold">{{ $showtime->film->title }}</h3>
                    <p class="text-sm text-gray-300 mt-1 italic">{{ $showtime->film->genre }} • {{ $showtime->film->duration }} menit</p>
                    <p class="text-sm text-gray-400 mt-2">Directed by <span class="text-white font-semibold">{{ $showtime->film->director }}</span></p>
                </div>

                <!-- QR Code placeholder (would appear after payment) -->
                <div class="hidden mt-auto bg-white/10 p-4 rounded-lg border border-dashed border-white/20 text-center">
                    <p class="text-sm font-medium mb-2">Your e-Ticket</p>
                    <div class="inline-block bg-white p-2 rounded">
                        <!-- QR code would be generated here -->
                        <div class="w-24 h-24 bg-gray-300 flex items-center justify-center">
                            <span class="text-gray-600 text-xs">QR Code</span>
                        </div>
                    </div>
                    <p class="text-xs mt-2 text-gray-400">Show this at the theater entrance</p>
                </div>
            </div>

            <!-- Transaction Details -->
            <div class="space-y-6">
                <div class="bg-gray-900/50 p-5 rounded-lg border border-gray-700/50">
                    <h3 class="font-bold text-xl mb-4 pb-2 border-b border-gray-700/50 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                        </svg>
                        Order Summary
                    </h3>

                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Date & Time</span>
                            <span class="font-medium">{{ $showtime->show_date }} • {{ $showtime->show_time }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-400">Theater</span>
                            <span class="font-medium">{{ $showtime->studio->name }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-400">Seats</span>
                            <span class="font-medium">{{ count($seats) }} Tiket</span>
                        </div>

                        <div class="flex justify-between pt-3 border-t border-gray-700/50">
                            <span class="text-gray-400">Total</span>
                            <span class="text-xl font-bold text-amber-500">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Confirmation Form -->
                <form method="POST" action="/seat/finalize" class="bg-gray-900/50 p-5 rounded-lg border border-gray-700/50" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
                    @foreach($seats as $seat)
                    <input type="hidden" name="seat_ids[]" value="{{ $seat->id }}">
                    @endforeach

                    <h3 class="font-bold text-xl mb-4 pb-2 border-b border-gray-700/50 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        Payment Details
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-300">Payment Method</label>
                            <div class="relative">
                                <select name="payment_method" class="appearance-none w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 pr-8 focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                                    <option value="manual">Manual Transfer</option>
                                    <option value="bca">BCA</option>
                                    <option value="e-wallet">E-Wallet</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Payment instructions that change based on selection -->
                        <div class="bg-gray-800/50 p-3 rounded-lg border border-gray-700/30 text-sm hidden" id="paymentInstructions">
                            <div class="font-medium mb-1">Payment Instructions:</div>
                            <div data-method="manual" class="hidden">
                                Transfer to: Bank ABC<br>
                                Account: 1234567890<br>
                                Amount: Rp TotalPrice<br>
                                Include order ID in description
                            </div>
                            <div data-method="bca" class="hidden">
                                Transfer to: BCA<br>
                                Account: 0987654321<br>
                                Amount: Rp TotalPrice
                            </div>
                            <div data-method="e-wallet" class="hidden">
                                Scan QR code or use phone number: 08123456789
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-300">Upload Proof of Payment</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-700 border-dashed rounded-lg hover:border-amber-500/50 transition-colors" id="dropzone">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h16a4 4 0 004-4V12a4 4 0 00-4-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M32 24l-8 8-8-8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-400">
                                        <label for="file-upload" class="relative cursor-pointer bg-gray-800 rounded-md font-medium text-amber-500 hover:text-amber-400 focus-within:outline-none">
                                            <span>Upload a file</span>
                                            <input id="file-upload" name="proof_payment" type="file" class="sr-only" accept="image/*,.pdf">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, PDF up to 5MB</p>
                                </div>
                            </div>
                            <div id="file-preview" class="mt-2 hidden">
                                <div class="flex items-center justify-between bg-gray-800/50 p-2 rounded">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm font-medium" id="file-name"></span>
                                    </div>
                                    <button type="button" class="text-gray-400 hover:text-red-400" id="remove-file">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and conditions -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox" class="focus:ring-amber-500 h-4 w-4 text-amber-600 border-gray-600 rounded bg-gray-800">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-medium text-gray-300">I agree to the <a href="#" class="text-amber-500 hover:text-amber-400">terms and conditions</a></label>
                                <p class="text-gray-500">By proceeding, you agree to our cancellation policy and theater rules.</p>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                                Confirm Payment
                                <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for enhanced interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Payment method change handler
            const paymentMethod = document.querySelector('select[name="payment_method"]');
            const paymentInstructions = document.getElementById('paymentInstructions');

            paymentMethod.addEventListener('change', function() {
                // Hide all instructions first
                document.querySelectorAll('#paymentInstructions div').forEach(el => {
                    el.classList.add('hidden');
                });

                // Show selected method's instructions
                const selectedMethod = this.value;
                document.querySelector(`#paymentInstructions div[data-method="${selectedMethod}"]`).classList.remove('hidden');
                paymentInstructions.classList.remove('hidden');
            });

            // File upload handling
            const fileInput = document.getElementById('file-upload');
            const dropzone = document.getElementById('dropzone');
            const filePreview = document.getElementById('file-preview');
            const fileName = document.getElementById('file-name');
            const removeFile = document.getElementById('remove-file');

            fileInput.addEventListener('change', function(e) {
                if (this.files.length) {
                    fileName.textContent = this.files[0].name;
                    filePreview.classList.remove('hidden');
                    dropzone.classList.add('hidden');
                }
            });

            removeFile.addEventListener('click', function() {
                fileInput.value = '';
                filePreview.classList.add('hidden');
                dropzone.classList.remove('hidden');
            });

            // Drag and drop functionality
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

            function highlight() {
                dropzone.classList.add('border-amber-500/70');
            }

            function unhighlight() {
                dropzone.classList.remove('border-amber-500/70');
            }

            dropzone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;

                if (files.length) {
                    fileName.textContent = files[0].name;
                    filePreview.classList.remove('hidden');
                    dropzone.classList.add('hidden');
                }
            }
        });
    </script>


</body>

</html>