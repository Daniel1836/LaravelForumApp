<!DOCTYPE html>
<html>

        <body>
                    <div class="navdiv">
            <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top">
                <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                </button>
               <div><a class="navbar-brand" href="#">Laravel Forum App</a></div>
               <li class="dropdown">
                   <a href="#" class="dropdown-toggle browse" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse</a>
                   <ul class="dropdown-menu">
                   <li><a href="/threads.php">All Threads</a></li>
                   @if (auth()->check())
                    <li><a href="/threads.php?by={{auth()->user()->name}}">My Threads</a></li>
                    @endif
                    <li><a href="/threads.php?popular=1">Popular Threads</a></li>
                     <li><a href="/threads.php?unanswered=1">Unanswered Threads</a></li>
                   </ul>
               </li>
               <a href="/threads/create" class="newthd">New Thread</a>
               <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Channels</a>
                   <ul class="dropdown-menu">
                       @foreach (App\Channel::all() as $channel)
                       <li><a href="/threads.php/{{ $channel->slug }}">{{ $channel->name}}</a> </li>
                       @endforeach
                   </ul>
               </li>
               
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}" class="links">Login</a></li>
                        <li><a href="{{ url('/register') }}" class="links">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle uname" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu logout" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                 <li><a href="{{ route('profile', Auth::user()) }}"><i class="fa fa-btn fa-sign-out"></i>My Profile</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
            <div class="container">
                <div class="row thread">
                    <div class="col-md-8 col-md-offset-2">
                        @forelse ($threads as $thread)
                        <div class="panel panel-default">
                            <div class="panel-heading">Forum Threads</div>

<article>
    <div class="level">
    <h4 class="flex">
      <div class="creator"><a href="/profiles/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a> posted:
      <a href="{{ $thread->path() }}">
          {{ $thread->title }}
          </a>
      </div>
    </h4>
    <a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</a>
    </div>
    <div class="panel-body">
    <div class="body">
        {{ $thread -> body}}
   </div>
  </article>
  <hr>

                          </div>
                   @empty
                   <p>There are no relevant results at this time.</p>
                     @endforelse
                       </div>
                  </div>
               </div>
            </div>
        </body>
</html>