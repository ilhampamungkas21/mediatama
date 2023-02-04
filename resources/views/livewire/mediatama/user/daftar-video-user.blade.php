<div>
    @if($detail)
    @include('livewire.mediatama.user.detail-video')


    @else
    <div class="card-group">
        @foreach($video as $data)
        <div class="card">
            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                <a href="javascript:;" class="d-block">
                    <img src="{{asset('assets/img/team-3.jpg')}}" class="img-fluid border-radius-lg">

                </a>
            </div>

            <div class="card-body pt-2">
                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">Mediatama</span>
                <p class="card-title h5 d-block text-darker">
                    {{$data->name_video}}
                </p>
                <button wire:click="detail({{ $data->id }})" type="button" class="btn bg-gradient-secondary">Lihat Video</button>
                <div class="author align-items-center">
                    <div class="name ps-3">
                        <div class="stats">
                            <small> Dibuat Pada
                                {{ Carbon\Carbon::parse($data->created_at)->format('m/d/Y') }}

                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>