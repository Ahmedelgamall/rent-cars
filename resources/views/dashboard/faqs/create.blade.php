@extends('dashboard.layouts.app')
@section('title', getTranslatedWords('add faq'))
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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ getTranslatedWords('home') }} /</span> {{ getTranslatedWords('add faq') }}</h4>

    <div class="row">
        <div class="col-md-12">

            <div class="card mb-4">
                <h5 class="card-header">{{ getTranslatedWords('add faq') }}</h5>
                <!-- Account -->

                <hr class="my-0" />
                <div class="card-body">
                    <form enctype="multipart/form-data" id="formAccountSettings" method="POST" action="{{ route('faqs.store') }}">
                        @csrf



                        <div class="row">
                            <div class="mb-3 col-md-6">
                                @component('components.input_trans', [
                                    'type' => 'text',
                                    'label' => getTranslatedWords('question'),
                                    'required' => 'true',
                                ])
                                    question
                                @endcomponent

                            </div>

                            <div class="mb-3 col-md-6">
                                @component('components.input_trans', [
                                    'type' => 'textarea',
                                    'label' => getTranslatedWords('answer'),
                                    'required' => 'true',
                                ])
                                    answer
                                @endcomponent

                            </div>

                            





                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">{{ getTranslatedWords('submit') }}</button>
                            <button type="reset" class="btn btn-outline-secondary">{{ getTranslatedWords('cancel') }}</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>

        </div>
    </div>
</div>
@endsection