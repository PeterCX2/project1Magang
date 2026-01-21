<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', default: 'VIDYEA')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'study-primary': '#6d28d9',
                        'study-secondary': '#8b5cf6',
                        'quiz-card': '#f3e8ff'
                    },
                    fontFamily: {
                        heading: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body { font-family: 'Inter', sans-serif; }

        @keyframes pop {
            0% { transform: scale(0.6); opacity: 0; }
            70% { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(1); }
        }

		/* small custom theme tweak */
		:root{
		--purple-600: #6B46C1;
		--purple-500: #7C3AED;
		--purple-400: #9F7AEA;
		--muted: #6B7280;
		}

		/* gentle card shadow for premium look */
		.soft-card {
		box-shadow: 0 6px 20px rgba(50,50,70,0.06);
		}

		/* small pop animation for level-up message (if used) */
		@keyframes pop {
		from { transform: translateY(6px) scale(.98); opacity: 0; }
		to { transform: translateY(0) scale(1); opacity: 1; }
		}

		.avatar-loading {
			opacity: 0.6;
			filter: blur(2px);
		}
		
		.avatar-preview {
			transition: all 0.3s ease;
		}
    </style>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen relative">

	<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">

    <!-- HEADER -->
	<header class="w-full bg-white border-b h-[80px] px-6 flex items-center justify-between sticky top-0 z-30">

		<!-- LEFT: TITLE -->
		<div>
			<h1 class="text-2xl font-bold text-gray-800">
				@yield('header-title', 'Dashboard')
			</h1>

			<p class="text-gray-500 text-sm">
				@yield('header-subtitle', 'Selamat datang kembali, ' . (Auth::user()->role ?? 'User') . ' 👋')
			</p>
		</div>

        @if(Auth::user()->role == 'admin')
            <div>
                <a href="{{ route('admin.index') }}" class="px-4 py-2 font-medium text-white bg-purple-600 rounded-md hover:bg-purple-500 focus:outline-none focus:shadow-outline-purple active:bg-purple-600 transition duration-150 ease-in-out">Films</a>
                <a href="{{ route('admin.category') }}" class="px-4 py-2 font-medium text-white bg-purple-600 rounded-md hover:bg-purple-500 focus:outline-none focus:shadow-outline-purple active:bg-purple-600 transition duration-150 ease-in-out">Categories</a>
				<a href="{{ route('admin.users') }}" class="px-4 py-2 font-medium text-white bg-purple-600 rounded-md hover:bg-purple-500 focus:outline-none focus:shadow-outline-purple active:bg-purple-600 transition duration-150 ease-in-out">Users</a>
            </div>
        @endif

		<!-- RIGHT: PROFILE DROPDOWN -->
		<div class="relative">
            
			<input type="checkbox" id="profileToggle" class="peer hidden">
            <label for="profileToggle" class="flex items-center gap-3 cursor-pointer space-x-2 text-gray-700 hover:text-indigo-600 transition-colors">
				<span>{{ Auth::user()->name }}</span>
			</label>

			<!-- DROPDOWN BOX -->
			<div class="absolute right-0 mt-3 w-44 bg-white border rounded-lg shadow-lg
						opacity-0 scale-95 pointer-events-none
						peer-checked:opacity-100 peer-checked:scale-100 peer-checked:pointer-events-auto
						transition-all duration-150 flex justify-center items-center">
				<form method="POST" action="{{ route('logout') }}" class="py-5">
                    @csrf
                    <button class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded">
                        Log Out
                    </button>
                </form>
			</div>
		</div>

	</header>

    <!-- MAIN CONTENT -->
    <main class="p-4 sm:p-8 relative">
        @yield('content')
    </main>

</body>
</html>
