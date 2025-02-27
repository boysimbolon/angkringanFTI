<div style="width: fit-content;height: fit-content;margin: auto ;background-color: gainsboro; padding: 40px;">
    <!-- Session Status -->

    <div style="text-align: center; margin-bottom: 1.25rem;">
        <h1 style="font-weight: bold; font-size: 1.5rem; margin-bottom: 0.25rem;">Himpunan Mahasiswa Teknologi Informasi</h1>
        <h3 style="font-weight: 300; font-size: 1.125rem; margin-bottom: 0.25rem;">Universitas Advent Indonesia</h3>
        @if (session()->has('message'))
            <div style="width: 100%; background-color: #16a34a; padding: 0.5rem; border-radius: 0.375rem; color: white;">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <form wire:submit.prevent="verify"> <!-- Gunakan wire:submit.prevent -->
        @csrf
        <!-- NIM -->
        <div>
            <label for="nim" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">NIM</label>
            <input
                wire:model="nim"
                id="nim"
                style="display: block; margin-top: 0.25rem; width: 100%;"
                type="text"
                name="nim"
                placeholder="NIM"
                inputmode="numeric"
                required
                autofocus
                autocomplete="off"
            />
            @error('nim') <span style="color: red; font-size: small">{{ $message }}</span> @enderror
        </div>

        <!-- PIN -->
        <div style="margin-top: 1rem;">
            <label for="pin" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Password</label>
            <input
                wire:model="pin"
                id="pin"
                style="display: block; margin-top: 0.25rem; width: 100%;"
                type="password"
                name="pin"
                placeholder="Password"
                required
                autocomplete="current-password"
            />
            @error('pin') <span style="color: red; font-size: small">{{ $message }}</span> @enderror
        </div>

        <!-- Forgot Password & Log In -->
        <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 0.5rem; margin-top: 2rem;">
            <button type="submit" style="width: 100%; padding: 0.75rem; text-align: center; background-color: #4B5563; color: white; border-radius: 0.375rem;">
                Login
            </button>
        </div>
    </form>
</div>
