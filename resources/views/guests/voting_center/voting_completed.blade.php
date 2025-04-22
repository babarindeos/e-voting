
<x-guest-layout>

    <div class="flex flex-col border-0 border-red-900 w-[100%] md:h-screen py-16">
        
 
        

        <form action="{{ route('student.elections.cast_vote') }}" method="post" class="border-0 mx-auto w-full h-full py-16">
            @csrf
        
                <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 mb-16">
                        
                        <div class='flex justify-center items-center -0 text-3xl'>Thank you for voting</div>

                        <div class="flex flex-row  space-x-8 mt-8 mx-auto">
                                                <div class="flex flex-col border-red-900  mt-4 border-0 mx-auto">
                                                    
                                                    <a href="{{ route('student.dashboard.index') }}" class="text-xl mx-auto underline text-blue-600" style="font-family:'Lato';font-weight:500;">Home</a> 
                                                </div>
                                                <div class="flex flex-col border-red-900  mt-4 border-0 mx-auto">
                                                    
                                                    <a href="{{ route('student.dashboard.index') }}" class="text-xl mx-auto underline text-blue-600" style="font-family:'Lato';font-weight:500;">Voting Center</a>
                                                </div>
                        </div>
                        
                </section>       
                <!-- end of body Section //-->
        
        </form>
            
        
    
    
        
    </div>
    


</x-guest-layout>




