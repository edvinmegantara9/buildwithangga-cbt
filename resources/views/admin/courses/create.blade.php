<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add new course') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('dashboard.courses.store') }}"
                        class="flex flex-col gap-[30px] w-[500px] mx-[70px] mt-10" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="flex gap-5 items-center">
                            <input type="file" name="cover" id="cover" class="peer hidden"
                                onchange="previewFile()" data-empty="true">
                            <div
                                class="relative w-[100px] h-[100px] rounded-full overflow-hidden peer-data-[empty=true]:border-[3px] peer-data-[empty=true]:border-dashed peer-data-[empty=true]:border-[#EEEEEE]">
                                <div class="relative file-preview z-10 w-full h-full hidden">
                                    <img src="" class="thumbnail-icon w-full h-full object-cover"
                                        alt="thumbnail">
                                </div>
                                <span
                                    class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 text-center font-semibold text-sm text-[#7F8190]">Icon<br>Course</span>
                            </div>
                            <button type="button"
                                class="flex shrink-0 p-[8px_20px] h-fit items-center rounded-full bg-[#0A090B] font-semibold text-white"
                                onclick="document.getElementById('cover').click()">
                                Add Icon
                            </button>
                        </div>
                        @error('cover')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror

                        <div class="flex flex-col gap-[10px]">
                            <p class="font-semibold">Course Name</p>
                            <div
                                class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]">
                                <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('/images/icons/note-favorite-outline.svg') }}"
                                        class="w-full h-full object-contain" alt="icon">
                                </div>
                                <input type="text"
                                    class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                                    placeholder="Write your better course name" name="name" required>
                            </div>
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="group/category flex flex-col gap-[10px]">
                            <p class="font-semibold">Category</p>
                            <div
                                class="peer flex items-center p-[12px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]">
                                <div class="mr-[10px] w-6 h-6 flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('/images/icons/bill.svg') }}"
                                        class="w-full h-full object-contain" alt="icon">
                                </div>
                                <select id="category"
                                    class="pl-1 font-semibold focus:outline-none w-full text-[#0A090B] invalid:text-[#7F8190] invalid:font-normal appearance-none bg-[url('{{ asset('/images/icons/arrow-down.svg') }}')] bg-no-repeat bg-right"
                                    name="category_id" required>
                                    <option value="" disabled selected hidden>Choose one of category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center gap-5">
                            <a href="{{ route('dashboard.courses.index') }}"
                                class="w-full h-[52px] p-[14px_20px] bg-[#0A090B] rounded-full font-semibold text-white transition-all duration-300 text-center">Back</a>
                            <button type="submit"
                                class="w-full h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Save
                                Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewFile() {
                var preview = document.querySelector('.file-preview');
                var fileInput = document.querySelector('input[type=file]');

                if (fileInput.files.length > 0) {
                    var reader = new FileReader();
                    var file = fileInput.files[0];

                    reader.onloadend = function() {
                        var img = preview.querySelector('.thumbnail-icon');
                        img.src = reader.result;
                        preview.classList.remove('hidden');
                    }

                    reader.readAsDataURL(file);
                    fileInput.setAttribute('data-empty', 'false');
                } else {
                    preview.classList.add('hidden');
                    fileInput.setAttribute('data-empty', 'true');
                }
            }
        </script>
        <script>
            function handleActiveAnchor(element) {
                event.preventDefault();

                const group = element.getAttribute('data-group');

                const allElements = document.querySelectorAll(`[data-group="${group}"][aria-checked="true"]`);
                allElements.forEach(el => {
                    el.setAttribute('aria-checked', 'false');
                });

                element.setAttribute('aria-checked', 'true');
            }
        </script>
    @endpush
</x-app-layout>
