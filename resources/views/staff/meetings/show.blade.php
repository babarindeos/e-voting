<x-staff-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        <section class="flex flex-row justify-between border-b border-gray-200 py-2 mt-6">
                <div class="text-2xl font-semibold ">
                    Meeting            
                </div>

                <div>

                            <a href="{{ route('admin.meetings.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Meetings</a>
                            
                            <a href="{{ route('admin.meetings.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Agenda</a>

                            <a href="{{ route('admin.meetings.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Attendance</a>
                </div>
                
        </section>  



        <!-- Announcement //-->
         

        <section class="py-2 mt-2">
            <div class="flex flex-col md:flex-row border-0">
                <div class="flex  flex-col md:w-[60%] border-0  py-2 overflow-y-auto h-100"><!-- left panel //-->
                

                      
                        <div class="border w-full md:w-[98%] rounded-md px-4 py-4">

                            <!-- announcement header //-->
                            <div class="flex flex-col border-b pb-4 space-y-2 md:space-y-1">
                                    <div class="py-1 font-semibold">
                                            {{ $meeting->title }}
                                    </div>
                                    <div class="flex flex-col md:flex-row text-sm md:space-x-6 border-0 md:items-center space-y-2 md:space-y-0">
                                            <div class="text-sm">
                                                Posted {{ $meeting->created_at->format('l jS F, Y @ g:i a') }}
                                            </div>
                                            <div class="flex">
                                                <div>
                                                    @if ($meeting->sender->profile != null) 
                                                            @if ($meeting->sender->profile->avatar!=null || $meeting->sender->profile->avatar!=null )
                                                                    <img src="{{ asset('storage/'.$meeting->sender->profile->avatar)}}" 
                                                                                class='w-8 h-8 rounded-full hover:ring hover:ring-gray-200' />
                                                            @else 
                                                                    <img class="w-8" src="{{ asset('images/avatar_64.jpg')}}" />
                                                            @endif
                                                    @else
                                                                <img class="w-8" src="{{ asset('images/avatar_64.jpg')}}" /> 
                                                    @endif
                                                </div>
                                                <div class="flex items-center px-2">
                                                        <a class="hover:underline" href="{{ route('staff.profile.email_user_profile',['email'=>$meeting->sender->email]) }}">
                                                                @php
                                                                    $surname = ucfirst(strtolower($meeting->sender->surname))
                                                                @endphp
                                                                {{ $surname }} {{ $meeting->sender->firstname }}
                                                        </a>
                                                </div>
                                            </div>
                                    </div>

                                   
                                </div>
                                <!-- end of announcement header //-->



                                <!-- meeting body //-->
                                <div class="py-8">

                                    <div class="flex flex-col md:flex-row ">

                                            <div class="md:w-1/5 border rounded-md py-4 px-4">
                                                <div class="text-center text-2xl font-semibold">
                                                         {{ \Carbon\Carbon::parse($meeting->date)->format('jS M')}}
                                                </div>
                                                <div class="text-center text-3xl font-bold">
                                                         {{ \Carbon\Carbon::parse($meeting->date)->format('Y')}} 
                                                </div>
                                                <div class="text-center py-2 text-lg">
                                                        @ {{ \Carbon\Carbon::parse($meeting->time)->format('g:i a') }}
                                                </div>
                                            </div>

                                            <div class="flex flex-col md:w-4/5 py-2 px-4  justify-center">
                                                    
                                                    <div class="text-2xl">
                                                        {{ $meeting->title }}
                                                    </div>

                                                    <div>
                                                        @ {{ $meeting->venue }}
                                                    </div>

                                            </div>

                                    </div>

                                    <div class="py-2 px-2">

                                            <!-- file and link //--> 
                                            <div class="flex flex-col md:flex-row md:justify-between py-4">
                                                    <div>
                                                            @if ($meeting->file!="")
                                                                    <div class="text-sm">
                                                                            <i class="fa-solid fa-paperclip"></i> 
                                                                            <a href="{{ asset('storage/'.$meeting->file) }}" target="_blank" class="hover:underline">
                                                                            File Attachment - <span class='text-xs'> {{ $meeting->filetype}} ({{ $meeting->filesize }})</span>
                                                                            </a>
                                                                    </div>
                                                                    <!-- end of file attachment //-->
                                                            @endif
                                                    </div>
                                                    <div>
                                                            <!-- meeting links //-->
                                                            @if ($meeting->link !='')
                                                                <div class="text-sm">
                                                                    <i class="fa-solid fa-globe "></i> 
                                                                    <a href="{{ $meeting->link }}" class="underline text-blue-800 px-1" target="_blank">
                                                                        {{ $meeting->link}}
                                                                    </a>

                                                                </div>
                                                            @endif
                                                    </div>
                                            </div>
                                            <!-- link of file and links //-->

                                            <div class='py-4'>
                                                    {!!  nl2br(e($meeting->message)) !!}
                                            </div>
                                    </div>


                                    
                                    <!-- Minutes of //-->
                                    @if ($meeting->minutes->count())
                                        <div class='px-2 py-2 mt-4 text-lg font-semibold border-b'>
                                             Minutes of Meeting
                                        </div>
                                        @foreach($meeting->minutes as $minute)
                                            <div class='px-2 py-4'>
                                                 <a href="{{ asset('storage/'.$minute->file) }}" target="_blank" class="underline">
                                                    {{ $minute->title }}
                                                </a>
                                            </div>
                                        @endforeach 
                                    @endif


                                    <!-- end of minutes //-->





                                    <!-- Agenda //-->

                                    @if ($agenda->count())
                                                <!-- Section //-->
                                                <section class="py-6">
                                                        <div class="flex border-0 flex-col w-[100%] md:w-[100%] py-2 md:py-4 md:px-1 mx-auto" >
                                                                <div class="font-semibold text-lg py-2">
                                                                        Substantive Senate Business
                                                                </div>
                                                                <div class="font-semibold text-md border-b py-2">
                                                                        Agenda
                                                                </div>
                                                                <div>
                                                                    <table width="100%" cellpadding="5">
                                                                        <thead>
                                                                            <tr class="border-b bg-green-100">
                                                                                <th class="py-4" width="10%">SN</th>
                                                                                <th class="text-left">Items</th>
                                                                               
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @php
                                                                                $counter = 0;
                                                                            @endphp
                                                                        
                                                                            @foreach($agenda as $agendum)
                                                                                <tr class="border-b">
                                                                                    <td class='text-center py-4'>
                                                                                        {{ ++$counter }}.
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $agendum->title}}
                                                                                        <div>
                                                                                            @if ($agendum->paper_id !=null)
                                                                                                        <a class='underline' target="_blank" href="{{ route('admin.papers.show',['paper'=>$agendum->paper_id]) }}">
                                                                                                            {{ $agendum->paper->title}} ({{ $agendum->paper->paper_no }})
                                                                                                        </a>
                                                                                                        <span class='text-xs border px-2 rounded-md'>Paper</span>

                                                                                                        @if ($agendum->paper->file!="")
                                                                                                                        <div class="text-sm">
                                                                                                                                <i class="fa-solid fa-paperclip"></i> 
                                                                                                                                <a href="{{ asset('storage/'.$agendum->paper->file) }}" target="_blank" class="hover:underline">
                                                                                                                                File Attachment - <span class='text-xs'> {{ $agendum->paper->filetype}} ({{ $agendum->paper->filesize }})</span>
                                                                                                                                </a>
                                                                                                                        </div>
                                                                                                                        <!-- end of file attachment //-->
                                                                                                        @endif
                                                                                            @endif
                                                                                            

                                                                                        </div>
                                                                                    </td>
                                                                                    
                                                                                </tr>
                                                                            @endforeach

                                                                        </tbody>
                                                                    </table>

                                                                </div>

                                                        </div>
                                                </section>

                                            <!-- end of Section //-->
                                    @endif





                                    <!-- end of Agenda //-->








                                </div>
                                <!-- meeting body //-->


                               

                                <!-- end of announcement links //-->
                                
                        </div>
                        

                        


                    
                       

                </div><!-- end of left pane //-->


                <div class="flex flex-col md:border-l  md:w-[40%] md:px-3 py-2"><!-- Right pane //-->
                    <form action="{{ route('admin.meetings.comments.store', ['meeting'=>$meeting->id]) }}" method="POST">
                            @csrf

                            <div class="py-1">
                                    Share your thoughts... 
                            </div>
                            <!-- textarea //-->
                            <div class="flex items-center py-1">
                                    
                                    <textarea name="message" rows="3" class="overflow-hidden border border-1 border-gray-400 bg-gray-50
                                            w-full p-2 rounded-md 
                                            focus:outline-none
                                            focus:border-blue-500 
                                            focus:ring
                                            focus:ring-blue-100" 
                                            
                                            value="{{ old('message') }}"
                                            required
                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                            maxlength="140">  </textarea>
                            </div>
                            <!-- end of textarea //-->

                            <!-- button //-->
                            <div class="flex justify-between">

                                <div class="flex text-xs text-gray-500">
                                    140 characters max
                                </div>
                                
                                <div>    
                                    <button type="submit" class="border border-1 border-green-500
                                    bg-green-500 text-white rounded-md py-2 px-4 text-xs font-semibold">
                                            Send
                                    </button>
                                </div>
                            </div>
                            <!-- end of button //-->
                    </form>



                    <!-- list of messages //-->
                    <div class="flex flex-col border-0 border-blue-900 h-50 overflow-y-auto py-2 mt-2">

                            @foreach ($comments as $comment)
                                <div class="flex flex-row my-2">
                                        <div class="px-3 border-0">
                                                @if ($comment->sender->profile !=null && $comment->sender->profile->avatar!="" )
                                                
                                                    <img src="{{ asset('storage/'.$comment->sender->profile->avatar)}}" class='w-12 h-10 rounded-full' />
                                                    
                                                @else
                                                    <img class="w-12" src="{{ asset('images/avatar_64.jpg')}}" />  
                                                @endif
                                                
                                        </div>
                                        <div class="px-3 py-1 rounded-md bg-gray-100 w-full">
                                                <a href="{{ route('staff.profile.email_user_profile', ['email'=>$comment->sender->email]) }}" class="font-semibold text-sm hover:underline">
                                                        
                                                        @php
                                                            $surname = ucfirst(strtolower($comment->sender->surname));
                                                        @endphp

                                                        {{ $surname }} {{ $comment->sender->firstname }}
                                                </a>
                                                <div class="text-xs">
                                                        {{ $comment->created_at->format('l jS F, Y @ g:i a') }}
                                                </div>
                                                <div class="text-sm py-2">
                                                       {{ $comment->message }}
                                                </div>

                                                @if (Auth::user()->id == $meeting->user_id)
                                                    <div class="text-xs text-end px-2 py-1">
                                                        <form action="{{ route('admin.meetings.comments.delete_comment', ['comment'=>$comment->id]) }}" method="post">
                                                            @csrf
                                                            @method('delete')                                
                                                                <button type="submit" class='border px-3 py-1 border-red-400 rounded-md 
                                                                       hover:text-white'><i class="fas fa-trash text-gray-500"></i></button>
                                                        </form>
                                                    </div>
                                                @endif

                                        </div>
                                </div>
                            @endforeach
                        
                    </div>
                    <!-- end of list of messages //-->

                    

                                                                                

                </div><!-- end of right panel //-->
            </div>             
        </section>

    
    
        





        <!-- end of announcement //-->





    </div>
</x-staff-layout>