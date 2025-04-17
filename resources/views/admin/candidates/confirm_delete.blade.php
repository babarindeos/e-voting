<x-admin-layout>
    <div class="flex flex-col w-full mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[90%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
            
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Delete Candidate</h1>
                    </div> 
                    <div>                     
                                 <a href="{{ route('admin.elections.show', ['election' => $candidate->election->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                        rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">&laquo; Back</a>
                    </div>                       
            </div>
            
        </section>
        <!-- end of page header //-->



        <!-- delete Candidate form //-->
        <section>
                <div>
                    <form  action="{{ route('admin.elections.candidates.delete', ['candidate' => $candidate->id]) }} " method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center">
                    @method("delete")    
                    @csrf

                         @include('partials._session_response')
                         

                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >
                                
                            </h2>
                            Do you really wish to delete this Candidate ?
                            
                            <div class="py-2 text-lg font-semibold">
                                {{ $candidate->surname }} {{ $candidate->firstname }} {{ $candidate->othernames }} 
                            </div>
                        </div>


                       
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-red-400 py-4 px-4 text-white 
                                           hover:bg-red-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Delete Candidate</button>
                        </div>
                        
                    </form><!-- end of election registration form //-->
                <div>
        </section>
        <!-- end of Election Type form //-->


    </div><!-- end of container //-->
</x-admin-layout>