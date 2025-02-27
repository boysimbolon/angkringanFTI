<div style="max-width: 32rem; margin: 2rem auto; padding: 1.5rem; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem;">
    <form wire:submit.prevent="create" style="display: grid; gap: 1rem;">
        <div>
            <label for="Menu" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4a5568;">Nama Menu</label>
            <input type="text" id="Menu" placeholder="Menu" required wire:model="menu"
                   style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d2d6dc; border-radius: 0.375rem; outline: none; box-shadow: none; transition: box-shadow 0.2s; focus: box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);">
        </div>
        <div>
            <label for="stok" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4a5568;">Stock</label>
            <input type="number" id="stok" placeholder="Stock" required wire:model="stok"
                   style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d2d6dc; border-radius: 0.375rem; outline: none; box-shadow: none; transition: box-shadow 0.2s; focus: box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);">
        </div>
        <div>
            <label for="harga" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4a5568;">Harga</label>
            <input type="text" id="harga" placeholder="harga" required wire:model="harga"
                   style="margin-top: 0.25rem; display: block; width: 100%; padding: 0.5rem; border: 1px solid #d2d6dc; border-radius: 0.375rem; outline: none; box-shadow: none; transition: box-shadow 0.2s; focus: box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);">
        </div>
        <div style="display: flex; align-items: center;">
            <input type="checkbox" id="verify" required style="margin-right: 0.5rem;">
            <label for="verify" style="font-size: 0.875rem; color: #4a5568;">Yakin Menambah Menu?</label>
        </div>

        <button type="submit"
                style="width: 100%; padding: 0.5rem 1rem; background-color: #3b82f6; color: white; font-weight: 600; border-radius: 0.375rem; transition: background-color 0.2s; border: none; cursor: pointer; outline: none; box-shadow: none; text-align: center;"
                onmouseover="this.style.backgroundColor='#2563eb'" onmouseout="this.style.backgroundColor='#3b82f6'">
            Pesan
        </button>
    </form>
    <script>
        document.title = "Jualan FTI | Create Menu";
    </script>
</div>

