<x-guest-layout>
<div class="flex flex-col flex-1 w-full border-0">

    

            @if ($registrations->count() || $elections->count())


                    <div class="flex flex-col  mx-auto w-full border-0">

                                @if ($registrations->count())
                                        <!-- registrations //-->
                                        <div class='flex flex-col w-[100%] md:w-[70%] border-0 mx-auto py-16'>
                                                @foreach($registrations as $registration)
                                                    <div class='flex flex-col justify-center items-center border w-full mx-auto py-16 shadow-md rounded-md'>
                                                        
                                                            <div class='text-center'>
                                                                    <div class='text-3xl font-semibold'>
                                                                        {{ $registration->election_suite->name }}
                                                                    </div>
                                                                    <div class='text-2xl py-2 mb-4'>
                                                                        Voter Registration
                                                                    </div>

                                                                    <div class='mt-8 text-xl'>Opens</div>
                                                                    <div class='flex flex-row space-x-2 justify-center mb-8 text-xl font-semibold'> 
                                                                        <div>
                                                                                {{ \Carbon\Carbon::parse($registration->start_date)->format('l jS F, Y') }}
                                                                        </div>
                                                                        <div>
                                                                                {{ \Carbon\Carbon::parse($registration->start_time)->format('g:i a') }}
                                                                        </div>
                                                                    </div>


                                                                    <div class='mt-8 text-xl'>Closes</div>
                                                                    <div class='flex flex-row space-x-2 justify-center mb-12 text-xl font-semibold'> 
                                                                        <div>
                                                                                {{ \Carbon\Carbon::parse($registration->end_date)->format('l jS F, Y') }}
                                                                        </div>
                                                                        <div>
                                                                                {{ \Carbon\Carbon::parse($registration->end_time)->format('g:i a') }}
                                                                        </div>
                                                                    </div>

                                                                    <div class='text-2xl'>
                                                                        <a class='underline' href="{{ route('guest.registration_center.index',['election_suite_uuid'=> $registration->election_suite->uuid]) }}">    
                                                                                Register Now
                                                                        </a>
                                                                    </div>
                                                            </div>
                                                    </div>
                                                @endforeach
                                        </div>
                                        <!-- end of registrations //-->
                                @endif


                                <!-- elections //-->
                                 @if ($elections->count())
                                    <div class='flex flex-col w-[100%] md:w-[70%] border-0  mx-auto py-16'>
                                                @foreach($elections as $election)
                                                    <div class='flex flex-col justify-center items-center border w-full mx-auto py-16 shadow-md rounded-md'>
                                                            <div class='text-center'>
                                                                    <div class='text-3xl font-semibold'>
                                                                        {{ $election->election_suite->name }}
                                                                    </div>
                                                                    <div class='text-2xl py-2 mb-2'>
                                                                        {{ $election->name }}
                                                                    </div>
                                                            </div>
                                                            <div class='mt-8 text-xl'>Opens</div>
                                                            <div class='flex flex-row space-x-2 justify-center mb-4 text-xl font-semibold'> 
                                                                <div>
                                                                        {{ \Carbon\Carbon::parse($election->start_date)->format('l jS F, Y') }}
                                                                </div>
                                                                <div>
                                                                
                                                                        {{ \Carbon\Carbon::parse($election->start_time)->format('g:i a') }}
                                                                </div>
                                                            </div>


                                                            <div class='mt-4 text-xl'>Closes</div>
                                                            <div class='flex flex-row space-x-2 justify-center mb-12 text-xl font-semibold'> 
                                                                <div>
                                                                        {{ \Carbon\Carbon::parse($election->end_date)->format('l jS F, Y') }}
                                                                </div>
                                                                <div>
                                                                
                                                                        {{ \Carbon\Carbon::parse($election->end_time)->format('g:i a') }}
                                                                </div>
                                                            </div>
                                                            <div class='text-2xl'>
                                                                            <a href="{{ route('guest.voting_center.index') }}" class='underline'>
                                                                                Vote Now
                                                                            </a>
                                                            </div>


                                                            @if ($election->positions->count())
                                                                
                                                                <div class='mt-16 border-t w-full mx-auto'>
                                                                    @foreach ($election->positions->unique('id') as $election_position)
                                                                            <div class='py-8 border-0 w-[80%] mx-auto text-center text-xl font-semibold'>{{ $election_position->name; }} Contestants</div>
                                                                            <div class='flex flex-row justify-center py-4 border-t w-[80%] mx-auto mb-16 space-x-10'>
                                                                                    @foreach($election->candidates as $candidate)
                                                                                        @if ($candidate->position_id == $election_position->id)
                                                                                                <div class='flex flex-col items-center space-y-2'>
                                                                                                        <div> 
                                                                                                                <a class='hover:shadow-md' href="{{ route('guest.candidate.alias',['candidate_alias' => $candidate->alias]) }}">
                                                                                                                        @if ($candidate->photo==null)
                                                                                                                        <img src="{{ asset('images/avatar_150.jpg')}}" class="w-36 h-36"  />
                                                                                                                        @else
                                                                                                                        <img src="{{ asset('storage/'.$candidate->photo) }}" class="w-36 h-36 rounded-full hover:shadow-lg" />
                                                                                                                        @endif
                                                                                                                </a>
                                                                                                        </div>
                                                                                                        <div>
                                                                                                                <a class='hover:underline' href="{{ route('guest.candidate.alias',['candidate_alias' => $candidate->alias]) }}">
                                                                                                                        {{ $candidate->surname }} {{ $candidate->firstname }}
                                                                                                                </a>
                                                                                                        </div>
                                                                                                </div>
                                                                                        @endif
                                                                                    @endforeach
                                                                            </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif


                                                                
                                                            

                                                    </div>
                                                @endforeach
                                    </div>


                                 @endif
                                <!-- end of elections //-->
                    </div>

            @else
                <div class="flex flex-col md:flex-row h-[80%]">
                            <!-- panel //-->
                            <div class="flex flex-col border-0 py-16 h-full w-full  md:w-[100%] md:h-[100%]"
                                style="background-image:url('{{asset('images/online-elections-voting.jpeg')}}'); 
                                    background-size: cover; 
                                    background-repeat: repeat
                                    background-position: center center; background-color:#f1f1f1;"
                            >
                                    <!-- <img src="{{ asset('images/goviflow_low.jpg') }}" /> //-->
                            </div>
                            <!-- end of panel //-->
                </div>
            @endif



           
    </div>


</div>
</x-guest-layout>