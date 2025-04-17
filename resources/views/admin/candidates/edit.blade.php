<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-red-900 mx-auto border-0">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Election</h1>
                    </div>
                    <div>

                            <a href="{{ route('admin.elections.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Election</a>


                            <a href="{{ route('admin.elections.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Elections</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Elections  Section  //-->
        <section class="flex flex-col w-[98%] md:w-[98%] md:flex-row mx-auto py-0 mt-0 border-0 justify-between">   
                <div class='font-normal text-lg'>{{ $candidate->election->name }}</div>
                <div>
                        <div class='flex flex-col md:flex-row space-y-1 md:space-y-0 md:space-x-1'>
                                <a href="{{ route('admin.elections.show',['election'=>$candidate->election->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Candidates</a>

                                <a href="{{ route('admin.elections.candidates.create',['election'=>$candidate->election->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Results</a>

                                <a href="{{ route('admin.elections.candidates.create',['election'=>$candidate->election->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Analytics</a>
                        </div>
                </div>

        </section>
        

        
        <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 border-0">
                    <form  action="{{ route('admin.elections.candidates.update',['candidate' => $candidate->id]) }} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-full md:w-[95%] items-center justify-center">
                                        @csrf
                    
                                        
                    
                                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                                            <h2 class="font-semibold text-xl py-1" >Edit Candidate</h2>
                                            
                                        </div>
                    
                    
                                        @include('partials._session_response')
                                        
                                        
                                         <!-- Position and matric no //-->
                                         <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">

                                                            <!-- Position //-->
                                                            <div class="flex flex-col border-red-900 w-[100%] md:w-[70%] py-2">
                                                                    
                                                                    
                                                                    <select name="position" class="border border-1 border-gray-400 bg-gray-50
                                                                                                            w-full p-4 rounded-md 
                                                                                                            focus:outline-none
                                                                                                            focus:border-blue-500 
                                                                                                            focus:ring
                                                                                                            focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                                                            
                                                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                                            required
                                                                                                            >
                                                                                                            <option value=''>-- Select Position --</option>
                                                                                                                @foreach($positions as $position)
                                                                                                                    <option class='py-4' value="{{$position->id}}" @if($position->id == $candidate->position_id) selected @endif>{{$position->name}}</option>
                                                                                                                @endforeach                                                                    
                                                                                                            </select>
                                        
                                                                                                            @error('position')
                                                                                                                <span class="text-red-700 text-sm">
                                                                                                                    {{$message}}
                                                                                                                </span>
                                                                                                            @enderror
                                                                    
                                                            </div>                                                                
                                                            <!-- end of Position //-->



                                                            <!-- Matric No. //-->
                                                            <div class="flex flex-col border-red-900 w-[100%] md:w-[30%] py-2">
                                                                            
                                                                                
                                                                            <input type="text" name="matric_no" class="border border-1 border-gray-400 bg-gray-50
                                                                                                                    w-full p-4 rounded-md 
                                                                                                                    focus:outline-none
                                                                                                                    focus:border-blue-500 
                                                                                                                    focus:ring
                                                                                                                    focus:ring-blue-100" placeholder="Matric. No."
                                                                                                                    
                                                                                                                    value="{{ $candidate->matric_no }}"
                                                                                                                    
                                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                                    required
                                                                                                                    />  
                                                                                                                                                                                        

                                                                                                                    @error('matric_no')
                                                                                                                        <span class="text-red-700 text-sm">
                                                                                                                            {{$message}}
                                                                                                                        </span>
                                                                                                                    @enderror
                                                                            
                                                            </div><!-- end of Matric. No.  //--> 
                                        </div>
                                        
                    
                                    
                                        
                                        
                                        <!-- Names //-->
                                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">
                                        
                                            <!-- Surname //-->
                                            <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-3">
                                                            
                                                                
                                                            <input type="text" name="surname" class="border border-1 border-gray-400 bg-gray-50
                                                                                                    w-full p-4 rounded-md 
                                                                                                    focus:outline-none
                                                                                                    focus:border-blue-500 
                                                                                                    focus:ring
                                                                                                    focus:ring-blue-100" placeholder="Surname"
                                                                                                    
                                                                                                    value="{{ $candidate->surname }}"
                                                                                                    
                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                    required
                                                                                                    />  
                                                                                                                                                                        

                                                                                                    @error('surname')
                                                                                                        <span class="text-red-700 text-sm">
                                                                                                            {{$message}}
                                                                                                        </span>
                                                                                                    @enderror
                                                            
                                            </div><!-- end of Surname  //--> 


                                            <!-- Firstname //-->
                                            <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-3">
                                                            
                                                                
                                                            <input type="text" name="firstname" class="border border-1 border-gray-400 bg-gray-50
                                                                                                    w-full p-4 rounded-md 
                                                                                                    focus:outline-none
                                                                                                    focus:border-blue-500 
                                                                                                    focus:ring
                                                                                                    focus:ring-blue-100" placeholder="Firstname"
                                                                                                    
                                                                                                    value="{{ $candidate->firstname }}"
                                                                                                    
                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                    required
                                                                                                    />  
                                                                                                                                                                        

                                                                                                    @error('firstname')
                                                                                                        <span class="text-red-700 text-sm">
                                                                                                            {{$message}}
                                                                                                        </span>
                                                                                                    @enderror
                                                            
                                            </div><!-- end of Firstname  //--> 

                                            
                                        </div><!-- end of Names //--> 




                                        <!-- Othernames and alias  //-->
                                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">
                                        


                                                      <!-- Othernames //-->
                                                      <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-3">
                                                                        
                                                                            
                                                                        <input type="text" name="othernames" class="border border-1 border-gray-400 bg-gray-50
                                                                                                                w-full p-4 rounded-md 
                                                                                                                focus:outline-none
                                                                                                                focus:border-blue-500 
                                                                                                                focus:ring
                                                                                                                focus:ring-blue-100" placeholder="Othernames"
                                                                                                                
                                                                                                                value="{{ $candidate->othernames }}"
                                                                                                                
                                                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                                
                                                                                                                />  
                                                                                                                                                                                    

                                                                                                                @error('othernames')
                                                                                                                    <span class="text-red-700 text-sm">
                                                                                                                        {{$message}}
                                                                                                                    </span>
                                                                                                                @enderror
                                                                        
                                                      </div><!-- end of Othernames  //--> 


                                                      <!-- Alias //-->
                                                      <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-3">
                                                                    
                                                                        
                                                                    <input type="text" name="alias" class="border border-1 border-gray-400 bg-gray-50
                                                                                                            w-full p-4 rounded-md 
                                                                                                            focus:outline-none
                                                                                                            focus:border-blue-500 
                                                                                                            focus:ring
                                                                                                            focus:ring-blue-100" placeholder="Alias"
                                                                                                            
                                                                                                            value="{{ $candidate->alias }}"
                                                                                                            
                                                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;" 
                                                                                                            
                                                                                                            required
                                                                                                            
                                                                                                            />  
                                                                                                                                                                                

                                                                                                            @error('alias')
                                                                                                                <span class="text-red-700 text-sm">
                                                                                                                    {{$message}}
                                                                                                                </span>
                                                                                                            @enderror
                                                                    
                                                    </div><!-- end of Alias  //--> 


                                                    
                                        </div><!-- end of othernames and alias //--> 





                                        
                                        <!-- Colleges, Department, Level//-->
                                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">
                                        
                                                <!-- College //-->
                                                <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-2">
                                                
                                                
                                                            <select name="college" class="border border-1 border-gray-400 bg-gray-50
                                                                                                    w-full p-4 rounded-md 
                                                                                                    focus:outline-none
                                                                                                    focus:border-blue-500 
                                                                                                    focus:ring
                                                                                                    focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                                                    
                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                                    
                                                                                                    >
                                                                                                    <option value=''>-- Select College --</option>
                                                                                                        @foreach($colleges as $college)
                                                                                                            <option class='py-4' value="{{$college->id}}" @if($college->id == $candidate->college_id) selected @endif>{{$college->name}}</option>
                                                                                                        @endforeach                                                                    
                                                                                                    </select>
                                
                                                                                                    @error('college')
                                                                                                        <span class="text-red-700 text-sm">
                                                                                                            {{$message}}
                                                                                                        </span>
                                                                                                    @enderror
                                                
                                                </div>
                                            
                                                <!-- end of College //-->


                                                
                                                <!-- Departments //-->
                                                <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-2">
                                                
                                                
                                                            <select name="department" class="border border-1 border-gray-400 bg-gray-50
                                                                                                    w-full p-4 rounded-md 
                                                                                                    focus:outline-none
                                                                                                    focus:border-blue-500 
                                                                                                    focus:ring
                                                                                                    focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                                                    
                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                                    
                                                                                                    >
                                                                                                    <option value=''>-- Select Department --</option>
                                                                                                        @foreach($departments as $department)
                                                                                                            <option class='py-4' value="{{$department->id}}" @if ($department->id == $candidate->department_id) selected @endif>{{$department->name}}</option>
                                                                                                        @endforeach                                                                    
                                                                                                    </select>
                                
                                                                                                    @error('department')
                                                                                                        <span class="text-red-700 text-sm">
                                                                                                            {{$message}}
                                                                                                        </span>
                                                                                                    @enderror
                                                
                                                </div>
                                            
                                                <!-- end of Departments //-->


                                                
                                                <!-- Level //-->
                                                <div class="flex flex-col border-red-900 w-[100%] md:w-[30%] py-2">
                                                
                                                
                                                            <select name="level" class="border border-1 border-gray-400 bg-gray-50
                                                                                                    w-full p-4 rounded-md 
                                                                                                    focus:outline-none
                                                                                                    focus:border-blue-500 
                                                                                                    focus:ring
                                                                                                    focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                                                    
                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                                    
                                                                                                    >
                                                                                                    <option value=''>-- Select Level --</option>
                                                                                                    
                                                                                                            <option class='py-4' value="100L" @if ($candidate->level == '100L') selected @endif>100L</option>
                                                                                                            <option class='py-4' value="200L" @if ($candidate->level == '200L') selected @endif>200L</option>
                                                                                                            <option class='py-4' value="300L" @if ($candidate->level == '300L') selected @endif>300L</option>
                                                                                                            <option class='py-4' value="400L" @if ($candidate->level == '400L') selected @endif>400L</option>
                                                                                                            <option class='py-4' value="500L" @if ($candidate->level == '500L') selected @endif >500L</option>
                                                                                                            <option class='py-4' value="600L" @if ($candidate->level == '600L') selected @endif>600L</option>
                                                                                                            <option class='py-4' value="700L" @if ($candidate->level == '700L') selected @endif>700L</option>                                                                                            
                                                                                                                                                                        
                                                                                                    </select>
                                
                                                                                                    @error('level')
                                                                                                        <span class="text-red-700 text-sm">
                                                                                                            {{$message}}
                                                                                                        </span>
                                                                                                    @enderror
                                                
                                                </div>
                                            
                                                <!-- end of Level //-->
                                                        
                                        </div><!-- end of Colleges, Departments, Levels //--> 


                                        <!-- Slogan //-->
                                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                                        
                                            
                                            <input type="text" name="slogan" class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100" placeholder="Slogan"
                                                                                    
                                                                                    value="{{ $candidate->slogan }}"
                                                                                    
                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                    
                                                                                    />  
                                                                                                                                                        
                    
                                                                                    @error('slogan')
                                                                                        <span class="text-red-700 text-sm">
                                                                                            {{$message}}
                                                                                        </span>
                                                                                    @enderror
                                            
                                        </div><!-- end of Slogan //--> 


                                        <!-- Photo file //-->
                                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                                    
                                            <div class='px-1 py-1'>Photo</div>
                                            <input type="file" name="photo" class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100" 
                                            
                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                            accept=".jpg, .jpeg, .png"
                                            />
                                            @if ($candidate->photo != null)
                                                <div class='text-sm'> 
                                                    <a target='_blank' class='underline' href="{{ asset('storage/'.$candidate->photo) }}">
                                                        Uploaded photo - {{ $candidate->photo }}
                                                    </a>

                                                </div>
                                            @endif
                                                
                    
                                            @error('photo')
                                                <span class="text-red-700 text-sm">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                            
                                        </div>
                                        <!-- end of Photo file //-->      



                                        <!-- Banner file //-->
                                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                                    
                                            <div class='px-1 py-1'>Banner</div>
                                            <input type="file" name="banner" class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100" 
                                            
                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                            accept=".jpg, .jpeg, .png"
                                            />
                                            @if ($candidate->banner != null)
                                                <div class='text-sm'> 
                                                    <a target='_blank' class='underline' href="{{ asset('storage/'.$candidate->banner) }}">
                                                        Uploaded banner - {{ $candidate->banner }}
                                                    </a>

                                                </div>
                                            @endif
                                                
                    
                                            @error('banner')
                                                <span class="text-red-700 text-sm">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                            
                                        </div>
                                        <!-- end of Banner file //--> 
                                         
                                        

                                        <!-- Manifesto file //-->
                                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                                    
                                            <div class='px-1 py-1'>Manifesto</div>
                                            <input type="file" name="manifesto" class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100" 
                                            
                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                            accept=".pdf"
                                            />
                                            @if ($candidate->manifesto != null)
                                                <div class='text-sm'> 
                                                    <a target='_blank' class='underline' href="{{ asset('storage/'.$candidate->manifesto) }}">
                                                        Uploaded manifesto - {{ $candidate->manifesto }}
                                                    </a>

                                                </div>
                                            @endif
                                                
                    
                                            @error('manifesto')
                                                <span class="text-red-700 text-sm">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                            
                                        </div>
                                        <!-- end of Manifesto file //--> 
                    
                    
                                    
                    
                                        <!-- Bio //-->
                                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                                        
                                            <div class='px-1 py-1'>Bio</div>
                                            <textarea name="bio" rows="10" class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100" 
                                                                                    
                                                                                    value="{{ old('bio') }}"
                                                                                    
                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                    
                                                                                    >{{ $candidate->bio }}</textarea>
                                                                                    <div class="text-xs text-gray-600">Max: 2,000 words</div>
                                                                                                                                                        
                    
                                                                                    @error('bio')
                                                                                        <span class="text-red-700 text-sm">
                                                                                            {{$message}}
                                                                                        </span>
                                                                                    @enderror
                                            
                                        </div><!-- end of Bio //-->


                                        

                                    
                                                     
                    
                                    
                                        <!-- end of upload //-->
                    
                    
                                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                                        hover:bg-gray-500
                                                        rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Update Candidate</button>
                                        </div>
                                        
                    </form><!-- end of new Mmeber form //-->

                

        </section>
       
        <!-- end of Election //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>