<label for="email" class="form-label">{{ $label }}</label>


{{-- @foreach (['ar', 'en'] as $lang) --}}
@foreach (getLanguages() as $lang)
    @if ($lang == 'ar')
        @php
            $dir = 'rtl';
        @endphp
    @else
        @php
            $dir = 'ltr';
        @endphp
    @endif
    @if (isset($model))
        @php
            $translation = $model->translateOrDefault('' . $lang);

        @endphp
    @endif
    @if ($type != 'textarea')
        <input @if ($required) required @endif type="{{ $type }}"
            class="form-control @isset($class) {{ $class }} @endisset"
            name="{{ $slot }}:{{ $lang }}[]" dir="{{ $dir }}"
            value="{{ old($slot . ':' . $lang) ?? ($translation->$slot ?? '') }}" placeholder="{{ $label }}">
        <span class="help-block">{{ $lang == 'ar' ? 'العربية' : 'english' }}</span>
        <div class="clearfix"> </div> <br />
    @else
        <textarea @if ($required) required @endif
            class="form-control editor @isset($class) {{ $class }} @endisset"
            name="{{ $slot }}:{{ $lang }}[]" dir="{{ $dir }}">
{!! old($slot . ':' . $lang) ?? ($translation->$slot ?? '') !!}
</textarea>
        <span class="help-block">{{ $lang == 'ar' ? 'العربية' : 'english' }}</span>
        <div class="clearfix"> </div> <br />
    @endif

    @error('' . $slot . ':' . $lang)
        <div class="text-danger">{{ $errors->first('' . $slot . ':' . $lang) }}</div>
    @enderror
@endforeach
