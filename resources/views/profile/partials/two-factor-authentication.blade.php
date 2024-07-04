<div class="bg-white p-6 rounded-lg mb-6">
    <h2 class="text-lg font-bold mb-4">Two Factor Authentication</h2>

    <!-- Image -->
    <div class="mb-4">
        <p>Image below is just for testing, it will be replaced with QR code</p>
        <img src="https://randomqr.com/assets/images/randomqr-256.png" alt="QR Code">
    </div>
    
    <p class="mb-4">Scan the QR code below with your phone's authenticator app. Input the token to activate two factor authentication.</p>
    <form method="POST" action="{{ route('profile.update')}}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="token_2fa" class="block text-s font-semibold text-gray-600">2FA Token</label>
            <input type="text" name="token_2fa" id="token_2fa" placeholder="2FA token input here" class="w-full border px-2 py-1 text-s rounded-lg">
        </div>
        @error('token_2fa')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white uppercase text-s font-semibold px-6 py-2 rounded-lg">
                Enable
            </button>
        </div>
    </form>
    <p class="mb-4">
        <span class="font-semibold">Two Factor Authentication is currently enabled</span> 
        <br>If you want to disable two factor authentication, click the button below.
</p>
    <form method="POST" action="404">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <button type="submit" class="bg-red-500 text-white uppercase text-s font-semibold px-6 py-2 rounded-lg">
                Disable
            </button>
        </div>
    </form>
</div>