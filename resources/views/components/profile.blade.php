<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{ $user->name }}</span><span class="text-black-50">{{ $user->email }} </span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <form action="{{route('users.update', $user)}}" method="post" class="p-3 py-5">
                @method('put')
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="name" class="labels">Name</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="enter name" value="{{$user->name}}">
                    </div>
                    <div class="col-md-12">
                        <label for="email" class="labels">Email</label>
                        <input id="email" name="email" type="text" class="form-control" placeholder="enter email" value="{{$user->email}}">
                    </div>
                    <div class="col-md-12">
                        <label for="facebook_id" class="labels">Facebook Id</label>
                        <input id="facebook_id" name="facebook_id" type="text" class="form-control" placeholder="enter facebook id" value="{{$user->facebook_id}}">
                    </div>
                </div>
                
                <div class="mt-5 text-center"><button class="btn btn-outline-primary profile-button" type="submit">Save Profile</button>
                </div>
            </form>
        </div>

    </div>
</div>