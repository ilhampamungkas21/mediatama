<div>
    <main class="main-content">
        <div class="container-fluid py-4">
            {{-- Tables --}}
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Tabel User</h6>
                        </div>

                        <div class="card-header pb-0">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#ModalCreate">
                                Tambah User
                            </button>
                        </div>



                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Level</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Terakhir di edit</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user as $data)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="../assets/img/team-2.jpg"
                                                            class="avatar avatar-sm me-3">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$data->name}}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{$data->email}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{$data->level}}</p>

                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{$data->updated_at}}</span>
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
    <div wire:ignore.self class="modal fade" id="ModalCreate" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Customer/Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- isi body -->

                    <form>
                        <input type="hidden" wire:model="user_id">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" wire:model.defer="email" class="form-control"
                                placeholder="name@example.com">
                            @error('email') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" wire:model.defer="name">
                            @error('name') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" wire:model.defer="password" class="form-control">
                            @error('password') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" wire:model.defer="level" id="exampleFormControlSelect1">
                                <option selected>Pilih Level</option>
                                <option value='customer'>Customer</option>
                                <option value='admin'>Admin</option>
                            </select>
                            @error('level') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </form>

                    <!-- end body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" wire:click.prevent="tambah_customer()">Add
                        Customer</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal update -->
    <div wire:ignore.self class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Customer/Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- isi body -->

                    <form>
                        <input type="hidden" wire:model="user_id">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" wire:model.defer="email" class="form-control"
                                placeholder="name@example.com" disabled>
                            @error('email') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" wire:model.defer="name">
                            @error('name') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" wire:model.defer="password" class="form-control"
                                placeholder="jika tidak ingin diubah kosongkan saja">

                        </div>

                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" wire:model.defer="level" id="exampleFormControlSelect1">
                                <option selected>Pilih Level</option>
                                <option value='customer'>Customer</option>
                                <option value='admin'>Admin</option>
                            </select>
                            @error('level') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </form>

                    <!-- end body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" wire:click.prevent="update_customer()">Update
                        Customer</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Model delete -->

    <div  wire:ignore.self class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
        aria-hidden="true">
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
                    <button type="button" class="btn btn-primary"  data-bs-dismiss="modal" wire:click.prevent="delete()">Hapus data ini</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




</div>