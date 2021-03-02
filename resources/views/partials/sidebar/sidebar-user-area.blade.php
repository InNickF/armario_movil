 <!-- Nav Item - User Information -->
 @if (!Auth::guest())
 <div class="d-flex justify-content-center align-items-center text-center mb-4 mt-2">

     <div class="text-white">
     	<div class="bg-cover bg-center img-profile rounded-circle mx-auto" style="background-image: url('{{ Auth::user()->avatar_image }}')"></div>
         <div class="mx-2 mt-2 text-uppercase nav-text-span-collased__d-none">{{ auth()->user()->full_name }}</div>
        <p style="font-size:12.7px!important;" class="nav-text-span-collased__d-none">{{$tagline}}</p>
     </div>
 </div>
 @endif