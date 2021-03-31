@extends('layouts.adminty')

@section('styles')
    {{-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files\assets\icon\themify-icons\themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files\assets\icon\icofont\css\icofont.css') }}">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files\assets\pages\data-table\css\buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}">
    
     <!-- sweet alert framework -->
     <link rel="stylesheet" type="text/css" href="{{ asset('files\bower_components\sweetalert\css\sweetalert.css') }}">

    <!-- animation nifty modal window effects css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files\assets\css\component.css') }}">
    
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files\assets\css\style.css') }}">


@endsection

@section('content')
    <div class="page-body button-page">
        <div class="row">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="#"><h3>Daftar User</h3></a></li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary waves-effect md-trigger" data-modal="modal-1">
                                Tambah User
                            </button>
                            <button type="button" id="edit-button" class="d-none btn btn-primary waves-effect md-trigger" data-modal="modal-2">
                                Edit User
                            </button>
                            {{-- <button onclick="deleteConfirmation()" class="d-none">
                                <i class="fas fa-trash"></i>
                              </button> --}}
                              {{-- <form id="delete-user-form" class="d-none" action="" method="post">
                                @method('DELETE')
                                @csrf 
                              </form> --}}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <!-- Ajax Sourced Data table start -->
                <div class="card">
                    <div class="card-header">
                        <div class="dropdown-inverse dropdown open">
                            <button class="btn btn-inverse dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export</button>
                            <div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a href="{{route('dashboard.user.export_excel')}}" class="dropdown-item waves-light waves-effect">Excel</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table id="user-table" class="table table-striped table-bordered nowrap yajra-datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>UUID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>UUID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            <!-- Ajax Sourced Data table end -->
            </div>
          
          <div class="col-sm-12">
              <div class="card">
                  <div class="card-block">
                    <div class="animation-model">
                        
                        <div class="md-modal md-effect-2" id="modal-2">
                            <div class="md-content">
                                <h3>Update User</h3>
                                    <div class="modal-body">
                                        <div class="card-block">
                                           
                                            <form id="update" action="{{ route('dashboard.user.update') }}" method="post" enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" id="uuid" name="uuid" value="">

                                                <div class="img-hover mb-4" style="max-height:200px; max-width:200px;">
                                                    <img class="img-fluid img-radius" id="modal-img" src="" alt="round-img" style="max-height:200px; max-width:200px;">
                                                    <div class="img-overlay img-radius">
                                                        <span>
                                                            <input type="file" id="update-profile_picture" name="profile_picture">
                                                        </span>
                                                    </div>
                                                    <div class="alert-message" id="updateProfilePictureError" style="color: red;"></div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="update-name" name="name" placeholder="Enter Username">
                                                        <div class="alert-message" id="updateNameError" style="color: red;"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="update-email" name="email" placeholder="Enter email">
                                                        <div class="alert-message" id="updateEmailError" style="color: red;"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="update-password" name="password" placeholder="Enter New password">
                                                        <div class="alert-message" id="udpatePasswordError" style="color: red;"></div>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Profile Picture</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" name="profile_picture">
                                                        <div class="alert-message" id="updateProfilePictureError" style="color: red;"></div>
                                                    </div>
                                                </div> --}}
                                                <div class="modal-footer justify-content-between">
                                                    <button type="submit" class="btn btn-primary m-b-0" id="edit">Submit</button>
                                                    <button type="button" class="btn btn-primary waves-effect md-close">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="md-modal md-effect-1" id="modal-1">
                            <div class="md-content">
                                <h3>Tambah User</h3>
                                    <div class="modal-body">
                                        <div class="card-block">
                                            <form id="tambah" action="{{ route('dashboard.user.create') }}" method="post" novalidate="" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Username">
                                                        <div class="alert-message" id="nameError" style="color: red;"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                                                        <div class="alert-message" id="emailError" style="color: red;"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Profile Picture</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" name="update-profile_picture" name="profile_picture">
                                                        <div class="alert-message" id="profilePictureError" style="color: red;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="submit" class="btn btn-primary m-b-0" id="simpan">Submit</button>
                                            <button type="button" class="btn btn-primary waves-effect md-close">Close</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        
                    <!--animation modal  Dialogs ends -->
                    <div class="md-overlay"></div>
                  </div>
                  </div>
              </div>
          </div>
         
          
          
        </div>
    </div>
@endsection
   
@push('javascripts')
    
