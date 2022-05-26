<div class="container mx-auto px-4">
    <div class="flex-initial w-100 space-y-6" x-data="{ open: false }">
        <div class="flex">
            <div class="p-4">
                <button type="button" wire:click="openTable"
                    class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:blue-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Assign
                    new course</button>
            </div>
        </div>
        @if ($open)
            <div class="border border-gray-300 relative overflow-x-auto shadow-md sm:rounded-lg p-4">
                @if (count($courses) > 0)
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="border-b dark:bg-gray-800">
                                <th scope="col" class="px-6 py-3"></th>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-table-1" type="checkbox" checked
                                                wire:model="checks.{{ $course->id }}"
                                                wire:click="collectId({{ $course->id }})"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{ $course->title }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $course->description }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex flex-row-reverse">
                        <div class="p-4">
                            <button type="button" wire:click="submit"
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>
                        </div>
                    </div>
                @else
                    <div class="flex justify-center">
                        <label for="">There are no any new courses to assigend due to all courses were assigend</label>
                    </div>
                @endif
            </div>
        @endif
        <div class="border border-gray-300 relative overflow-x-auto shadow-md sm:rounded-lg p-4">
            <div class="flex">
                <div class="p-4">
                    <p class="text-2xl dark:text-white">{{ $user->name }}'s assigned courses</p>
                </div>
            </div>
            <hr>
            <br>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="border-b dark:bg-gray-800">
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($userCourses->courses) > 0)
                        @foreach ($userCourses->courses as $userCourse)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $userCourse->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $userCourse->description }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $userCourses->name }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="py-5">
                                <div class="flex justify-center">
                                    <label class="text-sm" for="">There are no any assigned courses to
                                        show</label>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('refreshAssigedTable', function() {
            location.reload();
        });
    </script>
@endpush
