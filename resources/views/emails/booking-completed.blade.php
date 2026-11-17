
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Grooming Selesai</title>
</head>
<body style="margin: 0; padding: 30px 15px; background-color: #f5f5f5; font-family: Arial, sans-serif;">

    <div style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 12px; overflow: hidden;">

        <div style="background-color: #ff922b; padding: 25px; text-align: center; color: white;">
            <h2 style="margin: 0;">Galaxy Petshop</h2>
            <p style="margin: 8px 0 0;">Layanan Grooming</p>
        </div>

        <div style="padding: 30px; color: #333;">

            <h2 style="color: #28a745; margin-top: 0;">
                Booking Grooming Selesai!
            </h2>

            <p>
                Halo <strong>{{ $booking->customer->nama ?? 'Customer' }}</strong>,
            </p>

            <p>
                Kami ingin menginformasikan bahwa proses grooming
                hewan peliharaan Anda telah selesai.
            </p>

            <div style="background: #fff7ed; padding: 20px; border-radius: 10px; margin: 20px 0;">

                <h3 style="margin-top: 0; color: #754016;">
                    Detail Booking
                </h3>

                <p>
                    <strong>Nama Hewan:</strong>
                    {{ $booking->pet->nama_pet ?? '-' }}
                </p>

                <p>
                    <strong>Layanan:</strong>
                    {{ $booking->service->nama_service ?? '-' }}
                </p>

                <p>
                    <strong>Tanggal:</strong>
                    {{ $booking->tanggal_booking?->format('d/m/Y') ?? '-' }}
                </p>

                <p>
                    <strong>Jam:</strong>
                    {{ $booking->jam_booking
                        ? \Carbon\Carbon::parse($booking->jam_booking)->format('H:i')
                        : '-' }}
                </p>

                <p style="margin-bottom: 0;">
                    <strong>Status:</strong>
                    <span style="color: #198754; font-weight: bold;">
                        Selesai
                    </span>
                </p>

            </div>

            <p>
                Terima kasih telah mempercayakan perawatan hewan
                kesayangan Anda kepada Galaxy Petshop.
            </p>

            <p>
                Salam hangat,<br>
                <strong>Tim Galaxy Petshop</strong>
            </p>

        </div>

        <div style="background: #f8f9fa; padding: 15px; text-align: center; color: #888; font-size: 12px;">
            Email ini dikirim secara otomatis oleh sistem Galaxy Petshop.
        </div>

    </div>

</body>
</html>