<script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
  <!-- data-table js -->
  <script src="{{ asset('files\bower_components\datatables.net\js\jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('files\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('files\assets\pages\data-table\js\jszip.min.js') }}"></script>
  {{-- <script src="{{ asset('files\assets\pages\data-table\js\pdfmake.min.js') }}"></script> --}}
  <script src="{{ asset('files\assets\pages\data-table\js\vfs_fonts.js') }}"></script>
  <script src="{{ asset('files\bower_components\datatables.net-buttons\js\buttons.print.min.js') }}"></script>
  <script src="{{ asset('files\bower_components\datatables.net-buttons\js\buttons.html5.min.js') }}"></script>
  <script src="{{ asset('files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('files\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('files\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>
  <!-- i18next.min.js -->
  <script type="text/javascript" src="{{ asset('files\bower_components\i18next\js\i18next.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('files\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('files\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('files\bower_components\jquery-i18next\js\jquery-i18next.min.js') }}"></script>
  
<!-- sweet alert js -->
<script type="text/javascript" src="{{ asset('files\bower_components\sweetalert\js\sweetalert.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('files\assets\js\modal.js') }}"></script> --}}
<!-- sweet alert modal.js intialize js -->
<!-- modalEffects js nifty modal window effects -->
<script type="text/javascript" src="{{ asset('files\assets\js\modalEffects.js') }}"></script>
<script type="text/javascript" src="{{ asset('files\assets\js\classie.js') }}"></script>
  
  <!-- Custom js -->
  <script src="{{ asset('files\assets\pages\data-table\js\data-table-custom.js') }}"></script>

<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.user.all') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'uuid', name: 'uuid'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {
                data: 'action', 
                name: 'action',
                orderable: false, 
                searchable: false,
            },
        ]
    });
    
  });
</script>

<script>
    $(document).ready(function() {
        var form = $("#tambah");

    $('#simpan').on('click', function(e) {
      e.preventDefault();
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function(data) {
        var userTable = $('#user-table').dataTable();
        userTable.fnDraw(false); // reset data table
        Toast.fire({
            icon: 'success',
            title: 'Berhasil menambahkan user baru',
        });
        $('.alert-message').empty();
        },
        error: function(data) {
              console.log(data);
              $('#nameError').text(data.responseJSON.errors.name);
              $('#emailError').text(data.responseJSON.errors.email);
              $('#profilePictureError').text(data.responseJSON.errors.profile_picture);
           }
        });
    });

        $('.md-close').on('click', function() {
            $('.alert-message').empty();
        });
    });

    $('.yajra-datatable').on('click', '.edit-data', function() {
        var uuid = $(this).data('uuid');
        $.get('user/edit/'+uuid, function(data) {
            $('#edit-button').click();
            $('#update-name').val(data.name);
            $('#update-email').val(data.email);
            $('#uuid').val(data.uuid);
            
            $('#modal-img').attr('src', data.profile_picture);
        });
    });

    $(document).ready(function() {
        
        $('#edit').on('click', function(e) {
            e.preventDefault();
            var formData = new FormData($("#update")[0]);
            var profile_picture = $('#update-profile_picture')[0].files[0];
            // formData.append('_method', 'put');
            // formData.append('profile_picture', profile_picture);

            $.ajax({
                type: 'put',
                url: "{{ route('dashboard.user.update') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                console.log(data);
                var userTable = $('#user-table').dataTable();
                userTable.fnDraw(false); // reset data table
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil update data user',
                });
                $('.alert-message').empty();
                $('#modal-2').modal('hide');
                },
                error: function(data) {
                    console.log(data);
                    $('#updateNameError').text(data.responseJSON.errors.name);
                    $('#updateEmailError').text(data.responseJSON.errors.email);
                    $('#updatePasswordError').text(data.responseJSON.errors.password);
                    $('#updateProfilePictureError').text(data.responseJSON.errors.profile_picture);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $('.yajra-datatable').on('click', '.delete-data', function() {
        var uuid = $(this).data('uuid');
        var nama_user = $(this).data('nama_user');
        deleteConfirmation(uuid, nama_user);
    });

    function deleteConfirmation(uuid, nama_user) {
        Swal.fire({
            title: "Hapus user "+nama_user,
            text: "Menghapus user juga akan menghapus data terkait dari user tersebut, Apakah anda tetap ingin melanjutkan ?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak, batalkan!",
            reverseButtons: !0
        }).then(function (e) {
  
            if (e.value === true) {

                $.ajax({
                    type: 'DELETE',
                    url: 'user/delete/'+uuid,
                    success : function(data) {
                        var userTable = $('#user-table').dataTable();
                        userTable.fnDraw(false);
                        Swal.fire({
                            title: "Berhasil",
                            text: "Data user "+nama_user+"telah di hapus",
                            icon: "success",
                        });
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });

                /* without ajax */
                // var delete_form = $('#delete-user-form');
                // delete_form.attr('action', 'user/delete/'+uuid)
                // delete_form.submit();

            } else {
                e.dismiss;
            }
  
        }, function (dismiss) {
            return false;
        })
    }
  </script>

@endpush
