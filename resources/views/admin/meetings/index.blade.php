<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Meetings</h1>
                    </div>
                    <div>

                            <a href="{{ route('admin.meetings.create') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">New Meeting</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Announcement Section  //-->
        

        
        <section class="flex flex-col w-[98%] mx-auto py-2 mt-2 border-0">
                   


        @if ($meetings->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='10%' class="text-center font-semibold py-2 w-16">SN</th>
                                <th width='40%' class="font-semibold py-2 text-left">Title</th>
                                <th width='20%' class="font-semibold py-2 text-left">Schedule Date</th>
                                <th width='10%' class="font-semibold py-2 text-left">Venue</th> 
                                <th width='15%' class="font-semibold py-2 text-left">Actions</th> 
                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($meetings->currentPage() - 1) * $meetings->perPage();
                            @endphp
                            @foreach($meetings as $meeting)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-2 pr-4">
                                    
                                    <div>
                                        
                                            <a class="font-semibold text-blue-800 underline" href="{{ route('admin.meetings.show',['meeting'=>$meeting->id]) }}">
                                                {{ $meeting->title }}
                                            </a>                             
                                    </div>
                                    

                                    <div class="flex flex-col md:flex-row text-xs md:space-x-2 py-1">
                                                 @if ($meeting->file != '' || $meeting->file != null)    
                                                        <div class='flex flex-col space-y-1 md:flex-row justify-between text-xs'>
                                                            <div class="flex flex-col">
                                                                    <div class="flex flex-row space-x-2">
                                                                    
                                                                            <div>{{ $meeting->filetype }} ({{ $meeting->filesize }})</div>
                                                                                                                  
                                                                    </div>                                        
                                                            </div>                                
                                                        </div>
                                                @endif  

                                                <div>
                                                    Comments (0)
                                                </div>

                                                <div>
                                                    Attendees (0)
                                                </div>

                                                <div>
                                                    Papers (0)
                                                </div>

                                    </div>
                                
                                </td>
                                <td>
                                       {{ $meeting->created_at->format('l jS F, Y') }}
                                       <div class='text-sm'>
                                            {{ $meeting->created_at->format('g:i a') }}
                                       </div>
                                </td>
                                <td width="20%" class="">
                                        {{ $meeting->venue }}
                                </td>
                                <td>
                                            <span class="text-sm">
                                                <a class="hover:bg-green-500 bg-green-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.meetings.edit', ['meeting' => $meeting->id]) }}">Agenda</a>
                                            </span>
                                            <span class="text-sm">
                                                <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.meetings.edit', ['meeting' => $meeting->id]) }}">Edit</a>
                                            </span>
                                            <span> 
                                                <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                        px-4 py-1 text-xs" href="{{ route('admin.meetings.confirm_delete', ['meeting'=> $meeting->id]) }}"
                                                >Delete</a>
                                            </span>	

                                </td>
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                    <div>
                        {{ $meetings->links() }}
                    </div>

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Meetings
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Announcement Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>