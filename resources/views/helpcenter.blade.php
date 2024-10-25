@extends('layouts.layouts')

@section('content')
<section class="gradient-bg py-1">
    <div class="container-fluid p-5 text-center mt-4">
        <div class="form-container">
            <h1 class="form-header text-center">Hai! Ada yang perlu kami bantu Midiers?</h1>
            <p class="form-label text-center">Tulis pengaduan mu dibawah ini ya!</p>
            <div class="row">
                <div class="col-6">
                    <img id="rotatingIcon" class="icon-form" src="{{ asset('icon/helpcenter.png') }}" alt="">
                </div>
                <div class="col-md-6 text-desktop">
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <form id="contactForm" class="">
                                <div class="form-group">
                                    <label for="fullname">Nama lengkap</label>
                                    <input type="text" id="fullname" name="fullname" required>
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Branch</label>
                                    <input type="text" id="branch" name="branch" required>
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Pengaduan</label>
                                    <textarea name="pengaduan" id="pengaduan" cols="30" rows="10" required></textarea>
                                </div>
                                <button class="buton-form" type="submit">Kirim!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<div style="height: 60px;"></div>
<style>
        .form-container {
            color: white;
            background-color: #0253BB;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        .text-desktop{
            margin-top: 100px;
        }
        .icon-form {
        height: 50vh;
        }
        #contactForm{
            width: 100%;
            max-width: 500px;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        input, select, textarea {
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
        h1 {
            font-size: 1.5rem;
        }

        .icon-form {
        height: 30vh;
    }
}
</style>
<script>
    document.getElementById('contactForm').addEventListener('submit', function(e){
        e.preventDefault();
        
        const fullname = document.getElementById('fullname').value;
        const branch = document.getElementById('branch').value;
        const pengaduan = document.getElementById('pengaduan').value;

        const email = "teddy.a.pradipta@mu.ac.id";
        const subject = `${branch}`;
        const body = `Halo, saya dari branch ${branch} mengalami sebuah permasalahan yaitu:\n\n${pengaduan}\n\nTerima kasih`;

        const mailtoUrl = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
        window.location.href = mailtoUrl;
    });

</script>
@endsection
