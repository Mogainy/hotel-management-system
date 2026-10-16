<?php

require '../config/db.php';
include '../libraries/phpqrcode/qrlib.php';

$locations = mysqli_query(
    $conn,
    "SELECT * FROM locations"
);

while($location = mysqli_fetch_assoc($locations)){

    $link = "https://samhotelorder.ct.ws/hotel-ordering-system/guest/menu.php?token=" . $location['qr_token'];

    $filename = "../qrcodes/" . $location['qr_token'] . ".png";

    QRcode::png(
        $link,
        $filename,
        QR_ECLEVEL_L,
        10
    );
}

header("Location: qr_codes.php?success=1");
exit;
?>