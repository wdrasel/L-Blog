
    @if(isset($categoryName))
        <div class="alert alert-info">
            <p>
                Catagory: <strong>{{$categoryName}}</strong>
            </p>
        </div>

    @endif
    @if(isset($authorName))

        <div class="alert alert-info">
            Author: <strong>{{$authorName}}</strong>
        </div>
    @endif
    @if(isset($tagName))

        <div class="alert alert-info">
            Tag: <strong>{{$tagName}}</strong>
        </div>
    @endif

    @if ($term = request('term'))

        <div class="alert alert-info">
            Search result : <strong>{{$term}}</strong>
        </div>
    @endif