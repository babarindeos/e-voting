<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Elections</h1>
                    </div>
                    <div>

                            <a href="{{ route('admin.elections.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Elections</a>


                            <a href="{{ route('admin.election_suites.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Election Suites</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Election Committee Position Section  //-->
        

        
        <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 border-0">
                   


        @if ($elections->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='5%' class="text-center font-semibold py-6 w-16">SN</th>
                                <th width='20%' class="font-semibold py-2 text-left">Election Suite</th> 
                                <th width='25%' class="font-semibold py-2 text-left">Name</th>
                                <th width='15%' class="font-semibold py-2 text-left">Start</th>   
                                <th width='15%' class="font-semibold py-2 text-left">End</th>  
                                <th width='10%' class="font-semibold py-2 text-left">Live</th>                                                 
                                <th width='10%' class="font-semibold py-2 text-left">Actions</th> 
                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($elections->currentPage() - 1) * $elections->perPage();
                            @endphp

                            @foreach($elections as $election)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-8 pr-4">
                                    
                                    <div>
                                        
                                            <a class="font-semibold text-blue-800 underline" href="{{ route('admin.election_suites.show', ['election_suite' => $election->election_suite_id]) }}">
                                                {{ $election->election_suite->name }}
                                            </a>                             
                                    </div>                                  

                                </td>
                                <td class="py-8 pr-4">
                                    
                                    <div>
                                        
                                            <a class="font-semibold text-blue-800 underline" href="{{ route('admin.elections.show', ['election' => $election->id ]) }}">
                                                {{ $election->name }}
                                            </a>                             
                                    </div>      
                                    <div class='text-sm'>
                                            {{ $election->election_type->name }}

                                            @if ($election->college_id != null)
                                                    ({{ $election->college->code }})
                                            @else
                                                
                                            @endif
                                    </div>

                                </td>
                                <td>
                                     {{ \Carbon\Carbon::parse($election->start_date)->format('l jS F, Y') }}
                                     <div class='text-sm'>
                                            {{ \Carbon\Carbon::parse($election->start_time)->format('g:i a') }}
                                     </div>
                                </td>

                                <td>
                                     {{ \Carbon\Carbon::parse($election->end_date)->format('l jS F, Y') }}
                                     <div class='text-sm'>
                                            {{ \Carbon\Carbon::parse($election->end_time)->format('g:i a') }}
                                     </div>
                                </td>

                                <td>
                                                    @if ($election->live_status)
                                                        <div class='border-0 flex flex-col w-[50%] bg-green-400 rounded-md'>
                                                           <div class='border-0 mx-auto text-white font-semibold' >On</div>
                                                        </div>
                                                    @else
                                                        <div class='border-0 flex flex-col w-[50%] bg-red-400 rounded-md'>
                                                           <div class='border-0 mx-auto text-white font-semibold' >Off</div>
                                                        </div>
                                                    @endif

                                </td>
                                
                                <td>
                                           
                                            <span class="text-sm">
                                                <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.elections.edit', ['election' => $election->id]) }}">Edit</a>
                                            </span>
                                            <span> 
                                                <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.elections.confirm_delete', ['election'=> $election->id]) }}"
                                                >Delete</a>
                                            </span>	

                                </td>
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                    <div>
                        {{ $elections->links() }}
                    </div>

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Elections
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Electoral Committee Position Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>