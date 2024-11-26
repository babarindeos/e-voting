<x-admin-layout>

    <div class="flex flex-col border-0 w-[89%] md:w-[93%] mx-auto">
        <section class="flex flex-row justify-between border-b border-gray-200 py-2 mt-6">
                <div class="text-2xl font-semibold ">
                    Notifications         
                </div>

                <div>

                            <a href="{{ route('admin.notifications.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Notification</a>
                </div>
                
        </section>

       


        <!-- Create Notification Section  //-->
        

       
        <section id='wait-message' class="py-8 mt-2 mx-auto" style='display:none;'>
                <h3 class='text-xl'> Notifications are been sent, Please wait...</h3>
        </section>

        <section class="py-8 mt-2" id='form-notification'>
                <div>
                    <form  action="{{ route('admin.notifications.send') }} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-full md:w-[95%] items-center justify-center">
                        @csrf
    
                        
    
                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >New Notification</h2>
                            
                        </div>
    
    
                        @include('partials._session_response')
                        
                        
    
 
                        
                        
                        <!-- Meeting //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                
                                
                                <select name="meeting" class="border border-1 border-gray-400 bg-gray-50
                                                                         w-full p-4 rounded-md 
                                                                         focus:outline-none
                                                                         focus:border-blue-500 
                                                                         focus:ring
                                                                         focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                         
                                                                         style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                         required
                                                                         >
                                                                        <option value=''>-- Select Meeting --</option>
                                                                            @foreach($meetings as $meeting)
                                                                                <option class='py-4' value="{{$meeting->id}}">{{$meeting->title}} </option>
                                                                            @endforeach                                                                    
                                                                        </select>
    
                                                                         @error('meeting')
                                                                            <span class="text-red-700 text-sm">
                                                                                {{$message}}
                                                                            </span>
                                                                         @enderror
                                
                        </div>
                            
                        <!-- end of Meeting //-->


                        <!-- Subject //-->
                        <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0 border-red-900 w-[80%] md:w-[60%] py-3">
                        
                                    
                                        <!-- Subject  //-->
                                        <div class="flex flex-col w-full">
                                            <input type="text" name="subject" class="border border-1 border-gray-400 bg-gray-50
                                                                                    w-full p-4 rounded-md 
                                                                                    focus:outline-none
                                                                                    focus:border-blue-500 
                                                                                    focus:ring
                                                                                    focus:ring-blue-100" placeholder="Subject"
                                                                                    
                                                                                    value="{{ old('subject') }}"
                                                                                    
                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                    required
                                                                                    />  
                                                                                                                                                        
                    
                                                                                    @error('subject')
                                                                                        <span class="text-red-700 text-sm">
                                                                                            {{$message}}
                                                                                        </span>
                                                                                    @enderror
                                        </div>
                                        <!-- end of subject //-->
                
                        </div><!-- end of Subject //-->
    
                       
    
                        <!-- Note //-->
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-3">
                        
                            
                                    <textarea name="message" rows="15" class="border border-1 border-gray-400 bg-gray-50
                                                                            w-full p-4 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100" 
                                                                            
                                                                            value="{{ old('message') }}"
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                            required
                                                                            >  </textarea>
                                                                            <div class="text-xs text-gray-600">Note (Max: 2,000 words)</div>
                                                                                                                                                
            
                                                                            @error('message')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                            
                        </div><!-- end of note //-->


                        

                        



                         
                        

                        

    
                       
                        <!-- end of upload //-->
    
    
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button id='btn-send' type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Send Notification</button>
                        </div>
                        
                    </form><!-- end of new Digest form //-->
                <div>
    
            

        </section>
        <!-- End of Create Digest Section //-->



    </div>

</x-admin-layout>

<script>
    $('document').ready(function(){
        $("#btn-send").bind('click', function(){
            $("#form-notification").hide();
            $("#wait-message").show();
        })
    })

</script>