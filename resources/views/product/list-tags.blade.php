@if($tags)
    <select multiple="" class="form-control">
        @foreach($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach
    </select>
@endif