<x-student-layout>
    @if (!Session::has('current_election'))
        Not available
    @endif

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-red-900 mx-auto border-0">
        
            <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row border-b border-gray-300 py-4 md:py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">{{ $election->name }}</h1>
                    </div>
                    <div class='flex flex-row space-x-4'>
                            @php
                                    ++$current_page;
                                   
                            @endphp

                            @if ($current_page != 1)
                                        <form action="{{ route('student.elections.vote') }}" method="get">
                                                @csrf
                                                <button class="bg-green-600 text-white py-2 px-4 
                                                            rounded-lg text-md md:text-lg hover:bg-green-500">&laquo; Previous </button> 
                                        </form>                          
                            @endif

                           

                            @if ($votes_cast != null )
                                    @if ($current_page < $total_pages)
                                            <form action="{{ route('student.elections.vote.next') }}" method="post">
                                                    @csrf
                                                    <button href="{{ route('student.elections.vote.next') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                                        rounded-lg text-md md:text-lg hover:bg-green-500 hover:text-white hover:border-green-500">Next &raquo;</button>
                                            </form>
                                    @else
                                            <form action="{{ route('student.elections.vote.finalize_voting') }}" method="post">
                                                    @csrf
                                                    <button class="border border-green-600 text-green-600 py-2 px-6 
                                                    rounded-lg text-md md:text-lg hover:bg-green-500 hover:text-white hover:border-green-500">Finalize Voting &raquo;</button>
                                            </form>
                                    @endif
                            @endif
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Elections  Section  //-->
        <section class="flex flex-col w-[98%] md:w-[98%] md:flex-row mx-auto py-0 mt-0 border-0 justify-between">   
                <div class='font-normal text-2xl'>Preview</div>
                <div>
                        <div class='flex flex-col md:flex-row space-y-1 md:space-y-0 md:space-x-1 md:text-lg'>
                               Page {{ $current_page }} of {{ $total_pages }}
                        </div>
                </div>

        </section>
        

        <form action="{{ route('student.elections.cast_vote') }}" method="post" class="border mx-auto w-full ">
            @csrf
        
                <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 mb-16 border-0">
                        
                        @if ($votes_cast->count())

                               
                                        <div class="flex flex-col  md:flex-row md:flex-wrap mx-auto w-[90%]">
                                                @foreach($votes_cast as $vote)
                                                    <div class='border w-full md:w-[30%] py-4 px-4'>
                                                            <div class='text-xl font-semibold py-2'>
                                                                    {{ $vote->position->name }}
                                                            </div>
                                                            <div class='flex flex-col border rounded-md '>
                                                                @if ($vote->candidate==null)
                                                                    <img src="{{ asset('images/void_vote.png')}}" class="w-74 h-64 justify-start rounded-t object-cover"  />
                                                                @else
                                                                    <img src="{{ asset('storage/'.$vote->candidate->photo) }}" class="w-74 h-64 justify-start rounded-t object-cover" />
                                                                @endif

                                                                <div class='flex px-4 py-2 mt-2 border mx-auto text-xl'>
                                                                        @if ($vote->candidate != null)
                                                                            {{ $vote->candidate->surname }} {{ $vote->candidate->firstname }}
                                                                        @else
                                                                            None
                                                                        @endif
                                                                </div>

                                                                <div class='mx-auto flex flex-row space-x-4'>
                                                                                <!--  Choice //-->
                                                                                <div class="flex flex-row border-red-900 w-[80%] md:w-[60%] py-3">
                                                                                            <div class='flex flex-row space-x-2'>
                                                                                    
                                                                                                        <input type="checkbox" disabled name="candidate" class="border border-1 border-gray-400 bg-gray-50
                                                                                                                                    p-4 rounded-md 
                                                                                                                                    accent-green-500
                                                                                                                                    focus:outline-none
                                                                                                                                    focus:border-green-500 
                                                                                                                                    focus:ring
                                                                                                                                    focus:ring-green-500" value=""
                                                                                                                                    
                                                                                                                                    checked 
                                                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                                                    
                                                                                                                                    
                                                                                                                                    />                                                                                                 
                                                                                            </div>
                                                                                            @if ($vote->candidate != null && $vote->yes)
                                                                                                <div class='flex flex-row px-1 text-lg'> Yes </div>
                                                                                            @elseif ($vote->candidate != null && $vote->no)
                                                                                                <div class='flex flex-row px-1 text-lg'> No </div>                                                                                            
                                                                                            @endif
                                                                                           
                                                                                
                                                                                </div><!-- end of Choice  //-->
                                                                                
                                                                               
                                                                </div>
                                                            </div>
                                                    </div>
                                                    
                                                @endforeach     
                               



                              

                        @else
                                        <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                                            <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                                    There is currently no Candidate
                                            </div>
                                        </section>
                        @endif


            


                </section>       
                <!-- end of Electoral Committee Section //-->
        
        </form>
            
        
    
    
        
    </div>
    


</x-student-layout>