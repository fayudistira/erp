<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice <?= esc($invoice['invoice_number']) ?></title>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        h2 {
            margin-bottom: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }
    </style>
    <style>
        @media print {
            @page {
                margin: 20mm;
            }
        }
    </style>

</head>

<body>

    <h2>INVOICE PEMBAYARAN</h2>
    <p>
        Nomor Invoice: <strong><?= esc($invoice['invoice_number']) ?></strong><br>
        Nomor Registrasi: <?= esc($registration['reg_num']) ?><br>
        Program: <?= esc($program['title']) ?>
    </p>

    <table>
        <thead>
            <tr>
                <th>Deskripsi</th>
                <th class="text-right">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoice['invoice_items'] as $item): ?>
                <tr>
                    <td><?= esc($item['desc']) ?></td>
                    <td class="text-right">Rp <?= number_format($item['amount'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th>Total</th>
                <th class="text-right">Rp <?= number_format($invoice['total_amount'], 0, ',', '.') ?></th>
            </tr>
        </tbody>
    </table>

    <p style="margin-top:40px;">
        Silakan lakukan pembayaran sesuai nominal dan simpan invoice ini sebagai bukti.
    </p>


    <?php
    $url = base_url('invoice/view/' . urlencode($invoice['invoice_number']));

    $qrImg = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($qrUrl);
    ?>

    <div style="margin-top:40px; text-align:center;">
        <p>Scan QR untuk melihat detail invoice</p>
        <img src="<?= $qrUrl ?>" alt="QR Code">

    </div>

</body>

</html>