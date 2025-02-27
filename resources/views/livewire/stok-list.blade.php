<div>
    <div style="height: 100vh; display: flex; justify-content: space-between; " class="div">
    @foreach($menus as $men)
        <div style="flex: 1; text-align: center; background-color: #93c5fd; display: flex; flex-direction: column; justify-content: center; align-items: center; margin: 0 3px;">
            <h3 >{{$men['menu']}}</h3>
            <h3 style="color: #dc2626;">{{$men['jumlah']}}</h3>
        </div>
    @endforeach
        <style>
            @media (min-width: 850px) {
                /* Untuk laptop dan layar yang lebih besar */
                .div {
                    padding: 8px;
                    gap: 8px;
                    flex-direction: row; /* Mengubah menjadi flex-row pada layar lebar */
                }
                h3{
                    font-size: 9rem;
                }
            }
            @media (min-width: 300px) and (max-width: 500px) {
                .div {
                    flex-direction: column;
                }

                h3 {
                    font-size: 3rem;
                }
            }
            @media (min-width: 501px) and (max-width: 840px) {
                .div {
                    padding: 4px;
                    gap: 4px;
                    flex-direction: row; /* Mengubah menjadi flex-row pada layar lebar */
                }

                h3 {
                    font-size: 4rem;
                }
            }
        </style>
        <script>
            document.title = "Jualan FTI | Dashboard";
            setInterval(function(){
            @this.call('datas');
            }, 1000);
        </script>
</div>
</div>

