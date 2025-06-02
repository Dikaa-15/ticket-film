<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Confirmation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .neon-glow {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.7);
        }
        .cinematic-bg {
            background: radial-gradient(circle at center, #1a1a2e 0%, #16213e 100%);
        }
    </style>
</head>
<body class="cinematic-bg text-white h-screen flex items-center justify-center p-6">
    <div class="max-w-sm w-full mx-auto">
        <div class="bg-gray-800 bg-opacity-70 backdrop-blur-md rounded-3xl p-8 shadow-xl border border-gray-700">
            <!-- Illustration Container -->
            <div class="relative mb-6 h-48 flex items-center justify-center">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl opacity-20 blur-md"></div>
                
                <!-- Film-themed illustration components -->
                <div class="relative z-10 flex flex-col items-center">
                    <div class="bg-yellow-400 w-24 h-32 rounded-lg transform rotate-2 flex flex-col items-center justify-between p-2 border-2 border-yellow-300">
                        <div class="w-full h-4 bg-yellow-300 rounded-sm"></div>
                        <div class="text-xs font-bold text-yellow-800">ADMIT ONE</div>
                        <div class="w-full h-4 bg-yellow-300 rounded-sm"></div>
                    </div>
                    
                    <div class="flex mt-4 space-x-3">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                            <div class="w-5 h-5 bg-white rounded-full"></div>
                        </div>
                        <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                            <div class="w-3 h-3 bg-amber-600 rounded-full"></div>
                        </div>
                        <div class="w-8 h-8 bg-blue-400 rounded-full flex items-center justify-center">
                            <div class="w-6 h-2 bg-white rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Confirmation Text -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold mb-2 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Your tickets are booked!</h2>
                <p class="text-gray-300">Check your email for the confirmation. Your seats are reserved for you.</p>
            </div>
            
            <!-- Action Button -->
            <button class="w-full py-4 px-6 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl font-bold text-white neon-glow transition-all hover:from-blue-400 hover:to-blue-500 active:scale-95">
                <a href="{{ route('order.history') }}">View History</a>
            </button>
            
            <!-- Additional Options -->
            <div class="mt-6 flex justify-center space-x-4 text-sm">
                <a href="#" class="text-blue-400 hover:text-blue-300">Save to Wallet</a>
                <a href="#" class="text-gray-400 hover:text-gray-300">Share</a>
            </div>
        </div>
    </div>
</body>
</html>