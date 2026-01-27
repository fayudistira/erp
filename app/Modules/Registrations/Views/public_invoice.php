<h2>Detail Invoice</h2>

<p>Nomor Invoice: <strong><?= esc($invoice['invoice_number']) ?></strong></p>
<p>Program: <?= esc($program['title']) ?></p>
<p>Total: Rp <?= number_format($invoice['total_amount'], 0, ',', '.') ?></p>
<p>Status: <?= esc($invoice['status']) ?></p>