@extends('layouts.app')


@section('content')
    
<section id="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="slider-heading">Find Local professional for pretty much for everything.</h1>
                <div class="row">
                    <div class="col-md-4">
                        <label class="select-box">
                           <select class="form-control form-input location-input city-select">
                               <option value="">City</option>
                               @foreach ($cities as $city)                               
                                   <option value="{{ $city->id }}">{{ $city->name }}</option>
                               @endforeach
                           </select>
                        </label>   
                    </div>
                    <div class="col-md-8">
                        <div class="autocomplete-search services-autocomplete-search">
                            <div class="autocomplete-input-wrapper">
                                <input type="text" class="form-control form-input autocomplete-input services-search-input" placeholder="Hire a pro for service">
                            </div>
                            <div class="autocomplete-suggestions">
                            </div>
                        </div>
                        <input type="button" value="Search" class="service-btn service-provider-search-btn">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img src="images/man.png" alt="man" class="slider-img">
            </div>
        </div>
    </div>
</section>

@include('partials.messages')

<section id="guarantee">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
           <div class="col-md-5">
             <div class="guarantee-text">
               <h2 class="guarantee-heading">The ServiceDoer Guarantee</h2>
               <p class="guarantee-para">If the job isn't done as agreed,you can get your money back.And if there's property damage,<br/>you're protected</p>
             </div>
            </div>
           <div class="col-md-5 text-center">
               <img src="images/Untitled-1.png" alt="guarantee" class="guarantee-img">
           </div>
           <div class="col-md-1"></div>
        </div>
    </div>
</section>
<section id="photography">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="services-heading">Photography</h2>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
               <div class="col-md-4">
                   <a href="/service-providers/{{ $photography->id }}">
                        <img src="images/photo1.jpg" alt="couple shoot" class="services-img">
                        <h4>Couple Shoot<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i>Look for doers</span></h4>
                    </a>
               </div>
               <div class="col-md-4">
                    <a href="/service-providers/{{ $photography->id }}">
                        <img src="images/photo2.jpg" alt="wedding shoot" class="services-img">
                        <h4>Wedding Shoot<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>
                    </a>
                </div>
              <div class="col-md-4">
                    <a href="/service-providers/{{ $photography->id }}">
                        <img src="images/photo3.jpg" alt="party shoots" class="services-img">
                        <h4>Party Shoots<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>
                    </a>
                </div>
            </div>
        </div>
</section>
<section id="health-fitness">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="services-heading">Health &amp; Fitness</h2>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
               <div class="col-md-4">
                   <a href="/service-providers/{{ $yogaTrainer->id }}"></a>
                        <img src="images/health1.jpg" alt="yoga trainer" class="services-img">
                        <h4>Yoga Trainer<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>
                    </a>
               </div>
               <div class="col-md-4">
                    <a href="/service-providers/{{ $personalTrainer->id }}"></a>
                        <img src="images/health2.jpg" alt="personal trainer" class="services-img">
                        <h4>Personal Trainer<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>
                    </a>
                </div>
              <div class="col-md-4">
                    <a href="/service-providers/{{ $dietician->id }}"></a>
                        <img src="images/health3.jpg" alt="physician" class="services-img">
                        <h4>Dietician<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>
                    </a>
                </div>
            </div>
        </div>
</section>
<section id="offering">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="offering-div">
                    <h1 class="offering-heading">Offering more services for all customers</h1>
                    <h3 class="offering-para">Fast and easily available services</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="experts">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
               <img src="images/expert1.jpg" alt="ac repair" class="expert-img">
               <h4>AC Repair<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>
            </div>
            <div class="col-md-4">
                    <img src="images/expert2.jpg" alt="ac repair" class="expert-img1">
                    <h4>Carpenter<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>
            </div>
            <div class="col-md-4">
                    <img src="images/service2.jpg" alt="ac repair" class="expert-img2">
                    <h4>Electrician<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8 plumber">
                <img src="images/expert5.jpg" alt="ac repair" class="expert-img3">
                <h4>Plumber<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>
            </div>

        </div>
    </div>
</section>
<section id="community">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
               <img src="images/community.png" alt="buy business" class="business-img">
            </div>
            <div class="col-md-8">
               <h1 class="buy-heading">Buy more business and Help Community.</h1>
               <p class="buy-para">Whatever work you do,we'll find one for you.</p>
               <button class="buy-btn">Become a servicedoer</button>
            </div>
        </div>
</section>  

@endsection
          

