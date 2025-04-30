<x-admin-layout>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="flex flex-col border-0 w-[95%] mx-auto">

        <!-- Page Header //-->
        <section class="border-b border-gray-200 py-2 mt-2">
            <div class="text-2xl font-semibold ">
                Dashboard         
            </div>            
        </section>
        <!-- end of Page Header //-->

        <div class="py-2">
               <span class='font-semibold'>Welcome,</span>  {{ Auth::user()->surname }} {{ Auth::user()->firstname }}
        </div>


        <!-- board //-->
        <section class="flex flex-row border border-0 py-1 mt-3">
                <div class="flex flex-col md:flex-row mx-auto md:space-x-2 w-4/5 justify-center items-center">
                    <div class="flex flex-col border border-1 border-yellow-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-yellow-500">
                        <div class="text-white text-3xl text-end">
                            {{ number_format($election_suite_count)}}
                        </div>
                        <div class="text-sm text-white font-normal text-end">
                            Election Suites
                        </div>
                    </div>

                    <div class="flex flex-col border border-1 border-pink-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-pink-500">
                        <div class="text-white text-3xl text-end">
                            {{ $election_count}}
                        </div>
                        <div class="text-sm text-white font-normal text-end">
                            Elections
                        </div>
                    </div>


                    <div class="flex flex-col border border-1 border-green-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-green-500">
                        <div class="text-white text-3xl text-end">
                            {{ $position_count}}
                        </div>
                        <div class="text-sm text-white font-normal text-end">
                            Positions
                        </div>
                    </div>


                    <div class="flex flex-col border border-1 border-blue-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-blue-500">
                        <div class="text-white text-3xl  text-end">
                            {{ $candidate_count}}
                        </div>
                        <div class="text-sm text-white  text-end">
                            Candidates
                        </div>
                    </div>

                    <div class="flex flex-col border border-1 border-purple-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-purple-500">
                        <div class="text-white text-3xl text-end">
                            {{ $committee_count}}
                        </div>
                        <div class="text-sm text-white text-end">
                            Committees
                        </div>
                    </div>

                    
                </div>
        </section>
        <!-- end of board //-->



        <!-- Announcements  //--> 
        <section class="flex flex-col md:flex-row w-full py-4 md:space-x-4 space-y-4 md:space-y-0 mt-4">

            <!-- Announcements //-->
            <div class="flex flex-col w-full md:w-1/2 rounded-md border px-4 py-4 ">
                <div class='py-2 border-b w-full font-bold text-xl'>Election Suites</div>

                <div class='py-1'>
                        @foreach($election_suites as $election_suite)
                            <div class='py-4'>
                                    <a class='underline' href="#">
                                        {{ $election_suite->name }}
                                    </a>
                                    <div class='text-xs'>
                                        {{ $election_suite->created_at->format('l jS F, Y g:i a') }}
                                    </div>
                            </div>
                        @endforeach
                </div>
            </div><!-- end of Announcements //-->

            <div class="flex flex-col w-full md:w-1/2 rounded-md border px-4 py-4">
                    <div class='py-2 border-b w-full font-bold text-xl'>Elections</div>

                    <div class='py-1'>
                            @foreach($elections as $election)
                                <div class='py-4'>
                                        <a class='underline' href="#">
                                            {{ $election->name }}
                                        </a>
                                        <div class='text-xs'>
                                            {{ $election->created_at->format('l jS F, Y g:i a') }}
                                        </div>
                                </div>
                            @endforeach
                    </div>
            </div><!-- end of Meeting //-->
               
        </section>
        <!-- end of Announcements //--> 
        
        
        


        <!-- Announcements  //--> 
        <section class="flex flex-col md:flex-row w-full py-8 md:space-x-4 space-y-4 md:space-y-0">

            <!-- Announcements //-->
            <div class="flex flex-col w-full md:w-1/2 rounded-md border px-4 py-4 ">
                <div class='py-2 border-b w-full font-bold text-xl'>Positions</div>

                <div class='py-1'>
                        @foreach($positions as $position)
                            <div class='py-4'>
                                    <a class='underline' href="#">
                                        {{ $position->name }}
                                    </a>
                                    <div class='text-xs'>
                                        {{ $position->created_at->format('l jS F, Y g:i a') }}
                                    </div>
                            </div>
                        @endforeach
                </div>
            </div><!-- end of Announcements //-->

            <div class="flex flex-col w-full md:w-1/2 rounded-md border px-4 py-4">
                    <div class='py-2 border-b w-full font-bold text-xl'>Candidates</div>

                    <div class='py-1'>
                            @foreach($candidates as $candidate)
                                <div class='py-4'>
                                        <a class='underline' href="#" target="_blank">
                                            {{ $candidate->surname }}  {{ $candidate->firstname }}
                                        </a>
                                        <div class='text-xs'>
                                            {{ $candidate->created_at->format('l jS F, Y g:i a') }}
                                        </div>
                                </div>
                            @endforeach
                    </div>
            </div><!-- end of Meeting //-->
               
        </section>
        <!-- end of Announcements //--> 
        



            
    </div>
</x-admin-layout>

