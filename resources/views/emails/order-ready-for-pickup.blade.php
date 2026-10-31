
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Siap Diambil</title>
</head>

<body style="margin:0; padding:0; background:#f5f7fa; font-family:Arial, sans-serif; color:#333;">

    <div style="max-width:600px; margin:30px auto; background:#ffffff; border-radius:12px; overflow:hidden;">

        <!-- Header -->
        <div style="background:#198754; color:white; padding:25px; text-align:center;">

            <h2 style="margin:0;">
                PetCare
            </h2>

            <p style="margin:8px 0 0;">
                Pesanan siap diambil
            </p>

        </div>

        <!-- Konten Email -->
        <div style="padding:30px;">

            <h3>
                Halo, {{ $transaction->customer->nama ?? 'Pelanggan PetCare' }}!
            </h3>

            <p>
                Kabar baik! Pesanan kamu sudah selesai disiapkan
                dan sekarang bisa diambil di petshop.
            </p>

            <!-- Informasi Transaksi -->
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
                    <span style="color:#198754; font-weight:bold;">
                        {{ $transaction->status }}
                    </span>
                </p>

            </div>

            <!-- Detail Produk -->
            <h4 style="margin-bottom:10px;">
                Detail Pesanan
            </h4>

            @foreach($transaction->details as $detail)

                <div style="padding:12px 0; border-bottom:1px solid #eee;">

                    <div>
                        <strong>
                            {{ $detail->product->nama_product ?? 'Produk PetCare' }}
                        </strong>
                    </div>

                    <div style="color:#666; margin-top:5px;">
                        {{ $detail->jumlah }} ×
                        Rp {{ number_format($detail->harga, 0, ',', '.') }}
                    </div>

                    <div style="margin-top:5px; font-weight:bold;">
                        Subtotal:
                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                    </div>

                </div>

            @endforeach

            <!-- Total Pembayaran -->
            <div style="margin-top:20px; padding:15px; background:#f8f9fa; border-radius:10px;">

                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="font-size:18px; font-weight:bold;">
                            Total
                        </td>

                        <td style="font-size:18px; font-weight:bold; color:#198754; text-align:right;">
                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
                        </td>
                    </tr>
                </table>

            </div>

            <!-- Informasi Pengambilan -->
            <div style="margin-top:25px; padding:15px; background:#e8f5e9; border-radius:10px;">

                <h4 style="margin:0 0 10px; color:#198754;">
                    Pesanan Siap Diambil!
                </h4>

                <p style="margin:0;">
                    Silakan datang ke petshop untuk mengambil pesanan kamu.
                    Tunjukkan ID transaksi
                    <strong>#{{ $transaction->id_transaction }}</strong>
                    kepada petugas saat pengambilan.
                </p>

            </div>

            <p style="margin-top:25px;">
                Jika ada pertanyaan, silakan hubungi pihak petshop.
            </p>

            <p>
                Terima kasih telah berbelanja di PetCare!
            </p>

        </div>

        <!-- Footer -->
        <div style="background:#f8f9fa; padding:20px; text-align:center; color:#777; font-size:13px;">

            Email ini dikirim otomatis oleh sistem PetCare.

        </div>

    </div>

</body>
</html>
