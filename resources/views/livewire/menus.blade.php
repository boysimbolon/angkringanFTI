<div style="max-width: 1000px; margin: 20px auto; padding: 24px; background-color: white; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); border-radius: 8px;">
    <a href="{{ route('create-menu') }}" style="display: inline-block; margin-bottom: 16px; color: #2563eb; text-decoration: underline;">Create</a>
    <div style="margin-bottom: 16px; color: #16a34a;">
        {{ session('message') }}
    </div>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <thead style="background-color: #f9fafb;">
            <tr>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Menu</th>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Harga</th>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Stok</th>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Edit</th>
                <th style="padding: 12px 24px; text-align: left; font-size: 12px; font-weight: 500; color: #6b7280; text-transform: uppercase;">Tambah Stock</th>
            </tr>
            </thead>
            <tbody style="background-color: white;">
            @foreach($menus as $menu)
                <tr style="border-top: 1px solid #e5e7eb;">
                    <td style="padding: 12px 24px; white-space: nowrap;">{{ $menu['menu'] }}</td>
                    <td style="padding: 12px 24px; white-space: nowrap;">{{ $menu['harga'] }}</td>
                    <td style="padding: 12px 24px; white-space: nowrap;">{{ $menu['stok'] }}</td>
                    <td style="padding: 12px 24px; white-space: nowrap;">
                        <a href="{{ route('edit-menu', $menu['id']) }}" style="color: #2563eb; text-decoration: underline;">Edit</a>
                    </td>
                    <td style="padding: 12px 24px; white-space: nowrap;">
                        <a href="{{ route('tambah', $menu['id']) }}" style="color: #2563eb; text-decoration: underline;">Tambah Stok</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        document.title = "Jualan FTI | Menus";
    </script>
</div>
