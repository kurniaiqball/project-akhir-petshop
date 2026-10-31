<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Pesanan Berhasil</title>
</head>

<body style="margin:0; padding:0; background:#f5f7fa; font-family:Arial, sans-serif;">

    <div style="max-width:600px; margin:30px auto; background:#ffffff; border-radius:12px; overflow:hidden;">

        <div style="background:#198754; color:white; padding:25px; text-align:center;">

            <h2 style="margin:0;">
                PetCare
            </h2>

            <p style="margin:8px 0 0;">
                Pesanan berhasil dibuat
            </p>

        </div>

        <div style="padding:30px;">

            <h3>
                Halo, {{ $transaction->customer->nama }}!
            </h3>

            <p>
                Terima kasih telah melakukan pemesanan di PetCare.
                Pesanan kamu berhasil dibuat dan sedang menunggu proses dari admin.
            </p>

            <div style="background:#f8f9fa; padding:20px; border-radius:10px; margin:20px 0;">

                <p style="margin:0 0 10px;">
                    <strong>ID Transaksi:</strong>
                    #{{ $transaction->id_transaction }}
                </p>

                <p style="margin:0 0 10px;">
                    <strong>Tanggal:</strong>
                    {{ $transaction->tanggal->format('d/m/Y H:i') }}
                </p>

                <p style="margin:0;">
                    <strong>Status:</strong>
                    {{ $transaction->status }}
                </p>

            </div>

            <h4>
                Detail Pesanan
            </h4>

            @foreach($transaction->details as $detail)

                <div style="padding:12px 0; border-bottom:1px solid #eee;">

                    <div>
                        <strong>
                            {{ $detail->product->nama_product }}
                        </strong>
                    </div>

                    <div style="color:#666; margin-top:5px;">
                        {{ $detail->jumlah }} ×
                        Rp {{ number_format($detail->harga, 0, ',', '.') }}
                    </div>

                    <div style="margin-top:5px;">
                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                    </div>

                </div>

            @endforeach

            <div style="display:flex; justify-content:space-between; margin-top:20px; font-size:18px;">

                <strong>
                    Total
                </strong>

                <strong style="color:#198754;">
                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                </strong>

            </div>

            <p style="margin-top:30px;">
                Silakan cek halaman transaksi di website PetCare
                untuk melihat perkembangan pesanan kamu.
            </p>

            <p>
                Terima kasih telah menggunakan layanan PetCare.
            </p>

        </div>

        <div style="background:#f8f9fa; padding:20px; text-align:center; color:#777; font-size:13px;">

            Email ini dikirim otomatis oleh sistem PetCare.

        </div>

    </div>

</body>
</html>