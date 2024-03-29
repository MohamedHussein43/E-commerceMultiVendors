<div>
    <main id="main" class="main-site left-sidebar">

        <div class="container">
    
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">home</a></li>
                    <li class="item-link"><span>login</span></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                    <div class=" main-content-area">
                        <div class="wrap-login-item ">
                            <div class="login-form form-item form-stl">
                                <form name="frm-login" wire:submit.prevent="save">
                                    @if(Session::has('error_message'))
                                        <div class="alert alert-danger">{{Session::get('error_message')}}</div>
                                     @endif
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            <div class="alert alert-danger">{{$error}}</div>
                                        @endforeach
                                    @endif
                                    @csrf
                                    <fieldset class="wrap-title">
                                        <h3 class="form-title">Admins Login</h3>
                                    </fieldset>
                                    <fieldset class="wrap-input">
                                        <label for="validationDefaultUsername" class="form-label">Email Address:</label>
                                        <input type="email" class="form-control" wire:model.prevent="email" name="email" value="{{old('email')}}" id="validationDefaultUsername"  aria-describedby="inputGroupPrepend2" required placeholder="Type your email address">
                                        <span class="text-danger">@error('email'){{$message}}@enderror</span>
                                    </fieldset>
                                    <fieldset class="wrap-input">
                                        <label for="validationDefault03" class="form-label">Password:</label>
                                        <input type="password" name="password" class="form-control" wire:model.prevent="password" id="validationDefault03" required placeholder="Password">
                                        <span class="text-danger">@error('password'){{$message}}@enderror</span>
                                    </fieldset>
                                    <input type="submit" class="btn btn-submit">
                                </form>
                            </div>
                        </div>
                    </div><!--end main products area-->
                </div>
            </div><!--end row-->
    
        </div><!--end container-->
    
    </main>
    
</div>
