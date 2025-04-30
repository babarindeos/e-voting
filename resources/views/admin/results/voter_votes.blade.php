<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Results ({{ $votes->count() }})</h1>
                    </div>
                    <div>

                            <a href="{{ route('admin.elections.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Elections</a>


                            <a href="{{ route('admin.election_suites.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Election Suites</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->


        <section class='w-[98%] border-0 mx-auto'>
            <div class='flex flex-row justify-between '>
                    <div class='flex flex-col justify-center'>
                        {{ $election->name }}
                        <div class='text-xl'>
                               <span class='font-semibold'>Voter: </span> {{ $voter->surname}} {{ $voter->firstname}} {{ $voter->othernames }}
                        </div>
                    </div>
                    <div class='border-0 w-1/2'>
                            <!-- search //-->
                            <div class="flex flex-1 justify-end border border-0">
                            
                                            <input type="text" name="search" class="w-full md:w-1/2 border border-1 border-gray-400 bg-gray-50
                                                        p-2 rounded-md 
                                                        focus:outline-none
                                                        focus:border-blue-500 
                                                        focus:ring
                                                        focus:ring-blue-100" placeholder="Search"                
                                                    
                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                  
                                            
                                            />  
                            </div>
                    </div>
            </div>
        </section>
        


        <!-- Election Committee Position Section  //-->
        

        
        <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 border-0">
                   


        @if ($votes->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='5%' class="text-center font-semibold py-6 w-16">SN</th>
                                <th width='25%' class="font-semibold py-2 text-left">Voter</th> 
                                <th width='25%' class="font-semibold py-2 text-left">Candidate</th>
                                <th width='8%' class="font-semibold py-2 text-center">Yes</th>   
                                <th width='8%' class="font-semibold py-2 text-center">No</th>  
                                <th width='8%' class="font-semibold py-2 text-center">Void</th>  
                                <th width='15%' class="font-semibold py-2 text-left">Date</th>                                                 
                                
                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 0;
                            @endphp

                            @foreach($votes as $vote)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-8 pr-4">
                                    
                                    <div>
                                        
                                            <a class="font-semibold text-blue-800 underline" href="{{ route('admin.results.elections.voter_votes', ['election' => $election->id, 'voter' => $vote->voter->id]) }}">
                                                {{ $vote->voter->surname }} {{ $vote->voter->firstname }}
                                            </a>                             
                                    </div>      
                                    <div class='text-sm'>
                                           {{ $vote->voter->matric_no }} 

                                           @if ($vote->voter->college != null)
                                           |  {{ $vote->voter->college->code }} 
                                           
                                           @endif

                                           @if ($vote->voter->department != null)
                                           ,  {{ $vote->voter->department->code }}
                                           @endif
                                    </div>                            

                                </td>
                                <td class="py-8 pr-4">
                                    
                                    <div>
                                            @if ($vote->candidate != null)
                                                    <a class="font-semibold text-blue-800 underline" href="{{ route('admin.results.elections.candidate_votes', ['election' => $election->id, 'candidate' => $vote->candidate->id]) }}">
                                                        
                                                                {{ $vote->candidate->surname }} {{ $vote->candidate->firstname }}
                                                    
                                                    </a>  
                                            @endif                           
                                    </div>      
                                    <div class='text-sm'>
                                            @if ($vote->candidate != null)
                                                {{ $vote->candidate->position->name }}
                                            @endif
                                    </div>

                                </td>
                                <td class='text-center'>
                                        {{ $vote->yes }}
                                </td>

                                </td>
                                <td class='text-center'>
                                        {{ $vote->no }}
                                </td>

                                <td  class='text-center'>
                                        {{ $vote->void }}
                                </td>

                               
                                
                                <td>
                                        {{  \Carbon\Carbon::parse($vote->created_at)->format('D. jS F, Y g:i a') }}

                                </td>
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                    

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Votes
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Electoral Committee Position Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>