
@extends('layouts.layouts')

@section('content')
<section style="margin-top: 90px; margin-left : 1rem;">
    <div class="container">
        {{-- <h4>Home</h4> --}}
    </div>
</section>
<section>
    <div class="container center">
        <div class="row">
            <div class="" >
                <div class="card mb-3 border border-0" >
                    <div class="bg-midi rounded text-white">
                      <h1 class="text-center">Knowledge Management Activity</h1>
                      <img class="card-img-top image1 object-fit-cover"  src="{{ asset('icon/header-image.jpg') }}" alt="Card image cap">
                    </div>
                      <div class="card-body ">
                          <div class="d-flex flex-column flex-md-row justify-content-between">
                              <div class="p-2">
                                  <p>Knowledge Management mempunyai tujuan untuk menyimpan dan menyebarkan pengetahuan pembelajaran yang ada di Alfamidi. Kami juga menyimpan informasi-informasi mengenai berbagai acara. Yuk kepoin Knowledge Management!</p>
                                  <p>Kami memiliki:</p>    
                                  <div class="stats-container">
                                    <div class="stat-item">
                                        <div class="stat-number" id="repository-count">0</div>
                                        <div class="stat-label">Repository</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number" id="jurnal-count">0</div>
                                        <div class="stat-label">Jurnal Belajar</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number" id="learning-count">0</div>
                                        <div class="stat-label">Self Learning</div>
                                    </div>
                                </div>
                              </div>
                        </div>
                  </div>
                </div>
                <div class="container-program">
                  <p class="font-head-program">Knowledge Management Memiliki Banyak Program Belajar</p>
                  {{-- <p class="subtitle-program">Consolidate Your People Operations with Our All-in-One HR Software and Say Goodbye to Fragmented Tools</p> --}}
                  
                  <div class="stats-container-program">
                      <div class="stat-card-program">
                          <div class="stat-number-program">Webinar</div>
                          <div class="stat-description-program">Kumpulan Rekaman Webinar Alfamidi yang informatif dan relevan dengan kebutuhan sekarang</div>
                      </div>
                      <div class="stat-card-program">
                          <div class="stat-number-program">Training</div>
                          <div class="stat-description-program">Kumpulan rekaman dan informasi mengenai Training Kompetensi di Alfamidi</div>
                      </div>
                      <div class="stat-card-program">
                          <div class="stat-number-program">COP</div>
                          <div class="stat-description-program">Kumpulan infomasi mengenai community of practice di Alfamidi</div>
                      </div>
                  </div>
              </div>
                <div class="card mb-3 mt-5 border border-0" >
                    <div class="">
                        <div class="d-flex flex-column flex-md-row justify-content-between bg-midi rounded text-white">
                            <div class="p-3">
                                <h1>Dapatkan Ilmu dengan materi yang bisa kamu pelajari!</h1>
                                <p>Pelajari Lebih Lanjut di Knowledge Center</p>
                                <img class="card-img-top image1 object-fit-fill "  src="{{ asset('icon/gmbr3.png') }}"  alt="Card image cap">
                            </div>
                            <div class="p-3 margin-materi">
                                <ol type="1">
                                    <li>Dapatkan Informasi terkini mengenai Webinar, Artikel dan Podcast Alfamidi</li>
                                    <li>Dapatkan materi pembelajaran dari repositori, training, courses, dan masih banyak lagi!</li>
                                    <li>Dapatkan informasi terkini mengenai kegiatan-kegiatan Community of Interest dan Community of Practice!</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-container mx-auto">
                    <h1 class="form-header text-center">Ayo Bergabung Bersama Midishare!</h1>
                    <p class="form-label text-center">Daftarkan diri anda sekarang juga</p>
                    <form id="contactForm" class="mx-auto">
                        <div class="form-group">
                            <label for="firstName">Nama Depan</label>
                            <input type="text" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Nama Belakang</label>
                            <input type="text" id="lastName" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select id="kelas" name="kelas" required>
                                <option value="Tidak">Tidak</option>
                                <option value="MDP">MDP</option>
                                <option value="DP">DP</option>
                                <option value="IP">IP</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <button class="buton-form" type="submit">Kirim!</button>
                    </form>
                </div>
            </div>                                   
        </div>        
    </div>
</section>
<script>
    function animateValue(id, start, end, duration) {
        let current = start;
        const range = end - start;
        const increment = end > start ? 1 : -1;
        const stepTime = Math.abs(Math.floor(duration / range));
        const obj = document.getElementById(id);
        const timer = setInterval(function() {
            current += increment;
            obj.innerHTML = current + "+";
            if (current == end) {
                clearInterval(timer);
            }
        }, stepTime);
    }
    
    document.addEventListener('DOMContentLoaded', (event) => {
        animateValue("repository-count", 0, 10, 500);
        animateValue("jurnal-count", 0, 10, 500);
        animateValue("learning-count", 0, 10, 500);
    });
    document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();   
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const kelas = document.getElementById('kelas').value;
            const email = document.getElementById('email').value;

            const whatsappMessage = `Halo kak! saya ingin mendaftar menjadi anggota midishare:%0A
Name: ${firstName} ${lastName}%0A
Email: ${email}%0A
kelas: ${kelas}`;

            const whatsappNumber = '+6287884597637';
            const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${whatsappMessage}`;
            
            window.open(whatsappUrl, '_blank');
        });
    </script>
    
@endsection
<style>
    .image1{
        width: 80vw;
        height: 50vh;
    }
    .bg-midi{
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
        .font-head-program {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .subtitle-program {
            font-size: 1rem;
            color: #666;
            margin-bottom: 30px;
        }
        .stats-container-program {
            display: flex;
            justify-content: center;
            gap: 100px;
            flex-wrap: wrap;
        }
        .stat-card-program {
            background-color: white;
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
       
        .stat-card-program:hover{
          background-color: #0253BB;
          color: white;
        }
        .margin-materi{
          margin-top: 150px;
          line-height: 30px;
        }
        .form-container {
            color: white;
            background-color: #0253BB;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        #contactForm{
            width: 100%;
            max-width: 500px;
        }
        .form-header {
            color: white;
            margin-top: 0;
            margin-bottom: 0.5rem;
        }
        .form-label {
            margin-top: 0;
            margin-bottom: 1.5rem;
            color: white;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .buton-form {
            background-color: #E62323;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
        }
        .buton-form:hover {
            background-color: #964141;
        }
        @media (max-width: 768px) {
            .stat-item {
                flex-basis: 50%;
                text-align: start
            }
            .font-head{
                font-size: 65px;
            }
            .font-head-program {
                font-size: 2rem;
            }
            .stat-card-program {
                width: 100%;
                max-width: 300px;
            }
        }
</style>