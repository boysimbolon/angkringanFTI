<div style="max-width: 1000px; margin: 20px auto; padding: 24px; background-color: white; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); border-radius: 8px;">
    <div style="margin-bottom: 16px; color: #16a34a;">
        {{ session('message') }}
    </div>
    <div style="display: flex; justify-content: space-between">
        <input type="search" name="search" id="search" class="border-gray-500 rounded w-1/4" placeholder="Cari Pemesan...">
        <span wire:click="export" style="width: fit-content; padding: 5px; border-radius: 10px;background-color: #6d6dca; color:white; place-content: center; cursor: pointer;">
            Download
        </span>
    </div>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <thead style="background-color: #f9fafb;">
            <tr>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Nama Pemesan</th>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Menu 1</th>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Jumlah 1</th>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Menu 2</th>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Jumlah 2</th>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Total</th>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase">Catatan</th>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Status</th>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Update</th>
            </tr>
            </thead>
            <tbody style="background-color: white;">
            @foreach($pesanans as $pesan)
                <tr style="border-top: 1px solid #e5e7eb;">
                    <td style="padding: 12px 24px; white-space: nowrap;" class="name">{{ $pesan['nama_pemesan'] }}</td>
                    <td style="padding: 12px 24px; white-space: nowrap;">{{ $pesan['menu1'] }}</td>
                    <td style="padding: 12px 24px; white-space: nowrap;">{{ $pesan['jumlah1'] }}</td>
                    <td style="padding: 12px 24px; white-space: nowrap;">{{ $pesan['menu2'] }}</td>
                    <td style="padding: 12px 24px; white-space: nowrap;">{{ $pesan['jumlah2'] }}</td>
                    <td style="padding: 12px 24px; white-space: nowrap;">{{ $pesan['total_harga'] }}</td>
                    <td style=" width: 80px">{{ $pesan['catatan'] }}</td>
                    <td style="padding: 12px 24px; white-space: nowrap;">
                        @if($pesan['status'] == 0)
                            <span style="color: #ef4444;">Belum Diterima</span>
                        @else
                            <span style="color: #16a34a;">Diterima</span>
                        @endif
                    </td>
                    <td style="padding: 12px 24px; white-space: nowrap;">
                        @if($pesan['status'] == 0)
                            <div wire:click="update({{ $pesan['id'] }})" style="background-color: #ef4444; color: white; padding: 8px 16px; border-radius: 4px; cursor: pointer;">Konfirmasi</div>
                        @else
                            <span style="background-color: #16a34a; color: white; padding: 8px 16px; border-radius: 4px;">Diterima</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr id="noResults" style="display: none;">
                <td colspan="8" style="padding: 12px 24px; text-align: center;">Tidak ada hasil yang ditemukan.</td>
            </tr>
            </tbody>
        </table>
    </div>
    <script>
        document.title = "Jualan FTI | List Pesanan";
        setInterval(function(){
        @this.call('datas');
        }, 5000);
        document.getElementById('search').addEventListener('input', function (e) {
            const filter = this.value.toLowerCase();
            const items = document.getElementsByClassName('name');
            let hasResults = false;

            for (let item of items) {
                if (item.textContent.toLowerCase().includes(filter)) {
                    item.closest('tr').style.display = ''; // Tampilkan baris yang cocok
                    hasResults = true; // Ada hasil yang ditemukan
                } else {
                    item.closest('tr').style.display = 'none'; // Sembunyikan baris yang tidak cocok
                }
            }

            document.getElementById('noResults').style.display = hasResults ? 'none' : 'table-row';
        });
    </script>

</div>
