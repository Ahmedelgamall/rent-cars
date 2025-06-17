@extends('dashboard.layouts.app')
@section('title', getTranslatedWords('add car'))
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
        $(".selectKeywords").select2({
            tags: true,
            tokenSeparators: [',']
        });
        
    </script>
     <script src="{{ asset('assets/libs/bootstrap-fileinput/js/fileinput.js') }}" type="text/javascript"></script>
     <script src="{{ asset('assets/libs/bootstrap-fileinput/js/locales/ar.js') }}" type="text/javascript"></script>
 
     <script>
         var footerTemplate =
             '<div class="wt-uploadingbar"><span class="uploadprogressbar"></span><p style="width:190px;word-break:break-all;line-height: 20px;">{caption}</p><div class="text-center">{actions}</div></div>';
         var fileInputOptions = {
             // overwriteInitial: false,
             language: "ar",
             maxFileSize: 8096,
             showClose: false,
             showCaption: false,
             browseLabel: '{{ getTranslatedWords('choose image') }}',
             removeLabel: '{{ getTranslatedWords('delete') }}',
             browseIcon: '<i class="fas fa-folder"></i>',
             removeIcon: '<i class="fas fa-trash"></i>',
             removeTitle: '{{ getTranslatedWords(word: 'delete image') }}',
             elErrorContainer: '#kv-avatar-errors-1',
             browseClass: "btn btn-primary",
             removeClass: "btn btn-danger",
             defaultPreviewContent: '',
             layoutTemplates: {
                 main2: '{preview} {remove} {browse}',
                 footer: footerTemplate
             },
             // allowedFileExtensions: ["jpg", "jpeg", "png"],
             initialPreviewAsData: true,
             showUpload: false,
             autoOrientImage: false,
         }
         $("[type=file]").fileinput(fileInputOptions);
         $(document).on('click', '.add_more_attribute', function(e) {
            e.preventDefault();
            var thisDiv = $(this).closest('form').find('.attribute:last');

            var new_div = $(thisDiv).clone();
            new_div.find('input').val('');
            //count_video++;
            new_div.find('.remove_attribute').css('visibility', 'visible');
            thisDiv.after(new_div);
        })

        $(document).on('click', '.remove_attribute', function(e) {
            e.preventDefault();
            $(this).closest('.attribute').remove();
        })
     </script>
@endsection
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ getTranslatedWords('home') }} /</span>
            {{ getTranslatedWords('add car') }}</h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">{{ getTranslatedWords('add car') }}</h5>
                    <!-- Account -->

                    <hr class="my-0" />
                    <div class="card-body">
                        <form enctype="multipart/form-data" id="formAccountSettings" method="POST"
                            action="{{ route('cars.store') }}">
                            @csrf



                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    @component('components.input_trans', [
                                        'type' => 'text',
                                        'label' => getTranslatedWords('name'),
                                        'required' => 'true',
                                    ])
                                        title
                                    @endcomponent
                                </div>

                                <div class="mb-3 col-md-6">
                                    @component('components.input_trans', [
                                        'type' => 'textarea',
                                        'label' => getTranslatedWords('description'),
                                        'required' => 'true',
                                    ])
                                        description
                                    @endcomponent
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('category') }}</label>
                                    <select style="height: 36px; width: 100%" id="category_id"
                                        class="select2 form-select discount_type" name="category_id">
                                        <option value="">{{ getTranslatedWords('select') }}</option>
                                        @foreach (App\Models\Category::get() as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $errors->first('category_id') }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    @component('components.input_trans', [
                                        'type' => 'text',
                                        'label' => getTranslatedWords('model'),
                                        'required' => 'true',
                                    ])
                                        model
                                    @endcomponent
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('price') }}</label>
                                    <input type="number" value="{{ old('price') }}" class="form-control" name="price"
                                        placeholder="{{ getTranslatedWords('price') }}">
                                    @error('price')
                                        <div class="text-danger">{{ $errors->first('price') }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('kilometers') }}</label>
                                    <input type="number" value="{{ old('kilometers') }}" class="form-control" name="kilometers"
                                        placeholder="{{ getTranslatedWords('kilometers') }}">
                                    @error('kilometers')
                                        <div class="text-danger">{{ $errors->first('kilometers') }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('year model') }}</label>
                                    <input type="number" value="{{ old('year_model') }}" class="form-control" name="year_model"
                                        placeholder="{{ getTranslatedWords('year_model') }}">
                                    @error('year_model')
                                        <div class="text-danger">{{ $errors->first('year_model') }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">{{ getTranslatedWords('images') }} 980 * 490</label>
                                    
                                        <input type="file" name="images[]" multiple
                                            id="validatedCustomFile">
                                       
                                       
                                   
                                    @error('images')
                                        <div class="text-danger">{{ $errors->first('images') }}</div>
                                    @enderror
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
                                        <select name="meta_keywords:{{ $lang }}[]" class="selectKeywords form-control"
                                            multiple id=""></select>
                                        <span class="help-block">{{ $lang == 'ar' ? 'العربية' : 'english' }}</span>
                                        <div class="clearfix"> </div> <br />
                                        @error('meta_keywords:' . $lang)
                                            <div class="text-danger">{{ $errors->first('meta_keywords:' . $lang) }}</div>
                                        @enderror
                                    @endforeach

                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="email" class="form-label">{{ getTranslatedWords('attributes') }} </label>
                                    <div class="form-group row attribute">
                                        <div class="col-lg-5">
                                            @component('components.input_trans_array', [
    'type' => 'text',
    'label' => getTranslatedWords('attribute title'),
    'required' => 'false',
])
                                                key
                                            @endcomponent
                                        </div>
                                        <div class="col-lg-5">
                                            @component('components.input_trans_array', [
    'type' => 'textarea',
    'label' => getTranslatedWords('attribute value'),
    'required' => 'false',
])
                                                value
                                            @endcomponent
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">

                                                <a href="#" class="remove_attribute btn btn-danger ml-2" style="visibility: hidden;"><i class="fa fa-minus"></i>
                                                    {{getTranslatedWords('remove')}} </a>
                                            </div>
                                        </div>



                                    </div>
                                    <a class="btn btn-primary add_more_attribute mb-2">
                                        <i class="fas fa-plus"> {{getTranslatedWords('add more')}}</i>
                                    </a> 
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
