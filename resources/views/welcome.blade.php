
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
            <div class="container-fluid" >
                <div class="card mb-3 border border-0" >
                    <img class="card-img-top image1 object-fit-cover"  src="{{ asset('icon/ALFAMIDI-4.jpg') }}" alt="Card image cap">
                    <div class="card-body ">
                        <div class="d-flex flex-column flex-md-row justify-content-between">
                            <div class="p-2">
                                <h1>Knowledge Management Activity</h1>
                                <p>Divisi Knowledge Management merupakan divisi yang bertujuan untuk menyimpan dan menyebarkan pengetahuan pembelajaran yang ada di Alfamidi. Kami juga menyimpan informasi-informasi mengenai berbagai acara. Yuk kepoin Knowledge Management!</p>
                                <p>Kami memiliki:</p>
                                <ul style="list-style-type: none;">
                                    <li> <b>10+</b> Repository</li>
                                    <li> <b>10+</b> Jurnal Belajar</li>
                                    <li> <b>10+</b> Self Learning</li>
                                </ul>
                            </div>
                            <div class="p-2">
                              <img src="{{ asset('icon/karaktermidi-10.png') }}" height="300"  class="rounded mx-auto d-block" alt="...">
                            </div>
                            
                          </div>
                      </div>
                </div>
                <div class="card-body p-3">
                    <h1 class="h1 text-center">Knowledge Management Memiliki Banyak Program Belajar</h1>
                    <div class="row flex-column flex-md-row bg-primary-subtle p-5 rounded justify-content-between">
                        <div class="col col-md-3 mb-3 mb-sm-0">
                          <div class="card mb-3">
                            <div class="card-body">
                              <h5 class="card-title">Webinar</h5>
                              <p class="card-text" style="height: 90px">Kumpulan Rekaman Webinar Alfamidi yang informatif
                                dan relevan dengan kebutuhan sekarang
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col col-md-3">
                          <div class="card mb-3">
                            <div class="card-body">
                              <h5 class="card-title">Training</h5>
                              <p class="card-text" style="height: 90px">Kumpulan rekaman dan informasi mengenai Training Kompetensi di Alfamidi</p>
                            </div>
                          </div>
                        </div>
                        <div class="col col-md-3">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">COP</h5>
                              <p class="card-text" style="height: 90px">Kumpulan infomasi mengenai community of practice di Alfamidi</p>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="card mb-3 mt-5 border border-0" >
                    <div class="card-body bg-primary-subtle p-5 ">
                        <div class="d-flex flex-column flex-md-row justify-content-between">
                            <div class="p-2">
                                <h1>Dapatkan Ilmu dengan materi yang bisa kamu pelajari!</h1>
                                <p>Pelajari Lebih Lanjut di <a href="">Knowledge Center</a></p>
                                <img class="card-img-top image1 object-fit-fill "  src="{{ asset('icon/gmbr3.png') }}"  alt="Card image cap">
                            </div>
                            <div class="p-2">
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
</style>