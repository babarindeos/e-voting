<x-student-layout>

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
                                        <form action="{{ route('student.elections.vote.previous') }}" method="post">
                                                @csrf
                                                <button class="bg-green-600 text-white py-2 px-4 
                                                            rounded-lg text-md md:text-lg hover:bg-green-500">&laquo; Previous </button> 
                                        </form>                          
                            @endif

                           

                            @if ($cast_vote != null )
                                    @if ($current_page < $total_pages)
                                            <form action="{{ route('student.elections.vote.next') }}" method="post">
                                                    @csrf
                                                    <button href="{{ route('student.elections.vote.next') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                                        rounded-lg text-md md:text-lg hover:bg-green-500 hover:text-white hover:border-green-500">Next &raquo;</button>
                                            </form>
                                    @else
                                            <form action="{{ route('student.elections.vote.preview', ['election' => $election->uuid]) }}" method="get">
                                                    @csrf
                                                    <button class="border border-green-600 text-green-600 py-2 px-6 
                                                    rounded-lg text-md md:text-lg hover:bg-green-500 hover:text-white hover:border-green-500">Preview Vote Cast &raquo;</button>
                                            </form>
                                    @endif
                            @endif
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Elections  Section  //-->
        <section class="flex flex-col w-[98%] md:w-[98%] md:flex-row mx-auto py-0 mt-0 border-0 justify-between">   
                <div class='font-normal text-2xl'>Post: {{ $position->name }}</div>
                <div>
                        <div class='flex flex-col md:flex-row space-y-1 md:space-y-0 md:space-x-1 md:text-lg'>
                               Page {{ $current_page }} of {{ $total_pages }}
                        </div>
                </div>

        </section>
        

        <form action="{{ route('student.elections.cast_vote') }}" method="post" class="border mx-auto w-full ">
            @csrf
        
                <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 mb-16 border-0">
                        
                        @if ($candidates->count())

                                @if ($candidates->count() == 1)

                                        <div class="flex flex-col  md:flex-row md:flex-wrap mx-auto w-[90%]">
                                                @foreach($candidates as $candidate)
                                                    <div class='border w-full md:w-[30%] py-4 px-4'>
                                                            
                                                            <div class='flex flex-col border rounded-md '>
                                                                @if ($candidate->photo==null)
                                                                    <img src="{{ asset('images/avatar_150.jpg')}}" class="w-74 h-64"  />
                                                                @else
                                                                    <img src="{{ asset('storage/'.$candidate->photo) }}" class="w-74 h-64 justify-start rounded-t object-cover" />
                                                                @endif

                                                                <div class='flex px-4 py-2 mt-2 border mx-auto text-xl'>
                                                                        {{ $candidate->surname }} {{ $candidate->firstname }}
                                                                </div>
                                                                <div>
                                                                    <input type='hidden' name='single_candidate' value="{{ $candidate->id }}" />
                                                                </div>

                                                                <div class='flex mx-auto space-x-4'>
                                                                                <!-- Yes Choice //-->
                                                                                <div class="flex  border-red-900 w-[80%] md:w-[60%] py-3">
                                                                                            <div class='flex flex-row space-x-2'>
                                                                                    
                                                                                                        <input type="radio" name="candidate" class="border border-1 border-gray-400 bg-gray-50
                                                                                                                                    p-4 rounded-md 
                                                                                                                                    accent-green-500
                                                                                                                                    focus:outline-none
                                                                                                                                    focus:border-green-500 
                                                                                                                                    focus:ring
                                                                                                                                    focus:ring-green-500" value="Yes"
                                                                                                                                    
                                                                                                                                    
                                                                                                                                    @if ($cast_vote != null  && $cast_vote->yes == true ) checked @endif

                                                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                                                    
                                                                                                                                    
                                                                                                                                    />                                                                                           
                                                                                            </div><div class='text-lg px-1'>Yes</div>
                                                                                          
                                                                                
                                                                                </div><!-- end of Yes Choice  //--> 

                                                                                <!--  No Choice //-->
                                                                                <div class="flex flex-row border-red-900 w-[80%] md:w-[60%] py-3">
                                                                                            <div class='flex flex-row space-x-2'>
                                                                                    
                                                                                                        <input type="radio" name="candidate" class="border border-1 border-gray-400 bg-gray-50
                                                                                                                                    p-4 rounded-md 
                                                                                                                                    accent-green-500
                                                                                                                                    focus:outline-none
                                                                                                                                    focus:border-green-500 
                                                                                                                                    focus:ring
                                                                                                                                    focus:ring-green-500" value="No"
                                                                                                                                    
                                                                                                                                    
                                                                                                                                    @if ($cast_vote != null  && $cast_vote->no == true ) checked @endif

                                                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                                                    
                                                                                                                                    
                                                                                                                                    />                                                                                                 
                                                                                            </div><div class='text-lg px-1'>No</div>
                                                                                            
                                                                                
                                                                                </div><!-- end of No Choice  //--> 
                                                                </div>
                                                            </div>
                                                    </div>
                                                    
                                                @endforeach    


                                @else
                                        <div class="flex flex-col  md:flex-row md:flex-wrap mx-auto w-[90%]">
                                                @foreach($candidates as $candidate)
                                                    <div class='border w-full md:w-[30%] py-4 px-4'>
                                                            <div class='flex flex-col border rounded-md '>
                                                                @if ($candidate->photo==null)
                                                                    <img src="{{ asset('images/avatar_150.jpg')}}" class="w-74 h-64"  />
                                                                @else
                                                                    <img src="{{ asset('storage/'.$candidate->photo) }}" class="w-74 h-64 justify-start rounded-t object-cover" />
                                                                @endif

                                                                <div class='flex px-4 py-2 mt-2 border mx-auto text-xl'>
                                                                        {{ $candidate->surname }} {{ $candidate->firstname }}
                                                                </div>

                                                                <div class='mx-auto'>
                                                                                <!--  Choice //-->
                                                                                <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                                                                                            <div class='flex flex-row space-x-2'>
                                                                                    
                                                                                                        <input type="radio" name="candidate" class="border border-1 border-gray-400 bg-gray-50
                                                                                                                                    p-4 rounded-md 
                                                                                                                                    accent-green-500
                                                                                                                                    focus:outline-none
                                                                                                                                    focus:border-green-500 
                                                                                                                                    focus:ring
                                                                                                                                    focus:ring-green-500" value="{{ $candidate->id }}"
                                                                                                                                    
                                                                                                                                    @if ($cast_vote != null  && $cast_vote->candidate_id == $candidate->id ) checked @endif

                                                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                                                    
                                                                                                                                    
                                                                                                                                    />                                                                                                 
                                                                                            </div>
                                                                                           
                                                                                
                                                                                </div><!-- end of Choice  //--> 
                                                                </div>
                                                            </div>
                                                    </div>
                                                    
                                                @endforeach     
                                @endif <!-- end of check for single contestant //-->

                                                <!-- Void Choice //-->
                                                <div class='border w-full md:w-[30%] py-4 px-4'>
                                                            <div class='flex flex-col border rounded-md '>
                                                                
                                                                    <img src="{{ asset('images/void_vote.png')}}" class="w-74 h-64 object-cover"  />
                                                            

                                                                <div class='flex px-4 py-2 mt-2 border mx-auto text-xl'>
                                                                        None
                                                                </div>

                                                                <div class='mx-auto'>
                                                                                <!--  Choice //-->
                                                                                <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                                                                                            <div class='flex flex-row space-x-2'>
                                                                                    
                                                                                                        <input type="radio" name="candidate" class="border border-1 border-gray-400 bg-gray-50
                                                                                                                                    p-4 rounded-md 
                                                                                                                                    accent-green-500
                                                                                                                                    focus:outline-none
                                                                                                                                    focus:border-green-500 
                                                                                                                                    focus:ring
                                                                                                                                    focus:ring-red-500" value="void"
                                                                                                                                    
                                                                                                                                    required
                                                                                                                                    @if ($cast_vote != null && $cast_vote->void) checked @endif

                                                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                                                    
                                                                                                                                
                                                                                                                                    />                                                                                                 
                                                                                            </div>
                                                                                            @error('position')
                                                                                                <span class="text-red-700 text-sm">
                                                                                                    {{$message}}
                                                                                                </span>
                                                                                            @enderror
                                                                                
                                                                                </div><!-- end of Choice  //--> 
                                                                </div>
                                                            </div>
                                                    </div>
                                                    


                                                <!-- end of Void Choice //-->
                                        </div>
                                


                                        <div class="flex flex-col  md:flex-row md:flex-wrap mx-auto w-[90%] mt-8">
                                                <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] mt-4 border-0 mx-auto">
                                                    <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                                                hover:bg-green-500 font-semibold
                                                                rounded-md text-xl" style="font-family:'Lato';font-weight:800;">Cast Vote</button>
                                                </div>
                                        </div>

                              

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