<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kartu</title>
</head>
<body>
    <section style="border : 1px solid #fff">
<table width="100%">
    @foreach ($dataMmmber as $key =>$data )
        <tr>
            @foreach ($data as $item )
                <td class="text-center" with="50%">
                    <div class="box">
                        <img src="{{ asset('/public/image/kartuprakerja.png') }}" alt="card">
                        <div class="logo">
                            <p>{{ config('app.name') }}</p>
                            <img src="{{ asset('/public/image/logo.png') }}" alt="logo">
                        </div>
                        <div class="namaCustomer">{{ $item->namaCustomer }}</div>
                        <div class="telepon">{{ $item->noTelepon }}</div>
                        <div class="barcode text-left">
                            <img src="data:img/png;base64, {{ DNS2D::getBarcodePNG("$item->kode_member",
                                'QRCODE') }}" alt="qrcode" height="45" width="45">
                        </div>
                    </div>
                </td>
            @endforeach
        </tr>
    @endforeach
</table>
</section>
</body>
</html>
