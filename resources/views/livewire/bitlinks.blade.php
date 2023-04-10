<div>
    <div class="mt-6 text-gray-500 overflow-scroll">
        <table class="overflow-x-auto table-auto overflow-scroll">
            <thead>
            <tr>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Long URL</th>
                <th class="px-4 py-2">Custom Bitlinks</th>
                <th class="px-4 py-2">Short URL</th>
                <th class="px-4 py-2">Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($bitlinks as $bitlink)
                <tr>
                    <td class="border px-4 py-2">
                        <button type="button" wire:click="setDeleteId({{ $bitlink->id }})"
                                data-modal-target="defaultModal"
                                data-modal-show="defaultModal">Delete
                        </button> {{ isset($bitlink['title']) ? $bitlink['title'] : 'unknown' }}</td>
                    <td class="border px-4 py-2">{{ $bitlink->long_url }}</td>
                    <td class="border px-4 py-2">{{ implode(',', $bitlink->custom_bitlinks) }}</td>
                    <td class="border px-4 py-2">{{ $bitlink->bitlink_id }}</td>
                    <td class="border px-4 py-2">{{ $bitlink->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div wire:ignore.self
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full"
         id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- Main modal -->
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Terms of Service
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        This is a non-retrivable action due. Are you sure you want to permenantly delete this bitlink?
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button wire:click.prevent="delete()" data-modal-hide="defaultModal" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Yes, delete
                    </button>
                    <button data-modal-hide="defaultModal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
