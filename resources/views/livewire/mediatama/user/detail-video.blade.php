<div class="card">
    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
    </div>



    <button wire:click="detail_back()" type="button" class="btn bg-gradient-secondary">Kembali</button>

    <div class="card-body pt-2">
        <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">House</span>
        <a href="javascript:;" class="card-title h5 d-block text-darker">
            {{ $detail_name_video }}
        </a>
        <p class="card-description mb-4">
            PENERBIT DAN PERCETAKAN MEDIATAMA

            Mediatama Menjadi Penerbit dan Percetakan yang berkualitas dengan mengembangan keunggulan kompetitif di
            tingkat nasional khususnya dalam bidang pendidikan dan ikut berperan dalam mencerdaskan kehidupan Bangsa
            Indonesia.
        </p>

        @if(Auth::user()->level != 'admin')
            <button type="button" class="btn btn-secondary" wire:click.prevent="request_video()">
                <span>Request Video </span>
            </button>
        @endif

        <!-- <button type="button" class="btn btn-secondary" wire:click.prevent="request_video()">
            <span>Request Video </span>
        </button> -->

        @if($detail_status == 'menunggu-konfirmasi')
        <div class="alert alert-danger" role="alert">
            <strong>Maaf Anda Belum Bisa Akses</strong> Silahkan hub Admin untuk membuka video
        </div>
        @endif

        @if($detail_status == 'tutup-akses')
        <div class="alert alert-danger" role="alert">
            <strong>Maaf Anda Belum Bisa Akses</strong> Silahkan hub Admin untuk membuka video
        </div>
        @endif

        @if($detail_status == 'buka-akses' && $detail_url_video == 'habis')
        <div class="alert alert-danger" role="alert">
            <strong>Maaf Anda Belum Bisa Akses</strong> Silahkan hub Admin untuk membuka video
        </div>
        @endif




        @if($detail_url_video != 'habis' && $detail_status == 'buka-akses' )
        <div class="alert alert-success" role="alert">
            <strong>Selamat akses video telah dibuka</strong> Berikut adalah linknya
            <strong>Kamu bisa mengakses video ini sampai </strong> {{$date_end}}
        </div>

        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$detail_url_video}}"
                allowfullscreen></iframe>
        </div>

        <a href="https://www.youtube.com/embed/{{$detail_url_video}}">Klik disini juga bisa</a>
        @endif


        <!-- jika admin yg buka -->

        @if(Auth::user()->level == 'admin')
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$detail_url_video}}"
                allowfullscreen></iframe>
        </div>
        <a href="https://www.youtube.com/embed/{{$detail_url_video}}">Klik disini juga bisa</a>
        @endif



        <div class="author align-items-center">
            <div class="name ps-3">
                <div class="stats">
                    <small> Dibuat Pada
                        {{ Carbon\Carbon::parse($detail_created_at)->format('m/d/Y') }}

                    </small>
                </div>
            </div>
        </div>
    </div>
</div>