@extends('artadmin::auth_page')
@section('title', trans("admin_blocks::main.add"))
@section('content')
    <div class="main_content_iner">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("admin_blocks.blocks.index") }}">Список блоков</a></li>
                <li class="breadcrumb-item active" aria-current="page">Новый блок</li>
            </ol>
        </nav>
        <div class="dzenkit-basic-card dzenkit-fulltable-maxwid-lg">


            <div class="dzenkit-table-header hdr-box d-flex align-items-center justify-content-between">
                <div class="hdr">{{ trans("admin_blocks::main.add") }}</div>
            </div>






        <div class="dzenkit-basic-card-body fill rows_super_list">

        <form action="{{ route("admin_blocks.blocks.doadd") }}" method="POST">


            <div class="row mt-3">
                <div class="col-12 col-lg-5">
                   {{ trans("admin_blocks::main.enabled") }}
                </div>
                <div class="form-check form-switch col-12 col-lg-7">
                    <input type="checkbox" name="enable" class="form-check-input" value="1" checked >
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-4">
                    {{ trans("admin_blocks::main.title_block") }}
                </div>
                <div class="col-8">
                    <input type="text" name="title" class="form-control" required   >
                </div>
            </div>

            <hr class="mt-3"/>

            <div class="row mt-3">
                <div class="col-4">
                    {{ trans("admin_blocks::position.pos") }}
                </div>
                <div class="col-8">
                    <select class="form-control" name="position_id" required >
                        @if(count($positions))
                            @foreach($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4">
                    {{ trans("admin_blocks::main.type") }}
                </div>
                <div class="col-8">
                    <select onchange="this.options[this.selectedIndex].value && (window.location = '{{ route("admin_blocks.blocks.add") }}?type='+this.options[this.selectedIndex].value);" class="form-control" name="type" required >
                        @if(count($types))
                            @foreach($types as $type)
                                <option @if($current_type==$type) selected  @endif value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <hr class="mt-3"/>

            <div class="row mt-3">
                <div class="col-12 mb-4">
                    {{ trans("admin_blocks::main.content") }}
                </div>
                <div class="col-12">
                    {!! \AdminBlocks\Repository\FieldsRepository::getValue($current_type) !!}
                </div>
            </div>

            <hr class="mt-4" />
            <div class="row">
                <div class="col-12 col-lg-4">{{ csrf_field() }}</div>
                <div class="col-12 col-lg-8"><button type="submit" class="btn btn-lg btn-primary my-3">{{ trans("admin_blocks::main.add") }}</button></div>
            </div>

        </form>
        </div>


        </div>

    </div>
@endsection


