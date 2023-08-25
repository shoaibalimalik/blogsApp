<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Blogs Site</title>
        <link href="{{ asset('css/bootstrap-4.0.0-alpha.6.css') }}" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            .text-muted {
                margin-bottom: 5px;
            }
            .card {
                min-height: 230px;
                max-height: 230px;
                overflow: hidden;
                background: #e5ecf1;
            } 
            .card p {
                max-height: 140px;
                min-height: 140px;
                overflow: auto;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="bg-success p-1 d-flex justify-content-between">
            <h1>Blogs Site</h1>
            @if (Route::has('login'))
                <div class="p-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Log In As Admin</a>
                    @endauth
                </div>
            @endif
        </div>

        <div class="py-5">
            <div class="container-fluid">
                @if(count($posts) > 0) 
                    <div class="row hidden-md-up">
                        @foreach ($posts as $post)
                            <div class="col-md-3" style="margin-bottom: 10px;">
                                <div class="card">
                                    <div class="card-block">
                                        <h6 class="card-subtitle text-muted text-center"><u>{{ $post->title }}</u></h6>
                                        <p class="card-text p-y-1">{{ $post->body }}</p>
                                        <div class="p-1 d-flex justify-content-between">
                                            <svg class="showModalButton" data-post-id="{{ $post->id }}" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59c-.125.36-.479 1.013-1.04 1.639c-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545c1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484c.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464c.201-.263.38-.578.488-.901c.11-.33.172-.762.004-1.149c.069-.13.12-.269.159-.403c.077-.27.113-.568.113-.857c0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362a1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272c-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05a9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164c-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868c-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65c1.095-.3 1.977-.996 2.614-1.708c.635-.71 1.064-1.475 1.238-1.978c.243-.7.407-1.768.482-2.85c.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725a.5.5 0 0 0 .595.644l.003-.001l.014-.003l.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164c.175.058.45.3.57.65c.107.308.087.67-.266 1.022l-.353.353l.353.354c.043.043.105.141.154.315c.048.167.075.37.075.581c0 .212-.027.414-.075.582c-.05.174-.111.272-.154.315l-.353.353l.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353l.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                            <title>click me to like the post</title>
                                            </svg>
                                            <div>
                                                <span class="{{ $post->id }}_likes_count">{{ $post->likes_count }}</span> likes
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h2 class="text-center bg-secondary mt-5">Posts Coming soon</h2>
                @endif
            </div>
        </div>
    </body>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.showModalButton', showModal);

    function showModal() {
        const post_id = $(this).data('post-id');
        Swal.fire({
            title: 'Enter your email to like this post',
            input: 'email',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: (email) => {
                $.ajax({
                    method: "POST",
                    url: "/like",
                    data: { post_id: post_id, email: email }
                    }).done(function( response ) {
                        if(response.success === "true"){
                           $('.'+post_id+'_likes_count').html(response.likes);
                           Swal.fire(response.message, '', 'success');
                        }else{
                            Swal.fire(response.message, '', 'error');
                        } 
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        })
        .then((result) => {
            
        });
    }
</script>
    
</html>
