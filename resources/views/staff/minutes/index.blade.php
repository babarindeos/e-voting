<x-staff-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-2 mt-4 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Minutes</h1>
                    </div>
                    
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Announcement Section  //-->
        

        
        <section class="flex flex-col w-[98%] mx-auto py-2 mt-2 border-0">
                   


        @if ($minutes->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='5%' class="text-center font-semibold py-2 ">SN</th>
                                <th width='20%' class="font-semibold py-2 text-left">Title</th>
                                <th width='20%' class="font-semibold py-2 text-left">File</th> 
                                <th width='25%' class="font-semibold py-2 text-left">Note</th>                                
                                <th width='8%' class="font-semibold py-2 text-left">Date Published</th> 
                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($minutes->currentPage() - 1) * $minutes->perPage();
                            @endphp
                            @foreach($minutes as $minute)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-2 pr-4">
                                    
                                        {{ $minute->title }}
                                
                                </td>
                                <td>
                                                            @if ($minute->file!="")
                                                                    <div class="text-sm">
                                                                            <i class="fa-solid fa-paperclip"></i> 
                                                                            <a href="{{ asset('storage/'.$minute->file) }}" target="_blank" class="hover:underline">
                                                                            File Attachment - <span class='text-xs'> {{ $minute->filetype}} ({{ $minute->filesize }})</span>
                                                                            </a>
                                                                    </div>
                                                                    <!-- end of file attachment //-->
                                                            @endif
                                       

                                </td>
                                <td>
                                        {{ $minute->note }}
                                </td>

                                <td width="20%" class="text-sm">
                                        <div class="px-0">
                                            {{ $minute->created_at->format('l jS F, Y')}}
                                            <div class="text-xs">
                                                {{ $minute->created_at->format('@ g:i a') }}
                                            </div>
                                        </div>
                                </td>
                                
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                    <div>
                        {{ $minutes->links() }}
                    </div>

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Minutes
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Announcement Section //-->
    
        
    
    
        
    </div>
    


</x-staff-layout>