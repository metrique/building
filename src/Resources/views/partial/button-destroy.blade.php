<form action="{{ $route }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-danger" data-role="destroy"><i class="fa fa-trash-o"></i> Delete</button>
</form>
