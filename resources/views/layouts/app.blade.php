
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', default: 'VIDYEA')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

        /* Custom transition untuk sidebar */
        .sidebar-collapsed .sidebar-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
            transition: opacity 0.3s, width 0.3s;
        }
        
        .sidebar-expanded .sidebar-text {
            opacity: 1;
            width: auto;
            overflow: visible;
            transition: opacity 0.3s 0.1s, width 0.3s 0.1s;
        }
    </style>
</head>

<body class="bg-white min-h-screen relative">
    <!-- Checkbox untuk kontrol sidebar (tetap hidden) -->
    <input type="checkbox" id="sidebarToggle" class="hidden" checked>

	<!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 z-40 h-screen w-64 bg-white border-r border-slate-200 overflow-hidden transition-all duration-300 sidebar-expanded">
        <div class="h-14 flex items-center px-4 border-b">
            <img src="{{ asset('image/logo.svg') }}" class="h-10 w-10 shrink-0">
            <span class="ml-3 text-xl font-bold text-gray-800 sidebar-text">
                FilmLab
            </span>
        </div>
        <nav class="mt-4 space-y-1">
            @if(Auth::user()->hasRole('user') || Auth::user()->hasRole('film creator'))
                <a href="{{ route('user.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-100">
                    <img class="w-5 h-5 shrink-0" src="{{ asset('image/home.png') }}" alt="Home Icon">
                    <span class="ml-3 sidebar-text">
                        Home
                    </span>
                </a>
            @endif
            @if(Auth::user()->hasPermissionTo('view film'))
                <a href="{{ route('admin.index') }}" class="flex items-center px-4 py-2 hover:bg-gray-100">
                    <img class="w-5 h-5 shrink-0" src="{{ asset('image/films.png') }}" alt="Films Icon">
                    <span class="ml-3 sidebar-text">
                        Films
                    </span>
                </a>
            @endif
            @if (Auth::user()->hasPermissionTo('view category'))
                <a href="{{ route('admin.category') }}" class="flex items-center px-4 py-2 hover:bg-gray-100">
                    <img class="w-5 h-5 shrink-0" src="{{ asset('image/category.png') }}" alt="Categories Icon">
                    <span class="ml-3 sidebar-text">
                        Categories
                    </span>
                </a>
            @endif
            @if (Auth::user()->hasPermissionTo('view user'))
                <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-2 hover:bg-gray-100">
                    <img class="w-5 h-5 shrink-0" src="{{ asset('image/users.png') }}" alt="Users Icon">
                    <span class="ml-3 sidebar-text">
                        Users
                    </span>
                </a>
            @endif
            @if (Auth::user()->hasPermissionTo('view role'))
                <a href="{{ route('admin.roles') }}" class="flex items-center px-4 py-2 hover:bg-gray-100">
                    <img class="w-5 h-5 shrink-0" src="{{ asset('image/role.png') }}" alt="Role Icon">
                    <span class="ml-3 sidebar-text">
                        Roles
                    </span>
                </a>
            @endif
            @if (Auth::user()->hasPermissionTo('view audit'))
                <a href="{{ route('admin.audits') }}" class="flex items-center px-4 py-2 hover:bg-gray-100">
                    <img class="w-5 h-5 shrink-0" src="{{ asset('image/audit.png') }}" alt="Audit Icon">
                    <span class="ml-3 sidebar-text">
                        Audits
                    </span>
                </a>
            @endif
        </nav>
    </aside>

	<!-- Header -->
    <header class="w-full h-[40px] flex flex-end">
        <nav id="mainHeader" class="px-[50px] fixed top-0 left-0 right-0 h-14 flex items-center flex-end border-b border-slate-200 bg-white z-30 transition-all duration-300 pl-64">
            <!-- Container untuk konten header -->
            <div class="w-full flex items-center justify-end w-[100px]">
                <!-- Tombol toggle sidebar di kiri -->
                <div class="mr-auto flex flex-row items-center ml-2">
                    <label for="sidebarToggle" class="flex items-center justify-center w-10 h-10 rounded-lg cursor-pointer hover:bg-gray-100 text-gray-700 transition-all">
                        <!-- Ikon hamburger -->
                        <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <!-- Garis hamburger -->
                            <path id="menuBars" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4 6h16M4 12h16M4 18h16"></path>
                            <!-- Ikon X (tersembunyi awalnya) -->
                            <path id="menuClose" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </label>
                </div>

                <!-- Profile section (TIDAK DIUBAH dari kode asli) -->
                <div class="relative">
					<input type="checkbox" id="profileToggle" class="peer hidden">
					<label for="profileToggle" class="flex items-center gap-3 cursor-pointer text-gray-700 hover:text-indigo-600">
						<span>{{ Auth::user()->name }}</span>
					</label>
					<div class="absolute right-0 mt-3 w-44 bg-white border rounded-lg shadow-lg opacity-0 scale-95 pointer-events-none peer-checked:opacity-100 peer-checked:scale-100 peer-checked:pointer-events-auto transition-all duration-150">
						<form method="POST" action="{{ route('logout') }}" class="py-5 flex justify-center">
							@csrf
							<button class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 rounded">
								Log Out
							</button>
						</form>
					</div>
				</div>
            </div>
        </nav>
    </header>

    <!-- Main content -->
    <main id="mainContent" class="ml-64 pt-[70px] px-6 transition-all duration-300">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const mainHeader = document.getElementById('mainHeader');
            const mainContent = document.getElementById('mainContent');
            const menuBars = document.getElementById('menuBars');
            const menuClose = document.getElementById('menuClose');
            
            // Fungsi untuk toggle sidebar dan sesuaikan header
            function toggleSidebar(isExpanded) {
                if (isExpanded) {
                    // Sidebar expanded
                    sidebar.style.width = '16rem'; // 256px
                    sidebar.classList.remove('sidebar-collapsed');
                    sidebar.classList.add('sidebar-expanded');
                    
                    // Sesuaikan header
                    mainHeader.style.paddingLeft = '16rem';
                    
                    // Sesuaikan main content
                    mainContent.style.marginLeft = '16rem';
                    
                    // Ganti ikon menjadi hamburger
                    menuClose.classList.remove('hidden');
                    menuBars.classList.add('hidden');
                } else {
                    // Sidebar collapsed
                    sidebar.style.width = '5rem'; // 80px
                    sidebar.classList.remove('sidebar-expanded');
                    sidebar.classList.add('sidebar-collapsed');
                    
                    // Sesuaikan header
                    mainHeader.style.paddingLeft = '5rem';
                    
                    // Sesuaikan main content
                    mainContent.style.marginLeft = '5rem';
                    
                    // Ganti ikon menjadi X
                    menuClose.classList.add('hidden');
                    menuBars.classList.remove('hidden');
                }
            }
            
            // Event listener untuk checkbox toggle
            sidebarToggle.addEventListener('change', function() {
                toggleSidebar(this.checked);
            });
            
            // Inisialisasi state awal
            toggleSidebar(sidebarToggle.checked);
        });
    </script>
</body>
</html>