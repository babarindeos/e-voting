<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Election Registration</h1>
                    </div>
                    <div>                          


                            <a href="{{ route('admin.election_registrations.create') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">New Election Registration</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Election Registration Section  //-->
        

        
        <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 border-0">
                   


        @if ($election_registrations->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='5%' class="text-center font-semibold py-6 w-16">SN</th>
                                <th width='35%' class="font-semibold py-2 text-left">Election Suite</th>  
                                <th width='20%' class="font-semibold py-2 text-left">Start Date</th> 
                                <th width='20%' class="font-semibold py-2 text-left">End Date</th>  
                                <th width='10%' class="font-semibold py-2 text-left">Live Status</th>                                                        
                                <th width='10%' class="font-semibold py-2 text-left">Actions</th> 
                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($election_registrations->currentPage() - 1) * $election_registrations->perPage();
                            @endphp

                            @foreach($election_registrations as $election_registration)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-8 pr-4">
                                    
                                    <div>
                                        
                                            <a class="font-semibold text-blue-800 underline" href="#">
                                                {{ $election_registration->election_suite->name }}
                                            </a>                             
                                    </div>                                  

                                </td>
                                <td class="py-8 pr-4">
                                    
                                    {{ \Carbon\Carbon::parse($election_registration->start_date)->format('D. jS, F, Y') }}   
                                    <div class='text-sm'>
                                            {{ \Carbon\Carbon::parse($election_registration->start_time)->format('g:i a') }}
                                    </div>                         

                                </td>
                                <td class="py-8 pr-4">
                                    
                                    {{ $election_registration->end_date }}
                                    <div class='text-sm'>
                                            {{ \Carbon\Carbon::parse($election_registration->end_time)->format('g:i a') }}
                                    </div> 

                                </td>
                                <td>
                                                    @if ($election_registration->live_status)
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
                                                        px-4 py-1 text-xs" href="{{ route('admin.election_registrations.edit', ['election_registration' => $election_registration->id]) }}">Edit</a>
                                            </span>
                                            <span> 
                                                <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.election_registrations.confirm_delete', ['election_registration'=> $election_registration->id]) }}"
                                                >Delete</a>
                                            </span>	

                                </td>
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                   

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Election Registration
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Election Registration Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>