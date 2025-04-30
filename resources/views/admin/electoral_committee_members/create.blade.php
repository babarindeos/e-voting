<x-admin-layout>

    <div class="flex flex-col border-0 w-[89%] md:w-[93%] mx-auto">
        <section class="flex flex-row justify-between border-b border-gray-200 py-2 mt-6">
                <div class="text-2xl font-semibold ">
                    Electoral Committee Members         
                </div>

                <div>

                            <a href="{{ route('admin.electoral_committees.index') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"> Electoral Committees</a>


                            <a href="{{ route('admin.electoral_committees.positions.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Electoral Committee Positions</a>
                </div>
                
        </section>

       


         <!-- Electoral Committee  Section  //-->
         <section class="flex flex-col w-[98%] md:w-[100%] md:flex-row mx-auto py-4 mt-2 border-0 justify-between">   
                <div class='font-normal text-lg'>{{ $electoral_committee->name }}</div>
                <div>
                        <a href="{{ route('admin.electoral_committees.show',['electoral_committee'=>$electoral_committee->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                    rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Members</a>
                </div>

        </section>

        <!-- Create Announcement Section  //-->
        
       
    
        <section class="py-8 mt-2">
                <div>
                    <form  action="{{ route('admin.electoral_committees.members.store',['electoral_committee' => $electoral_committee->id]) }} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-full md:w-[95%] items-center justify-center">
                        @csrf
    
                        
    
                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >Create Electoral Committee Member</h2>
                            
                        </div>
    
    
                        @include('partials._session_response')
                        
                        


                        <!-- Position //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
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
                                                                                <option class='py-4' value="{{$position->id}}">{{$position->position}}</option>
                                                                            @endforeach                                                                    
                                                                        </select>
    
                                                                         @error('position')
                                                                            <span class="text-red-700 text-sm">
                                                                                {{$message}}
                                                                            </span>
                                                                         @enderror
                                
                        </div>
                            
                        <!-- end of Position //-->
                        
    
                       
                        
                        
                        <!-- Names //-->
                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            <!-- Surname //-->
                            <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                                            
                                                
                                            <input type="text" name="surname" class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100" placeholder="Surname"
                                                                                    
                                                                                    value="{{ old('surname') }}"
                                                                                    
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
                            <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                                            
                                                
                                            <input type="text" name="firstname" class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100" placeholder="Firstname"
                                                                                    
                                                                                    value="{{ old('firstname') }}"
                                                                                    
                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                    required
                                                                                    />  
                                                                                                                                                        

                                                                                    @error('firstname')
                                                                                        <span class="text-red-700 text-sm">
                                                                                            {{$message}}
                                                                                        </span>
                                                                                    @enderror
                                            
                            </div><!-- end of Firstname  //--> 


                            <!-- Othernames //-->
                            <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                                            
                                                
                                            <input type="text" name="othernames" class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100" placeholder="Othernames"
                                                                                    
                                                                                    value="{{ old('othernames') }}"
                                                                                    
                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                    
                                                                                    />  
                                                                                                                                                        

                                                                                    @error('othernames')
                                                                                        <span class="text-red-700 text-sm">
                                                                                            {{$message}}
                                                                                        </span>
                                                                                    @enderror
                                            
                            </div><!-- end of Othernames  //--> 

                                        
                        </div><!-- end of Names //--> 



                        
                        <!-- Colleges, Department, Level//-->
                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">
                        
                                <!-- College //-->
                                <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
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
                                                                                            <option class='py-4' value="{{$college->id}}">{{$college->name}}</option>
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
                                <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
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
                                                                                            <option class='py-4' value="{{$department->id}}">{{$department->name}}</option>
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
                                <div class="flex flex-col border-red-900 w-[80%] md:w-[30%] py-2">
                                
                                
                                            <select name="level" class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                                    
                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                    
                                                                                    >
                                                                                    <option value=''>-- Select Level --</option>
                                                                                       
                                                                                            <option class='py-4' value="100L">100L</option>
                                                                                            <option class='py-4' value="200L">200L</option>
                                                                                            <option class='py-4' value="300L">300L</option>
                                                                                            <option class='py-4' value="400L">400L</option>
                                                                                            <option class='py-4' value="500L">500L</option>
                                                                                            <option class='py-4' value="600L">600L</option>
                                                                                            <option class='py-4' value="700L">700L</option>                                                                                            
                                                                                                                                                           
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
                                                                    
                                                                    value="{{ old('slogan') }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    
                                                                    />  
                                                                                                                                        
    
                                                                    @error('slogan')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of Slogan //--> 
    
                       
    
                        <!-- Bio //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                            <textarea name="bio" rows="10" class="border border-1 border-gray-400 bg-gray-50
                                                                    w-full p-4 rounded-md 
                                                                    focus:outline-none
                                                                    focus:border-blue-500 
                                                                    focus:ring
                                                                    focus:ring-blue-100" 
                                                                    
                                                                    value="{{ old('bio') }}"
                                                                    
                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                    
                                                                    ></textarea>
                                                                    <div class="text-xs text-gray-600">Max: 2,000 words</div>
                                                                                                                                        
    
                                                                    @error('bio')
                                                                        <span class="text-red-700 text-sm">
                                                                            {{$message}}
                                                                        </span>
                                                                    @enderror
                            
                        </div><!-- end of Bio //-->


                        

                       
                         <!-- Photo file //-->
                         <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                    
                                    
                            <input type="file" name="photo" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100" 
                              
                             style="font-family:'Lato';font-size:16px;font-weight:500;"
                             accept=".jpg, .jpeg, .png, .pdf, .doc, .docx, .xls, .xlsx"
                             />
                                
    
                             @error('photo')
                                <span class="text-red-700 text-sm">
                                    {{$message}}
                                </span>
                             @enderror
                            
                        </div>
                        <!-- end of Photo file //-->                   
    
                       
                        <!-- end of upload //-->
    
    
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Create Member</button>
                        </div>
                        
                    </form><!-- end of new Member form //-->
                <div>
    
            

        </section>
        <!-- End of Create Member Section //-->



    </div>

</x-admin-layout>