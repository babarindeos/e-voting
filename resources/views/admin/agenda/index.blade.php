<x-admin-layout>

    <div class="flex flex-col border-0 w-[89%] md:w-[93%] mx-auto">
        <section class="flex flex-row justify-between border-b border-gray-200 py-2 mt-6">
                <div class="text-2xl font-semibold ">
                    Meeting            
                </div>

                <div>

                            <a href="{{ route('admin.meetings.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Meetings</a>
                </div>
                
        </section>

       


        <!-- Create Announcement Section  //-->
        
       
    
        <section class="py-8 mt-2">
                <div>
                    <form  action="{{ route('admin.meetings.agenda.store',['meeting'=>$meeting->id]) }} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-full md:w-[95%] items-center justify-center">
                        @csrf
    
                        
    
                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >{{ $meeting->title }}</h2>                            
                        </div>
    
    
                        @include('partials._session_response')
                        
                        
    

                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3 ">
                            Add Agendum

                        </div>
                        <!-- Meeting Agendum //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <input type="text" name="title" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" placeholder="Agendum"
                                                                    
                                                                    value="{{ old('title') }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    required
                                                                    />  
                                                                                                                                        
    
                                                                    @error('title')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of Meeting title //--> 


                        <!-- Paper //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                                <select name="paper" class="border border-1 border-gray-400 bg-gray-50
                                                                         w-full p-4 rounded-md 
                                                                         focus:outline-none
                                                                         focus:border-blue-500 
                                                                         focus:ring
                                                                         focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                         
                                                                         style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                         
                                                                         >
                                                                        <option value=''>-- Select Paper --</option>
                                                                            @foreach($papers as $paper)
                                                                                <option class='py-4' value="{{$paper->id}}">{{$paper->title}} ({{$paper->paper_no}})</option>
                                                                            @endforeach                                                                    
                                                                        </select>
    
                                                                         @error('paper')
                                                                            <span class="text-red-700 text-sm">
                                                                                {{$message}}
                                                                            </span>
                                                                         @enderror
                                
                            </div>
                            
                            <!-- end of Paper //-->

                        
                        
                        
                        
                        
    
    
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Add Agendum</button>
                        </div>
                        
                    </form><!-- end of new Announcement form //-->
                <div>
    
            

        </section>
        <!-- End of Create Announcement Section //-->


        @if ($agenda->count())
        <!-- Section //-->
        <section class="">
                <div class="flex border-0 flex-col w-[80%] md:w-[60%] py-2 md:py-4 md:px-8 mx-auto" >
                        <div class="font-semibold text-xl border-b py-2">
                                Agenda
                        </div>
                        <div>
                            <table width="100%" cellpadding="5">
                                <thead>
                                    <tr class="border-b bg-green-100">
                                        <th class="py-4" width="10%">SN</th>
                                        <th class="text-left">Item</th>
                                        <th class="text-left">Action</th>
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
                                            <td>
                                                    <form action="{{ route('admin.meetings.agenda.delete',['agenda'=>$agendum->id]) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class='text-xs border px-2 py-1 
                                                                       rounded-md border-red-400 hover:bg-red-400 hover:text-white '>
                                                            Remove                                                                    
                                                        </button>

                                                    </form>
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



    </div>

</x-admin-layout>