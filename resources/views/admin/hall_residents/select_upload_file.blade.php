<x-admin-layout>


<div class="flex flex-col border-0 w-[95%] mx-auto py-4">

        <!-- Page Header //-->
        <section class="border-b border-gray-200 py-2 mt-2">
            <div class="flex border-gray-300 py-2 justify-between">
                    <div class="text-2xl font-semibold ">
                        Hall Residents       
                    </div>    
                    <div>
                            <a href="{{ route('admin.halls.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Hall</a>


                            <a href="{{ route('admin.halls.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Halls</a>
                    </div>    
            </div>    
        </section>
        <!-- end of Page Header //-->



         <!-- new student form //-->
         <section>
                <div class='font-normal text-xl py-4'>{{ $hall->name }}</div>
                <form  action="#" method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-[80%] items-center justify-center">
                                @csrf

                                

                                <div class="flex flex-col w-[100%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                                    <h2 class="font-semibold text-xl py-1" >Upload File</h2>
                                    <span class='text-sm'>Upload csv file (containing Matric No., Full names.  No column heading)</span> 
                                </div>


                                @include('partials._session_response')

                                <!-- document file //-->
                                <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-2">
                                
                                
                                            <input type="file" name="document" class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100" 
                                            
                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                            accept=".csv"
                                            required />
                                                
                    
                                            @error('document')
                                                <span class="text-red-700 text-sm">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                            
                                </div>
                                <!-- end of document file //-->

                                <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] mt-1">
                                        <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                                      hover:bg-gray-500 rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Upload File</button>
                                </div>


                                @if ($failuploads->count())
                                        <!-- List of failed Upload //-->
                                        <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-8">
                                                <a id='btn_failupload' href="#" class='hover:underline text-lg text-red-800 font-semibold'>
                                                    Failed Upload ({{ $failuploads->count() }})
                                                </a>
                                                <table class="border hidden" id='tbl_failupload'>
                                                    <thead>
                                                        <tr class='bg-gray-100'>
                                                            <th width='10%' class='text-center py-4'>SN</th>
                                                            <th  width='40%' class="text-left">Matric. No</th>
                                                            <th class="text-left">Full name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $counter = 0;
                                                        @endphp
                                                        @foreach($failuploads as $failupload)
                                                            <tr class='odd:bg-white even:bg-gray-50'>
                                                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                                                <td>
                                                                    <div>
                                                                        {{ $failupload->fullname }}
                                                                    </div>
                                                                   
                                                                </td>
                                                                <td>
                                                                         {{ $failupload->matric_no }}
                                                                </td>
                                                            </tr>
                                                        @endforeach                                            

                                                    </tbody>
                                                </table>
                                        </div>
                                        <!-- end of failed Upload //-->
                                @endif
                            
                           
                    </form>        
                   
        </section>
        <!-- end of new student form //-->


        @if ($temp_upload->count())

                <!-- List of records //-->
                <div class="flex flex-col mx-auto w-[100%] md:w-[100%] mt-2 mb-8 md:px-10 items-center justify-center border rounded-md ">
                        <div class="flex flex-col border-0 border-red-800 w-[100%] md:w-[100%]  md:px-2 py-2  mb-8">
                                <div class='flex flex-row md:flex-row md:justify-between text-lg font-medium py-4 mt-2 '>
                                        <div>
                                                Students Uploaded Records ({{ $temp_upload->count() }})
                                        </div>
                                        <div>
                                                <div class="flex flex-row space-x-2">
                                                        <div>
                                                                    <a href="{{ route('admin.halls.residents.uploads.clear_temp_upload') }}" class="border border-green-600 text-green-600 py-2 px-4 
                                                                                rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500"> Clear </a>
                                                        </div>
                                                        <div>
                                                                    <a href="{{ route('admin.halls.residents.uploads.save', ['hall'=> $hall->id]) }}" class="border border-green-600 text-green-600 py-2 px-4 
                                                                                rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500"> Save </a>
                                                            
                                                        </div>

                                                </div>
                                        </div>
                                </div>
                                <table class="w-full">
                                    <thead>
                                        <tr class='bg-green-100'>
                                            <th width='10%' class='py-4'>SN</th>                                            
                                            <th width='25%' class='text-left '>Matric No.</th>
                                            <th width='40%' class='text-left '>Full name</th>                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach($temp_upload as $student)
                                        <tr class="odd:bg-white even:bg-gray-100 border-b">
                                            <td class='text-center py-4'>{{ ++$counter }}.</td>
                                            
                                            <td>
                                                    {{ $student->matric_no }}                           
                                            </td>
                                            <td>
                                                    {{ $student->fullname }}                           
                                            </td>
                                            
                                            <td class='text-center py-4'>
                                                <form action="{{ route('admin.halls.residents.uploads.delete',['upload' => $student->id ]) }}" method="POST">
                                                    @csrf
                                                    @method("delete")

                                                    <button class='border border-red-600 py-2 px-4 text-xs rounded-2xl hover:bg-red-500 hover:text-white'>
                                                        Remove
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                        </div>
                            
                </div>
                <!-- end of records //-->
                    
        @endif




</div>



</x-admin-layout>


<script>
$(document).ready(function(){
   $("#btn_failupload").bind('click', function(){
        $('#tbl_failupload').toggle();
   })
});
</script>