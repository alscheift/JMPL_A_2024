<x-layout>

    <section class="py-8 max-w-4xl mx-auto">
        <h1 class="text-lg font-bold mb-8 pb-2 border-b">
            {{ __('Profile') }}
        </h1>

            <main class="flex flex-col">
               @include('profile.partials.user-identity')
               @include('profile.partials.password')
            </main>
        </div>
    </section>

</x-layout>
