<div>
    <main class="main-content">
        <div class="container-fluid py-4">
            {{-- Tables --}}
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Tabel Request Video</h6>
                        </div>

                        <div class="card-header pb-0">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#ModalCreate">
                                Tambah Akses dari admin
                            </button>
                        </div>


                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama Video</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Customer</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Akses Awal</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Akses Akhir</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($request as $data)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">

                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"> {{$data->video->name_video}} </h6>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"> {{$data->user->name}} </p>

                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    @if($data->status == 'request-yes' )
                                                    sudah dikonfirmasi
                                                    @else
                                                    {{$data->status}}
                                                    @endif
                                                </span>



                                                @if($data->acces_end < $time_now ) <p
                                                    class="text-xs text-secondary mb-0">Butuh diperbarui</p>
                                                    @endif

                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{$data->acces_start}} </span>
                                            </td>

                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{$data->acces_end}} </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="btn-group">

                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#ModalUpdate"
                                                        wire:click="edit({{ $data->id }})">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                        edit
                                                    </button>


                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#modal-delete"
                                                        wire:click="deleteId({{ $data->id }})">
                                                        <i class="fa fa-fw fa-times"></i>
                                                        delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>


    <!-- Modal Create -->
    <div wire:ignore.self class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- isi body -->

                    <form>

                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Nama User</label>
                                    <div wire:ignore>
                                        <select class="form-control" id="select2-dropdown" wire:model.lazy='user_id'
                                            style="width: 100%">
                                            <option selected>Pilih Customer</option>
                                            @foreach($customer as $data_customer)
                                            <option value="{{ $data_customer->id }}">{{ $data_customer->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('user_id') <span class="error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Pilih Video</label>
                                    <div wire:ignore>
                                        <select class="form-control" id="select2-dropdown2" wire:model.defer='video_id'
                                            style="width: 100%">
                                            <option selected>Pilih Video</option>
                                            @foreach($video as $data_video)
                                            <option value="{{ $data_video->id }}">{{ $data_video->name_video }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('video_id') <span class="error">{{ $message }}</span>@enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">

                                    <div wire:ignore>
                                        <label>Acces Start</label>
                                        <input type="datetime-local" class="form-control"
                                            wire:model.defer="acces_start">
                                      
                                    </div>
                                    @error('acces_start') <span class="error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
            
                                    <div wire:ignore>
                                        <label>Acces End</label>
                                        <input type="datetime-local" class="form-control"
                                            wire:model.defer="acces_end">
                                     
                                    </div>
                                    @error('acces_end') <span class="error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>





                    </form>

                    <!-- end body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" wire:click.prevent="close_modal()">Close</button>
                    <button type="button" id='target' class="btn btn-success" wire:click.prevent="tambah_akses()">
                        Beri Akses (Save)</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal update -->
    <div wire:ignore.self class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Request Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- isi body -->

                    <form>
                        <input type="hidden" wire:model="video_id">



                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Start </label>
                                    <input type="datetime-local" class="form-control" wire:model.defer="acces_start">
                                    @error('acces_start') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>End </label>
                                    <input type="datetime-local" class="form-control" wire:model.defer="acces_end">
                                    @error('acces_end') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Nama Customer</label>
                                    <input type="text" class="form-control" wire:model.defer="id_user" disabled>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Url</label>
                                    <input type="text" class="form-control" wire:model.defer="id_video" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi</label>


                            <select class="form-control" wire:model.defer="status" id="exampleFormControlSelect1">
                                <option>Pilih status</option>
                                <option value='buka-akses'>Buka Akses</option>
                                <option value='tutup-akses'>Tutup Akses</option>
                            </select>
                            @error('status') <span class="error">{{ $message }}</span> @enderror

                        </div>



                    </form>

                    <!-- end body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" wire:click.prevent="update_request()">Update
                        Customer</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Model delete -->

    <div wire:ignore.self class="modal fade" id="modal-delete" tabindex="-1" role="dialog"
        aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="text-gradient text-danger mt-4">Anda Yakin</h4>
                        <p>Data akan permanen dihapus
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        wire:click.prevent="delete()">Hapus data ini</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    @section('scripts-datepicker')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
    config = {
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
        position: 'center',
        time_24hr: true,
    }
    flatpickr("input[type=datetime-local]", config);
    </script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#select2-dropdown').select2({
            dropdownParent: $("#ModalCreate")
        });
        $('#select2-dropdown').on('change', function(e) {
            var data_id_user = $('#select2-dropdown').val();
            @this.set('user_id', data_id_user);
        });

        $('#select2-dropdown2').select2({
            dropdownParent: $("#ModalCreate")
        });
        $('#select2-dropdown2').on('change', function(e) {
            var data_id_video = $('#select2-dropdown2').val();
            @this.set('video_id', data_id_video);

        });


    });
    </script>



    @endsection






</div>