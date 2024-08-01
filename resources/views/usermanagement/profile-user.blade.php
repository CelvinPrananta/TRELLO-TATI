@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            {{-- message --}}
            {!! Toastr::message() !!}
            
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" data-fancybox="foto-profil">
                                            <img alt="{{ Auth::user()->name }}" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" loading="lazy">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic pro-overview tab-pane fade show active">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="pro-edit">
                                                <a data-target="#foto_profile" data-toggle="modal" class="edit-icon-avatar" href="#">
                                                    <i class="fa-solid fa-camera-retro fa-lg"></i>
                                                </a>
                                            </div>
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $information->name }}</h3>
                                                <div class="staff-id">Account ID : {{ Session::get('user_id') }}</div>
                                                <div class="small doj text-muted">Join Date : {{ \Carbon\Carbon::parse(Session::get('join_date'))->translatedFormat('l, j F Y || h:i A') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                @if (!empty($information))
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                            <div class="title">Full Name</div>
                                                            <div class="text">{{ $information->name }}</div>
                                                        @else
                                                            <div class="title">Full Name</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                            <div class="title">E-mail</div>
                                                            <a href="mailto:{{ $information->email }}"><div class="text">{{ $information->email }}</div></a>
                                                        @else
                                                            <div class="title">E-mail</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                            <div class="title">Username</div>
                                                            <div class="text">{{ $information->username }}</div>
                                                        @else
                                                            <div class="title">Username</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                            <div class="title">Employee ID</div>
                                                            <div class="text">{{ $information->employee_id }}</div>
                                                        @else
                                                            <div class="title">Employee ID</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->user_id == $information->user_id)
                                                            <div class="title">Date of Birth</div>
                                                            <div class="text">{{ date('d F Y', strtotime($information->tgl_lahir)) }}</div>
                                                        @else
                                                            <div class="title">Date of Birth</div>
                                                            <div class="text">N/A</div>
                                                        @endif
                                                    </li>
                                                @else
                                                    <li>
                                                        <div class="title">Full Name</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">E-mail</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Username</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Employee ID</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Date of Birth</div>
                                                        <div class="text">N/A</div>
                                                    </li>
                                                @endif<br>
                                                <a href='#' class='btn btn-outline-danger' data-toggle='modal' data-target='#hapus_pengguna'><i class="fa fa-trash-o m-r-5"></i> Delete Account</a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit">
                                    <a data-target="#data_pengguna" data-toggle="modal" class="edit-icon" href="#">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->

        @if (!empty($information))
            <!-- Update Data Pengguna Modal -->
            <div id="data_pengguna" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('profile/perbaharui/data-pengguna2') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly placeholder="Enter a name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>E-mail</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly placeholder="Enter your email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" readonly placeholder="Enter your username">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Employee ID</label>
                                                    <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ Auth::user()->employee_id }}" readonly placeholder="Enter your employee id">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of Birth</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate" value="{{ $information->tgl_lahir }}" placeholder="Enter your date of birth">
                                                        <small class="text-danger">Example : 10-10-2023</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" class="form-control" id="avatar" name="avatar" value="{{ $user->avatar }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Update Data Pengguna Modal -->
        @else
            <!-- Update Data Pengguna Modal -->
            <div id="data_pengguna" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('profile/perbaharui/data-pengguna2') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly placeholder="Enter a name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>E-mail</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly placeholder="Enter your email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" readonly placeholder="Enter your username">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Employee ID</label>
                                                    <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ Auth::user()->employee_id }}" readonly placeholder="Enter your employee id">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of Birth</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate" placeholder="Enter your date of birth">
                                                        <small class="text-danger">Example : 10-10-2023</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" class="form-control" id="avatar" name="avatar" value="{{ $user->avatar }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Update Data Pengguna Modal -->
        @endif

        <!-- Hapus Akun Modal -->
        <div id="hapus_pengguna" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Account</h3>
                            <p>Are you sure you want to delete your aacount?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('data/pengguna/hapus') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Yes</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">No</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Hapus Akun Modal -->

        @if (!empty($information))
            <!-- Update Foto Profil Modal -->
            <div id="foto_profile" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Profile Picture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('profile/perbaharui/foto') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" id="imagePreview" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" loading="lazy">
                                            <div class="fileupload btn">
                                                <span class="btn-text">Upload</span>
                                                <input class="upload" type="file" id="image" name="images" onchange="previewImage(event)">
                                                <input type="hidden" name="hidden_image" id="e_image" value="{{ Auth::user()->avatar }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Update Foto Profil Modal -->
        @else
            <!-- Update Foto Profil Modal -->
            <div id="foto_profile" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Profile Picture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('profile/perbaharui/foto') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" id="imagePreview" src="{{ URL::to('/assets/images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" loading="lazy">
                                            <div class="fileupload btn">
                                                <span class="btn-text">Upload</span>
                                                <input class="upload" type="file" id="image" name="images" onchange="previewImage(event)">
                                                <input type="hidden" name="hidden_image" id="e_image" value="{{ Auth::user()->avatar }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                                                    <input type="hidden" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Update Foto Profil Modal -->
        @endif

    </div>
    <!-- /Page Wraper -->

    @section('script')
        <script>
            function previewImage(event) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('imagePreview').src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <!-- FancyBox Foto Profil -->
        <script>
            $(document).ready(function() {
                $('[data-fancybox="foto-profil"]').fancybox({
                });
            });
        </script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
        <!-- /FancyBox Foto Profil -->

        <script>
		    $(".theSelect").select2();
	    </script>

        <script>
            @if (Auth::user()->role_name == 'User') 
                document.getElementById('pageTitle').innerHTML = 'Profile Settings - User | Loghub - PT TATI';
            @endif
        </script>

        <script src="{{ asset('assets/js/memuat-ulang.js') }}"></script>

    @endsection
@endsection