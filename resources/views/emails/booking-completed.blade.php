
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Grooming Selesai - PetCare</title>
</head>

<body style="margin: 0; padding: 30px 15px; background-color: #fff7f0; font-family: Arial, sans-serif; color: #333;">

    <div style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 14px; overflow: hidden; border: 1px solid #f3e5d8;">

        <!-- Header -->
        <div style="background-color: #f58220; padding: 28px 25px; text-align: center; color: white;">

            <h2 style="margin: 0; font-size: 26px; font-weight: bold;">
                PetCare
            </h2>

            <p style="margin: 8px 0 0; font-size: 14px;">
                Layanan Grooming
            </p>

        </div>

        <!-- Content -->
        <div style="padding: 30px; color: #333;">

            <h2 style="color: #f58220; margin-top: 0; margin-bottom: 20px; font-size: 22px;">
                Booking Grooming Selesai!
            </h2>

            <p style="font-size: 14px; line-height: 1.7;">
                Halo <strong>{{ $booking->customer->nama ?? 'Customer PetCare' }}</strong>,
            </p>

            <p style="font-size: 14px; line-height: 1.7;">
                Kami ingin menginformasikan bahwa proses grooming
                hewan peliharaan Anda telah selesai.
            </p>

            <!-- Booking Details -->
            <div style="background: #fff7f0; padding: 22px; border-radius: 10px; margin: 22px 0; border: 1px solid #f9dfc8;">

                <h3 style="margin-top: 0; margin-bottom: 18px; color: #d96812; font-size: 17px;">
                    Detail Booking
                </h3>

                <p style="margin: 10px 0; font-size: 14px;">
                    <strong>ID Booking:</strong>
                    #{{ $booking->id_booking }}
                </p>

                <p style="margin: 10px 0; font-size: 14px;">
                    <strong>Nama Hewan:</strong>
                    {{ $booking->pet->nama_pet ?? '-' }}
                </p>

                <p style="margin: 10px 0; font-size: 14px;">
                    <strong>Layanan:</strong>
                    {{ $booking->service->nama_service ?? '-' }}
                </p>

                <p style="margin: 10px 0; font-size: 14px;">
                    <strong>Tanggal:</strong>
                    {{ $booking->tanggal_booking?->format('d/m/Y') ?? '-' }}
                </p>

                <p style="margin: 10px 0; font-size: 14px;">
                    <strong>Jam:</strong>
                    {{ $booking->jam_booking
                        ? \Carbon\Carbon::parse($booking->jam_booking)->format('H:i')
                        : '-' }}
                </p>

                <p style="margin: 10px 0 0; font-size: 14px;">
                    <strong>Status:</strong>

                    <span style="display: inline-block; background: #e8f5ed; color: #198754; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                        Selesai
                    </span>
                </p>

            </div>

            <!-- Information -->
            <div style="background: #fffaf5; border-left: 4px solid #f58220; padding: 15px; margin: 22px 0; border-radius: 5px;">

                <p style="margin: 0; font-size: 14px; line-height: 1.7; color: #555;">
                    Terima kasih telah mempercayakan perawatan hewan kesayangan Anda kepada PetCare. Semoga hewan peliharaan Anda selalu sehat dan nyaman!
                </p>

            </div>

            <p style="font-size: 14px; line-height: 1.7;">
                Salam hangat,<br>
                <strong style="color: #f58220;">Tim PetCare</strong>
            </p>

        </div>

        <!-- Footer -->
        <div style="background: #fff7f0; padding: 18px 15px; text-align: center; color: #999; font-size: 12px; border-top: 1px solid #f3e5d8;">

            <p style="margin: 0 0 5px;">
                Email ini dikirim secara otomatis oleh sistem PetCare.
            </p>

            <p style="margin: 0;">
                &copy; {{ date('Y') }} PetCare. All rights reserved.
            </p>

        </div>

    </div>

</body>
</html>
