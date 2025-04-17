<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Elective Positions</h1>
                    </div>
                    <div>

                            


                            <a href="{{ route('admin.positions.create') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">New Elective Position</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Elective Position Section  //-->
        

        
        <section class="flex flex-col w-[98%] md:w-[80%] mx-auto py-2 mt-2 border-0">
                   


        @if ($positions->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='10%' class="text-center font-semibold py-6 w-16">SN</th>
                                <th width='75%' class="font-semibold py-2 text-left">Name</th>                                                      
                                <th width='15%' class="font-semibold py-2 text-left">Actions</th> 
                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($positions->currentPage() - 1) * $positions->perPage();
                            @endphp

                            @foreach($positions as $position)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-8 pr-4">
                                    
                                    <div>
                                        
                                            <a class="font-semibold text-blue-800 underline" href="#">
                                                {{ $position->name }}
                                            </a>                             
                                    </div>                                  

                                </td>
                                
                                <td>
                                           
                                            <span class="text-sm">
                                                <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.positions.edit', ['position' => $position->id]) }}">Edit</a>
                                            </span>
                                            <span> 
                                                <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.positions.confirm_delete', ['position'=> $position->id]) }}"
                                                >Delete</a>
                                            </span>	

                                </td>
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                    <div>
                        {{ $positions->links() }}
                    </div>

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Elective Positions
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Electoral Committee Position Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>