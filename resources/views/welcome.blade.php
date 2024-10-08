
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
           
            {{-- <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{ Storage::url('public/gambar/' . $item->image) }}" alt="Card image cap">
                </div>
            </div> --}}
            <div class="" >
                <div class="card mb-3 border border-0" >
                  <div class="bg-midi rounded text-white">
                    <h1 class="text-center">Knowledge Management Activity</h1>
                    <img class="card-img-top image1 object-fit-cover"  src="{{ asset('icon/header-image.jpg') }}" alt="Card image cap">
                  </div>
                    <div class="card-body ">
                        <div class="d-flex flex-column flex-md-row justify-content-between">
                            <div class="p-2">
                                <p>Divisi Knowledge Management merupakan divisi yang bertujuan untuk menyimpan dan menyebarkan pengetahuan pembelajaran yang ada di Alfamidi. Kami juga menyimpan informasi-informasi mengenai berbagai acara. Yuk kepoin Knowledge Management!</p>
                                <p>Kami memiliki:</p>    
                                <div class="stats-container">
                                  <div class="stat-item">
                                      <div class="stat-number">10+</div>
                                      <div class="stat-label">Repository</div>
                                  </div>
                                  <div class="stat-item">
                                      <div class="stat-number">10+</div>
                                      <div class="stat-label">Jurnal Belajar</div>
                                  </div>
                                  <div class="stat-item">
                                      <div class="stat-number">10+</div>
                                      <div class="stat-label">Self Learning</div>
                                  </div>
                              </div>
                            </div>
                            {{-- <div class="p-2">
                                <img src="{{ asset('icon/karaktermidi-10.png') }}" height="300"  class="rounded mx-auto d-block" alt="...">
                            </div>                             --}}
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
            </div>                                   
           
        </div>        
    </div>
</section>

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