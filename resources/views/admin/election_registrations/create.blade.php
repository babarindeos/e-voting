<x-admin-layout>

    <div class="flex flex-col border-0 w-[89%] md:w-[93%] mx-auto">
        <section class="flex flex-row justify-between border-b border-gray-200 py-2 mt-6">
                <div class="text-2xl font-semibold ">
                    Election Registration        
                </div>

                <div>

                          <a href="{{ route('admin.election_registrations.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Election Registrations</a>
                </div>
                
        </section>

       


        <!-- Create Electoral Committee Position Section  //-->
        
       
    
        <section class="py-8 mt-2">
                <div>
                    <form  action="{{ route('admin.election_registrations.store') }} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-full md:w-[95%] items-center justify-center">
                        @csrf
    
                        
    
                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >Create Election Registration</h2>
                            
                        </div>
    
    
                        @include('partials._session_response')
                        
                        
    
                        <!-- Election Suite //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                                <select name="election_suite" class="border border-1 border-gray-400 bg-gray-50
                                                                         w-full p-4 rounded-md 
                                                                         focus:outline-none
                                                                         focus:border-blue-500 
                                                                         focus:ring
                                                                         focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                         
                                                                         style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                         required
                                                                         >
                                                                        <option value=''>-- Select Election Suite --</option>
                                                                            @foreach($election_suites as $election_suite)
                                                                                <option class='py-4' value="{{$election_suite->id}}">{{ $election_suite->name }}</option>
                                                                            @endforeach                                                                    
                                                                        </select>
    
                                                                         @error('election_suite')
                                                                            <span class="text-red-700 text-sm">
                                                                                {{$message}}
                                                                            </span>
                                                                         @enderror
                                
                        </div>
                            
                        <!-- end of Election Suite //-->
                        
    
                       
                        
                       
                        
                        <!-- Start Date and Time //-->
                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">
                                
                                        <!-- Date //-->
                                    <div class="flex flex-col md:w-3/5">
                                                <input type="date" name="start_date" class="border border-1 border-gray-400 bg-gray-50
                                                                                        w-full p-4 rounded-md 
                                                                                        focus:outline-none
                                                                                        focus:border-blue-500 
                                                                                        focus:ring
                                                                                        focus:ring-blue-100" placeholder="Start Date"
                                                                                        
                                                                                        value="{{ old('start_date') }}"
                                                                                        
                                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                        required
                                                                                        />  
                                                                                        <div>                                                                              
                                                                                                <div class="text-sm">
                                                                                                        Start Date
                                                                                                </div>
                                                                                                <div>                                                                                                
                                                                                                        @error('start_date')
                                                                                                            <span class="text-red-700 text-sm">
                                                                                                                {{$message}}
                                                                                                            </span>
                                                                                                        @enderror
                                                                                                </div>
                                                                                        </div>
                                    </div>
                                    <!-- Start Date //-->

                                    <!-- Time //-->
                                    <div class="flex flex-col md:w-2/5">
                                                <input type="time" name="start_time" class="border border-1 border-gray-400 bg-gray-50
                                                                                        w-full p-4 rounded-md 
                                                                                        focus:outline-none
                                                                                        focus:border-blue-500 
                                                                                        focus:ring
                                                                                        focus:ring-blue-100" placeholder="Start time"
                                                                                        
                                                                                        value="{{ old('start_time') }}"
                                                                                        
                                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                        required
                                                                                        /> 
                                                                                        <div>                                                                              
                                                                                                <div class="text-sm">
                                                                                                        Start Time
                                                                                                </div>
                                                                                                <div>                                                                                                
                                                                                                        @error('start_time')
                                                                                                            <span class="text-red-700 text-sm">
                                                                                                                {{$message}}
                                                                                                            </span>
                                                                                                        @enderror
                                                                                                </div>
                                                                                        </div>                                                                                                                                                    
                        

                                    </div>
                                    <!-- end of Time //-->
                            
                                        
                        </div><!-- end of Start Date and Time //-->
                        
                        



                        
                        <!-- End Date and Time //-->
                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 border-red-900 w-[80%] md:w-[60%] py-3">
                                
                                        <!-- Date //-->
                                    <div class="flex flex-col md:w-3/5">
                                                <input type="date" name="end_date" class="border border-1 border-gray-400 bg-gray-50
                                                                                        w-full p-4 rounded-md 
                                                                                        focus:outline-none
                                                                                        focus:border-blue-500 
                                                                                        focus:ring
                                                                                        focus:ring-blue-100" placeholder="End Date"
                                                                                        
                                                                                        value="{{ old('end_date') }}"
                                                                                        
                                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                        required
                                                                                        />  
                                                                                        <div>                                                                              
                                                                                                <div class="text-sm">
                                                                                                        End Date
                                                                                                </div>
                                                                                                <div>                                                                                                
                                                                                                        @error('end_date')
                                                                                                            <span class="text-red-700 text-sm">
                                                                                                                {{$message}}
                                                                                                            </span>
                                                                                                        @enderror
                                                                                                </div>
                                                                                        </div>
                                    </div>
                                    <!-- Start Date //-->

                                    <!-- Time //-->
                                    <div class="flex flex-col md:w-2/5">
                                                <input type="time" name="end_time" class="border border-1 border-gray-400 bg-gray-50
                                                                                        w-full p-4 rounded-md 
                                                                                        focus:outline-none
                                                                                        focus:border-blue-500 
                                                                                        focus:ring
                                                                                        focus:ring-blue-100" placeholder="End time"
                                                                                        
                                                                                        value="{{ old('end_time') }}"
                                                                                        
                                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                        required
                                                                                        /> 
                                                                                        <div>                                                                              
                                                                                                <div class="text-sm">
                                                                                                        End Time
                                                                                                </div>
                                                                                                <div>                                                                                                
                                                                                                        @error('end_time')
                                                                                                            <span class="text-red-700 text-sm">
                                                                                                                {{$message}}
                                                                                                            </span>
                                                                                                        @enderror
                                                                                                </div>
                                                                                        </div>                                                                                                                                                    
                        

                                    </div>
                                    <!-- end of Time //-->
                            
                                        
                        </div><!-- end of End Date and Time //--> 






                        <!-- Live Status//-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                                    <div class='flex flex-row space-x-2'>
                            
                                                <input type="checkbox" name="live_status" class="border border-1 border-gray-400 bg-gray-50
                                                                            p-4 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100" placeholder="live"
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                            
                                                                           
                                                                            />  
                                                <div>
                                                            Live Status
                                                </div>
                                    </div>
                                    
                                                                                                                                    

                                                                @error('live_status')
                                                                    <span class="text-red-700 text-sm">
                                                                        {{$message}}
                                                                    </span>
                                                                @enderror
                        
                        </div><!-- end of Live Status //--> 









                       


                        


                         
    
                        
                        
                       
    
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Create Election Registration</button>
                        </div>
                        
                    </form><!-- end of new Election Registration form //-->
                <div>
    
            

        </section>
        <!-- End of Create Election Registration Section //-->



    </div>

</x-admin-layout>