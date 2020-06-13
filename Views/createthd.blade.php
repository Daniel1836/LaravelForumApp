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
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                             <div class="panel-heading">Create a new Thread</div>
                            <div class="panel-body">
                                <form method="POST" action="/threads.php">
                                    {{csrf_field()}}
                                    
                                      <div class="form-group">
                                        <label for="channel_id">Choose a Channel:</label>
                                        <select name="channel_id" class="form-control" id="channel_id" required>
                                            <option value="">Choose One...</option>
                                            
                                            @foreach ($channels as $channel)
                                            <option value="{{ $channel->id}}" {{old('channel_id')==$channel->id? 'selected' : ''}}>{{ $channel->name}}</option>
                                            @endforeach
                                            </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="title">Title:</label>
                                        <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="body">Body:</label>
                                        <textarea name="body" class="form-control" id="body" rows="8" required>{{old('body')}}</textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Publish</button>
                                    </div>
                                    
                                     @if(count($errors))
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                    
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                                     @endif
                                </form>
                               
                            </div>
                            </div>
                    </div>
                </div>
           </div>
                           
                            
                            
  </body>
  </html>
