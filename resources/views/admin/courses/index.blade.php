<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Courses') }}
            </h2>
            <a href="{{ route('dashboard.courses.create') }}"
                class="h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D]">Add
                New Course</a>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="course-list-container flex flex-col px-5 mt-[30px] gap-[30px] pb-36 ">
                        <div
                            class="course-list-header flex flex-nowrap justify-between pb-4 pr-10 border-b border-[#EEEEEE]">
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
                        @foreach ($courses as $course)
                            <div class="list-items flex flex-nowrap justify-between pr-10">
                                <div class="flex shrink-0 w-[300px]">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 flex shrink-0 overflow-hidden rounded-full">
                                            <img src="{{ Storage::url($course->cover) }}" class="object-cover"
                                                alt="thumbnail">
                                        </div>
                                        <div class="flex flex-col gap-[2px]">
                                            <p class="font-bold text-lg">{{ $course->name }}</p>
                                            {{-- <p class="text-[#7F8190]">Beginners</p> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex shrink-0 w-[150px] items-center justify-center">
                                    <p class="font-semibold">{{ \Carbon\Carbon::parse($course->created_at)->format('F j, Y') }}</p>
                                </div>
                                <div class="flex shrink-0 w-[170px] items-center justify-center">
                                    <p class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B]">
                                        {{ $course->category->name }}</p>
                                </div>
                                <div class="flex shrink-0 w-[120px] items-center">
                                    <div class="relative h-[41px]">
                                        <div
                                            class="menu-dropdown w-[120px] max-h-[41px] overflow-hidden absolute top-0 p-[10px_16px] bg-white flex flex-col gap-3 border border-[#EEEEEE] transition-all duration-300 hover:shadow-[0_10px_16px_0_#0A090B0D] rounded-[18px]">
                                            <button onclick="toggleMaxHeight(this)"
                                                class="flex items-center justify-between font-bold text-sm w-full">
                                                menu
                                                <img src="{{ asset('images/icons/arrow-down.svg') }}" alt="icon">
                                            </button>
                                            <a href="{{ route('dashboard.courses.show', $course->id) }}"
                                                class="flex items-center justify-between font-bold text-sm w-full">
                                                Manage Course
                                            </a>
                                            <a href="{{ route('dashboard.course.students.index', $course->id) }}"
                                                class="flex items-center justify-between font-bold text-sm w-full">
                                                Manage Students
                                            </a>
                                            <a href="{{ route('dashboard.courses.edit', $course->id) }}"
                                                class="flex items-center justify-between font-bold text-sm w-full">
                                                Edit Course
                                            </a>
                                            <form action="{{ route('dashboard.courses.destroy', $course->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="flex items-center justify-between font-bold text-sm w-full text-[#FD445E]">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        function toggleMaxHeight(button) {
            const menuDropdown = button.parentElement;
            menuDropdown.classList.toggle('max-h-fit');
            menuDropdown.classList.toggle('shadow-[0_10px_16px_0_#0A090B0D]');
            menuDropdown.classList.toggle('z-10');
        }

        document.addEventListener('click', function(event) {
            const menuDropdowns = document.querySelectorAll('.menu-dropdown');
            const clickedInsideDropdown = Array.from(menuDropdowns).some(function(dropdown) {
                return dropdown.contains(event.target);
            });
            
            if (!clickedInsideDropdown) {
                menuDropdowns.forEach(function(dropdown) {
                    dropdown.classList.remove('max-h-fit');
                    dropdown.classList.remove('shadow-[0_10px_16px_0_#0A090B0D]');
                    dropdown.classList.remove('z-10');
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
