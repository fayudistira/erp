<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'kursusbahasa.sos@gmail.com'; // Isi dengan email kamu
    public string $fromName   = 'Nama Kursus Kamu';           // Nama pengirim
    public string $protocol   = 'smtp';                       // UBAH ke smtp

    public string $SMTPHost   = 'smtp.googlemail.com';        // Host Gmail
    public string $SMTPUser   = 'kursusbahasa.sos@gmail.com';
    public string $SMTPPass   = 'fdql htbx lcry ukxy';        // Gunakan App Password (bukan password login)
    public int $SMTPPort      = 587;                          // Port 465 untuk SSL atau 587 untuk TLS
    public string $SMTPCrypto = 'tls';                        // Gunakan 'ssl' jika port 465

    public string $mailType   = 'html';
    public string $newline    = "\r\n";
    public string $CRLF       = "\r\n";
}
