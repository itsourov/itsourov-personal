 <div
     class=" bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-800  cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700">
     <button type="button" class="flex items-center justify-between w-full px-4 py-5 sm:p-6">
         <span class="flex text-lg font-semibold"> {{ $q }} </span>


         <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
         </svg>
     </button>

     <div class="hidden px-4 pb-5 sm:px-6 sm:pb-6 ">
         {{ $a }}
     </div>
 </div>
