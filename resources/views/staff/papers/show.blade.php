<x-staff-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        <section class="flex flex-row justify-between border-b border-gray-200 py-2 mt-6">
                <div class="text-2xl font-semibold ">
                    Paper            
                </div>

                <div>

                            <a href="{{ route('staff.papers.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Papers</a>
                </div>
                
        </section>  



        <!-- Paper //-->
         

        <section class="py-2 mt-2">
            <div class="flex flex-col md:flex-row border-0">
                <div class="flex  flex-col md:w-[60%] border-0  py-2 overflow-y-auto h-100"><!-- left panel //-->
                

                      
                        <div class="border w-full md:w-[98%] rounded-md px-4 py-4">

                            <!-- paper header //-->
                            <div class="flex flex-col border-b pb-4 space-y-2 md:space-y-1">
                                    <div class="py-1 font-semibold text-xl">
                                            {{ $paper->title }} ({{ $paper->paper_no }})
                                    </div>
                                    <div class="flex flex-col md:flex-row text-sm md:space-x-6 border-0 md:items-center space-y-2 md:space-y-0">
                                            <div class="text-sm">
                                                Posted {{ $paper->created_at->format('l jS F, Y @ g:i a') }}
                                            </div>
                                            <div class="flex">
                                                <div>
                                                    @if ($paper->sender->profile != null) 
                                                            @if ($paper->sender->profile->avatar!=null || $meeting->sender->profile->avatar!=null )
                                                                    <img src="{{ asset('storage/'.$paper->sender->profile->avatar)}}" 
                                                                                class='w-8 h-8 rounded-full hover:ring hover:ring-gray-200' />
                                                            @else 
                                                                    <img class="w-8" src="{{ asset('images/avatar_64.jpg')}}" />
                                                            @endif
                                                    @else
                                                                <img class="w-8" src="{{ asset('images/avatar_64.jpg')}}" /> 
                                                    @endif
                                                </div>
                                                <div class="flex items-center px-2">
                                                        <a class="hover:underline" href="{{ route('staff.profile.email_user_profile',['email'=>$paper->sender->email]) }}">
                                                                @php
                                                                    $surname = ucfirst(strtolower($paper->sender->surname))
                                                                @endphp
                                                                {{ $surname }} {{ $paper->sender->firstname }}
                                                        </a>
                                                </div>
                                            </div>
                                    </div>

                                   
                                </div>
                                <!-- end of announcement header //-->



                                <!-- meeting body //-->
                                <div class="py-4">

                                        <!-- file and link //--> 
                                        <div class="flex flex-col md:flex-row md:justify-between py-4">
                                                    <div>
                                                            @if ($paper->file!="")
                                                                    <div class="text-sm">
                                                                            <i class="fa-solid fa-paperclip"></i> 
                                                                            <a href="{{ asset('storage/'.$paper->file) }}" target="_blank" class="hover:underline">
                                                                            File Attachment - <span class='text-xs'> {{ $paper->filetype}} ({{ $paper->filesize }})</span>
                                                                            </a>
                                                                    </div>
                                                                    <!-- end of file attachment //-->
                                                            @endif
                                                    </div>                                                   
                                        </div>
                                        <!-- link of file and links //-->

                                        <div class="py-2">
                                                <div class='font-semibold'>
                                                    College
                                                </div>
                                                <div>
                                                    {{ $paper->paper_college->name }}
                                                </div>
                                        </div>

                                        @if ($paper->department!=null)
                                            <div class="py-2">
                                                    <div class='font-semibold'>
                                                        Department
                                                    </div>
                                                    <div>
                                                        {{ $paper->department }}
                                                    </div>
                                            </div>
                                        @endif

                                        <div class="py-2">
                                                <div class='font-semibold'>
                                                    Authors
                                                </div>
                                                <div>
                                                    {{ $paper->paper_author->surname }} {{ $paper->paper_author->firstname }}
                                                    <div class='text-sm'>{{ $paper->other_authors }}</div>
                                                </div>
                                        </div>

                                        <div class="py-2">
                                                <div class='font-semibold'>
                                                    Note
                                                </div>
                                                <div>
                                                        {!!  nl2br(e($paper->message)) !!}

                                                </div>
                                        </div>

                                        <div class="py-2">
                                                <div class='font-semibold'>
                                                    Status
                                                </div>
                                                <div>
                                                        @php
                                                            $status = ucwords($paper->status)
                                                        @endphp
                                                        {{ $status }}
                                                </div>
                                        </div>
                                    
                                </div>
                                <!-- meeting body //-->

                               

                                <!-- end of paper links //-->
                                
                        </div>
                        

                        


                    
                       

                </div><!-- end of left pane //-->


                <div class="flex flex-col md:border-l  md:w-[40%] md:px-3 py-2"><!-- Right pane //-->
                    <form action="{{ route('staff.papers.comments.store', ['paper'=>$paper->id]) }}" method="POST">
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

                                                @if (Auth::user()->id == $comment->user_id)
                                                    <div class="text-xs text-end px-2 py-1">
                                                        <form action="{{ route('staff.meetings.papers.delete_comment', ['comment'=>$comment->id]) }}" method="post">
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