<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Election Suites</h1>
                    </div>
                    <div>

                            


                            <a href="{{ route('admin.election_suites.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Election Suites</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->




        <!-- Elections  Section  //-->
        <section class="flex flex-col w-[98%] md:w-[98%] md:flex-row mx-auto py-0 mt-0 border-0 justify-between">   
                <div class='font-normal text-lg'>{{ $election_suite->name }}</div>
                <div class='flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2'>
                        <div class='flex flex-col md:flex-row space-y-1 md:space-y-0 md:space-x-1'>
                                <a href="{{ route('admin.election_suites.registered_voters', ['election_suite' => $election_suite->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Registered Voters</a>

                                
                        </div>

                        <div class='flex flex-col md:flex-row space-y-1 md:space-y-0 md:space-x-1'>
                                <a href="{{ route('admin.election_suites.show', ['election_suite' => $election_suite->id ]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Elections</a>

                                
                        </div>
                </div>

        </section>

        


        <!-- Election Suite Section  //-->
        

        
        <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 border-0">
                   


            @if ($election_suite->elections->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='15%' class="text-center font-semibold py-6 w-16">SN</th>
                                <th width='35%' class="font-semibold py-2 text-left">Name</th> 
                                <th width='30%' class="font-semibold py-2 text-left">Date</th>                                                      
                                <th width='25%' class="font-semibold py-2 text-center">Live Status</th> 
                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 0;
                            @endphp

                            @foreach($election_suite->elections as $election)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-8 pr-4">
                                    
                                    <div>
                                        
                                            <a class="font-semibold text-blue-800 underline" href="{{ route('admin.elections.show', ['election' => $election->id ]) }}">
                                                {{ $election->name }}
                                            </a>       
                                            <div class='text-sm'>{{ $election->name }} ({{ $election->election_type->name }})</div>                      
                                    </div>                                  

                                </td>
                                
                                <td>
                                           
                                        <div>
                                            {{ \Carbon\Carbon::parse($election->start_date)->format('D jS F, Y') }} - 
                                            {{ \Carbon\Carbon::parse($election->end_date)->format('D jS F, Y') }}
                                        </div> 
                                        <div class='text-sm'>
                                            {{ \Carbon\Carbon::parse($election->start_time)->format('g:i a') }} - 
                                            {{ \Carbon\Carbon::parse($election->end_time)->format('g:i a') }}
                                        </div> 

                                </td>
                                <td>
                                                    @if ($election->live_status)
                                                        <div class=' flex flex-col border-0 border-red-900 '>
                                                           <div class='border-0 mx-auto text-white py-2 px-4 bg-green-400 rounded-md font-semibold' >On</div>
                                                        </div>
                                                    @else
                                                        <div class='border-0 flex flex-col '>
                                                           <div class='border-0 mx-auto text-white py-2 px-4 bg-red-400 rounded-md font-semibold' >Off</div>
                                                        </div>
                                                    @endif
                                            

                                </td>
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                    

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Election Suites
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Election Suite Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>