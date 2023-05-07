<div x-data="{
    messages: [],
    remove(message) {
        this.messages.splice(this.messages.map((message) => message.message).indexOf(message), 1)
    },
}"
    @notify.window="let type = $event.detail.type; let message = $event.detail.message; messages.push({'message': message, 'type': type}); setTimeout(() => { remove(message) }, 3000)"
    class="fixed inset-0 flex flex-col items-end justify-end px-4 py-6 pointer-events-none sm:p-6 sm:justify-end space-y-4 ">
    <template x-for="(message, messageIndex) in messages" :key="messageIndex">
        <div
            class=" max-w-sm w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black dark:ring-gray-700 ring-opacity-5 overflow-hidden flex-shrink-0">
            <div class="rounded-lg shadow-xs overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <x-svg.info class="h-6 w-6 text-blue-400" x-show="message.type == 'info'" x-cloak />

                            <x-svg.check-circle x-show="message.type == 'success'" x-cloak
                                class="h-6 w-6 text-green-400" />

                            <x-svg.info x-show="message.type == 'error'" x-cloak class="h-6 w-6 text-red-400" />

                            <x-svg.info x-show="message.type == 'warning'" x-cloak class="h-6 w-6 text-yellow-400" />

                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p x-text="message.message" class="text-sm leading-5 font-medium "></p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="remove(message.message)"
                                class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150">
                                <span class="sr-only">Close</span>
                                <x-svg.x class="w-5 h-5" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
