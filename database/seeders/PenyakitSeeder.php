<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenyakitSeeder extends Seeder {
    public function run(): void {
        $data = [
            [
                'slug'          => 'daun_sehat',
                'nama'          => 'Daun Sehat',
                'deskripsi'     => 'Daun bawang merah berwarna hijau segar, tidak terdapat bercak, tidak layu, dan pertumbuhan terlihat normal.',
                'tingkat_bahaya'=> 'sehat',
                'gejala'        => json_encode(['Warna daun hijau merata dan segar','Tidak ada bercak atau area busuk','Batang dan daun terlihat tegak dan kuat']),
                'penanganan'    => json_encode(['Lakukan penyiraman secukupnya pagi hari','Jaga kebersihan dan sanitasi lahan','Pantau kondisi tanaman secara rutin','Berikan pupuk sesuai anjuran dosis']),
                'pencegahan'    => json_encode(['Gunakan bibit sehat bersertifikat','Rotasi tanaman dan bersihkan gulma secara berkala','Jaga drainase agar tidak tergenang','Lakukan pemantauan mingguan untuk deteksi dini']),
                'referensi'     => json_encode([
                    ['title' => 'Panduan budidaya & sanitasi tanaman','url' => 'https://example.com/bawang-sehat/sanitasi'],
                    ['title' => 'Prinsip pencegahan penyakit tanaman','url' => 'https://example.com/bawang-sehat/pencegahan'],
                ]),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'slug'          => 'moler',
                'nama'          => 'Moler (Fusarium)',
                'deskripsi'     => 'Penyakit moler disebabkan jamur Fusarium oxysporum yang menyerang akar dan batang, mengakibatkan daun melengkung, menguning, dan layu.',
                'tingkat_bahaya'=> 'peringatan',
                'gejala'        => json_encode(['Daun terlihat melengkung atau memutar','Warna daun berubah menjadi kekuningan','Tanaman tampak layu dan pertumbuhan kerdil','Pangkal batang membusuk berwarna kecoklatan']),
                'penanganan'    => json_encode(['Cabut dan musnahkan tanaman yang terinfeksi parah','Gunakan bibit sehat bersertifikat bebas Fusarium','Perbaiki sistem drainase agar tidak tergenang','Gunakan fungisida berbahan aktif Metalaksil sesuai anjuran','Lakukan rotasi tanaman minimal satu musim']),
                'pencegahan'    => json_encode(['Gunakan bibit/benih bebas Fusarium','Tanam pada lahan dengan drainase baik','Hindari penanaman berulang di lahan yang sama','Lakukan rotasi tanaman dan sanitasi lahan','Gunakan mulsa/ajir untuk menjaga kelembapan tanah seimbang']),
                'referensi'     => json_encode([
                    ['title' => 'Strategi pengendalian Fusarium pada tanaman', 'url' => 'https://example.com/moler/fusarium-control'],
                    ['title' => 'Praktik sanitasi dan rotasi untuk pencegahan penyakit', 'url' => 'https://example.com/moler/sanitation-rotation'],
                ]),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'slug'          => 'busuk_daun',
                'nama'          => 'Busuk Daun (Phytophthora)',
                'deskripsi'     => 'Busuk daun disebabkan Phytophthora porri, ditandai dengan bercak basah atau menghitam pada daun yang dapat menyebar cepat di kondisi lembap.',
                'tingkat_bahaya'=> 'bahaya',
                'gejala'        => json_encode(['Terdapat bercak coklat atau hitam basah pada daun','Daun tampak membusuk dan mengeluarkan bau tidak sedap','Bagian daun yang terinfeksi mudah patah','Infeksi menyebar ke atas dari pangkal daun']),
                'penanganan'    => json_encode(['Kurangi kelembapan berlebih dengan memperbaiki drainase','Buang dan musnahkan bagian daun yang terinfeksi','Atur jarak tanam agar sirkulasi udara baik (15-20 cm)','Hindari penyiraman pada sore/malam hari','Gunakan fungisida Mankozeb 80% atau Propineb bila diperlukan']),
                'pencegahan'    => json_encode(['Perbaiki drainase dan hindari genangan','Tingkatkan sirkulasi udara dengan jarak tanam ideal','Lakukan sanitasi lahan dari sisa tanaman','Penyiraman terarah ke tanah (hindari daun basah)','Lakukan pemantauan rutin terutama saat kondisi lembap']),
                'referensi'     => json_encode([
                    ['title' => 'Pengendalian penyakit Phytophthora pada sayuran', 'url' => 'https://example.com/busuk-daun/phytophthora-control'],
                    ['title' => 'Praktik budidaya untuk mengurangi kelembapan', 'url' => 'https://example.com/busuk-daun/humidity-management'],
                ]),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'slug'          => 'trotol',
                'nama'          => 'Trotol (Alternaria)',
                'deskripsi'     => 'Trotol atau bercak ungu disebabkan Alternaria porri, ditandai bercak kecil yang melebar dan mengganggu fotosintesis tanaman.',
                'tingkat_bahaya'=> 'bahaya',
                'gejala'        => json_encode(['Muncul bercak kecil berwarna ungu di tengah daun','Bercak membesar dengan lingkaran konsentris dan tepi kuning','Daun mengering dari ujung ke arah pangkal','Pada serangan parah seluruh daun mengering']),
                'penanganan'    => json_encode(['Pangkas bagian daun terserang dan musnahkan di luar lahan','Jaga sanitasi dan kebersihan lahan dari sisa tanaman','Hindari penyiraman berlebihan terutama sore hari','Semprot fungisida Iprodion atau Klorotalonil secara preventif','Lakukan pengendalian hama terpadu (PHT) secara rutin']),
                'pencegahan'    => json_encode(['Buang sisa tanaman terserang agar spora tidak berkembang','Pastikan kebersihan alat dan permukaan tanam','Hindari kelembapan berlebih di permukaan daun','Lakukan pengendalian preventif saat awal musim','Rotasi tanaman dan gunakan bibit sehat']),
                'referensi'     => json_encode([
                    ['title' => 'Manajemen penyakit Alternaria pada bawang', 'url' => 'https://example.com/trotol/alternaria-management'],
                    ['title' => 'Sanitasi lahan untuk mencegah penyebaran jamur', 'url' => 'https://example.com/trotol/sanitation'],
                ]),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];
        DB::table('penyakit')->insert($data);
    }
}