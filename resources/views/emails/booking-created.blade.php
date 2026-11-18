<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Berhasil - PetCare</title>
</head>

<body style="margin:0; padding:20px; background-color:#fff7f0; font-family:Arial, Helvetica, sans-serif; color:#29231f;">

    <div style="max-width:600px; margin:30px auto; background-color:#ffffff; border-radius:14px; overflow:hidden; border:1px solid #f3e5d8;">

        {{-- Header --}}
        <div style="background-color:#f58220; padding:30px 20px; text-align:center; color:#ffffff;">

            <h1 style="margin:0; font-size:28px; font-weight:bold;">
                PetCare
            </h1>

            <p style="margin:10px 0 0; font-size:15px;">
                Layanan Terbaik untuk Hewan Kesayangan
            </p>

        </div>

        {{-- Content --}}
        <div style="padding:30px 25px;">

            <h2 style="color:#d96812; margin:0 0 20px; font-size:21px;">
                Booking Berhasil Dibuat!
            </h2>

            <p style="font-size:14px; line-height:1.7; color:#555555;">
                Halo, <strong style="color:#29231f;">{{ $booking->customer->nama }}</strong>.
            </p>

            <p style="font-size:14px; line-height:1.7; color:#555555;">
                Booking grooming kamu berhasil dibuat dan saat ini
                sedang menunggu konfirmasi dari admin PetCare.
                Terima kasih telah memilih layanan kami!
            </p>

            {{-- Booking Information --}}
            <div style="background-color:#fff7f0; border:1px solid #ffe0c2; border-radius:10px; padding:20px; margin:25px 0;">

                <h3 style="margin:0 0 18px; color:#d96812; font-size:17px;">
                    Detail Booking
                </h3>

                <p style="margin:0 0 12px; font-size:14px;">
                    <strong>ID Booking:</strong>
                    #{{ $booking->id_booking }}
                </p>

                <p style="margin:0 0 12px; font-size:14px;">
                    <strong>Nama Hewan:</strong>
                    {{ $booking->pet->nama_pet ?? '-' }}
                </p>

                <p style="margin:0 0 12px; font-size:14px;">
                    <strong>Jenis Hewan:</strong>
                    {{ $booking->pet->jenis ?? '-' }}
                </p>

                <p style="margin:0 0 12px; font-size:14px;">
                    <strong>Layanan:</strong>
                    {{ $booking->service->nama_service ?? '-' }}
                </p>

                <p style="margin:0 0 12px; font-size:14px;">
                    <strong>Harga:</strong>
                    <span style="color:#d96812; font-weight:bold;">
                        Rp {{ number_format($booking->service->harga ?? 0, 0, ',', '.') }}
                    </span>
                </p>

                <p style="margin:0 0 12px; font-size:14px;">
                    <strong>Tanggal:</strong>
                    {{ $booking->tanggal_booking->format('d/m/Y') }}
                </p>

                <p style="margin:0 0 12px; font-size:14px;">
                    <strong>Jam:</strong>
                    {{ \Carbon\Carbon::parse($booking->jam_booking)->format('H:i') }}
                </p>

                <p style="margin:0 0 12px; font-size:14px;">
                    <strong>Status:</strong>
                    <span style="display:inline-block; background-color:#fff0d9; color:#b85c00; padding:5px 12px; border-radius:20px; font-size:12px; font-weight:bold;">
                        Menunggu
                    </span>
                </p>

                @if($booking->catatan)
                    <div style="margin-top:15px; padding:12px; background-color:#ffffff; border-radius:8px; border:1px solid #ffe0c2;">

                        <p style="margin:0 0 5px; font-size:14px; font-weight:bold; color:#d96812;">
                            Catatan:
                        </p>

                        <p style="margin:0; font-size:14px; line-height:1.6; color:#555555;">
                            {{ $booking->catatan }}
                        </p>

                    </div>
                @endif

            </div>

            {{-- Information --}}
            <div style="background-color:#fff7f0; border:1px solid #ffe0c2; border-radius:10px; padding:18px; margin-top:25px;">

                <h4 style="margin:0 0 10px; color:#d96812; font-size:16px;">
                    Menunggu Konfirmasi Admin
                </h4>

                <p style="margin:0; font-size:14px; line-height:1.7; color:#555555;">
                    Booking kamu sudah berhasil tercatat di sistem.
                    Mohon menunggu informasi selanjutnya melalui email
                    ini setelah admin PetCare melakukan konfirmasi.
                </p>

            </div>

            <p style="margin:25px 0 15px; font-size:14px; line-height:1.7; color:#555555;">
                Terima kasih telah mempercayakan perawatan hewan
                kesayanganmu kepada PetCare.
            </p>

            <p style="margin:0; font-size:14px; line-height:1.7; color:#777777;">
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
                &copy; {{ date('Y') }} PetCare. All rights reserved.
            </p>

            <p style="margin:5px 0 0; color:#888888; font-size:12px;">
                Email ini dikirim otomatis oleh sistem PetCare.
            </p>

        </div>

    </div>

</body>
</html>
