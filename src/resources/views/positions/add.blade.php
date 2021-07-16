@extends('artadmin::auth_page')
@section('title', trans("admin_blocks::position.title_add"))
@section('content')
    <div class="main_content_iner">
        <div class="dzenkit-basic-card dzenkit-fulltable-maxwid-lg">

            <div class="dzenkit-table-header hdr-box d-flex align-items-center justify-content-between">
                <div class="hdr">{{ trans("admin_blocks::position.title_add") }}</div>
            </div>


            <div class="dzenkit-basic-card-body fill">

                <form action="{{ route("admin_blocks.position.doadd") }}" method="POST">

                    {!! csrf_field() !!}
                    <div class="row my-2">
                        <div class="col-12 col-lg-4">
                            <p><strong>{{ trans("admin_blocks::position.pos") }}(a-z)</strong></p>
                            <p>Примеры:<br/>example<br/>example_example</p>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="text" pattern="[a-z_]{3,}" name="position" class="crud_field_title form-control" required="" placeholder="example , example_example">
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col-12 col-md-6 my-3">
                            <button type="submit" name="redirect" value="list" class="btn_create_list btn btn-lg btn-primary">Сохранить</button>
                        </div>
                        <div class="col-12 col-md-6 my-3">


                            <button type="submit" class="btn btn-lg btn-primary" disabled="disabled" style="opacity:.25;">Применить</button>
                        </div>

                    </div>


                    {{--
                    <!--<table class="table">
                        <tr>
                            <td>
                                <strong>{{ trans("admin_blocks::position.pos") }}(a-z)</strong><br class="mt-2"/>
                            </td>
                            <td><input type="text" pattern="[a-z_]{3,}" name="position" required></td>
                        </tr>
                        <tr>
                            <td>{{ csrf_field() }}</td>
                            <td><button type="submit" class="btn btn-danger">{{ trans("admin_blocks::position.title_add") }}</button></td>
                        </tr>
                    </table>-->--}}


                </form>

            </div>


        </div>
    </div>
@endsection


