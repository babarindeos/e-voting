<header class="flex flex-col shadow-md bg-gradient-to-b from-green-700 to-green-500">

    
    
    <nav class="py-3 border-0">
        <div class="mx-auto px-2 sm:px-8 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- Logo -->
                <div class="flex flex-shrink-0">
                    <!-- logo //-->
                    <div class="flex flex-row px-2 md:px-4 py-2">
                        <img src="{{ asset('images/logo.png')}}" />
                    </div>
                    <!-- end of logo //-->
                    <!-- Name //-->
                    <div class="flex flex-col item-center justify-center">
                            <div class="text-white font-bold text-2xl font-serif">FUNAAB e-Senate</div>
                            <div class="text-white font-semibold font-serif opacity-70">Federal University of Agriculture Abeokuta</div>
                                
                    </div>
                    <!-- end of name //-->
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden px-4">
                    <button class="text-white focus:outline-none" id="mobile-menu-button">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <!-- Main Menu -->
                <div class="hidden lg:flex lg:px-4 space-x-4">
                    @auth
                        @if (Auth::user()->role==='admin')

                            <a href='{{ route('admin.dashboard.index') }}' class="flex font-semibold items-center text-white hover:border-b-yellow-100 hover:border-b-4 mx-2 ">Dashboard</a>

                           
                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Meetings
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[350%]">
                                    <a href="{{ route('admin.meetings.index') }}" class="flex flex-row px-4 py-2 border-b hover:bg-green-500 hover:text-white hover:border-l-yellow-500 hover:border-l-4 pr-8">Manage Meetings</a>
                                    <a href="{{ route('admin.meetings.create') }}" class="flex flex-row px-4 py-2 border-b hover:bg-green-500 hover:text-white hover:border-l-yellow-500 hover:border-l-4 pr-8">Create Meeting</a>
                                    <a href="#" class="flex flex-row px-4 py-2 hover:bg-gray-200 border-b hover:bg-green-500 hover:text-white hover:border-l-yellow-500 hover:border-l-4 pr-8">Meeting Notification</a>
                                    <a href="" class="flex flex-row px-4 py-2 hover:bg-green-500 hover:text-white  hover:border-l-yellow-500 hover:border-l-4 pr-8">Meeting Reminder</a>
                                </div>
                            </div>


                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Documents
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[260%]">
                                    <a href="{{ route('admin.papers.index') }}" class="flex flex-row px-4 py-2 border-b hover:bg-green-500 hover:text-white hover:border-l-yellow-500 hover:border-l-4 pr-8">Papers</a>
                                    <a href="{{ route('admin.digests.index') }}" class="flex flex-row px-4 py-2 border-b hover:bg-green-500 hover:text-white hover:border-l-yellow-500 hover:border-l-4 pr-8">Digests</a>
                                    <a href="{{ route('admin.minutes.index') }}" class="flex flex-row px-4 py-2 border-b hover:bg-green-500 hover:text-white hover:border-l-yellow-500 hover:border-l-4 pr-8">Minutes</a>
                                </div>
                            </div>

                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Announcements
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[200%]">
                                    <a href="{{ route('admin.announcements.index') }}" class="flex flex-row px-4 py-2 border-b hover:bg-green-500 hover:text-white hover:border-l-yellow-500 hover:border-l-4 pr-8">Manage Announcements</a>
                                    <a href="{{ route('admin.announcements.create') }}" class="flex flex-row px-4 py-2 border-b hover:bg-green-500 hover:text-white hover:border-l-yellow-500 hover:border-l-4 pr-8">Create Announcement</a>
                                </div>
                            </div>

                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Users
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[350%]">
                                    <a href="{{ route('admin.staff.index') }}" class="flex flex-row px-4 py-2 border-b hover:bg-green-500 hover:text-white hover:border-l-yellow-500 hover:border-l-4 pr-8">Manage Users</a>
                                    <a href="{{ route('admin.staff.create') }}" class="flex flex-row px-4 py-2 border-b hover:bg-green-500 hover:text-white hover:border-l-yellow-500 hover:border-l-4 pr-8">Create User</a>
                                </div>
                            </div>
                            
                            
                            <div class="relative group">
                                <button class="text-white px-1 py-2 rounded-md font-semibold">
                                    Settings
                                </button>
                                <!-- Sub-menu -->
                                <div class="absolute hidden group-hover:block bg-white text-gray-800 mt-0 py-2 shadow-lg w-[280%]">
                                    <a href="{{ route('admin.colleges.index') }}" class="flex flex-row px-4 py-2 border-b hover:bg-green-500 hover:text-white  hover:border-l-yellow-500 hover:border-l-4 pr-8">Colleges</a>
                                    <a href="{{ route('admin.departments.index') }}" class="flex flex-row px-4 py-2 border-b hover:bg-green-500 hover:text-white hover:border-l-yellow-500 hover:border-l-4 pr-8">Departments</a>
                                </div>
                            </div>
                            <form action="{{ route('admin.auth.logout') }}" method="POST" class="flex items-center justify-center border-0">
                                @csrf
                                
                                <button type="submit" class="flex font-semibold items-center hover:border-b-yellow-100 text-white hover:border-b-4 mx-3 ">Sign Out</button>
                            </form>  
                        @endif
                    @endauth     
                </div>
                
            </div>
            
            <!-- Mobile Menu -->
            <div class="lg:hidden hidden" id="mobile-menu">
                <a href="#" class="block text-white px-4 py-2 hover:bg-gray-700 rounded-md">Dashboard</a>
                <div class="relative">
                    <button class="block w-full text-left text-white px-4 py-2 hover:bg-gray-700 rounded-md focus:outline-none" id="meetings-mobile">
                        Meetings
                    </button>
                    <!-- Sub-menu for Mobile -->
                    <div class="hidden bg-slate-50 rounded-md" id="meetings-sub-menu-mobile">
                        <a href="{{ route('admin.cells.index') }}" class="block px-4 py-2 hover:bg-gray-200">Manage Meetings</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200">Create Meeting</a>
                        <a href="#" class="flex flex-row px-4 py-2 hover:bg-gray-200">Meeting Notification</a>
                        <a href="#" class="flex flex-row px-4 py-2 hover:bg-gray-200">Minutes of Meeting</a>
                    </div>
                </div>

                <div class="relative">
                    <button class="block w-full text-left text-white px-4 py-2 hover:bg-gray-700 rounded-md focus:outline-none" id="documents-mobile">
                        Documents
                    </button>
                    <!-- Sub-menu for Mobile -->
                    <div class="hidden bg-slate-50 rounded-md" id="documents-sub-menu-mobile">
                        <a href="{{ route('admin.cells.index') }}" class="block px-4 py-2 hover:bg-gray-200">Papers</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200">Digests</a>
                        <a href="#" class="flex flex-row px-4 py-2 hover:bg-gray-200">Minutes</a>
                    </div>
                </div>

                <div class="relative">
                    <button class="block w-full text-left text-white px-4 py-2 hover:bg-gray-700 rounded-md focus:outline-none" id="announcements-mobile">
                        Announcements
                    </button>
                    <!-- Sub-menu for Mobile -->
                    <div class="hidden bg-slate-50 rounded-md" id="announcements-sub-menu-mobile">
                        <a href="{{ route('admin.cells.index') }}" class="block px-4 py-2 hover:bg-gray-200">Manage Announcements</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200">Create Announcements</a>
                    </div>
                </div>

                <div class="relative">
                    <button class="block w-full text-left text-white px-4 py-2 hover:bg-gray-700 rounded-md focus:outline-none" id="users-mobile">
                        Users
                    </button>
                    <!-- Sub-menu for Mobile -->
                    <div class="hidden bg-slate-50 rounded-md" id="users-sub-menu-mobile">
                        <a href="{{ route('admin.staff.index') }}" class="block px-4 py-2 hover:bg-gray-200">Manage Users</a>
                        <a href="{{ route('admin.staff.create') }}" class="block px-4 py-2 hover:bg-gray-200">Create User</a>
                    </div>
                </div>

                <div class="relative">
                    <button class="block w-full text-left text-white px-4 py-2 hover:bg-gray-700 rounded-md focus:outline-none" id="settings-mobile">
                        Settings
                    </button>
                    <!-- Sub-menu for Mobile -->
                    <div class="hidden bg-slate-50 rounded-md" id="settings-sub-menu-mobile">
                        <a href="{{ route('admin.cells.index') }}" class="block px-4 py-2 hover:bg-gray-200">Colleges</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-200">Departments</a>
                    </div>
                </div>
               
                <form action="{{ route('admin.auth.logout') }}" method="POST" class="block w-full">
                    @csrf
                    
                    <button type="submit" class="block w-full text-white px-4 py-2 hover:bg-gray-700 rounded-md">Sign Out</button>
                </form> 
            </div>
        </div>
    </nav>
    
    <script>
        // Toggle Mobile Menu
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    
        // Toggle Mobile Sub-menu
        document.getElementById('meetings-mobile').addEventListener('click', function () {
            document.getElementById('meetings-sub-menu-mobile').classList.toggle('hidden');
        });

         // Toggle Mobile Sub-menu
         document.getElementById('documents-mobile').addEventListener('click', function () {
            document.getElementById('documents-sub-menu-mobile').classList.toggle('hidden');
        });

         // Toggle Mobile Sub-menu
         document.getElementById('announcements-mobile').addEventListener('click', function () {
            document.getElementById('announcements-sub-menu-mobile').classList.toggle('hidden');
        });

         // Toggle Mobile Sub-menu
         document.getElementById('users-mobile').addEventListener('click', function () {
            document.getElementById('users-sub-menu-mobile').classList.toggle('hidden');
        });

         // Toggle Mobile Sub-menu
         document.getElementById('settings-mobile').addEventListener('click', function () {
            document.getElementById('settings-sub-menu-mobile').classList.toggle('hidden');
        });
    </script>

    
</header>
