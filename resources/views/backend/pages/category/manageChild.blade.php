@foreach($children as $key => $child)
    <tr>
        <td></td>
        <td>
            {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level) !!}
            └─ <i class="{{$child->icon}}"></i> {{$child->name}}
        </td>
        <td>{{$child->page_type}}</td>
        <td>{{$child->parent->name}}</td>
        <td>
            @if($child->status)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">Inactive</span>
            @endif
        </td>
        <td>
            <a href="{{route('manage-category.show', $child->id)}}"
               class="btn btn-info btn-sm">
                <i class="bi bi-eye-fill"></i>
            </a>
            <a href="{{route('manage-category.edit', $child->id)}}"
               class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-square"></i>
            </a>

            <form action="{{route('manage-category.destroy', $child->id)}}"
                  method="post" class="d-inline">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this?')">
                    <i class="bi bi-trash-fill"></i>
                </button>
            </form>
        </td>
    </tr>
    @if(count($child->children) > 0)
        @include('backend.pages.category.manageChild', ['children' => $child->children, 'level' => $level + 1])
    @endif
@endforeach