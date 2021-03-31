@extends('layouts.adminty')

@section('styles')
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files\bower_components\font-awesome\css\font-awesome.min.css') }}">
    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files\assets\pages\advance-elements\css\bootstrap-datetimepicker.css') }}">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files\bower_components\bootstrap-daterangepicker\css\daterangepicker.css') }}">
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files\bower_components\datedropper\css\datedropper.min.css') }}">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files\assets\icon\themify-icons\themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files\assets\icon\icofont\css\icofont.css') }}">
@endsection

@section('content')
<div class="page-wrapper">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>User Profile</h4>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">User Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

        <!-- Page-body start -->
        <div class="page-body">
            <!--profile cover start-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="cover-profile">
                        <div class="profile-bg-img">
                            <img class="profile-bg-img img-fluid" src="{{ asset('files\assets\images\user-profile\bg-img1.jpg') }}" alt="bg-img">
                            <div class="card-block user-info">
                                <div class="col-md-12">
                                    <div class="media-left">
                                        <form id="form-update-profile_picture" action="{{ route('dashboard.user.profile.change-profile-picture') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="img-hover profile-image" style="max-height:200px; max-width:200px;">
                                                <img class="img-fluid img-radius" src="{{ $user->profile_picture }}" alt="user-img" style="max-height: 150px; max-width: 150px">
                                                <div class="img-overlay img-radius">
                                                    <span>
                                                        <input type="hidden" name="uuid" value="{{ $user->uuid}}">
                                                        <input type="file" id="update-profile_picture" name="profile_picture">
                                                    </span>
                                                </div>
                                                <div class="alert-message" id="updateProfilePictureError" style="color: red;"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="media-body row">
                                        <div class="col-lg-12">
                                            <div class="user-title">
                                                <h2>{{ ucfirst($user->name) }}</h2>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="pull-right cover-btn">
                                                <button type="button" class="btn btn-primary m-r-10 m-b-5"><i class="icofont icofont-plus"></i> Follow</button>
                                                <button type="button" class="btn btn-primary"><i class="icofont icofont-ui-messaging"></i> Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--profile cover end-->
            <div class="row">
                <div class="col-lg-12">
                    <!-- tab header start -->
                    <div class="tab-header card">
                        <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Personal Info</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                    </div>
                    <!-- tab header end -->
                    <!-- tab content start -->
                    <div class="tab-content">
                        <!-- tab panel personal start -->
                        <div class="tab-pane active" id="personal" role="tabpanel">
                            <!-- personal card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-header-text">About Me</h5>
                                    <button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
                                        <i class="icofont icofont-edit"></i>
                                    </button>
                                </div>
                                <div class="card-block">
                                    <div class="view-info">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="general-info">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-xl-6">
                                                            <div class="table-responsive">
                                                                <table class="table m-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">Name</th>
                                                                            <td>{{ $user->name }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- end of table col-lg-6 -->
                                                        <div class="col-lg-12 col-xl-6">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">Email</th>
                                                                            <td>{{ $user->email }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- end of table col-lg-6 -->
                                                    </div>
                                                    <!-- end of row -->
                                                </div>
                                                <!-- end of general info -->
                                            </div>
                                            <!-- end of col-lg-12 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <!-- end of view-info -->
                                    <div class="edit-info">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="general-info">
                                                    <form id="update-profile" method="POST" action="{{ route('dashboard.user.profile.update') }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="hidden" name="uuid" value="{{ $user->uuid}}">

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                                                                    <input type="text" name="name" class="form-control" placeholder="User Name">
                                                                                </div>
                                                                                <div class="alert-message" id="updateNameError" style="color: red;"></div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-ui-email"></i></span>
                                                                                    <input type="email" name="email" class="form-control" placeholder="Email Address">
                                                                                </div>
                                                                                <div class="alert-message" id="updateEmailError" style="color: red;"></div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-ui-password"></i></span>
                                                                                    <input type="text" name="password" class="form-control" placeholder="Password">
                                                                                </div>
                                                                                <div class="alert-message" id="updatePasswordError" style="color: red;"></div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <!-- end of table col-lg-6 -->
                                                            <div class="col-lg-6">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
                                                                                    <input type="text" class="form-control" placeholder="Mobile Number">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-social-twitter"></i></span>
                                                                                    <input type="text" class="form-control" placeholder="Twitter Id">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" id="basic-addon1">@</span>
                                                                                    <input type="text" class="form-control" placeholder="Twitter Id">
                                                                                </div>
                                                                            </td>
                                                                        </tr> -->
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-social-skype"></i></span>
                                                                                    <input type="email" class="form-control" placeholder="Skype Id">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-earth"></i></span>
                                                                                    <input type="text" class="form-control" placeholder="website">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <!-- end of table col-lg-6 -->
                                                        </div>
                                                        <!-- end of row -->
                                                        <div class="text-center">
                                                            <button type="submit" id="edit" class="btn btn-primary waves-effect waves-light m-r-20">Save</button>
                                                            <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                        </div>
                                                    </form>
                                                   
                                                </div>
                                                <!-- end of edit info -->
                                            </div>
                                            <!-- end of col-lg-12 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <!-- end of edit-info -->
                                </div>
                                <!-- end of card-block -->
                            </div>
                            {{-- <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-header-text">Description About Me</h5>
                                            <button id="edit-info-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
                        <i class="icofont icofont-edit"></i>
                    </button>
                                        </div>
                                        <div class="card-block user-desc">
                                            <div class="view-desc">
                                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?" "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able To Do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pain.</p>
                                            </div>
                                            <div class="edit-desc">
                                                <div class="col-md-12">
                                                    <textarea id="description">
                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?" "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able To Do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pain.</p>
                            </textarea>
                                                </div>
                                                <div class="text-center">
                                                    <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20 m-t-20">Save</a>
                                                    <a href="#!" id="edit-cancel-btn" class="btn btn-default waves-effect m-t-20">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- personal card end--> --}}
                        </div>
                        <!-- tab pane personal end -->
                    </div>
                    <!-- tab content end -->
                </div>
            </div>
        </div>
        <!-- Page-body end -->
</div>

@endsection

@push('javascripts')
    
<!-- Page specific js-->
        
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('files\bower_components\modernizr\js\css-scrollbars.js') }}"></script>

    <!-- Bootstrap date-time-picker js -->
    <script type="text/javascript" src="{{ asset('files\assets\pages\advance-elements\moment-with-locales.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files\bower_components\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files\assets\pages\advance-elements\bootstrap-datetimepicker.min.js') }}"></script>
    <!-- Date-range picker js -->
    <script type="text/javascript" src="{{ asset('files\bower_components\bootstrap-daterangepicker\js\daterangepicker.js') }}"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="{{ asset('files\bower_components\datedropper\js\datedropper.min.js') }}"></script>
    <!-- data-table js -->
    <script src="{{ asset('files\bower_components\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('files\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('files\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>
    <!-- ck editor -->
    <script src="{{ asset('files\assets\pages\ckeditor\ckeditor.js') }}"></script>
    <!-- echart js -->
    <script src="{{ asset('files\assets\pages\chart\echarts\js\echarts-all.js') }}" type="text/javascript"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{ asset('files\bower_components\i18next\js\i18next.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files\bower_components\jquery-i18next\js\jquery-i18next.min.js') }}"></script>
    <script src="{{ asset('files\assets\pages\user-profile.js') }}"></script>
    <script src="{{ asset('files\assets\js\pcoded.min.js') }}"></script>
    <script src="{{ asset('files\assets\js\vartical-layout.min.js') }}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{ asset('files\assets\js\script.js') }}"></script>

    <script>
    $(document).ready(function() {
        
        $('#edit').on('click', function(e) {
            e.preventDefault();
            var form = $('#update-profile'); 

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function(data) {
                console.log(data);
                window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                    $('#updateNameError').text(data.responseJSON.errors.name);
                    $('#updateEmailError').text(data.responseJSON.errors.email);
                    $('#updatePasswordError').text(data.responseJSON.errors.password);
                }
            });
        });

        $('#edit-cancel').on('click', function() {
            var form = $('#update-profile');
            form.trigger('reset');
            $('.alert-message').empty();
        });

    });
    </script>

    <script type="text/javascript">
        document.getElementById('update-profile_picture').onchange = function() {
            document.getElementById('form-update-profile_picture').submit();
        };
    </script>
@endpush
