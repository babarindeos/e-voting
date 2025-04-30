<x-admin-layout>

    <div class="flex flex-col border-0 w-[95%] mx-auto">
        

        <!-- page header //-->
        <section class="flex flex-col w-full md:w-full py-8 px-2 md:px-4 border-red-900 mx-auto border-0">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Election</h1>
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

        


        <!-- Elections  Section  //-->
        <section class="flex flex-col w-[98%] md:w-[98%] md:flex-row mx-auto py-0 mt-0 border-0 justify-between">   
                <div class='font-normal text-lg'>{{ $election->name }}</div>
                <div>
                        <div class='flex flex-col md:flex-row space-y-1 md:space-y-0 md:space-x-1'>
                                <a href="{{ route('admin.elections.candidates.create',['election'=>$election->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Add Candidates</a>

                                <a href="{{ route('admin.results.elections.show',['election'=>$election->id]) }}" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Results</a>

                                <a href="#" class="border border-green-600 text-green-600 py-2 px-6 
                                            rounded-lg text-xs md:text-sm hover:bg-green-500 hover:text-white hover:border-green-500">Analytics</a>
                        </div>
                </div>

        </section>
        

        
        <section class="flex flex-col w-[98%] md:w-[98%] mx-auto py-2 mt-2 border-0">
                   
                @if ($election->candidates->count())
                                <table class="table-auto border-collapse border border-1 border-gray-200 w-full">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th width='10%' class="text-center font-semibold py-6 ">SN</th>
                                            <th width='15%' class="font-semibold py-2 text-left">Position</th>
                                            <th width='15%' class="font-semibold py-2 text-left">Photo</th>
                                            <th width='25%' class="font-semibold py-2 text-left">Names</th>  
                                            <th width='20%' class="font-semibold py-2 text-left">Constituency</th> 
                                             
                                                                                               
                                            <th width='15%' class="font-semibold py-2 text-center">Actions</th> 
                                                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 0;
                                        @endphp

                                        @foreach($election->candidates as $candidate)
                                        <tr class="border border-b border-gray-200 ">
                                            <td class='text-center py-4'>{{ ++$counter }}.</td>
                                            <td>{{ $candidate->position->name }}</td>
                                            <td class='py-4 text-center'>
                                                        @if ($candidate->photo==null)
                                                            <img src="{{ asset('images/avatar_150.jpg')}}" class="w-16 h-16"  />
                                                        @else
                                                            <img src="{{ asset('storage/'.$candidate->photo) }}" class="w-16 h-16 rounded-full" />
                                                        @endif

                                                        @php
                                                            $yes = 0;
                                                            $no = 0;
                                                            $void = 0;
                                                        

                                                            foreach($candidate->votes as $vote)
                                                            {
                                                                if ($vote->yes)
                                                                {
                                                                    ++$yes;
                                                                }
                                                                elseif ($vote->no)
                                                                {
                                                                    ++$no;
                                                                }
                                                                elseif ($vote->void)
                                                                {
                                                                    ++$void;
                                                                }

                                                            }

                                                        @endphp
 
                                                        <div class='py-2'>
                                                            
                                                            <table  class='border'>
                                                                <tr class=''>
                                                                    <td class='py-2 px-2 font-semibold'>Yes</td><td class='px-4 '>  {{ $yes }} </td><td class='font-semibold'>No </td><td class='px-4'> {{ $no }} </td><td>Void</td><td class='px-4'> {{ $void }} </td>
                                                                </tr>
                                                                
                                                            </table>
                                                        </div>
                                            </td>
                                            <td class="py-8 pr-4">
                                                
                                                <div>
                                                    
                                                        <a class="font-semibold text-blue-800 underline" href="{{ route('admin.elections.candidates.show',['candidate' => $candidate->id]) }}">
                                                            {{ $candidate->surname }} {{ $candidate->firstname }} {{ $candidate->othernames }}
                                                        </a>                             
                                                </div>        
                                                <div class='text-sm'> 
                                                        {{ $candidate->matric_no }}
                                                </div>                                                  
                                                

                                            </td>
                                            <td>
                                                    {{ $candidate->college->code }}, {{ $candidate->department->code }} ({{ $candidate->level }})
                                            </td>
                                            
                                                    
                                            
                                            <td>
                                                    
                                                        <span class="text-sm">
                                                            <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                                    px-4 py-1 text-xs" href="{{ route('admin.elections.candidates.edit', ['candidate' => $candidate->id]) }}">Edit</a>
                                                        </span>
                                                        <span> 
                                                            <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                                    px-4 py-1 text-xs" href="{{ route('admin.elections.candidates.confirm_delete', ['candidate'=> $candidate->id]) }}"
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
                                            There is currently no Candidate
                                    </div>
                                </section>
                @endif


       


        </section>
       
        <!-- end of Electoral Committee Section //-->
    
        
    
    
        
    </div>
    


</x-admin-layout>