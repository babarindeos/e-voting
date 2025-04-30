<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-red-900 mx-auto border-0">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Hall of Residence</h1>
                    </div>
                    <div>

                            <a href="{{ route('admin.halls.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Hall</a>


                            <a href="{{ route('admin.halls.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Halls</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Elections  Section  //-->
        <section class="flex flex-col w-[98%] md:w-[98%] md:flex-row mx-auto py-0 mt-0 border-0 justify-between">   
                <div class='font-normal text-lg'>{{ $hall->name }} ({{ $hall->residents->count() }})</div>
                <div>
                        <div class='flex flex-col md:flex-row space-y-1 md:space-y-0 md:space-x-1'>
                                <a href="{{ route('admin.halls.residents.create', ['hall' => $hall->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Add Resident</a>

                                <a href="{{ route('admin.halls.residents.uploads.select_file', ['hall' => $hall->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Upload Residents</a>

                                <a href="{{ route('admin.halls.residents.delete_hall_residents', ['hall' => $hall->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Delete All Residents</a>
                        </div>
                </div>

        </section>
        

        
        <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 border-0">
                   
                @if ($hall->residents->count())
                                <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th width='10%' class="text-center font-semibold py-6 ">SN</th>
                                            <th width='20%' class="font-semibold py-2 text-left">Matric No.</th>
                                            <th width='50%' class="font-semibold py-2 text-left">Names</th>                                                                                       
                                            <th width='20%' class="font-semibold py-2 text-left">Actions</th> 
                                                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 0;
                                        @endphp

                                        @foreach($hall->residents as $resident)
                                        <tr class="border border-b border-gray-200 ">
                                            <td class='text-center py-4'>{{ ++$counter }}.</td>
                                            <td>
                                                {{ $resident->matric_no }}
                                            </td>
                                            <td>
                                                {{ $resident->fullname }}
                                            </td>
                                            
                                            
                                            <td class='flex flex-col justify-center py-3 border-0 space-x-1'>
                                                <form action="{{ route('admin.halls.residents.delete', ['resident'=>$resident->id]) }}" 
                                                      method="POST" class='flex flex-row space-x-2'>
                                                @csrf
                                                @method("delete")
                                                        <div class="flex flex-col text-sm">
                                                            <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                                    px-4 py-1 text-xs" 
                                                                    href="{{ route('admin.halls.residents.edit', ['resident' => $resident->id ]) }}">Edit</a>
                                                        </div>
                                                        <div class='flex flex-col'> 
                                                            
                                                               

                                                                    <button class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                                            px-4 py-1 text-xs"
                                                                    >Delete</button>
                                                           
                                                        </div>	
                                                </form>

                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    

                                    </tbody>
                                </table>

                               

                @else
                                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                                    <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                            There is currently no Residents
                                    </div>
                                </section>
                @endif


       


        </section>
       
        <!-- end of Electoral Committee Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>