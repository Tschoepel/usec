<x-guest-layout>
    <div>
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
            <svg class="h-6 w-6 text-red-600"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="1.5"
                 stroke="currentColor"
                 aria-hidden="true">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>

        </div>
        <div class="mt-3 text-center sm:mt-5">
            <h3 class="text-base font-semibold leading-6 text-gray-900"
                id="modal-title">2FA Request denied</h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500">Your request has been denied or is no longer valid. You have been logged out and you can try again later.</p>
            </div>
        </div>
    </div>
    <div class="mt-5 sm:mt-6">
        <a href="{{route('index')}}" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Take me back to the website
        </a>
    </div>
</x-guest-layout>
