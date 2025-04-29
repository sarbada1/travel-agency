<?php
if (!isset($dash))
    $dash = '-';
else
    $dash .= '-';
?>

@foreach($childDataTable as $child)
    @if($child->child)
        <tr>
            <td>{{$dash}} {{$child->name}}</td>
            <td>{{$child->postedBy->name}}</td>
            <td>
                                            @if($child->image)
                                                <img src="{{url($child->image)}}" alt="{{$child->name}}" width="50">
                                            @else
                                                <img src="{{url('icons/notfound.png')}}" width="50">
                                            @endif


                                        </td>
            <td>{{$child->created_at->diffForHumans()}}</td>
            <td style="width: 12%;">
                                            <form action="{{route('manage-blog-category.destroy',$child->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')

                                                @can('blog_categories_show')
                                                    <a href="{{route('manage-blog-category.show',$child->id)}}"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                @endcan
                                                @can('blog_categories_edit')
                                                    <a href="{{route('manage-blog-category.edit',$child->id)}}"
                                                       class="btn btn-success btn-sm">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                @endcan

                                                @can('blog_categories_delete')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                @endcan
                                            </form>

                                        </td>
          

        </tr>
            <?php $dash .= '-'; ?>
            <?php $dash = substr($dash, 0, -1); ?>
    @endif


    @include('backend.pages.blog.category.manageChild',['childDataTable' => $child->child])

@endforeach
