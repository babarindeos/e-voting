<x-admin-layout>

    <div class="flex flex-col border-0 w-[89%] md:w-[93%] mx-auto">
        <section class="flex flex-row justify-between border-b border-gray-200 py-2 mt-6">
                <div class="text-2xl font-semibold ">
                    Digests             
                </div>

                <div>

                            <a href="{{ route('admin.digests.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Digest</a>
                </div>
                
        </section>

       


        <!-- Create Paper Section  //-->
        
       
    
        <section class="py-8 mt-2">
                <div>
                    <form  action="{{ route('admin.digests.store') }} " method="POST" enctype="multipart/form-data" class="flex flex-col mx-auto w-full md:w-[95%] items-center justify-center">
                        @csrf
    
                        
    
                        <div class="flex flex-col w-[80%] md:w-[60%] py-2 md:py-4" style="font-family:'Lato'; font-size:18px; font-weight:400;">
                            <h2 class="font-semibold text-xl py-1" >New Digest</h2>
                            
                        </div>
    
    
                        @include('partials._session_response')
                        
                        
    
                        <!-- Digest  //-->
                        <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0 border-red-900 w-[80%] md:w-[60%] py-3">
                        
                                    
                                    <!-- Digest title //-->
                                    <div class="flex flex-col w-full">
                                        <input type="text" name="title" class="border border-1 border-gray-400 bg-gray-50
                                                                                w-full p-4 rounded-md 
                                                                                focus:outline-none
                                                                                focus:border-blue-500 
                                                                                focus:ring
                                                                                focus:ring-blue-100" placeholder="Digest Title"
                                                                                
                                                                                value="{{ old('title') }}"
                                                                                
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
                            
                        </div><!-- end of Digest //-->  
                        
                        
                        

    
                       
    
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
                                                                            
                                                                            >  </textarea>
                                                                            <div class="text-xs text-gray-600">Note (Max: 2,000 words)</div>
                                                                                                                                                
            
                                                                            @error('note')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                            
                        </div><!-- end of note //-->


                        

                        



                         <!-- Digest File file //-->
                         <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-2">
                                    
                                    
                            <input type="file" name="file" class="border border-1 border-gray-400 bg-gray-50
                                                                     w-full p-4 rounded-md 
                                                                     focus:outline-none
                                                                     focus:border-blue-500 
                                                                     focus:ring
                                                                     focus:ring-blue-100" 
                              
                             style="font-family:'Lato';font-size:16px;font-weight:500;"
                             accept=".jpg, .jpeg, .png, .pdf, .doc, .docx, .xls, .xlsx"

                             required
                             />
                                
    
                             @error('file')
                                <span class="text-red-700 text-sm">
                                    {{$message}}
                                </span>
                             @enderror
                            
                        </div>
                        <!-- end of file //-->     
                         
                        

                        

    
                       
                        <!-- end of upload //-->
    
    
                        <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] mt-4">
                            <button type="submit" class="border border-1 bg-gray-400 py-4 text-white 
                                           hover:bg-gray-500
                                           rounded-md text-lg" style="font-family:'Lato';font-weight:500;">Upload Digest</button>
                        </div>
                        
                    </form><!-- end of new Digest form //-->
                <div>
    
            

        </section>
        <!-- End of Create Digest Section //-->



    </div>

</x-admin-layout>