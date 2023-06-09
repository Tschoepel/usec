<x-guest-layout>
    {{-- <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 class="text-base font-semibold leading-7 text-gray-900">2 Factor Authentification</h2>

        <div class="relative pt-1">
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-slate-200">
              <div style="width:30%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-slate-500"></div>
            </div>
          </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form> --}}
            {{-- <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6"> --}}
              <div>
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-yellow-100">
                  <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                  <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">2FA Request</h3>
                  <div class="mt-2">
                    <p class="text-sm text-gray-500">Please check your smartwatch to accept the request.</p>
                  </div>
                </div>
              </div>
              {{-- <div class="mt-5 sm:mt-6">
                <button type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Resend 2FA request</button>
              </div> --}}
              <div x-data="{
                redirectUrl: '',
                checkForUpdates() {
                    fetch('/check/{{ Auth::user()->id }}')
                        .then(response => response.json())
                        .then(data => {
                            if (data.redirect) {
                                window.location.href  = data.redirect;
                            } else {
                                setTimeout(() => this.checkForUpdates(), 10000); // Poll again after 1 second
                            }
                        })
                        .catch(() => {
                            setTimeout(() => this.checkForUpdates(), 10000); // Retry after 1 second if there was an error
                        });
                },
                redirectToUrl() {
                    if (this.redirectUrl) {
                        window.location.href = this.redirectUrl;
                    }
                }
            }" x-init="checkForUpdates()">
            </div>
</x-guest-layout>
