<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Learning page') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="course-list-container flex flex-col px-5 mt-[30px] gap-[30px]">
                        <div class="course-list-header flex flex-nowrap justify-between pb-4 pr-10 border-b border-[#EEEEEE]">
                            <div class="flex shrink-0 w-[300px]">
                                <p class="text-[#7F8190]">Course</p>
                            </div>
                            <div class="flex justify-center shrink-0 w-[150px]">
                                <p class="text-[#7F8190]">Date Created</p>
                            </div>
                            <div class="flex justify-center shrink-0 w-[170px]">
                                <p class="text-[#7F8190]">Category</p>
                            </div>
                            <div class="flex justify-center shrink-0 w-[120px]">
                                <p class="text-[#7F8190]">Action</p>
                            </div>
                        </div>
                        @forelse ($my_courses as $course)                        
                        <div class="list-items flex flex-nowrap justify-between pr-10">
                            <div class="flex shrink-0 w-[300px]">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 flex shrink-0 overflow-hidden rounded-full">
                                        <img src="{{ Storage::url($course->cover) }}" class="object-cover" alt="thumbnail">
                                    </div>
                                    <div class="flex flex-col gap-[2px]">
                                        <p class="font-bold text-lg">{{ $course->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex shrink-0 w-[150px] items-center justify-center">
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($course->created_at)->format('F j, Y') }}</p>
                            </div>
                            <div class="flex shrink-0 w-[170px] items-center justify-center">
                                <p class="p-[8px_16px] rounded-full bg-[#D5EFFE] font-bold text-sm text-[#066DFE]">{{ $course->category->name }}</p>
                            </div>
                            <div class="flex shrink-0 w-[120px] items-center">
                                @if ($course->nextQuestionId !== null)
                                <a href="{{ route('dashboard.learning.course', ['course' => $course->id, 'question' => $course->nextQuestionId]) }}" class="w-full h-[41px] p-[10px_20px] bg-[#6436F1] rounded-full font-bold text-sm text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Start Test</a>
                                @else
                                <a href="{{ route('dashboard.learning.report', $course) }}" class="w-full h-[41px] p-[10px_20px] bg-[#6436F1] rounded-full font-bold text-sm text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Result</a>
                                @endif
                            </div>
                        </div>
                        @empty
                            <p>No class enrolled, please contact your teacher!</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
