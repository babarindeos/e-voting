<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-red-900 mx-auto border-0">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Electoral Committees</h1>
                    </div>
                    <div>

                            <a href="{{ route('admin.electoral_committees.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500"><i class="fas fa-plus text-xs"></i> New Electoral Committee</a>


                            <a href="{{ route('admin.electoral_committees.positions.index') }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Electoral Committee Positions</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        


        <!-- Electoral Committee  Section  //-->
        <section class="flex flex-col w-[98%] md:w-[98%] md:flex-row mx-auto py-0 mt-0 border-0 justify-between">   
                <div class='font-normal text-lg'>{{ $electoral_committee->name }}</div>
                <div>
                        <a href="{{ route('admin.electoral_committees.members.create',['electoral_committee'=>$electoral_committee->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                    rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Add Member</a>
                </div>

        </section>
        

        
        <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 border-0">
                   
                @if ($electoral_committee->members->count())
                                <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th width='10%' class="text-center font-semibold py-6 ">SN</th>
                                            <th width='20%' class="font-semibold py-2 text-left">Position</th>
                                            <th width='25%' class="font-semibold py-2 text-left">Names</th>  
                                            <th width='10%' class="font-semibold py-2 text-left">Photo</th> 
                                            <th width='20%' class="font-semibold py-2 text-left">Constituency</th>  
                                                                                               
                                            <th width='15%' class="font-semibold py-2 text-left">Actions</th> 
                                                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 0;
                                        @endphp

                                        @foreach($electoral_committee->members as $member)
                                        <tr class="border border-b border-gray-200 ">
                                            <td class='text-center py-4'>{{ ++$counter }}.</td>
                                            <td>
                                                {{ $member->position->position }}
                                            </td>
                                            <td class="py-8 pr-4">
                                                
                                                <div>
                                                    
                                                        <a class="font-semibold text-blue-800 underline" href="{{ route('admin.electoral_committees.show',['electoral_committee' => $electoral_committee->id]) }}">
                                                            {{ $member->surname }} {{ $member->firstname }} {{ $member->othernames }}
                                                        </a>                             
                                                </div>                                  

                                            </td>
                                            <td>
                                                        @if ($member->photo==null)
                                                            <img src="{{ asset('images/avatar_150.jpg')}}" class="w-16 h-16"  />
                                                        @else
                                                            <img src="{{ asset('storage/'.$member->photo) }}" class="w-16 h-16 rounded-full" />
                                                        @endif
                                            </td>
                                            <td>
                                                         {{ $member->college->code }}, {{ $member->department->code }} ({{ $member->level }})
                                            </td>
                                                    
                                            
                                            <td>
                                                    
                                                        <span class="text-sm">
                                                            <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                                    px-4 py-1 text-xs" href="{{ route('admin.electoral_committees.members.edit', ['member' => $member->id]) }}">Edit</a>
                                                        </span>
                                                        <span> 
                                                            <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                                    px-4 py-1 text-xs" href="{{ route('admin.electoral_committees.members.confirm_delete', ['member'=> $member->id]) }}"
                                                            >Delete</a>
                                                        </span>	

                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    

                                    </tbody>
                                </table>

                               

                @else
                                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-0 py-8 border-0">
                                    <div class="flex flex-row border-0 justify-center text-2xl font-semibold text-gray-300">
                                            There is currently no Electoral Committee Members
                                    </div>
                                </section>
                @endif


       


        </section>
       
        <!-- end of Electoral Committee Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>