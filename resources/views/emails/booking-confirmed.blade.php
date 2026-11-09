
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Dikonfirmasi - PetCare</title>
</head>
<body style="margin:0; padding:0; background:#f4f6f9; font-family:Arial,sans-serif; color:#333;">

    <div style="max-width:600px; margin:30px auto; background:#ffffff; border-radius:12px; overflow:hidden;">

        <div style="background:#198754; padding:25px; text-align:center; color:white;">
            <h1 style="margin:0; font-size:26px;">PetCare</h1>
            <p style="margin:8px 0 0;">Layanan Terbaik untuk Hewan Kesayangan</p>
        </div>

        <div style="padding:30px;">
            <h2 style="color:#198754; margin-top:0;">
                Booking Berhasil Dikonfirmasi!
            </h2>

            <p>Halo, <strong>{{ $booking->customer->nama }}</strong>.</p>

            <p>
                Kabar baik! Booking grooming kamu telah dikonfirmasi
                oleh admin PetCare.
            </p>

            <div style="background:#f8f9fa; border:1px solid #e9ecef; border-radius:8px; padding:20px; margin:20px 0;">
                <h3 style="margin-top:0;">Detail Booking</h3>

                <p><strong>ID Booking:</strong> #{{ $booking->id_booking }}</p>
                <p><strong>Nama Hewan:</strong> {{ $booking->pet->nama_pet ?? '-' }}</p>
                <p><strong>Jenis Hewan:</strong> {{ $booking->pet->jenis ?? '-' }}</p>
                <p><strong>Layanan:</strong> {{ $booking->service->nama_service ?? '-' }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($booking->service->harga ?? 0, 0, ',', '.') }}</p>
                <p><strong>Tanggal:</strong> {{ $booking->tanggal_booking->format('d/m/Y') }}</p>
                <p><strong>Jam:</strong> {{ \Carbon\Carbon::parse($booking->jam_booking)->format('H:i') }}</p>
                <p><strong>Status:</strong> Dikonfirmasi</p>

                @if($booking->catatan)
                    <p><strong>Catatan:</strong> {{ $booking->catatan }}</p>
                @endif
            </div>

            <p>
                Silakan datang sesuai jadwal booking yang telah dikonfirmasi.
                Jika ada perubahan jadwal, silakan hubungi pihak PetCare.
            </p>

            <p style="margin-bottom:0;">
                Terima kasih telah memilih PetCare.<br>
                <strong>Tim PetCare</strong>
            </p>
        </div>

        <div style="background:#f8f9fa; padding:18px; text-align:center; color:#777; font-size:12px;">
            &copy; {{ date('Y') }} PetCare. All rights reserved.
        </div>

    </div>

</body>
</html>
