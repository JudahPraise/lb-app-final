@extends('welcome')

@section('main')
    @component('components.alerts')@endcomponent
    @component('components.cookie')@endcomponent
    <div class="container-fluid d-flex justify-content-center mt-5 mb-5">
        <div class="row w-75" style="height: 76.3vh;">
            <div class="col-md-6 d-none d-sm-block p-md-5">
                <h2 class="d-flex align-items-center"><a href="{{ route('welcome') }}" class="text-dark"><i class="far fa-arrow-alt-circle-left mr-3" style="font-size: 17pt;"></i></a>REGISTER</h2>
                <img src="{{ asset('images/build.png') }}" alt="" srcset="" style="width: 90%; height: 90%">
            </div>
            <div class="col-md-6 p-md-5 d-flex align-items-center">
                <form action="{{ route('register.store') }}" method="POST"  enctype="multipart/form-data"> 
                    @csrf
                    <div class="container p-0 d-lg-none d-md-block mb-3">
                        <h2>REGISTER</h2>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" class="form-control" name="firstname" id="exampleInputEmail1" style="font-size: 10pt;">
                        </div> 
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Middle Name</label>
                            <input type="text" class="form-control" name="lastname" id="exampleInputEmail1" style="font-size: 10pt;">
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" class="form-control" name="middlename" id="exampleInputEmail1" style="font-size: 10pt;">
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" id="exampleInputEmail1" style="font-size: 10pt;">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Gender</label>
                            <select class="form-control" name="gender" id="exampleFormControlSelect1" style="font-size: 10pt;">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Contact Number</label>
                        <input type="text" class="form-control" name="contact_no" id="exampleInputEmail1" style="font-size: 10pt;">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Email Address</label>
                        <input type="email" class="form-control" name="email_address" id="exampleInputEmail1" style="font-size: 10pt;">
                    </div>
                    <div class="form-group mb-3">
                        <label for="resume">Resume</label>
                        <input class="file-input" type="file" name="file">
                        <br>
                        <span class="text-danger">*Kindly upload PDF format of your resume</span>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="resume_permission" id="customSwitch1" value="1">
                        <label class="custom-control-label" for="customSwitch1">Toggle this if you want to give employer a permission to download or print your resume</label>
                    </div>

                    <button type="submit" class="btn btn-dark float-right">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection