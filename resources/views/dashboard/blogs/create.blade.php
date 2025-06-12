@extends('dashboard.layouts.app')
@section('title', getTranslatedWords('add blog'))
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/select2.min.css') }}" />
@endsection
@section('js')
    <script src="{{ asset('assets/libs/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
    <script>
        //***********************************//
        // For select 2
        //***********************************//
        $(".select2").select2({
            tags: true,
            tokenSeparators: [',']
        });
        $('.ckeditor').ckeditor();
    </script>
@endsection
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ getTranslatedWords('home') }} /</span>
            {{ getTranslatedWords('add blog') }}</h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">{{ getTranslatedWords('add blog') }}</h5>
                    <!-- Account -->

                    <hr class="my-0" />
                    <div class="card-body">
                        <form enctype="multipart/form-data" id="formAccountSettings" method="POST"
                            action="{{ route('blogs.store') }}">
                            @csrf



                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    @component('components.input_trans', [
                                        'type' => 'text',
                                        'label' => getTranslatedWords('title'),
                                        'required' => 'true',
                                    ])
                                        title
                                    @endcomponent

                                </div>

                                <div class="mb-3 col-md-6">

                                    @component('components.input_trans', [
                                        'type' => 'textarea',
                                        'label' => getTranslatedWords('body'),
                                        'required' => 'true',
                                        'class' => 'ckeditor',
                                    ])
                                        body
                                    @endcomponent

                                </div>

                                <div class="mb-3 col-md-6">
                                    @component('components.input_trans', [
                                        'type' => 'textarea',
                                        'label' => getTranslatedWords('meta_description'),
                                        'required' => 'false',
                                    ])
                                        meta_description
                                    @endcomponent

                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email"
                                        class="form-label">{{ getTranslatedWords('meta_keywords') }}</label>
                                    {{-- @foreach (['ar', 'en'] as $lang) --}}
                                    @foreach (getLanguages() as $lang)
                                        <select name="meta_keywords:{{ $lang }}[]" class="select2 form-control"
                                            multiple id=""></select>
                                        <span class="help-block">{{ $lang == 'ar' ? 'العربية' : 'english' }}</span>
                                        <div class="clearfix"> </div> <br />
                                        @error('meta_keywords:' . $lang)
                                            <div class="text-danger">{{ $errors->first('meta_keywords:' . $lang) }}</div>
                                        @enderror
                                    @endforeach

                                </div>




                                <div class="mb-3 col-md-6">

                                    {{ getTranslatedWords('image') }} 800 * 562
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input"
                                            id="validatedCustomFile">
                                        <label class="custom-file-label"
                                            for="validatedCustomFile">{{ getTranslatedWords('image') }}</label>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="text-danger">{{ $errors->first('image') }}</div>
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
