<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Kursus Bahasa Asing - Kampung Inggris Pare') ?></title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-yellow': '#ffd700',
                        'dark-yellow': '#ffc107',
                        'black-gray': '#212529',
                    }
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        @layer components {
            .social-link {
                @apply w-8 h-8 flex items-center justify-center rounded-full border border-primary-yellow/30 text-primary-yellow transition-all duration-300 hover:bg-primary-yellow hover:text-black-gray hover:-translate-y-0.5;
            }
            .section-title {
                @apply relative font-extrabold text-black-gray text-2xl mb-6 inline-block;
            }
            .section-title::after {
                @apply content-[''] w-12 h-1 bg-primary-yellow absolute -bottom-2 left-0 rounded-full;
            }
            .program-card {
                @apply bg-white border border-black/10 rounded-lg overflow-hidden transition-all duration-300 hover:border-primary-yellow hover:shadow-xl hover:-translate-y-1 h-full;
            }
            .btn-yellow {
                @apply bg-primary-yellow text-black-gray font-bold py-2 px-6 rounded-lg transition-colors hover:bg-dark-yellow;
            }
        }

        /* Orbit System Styles */
.orbit-container {
    position: relative;
    width: 300px; /* Ukuran total orbit */
    height: 300px;
    margin: 0 auto;
    perspective: 1000px;
}

.orbit-path {
    position: absolute;
    width: 100%;
    height: 100%;
    animation: rotateOrbit 15s linear infinite;
    transform-style: preserve-3d;
}

.flag-icon {
    position: absolute;
    width: 35px;
    height: 35px;
    background: white;
    border-radius: 50%;
    padding: 5px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    /* Mengimbangi rotasi orbit agar bendera tetap tegak */
    animation: counterRotate 15s linear infinite; 
}

/* Posisi Bendera di lintasan (0, 90, 180, 270 derajat) */
.flag-1 { top: 0; left: 50%; transform: translateX(-50%); }
.flag-2 { top: 50%; right: 0; transform: translateY(-50%); }
.flag-3 { bottom: 0; left: 50%; transform: translateX(-50%); }
.flag-4 { top: 50%; left: 0; transform: translateY(-50%); }

@keyframes rotateOrbit {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes counterRotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(-360deg); }
}
    </style>

    <?= $this->renderSection('style') ?>
</head>

