<html>
    <head></head>
    <body>
        <div class="flex flex-col bg-gray-200 w-full h-screen items-center">

            <div class="flex flex-col bg-white rounded w-11/12 md:w-8/12 shadow mx-auto p-6 mt-6 mb-2 items-start">

                <div class="text-4xl font-medium mb-2 text-blue-400">
                    {{ config('app.name') }}
                </div>

                <h3>{{ __('emails.sign-up.greeting', ['name' => $user->name]) }}</h3>
                <span>
                {{ __('emails.sign-up.signed-on') }}
                <a class="underline" href="{{ config('app.url') }}">{{ config('app.name') }}</a>,
                {{ __('emails.sign-up.click-to-validate') }}
            </span>

                <a
                    class="bg-blue-400 hover:bg-blue-800 rounded px-12 py-2 text-white font-medium my-2"
                    href="{{ route('sign-up.verify', ['emailLink' => $user->email_link ])  }}">
                    {{ __('emails.sign-up.click-here') }}
                </a>

                <span class="font-light">{{ __('emails.sign-up.not-you') }}</span>
            </div>

            <a href="{{ config('app.url') }}">
            <span class="text-sm md:text-lg text-gray-600 font-thin underline">
                {{__('links.merchant-qr-code.powered-by')}}
            </span>
            </a>
        </div>

    </body>
</html>

