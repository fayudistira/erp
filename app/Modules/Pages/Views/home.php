<?= $this->extend('Modules\Pages\Views\layouts\pages_layout') ?>

<?= $this->section('style') ?>
<style>
    /* Animasi Teks Spinning */
    @keyframes zoomInCustom {
        0% {
            transform: scale(0.8) translateY(8px);
            opacity: 0;
            filter: blur(2px);
        }

        70% {
            transform: scale(1.02) translateY(0);
            filter: blur(0);
        }

        100% {
            transform: scale(1) translateY(0);
            opacity: 1;
            filter: blur(0);
        }
    }

    @keyframes fadeOutCustom {
        0% {
            transform: scale(1) translateY(0);
            opacity: 1;
            filter: blur(0);
        }

        30% {
            transform: scale(1.05) translateY(-3px);
            filter: blur(1px);
        }

        100% {
            transform: scale(0.8) translateY(8px);
            opacity: 0;
            filter: blur(2px);
        }
    }

    .text-zoom-in {
        animation: zoomInCustom 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    .text-fade-out {
        animation: fadeOutCustom 0.7s cubic-bezier(0.55, 0.085, 0.68, 0.53) forwards;
    }

    /* Orbit System (Bendera Memutar) */
    .orbit-container {
        position: relative;
        width: 280px;
        /* Ukuran diperkecil 20% */
        height: 280px;
        margin: 0 auto;
    }

    .orbit-path {
        position: absolute;
        width: 100%;
        height: 100%;
        animation: rotateOrbit 20s linear infinite;
    }

    .flag-orbit {
        position: absolute;
        width: 32px;
        /* Ukuran bendera diperkecil */
        height: 32px;
        background: white;
        border-radius: 50%;
        padding: 3px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        animation: counterRotate 20s linear infinite;
    }

    /* Penempatan Bendera di Orbit */
    .f-1 {
        top: 0;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .f-2 {
        top: 50%;
        right: 0;
        transform: translate(50%, -50%);
    }

    .f-3 {
        bottom: 0;
        left: 50%;
        transform: translate(-50%, 50%);
    }

    .f-4 {
        top: 50%;
        left: 0;
        transform: translate(-50%, -50%);
    }

    @keyframes rotateOrbit {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @keyframes counterRotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(-360deg);
        }
    }

    :root {
        --primary-yellow: #FFD700;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="relative py-12 lg:py-16 min-h-[50vh] flex items-center bg-cover bg-center text-white overflow-hidden"
    style="background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.9)), url('https://kursusbahasa.org/assets/img/gallery/kampung-inggris-pare.webp');">
    <div class="max-w-6xl mx-auto px-4 w-full">
        <div class="flex flex-wrap items-center">
            <div class="w-full lg:w-1/2 text-left mb-8 lg:mb-0">
                <h1 class="text-3xl lg:text-5xl font-extrabold leading-tight">
                    <span class="block mb-0.5">Mau belajar</span>
                    <div class="relative h-10 lg:h-14 my-2">
                        <span id="spinningText" class="absolute left-0 top-0 text-[var(--primary-yellow)] opacity-0 scale-75 leading-tight text-zoom-in">
                            Bahasa Mandarin
                        </span>
                    </div>
                    <span class="block">di Kampung Inggris?</span>
                </h1>
                <p class="text-sm lg:text-base opacity-85 mb-6 mt-4 max-w-md">
                    Bergabunglah dengan ribuan siswa yang telah sukses menguasai bahasa asing bersama kami.
                </p>
                <a href="#programs" class="inline-flex items-center gap-2 bg-[var(--primary-yellow)] text-black px-6 py-3 rounded-full font-bold text-sm hover:bg-yellow-400 transition-all transform hover:-translate-y-1">
                    Mulai Belajar <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="hidden lg:block lg:w-1/2">
                <div class="orbit-container">
                    <div class="absolute inset-0 flex items-center justify-center z-10">
                        <img src="https://kursusbahasa.org/assets/img/logo-sos.webp" alt="Logo" class="w-32 h-32 object-contain drop-shadow-xl opacity-90">
                    </div>
                    <div class="orbit-path">
                        <div class="flag-orbit f-1"><img src="https://flagcdn.com/w40/cn.png" class="rounded-full w-full h-full object-cover"></div>
                        <div class="flag-orbit f-2"><img src="https://flagcdn.com/w40/jp.png" class="rounded-full w-full h-full object-cover"></div>
                        <div class="flag-orbit f-3"><img src="https://flagcdn.com/w40/kr.png" class="rounded-full w-full h-full object-cover"></div>
                        <div class="flag-orbit f-4"><img src="https://flagcdn.com/w40/de.png" class="rounded-full w-full h-full object-cover"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="max-w-5xl mx-auto px-4 -mt-10 relative z-10">
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div class="md:border-r border-gray-100 last:border-0">
                <h3 class="text-2xl font-bold text-yellow-500">12+</h3>
                <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Bahasa Asing</p>
            </div>
            <div class="md:border-r border-gray-100 last:border-0">
                <h3 class="text-2xl font-bold text-yellow-500">150+</h3>
                <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Mentor Ahli</p>
            </div>
            <div class="md:border-r border-gray-100 last:border-0">
                <h3 class="text-2xl font-bold text-yellow-500">98%</h3>
                <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Peserta Lulus</p>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-yellow-500">24/7</h3>
                <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Akses Materi</p>
            </div>
        </div>
    </div>
</div>

<section id="programs" class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-2xl lg:text-3xl font-bold mb-3">Program Unggulan</h2>
            <div class="w-12 h-0.5 bg-yellow-400 mx-auto mb-3"></div>
            <p class="text-gray-500 text-sm">Pilih paket belajar yang sesuai dengan tujuan Anda.</p>
        </div>

        <div class="flex flex-wrap -mx-3">
            <aside class="w-full lg:w-1/5 px-3 mb-6">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 sticky top-20">
                    <h6 class="text-xs font-bold mb-3 flex items-center gap-2">
                        <i class="fas fa-filter text-yellow-500"></i> Filter
                    </h6>
                    <form action="<?= base_url('/') ?>" method="get" class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1.5">Bahasa</label>
                            <select name="category" onchange="this.form.submit()" class="w-full border-gray-200 rounded-lg text-xs py-1.5 focus:ring-yellow-500">
                                <option value="">Semua</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['category'] ?>" <?= ($filter['category'] ?? '') == $cat['category'] ? 'selected' : '' ?>><?= $cat['category'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Metode</label>
                            <div class="space-y-1.5 text-xs text-gray-600">
                                <?php $types = ['' => 'Semua', 'Online' => 'Online', 'Offline' => 'Offline'];
                                foreach ($types as $val => $label): ?>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="classtype" value="<?= $val ?>" onchange="this.form.submit()" class="text-yellow-500 w-3 h-3" <?= ($filter['classtype'] ?? '') == $val ? 'checked' : '' ?>>
                                        <span><?= $label ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </aside>

            <main class="w-full lg:w-4/5 px-3">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    <?php if (!empty($programs)): foreach ($programs as $prog): ?>
                            <div class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-md transition-all flex flex-col group">
                                <div class="relative h-36 overflow-hidden">
                                    <img src="<?= base_url('uploads/programs/' . ($prog['thumbnails'] ?: 'default.jpg')) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div class="p-4 flex flex-col flex-grow">
                                    <div class="flex flex-wrap gap-1.5 mb-2">
                                        <span class="bg-yellow-50 text-yellow-700 text-[9px] font-bold px-1.5 py-0.5 rounded"><?= esc($prog['category']) ?></span>
                                        <span class="bg-gray-50 text-gray-500 text-[9px] font-bold px-1.5 py-0.5 rounded"><?= esc($prog['duration']) ?></span>
                                    </div>
                                    <h5 class="font-bold text-gray-900 text-sm leading-tight mb-2 line-clamp-2"><?= esc($prog['title']) ?></h5>
                                    <div class="mt-auto pt-3 border-t border-gray-100 flex items-end justify-between">
                                        <div>
                                            <span class="block text-[9px] text-gray-400 line-through">IDR <?= number_format($prog['tuition'] * 1.2, 0, ',', '.') ?></span>
                                            <span class="text-sm font-bold text-yellow-600">IDR <?= number_format($prog['tuition'], 0, ',', '.') ?></span>
                                        </div>
                                        <a href="<?= base_url('programs/show/' . $prog['id']) ?>" class="bg-black text-white px-4 py-1.5 rounded-lg text-[10px] font-bold hover:bg-yellow-500 transition-colors">DAFTAR</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                    else: ?>
                        <div class="col-span-full py-10 text-center border-2 border-dashed border-gray-100 rounded-2xl text-gray-400 text-sm">Tidak ditemukan program.</div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
</section>

<section class="py-12 bg-white">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full lg:w-1/3 px-4 mb-8">
                <h2 class="text-xl font-bold mb-2">Punya Pertanyaan?</h2>
                <p class="text-xs text-gray-500 mb-6">Konsultasi gratis dengan admin kami.</p>
                <a href="https://wa.me/6285810310950" class="inline-flex items-center gap-2 bg-black text-white px-5 py-2 rounded-full text-xs font-bold hover:bg-yellow-400 hover:text-black transition-all">
                    <i class="fab fa-whatsapp"></i> Chat Admin
                </a>
            </div>
            <div class="w-full lg:w-2/3 px-4 space-y-3">
                <?php if (!empty($faqs)): foreach ($faqs as $key => $faq): ?>
                        <div class="border border-gray-100 rounded-xl">
                            <button class="w-full flex items-center justify-between p-4 text-left font-bold text-xs text-gray-700 hover:bg-gray-50 transition-colors" onclick="this.nextElementSibling.classList.toggle('hidden')">
                                <span><?= esc($faq['question']) ?></span>
                                <i class="fas fa-chevron-down text-[10px]"></i>
                            </button>
                            <div class="<?= $key === 0 ? '' : 'hidden' ?> p-4 pt-0 text-[11px] text-gray-500 leading-relaxed">
                                <?= nl2br(esc((string) $faq['answer'])) ?>
                            </div>
                        </div>
                <?php endforeach;
                endif; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const spinningText = document.getElementById("spinningText");
        if (spinningText) {
            const languages = ["Bahasa Mandarin", "Bahasa Jepang", "Bahasa Korea", "Bahasa Jerman", "Bahasa Inggris"];
            let currentIndex = 0;
            setInterval(() => {
                spinningText.classList.remove("text-zoom-in");
                spinningText.classList.add("text-fade-out");
                setTimeout(() => {
                    currentIndex = (currentIndex + 1) % languages.length;
                    spinningText.textContent = languages[currentIndex];
                    spinningText.classList.remove("text-fade-out");
                    spinningText.classList.add("text-zoom-in");
                }, 700);
            }, 3500);
        }
    });
</script>
<?= $this->endSection() ?>