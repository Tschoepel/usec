<x-guest-layout>
    <form method="POST" action="{{ route('2fa.secret_save') }}">
        @csrf

            {{-- <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6"> --}}
              <div>
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-yellow-100">
                  <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                  </svg>

                </div>
                <div class="mt-3 text-center sm:mt-5">
                  <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">2FA Secret</h3>
                  <div class="mt-2">
                    <p class="text-sm text-gray-500">Please enter this secret in the 2FA App tp connect your smartwatch safely with our service.</p>
                  </div>
                  <div class="mt-2">
                    <p class="text-xl text-gray-900">{{ $secret }}</p>
                    <input class="hidden" name="secret" value="{{ $secret }}">
                  </div>
                </div>
              </div>
              <div class="mt-5 sm:mt-6">
                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    I have saved this secret and want to continue
                </button>
              </div>
            </form>
</x-guest-layout>
