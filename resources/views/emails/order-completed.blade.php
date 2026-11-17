
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pesanan Selesai - PetCare</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 30px; border-radius: 10px;">

        <h2 style="color: #198754; text-align: center;">
            Pesanan Telah Selesai!
        </h2>

        <p>Halo, {{ $transaction->customer->nama ?? 'Customer PetCare' }}.</p>

        <p>
            Kami ingin menginformasikan bahwa transaksi kamu telah
            selesai. Terima kasih telah menggunakan layanan PetCare!
        </p>

        <hr>

        <h3>Detail Transaksi</h3>

        <p>
            <strong>ID Transaksi:</strong>
            #{{ $transaction->id_transaction }}
        </p>

        <p>
            <strong>Tanggal:</strong>
            {{ $transaction->tanggal }}
        </p>

        <p>
            <strong>Status:</strong>
            <span style="color: #198754; font-weight: bold;">
                Selesai
            </span>
        </p>

        <h3>Produk yang Dibeli</h3>

        <table width="100%" cellpadding="8" cellspacing="0"
            style="border-collapse: collapse;">

            <thead>
                <tr style="background: #f1f1f1;">
                    <th align="left">Produk</th>
                    <th align="center">Jumlah</th>
                    <th align="right">Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($transaction->details as $detail)
                    <tr>
                        <td>
                            {{ $detail->product->nama_product ?? 'Produk' }}
                        </td>

                        <td align="center">
                            {{ $detail->jumlah }}
                        </td>

                        <td align="right">
                            Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr>

        <h3 style="text-align: right;">
            Total: Rp{{ number_format($transaction->total, 0, ',', '.') }}
        </h3>

        <p>
            Terima kasih sudah mempercayakan kebutuhan hewan peliharaan
            kamu kepada PetCare.
        </p>

        <p style="text-align: center; color: #777;">
            Salam hangat,<br>
            <strong>Tim PetCare</strong>
        </p>

    </div>

</body>
</html>
