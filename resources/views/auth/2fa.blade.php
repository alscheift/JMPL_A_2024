<x-layout content="content">
    <!-- Simple form 2fa -->
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <h1 class="text-center font-bold text-xl">Two Factor Authentication</h1>

            <form method="POST" action="{{ route('2fa.verify')}}" class="mt-10">
                @csrf
                <x-form.input labelname="2FA Token" name="token" type="input"></x-form.input>

                <!-- center -->
                <div class="flex justify-center">
                    <x-form.button>Login</x-form.button>
                </div>

                
            </form>
        </main>
    </section>
    <script>
        // get element that contain  href of 'login'
        const login = document.querySelector('a[href="login"]');
        const register = document.querySelector('a[href="register"]');
        
        // change the href of 'login' to '2fa'
        login.href = "{{ route('login') }}";
        register.href = "{{ route('register') }}";

        </script>
    <form method="POST" action="{{ route('2fa.verify') }}">
       
    </form>
</x-layout>
