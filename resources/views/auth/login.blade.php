<x-layout content="content">
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <h1 class="text-center font-bold text-xl">Login !</h1>

            <form method="POST" action="/login" class="mt-10">
                @csrf

                <x-form.input labelname="Email or Username" name="email" type="input"
                              autocomplete="username"></x-form.input>
                <x-form.input name="password" type="password" autocomplete="new-password"></x-form.input>

                <div id="recaptcha-container" class="g-recaptcha mt-2 mb-2"></div>
                <x-form.error name="g-recaptcha-response"></x-form.error>
                <x-form.button>Login</x-form.button>
            </form>
        </main>
        <script>
            var onloadCallback = function() {
                @if(session('captcha'))
            grecaptcha.render('recaptcha-container', {
                'sitekey' : '{{ config('recaptcha.site_key') }}',
                'callback' : function(response) {
                    // console.log(response+' is verified');
                    document.querySelector('#g-recaptcha-response').value = response;
                }
            });
            @else
            console.log('no captcha needed :D');
            @endif
            
        };
        </script>
    </section>
</x-layout>
