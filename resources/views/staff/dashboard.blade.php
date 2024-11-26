<x-staff-layout>

<div class="flex flex-col border-0 w-[95%] mx-auto">
    <section class="border-b border-gray-200 py-2 mt-2">
            <div class="text-2xl font-semibold ">
                Dashboard                
            </div>
            <div>
               
            </div>
    </section>

    <div class="py-2">
                @if (Auth::check())
                    @php
                        $surname = ucfirst(strtolower(Auth::user()->surname))
                    @endphp

                    Welcome 
                @endif
               <span class='font-semibold'>Welcome,</span>  {{ $surname }} {{ Auth::user()->firstname}}
    </div>

   


    
        




    
</div>

</x-staff-layout>