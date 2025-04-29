<?php
if (!isset($dash))
    $dash = '-';
else
    $dash .= '-';
?>

@foreach($childrenData as $child)
    @if($child->child)
        <option value="{{$child->id}}"   @if( isSet($parentId) && $child->id == $parentId) selected @endif >{{$dash}} {{$child->name}}</option>
            <?php $dash .= '-'; ?>
        @include('backend.pages.blog.category.create-nested-child',['childrenData' => $child->child, 'parentId' => $parentId ?? null])
            <?php $dash = substr($dash, 0, -1); ?>
    @else
        <option value="{{$child->id}}"   @if( isSet($parentId) && $child->id == $parentId) selected @endif  >{{$dash}} {{$child->name}} yes</option>
    @endif
@endforeach
