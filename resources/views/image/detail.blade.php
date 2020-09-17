@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card pub_image">

                <div class="card-header">
                    @if ($image->users->image)
                    <img src="{{ route('user.avatar', ['filename'=>$image->users->image]) }}"
                         alt="Avatar"
                         class="avatar">
                    @endif

                    <div class="data-user">
                        {{ $image->users->name.' '.$image->users->surname }}
                        <span class="nickname">{{ ' | @'.$image->users->nick }}</span>
                    </div>

                </div>

                <div class="card-body">
                    <div class="image-container image-detail">
                        <img src="{{ route('image.file', ['filename'=>$image->image_path]) }}"
                             alt="">
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
                        <img src="{{ asset('images/hearts-64-red.png') }}"
                             data-id="{{ $image->id }}"
                             class="btn-dislike">
                        @else
                        <img src="{{ asset('images/hearts-64-gray.png') }}"
                             data-id="{{ $image->id }}"
                             class="btn-like">
                        @endif
                        {{ count($image->likes) }}

                        @if (Auth::user() && Auth::user()->id == $image->users->id)
                        <div class="actions">
                            <a href="{{ route('image.edit', ['id'=>$image->id]) }}"
                               class="btn btn-sm btn-primary">Actualizar</a>

                            <!-- Button to Open the Modal -->
                            <button type="button"
                                    class="btn btn-sm btn-danger"
                                    data-toggle="modal"
                                    data-target="#eliminarimagen">
                                Eliminar
                            </button>

                            <!-- The Modal -->
                            <div class="modal"
                                 id="eliminarimagen">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">¿Estas seguro?</h4>
                                            <button type="button"
                                                    class="close"
                                                    data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            Si eliminas esta imagen nunca podrás recuperarla, ¿Estas seguro de querer borrarla?
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <a href="{{ route('image.delete', ['id' => $image->id]) }}"
                                               class="btn btn-danger">Eliminar definitivamente</a>
                                            <button type="button"
                                                    class="btn btn-dark"
                                                    data-dismiss="modal">Cancelar</button>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="comments"
                         style="padding: 20px">
                        <h2>Comentarios ({{ count($image->comments) }})</h2>
                        <hr>
                        <form action="{{ route('comment.save') }}"
                              method="post">
                            @csrf
                            <input type="hidden"
                                   id="image_id"
                                   name="image_id"
                                   value="{{ $image->id }}">
                            <p>
                                <textarea name="content"
                                          id="content"
                                          rows="4"
                                          class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                          style="width: 100%"
                                          required
                                          autofocus></textarea>
                            <div class="clearfix"></div>
                            @if ($errors->has('content'))
                            <span class="invalid-feedback"
                                  role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                            @endif
                            </p>
                            <button type="submit"
                                    class="btn btn-success">Enviar</button>
                        </form>
                        <hr>
                        @foreach ($image->comments as $comment)
                        <div class="comment">
                            <span class="nickname">{{ '@'.$comment->users->nick }}</span>
                            <span class="nickname">{{ ' | '.\FormatTime::LongTimeFilter($comment->created_at) }} </span>
                            <p>
                                {{ $comment->content }}
                                <br />
                                <br />
                                @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->images->user_id == Auth::user()->id))
                                    <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">Eliminar</a>
                                @endif
                            </p>
                            <hr>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
