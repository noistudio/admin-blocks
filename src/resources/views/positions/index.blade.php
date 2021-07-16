@extends('artadmin::auth_page')
@section('title', trans("admin_blocks::position.positions"))
@section('content')
    <div class="main_content_iner">
        <div class="dzenkit-basic-card dzenkit-fulltable-maxwid-lg">
            
            <div class="dzenkit-table-header hdr-box d-flex align-items-center justify-content-between">
                <div class="hdr">{{ trans("admin_blocks::position.positions") }}</div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-secondary mr-2 icon-filter-1 js_show_hide_selections-setting"></button>
                    <div class="dropdown">
                        <a id="tableCog" href="#" class="btn btn-secondary mr-2 icon-cog-alt dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu dropdown-menu-right dzenkit-dropdown-menu dzenkit-check-menu pt-0" aria-labelledby="tableCog">
                            <li class="hdr">Настройка выдачи</li>
                            <li class="d-flex"><a class="dropdown-item icon-ok dzen-check " href="?orderby=desc">Новый сверху</a></li>
                            <li><a class="dropdown-item icon-ok dzen-check  actv " href="?orderby=asc">Новый снизу</a></li>

                            {{--<!--<li class="dropdown-divider"></li>
                            <li><a class="dropdown-item icon-ok dzen-check js_show_hide_table_descripts" href="#">Раскрыть уточнения</a></li>-->--}}
                        </ul>
                    </div>

                    <a href="{{ route("admin_blocks.position.add") }}" class="btn btn-dzenkit-action"><i class="icon-plus"></i>Добавить</a>
                </div>
            </div>
            
        
        <div class="dzenkit-basic-card-body rows_super_list">
            
            <form class="delete_form_all" action="" method="GET">
                
                <div class="table-responsive">
        
        
        
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="navbar-col"></th>
                                <th>{{ trans("admin_blocks::position.pos") }}</td>
                                {{--<!--<th>{{ trans("admin_blocks::position.delete") }}</td>-->--}}
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($rows)>0)
                            @foreach($rows as $row)
                        
                                <tr data-url-change="" data-row-id="" data-sort="">
                                    <td>
                                        <div class="row-nav d-flex">

                                            <div class="nav-bar d-flex align-items-center">
                                            
                                                <!-- action menu -->
                                                <div class="action">
                                                    <div class="dropleft">
                                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="icon-menu"></i>
                                                        </button>

                                                        <ul class="dropdown-menu">
                                                            <li><a class="icon-trash-empty del d-flex align-items-center" href="{{ route("admin_blocks.position.delete",$row->id) }}">Удалить без подтверждения</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- / action menu -->
                                            </div>
                                
                                        </div>
                                    </td>
                            
                                    <td><p>{{ $row->name }}</p></td>

                                </tr>
                
                
                
                
                                {{--<!--<tr>
                                    <td><p>{{ $row->name }}</p></td>
                                    <td><a href="{{ route("admin_blocks.position.delete",$row->id) }}">{{ trans("admin_blocks::position.delete") }}</a></td>
                                </tr>-->--}}
                    
                    
                    
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                </form>
        
            </div>
        </div>
    </div>
@endsection


