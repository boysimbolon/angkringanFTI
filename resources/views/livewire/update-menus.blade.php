<div>
    <div style="margin-bottom: 1rem; color: #22c55e;">{{ session('message') }}</div>
    @if(request()->routeIs('edit-menu'))
        <div style="max-width: 32rem; margin: 2rem auto; padding: 1.5rem; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem;">
            <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">Edit Menu</h2>

            <form wire:submit.prevent="updateMenu" style="margin-top: 1rem;">
                <div>
                    <label for="menu" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563;">Menu</label>
                    <input type="text" id="menu" wire:model="menu" style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; outline: none; transition: ring 0.2s;">
                </div>

                <div>
                    <label for="harga" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563;">Harga</label>
                    <input type="number" min="0" id="harga" wire:model="harga" style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; outline: none; transition: ring 0.2s;">
                </div>

                <button type="submit" style="width: 100%; padding: 0.5rem 1rem; background-color: #2563eb; color: white; font-weight: 600; border-radius: 0.375rem; transition: background-color 0.2s; margin-top: 1rem;">Update Menu</button>
            </form>
        </div>
    @endif
    @if(request()->routeIs('tambah'))
        <div style="max-width: 32rem; margin: 2rem auto; padding: 1.5rem; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem;">
            <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">Edit Menu</h2>

            <form wire:submit.prevent="updateMenu" style="margin-top: 1rem;">
                <div>
                    <label for="menu" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563;">Menu</label>
                    <span style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color: #f9fafb;">{{$menu}}</span>
                </div>

                <div>
                    <label for="harga" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563;">Harga</label>
                    <span style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color: #f9fafb;">{{$harga}}</span>
                </div>

                <div>
                    <label for="stok" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563;">Stok</label>
                    <input type="number" min="0" id="stok" wire:model="tambahan" style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; outline: none; transition: ring 0.2s;">
                </div>

                <button type="submit" style="width: 100%; padding: 0.5rem 1rem; background-color: #2563eb; color: white; font-weight: 600; border-radius: 0.375rem; transition: background-color 0.2s; margin-top: 1rem;">Update Menu</button>
            </form>
        </div>
    @endif
    <script>
        document.title = "Jualan FTI | Update Menu";
    </script>
</div>
