<div class="bg-white p-6 rounded-lg mb-6">
    <h2 class="text-lg font-bold mb-4">Account</h2>

    <form method="POST" action="404">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="name" class="block text-s font-semibold text-gray-600">Name</label>
            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="w-full border px-2 py-1 text-s rounded-lg">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-s font-semibold text-gray-600">Email</label>
            <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="w-full border px-2 py-1 text-s rounded-lg">
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white uppercase text-s font-semibold px-6 py-2 rounded-lg">
                Update
            </button>
        </div>
    </form>
</div>