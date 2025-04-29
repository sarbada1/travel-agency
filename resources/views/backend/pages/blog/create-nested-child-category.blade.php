<?php
if (!isset($dash))
    $dash = '-';
else
    $dash .= '-';
?>

@foreach($childrenData as $child)
    @if($child->child)
        <option value="{{$child->id}}"   @if( isSet($selectedCategoryId) &&  $selectedCategoryId !== "" && $child->id === $selectedCategoryId) selected @endif >{{$dash}} {{$child->name}}</option>
            <?php $dash .= '-'; ?>
        @include('backend.pages.blog.create-nested-child-category',['childrenData' => $child->child, 'selectedCategoryId' => $selectedCategoryId ?? null])
            <?php $dash = substr($dash, 0, -1); ?>
    @else
        <option value="{{$child->id}}"   @if( isSet($selectedCategoryId) &&  $selectedCategoryId !== "" && $child->id === $selectedCategoryId) selected @endif  >{{$dash}} {{$child->name}} </option>
    @endif
@endforeach
