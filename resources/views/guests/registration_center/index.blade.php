<x-guest-layout>
<div class="flex flex-col flex-1 w-full border-0">

    <div class="flex flex-col md:flex-row h-[80%] md:h-full w-full md:w-[30%] mx-auto">
           
            


            <!-- Right  panel //-->
            <div class="flex flex-col w-full  md:w-[100%] items-center justify-center py-4 border-0">

                <section class="flex flex-col w-full border border-0">
                    <div class="flex flex-col w-full border border-0" >
                    <form  action="{{ route('guest.registration_center.login',['election_suite_uuid' => $election_suite_uuid]) }}" method="POST" class="flex flex-col mx-auto w-[90%] items-center justify-center space-y-2">
                            @csrf


                            <div class="flex flex-col w-[80%] md:w-[80%] py-4 font-serif border-0" >
                                <h2 class="font-semibold text-3xl text-center" >{{ $election_suite->name }}</h2>
                                <div class='text-2xl py-2 mb-4 text-center'>
                                    Voter Registration
                                </div>
                                <br/>
                                
                                
                            </div>
                            

                            <div class="flex flex-col w-[80%] md:w-[80%] py-4 mt-4 font-serif border-0" >
                                <h2 class="font-semibold text-2xl text-center" >Registration Center</h2>
                                <br/>
                                
                                
                            </div>

                            <!-- username //-->
                            <div class="w-[80%] py-1">

                                <input type="text" name="matric_no" class="border border-1 border-gray-400 bg-gray-50
                                                                        w-full p-4 rounded-md 
                                                                        focus:outline-none
                                                                        focus:border-blue-500 
                                                                        focus:ring
                                                                        focus:ring-blue-100" placeholder="Matric. No."
                                                                        
                                                                        value="{{ old('matric_no') }}"
                                                                        
                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                        required
                                                                        />  
                                                                                                                                            

                                                                        @error('matric_no')
                                                                            <span class="text-red-700 text-sm">
                                                                                {{$message}}
                                                                            </span>
                                                                        @enderror
                                
                            </div><!-- end of username //-->

                            <!-- password //-->
                            <div class="w-[80%] py-1">

                                <input type="password" name="password" class="border border-1 border-gray-400 bg-gray-50
                                    w-full p-4 rounded-md 
                                    focus:outline-none
                                    focus:border-blue-500 
                                    focus:ring
                                    focus:ring-blue-100" placeholder="Password"
                                    
                                    value="{{ old('password') }}"
                                    
                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                    required
                                    />  
                                                                                                        

                                    @error('password')
                                        <span class="text-red-700 text-sm">
                                            {{$message}}
                                        </span>
                                    @enderror

                            </div><!-- end of password //-->

                            <!-- submit //-->
                            <!-- submit button //-->
                            <div class="flex flex-col border-red-900 w-[80%] md:w-[80%] mt-8 py-1">
                                <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                               hover:bg-gray-500
                                               rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Login</button>
                            </div>

                            <!-- end of submit //-->

                        </form>
                    </div>
                </section>
                    
            </div>
            <!-- end of right panel //-->
    </div>


</div>
</x-guest-layout>