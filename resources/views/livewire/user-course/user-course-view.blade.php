<div>
    <div class="container mx-auto px-4 space-y-6">
        <div class="border border-gray-300 relative overflow-x-auto shadow-md sm:rounded-lg p-4">
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
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($userCourses->courses) > 0)
                        @foreach ($userCourses->courses as $course)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $course->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $course->description }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($course->status == 1)
                                        <div class="inline-flex rounded-md shadow-sm" role="group">
                                            <span class="bg-red-700 p-1 text-white rounded-md">Participated</span>
                                        </div>
                                    @else
                                        <div class="inline-flex rounded-md shadow-sm" role="group">
                                            <button type="button" wire:click="participateUser({{ $course->id }})"
                                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Participate</button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="py-5">
                                <div class="flex justify-center">
                                    <label class="text-sm" for="">There are no any courses for you</label>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
