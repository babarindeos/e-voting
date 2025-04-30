<x-guest-layout>
<div class="flex flex-col flex-1 w-full border-0">

    <div class="flex flex-col md:flex-row h-[80%] md:h-full w-full md:w-[30%] mx-auto">
           
            


            <!-- Right  panel //-->
            <div class="flex flex-col w-full  md:w-[100%] items-center justify-center py-4 border-0">

                <section class="flex flex-col w-full border border-0">
                    <div class="flex flex-col w-full border border-0" >
                         <form  action="" method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center space-y-2">
                                <div class='text-3xl font-semibold'>
                                     Registration Completed

                                </div>
                                <div class='text-center py-4 text-xl'>
                                    Your registration code for the elections has been sent to <span class='text-green-600'>{{ $email }}</span>. Thank you.
                                </div>
                        </form>
                    </div>
                </section>
                    
            </div>
            <!-- end of right panel //-->
    </div>


</div>
</x-guest-layout>