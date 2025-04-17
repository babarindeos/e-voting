<x-student-layout>

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

        @if ($live_elections->count())

            @foreach($live_elections as $election)

                @if ($election->election_type_id == 1)
                    <!-- University wide elections //-->
                    <div class='w-[50%] border mx-auto py-8 shadow-md'>
                        <div class='text-3xl text-center'>
                                {{ $election->name }}
                        </div>
                    </div>
                @elseif ($election->election_type_id == 2)
                    <!-- College election //-->
                    @php
                        $eligibility_status = false;
                        $voter_college = '';
                    @endphp


                    <!-- check if the user's college is live  //-->
                    @foreach( Auth::user()->voter as $reg)
                       
                        @if  ($reg->election_suite_id == $election->election_suite_id)
                                <div class='w-[50%] border mx-auto py-12 shadow-md rounded-md'>
                                        <div class='text-3xl text-center'>
                                                {{ $election->name }}
                                            
                                        </div>
                                        <div class='text-center py-2'>
                                                        {{ $election->election_type->name }}
                                        </div>
                                        <div class='text-center py-8'>
                                                <form action="{{ route('student.elections.start_voting') }}" method="POST">
                                                    @csrf
                                                    
                                                    <input type='hidden' name='election_uuid' value="{{ $election->uuid }}" />
                                                    <button  class="border border-green-600 text-green-600 py-4 px-8 
                                                                text-xs md:text-lg rounded-md hover:bg-green-500 hover:text-white hover:border-green-500">Start Voting</a>
                                                </form>
                                        </div>
                                </div>
                        @endif
                    @endforeach

                   
                  
                @endif
            



            @endforeach

        @endif
                
               
    </section>
    <!-- end of Dashboard //--> 
   


    
        




    
</div>

</x-student-layout>