<body class="bg-slate-50 text-slate-800 font-sans">
    <nav class="sticky top-0 z-[1030] bg-black-gray text-white py-3 border-b-2 border-primary-yellow shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-xl font-bold tracking-tight">
                    <a href="<?= base_url('/') ?>" class="no-underline text-slate-50">
                        <span class="text-primary-yellow">kursus</span>bahasa.org
                    </a>
                </div>

                <div class="flex items-center gap-2 flex-wrap justify-center">
                    <?php
                    $flags = [
                        'cn' => 'Mandarin',
                        'jp' => 'Jepang',
                        'kr' => 'Korea',
                        'de' => 'Jerman',
                        'gb' => 'Inggris'
                    ];
                    foreach ($flags as $code => $name): ?>
                        <a href="<?= base_url('/?category=' . $name) ?>" class="social-link" title="Program <?= $name ?>">
                            <img src="https://hatscripts.github.io/circle-flags/flags/<?= $code ?>.svg" class="w-5 h-5 rounded-full" alt="<?= $name ?>" />
                        </a>
                    <?php endforeach; ?>

                    <div class="w-px h-6 bg-slate-700 mx-1 hidden md:block"></div>

                    <a href="<?= base_url('/') ?>" class="social-link" title="Beranda">
                        <i class="fas fa-home text-sm"></i>
                    </a>

                    <?php if (!empty($menu)): ?>
                        <?php foreach ($menu as $label => $url): ?>
                            <a href="<?= esc($url) ?>" class="social-link" title="<?= ucfirst($label) ?>">
                                <i class="fas fa-<?= strtolower($label) ?> text-sm"></i>
                            </a>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-[70vh]">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-black-gray text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-12">
                <div class="md:col-span-6">
                    <h5 class="text-xl font-bold mb-4 italic uppercase">
                        <a href="<?= base_url('/') ?>" class="text-white no-underline">
                            <span class="text-primary-yellow">kursus</span>bahasa.org
                        </a>
                    </h5>
                    <p class="text-slate-400 mb-6 leading-relaxed">
                        Lembaga kursus bahasa asing terpercaya dengan metode Kampung
                        Inggris untuk lima bahasa: Mandarin, Jepang, Korea, Jerman, dan
                        Inggris.
                    </p>
                    <div class="p-4 bg-white/5 border-l-4 border-primary-yellow rounded-r-lg">
                        <p class="text-xs text-slate-400 leading-loose uppercase tracking-wider font-semibold">
                            SK Diknas: Nomor 421.9/1885/418.20/2023<br />
                            SK KEMENKUMHAM Nomor AHU-0015725.AH.01.07.TAHUN 2018
                        </p>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <h5 class="text-lg font-bold mb-6 border-b border-slate-700 pb-2">Tautan Cepat</h5>
                    <ul class="space-y-3">
                        <li>
                            <a href="<?= base_url('/') ?>" class="text-slate-400 hover:text-primary-yellow transition-colors no-underline flex items-center gap-2">
                                <i class="fas fa-chevron-right text-[10px]"></i> Home
                            </a>
                        </li>
                        <?php if (!empty($menu)): ?>
                            <?php foreach ($menu as $label => $url): ?>
                                <li>
                                    <a href="<?= esc($url) ?>" class="text-slate-400 hover:text-primary-yellow transition-colors no-underline flex items-center gap-2">
                                        <i class="fas fa-chevron-right text-[10px]"></i> <?= ucfirst($label) ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                </div>

                <div class="md:col-span-3">
                    <h5 class="text-lg font-bold mb-6 border-b border-slate-700 pb-2">Kontak Kami</h5>
                    <ul class="space-y-4">
                        <li class="flex gap-3 items-start group">
                            <i class="fas fa-map-marker-alt text-primary-yellow mt-1 transition-transform group-hover:scale-125"></i>
                            <span class="text-slate-400 text-sm">Perum GPR 1 Blok C No.4, Jl. Veteran Tulungrejo, Pare, Kediri 64212</span>
                        </li>
                        <li class="flex gap-3 items-center group">
                            <i class="fas fa-phone text-primary-yellow transition-transform group-hover:scale-125"></i>
                            <span class="text-slate-400 text-sm">0858 1031 0950</span>
                        </li>
                        <li class="flex gap-3 items-center group">
                            <i class="fas fa-envelope text-primary-yellow transition-transform group-hover:scale-125"></i>
                            <span class="text-slate-400 text-sm">info@kursusbahasa.org</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-800">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="text-slate-500 text-sm">
                        &copy; <?= date('Y') ?> <span class="text-slate-300 font-bold">kursusbahasa.org</span>. All rights reserved.
                    </div>

                    <div class="flex items-center gap-4">
                        <?php
                        $socials = [
                            'whatsapp' => 'https://wa.me/6285810310950',
                            'youtube' => 'https://www.youtube.com/@kursusbahasa',
                            'facebook' => 'https://www.facebook.com/kursusbahasa',
                            'tiktok' => 'https://www.tiktok.com/@kursusbahasa',
                            'instagram' => 'https://www.instagram.com/kursusbahasa'
                        ];
                        foreach ($socials as $icon => $link): ?>
                            <a href="<?= $link ?>" class="text-slate-400 hover:text-primary-yellow text-xl transition-all hover:scale-125" target="_blank">
                                <i class="fab fa-<?= $icon ?>"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?= $this->renderSection('script') ?>
</body>

</html>