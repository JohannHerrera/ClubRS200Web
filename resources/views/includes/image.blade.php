<div class="card pub_image">
    <div class="card-header">
        @if ($image->users->image)
            <img src="{{ route('user.avatar', ['filename'=>$image->users->image]) }}" alt="Avatar" class="avatar">
        @endif

        <a href="{{ route('profile', ['id' => $image->users->id]) }}">
            <div class="data-user">
                {{ $image->users->name.' '.$image->users->surname }}
                <span class="nickname">
                    {{ ' | @'.$image->users->nick }}
                </span>
            </div>
        </a>
    </div>

    <div class="card-body">
        <div class="image-container image-detail">
            <img src="{{ route('image.file', ['filename'=>$image->image_path]) }}" alt="">
        </div>
        <div class="description">
            <span class="nickname">{{ '@'.$image->users->nick }}</span>
            <span class="nickname">{{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }} </span>
            <p>{{ $image->description }}</p>
        </div>

        <div class="likes">
            <?php $user_like = false; ?>
            @foreach ($image->likes as $like)
                @if ($like->users->id == Auth::user()->id)
                    <?php $user_like = true; ?>
                @endif
            @endforeach

            @if ($user_like)
                <img src="{{ asset('images/hearts-64-red.png') }}" data-id="{{ $image->id }}" class="btn-dislike">
            @else
                <img src="{{ asset('images/hearts-64-gray.png') }}" data-id="{{ $image->id }}" class="btn-like">
            @endif
            {{ count($image->likes) }}

        </div>

        <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="btn btn-sm btn-dark btn-comments">
            Comentarios ({{ count($image->comments) }})
        </a>
    </div>

</div>
