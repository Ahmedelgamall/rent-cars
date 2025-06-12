@isset($data)
    @foreach ($data as $key => $value)
        <div class="border px-4 py-4 mb-4">
            <h4 class="mb-4 border-bottom pb-2">{{ getTranslatedWords('' . $key) }}</h4>
            @foreach ($value as $k => $item)
                <ul class="list-unstyled">
                    <li class="mb-4 d-flex justify-content-between"><input type="hidden" name="permissions[]"
                            value="{{ $k }}">{{ $item }}
                        <a href="#" class="delete_permission btn btn-danger"><i class="bx  bx-message-square-x"></i></a>
                    </li>
                </ul>
            @endforeach
        </div>
    @endforeach
@endisset