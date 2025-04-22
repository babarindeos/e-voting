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

         <!-- Elections  Section  //-->
         <section class="flex flex-col w-[98%] md:w-[98%] md:flex-row mx-auto py-0 mt-0 border-0 justify-between">   
                <div class='font-normal text-lg font-semibold'>Registered Voters ({{ $election_suite->registered_voters->count() }})</div>
        </section>
        

        
        <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 border-0">
                   


            @if ($election_suite->registered_voters->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='10%' class="text-center font-semibold py-6 w-16">SN</th>
                                <th width='35%' class="font-semibold py-2 text-left">Name</th>
                                <th width='15%' class="font-semibold py-2 text-left">Contact</th>  
                                <th width='25%' class="font-semibold py-2 text-left">Constituency</th> 
                                <th width='15%' class="font-semibold py-2 text-left">Date</th> 
                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 0;
                            @endphp

                            @foreach($election_suite->registered_voters as $voter)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-8 pr-4">
                                    
                                    <div>
                                        
                                            <a class="font-medium " href="#">
                                                {{ $voter->surname }} {{ $voter->firstname }} {{ $voter->othernames }}
                                            </a>       
                                            <div class='text-sm'>
                                                {{ $voter->matric_no }}
                                            </div>                      
                                    </div>                                  

                                </td>
                                
                                <td>
                                           
                                            {{ $voter->phone }}

                                </td>
                                <td>
                                                    
                                            {{ $voter->department->code }}, {{ $voter->college->code }}
                                            <div class='text-sm'>{{ $voter->level }}</div>

                                </td>
                                <td>
                                            {{ \Carbon\Carbon::parse($voter->created_at)->format('D. jS F, Y') }}
                                </td>
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                    

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Registered Voters
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Election Suite Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>