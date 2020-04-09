<!DOCTYPE html>
<html>

    <body>
            <div class="navdiv">
                    <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top">
                        <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                        </button>
                       <div><a class="navbar-brand" href="#">Laravel CRUD App</a></div>
                        <div class="collapse navbar-collapse menu" id="navbarSupportedContent">
                            <ul class="navbar-nav menulist">
                              <li class="nav-item"><a class="nav-link" href="{{ url('/welcome.php') }}">Home</a></li>
                              <li class="nav-item"><a class="nav-link link" href="#">Create</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
<form class="form-horizontal" method="POST" action="{{ url('/insert.php') }}">
    {{csrf_field()}}
    <fieldset>
        @if(count($errors) > 0)
          @foreach($errors->all() as $error)
          <div class="alert alert-danger">
              {{$error}}
          </div>
          @endforeach
        @endif
    <div class="row">
        <div class="col-lg-12">
           <label class="col-lg-1">Title</label>
              <div class="col-lg-5">
                 <input type="text" name="title" class="form-control" placeholder="Title">
              </div>
         </div>
    </div>
    <div class="row">
        <div class="col-lg-12 description">
           <label class="col-lg-1">Description</label>
              <div class="col-lg-5">
                 <input type="text" name="description" class="form-control" placeholder="Description">
              </div>
         </div>
    </div>

<div class="form-group">
    <div class="col-lg-10">
        <button type="submit" class="btn btn-primary">Submit</button>
      <div class="back"><a href="{{ url('/welcome.php') }}" class="btn btn-primary">Back</a></div>
    </div>
</div>
</fieldset>
</form>
</body>
</html>