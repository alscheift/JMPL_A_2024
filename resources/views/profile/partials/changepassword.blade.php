<div class="bg-white p-6 rounded-lg">
    <h2 class="text-lg font-bold mb-4">Password</h2>

    <form method="POST" action="{{ route('password.update')}}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="current_password" class="block text-s font-semibold text-gray-600">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="w-full border px-2 py-1 text-s rounded-lg">
        </div>

        @error('current_password')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror

        <div class="mb-4">
            <label for="password" class="block text-s font-semibold text-gray-600">Password</label>
            <input type="password" name="password" id="password" class="w-full border px-2 py-1 text-s rounded-lg">
        </div>

        @error('password')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror


        <div class="mb-4">
            <label for="password_confirmation" class="block text-s font-semibold text-gray-600">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border px-2 py-1 text-s rounded-lg">
        </div>

        @error('password_confirmation')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white uppercase text-s font-semibold px-6 py-2 rounded-lg">
                Update Password
            </button>
        </div>
    </form>
</div>