<div style="max-width: 32rem; margin: 2rem auto; padding: 1.5rem; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem;">
    @if (session()->has('message'))
        <div style="margin-bottom: 1rem; color: #22c55e;">{{ session('message') }}</div>
    @elseif (session()->has('error'))
        <div style="margin-bottom: 1rem; color: #c52235;">{{ session('error') }}</div>
    @endif

    <form style="display: grid; gap: 1rem;" wire:submit.prevent="Pesan">
        <div>
            <label for="namaPemesan" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4a5568;">Nama Pemesan</label>
            <input type="text" id="namaPemesan" placeholder="Nama Pemesan" required wire:model="namaPemesan"
                   style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d2d6dc; border-radius: 0.375rem; outline: none; transition: box-shadow 0.2s; focus: box-shadow 0 0 0 2px rgba(59, 130, 246, 0.5);">
            @error('namaPemesan') <span style="color: red; font-size: small">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="menus1" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4a5568;">Menu 1</label>
            <select id="menus1" required wire:model="menus1" wire:change="batas('1')"
                    style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d2d6dc; border-radius: 0.375rem; outline: none; transition: box-shadow 0.2s; focus: box-shadow 0 0 0 2px rgba(59, 130, 246, 0.5);">
                <option value="0">Pilih Menu 1</option>
                @foreach($menus as $menu)
                    @if($menu['id'] !=$menus2)
                        <option value="{{ $menu['id'] }}" @if($menu['stock'] < 1) disabled @endif>{{ $menu['nama_menu'] }} - {{ $menu['stock'] }}</option>
                    @endif
                @endforeach
            </select>
                @error('menus1') <span style="color: red; font-size: small">{{ $message }}</span> @enderror
        </div>

        @if ($menus1 != '0')
            <div>
                <label for="jp1" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4a5568;">Jumlah Pesanan 1</label>
                <input type="number" id="jp1" placeholder="Jumlah Pesanan 1" min="0" required wire:model="jp1" wire:change="calculateTotal"
                       style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d2d6dc; border-radius: 0.375rem; outline: none; transition: box-shadow 0.2s; focus: box-shadow 0 0 0 2px rgba(59, 130, 246, 0.5);">
                @error('jp1') <span style="color: red; font-size: small">{{ $message }}</span> @enderror
            </div>
        @endif

        <div>
            <label for="menus2" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4a5568;">Menu 2</label>
            <select id="menus2" wire:model="menus2" wire:change="batas('2')"
                    style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d2d6dc; border-radius: 0.375rem; outline: none; transition: box-shadow 0.2s; focus: box-shadow 0 0 0 2px rgba(59, 130, 246, 0.5);">
                <option value="0">Pilih Menu 2</option>
                @foreach($menus as $menu)
                    @if($menu['id'] !=$menus1)
                    <option value="{{ $menu['id'] }}" @if($menu['stock'] < 1) disabled @endif>{{ $menu['nama_menu'] }} - {{ $menu['stock'] }}</option>
                    @endif
                @endforeach
            </select>
            @error('menus2') <span style="color: red; font-size: small">{{ $message }}</span> @enderror
        </div>

        @if ($menus2 != '0')
            <div>
                <label for="jp2" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4a5568;">Jumlah Pesanan 2</label>
                <input type="number" id="jp2" placeholder="Jumlah Pesanan 2" min="0" required wire:model="jp2" wire:change="calculateTotal"
                       style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d2d6dc; border-radius: 0.375rem; outline: none; transition: box-shadow 0.2s; focus: box-shadow 0 0 0 2px rgba(59, 130, 246, 0.5);">
                @error('jp2') <span style="color: red; font-size: small">{{ $message }}</span> @enderror
            </div>
        @endif

        <div style="margin-top: 1.5rem;">
            <h3 style="font-weight: 600; font-size: 1.125rem;">Pesanan Anda:</h3>
            <p>
                Menu 1:
                @if ($menus1 && $menus->where('id', $menus1)->first())
                    {{ $menus->where('id', $menus1)->first()['nama_menu'] }} x {{ $jp1 }} = Rp. {{ $this->getMenuPrice($menus1,'1') * $jp1 }}
                @else
                    Pilih Menu 1 terlebih dahulu
                @endif
            </p>
            <p>
                Menu 2:
                @if ($menus2 && $menus->where('id', $menus2)->first())
                    {{ $menus->where('id', $menus2)->first()['nama_menu'] }} x {{ $jp2 }} = Rp. {{ $this->getMenuPrice($menus2,'2') * $jp2 }}
                @else
                    Pilih Menu 2 terlebih dahulu
                @endif
            </p>
            <p>Total: Rp. {{ $this->calculateTotal() }}</p>
        </div>

        <div>
            <label for="mode_pembayaran" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4a5568;">Metode Pembayaran</label>
            <select id="mode_pembayaran" required wire:model="mode_pembayaran"
                    style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d2d6dc; border-radius: 0.375rem; outline: none; transition: box-shadow 0.2s; focus: box-shadow 0 0 0 2px rgba(59, 130, 246, 0.5);">
                <option value="-">Pilih Pembayaran</option>
                @foreach($methods as $method)
                    <option value="{{ $method }}">{{ $method }}</option>
                @endforeach
            </select>
            @error('mode_pembayaran') <span style="color: red; font-size: small">{{ $message }}</span> @enderror
        </div>

        <div style="display: flex; align-items: center;">
            <input type="checkbox" id="verify" required style="margin-right: 0.5rem;">
            <label for="verify" style="font-size: 0.875rem; color: #4a5568;">Sudah verifikasi Pembayaran?</label>
        </div>
        <div >
            <label for="catatan" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4a5568;">Catatan (optional)</label>
            <textarea placeholder="Catatan...." wire:model="catatan" style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d2d6dc; border-radius: 0.375rem; outline: none; transition: box-shadow 0.2s; focus: box-shadow 0 0 0 2px rgba(59, 130, 246, 0.5);"></textarea>
        </div>
        <button type="submit"
                style="width: 100%; padding: 0.5rem 1rem; background-color: #3b82f6; color: white; font-weight: 600; border-radius: 0.375rem; transition: background-color 0.2s; border: none; cursor: pointer; outline: none; text-align: center;"
        >  Pesan
        </button>
    </form>
</div>
