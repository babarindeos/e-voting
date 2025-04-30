<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Election Types</h1>
                    </div>
                    <div>

                            <a href="{{ route('admin.election_types.create') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">New Election Type</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Election Type Section  //-->
        

        
        <section class="flex flex-col w-[98%] md:w-[80%] mx-auto py-2 mt-2 border-0">
                   


        @if ($election_types->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='3%' class="text-center font-semibold py-6 w-16">SN</th>
                                <th width='50%' class="font-semibold py-2 text-left">Name</th> 
                                <th width='30' class="font-semibold py-2 text-left">Coverage</th>                               
                                <th width='17%' class="font-semibold py-2 text-left">Actions</th> 
                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($election_types->currentPage() - 1) * $election_types->perPage();
                            @endphp
                            @foreach($election_types as $election_type)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-8 pr-4">
                                    
                                    <div>
                                        
                                            <a class="font-semibold text-blue-800 underline" href="#">
                                                {{ $election_type->name }}
                                            </a>                             
                                    </div>                                  

                                </td>
                                <td>
                                        @if ($election_type->coverage == 1)
                                            University
                                            
                                        @elseif ($election_type->coverage == 2)
                                        
                                            College
                                        @elseif ($election_type->coverage ==3 )
                                        
                                            Hall of Residence
                                        @endif
                                </td>
                                <td>
                                           
                                            <span class="text-sm">
                                                <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.election_types.edit', ['election_type' => $election_type->id]) }}">Edit</a>
                                            </span>
                                            <span> 
                                                <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.election_types.confirm_delete', ['election_type'=> $election_type->id]) }}"
                                                >Delete</a>
                                            </span>	

                                </td>
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                    <div>
                        {{ $election_types->links() }}
                    </div>

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Election Types
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Election Type Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>