@if (Session::has('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×错误</button>
        <strong>
            <i class="fa fa-check-circle fa-lg fa-fw"></i> Success(成功).
        </strong>
        {{ Session::get('success') }}
    </div>
@endif