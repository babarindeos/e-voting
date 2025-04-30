<x-guest-layout>
    <div class="flex flex-col md:flex-row w-full w-[100%] border py-8 px-8">
        <div class='flex flex-col items-center md:w-[30%] md:px-4'>
             @if ($candidate->photo==null)
                <img src="{{ asset('images/avatar_150.jpg')}}" class="w-72 h-72"  />
             @else
                <img src="{{ asset('storage/'.$candidate->photo) }}" class="w-full rounded-md" />
             @endif
             <div class='py-2 text-2xl text-center'>
                 {{ $candidate->surname }} {{ $candidate->firstname }} {{ $candidate->othernames}}
                 <div class='text-lg'>{{ $candidate->alias }}</div>
             </div>

             <div class='flex border-0 py-4 justify-center' >
                    <div class='text-center'>
                            {{ $candidate->department->code }}, {{ $candidate->college->code }}
                            <div>{{ $candidate->level }}</div>

                    </div>
             </div>
             
        </div>
        <div class='flex flex-col md:w-[70%] border-0  md:px-4 md:border-l'>

                @if ($candidate->banner != null)
                    <div style="background-image:url('{{ asset('storage/'.$candidate->banner) }}'); 
                                    background-size: cover; 
                                    background-repeat: repeat;
                                    background-position: center left;"> 

                            <img src="{{ asset('storage/'.$candidate->banner) }}" class='object-cover w-full h-64'/>
                    </div>
                @endif


                
                    <div class='flex justify-between'>
                             @if ($candidate->slogan != null)
                                    <div class='py-4 text-lg'>
                                        <span class='font-medium '>Slogan:</span> {{ $candidate->slogan }}
                                    </div>
                             @endif

                             @if ($candidate->manifesto != null)
                                    <div class='py-4 text-lg'>
                                        <a target='_blank' class='hover:underline' href="{{ asset('storage/'.$candidate->manifesto ) }}">Manifesto</a>
                                    </div>
                            @endif
                    </div>
                   

                


                @if ($candidate->bio != null)
                    <div class='text-2xl mt-2'>About</div>
                    <div class='py-4 text-md'>
                         {{!! nl2br($candidate->bio) !!}}
                    </div>

                @endif
        </div>


        

    </div>
</x-guest-layout>