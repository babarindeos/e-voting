<x-staff-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-2 mt-4 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Papers</h1>
                    </div>
                    
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Announcement Section  //-->
        

        
        <section class="flex flex-col w-[98%] mx-auto py-2 mt-2 border-0">
                   


        @if ($papers->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='5%' class="text-center font-semibold py-2 ">SN</th>
                                <th width='7%' class="font-semibold py-2 text-left">Paper No.</th>
                                <th width='20%' class="font-semibold py-2 text-left">Title.</th>
                                <th width='20%' class="font-semibold py-2 text-left">Authors</th>
                                <th width='15%' class="font-semibold py-2 text-left">Posted By</th>
                                <th width='8%' class="font-semibold py-2 text-left">Date Published</th> 
                               
                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($papers->currentPage() - 1) * $papers->perPage();
                            @endphp
                            @foreach($papers as $paper)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-2 pr-4">
                                    
                                        {{ $paper->paper_no }}
                                
                                </td>
                                <td>

                                        @php
                                            $status = $paper->status;

                                            $status_panel = '';

                                            if ($status == 'pending')
                                            {
                                                $status_panel = "<span class='bg-blue-400 rounded-md ml-1 text-xs px-2 text-white '>Pending</span>";
                                            }
                                            else if($status == 'declined')
                                            {
                                                $status_panel = "<span class='bg-red-400 rounded-md ml-1 text-xs px-2 text-white '>Declined</span>";
                                            }
                                            else if($status == 'approved')
                                            {
                                                $status_panel = "<span class='bg-green-400 rounded-md ml-1 text-xs px-2 text-white '>Approved</span>";
                                            }

                                        @endphp
                                                <div>
                                                    <a href="" 
                                                    class='text-blue-500 underline font-semibold' >
                                                        <a class="font-semibold text-blue-800 underline" href="{{ route('staff.papers.show',['paper'=>$paper->id]) }}">
                                                            {{ $paper->title }} 
                                                        </a>
                                                        @php echo $status_panel; @endphp
                                                    
                                                </div>
                                                <div class='flex flex-col space-y-1 md:flex-row justify-between text-xs'>
                                                    <div class="flex flex-col">
                                                            <div class="flex flex-row space-x-2">
                                                                @if ($paper->file != '' || $paper->file != null)
                                                                    <div>{{ $paper->filetype }} ({{ $paper->filesize }})</div>
                                                                @endif                                            
                                                            </div>                                        
                                                    </div>                                
                                                </div>


                                </td>
                                <td>
                                            {{ $paper->paper_author->surname }} {{ $paper->paper_author->firstname }}
                                            <div class="text-xs">
                                                    {{ $paper->other_authors }}
                                            </div>

                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        @php
                                            $surname = ucfirst(strtolower($paper->sender->surname))
                                        @endphp

                                            <div>
                                                @if ($paper->sender->profile != null) 
                                                    @if ($paper->sender->profile->avatar != null || $paper->sender->profile->avatar !='' )
                                                            <img class="w-8" src="{{ asset('images/avatar_64.jpg')}}" /> 
                                                    @else
                                                             
                                                            <img src="{{ asset('storage/'.$announcement->sender->profile->avatar)}}" 
                                                                        class='w-8 h-8 rounded-full hover:ring hover:ring-gray-300' />

                                                    @endif
                                                @else
                                                            
                                                            <img class="w-8" src="{{ asset('images/avatar_64.jpg')}}" /> 
                                                


                                                @endif
                                            </div>

                                            <div>
                                                            <a class="hover:underline" href="{{ route('admin.profile.email_user_profile',['email'=>$paper->sender->email]) }}">
                                                                    @php
                                                                        $surname = ucfirst(strtolower($paper->sender->surname))
                                                                    @endphp
                                                                    {{ $surname }} {{ $paper->sender->firstname }}
                                                            </a>

                                            </div>
                                            
                                    </div>

                                </td>
                                <td width="20%" class="text-sm">
                                        <div class="px-0">
                                            {{ $paper->created_at->format('l jS F, Y')}}
                                            <div class="text-xs">
                                                {{ $paper->created_at->format('@ g:i a') }}
                                            </div>
                                        </div>
                                </td>
                            
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                    <div>
                        {{ $papers->links() }}
                    </div>

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Papers
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Announcement Section //-->
    
        
    
    
        
    </div>
    


</x-staff-layout>