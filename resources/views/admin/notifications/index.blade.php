<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-0 border-red-900 mx-auto border border-1">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Notifications</h1>
                    </div>
                    <div>

                            <a href="{{ route('admin.notifications.create') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">New Notification</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Announcement Section  //-->
        

        
        <section class="flex flex-col w-[98%] mx-auto py-2 mt-2 border-0">
                   


        @if ($notifications->count())
                    <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th width='5%' class="text-center font-semibold py-2 ">SN</th>
                                <th width='20%' class="font-semibold py-2 text-left">Subject</th>
                                <th width='20%' class="font-semibold py-2 text-left">Meeting</th>                              
                                <th width='8%' class="font-semibold py-2 text-left">Date Sent</th>                                                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($notifications->currentPage() - 1) * $notifications->perPage();
                            @endphp
                            @foreach($notifications as $notification)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td class="py-2 pr-4">
                                    
                                        {{ $notification->subject }}
                                
                                </td>
                                <td>
                                        {{ $notification->meeting->title }}
                                       

                                </td>
                                

                                <td width="20%" class="text-sm">
                                        <div class="px-0">
                                            {{ $notification->created_at->format('l jS F, Y')}}
                                            <div class="text-xs">
                                                {{ $notification->created_at->format('@ g:i a') }}
                                            </div>
                                        </div>
                                </td>
                                
                                
                            </tr>
                            @endforeach
                        

                        </tbody>
                    </table>

                    <div>
                        {{ $notifications->links() }}
                    </div>

            @else
                    <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                        <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                There is currently no Notification
                        </div>
                    </section>
            @endif



        </section>
       
        <!-- end of Announcement Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>