
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Selesai - PetCare</title>
</head>

<body style="margin:0; padding:20px; background-color:#fff7f0; font-family:Arial, Helvetica, sans-serif; color:#29231f;">

    <div style="max-width:600px; margin:30px auto; background-color:#ffffff; border-radius:14px; overflow:hidden; border:1px solid #f3e5d8;">

        {{-- Header --}}
        <div style="background-color:#f58220; color:#ffffff; padding:30px 20px; text-align:center;">

            <h2 style="margin:0; font-size:28px; font-weight:bold;">
                PetCare
            </h2>

            <p style="margin:10px 0 0; font-size:15px;">
                Pesanan Telah Selesai!
            </p>

        </div>

        {{-- Content --}}
        <div style="padding:30px 25px;">

            <h3 style="margin:0 0 15px; font-size:21px; color:#29231f;">
                Halo, {{ $transaction->customer->nama ?? 'Customer PetCare' }}!
            </h3>

            <p style="font-size:14px; line-height:1.7; color:#555555; margin:0;">
                Kami ingin menginformasikan bahwa transaksi kamu telah
                selesai. Terima kasih telah menggunakan layanan PetCare!
            </p>

            {{-- Transaction Information --}}
            <div style="background-color:#fff7f0; border:1px solid #ffe0c2; padding:20px; border-radius:10px; margin:25px 0;">

                <h4 style="margin:0 0 15px; color:#d96812; font-size:16px;">
                    Detail Transaksi
                </h4>

                <p style="margin:0 0 10px; font-size:14px;">
                    <strong>ID Transaksi:</strong>
                    #{{ $transaction->id_transaction }}
                </p>

                <p style="margin:0 0 10px; font-size:14px;">
                    <strong>Tanggal:</strong>
                    {{ $transaction->tanggal }}
                </p>

                <p style="margin:0; font-size:14px;">
                    <strong>Status:</strong>
                    <span style="display:inline-block; background-color:#fff0d9; color:#b85c00; padding:5px 12px; border-radius:20px; font-size:12px; font-weight:bold;">
                        Selesai
                    </span>
                </p>

            </div>

            {{-- Product Details --}}
            <h4 style="margin:0 0 15px; font-size:17px; color:#29231f;">
                Produk yang Dibeli
            </h4>

            <table width="100%" cellpadding="10" cellspacing="0"
                style="border-collapse:collapse; font-size:13px;">

                <thead>
                    <tr style="background-color:#fff2e6; color:#d96812;">
                        <th align="left" style="padding:12px 8px;">
                            Produk
                        </th>

                        <th align="center" style="padding:12px 8px;">
                            Jumlah
                        </th>

                        <th align="right" style="padding:12px 8px;">
                            Subtotal
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($transaction->details as $detail)

                        <tr style="border-bottom:1px solid #eeeeee;">

                            <td style="padding:12px 8px; color:#29231f;">
                                {{ $detail->product->nama_product ?? 'Produk' }}
                            </td>

                            <td align="center" style="padding:12px 8px; color:#555555;">
                                {{ $detail->jumlah }}
                            </td>

                            <td align="right" style="padding:12px 8px; color:#d96812; font-weight:bold;">
                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            {{-- Total --}}
            <div style="margin-top:22px; padding:18px; background-color:#fff7f0; border-radius:10px;">

                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="font-size:16px; font-weight:bold; color:#29231f;">
                            Total Pembayaran
                        </td>

                        <td align="right" style="font-size:18px; font-weight:bold; color:#f58220;">
                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
                        </td>
                    </tr>
                </table>

            </div>

            {{-- Completion Information --}}
            <div style="margin-top:25px; padding:20px; background-color:#fff7f0; border:1px solid #ffe0c2; border-radius:10px;">

                <h4 style="margin:0 0 10px; color:#d96812; font-size:16px;">
                    Transaksi Berhasil Diselesaikan!
                </h4>

                <p style="margin:0; font-size:14px; line-height:1.7; color:#555555;">
                    Pesanan kamu telah selesai diproses.
                    Semoga produk yang kamu beli bermanfaat
                    untuk hewan kesayanganmu.
                </p>

            </div>

            <p style="margin:25px 0 15px; font-size:14px; line-height:1.7; color:#555555;">
                Terima kasih sudah mempercayakan kebutuhan hewan peliharaan
                kamu kepada PetCare.
            </p>

            <p style="margin:0; text-align:center; color:#777777; font-size:14px; line-height:1.7;">
                Salam hangat,<br>
                <strong style="color:#d96812;">
                    Tim PetCare
                </strong>
            </p>

        </div>

        {{-- Footer --}}
        <div style="background-color:#fff7f0; border-top:1px solid #f3e5d8; padding:20px; text-align:center;">

            <p style="margin:0; color:#d96812; font-size:14px; font-weight:bold;">
                PetCare
            </p>

            <p style="margin:8px 0 0; color:#888888; font-size:12px;">
                Email ini dikirim otomatis oleh sistem PetCare.
                Mohon tidak membalas email ini.
            </p>

        </div>

    </div>

</body>
</html>