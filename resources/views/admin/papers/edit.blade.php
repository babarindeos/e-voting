<x-admin-layout>

    <div class="flex flex-col border-0 w-[89%] md:w-[93%] mx-auto">
        <section class="flex flex-row justify-between border-b border-gray-200 py-2 mt-6">
                <div class="text-2xl font-semibold ">
                    Papers             
                </div>

                <div>

                            <a href="{{ route('admin.papers.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Papers</a>
                </div>
                
        </section>

       


        <!-- Create Paper Section  //-->
        
       
    
        <section class="py-8 mt-2">
                <div>
                    <form  action="{{ route('admin.papers.update',['paper'=>$paper->id]) }} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-full md:w-[95%] items-center justify-center">
                        @csrf
    
                        
    
                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >Edit Paper</h2>
                            
                        </div>
    
    
                        @include('partials._session_response')
                        
                        
    
                        <!-- Paper  //-->
                        <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0 border-red-900 w-[80%] md:w-[60%] py-3">
                        
                                    <!-- Paper No //-->
                                    <div class="flex flex-col md:w-1/5">
                                        <input type="text" name="paper_no" class="border border-1 border-gray-400 bg-gray-50
                                                                                w-full p-4 rounded-md 
                                                                                focus:outline-none
                                                                                focus:border-blue-500 
                                                                                focus:ring
                                                                                focus:ring-blue-100" placeholder="Paper No."
                                                                                
                                                                                value="{{ $paper->paper_no }}"
                                                                                
                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                required
                                                                                />  
                                                                                                                                                    
                
                                                                                @error('paper_no')
                                                                                    <span class="text-red-700 text-sm">
                                                                                        {{$message}}
                                                                                    </span>
                                                                                @enderror
                                    </div>
                                    <!-- end of Paper No. //-->

                                    <!-- Paper title //-->
                                    <div class="flex flex-col md:w-4/5">
                                        <input type="text" name="title" class="border border-1 border-gray-400 bg-gray-50
                                                                                w-full p-4 rounded-md 
                                                                                focus:outline-none
                                                                                focus:border-blue-500 
                                                                                focus:ring
                                                                                focus:ring-blue-100" placeholder="Paper Title"
                                                                                
                                                                                value="{{ $paper->title }}"
                                                                                
                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                required
                                                                                />  
                                                                                                                                                    
                
                                                                                @error('title')
                                                                                    <span class="text-red-700 text-sm">
                                                                                        {{$message}}
                                                                                    </span>
                                                                                @enderror
                                    </div>
                                    <!-- end of title //-->
                            
                        </div><!-- end of Paper //-->  
                        
                        
                        <!-- College //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                                <select name="college" class="border border-1 border-gray-400 bg-gray-50
                                                                         w-full p-4 rounded-md 
                                                                         focus:outline-none
                                                                         focus:border-blue-500 
                                                                         focus:ring
                                                                         focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                         
                                                                         style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                         required
                                                                         >
                                                                        <option value=''>-- Select College --</option>
                                                                            @foreach($colleges as $college)
                                                                                <option class='py-4' @if($college->id == $paper->college_id)  selected @endif value="{{$college->id}}">{{$college->name}} ({{$college->code}})</option>
                                                                            @endforeach                                                                    
                                                                        </select>
    
                                                                         @error('college')
                                                                            <span class="text-red-700 text-sm">
                                                                                {{$message}}
                                                                            </span>
                                                                         @enderror
                                
                        </div>
                            
                        <!-- end of College //-->


                        <!-- Department //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                                <select name="department" id='department' class="border border-1 border-gray-400 bg-gray-50
                                                                         w-full p-4 rounded-md 
                                                                         focus:outline-none
                                                                         focus:border-blue-500 
                                                                         focus:ring
                                                                         focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                         
                                                                         style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                         required
                                                                         >
                                                                        <option value=''>-- Select Department --</option>
                                                                    
                                                                        @foreach($departments as $department)
                                                                            <option class='py-4' @if($department->id == $paper->department_id)  selected @endif value="{{$department->id}}">{{$department->name}} ({{$department->code}})</option>
                                                                        @endforeach                                                                    
                                                                        
                                                                                                                                               
                                                                        </select>
    
                                                                         @error('department')
                                                                            <span class="text-red-700 text-sm">
                                                                                {{$message}}
                                                                            </span>
                                                                         @enderror
                                
                        </div>                            
                        <!-- end of Department //-->


                        <!-- Author //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                                <select name="author" id='author' class="border border-1 border-gray-400 bg-gray-50
                                                                         w-full p-4 rounded-md 
                                                                         focus:outline-none
                                                                         focus:border-blue-500 
                                                                         focus:ring
                                                                         focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                         
                                                                         style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                         required
                                                                         >
                                                                        <option value=''>-- Select Author --</option>
                                                                    
                                                                        @foreach($staff as $person)
                                                                            <option class='py-4' @if($person->user_id == $paper->author)  selected @endif value="{{$person->user_id}}">{{$person->surname}} {{ $person->firstname }} ({{$person->fileno}})</option>
                                                                        @endforeach                                                                    
                                                                        
                                                                                                                                               
                                                                        </select>
    
                                                                         @error('department')
                                                                            <span class="text-red-700 text-sm">
                                                                                {{$message}}
                                                                            </span>
                                                                         @enderror
                                
                        </div>
                            
                        <!-- end of Author //-->


                        <!-- Other Authors //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                                    <input type="text" name="other_authors" class="border border-1 border-gray-400 bg-gray-50
                                                                            w-full p-4 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100" placeholder="Other Authors"
                                                                            
                                                                            value="{{ $paper->other_authors }}"
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                            
                                                                            />  
                                                                                                                                                

                                                                            @error('other_authors')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                        
                        </div><!-- end of Other Authors //-->   


    
                       
    
                        <!-- Note //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                                    <textarea name="note" rows="10" class="border border-1 border-gray-400 bg-gray-50
                                                                            w-full p-4 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100" 
                                                                            
                                                                            value="{{ old('message') }}"
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                            
                                                                            > {{ $paper->note }} </textarea>
                                                                            <div class="text-xs text-gray-600">Max: 2,000 words</div>
                                                                                                                                                
            
                                                                            @error('note')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                            
                        </div><!-- end of note //-->


                        

                        



                         <!-- Paper File file //-->
                         <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                    
                                    
                            <input type="file" name="file" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100" 
                              
                             style="font-family:'Lato';font-size:16px;font-weight:500;"
                             accept=".jpg, .jpeg, .png, .pdf, .doc, .docx, .xls, .xlsx"
                             />
                                
    
                             @error('file')
                                <span class="text-red-700 text-sm">
                                    {{$message}}
                                </span>
                             @enderror
                            
                        </div>
                        <!-- end of file //-->     
                        @if ($paper->file!=null || $paper->file=='')
                                    <div class="flex flex-row w-text-sm w-[80%] md:w-[60%] ">
                                            <i class="fa-solid fa-paperclip"></i> 
                                            <a href="{{ asset('storage/'.$paper->file) }}" target="_blank" class="hover:underline">
                                                <span class='text-xs px-2'> {{ $paper->filetype}} ({{ $paper->filesize }})</span>
                                            </a>

                                    </div>
                        @endif
                         
                        

                        <!-- Status //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                                <select name="status" id='status' class="border border-1 border-gray-400 bg-gray-50
                                                                         w-full p-4 rounded-md 
                                                                         focus:outline-none
                                                                         focus:border-blue-500 
                                                                         focus:ring
                                                                         focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                         
                                                                         style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                         required
                                                                         >
                                                                        <option value=''>-- Select Status --</option>
                                                                    
                                                                        <option class='py-4' @if($paper->status=='pending') selected @endif value="pending">Pending</option>
                                                                        <option class='py-4' @if($paper->status=='declined') selected @endif value="declined">Declined</option>
                                                                        <option class='py-4' @if($paper->status=='approved') selected @endif value="approved">Approved</option>
                                                                                                                                          
                                                                        
                                                                                                                                               
                                                                        </select>
    
                                                                         @error('status')
                                                                            <span class="text-red-700 text-sm">
                                                                                {{$message}}
                                                                            </span>
                                                                         @enderror
                                
                        </div>
                            
                        <!-- end of Status //-->

    
                       
                        <!-- end of upload //-->
    
    
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Update Paper</button>
                        </div>
                        
                    </form><!-- end of new Announcement form //-->
                <div>
    
            

        </section>
        <!-- End of Create Announcement Section //-->



    </div>

</x-admin-layout>