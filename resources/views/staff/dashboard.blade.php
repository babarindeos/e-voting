<x-staff-layout>

<div class="flex flex-col border-0 w-[95%] mx-auto">
    <section class="border-b border-gray-200 py-2 mt-2">
            <div class="text-2xl font-semibold ">
                Dashboard                
            </div>
            <div>
               
            </div>
    </section>

    <div class="py-2">
                @if (Auth::check())
                    @php
                        $surname = ucfirst(strtolower(Auth::user()->surname))
                    @endphp

                @endif
               <span class='font-semibold'>Welcome,</span>  {{ $surname }} {{ Auth::user()->firstname}}
    </div>


    <!-- board //-->
    <section class="flex flex-row border border-0 py-1 mt-3">
                <div class="flex flex-col md:flex-row mx-auto md:space-x-2 w-4/5 justify-center items-center">
                    <a  href="{{ route('staff.meetings.index') }}" class="flex flex-col border border-1 border-yellow-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-yellow-500">
                        <div class="text-white text-3xl text-end">
                            {{ number_format($meeting_count)}}
                        </div>
                        <div class="text-sm text-white font-normal text-end">
                            Meetings
                        </div>
                    </a>

                    <a  href="{{ route('staff.papers.index') }}" class="flex flex-col border border-1 border-pink-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-pink-500">
                        <div class="text-white text-3xl text-end">
                            {{ $paper_count}}
                        </div>
                        <div class="text-sm text-white font-normal text-end">
                            Papers
                        </div>
                    </a>


                    <a  href="{{ route('staff.digests.index') }}" class="flex flex-col border border-1 border-green-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-green-500">
                        <div class="text-white text-3xl text-end">
                            {{ $digest_count}}
                        </div>
                        <div class="text-sm text-white font-normal text-end">
                            Digests
                        </div>
                    </a>


                    <a  href="{{ route('staff.minutes.index') }}" class="flex flex-col border border-1 border-blue-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-blue-500">
                        <div class="text-white text-3xl  text-end">
                            {{ $minute_count}}
                        </div>
                        <div class="text-sm text-white  text-end">
                            Minutes
                        </div>
                    </a>

                    

                    
                </div>
        </section>
        <!-- end of board //-->



        <!-- Announcements  //--> 
        <section class="flex flex-col md:flex-row w-full py-4 md:space-x-4 space-y-4 md:space-y-0 mt-4">

            <!-- Announcements //-->
            <div class="flex flex-col w-full md:w-1/2 rounded-md border px-4 py-4 ">
                <div class='py-2 border-b w-full font-bold text-xl'>Recent Announcements</div>

                <div class='py-1'>
                        @foreach($announcements as $announcement)
                            <div class='py-4'>
                                    <a class='underline' href="{{ route('staff.announcements.show',['announcement'=>$announcement->id]) }}">
                                        {{ $announcement->subject }}
                                    </a>
                                    <div class='text-xs'>
                                        {{ $announcement->created_at->format('l jS F, Y g:i a') }}
                                    </div>
                            </div>
                        @endforeach
                </div>
            </div><!-- end of Announcements //-->

            <div class="flex flex-col w-full md:w-1/2 rounded-md border px-4 py-4">
                    <div class='py-2 border-b w-full font-bold text-xl'>Latest Meetings</div>

                    <div class='py-1'>
                            @foreach($meetings as $meeting)
                                <div class='py-4'>
                                        <a class='underline' href="{{ route('staff.meetings.show',['meeting'=>$meeting->id]) }}">
                                            {{ $meeting->title }}
                                        </a>
                                        <div class='text-xs'>
                                            {{ $meeting->created_at->format('l jS F, Y g:i a') }}
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
                <div class='py-2 border-b w-full font-bold text-xl'>Recent Papers</div>

                <div class='py-1'>
                        @foreach($papers as $paper)
                            <div class='py-4'>
                                    <a class='underline' href="{{ route('staff.papers.show',['paper'=>$paper->id]) }}">
                                        {{ $paper->title }}
                                    </a>
                                    <div class='text-xs'>
                                        {{ $paper->created_at->format('l jS F, Y g:i a') }}
                                    </div>
                            </div>
                        @endforeach
                </div>
            </div><!-- end of Announcements //-->

            <div class="flex flex-col w-full md:w-1/2 rounded-md border px-4 py-4">
                    <div class='py-2 border-b w-full font-bold text-xl'>Latest Minutes</div>

                    <div class='py-1'>
                            @foreach($minutes as $minute)
                                <div class='py-4'>
                                        <a class='underline' href="{{ asset('storage/'.$minute->file) }}" target="_blank">
                                            {{ $minute->title }}
                                        </a>
                                        <div class='text-xs'>
                                            {{ $minute->created_at->format('l jS F, Y g:i a') }}
                                        </div>
                                </div>
                            @endforeach
                    </div>
            </div><!-- end of Meeting //-->
               
        </section>
        <!-- end of Announcements //--> 
   


    
        




    
</div>

</x-staff-layout>