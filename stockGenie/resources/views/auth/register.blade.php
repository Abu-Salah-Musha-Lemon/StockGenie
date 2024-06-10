
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stoke Genie</title>

        <!-- Base Css Files -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/ionicon/css/ionicons.min.css')}}" rel="stylesheet" />
        <link href="{{asset('css/material-design-iconic-font.min.css')}}" rel="stylesheet">

        <!-- animate css -->
        <link href="{{asset('css/animate.css')}}" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="{{asset('css/waves-effect.css')}}" rel="stylesheet">

        <!-- Custom Files -->
        <link href="{{asset('css/helper.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />


        <script src="{{asset('js/modernizr.min.js')}}"></script>
        
    </head>
    <body>


        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-heading bg-img"> 
                    <div class="bg-overlay"></div>
                   <h3 class="text-center m-t-10 text-white"> Create a new Account </h3>
                </div> 


                <div class="panel-body ">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="form-group px-2">
                            <div class="col-xs-12 " style="margin-bottom:10px">
                                <input class="form-control input-lg " type="text"  name="name" :value="old('name')" placeholder="Username">
                            </div>
                            <span class="text-danger">@error('name') {{$nessage}}@enderror</span>
                            
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-12 " style="margin-bottom:10px">
                                <input class="form-control input-lg " type="email" name="email" :value="old('email')" placeholder="Email">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 " style="margin-bottom:10px">
                                <input class="form-control input-lg " id="password" 
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password"  placeholder="Password">
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 " style="margin-bottom:10px">
                                <input class="form-control input-lg " id="password_confirmation" 
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" placeholder="Confirmation Password"/>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12 " style="margin-bottom:10px">
                                <button class="btn btn-primary waves-effect waves-light btn-lg w-lg " type="submit">Register</button>
                            </div>
                        </div>

                        <div class="form-group m-t-30">
                            <div class="col-sm-12 text-center">
                                <a href="{{ route('login') }}">Already have account?</a>
                            </div>
                        </div>
                    </form> 
                </div>                                 
                
            </div>
        </div>

        
    	<script>
            var resizefunc = [];
        </script>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/waves.js')}}"></script>
        <script src="{{asset('js/wow.min.js')}}"></script>
        <script src="{{asset('js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>
        <script src="{{asset('assets/jquery-detectmobile/detect.js')}}"></script>
        <script src="{{asset('assets/fastclick/fastclick.js')}}"></script>
        <script src="{{asset('assets/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('assets/jquery-blockui/jquery.blockUI.js')}}"></script>


        <!-- CUSTOM JS -->
        <script src="{{asset('js/jquery.app.js')}}"></script>
	
	</body>
</html>
