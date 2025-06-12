@extends('dashboard.layouts.app')
@section('title', 'تعديل الملف الشخصى')
@section('css')
<link href="{{ asset('assets/libs/quill/dist/quill.snow.css') }}" rel="stylesheet" />
@endsection
@section('js')
<script src="{{ asset('assets/libs/quill/dist/quill.min.js') }}"></script>

@endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">الرئيسية /</span> تعديل الملف الشخصى</h4>

    <div class="row">
        <div class="col-md-12">

            <div class="card mb-4">
                <h5 class="card-header">تعديل الملف الشخصى</h5>
                <!-- Account -->

                <hr class="my-0" />
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('updateProfile') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">الاسم</label>
                                <input
                                    class="form-control"
                                    type="text"

                                    value="{{ auth()->user()->name }}"
                                    name="name" placeholder="الاسم"
                                    autofocus />
                                @error('name')
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">الايميل</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="email"
                                    value="{{ auth()->user()->email }}"
                                    name="email" placeholder="الايميل" />
                                @error('email')
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label"> كلمة المرور
                                    تترك فارغة لعدم التعديل</label>
                                <input
                                    type="password"
                                    class="form-control"

                                    name="password" />
                                @error('password')
                                <div class="text-danger">{{ $errors->first('password') }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label"> تأكيد كلمة المرور
                                    تترك فارغة لعدم التعديل</label>
                                <input
                                    type="password"
                                    class="form-control"

                                    name="password_confirmation" />
                                @error('password_confirmation')
                                <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">حفظ</button>
                            <button type="reset" class="btn btn-outline-secondary">إلغاء</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>

        </div>
    </div>
</div>


@endsection