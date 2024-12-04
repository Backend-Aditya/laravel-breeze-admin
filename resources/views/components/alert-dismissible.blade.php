@props(['message' => ''])

<div id="dismissibleAlert" role="alert"
    class="fixed top-[50px] z-50 flex items-end justify-center px-4 py-6 transition duration-500 opacity-100 -right-64 sm:p-6 sm:items-start sm:justify-end">
    <div class="relative flex w-auto px-4 py-4 overflow-hidden bg-gray-100 rounded-lg shadow-sm dark:bg-gray-900">
        <div class="mr-12 text-sm font-medium text-gray-600 dark:text-gray-300">{{ $message }}</div>
        <button id="dismissButton"
            class="!absolute top-3 right-3 h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase transition-all bg-gray-200 hover:bg-gray-300 active:bg-gray-400/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 dark:active:bg-gray-700/30"
            type="button">
            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6 text-gray-600 dark:text-gray-300" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </span>
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alertElement = document.getElementById('dismissibleAlert');
        const dismissButton = document.getElementById('dismissButton');

        alertElement.style.transform = 'translateX(-16rem)';

        const hideAlert = () => {
            alertElement.style.transform = 'translateX(16rem)';
        };

        dismissButton.addEventListener('click', hideAlert);

        setTimeout(hideAlert, 5000);
    });
</script>
