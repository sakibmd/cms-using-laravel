@extends('layouts.blog')

@section('title')
  Self Development blog - Home Page
@endsection

@section('header')
    <!-- Header -->
    <header class="header text-center text-white" style="background-image: linear-gradient(to right top, #051937, #003c5b, #006173, #02877c, #63aa7c);">
      <div class="container">

        <div class="row">
          <div class="col-md-8 mx-auto">

            <h1>Latest Blog Posts</h1>
            <p class="lead-2 opacity-90 mt-6">Read and get updated on how we progress</p>

          </div>
        </div>

      </div>
    </header><!-- /.header -->
@endsection

@section('content')
        <!-- Main Content -->
        <main class="main-content">
          <div class="section bg-gray">
            <div class="container">
              <div class="row">
    
    
                <div class="col-md-8 col-xl-9">
                  <div class="row gap-y">
    
                    @forelse ($posts as $post)
                        <div class="col-md-6">
                            <div class="card border hover-shadow-6 mb-6 d-block">
                            <a href="{{ route('blog.show',$post->id) }}"><img class="card-img-top" src="{{ asset('storage/'.$post->image) }}" alt="Card image cap"></a>
                            <div class="p-6 text-center">
                                <p><a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="#">{{ $post->category->name }}</a></p>
                                <h5 class="mb-0"><a class="text-dark" href="{{ route('blog.show', $post->id) }}">{{ $post->title }}</a></h5>
                                <p class="my-3"><strong>Views: {{ $post->view_count }}</strong></p>
                            </div>
                            </div>
                        </div>
                    @empty
                        <h3 class="text-center">No Post Found For <strong>"{{ request()->query('search') }}"</strong></h3>
                    @endforelse
    
                  </div>
    
    
                  {{-- <nav class="flexbox mt-30">
                    <a class="btn btn-white disabled"><i class="ti-arrow-left fs-9 mr-4"></i> Newer</a>
                    <a class="btn btn-white" href="#">Older <i class="ti-arrow-right fs-9 ml-4"></i></a>
                  </nav> --}}
                  {{ $posts->appends(['search' => request()->query('search') ])->links() }}
                </div>
    
    
                @include('partials.sidebar')
              
    
              </div>

            </div> 
            <div class="container" style="background: rgb(146, 218, 214); padding: 40px 30px;margin-top:60px;border-radius:12px;">
              <div class="row justify-content-center  ">
                <h1><strong>Subscribe our site to see notification</strong></h1>
              </div>
              <div class="row my-2 justify-content-center">
                @if (session()->has('successSubscriber'))
                    <div class="alert alert-success m-3 text-center" id="success" role="alert">
                    {{ session()->get('successSubscriber') }}
                    </div>
                @endif 

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
           </div>
              <div class="row text-center" >
                    <br>
                      <div class="form-inline m-auto">
                        <form action="{{ route('subscriber.store') }}" method="POST">
                          @csrf
                          <div class="d-flex justify-content-start col-md-12">
                               <div class="form-group">
                                   <input type="email" name="email" placeholder="enter email" class="form-control">
                               </div>
                               <div class="form-group">
                                   <button type="submit" class="btn btn-danger ml-2">Subscribe</button>
                               </div>
                          </div>
                          
                      </form>
                      </div>
                </div>
            </div>
          </div>
        </main>


       
@endsection