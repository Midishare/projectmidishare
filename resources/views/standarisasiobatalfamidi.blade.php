@extends($layout)

@section('content')
    <div class="py-5" style="margin-top: 100px;">
        <div class="container">
            <div class="bg-white shadow">
                <div class="bg-success rounded text-white">
                    <div class="p-4 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="h4 mb-0 font-weight-bold">Standarisasi obat</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col p-4 pb-0 col-sm-12 col-12 col-xl-6">
                            <img src="{{ asset('icon/welcomealfamidi.png') }}" alt="Delivery Person" class="rounded"
                                style="object-fit: cover; width: 100%;">
                        </div>
                        <div class="col p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="h5 font-weight-bold">Apa Itu Standarisasi Obat</h2>
                                    <p class="mb-0">Standarisasi obat adalah proses untuk menjamin kualitas, keamanan, dan
                                        khasiat obat. Standarisasi obat dilakukan dengan berbagai metode analisis, seperti
                                        kimiawi, fisik, dan mikrobiologi. Contoh standar: BPOM (Indonesia), FDA (AS), atau
                                        WHO.</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-0">"Kami berkomitmen untuk memastikan setiap obat memenuhi standar
                                        kualitas, keamanan, dan efektivitas. Temukan informasi lengkap mengenai regulasi
                                        obat di sini."</p>
                                </div>
                            </div>
                        </div>
                        <div class="container-program mb-4 mt-4">
                            <div class="stats-container-program">
                                <div class="stat-card-program">
                                    <img src="{{ asset('icon/3.png') }}" alt="Delivery Person" class="rounded"
                                        style="object-fit: cover; width: 50px;">
                                    <div class="stat-number-program">Obat Bebas</div>

                                </div>
                                <div class="stat-card-program">
                                    <img src="{{ asset('icon/4.png') }}" alt="Delivery Person" class="rounded"
                                        style="object-fit: cover; width: 50px;">
                                    <div class="stat-number-program">Obat Resep</div>

                                </div>
                                <div class="stat-card-program">
                                    <img src="{{ asset('icon/5.png') }}" alt="Delivery Person" class="rounded"
                                        style="object-fit: cover; width: 50px;">
                                    <div class="stat-number-program">Obat Herbal</div>
                                </div>
                            </div>
                        </div>
                        <div>

                        </div>
                        <div class="container-fluid ">
                            <div class="text-center">
                                <img src="{{ asset('icon/LOGO-OBAT.png') }}" alt="Delivery Person"
                                    class="rounded p-5 logo-obat ">
                            </div>
                            <div class="p-5">
                                <h3>7 Logo Obat yang Wajib Kamu Tahu</h3>
                                <p class="mt-5">
                                    Pernahkah kamu memperhatikan logo-logo kecil yang ada di kemasan obat? Meskipun terlihat
                                    sepele, logo-logo ini menyimpan informasi penting tentang jenis obat tersebut. Yuk, kita
                                    cari tahu bersama!
                                </p>
                                <p>
                                <ul>
                                    <ol>
                                        <li>
                                            <h5>Hijau Segar: Obat Bebas</h5>
                                            <p>Obat ini bisa kamu beli bebas di apotek tanpa perlu resep dokter. Biasanya
                                                digunakan
                                                untuk mengatasi gejala ringan seperti sakit kepala atau demam.
                                                Contoh: Paracetamol, obat batuk sederhana.</p>
                                        </li>
                                        <li>
                                            <h5>Biru Tenang: Obat Bebas Terbatas</h5>
                                            <p>Obat ini juga mudah didapatkan, tapi sebaiknya kamu konsultasi dulu dengan
                                                apoteker sebelum mengonsumsinya. Efek sampingnya mungkin sedikit lebih kuat
                                                daripada obat bebas.
                                                Contoh: Obat alergi, obat maag.</p>
                                        </li>
                                        <li>
                                            <h5>Merah Menyala: Obat Keras</h5>
                                            <p>Obat ini harus dengan resep dokter. Efek sampingnya bisa lebih serius, jadi
                                                jangan sembarangan minum ya!
                                                Contoh: Antibiotik, obat diabetes, obat tekanan darah tinggi.</p>
                                        </li>
                                        <li>
                                            <h5>Lingkaran dengan Palang Merah: Obat Narkotika</h5>
                                            <p>Obat ini mengandung zat adiktif dan berbahaya jika disalahgunakan.
                                                Penggunaannya harus sangat diawasi oleh dokter.
                                                Contoh: Morfin, kokain (hanya untuk keperluan medis).</p>
                                        </li>
                                        <li>
                                            <h5>Oval dengan Gambar Tanaman: Obat Jamu</h5>
                                            <p>Obat tradisional yang terbuat dari bahan-bahan alami seperti tumbuhan.
                                                Biasanya digunakan untuk menjaga kesehatan dan mengatasi berbagai penyakit
                                                ringan.
                                                Contoh: Jamu untuk meningkatkan nafsu makan, jamu untuk melancarkan haid.
                                            </p>
                                        </li>
                                        <li>
                                            <h5>Tiga Bintang Hijau: Obat Herbal Terstandar</h5>
                                            <p>Obat herbal yang sudah melalui proses pengolahan modern sehingga kualitas dan
                                                keamanannya terjamin.
                                                Contoh: Obat herbal untuk menurunkan kolesterol.
                                            </p>
                                        </li>
                                        <li>
                                            <h5>Kepingan Salju: Fitofarmaka</h5>
                                            <p>Obat yang berasal dari tumbuhan, namun sudah melalui proses ekstraksi dan
                                                pemurnian sehingga kandungan aktifnya lebih terkonsentrasi.
                                                Contoh: Obat herbal untuk mengatasi masalah kulit.
                                            </p>
                                        </li>
                                    </ol>
                                </ul>


                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 overflow-scroll">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">penggunaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Promag</td>
                                <td>Lambung</td>
                                <td>3x1 (table kunyah)</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Mixagrip flu&batuk</td>
                                <td>Flu & Batuk</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Mixagrip FLu</td>
                                <td>Flu</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Komix</td>
                                <td>Flu & Batuk</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Oskadon</td>
                                <td>Sakit Kepala</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>Bintang Toedjoe</td>
                                <td>Sakit Kepala</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <th scope="row">7</th>
                                <td>Biogesic</td>
                                <td>Sakit Kepala</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">8</th>
                                <td>Bodrex Flu dan Batuk</td>
                                <td>Flu dan Batuk</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">9</th>
                                <td>Bodrex Flu dan Batuk</td>
                                <td>Flu dan Batuk</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">10</th>
                                <td>Bodrex Flu dan Batuk Berdahak</td>
                                <td>Flu dan Batuk</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">11</th>
                                <td>Bodrex Extra</td>
                                <td>Sakit kepala & demam</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">12</th>
                                <td>Bodrex Migran</td>
                                <td>Sakit kepala</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">13</th>
                                <td>Decolgen</td>
                                <td>Flu</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">14</th>
                                <td>Paramex</td>
                                <td>Sakit kepala</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">15</th>
                                <td>Neo Rheumacyl Oralinu</td>
                                <td>Pegel Linu</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <th scope="row">16</th>
                                <td>Neozep Forte</td>
                                <td>Demam & Flu</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">17</th>
                                <td>Diatabs</td>
                                <td>anti diare</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <th scope="row">18</th>
                                <td>Inza</td>
                                <td>Flu</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                            <tr>
                                <th scope="row">19</th>
                                <td>Feminax</td>
                                <td>Pelancar Haid</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <th scope="row">20</th>
                                <td>ultraflu</td>
                                <td>Flu & Demam</td>
                                <td>3x1 (tablet)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- <div class="p-4 justify-content-betwen">
                    <div class="row container">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('icon/vitamin.jpg') }}" alt="Bone & Joint Care" class="w-5 rounded"
                                style="max-height: 180px; object-fit: cover;">
                            <h3 class="h6 font-weight-bold mt-2">Vitamin</h3>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('icon/cough.jpg') }}" alt="Liver Care" class="w-5 rounded"
                                style="max-height: 180px; object-fit: cover;">
                            <h3 class="h6 font-weight-bold mt-2">Batuk & Flu</h3>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('icon/fever.jpg') }}" alt="Respiratory Care" class="w-5 rounded"
                                style="max-height: 180px; object-fit: cover;">
                            <h3 class="h6 font-weight-bold mt-2">Demam & Sakit Kepala</h3>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('icon/stomache.jpg') }}" alt="Eye Care" class="w-5 rounded"
                                style="max-height: 180px; object-fit: cover;">
                            <h3 class="h6 font-weight-bold mt-2">Lambung</h3>
                        </div>
                    </div>
                </div> --}}
            </div>

        </div>
    </div>
@endsection
<style>
    .bg-midi {
        background-color: #0253BB;
    }

    .stats-container {
        display: flex;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: 0 auto;
        font-family: Arial, sans-serif;
    }

    .stat-item {
        text-align: center;
        padding: 20px;
        flex: 1 1 300px;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 1.2rem;
        color: #666;
    }

    .container-program {
        text-align: center;
    }

    .stats-container-program {
        display: flex;
        justify-content: center;
        gap: 100px;
        flex-wrap: wrap;
    }

    .stat-card-program {
        background-color: green;
        border-radius: 10px;
        padding: 20px;
        width: 200px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-number-program {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .stat-description-program {
        font-size: 0.9rem;
    }

    .stat-card-program:hover {
        background-color: #0253BB;
        color: white;
    }

    .logo-obat {
        object-fit: cover;
        width: 700px;
    }

    @media (max-width: 768px) {
        .stat-item {
            flex-basis: 50%;
            text-align: start
        }

        .stat-card-program {
            width: 100%;
            max-width: 300px;
        }

        .logo-obat {
            object-fit: cover;
            width: 370px;
        }
    }
</style>
