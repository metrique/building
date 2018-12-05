<form action="{{ $route }}" method="POST">
    {!! csrf_field() !!}
    {{ method_field('DELETE') }}
    <button type="submit" class="btn btn-xs btn-danger" data-role="destroy">
        <i class="fa fa-trash-o"></i>
        Delete
    </button>
</form>
