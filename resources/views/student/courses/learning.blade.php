<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $course->name }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="learning flex flex-col gap-[50px] items-center mt-[50px] w-full pb-[30px]" method="POST" action="{{ route('dashboard.learning.course.store', ['course' => $course->id, 'question' => $question->id]) }}">
                        @csrf
                        <h1 class="w-[821px] font-extrabold text-[46px] leading-[69px] text-center">
                            {{ $question->question }}
                        </h1>
                        <div class="flex flex-col gap-[30px] max-w-[750px] w-full">
                            @foreach ($question->answers as $answer)                           
                            <label for="{{ $answer->id }}"
                                class="group flex items-center justify-between rounded-full w-full border border-[#EEEEEE] p-[18px_20px] gap-[14px] transition-all duration-300 has-[:checked]:border-2 has-[:checked]:border-[#0A090B]">
                                <div class="flex items-center gap-[14px]">
                                    <img src="{{ asset('images/icons/arrow-circle-right.svg') }}" alt="icon">
                                    <span class="font-semibold text-xl leading-[30px]">{{ $answer->answer }}</span>
                                </div>
                                <div class="hidden group-has-[:checked]:block">
                                    <img src="{{ asset('images/icons/tick-circle.svg') }}" alt="icon">
                                </div>
                                <input type="radio" name="answer_id" id="{{ $answer->id }}" class="hidden" value="{{ $answer->id }}">
                            </label>
                            @endforeach
                        </div>
                        <button type="submit"
                            class="w-fit p-[14px_40px] bg-[#6436F1] rounded-full font-bold text-sm text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center align-middle">Save
                            & Next Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
