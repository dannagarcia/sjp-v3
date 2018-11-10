@extends('layout.app')

@section('page_title', "Alumni Custom fields")


@section('styles')

    <style>
        #id-settings {
            margin-top: 40px;
        }
    </style>

@endsection



@section('body')

    <div id="id-settings">

        <div class="col-xs-6">
            <h2>Default Settings</h2>
            <textarea disabled class="form-control" name="" id="" cols="30"
                      rows="20">{{ $default_settings }}</textarea>
        </div>

        <div class="col-xs-6">
            <form action="/settings/update" method="post">
                {{ csrf_field() }}
                <button class="btn btn-success pull-right" type="submit">Save</button>
                <a id="preview_id" class="btn btn-warning pull-right" href="#">Preview</a>

                <input type="hidden" name="setting_id" value="{{ $settings->id }}">
                <textarea class="form-control" name="new_value" id="new_value" cols="30"
                          rows="20">{{ old('new_value',  $settings->value) }}</textarea>
            </form>
        </div>
    </div>



@endsection

@section('scripts')

    <script>
        $(document).ready(function () {

            $('#preview_id').attr('href', '/settings/preview_id?json=' + $('#new_value').val())

            $.each($('textarea'), function (k, v) {
                $(v).val((JSON.stringify(JSON.parse($(v).val()), null, "\t")));
            });

            $('#new_value').on('keyup', function (event) {
                $('#preview_id').attr('href', '/settings/preview_id?json=' + $('#new_value').val())
            });

        });
    </script>

@endsection