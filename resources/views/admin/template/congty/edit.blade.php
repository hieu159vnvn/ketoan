<form class="ui form p-4" action="editcompany/{{$congty->id}}" method="post" name="form_1">
    {{ csrf_field() }}
    <div class="row flex-align-end">
        <div class="form-group col-sm-6 mt-0 ">
            <h6>Tên tiếng Việt</h6>
            <input type="text" data-role="input" name="name_vn" value="{{$congty->name_vn}}"  >
        </div>
        <div class="form-group col-sm-6 mt-0">
            <h6>Tên tiếng Nhật</h6>
            <input type="text" data-role="input" name="name_jp" value="{{$congty->name_jp}}" >
        </div>
        <div class="form-group col-sm-12 mt-0">
            <h6>Ghi chú</h6>
            <input type="text" data-role="input" name="note" value="{{$congty->note}}" >
        </div>
        <div class="form-group col-sm-12 mt-0">
            <button class="mt-1 image-button primary"><span class="mif-checkmark icon"></span><span class="caption">Lưu</span></button>
        </div>
    </div>
</form>
