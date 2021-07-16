@section('footer_js')
    <script src="{{ asset("vendor/admin_blocks/menu.js") }}"></script>
 @endsection
<input type="hidden" class="json_links" name="links" value='{!! json_encode($links) !!}'>

<div class="">
    <div class="row my-2">
        <div class="col-12 col-lg-4">
            {{ trans("admin_blocks::main.view") }}
        </div>
        <div class="col-12 col-lg-8">
            <input type="text" name="view" value="{{ $view }}"  class="form-control"/>
        </div>

    </div>
    
    <hr class="mt-3">
    
    <p>{{ trans("admin_blocks::main.manage_links") }}:</p>
   <div class="row my-2">
       <div class="col-12 col-lg-4">
           {{ trans("admin_blocks::main.link") }}<br>Например: /company
       </div>
       <div class="col-12 col-lg-8">
           <textarea  class="link_href form-control"></textarea>
       </div>

   </div>
    <div class="row my-2">
        <div class="col-12 col-lg-4">
            {{ trans("admin_blocks::main.title_link") }}
        </div>
        <div class="col-12 col-lg-8">
            <textarea   class="link_title form-control"></textarea>
        </div>

    </div>
    <div class="row my-2">
        <div class="col-12 col-lg-4">
            _target
        </div>
        <div class="col-12 col-lg-8">
            <select class="form-control link_target">
                <option></option>
                <option value="_self">{{ trans("admin_blocks::main.target_self") }}</option>
                <option value="_blank">{{ trans("admin_blocks::main.target_blank") }}</option>
            </select>

        </div>

    </div>
    <div class="row my-2 row_add_btn">
        <div class="col-8 offset-4">
            <a href="#" class="btn btn-dzenkit-action menu-add-link"><i class="icon-plus"></i>{{ trans("admin_blocks::main.addlink") }}</a>
        </div>
    </div>
    
    <div class="row row_edit_btn" style="display:none;">
        <div class="col-8 offset-4">
            <a href="#" class="btn btn-info menu-editbtn-link">{{ trans("admin_blocks::main.editlink") }}</a>
        </div>
    </div>
    
    <div class="">
        <p>Порядок добавления в древо:<br/>1. Выберите пункт в древе, куда добавить ссылку.<br/>2. Заполните форму выше.<br/>3. Нажмите [+Добавить] под формой.<br/>4. Нажмите [Применить] в конце страницы, чтобы сохранить изменения.</p>
    </div>
    
    
    <hr class="mt-3">
    
    <div class="result_menu row my-2" data-links="{{ trans("admin_blocks::main.links") }}" data-delete="{{ trans("admin_blocks::main.delete") }}" data-add="{{ trans("admin_blocks::main.addlink") }}" data-edit="{{ trans("admin_blocks::main.edit") }}">

    </div>
</div>
