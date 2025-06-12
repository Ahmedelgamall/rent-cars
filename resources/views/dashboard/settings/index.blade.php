@extends('dashboard.layouts.app')
@section('title', getTranslatedWords('settings'))
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/select2.min.css') }}" />
@endsection
@section('js')
    <script src="{{ asset('assets/libs/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('new_assets/js/ckeditor/ckeditor.js') }}"></script>

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
            {{ getTranslatedWords('settings') }}</h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">{{ getTranslatedWords('settings') }}</h5>
                    <!-- Account -->

                    <hr class="my-0" />
                    <div class="card-body">
                        <form enctype="multipart/form-data" id="formAccountSettings" method="POST"
                            action="{{ route('settings.update', $setting->id) }}">
                            @csrf
                            @method('put')
                            <div class="row">



                                <div class="mb-3 col-md-6">
                                    @component('components.input_trans', [
                                        'type' => 'text',
                                        'label' => getTranslatedWords('system name'),
                                        'required' => 'true',
                                        'model' => $setting,
                                    ])
                                        system_name
                                    @endcomponent

                                </div>
                                <div class="mb-3 col-md-6">
                                    @component('components.input_trans', [
                                        'type' => 'text',
                                        'label' => getTranslatedWords('address'),
                                        'required' => 'false',
                                        'model' => $setting,
                                    ])
                                        address
                                    @endcomponent

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('email') }}</label>
                                    <input type="email" value="{{ $setting->email }}" class="form-control" name="email"
                                        placeholder="{{ getTranslatedWords('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('phone') }}</label>
                                    <input type="phone" value="{{ $setting->phone }}" class="form-control" name="phone"
                                        placeholder="{{ getTranslatedWords('phone') }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $errors->first('phone') }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    @if ($setting->logo != '')
                                        <label for="email"
                                            class="form-label">{{ getTranslatedWords('current logo') }}</label>
                                        <img class="img-fluid"
                                            src="{{ route('file_show', ['filename' => $setting->logo, 'path' => 'settings']) }}" /><br>
                                    @endif
                                    {{ getTranslatedWords('logo') }} 159 * 37
                                    <div class="custom-file">
                                        <input type="file" name="logo" class="custom-file-input"
                                            id="validatedCustomFile">
                                        <label class="custom-file-label"
                                            for="validatedCustomFile">{{ getTranslatedWords('logo') }}</label>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                    @error('logo')
                                        <div class="text-danger">{{ $errors->first('logo') }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    @if ($setting->about_image != '')
                                        <label for="email"
                                            class="form-label">{{ getTranslatedWords('current about us image') }}</label>
                                        <img class="img-fluid"
                                            src="{{ route('file_show', ['filename' => $setting->about_image, 'path' => 'settings']) }}" /><br>
                                    @endif
                                    {{ getTranslatedWords('about_us_image') }} 1140 * 1210
                                    <div class="custom-file">
                                        <input type="file" name="about_image" class="custom-file-input"
                                            id="validatedCustomFile">
                                        <label class="custom-file-label"
                                            for="validatedCustomFile">{{ getTranslatedWords('about_us_image') }}</label>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                    @error('about_image')
                                        <div class="text-danger">{{ $errors->first('about_image') }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    @if ($setting->cover_image != '')
                                        <label for="email"
                                            class="form-label">{{ getTranslatedWords('current cover image') }}</label>
                                        <img class="img-fluid"
                                            src="{{ route('file_show', ['filename' => $setting->cover_image, 'path' => 'settings']) }}" /><br>
                                    @endif
                                    {{ getTranslatedWords('cover image') }} 1920 * 404
                                    <div class="custom-file">
                                        <input type="file" name="cover_image" class="custom-file-input"
                                            id="validatedCustomFile">
                                        <label class="custom-file-label"
                                            for="validatedCustomFile">{{ getTranslatedWords('cover image') }}</label>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                    @error('cover_image')
                                        <div class="text-danger">{{ $errors->first('cover_image') }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('facebook link') }}</label>
                                    <input type="url" value="{{ $setting->facebook_link }}" class="form-control" name="facebook_link"
                                        placeholder="{{ getTranslatedWords('facebook link') }}">
                                    @error('facebook_link')
                                        <div class="text-danger">{{ $errors->first('facebook_link') }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('twitter link') }}</label>
                                    <input type="url" value="{{ $setting->twitter_link }}" class="form-control" name="twitter_link"
                                        placeholder="{{ getTranslatedWords('twitter link') }}">
                                    @error('twitter_link')
                                        <div class="text-danger">{{ $errors->first('twitter_link') }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('instagram link') }}</label>
                                    <input type="url" value="{{ $setting->instagram_link }}" class="form-control" name="instagram_link"
                                        placeholder="{{ getTranslatedWords('instagram link') }}">
                                    @error('instagram_link')
                                        <div class="text-danger">{{ $errors->first('instagram_link') }}</div>
                                    @enderror
                                </div>

                                

                                <div class="mb-3 col-md-6">
                                    @if ($setting->faq_image != '')
                                        <label for="email"
                                            class="form-label">{{ getTranslatedWords('current faqs image') }}</label>
                                        <img class="img-fluid"
                                            src="{{ route('file_show', ['filename' => $setting->faq_image, 'path' => 'settings']) }}" /><br>
                                    @endif
                                    {{ getTranslatedWords('faqs image') }} 600 * 600
                                    <div class="custom-file">
                                        <input type="file" name="faq_image" class="custom-file-input"
                                            id="validatedCustomFile">
                                        <label class="custom-file-label"
                                            for="validatedCustomFile">{{ getTranslatedWords('faqs image') }}</label>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                    @error('faq_image')
                                        <div class="text-danger">{{ $errors->first('faq_image') }}</div>
                                    @enderror
                                </div>



                                <div class="mb-3 col-md-12">
                                    @component('components.input_trans', [
                                        'type' => 'text',
                                        'label' => getTranslatedWords('about us title'),
                                        'required' => 'false',
                                        'model' => $setting,
                                    ])
                                        about_us_title
                                    @endcomponent
                                </div>

                                <div class="mb-3 col-md-12">
                                    @component('components.input_trans', [
                                        'type' => 'textarea',
                                        'label' => getTranslatedWords('about us description'),
                                        'required' => 'false',
                                        'model' => $setting,
                                    ])
                                        about_us_description
                                    @endcomponent
                                </div>

                                <div class="mb-3 col-md-12">
                                    @component('components.input_trans', [
                                        'type' => 'textarea',
                                        'label' => getTranslatedWords('meta description'),
                                        'required' => 'false',
                                        'model' => $setting,
                                    ])
                                        meta_description
                                    @endcomponent
                                </div>

                                <div class="mb-3 col-md-12">
                                    @component('components.input_trans', [
                                        'type' => 'text',
                                        'label' => getTranslatedWords('privacy policy'),
                                        'required' => 'false',
                                        'model' => $setting,
                                    ])
                                        privacy
                                    @endcomponent
                                </div>

                                <div class="mb-3 col-md-12">
                                    @component('components.input_trans', [
                                        'type' => 'text',
                                        'label' => getTranslatedWords('terms and conditions'),
                                        'required' => 'false',
                                        'model' => $setting,
                                    ])
                                        terms
                                    @endcomponent
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
