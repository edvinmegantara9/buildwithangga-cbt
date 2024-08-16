<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add student') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="header ml-[70px] pr-[70px] w-[940px] flex items-center justify-between mt-10">
                        <div class="flex gap-6 items-center">
                            <div class="w-[150px] h-[150px] flex shrink-0 relative overflow-hidden">
                                <img src="{{ Storage::url($course->cover) }}"
                                    class="w-full h-full object-contain" alt="icon">
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
                                        <p class="font-semibold">{{ \Carbon\Carbon::parse($course->created_at)->format('F j, Y') }}</p>
                                    </div>
                                    <div class="flex gap-[10px] items-center">
                                        <div class="w-6 h-6 flex shrink-0">
                                            <img src="{{ asset('images/icons/profile-2user-outline.svg') }}" alt="icon">
                                        </div>
                                        <p class="font-semibold">{{ count($students) }} students</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="add-question" class="mx-[70px] mt-[30px] flex flex-col gap-5" method="POST" action="{{ route('dashboard.course.students.store', $course) }}">
                        @csrf
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <h2 class="font-bold text-2xl">Add New Student</h2>
                        <div class="flex flex-col gap-[10px]">
                            <p class="font-semibold">Email Address</p>
                            <div
                                class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] focus-within:border-2 focus-within:border-[#0A090B]">
                                <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('/images/icons/sms.svg') }}" class="h-full w-full object-contain" alt="icon">
                                </div>
                                <input type="text"
                                    class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                                    placeholder="Write student email address" name="email">
                            </div>
                        </div>
                        <button type="submit"
                            class="w-[500px] h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Add
                            Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
