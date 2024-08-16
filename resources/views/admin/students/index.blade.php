<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Students') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="header ml-[70px] pr-[70px] w-[940px] flex items-center justify-between mt-10">
                        <div class="flex gap-6 items-center">
                            <div class="w-[150px] h-[150px] flex shrink-0 relative overflow-hidden">
                                <img src="{{ Storage::url($course->cover) }}" class="w-full h-full object-contain"
                                    alt="icon">
                                <p
                                    class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B] absolute bottom-0 transform -translate-x-1/2 left-1/2 text-nowrap">
                                    {{ $course->category->name }}</p>
                            </div>
                            <div class="flex flex-col gap-5">
                                <h1 class="font-extrabold text-[30px] leading-[45px]">{{ $course->name }}</h1>
                                <div class="flex items-center gap-5">
                                    <div class="flex gap-[10px] items-center">
                                        <div class="w-6 h-6 flex shrink-0">
                                            <img src="{{ asset('images/icons/calendar-add.svg') }}" alt="icon">
                                        </div>
                                        <p class="font-semibold">
                                            {{ \Carbon\Carbon::parse($course->created_at)->format('F j, Y') }}</p>
                                    </div>
                                    <div class="flex gap-[10px] items-center">
                                        <div class="w-6 h-6 flex shrink-0">
                                            <img src="{{ asset('images/icons/profile-2user-outline.svg') }}"
                                                alt="icon">
                                        </div>
                                        <p class="font-semibold">{{ count($students) }} students</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <a href="{{ route('dashboard.course.students.create', $course) }}"
                                class="h-[52px] p-[14px_30px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D]">Add
                                Student</a>
                        </div>
                    </div>
                    <div id="course-test" class="mx-[70px] w-[870px] mt-[30px]">
                        <div class="flex flex-col gap-5 mt-2">
                            @foreach ($students as $student)
                                <div
                                    class="student-card w-full flex items-center justify-between p-4 border border-[#EEEEEE] rounded-[20px]">
                                    <div class="flex gap-4 items-center">
                                        <div class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                            <img src="{{ asset('images/photos/default-photo.svg') }}"
                                                class="w-full h-full object-cover" alt="photo">
                                        </div>
                                        <div class="flex flex-col gap-[2px]">
                                            <p class="font-bold text-lg">{{ $student->name }}</p>
                                            <p class="text-[#7F8190]">{{ $student->email }}</p>
                                        </div>
                                    </div>
                                    @if ($student->status == 'Passed')
                                        <div class="flex items-center gap-[14px]">
                                            <p
                                                class="p-[6px_10px] rounded-[10px] bg-[#06BC65] font-bold text-xs text-white outline-[#06BC65] outline-dashed outline-[2px] outline-offset-[4px] mr-[6px]">
                                                Passed</p>
                                        </div>
                                    @elseif ($student->status == 'Not passed')
                                        <div class="flex items-center gap-[14px]">
                                            <p
                                                class="p-[6px_10px] rounded-[10px] bg-[#FD445E] font-bold text-xs text-white outline-[#FD445E] outline-dashed outline-[2px] outline-offset-[4px] mr-[6px]">
                                                Not passed</p>
                                        </div>
                                    @elseif ($student->status == 'Not started')
                                        <p
                                            class="p-[6px_10px] rounded-[10px] bg-[#666] font-bold text-xs text-white outline-[#666] outline-dashed outline-[2px] outline-offset-[4px] mr-[6px]">
                                            Not started</p>
                                    @endif
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
