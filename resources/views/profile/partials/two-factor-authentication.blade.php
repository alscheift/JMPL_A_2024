<div class="bg-white p-6 rounded-lg mb-6">
    <h2 class="text-lg font-bold mb-4">Two Factor Authentication</h2>

    @php
        
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
        $key = old('secret') ?? $google2fa->generateSecretKey();
        $inlineUrl = $google2fa->getQRCodeInline(
            auth()->user()->username,
            auth()->user()->email,
            $key
        );
    @endphp
    <!-- Image -->

    @if(!auth()->user()->is_two_factor_enabled)

    <div class="mb-4">
        {!! $inlineUrl !!}
    </div>
    
    <p class="mb-4">Scan the QR code below with your phone's authenticator app. Input the token to activate two factor authentication.</p>
    <form method="POST" action="{{ route('2fa.enable')}}">
        @csrf
        <input type="hidden" name="secret" value="{{ $key }}">

        <div class="mb-2">
            <label for="token_2fa" class="block text-s font-semibold text-gray-600">2FA Token</label>
            <input type="text" name="token_2fa" id="token_2fa" placeholder="2FA token input here" class="w-full border px-2 py-1 text-s rounded-lg">
        </div>
        @error('token_2fa')
            <p class="text-red-500 text-xs mb-4">{{ $message }}</p>
        @enderror

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white uppercase text-s font-semibold px-6 py-2 rounded-lg">
                Enable
            </button>
        </div>
    </form>
    @else
    <p class="mb-4">
        <span class="font-semibold">Two Factor Authentication is currently enabled</span> 
        <br>If you want to disable two factor authentication, click the button below.
    </p>
    <form method="POST" action="{{ route('2fa.disable') }}">
        @csrf
        <div class="mb-4">
            <button type="submit" class="bg-red-500 text-white uppercase text-s font-semibold px-6 py-2 rounded-lg">
                Disable
            </button>
        </div>
    </form>
    @endif
</div>