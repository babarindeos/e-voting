<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-red-900 mx-auto border-0">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Candidate</h1>
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

        


        <!-- Candidate  Section  //-->
        <section class="flex flex-col w-[98%] md:w-[98%] md:flex-row mx-auto py-0 mt-0 border-0 justify-between">   
                <div class='font-normal text-lg'>{{ $candidate->election->name }}</div>
                <div>
                        <div class='flex flex-col md:flex-row space-y-1 md:space-y-0 md:space-x-1'>
                                <a href="{{ route('admin.elections.show',['election'=>$candidate->election->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">&laquo; Back</a>

                                <a href="" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Results</a>

                                <a href="" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Analytics</a>
                        </div>
                </div>

        </section>
        

        
        <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 border-0">
                   
                <div class='flex flex-col md:flex-row w-full border-0'>
                    <div class="w-full md:w-[30%] border-0">
                                <div>
                                        @if ($candidate->photo==null)
                                            <img src="{{ asset('images/avatar_150.jpg')}}" class="w-64 h-64"  />
                                        @else
                                            <img src="{{ asset('storage/'.$candidate->photo) }}" class="w-82 h-82 rounded-lg" />
                                        @endif
                                </div>
                                <div class='text-center mt-2 text-2xl'>
                                    {{ $candidate->surname }} {{ $candidate->firstname }} {{ $candidate->othernames }}
                                </div>
                                <div class='text-center '>
                                    {{ $candidate->matric_no }} 
                                </div>
                                
                    </div>
                    <div class='w-full md:w-[70%] px-2'> 
                            <!-- Candidate Data //-->


                             <!-- Position //-->
                             <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-3">
                                                        
                                                            
                                                        <div name="surname" class="border border-1 border-gray-400 bg-gray-50
                                                                                                w-full p-4 rounded-md 
                                                                                                focus:outline-none
                                                                                                focus:border-blue-500 
                                                                                                focus:ring
                                                                                                focus:ring-blue-100"                                                                                            
                                                                                                
                                                                                                
                                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                
                                                                                                > {{ $candidate->position->name }} </div> 
                                                                                                                                                                    

                                                                                              
                                                        
                            </div><!-- end of Position  //--> 


                            <!-- Names //-->
                            <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">
                                        
                                        <!-- Surname //-->
                                        <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-3">
                                                        
                                                            
                                                        <div class="border border-1 border-gray-400 bg-gray-50
                                                                                                w-full p-4 rounded-md 
                                                                                                focus:outline-none
                                                                                                focus:border-blue-500 
                                                                                                focus:ring
                                                                                                focus:ring-blue-100"                        
                                                                                                
                                                                                                
                                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                
                                                                                                /> {{ $candidate->surname }} </div>                                                                          
                                                        
                                        </div><!-- end of Surname  //--> 


                                        <!-- Firstname //-->
                                        <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-3">
                                                        
                                                            
                                                        <div class="border border-1 border-gray-400 bg-gray-50
                                                                                                w-full p-4 rounded-md 
                                                                                                focus:outline-none
                                                                                                focus:border-blue-500 
                                                                                                focus:ring
                                                                                                focus:ring-blue-100"                                                                          
                                                                                                
                                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                
                                                                                                />  {{ $candidate->firstname }} </div>                                                                                                                                                               

                                                                                               
                                                        
                                        </div><!-- end of Firstname  //--> 

                                        
                                    </div><!-- end of Names //--> 




                                    <!-- Othernames and alias  //-->
                                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">
                                    


                                                  <!-- Othernames //-->
                                                  <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-3">
                                                                    
                                                                        
                                                                    <div class="border border-1 border-gray-400 bg-gray-50
                                                                                                            w-full p-4 rounded-md 
                                                                                                            focus:outline-none
                                                                                                            focus:border-blue-500 
                                                                                                            focus:ring
                                                                                                            focus:ring-blue-100"
                                                                                                            
                                                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                            
                                                                                                            />  {{ $candidate->othernames }} </div>
                                                                                                                                                                                

                                                                                                           
                                                                    
                                                  </div><!-- end of Othernames  //--> 


                                                  <!-- Alias //-->
                                                  <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-3">
                                                                
                                                                    
                                                                <div  class="border border-1 border-gray-400 bg-gray-50
                                                                                                        w-full p-4 rounded-md 
                                                                                                        focus:outline-none
                                                                                                        focus:border-blue-500 
                                                                                                        focus:ring
                                                                                                        focus:ring-blue-100" 

                                                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;" 
                                                                                                                                                                                               
                                                                                                        >  {{ $candidate->alias }}  </div>                                                                                                   
                                                                
                                                 </div><!-- end of Alias  //--> 


                                                
                                    </div><!-- end of othernames and alias //--> 





                                    
                                    <!-- Colleges, Department, Level//-->
                                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">
                                    
                                            <!-- College //-->
                                            <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-2">
                                            
                                            
                                                        <div  class="border border-1 border-gray-400 bg-gray-50
                                                                                                w-full p-4 rounded-md 
                                                                                                focus:outline-none
                                                                                                focus:border-blue-500 
                                                                                                focus:ring
                                                                                                focus:ring-blue-100"                                      
                                                                                                                                                                                           

                                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                                
                                                                                                > {{ $candidate->college->code }}</div>
                                                                                               
                            
                                                                                               
                                            
                                            </div>
                                        
                                            <!-- end of College //-->


                                            
                                            <!-- Departments //-->
                                            <div class="flex flex-col border-red-900 w-[100%] md:w-[60%] py-2">
                                            
                                            
                                                        <div class="border border-1 border-gray-400 bg-gray-50
                                                                                                w-full p-4 rounded-md 
                                                                                                focus:outline-none
                                                                                                focus:border-blue-500 
                                                                                                focus:ring
                                                                                                focus:ring-blue-100"                                                                                     
                                                                                                
                                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                                                
                                                                                                >{{ $candidate->department->code }}</div>
                                                                                                
                                            
                                            </div>
                                        
                                            <!-- end of Departments //-->


                                            
                                            <!-- Level //-->
                                            <div class="flex flex-col border-red-900 w-[100%] md:w-[30%] py-2">
                                            
                                            
                                                        <div class="border border-1 border-gray-400 bg-gray-50
                                                                                                w-full p-4 rounded-md 
                                                                                                focus:outline-none
                                                                                                focus:border-blue-500 
                                                                                                focus:ring
                                                                                                focus:ring-blue-100"                                                                                         
                                                                                                
                                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                                
                                                                                                >{{ $candidate->level }}</div>
                                                                                                
                            
                                            
                                            </div>
                                        
                                            <!-- end of Level //-->
                                                    
                                    </div><!-- end of Colleges, Departments, Levels //--> 


                                    <!-- Slogan //-->
                                    <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                                    
                                        
                                        <div class="border border-1 border-gray-400 bg-gray-50
                                                                                w-full p-4 rounded-md 
                                                                                focus:outline-none
                                                                                focus:border-blue-500 
                                                                                focus:ring
                                                                                focus:ring-blue-100" placeholder="Slogan"                                                                              
                                                                               
                                                                                
                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                
                                                                                >{{ $candidate->slogan }} </div> 
                                                                                                                                                    
                
                                                                               
                                        
                                    </div><!-- end of Slogan //--> 


                                   
                                    @if ($candidate->banner != null)

                                        <!-- Banner file //-->
                                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                                    
                                            <div class='px-1 py-1'>Banner</div>
                                            <div class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100" 
                                            
                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                            accept=".jpg, .jpeg, .png"
                                            />
                                                <a target='_blank' class='underline' href="{{ asset('storage/'.$candidate->banner) }}">Click to view banner</a>
                                            
                                            </div>            
                    
                                            
                                        </div>
                                        <!-- end of Banner file //--> 

                                    @endif
                                     
                                    
                                    @if ($candidate->manifesto != null)
                                            <!-- Manifesto file //-->
                                            <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                                        
                                                <div class='px-1 py-1'>Manifesto</div>
                                                <div  class="border border-1 border-gray-400 bg-gray-50
                                                                                        w-full p-4 rounded-md 
                                                                                        focus:outline-none
                                                                                        focus:border-blue-500 
                                                                                        focus:ring
                                                                                        focus:ring-blue-100" 
                                                
                                                style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                accept=".pdf"
                                                />  
                                                    <a target='_blank' class='underline' href="{{ asset('storage/'.$candidate->manifesto) }}">Click to view candidate's manifesto</a>
                                            </div>                 
                        
                                                
                                                
                                            </div>
                                            <!-- end of Manifesto file //--> 
                                    @endif
                
                
                                
                
                                    <!-- Bio //-->
                                    <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                                    
                                        <div class='px-1 py-1'>Bio</div>
                                        <div class="border border-1 border-gray-400 bg-gray-50
                                                                                w-full p-4 rounded-md 
                                                                                focus:outline-none
                                                                                focus:border-blue-500 
                                                                                focus:ring
                                                                                focus:ring-blue-100" 
                                                                                
                                                                                value="{{ old('bio') }}"
                                                                                
                                                                                style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                
                                                                                >  {{ $candidate->bio }}</div>
                                                                                <div class="text-xs text-gray-600">Max: 2,000 words</div>
                                                                                                                                                    
                
                                                                                
                                        
                                    </div><!-- end of Bio //-->


                                    






                            <!-- end of Candidate data //-->

                    </div>     
                </div>         
       


        </section>
       
        <!-- end of Candidate Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>