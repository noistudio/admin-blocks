@extends('artadmin::auth_page')
@section('title', trans("admin_blocks::main.blocks"))
@section('content')
    <div class="main_content_iner">

        <div class="dzenkit-basic-card dzenkit-fulltable-maxwid-lg">


            <div class="dzenkit-table-header hdr-box d-flex align-items-center justify-content-between">
                <div class="hdr">{{ trans("admin_blocks::main.blocks") }}</div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-secondary mr-2 icon-filter-1 js_show_hide_selections-setting"></button>
                    <div class="dropdown">
                        <a id="tableCog" href="#" class="btn btn-secondary mr-2 icon-cog-alt dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu dropdown-menu-right dzenkit-dropdown-menu dzenkit-check-menu pt-0" aria-labelledby="tableCog">
                            <li class="hdr">Настройка выдачи</li>
                            <li class="d-flex"><a class="dropdown-item icon-ok dzen-check @if(isset($get_vars['orderby']) and $get_vars['orderby']=="sort") actv  @endif" href="?orderby=sort">По сортировке</a></li>
                            <li><a class="dropdown-item icon-ok dzen-check @if(!(isset($get_vars['orderby']) and strlen($get_vars['orderby'])>0)) actv  @endif " href="?orderby">Новый снизу</a></li>
                            <li class="d-flex"><a class="dropdown-item icon-ok dzen-check @if(isset($get_vars['orderby']) and $get_vars['orderby']=="desc") actv  @endif" href="?orderby=desc">Новый сверху</a></li>


                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item icon-ok dzen-check js_show_hide_table_descripts" href="#">Раскрыть уточнения</a></li>
                        </ul>
                    </div>

                    <a href="{{ route('admin_blocks.blocks.add') }}" class="btn btn-dzenkit-action"><i class="icon-plus"></i>Добавить</a>
                </div>
            </div>




        {{--<!--<h4>{{ trans("admin_blocks::main.blocks") }}</h4>
        <p><a href="{{ route('admin_blocks.blocks.add') }}" class="btn btn-success">{{ trans("admin_blocks::main.add") }}</a></p>-->--}}





        <!-- ++++++++++ dzenkit-selections-setting ++++++++++ -->
        <div class="dzenkit-selections-setting">
                <div class="dzenkit-basic-card-body">
                    <p class="hdr">Настройка выборки</p>

                    <form action="">

                        <!--<div class="row mb-3">
                            <label for="selectForm_CategorSubGroup" class="col-md-4 col-form-label">Просмотрено</label>
                            <div class="col-md-4">
                                <select class="form-select" name="enable">
                                    <option value="0"></option>
                                    <option value="1">Да</option>
                                    <option value="2">Нет</option>
                                </select>
                            </div>
                        </div>

                        <div class="dzenkit-form-range-box row mb-3">
                            <label for="selectForm_CategorSubGroup" class="col-md-4 col-form-label">Дата</label>
                            <div class="col-md-2">
                                <select class="form-select" name="data_type">
                                    <option value="0"></option>
                                    <option value="1">=</option>

                                    <option value="3">↔</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="dzenkit-range-input row hide">
                                    <div class="col-md-6"><input type="date" value="" name="date_create_from" class="form-control" id="" data-ph-double="От" placeholder="От"></div>
                                    <div class="col-md-6"><input type="date" value="" name="date_create_to" class="form-control" id="" placeholder="До"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row dzenkit-submit-box">
                            <div class="offset-md-4">
                                <button type="submit" class="btn btn-info">Найти</button>
                            </div>
                        </div>-->

                       @if(isset($get_vars['orderby']))
                       <input type="hidden" name="orderby" value="{{ $get_vars['orderby'] }}">
                       @endif

                        <div class="row mb-3">
                            <label for="exampleFormControlInput1" class="col-md-4 col-form-label">{{ trans("admin_blocks::main.type") }}</label>
                            <div class="col-md-8">
                                <select class="form-select" name="type">
                                    <option></option>
                                    @if(count($types))
                                    @foreach($types as $type)
                                    <option  @if(isset($get_vars['type']) and $get_vars['type']==$type) selected @endif  value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="exampleFormControlInput2" class="col-md-4 col-form-label">{{ trans("admin_blocks::position.pos") }}</label>
                            <div class="col-md-8">
                                <select class="form-select" name="position">
                                    <option></option>
                                    @if(count($positions))
                                    @foreach($positions as $position)
                                    <option @if(isset($get_vars['position']) and $get_vars['position']==$position->id) selected @endif value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="exampleFormControlInput3" class="col-md-4 col-form-label">{{ trans("admin_blocks::main.status") }}</label>
                            <div class="col-md-8">
                                <select class="form-select" name="enable">
                                    <option></option>
                                    <option @if(isset($get_vars['enable']) and $get_vars['enable']==0) selected @endif  value="0">{{ trans("admin_blocks::main.status_disable") }}</option>
                                    <option  @if(isset($get_vars['enable']) and $get_vars['enable']==1) selected @endif  value="1">{{ trans("admin_blocks::main.status_enable") }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row dzenkit-submit-box">
                            <div class="offset-md-4">
                                <button type="submit" class="btn btn-info">{{ trans("admin_blocks::main.find") }}</button>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        <!-- ++++++++++ / dzenkit-selections-setting ++++++++++ -->


        {{--<!--<form action="" class="row">
        <div class="mb-3 col-3">
            <label for="exampleFormControlInput1" class="form-label">{{ trans("admin_blocks::main.type") }}</label>
            <select class="form-control" name="type">
                <option></option>
                @if(count($types))
                @foreach($types as $type)
                <option  @if(isset($get_vars['type']) and $get_vars['type']==$type) selected @endif  value="{{ $type }}">{{ $type }}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="mb-3 col-3">
            <label for="exampleFormControlInput2" class="form-label">{{ trans("admin_blocks::position.pos") }}</label>
            <select class="form-control" name="position">
                <option></option>
                @if(count($positions))
                    @foreach($positions as $position)
                        <option @if(isset($get_vars['position']) and $get_vars['position']==$position->id) selected @endif value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="mb-3 col-3">
            <label for="exampleFormControlInput3" class="form-label">{{ trans("admin_blocks::main.status") }}</label>
            <select class="form-control" name="enable">
                <option></option>
                <option @if(isset($get_vars['enable']) and $get_vars['enable']==0) selected @endif  value="0">{{ trans("admin_blocks::main.status_disable") }}</option>
                <option  @if(isset($get_vars['enable']) and $get_vars['enable']==1) selected @endif  value="1">{{ trans("admin_blocks::main.status_enable") }}</option>

            </select>
        </div>
            <div class="mb-3 col-3">
                <label for="exampleFormControlInput4" class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-success mt-4">{{ trans("admin_blocks::main.find") }}</button>
            </div>
        </form>-->--}}


        <div class="dzenkit-basic-card-body rows_super_list">

            {{--
            @foreach($admin_blocks as $row)
                <form style="display:none;" class="delete_{{ $row->id }}" action="{{ route('admin_blocks.blocks.destroy', $row->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="delete" style="border: none; background-color:transparent;">
                        Удалить
                    </button>
                </form>
            @endforeach
            --}}


            <form class="delete_form_all" action="" method="GET">

            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>

                            <th class="navbar-col">
                                <div class="d-flex">
                                   Позиция
                                </div>
                                {{--
                                <div class="d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-all-numbers" type="checkbox" value="#">
                                        <b>#</b>
                                    </div>
                                </div>--}}


                            </th>

                            <th scope="col">Название</th>
                                <!--<th scope="col">Статус</th>-->
                                <th scope="col">Тип</th>
                                <th scope="col">Позиция</th>

                                {{--<!--<th scope="col">Редактировать</th>
                                <th scope="col">Удалить</th>-->--}}

                        </tr>
                    </thead>

                    <tbody>
                    @if(count($rows)>0)
                        @foreach($rows as $row)
                        <tr data-url-change="{{ route("admin_blocks.blocks.toogle",$row->id) }}" data-row-id="{{ $row->id }}" data-sort="{{ $row->id }}">
                            <td>
                                <div class="row-nav d-flex">
                                    <div class="form-check">
                                        {{ $row->sort }}
                                    </div>
                                    {{--
                                    <div class="form-check">
                                        <input class="form-check-input form-check-number" type="checkbox" name="id[]" value="{{ $row->id }}">
                                        <!--<strong class="js_row_number">{{ $row->sort }}</strong>-->
                                        <strong class="js_row_number">{{ $row->id }}</strong>
                                    </div>
                                    --}}

                                    <div class="nav-bar d-flex align-items-center">

                                        {{--<!--strelki - up down change-->
                                            <div class="change d-flex">
                                            <button class="icon-down-big js_put_row_down" data-row-id="{{ $row->id }}"></button><button class="icon-up-big js_put_row_up" data-row-id="{{ $row->id }}"></button>
                                        </div>--}}

                                        {{--
                                        <div class="status">
                                            <div class="form-check form-switch d-flex align-items-center">
                                                <input class="form-check-input row_is_enable" data-route="{{ route("admin_blocks.blocks.toogle",$row->id) }}" type="checkbox" @if($row->enable==1) checked @endif >
                                            </div>
                                        </div>--}}

                                        <!-- action menu -->
                                        <div class="action">
                                            <div class="dropleft">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="icon-menu"></i>
                                                </button>

                                                <ul class="dropdown-menu">
                                                    {{--<!--<li><a class="icon-pencil d-flex align-items-center" href="https://maramirstone.ru/adminsuper/requests_prices/1" title="show">
                                                            Просмотр
                                                        </a></li>-->--}}
                                                    <li><a class="icon-pencil d-flex align-items-center" href="{{ route("admin_blocks.blocks.edit",$row->id) }}">
                                                            Редактировать
                                                        </a></li>
                                                    {{--<!--<li><a class="icon-clone d-flex align-items-center" href="https://maramirstone.ru/adminsuper/requests_prices/clone/1">Клонировать</a></li>-->--}}
                                                    {{--<!--<li><hr class="dropdown-divider"></li>-->
                                                    <!--<li><p class="change-row-action icon-sort d-flex align-items-center" href="#"><input type="text" class="input_new_position" value="{{ $row->sort }}"><b class="btn btn-dzenkit-action btn_move">Перенести</b></p></li>-->--}}
                                                    <li><hr class="dropdown-divider mt-5"></li>

                                                    {{--<!--<li><a class="icon-trash-empty del d-flex align-items-center delete_row" data-row-id="{{ $row->id }}" href="{{ route("admin_blocks.blocks.delete",$row->id) }}" data-toggle="modal" data-target="#deleteModal">Удалить</a></li>-->--}}

                                                    <li><a class="icon-trash-empty del d-flex align-items-center" href="{{ route("admin_blocks.blocks.delete",$row->id) }}" >Удалить без подтверждения</a></li>

                                                </ul>

                                            </div>
                                        </div>
                                        <!-- / action menu -->
                                    </div>




                                <a class="mr-0" href="{{ route("admin_blocks.blocks.toogle",$row->id) }}">
                                @if($row->enable==1)
                                    <i class="demo-icon icon-eye"></i>
                                @else
                                    <i class="demo-icon icon-eye-off"></i>
                                @endif
                                </a>



                                </div>
                            </td>

                            <td><a href="{{ route("admin_blocks.blocks.edit",$row->id) }}">{{ $row->title }}</a></td>

                            <!--<td class="text-center">
                                <a class="mr-0" href="{{ route("admin_blocks.blocks.toogle",$row->id) }}">
                                @if($row->enable==1)
                                    <i class="demo-icon icon-eye"></i>
                                @else
                                    <i class="demo-icon icon-eye-off"></i>
                                @endif
                                </a>
                            </td>-->

                            <td><p>{{ $row->type }}</p></td>
                            <td><p>{{ $row->position->name }}</p></td>
                            {{--<!--<td><a href="{{ route("admin_blocks.blocks.edit",$row->id) }}">Редактировать</a></td>
                            <td><a href="{{ route("admin_blocks.blocks.delete",$row->id) }}">Удалить</a></td>-->--}}


                        </tr>

                        @endforeach
                    @endif

                    </tbody>
                </table>

                <div class="actions-for-table-rows">

                    <div class="d-flex align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="#">
                        </div>
                        <div class="d-flex mr-3"><b>Выбрано&nbsp;</b> <span class="js_total_table_rows_selected"> 0:</span></div>

                        <div>
                            <button class="btn btn-secondary my-1 mr-2 icon-toggle-on js_form_tablerow_on">Включить</button>
                            <button class="btn btn-secondary my-1 mr-2 icon-toggle-off js_form_tablerow_off">Выключить</button>
                            <button class="btn btn-danger my-1 mr-2 icon-trash-empty js_form_tablerow_del" data-toggle="modal" data-target="#deleteModal2">Удалить</button>
                        </div>
                    </div>

                </div>



                {{--
                <nav>
                    {!! $blocks->links("artcrud::paginate") !!}
                </nav>
                --}}



            </form>




        {{-- <!-- Исходная таблица Артёма -->
        <table class="table">
            <thead>
            <tr>
                <th>{{ trans("admin_blocks::main.title_block") }}</th>
                <th>{{ trans("admin_blocks::main.type") }}</th>
                <th>{{ trans("admin_blocks::position.pos") }}</th>
                <th>{{ trans("admin_blocks::main.status") }}</th>
                <th>{{ trans("admin_blocks::main.edit") }}</th>
                <th>{{ trans("admin_blocks::main.delete") }}</th>
            </tr>
            </thead>
            <tbody>
            @if(count($rows)>0)
                @foreach($rows as $row)
                    <tr>
                        <td>{{ $row->title }}</td>
                        <td>{{ $row->type }}</td>
                        <td>{{ $row->position->name }}</td>
                        <td>
                            <a href="{{ route("admin_blocks.blocks.toogle",$row->id) }}">
                            @if($row->enable==1)
                                <i class="demo-icon icon-eye"></i>
                            @else
                                <i class="demo-icon icon-eye-off"></i>
                            @endif
                            </a>
                            </td>
                        <td><a href="{{ route("admin_blocks.blocks.edit",$row->id) }}">{{ trans("admin_blocks::main.edit") }}</a></td>
                        <td><a href="{{ route("admin_blocks.blocks.delete",$row->id) }}">{{ trans("admin_blocks::main.delete") }}</a></td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        --}}


            </div>

        </div>
    </div>







        <!-- ==================== M O D A L S ==================== -->
        <!-- ++++++++++ DELETE MODAL ++++++++++ -->
        <div class="modal fade" id="deleteModal2" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Подтвердите УДАЛЕНИЕ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Данные будут удалены безвозвратно.</p>
                        <p>Вы уверены, что хотите удалить?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete_all" data-dismiss="modal">Удалить</button>
                        <button type="button" class="btn btn-info ml-auto">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Подтвердите УДАЛЕНИЕ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Данные будут удалены безвозвратно.</p>
                        <p>Вы уверены, что хотите удалить?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete_row_btn" data-dismiss="modal">Удалить</button>
                        <button type="button" class="btn btn-info ml-auto">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ++++++++++ / DELETE MODAL ++++++++++ -->
        <!-- ==================== / M O D A L S ==================== -->








    </div>
@endsection
