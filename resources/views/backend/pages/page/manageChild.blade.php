<?php
if (!isset($dash))
    $dash = '-';
else
    $dash .= '-';
?>

@foreach($childDataTable as $child)
    @if($child->child)
        <tr>
            <td>{{$dash}} {{$child->title}}</td>
            <td>
                @if($child->image)
                    <img src="{{url($child->image)}}" alt=""
                         style="width: 100px;">
                @else
                    <span class="badge bg-danger"> No Image</span>
                @endif

            </td>
            <td style="width: 12%;">
                <a href="{{route('manage-page.show',$child->id)}}"
                   class="btn btn-primary btn-sm" title="Show News">
                    <i class="bi bi-eye-fill"></i>
                </a>
                <a href="{{route('manage-page.edit',$child->id)}}"
                   class="btn btn-success btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{route('manage-page.destroy',$child->id)}}" method="post" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure ?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>

            </td>


        </tr>
            <?php $dash .= '-'; ?>
            <?php $dash = substr($dash, 0, -1); ?>
    @endif


    @include('backend.pages.page.manageChild',['childDataTable' => $child->child])

@endforeach
