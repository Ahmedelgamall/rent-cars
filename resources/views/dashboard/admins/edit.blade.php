@extends('dashboard.layouts.app')
@section('title', getTranslatedWords('edit admin'))
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/select2.min.css') }}" />
@endsection
@section('js')
    <script src="{{ asset('assets/libs/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>

    <script>
        //***********************************//
        // For select 2
        //***********************************//
        $(".select2").select2();
    </script>
@endsection
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ getTranslatedWords('home') }} /</span>
            {{ getTranslatedWords('edit admin') }}</h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">{{ getTranslatedWords('edit admin') }}</h5>
                    <!-- Account -->

                    <hr class="my-0" />
                    <div class="card-body">
                        <form enctype="multipart/form-data" id="formAccountSettings" method="POST"
                            action="{{ route('admins.update', $row->id) }}">
                            @csrf
                            @method('put')

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('name') }}</label>
                                    <input type="text" value="{{ $row->name }}" class="form-control" name="name"
                                        placeholder="{{ getTranslatedWords('name') }}">
                                    @error('name')
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('email') }}</label>
                                    <input type="text" value="{{ $row->email }}" class="form-control" name="email"
                                        placeholder="{{ getTranslatedWords('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('password') }}
                                        ({{ getTranslatedWords('leave blank to not updating') }})</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="{{ getTranslatedWords('password') }}">
                                    @error('password')
                                        <div class="text-danger">{{ $errors->first('password') }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email"
                                        class="form-label">{{ getTranslatedWords('password confirmation') }}
                                        ({{ getTranslatedWords('leave blank to not updating') }})</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder=" {{ getTranslatedWords('password confirmation') }}">
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email"
                                        class="form-label">{{ getTranslatedWords('roles') }}</label>
                                    <select style="height: 36px; width: 100%" id="country"
                                        class="select2 form-select discount_type" multiple="multiple" name="roles[]">
                                        @foreach (config('permission.models.role')::get() as $role)
                                            <option value="{{ $role->id }}"
                                                @if (in_array($role->id, $row->roles->pluck('id')->toArray())) selected @endif>{{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <div class="text-danger">{{ $errors->first('roles') }}</div>
                                    @enderror
                                </div>










                            </div>



                            <div class="mt-2">
                                <button type="submit"
                                    class="btn btn-primary me-2">{{ getTranslatedWords('submit') }}</button>
                                <button type="reset"
                                    class="btn btn-outline-secondary">{{ getTranslatedWords('cancel') }}</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>

            </div>
        </div>
    </div>
@endsection