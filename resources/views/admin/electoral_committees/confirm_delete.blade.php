<x-admin-layout>
    <div class="flex flex-col w-full mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Delete Electoral Committee</h1>
                    </div> 
                    <div>
                           

                            <a href="{{ route('admin.electoral_committees.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Electoral Committees</a>


                            <a href="{{ route('admin.electoral_committees.positions.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Electoral Committee Positions</a>
                    </div>                       
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- delete Election form //-->
        <section>
                <div>
                    <form  action="{{ route('admin.electoral_committees.delete', ['electoral_committee' => $electoral_committee->id]) }} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                    @method("delete")    
                    @csrf

                         @include('partials._session_response')
                         

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >
                                
                            </h2>
                            Do you really wish to delete this Electoral Committee ?
                            
                            <div class="py-2 text-lg font-semibold">
                                {{ $electoral_committee->name }} 
                            </div>
                        </div>


                       
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-red-400 py-4 px-4 text-white 
                                           hover:bg-red-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Delete Electoral Committee</button>
                        </div>
                        
                    </form><!-- end of electoral committee form //-->
                <div>
        </section>
        <!-- end of Electoral Committee form //-->


    </div><!-- end of container //-->
</x-admin-layout>