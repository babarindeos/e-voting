<x-admin-layout>
    <div class="container mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Delete Cell Type</h1>
                    </div> 
                    <div>
                        <a href="{{ route('admin.cells.index') }}" class="bg-green-600 text-white py-2 px-4 
                                        rounded-lg text-xs md:text-sm hover:bg-green-500">Cell</a>

                        <a href="{{ route('admin.cell_types.index') }}" class="border border-green-600 text-green-600 py-2 px-4 
                                        rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Cell Types</a>
                    </div>                  
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- new ministry form //-->
        <section>
                <div>
                    <form  action="{{ route('admin.cells.confirm_delete', ['cell' => $cell->id]) }} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                        @csrf

                        

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >
                                
                            </h2>
                            Do you really wish to delete this Cell ?
                            
                            <div class="py-2 text-lg font-semibold">
                                {{ $cell->name }} ({{ $cell->code}})
                            </div>
                        </div>


                       
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-red-400 py-4 px-4 text-white 
                                           hover:bg-red-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Delete Cell </button>
                        </div>
                        
                    </form><!-- end of new Cell Type form //-->
                <div>
        </section>
        <!-- end of new ministry form //-->


    </div><!-- end of container //-->
</x-admin-layout>