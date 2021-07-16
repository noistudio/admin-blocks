@extends('artadmin::auth_page')
@section('title', trans("admin_blocks::main.edit_block"))
@section('content')
    <div class="main_content_iner">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("admin_blocks.blocks.index") }}">Список блоков</a></li>
                <li class="breadcrumb-item active" aria-current="page">Редактирование</li>
            </ol>
        </nav>
    <div class="dzenkit-basic-card dzenkit-fulltable-maxwid-lg">

        <div class="dzenkit-table-header hdr-box d-flex align-items-center justify-content-between">
            <div class="hdr">{{ trans("admin_blocks::main.edit_block") }}</div>
        </div>

        <div class="dzenkit-basic-card-body fill">
        <form action="{{ route("admin_blocks.blocks.doedit",$block->id) }}" method="POST" enctype="multipart/form-data">


            <div class="row mt-2 mb-4">
                <div class="col-12 col-lg-5">
                    <strong>{{ trans("admin_blocks::main.enabled") }}</strong>
                </div>
                <div class="form-check form-switch col-12 col-lg-7">
                    <input class="form-check-input row_is_enable" data-route="" name="enable" type="checkbox" value="1" @if($block->enable==1) checked @endif>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-12 col-lg-4">
                    <strong>{{ trans("admin_blocks::main.title_block") }}</strong>
                </div>
                <div class="col-12 col-lg-8">
                    <input type="text" name="title" data-title="{{ trans("admin_blocks::main.title_block") }}" class="crud_field_title form-control" required value="{{ $block->title }}" placeholder="{{ $block->title }}"   >
                </div>
            </div>


            <div class="row my-2">
                <div class="col-12 col-lg-4">
                    <strong>{{ trans("admin_blocks::position.pos") }}</strong>
                </div>
                <div class="col-12 col-lg-8">
                    <select class="form-control" name="position_id" required >
                        @if(count($positions))
                            @foreach($positions as $position)
                                <option @if($block->position_id==$position->id) selected @endif value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-12 col-lg-4">
                    <strong>Порядок</strong>
                </div>
                <div class="col-12 col-lg-8">
                    <input type="number" name="sort" data-title="Порядок сортировки, при выводе позиции" class="crud_field_title form-control" required value="{{ $block->sort }}" placeholder="Порядок сортировки"   >
                </div>
            </div>

            <div class="row my-2">
                <div class="col-12 col-lg-4">
                    <strong>{{ trans("admin_blocks::main.type") }}</strong>
                </div>
                <div class="col-12 col-lg-8">
                    {{ $block->type }}
                </div>
            </div>

            <div class="row my-2">
                <div class="col-12 col-lg-4">
                    <strong>{{ trans("admin_blocks::main.load_block") }}</strong>
                </div>
                <div class="col-12 col-lg-8">
                    @<b>load_block({{$block->id}})</b>
                </div>
            </div>

            <div class="row my-2">
                <div class="col-12 col-lg-4">
                    <strong>{{ trans("admin_blocks::main.load_block_by_pos") }}</strong>
                </div>
                <div class="col-12 col-lg-8">
                    @<b>load_position("{{$block->position->name}}")</b>
                </div>
            </div>

            <hr class="mt-3"/>

            <div class="row my-2">
                <div class="col-12 mb-4">
                    <strong>{{ trans("admin_blocks::main.content") }}</strong>
                </div>
                <div class="col-12">
                   {!! \AdminBlocks\Repository\FieldsRepository::getValue($block->type,$block->data) !!}
                </div>
            </div>




            <div class="crud_notify alert alert-danger" style="display:none">
            </div>

            <hr class="mt-5"/>

            <div class="row text-center">
                <div class="col-12 col-md-6 my-3">
                    <button type="submit"  name="redirect" value="list" class="btn_create_list btn btn-lg btn-primary" disabled="disabled" style="opacity:.25;">Сохранить</button>
                </div>
                <div class="col-12 col-md-6 my-3">
                    <!--<button type="submit" name="redirect" value="edit" class="btn_create_edit btn btn-lg btn-primary">Применить</button>-->

                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-lg btn-primary">Применить</button>
                </div>

            </div>










            {{--
            <!-- ishodnaya - tablitsa - Artema -->
            <!--<table class="table">
                <tr>
                    <td>{{ trans("admin_blocks::main.enabled") }}</td>
                    <td><input type="checkbox" @if($block->enable==1) checked @endif   name="enable" class="form-check-input" value="1"  ></td>
                </tr>
                <tr>
                    <td>{{ trans("admin_blocks::main.title_block") }}</td>
                    <td><input type="text" name="title" class="form-control" required value="{{ $block->title }}"   ></td>
                </tr>
                <tr>
                    <td>
                        {{ trans("admin_blocks::position.pos") }}
                    </td>
                    <td>
                        <select class="form-control" name="position_id" required >
                            @if(count($positions))
                                @foreach($positions as $position)
                                    <option @if($block->position_id==$position->id) selected @endif value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>{{ trans("admin_blocks::main.type") }}</td>
                    <td>
                        {{ $block->type }}
                    </td>
                </tr>
                <tr>
                    <td>{{ trans("admin_blocks::main.load_block") }}</td>
                    <td>@<b>load_block({{$block->id}})</b></td>
                </tr>
                <tr>
                    <td>{{ trans("admin_blocks::main.load_block_by_pos") }}</td>
                    <td>@<b>load_position("{{$block->position->name}}")</b></td>
                </tr>
                <tr>
                    <td>{{ trans("admin_blocks::main.content") }}</td>
                    <td>
                        {!! \AdminBlocks\Repository\FieldsRepository::getValue($block->type,$block->data) !!}
                    </td>
                </tr>

                <tr>
                    <td>{{ csrf_field() }}</td>
                    <td><button type="submit" class="btn btn-danger">{{ trans("admin_blocks::main.doedit") }}</button></td>
                </tr>
            </table>-->
            <!-- / ishodnaya - tablitsa - Artema -->
            --}}


        </form>
        </div>



    </div>
    </div>
@endsection
