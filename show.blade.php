<!DOCTYPE html>
<html>

 <body>
       <div class="navdiv">
            <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top">
                <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                </button>
               <div><a class="navbar-brand" href="#">Laravel Forum App</a>
               <a href="/threads.php" class="threads">All Threads</a>
               </div>
            </nav>
        </div>
       <div class="container">
                <div class="row thread">
                    <div class="col-md-12">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            
                           <div class="creator">
                               <div class="level">
                                   <span class="flex"><a href="/profiles/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a> posted:</div>
                        
                            <div class="panel-heading">{{ $thread -> title }}</div>
                                    </span>
                                    @can ('update', $thread)
                               <form action="{{ $thread->path() }}" method="POST" class="del">
                               {{ csrf_field() }}
                               {{ method_field('DELETE') }}
                               <button type="submit" class="btn btn-link">Delete Thread</button>
                           </form>
                           @endcan
                           </div>
                            <div class="panel-body">{{ $thread -> body }}</div>
                         </div>
                     
                      @foreach ($thread->replies as $reply)
                        <div id="reply-{{ $reply->id }}" class="panel panel-default>
                            <div class="panel-heading">
                              <div class="time">
                              <div class="level">
                              <h5 class="flex">
                              <a href="/profiles/{{ $reply->owner->name }}">
                             {{$reply->owner->name}} </a> said {{ $reply->created_at->diffforHumans() }}...
                             </h5>
                             <div>
                             <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                             {{ csrf_field() }}
                             <div class="fav">
                               <button type="submit" class="btn btn-default" {{ $reply->isFavorited() ? 'disabled':'' }}>{{ $reply->favorites()->count()}} {{ str_plural('Favorite', $reply->favorites()->count()) }}</button>
                               </div>
                             </form>
                             </div>
                              </div>
                              </div>
                           <hr>
                             <div class="panel-body">{{ $reply -> body }}
                             </div>
                             @can ('update', $reply)
                             <div class="panel-footer">
                                 <form method="POST" action="/replies/{{ $reply->id }}">
                                     {{ csrf_field() }}
                                     {{ method_field('DELETE') }}
                                     <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                 </form>
                             </div>
                             @endcan
                             </div>
                            
                             @endforeach
                             
                             {{ $replies->links() }}
                             
                               @if(auth()->check())
                 
                    <form method="POST" action="{{ $thread->path() . '/replies' }}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Post</button>
                        </form>
                       
                        @else
                        <p class="text-center">Please <a href="{{ route('register') }}">sign in</a> to participate in this discussion.</p>
                        @endif
                        </div>
                       
                    <div class="col-md-4">
                         <div class="panel panel-default">
                              <div class="panel-body">
                                  <p>This thread was published {{ $thread->created_at->diffForHumans() }} by <a href="#">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.</p>
                                  </div>
                             
                            </div>
                    </div>
                </div>
            </div>
                
               
        </div>
</body>
</html>