@extends('layouts.app')


@section('content')
    
@include('partials.messages')
<section id="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="slider-heading">Find Local professional for pretty much for everything.</h1>
                <div class="row no-gutters"> 
                    <div class="col-md-4">
                        <label class="select-box">
                           <select class="form-control form-input location-input city-select">
                               @foreach ($cities as $city)                               
                                   <option value="{{ $city->id }}">{{ $city->name }}</option>
                               @endforeach
                           </select>
                        </label>   
                    </div>
                    <div class="col-md-6">
                        <div class="autocomplete-search services-autocomplete-search">
                            <div class="autocomplete-input-wrapper">
                                <input type="text" class="form-control form-input autocomplete-input services-search-input" placeholder="Hire a pro for service">
                            </div>
                            <div class="autocomplete-suggestions">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
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
        <section id="top-rated-services">
            <div class="container rated-services">
                <div class="row">
                    <div class="col-md-4">
                        <h2 class="services-heading">Top Rated Services</h2>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row services-rated">
                   <div class="col-md-4">
                    <a href="/service-providers/{{ $lahore->id }}/{{ $homeCleaning->id }}">
                        <img src="images/service1.jpg" alt="house-cleaning" class="services-img">
                        <h4>Full House Cleaning<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>
                    </a>
                   </div>
                   <div class="col-md-4">
                    <a href="/service-providers/{{ $lahore->id }}/{{ $electrician->id }}">
                        <img src="images/electricianimg.jpg" alt="Electrician" class="services-img">
                        <h4>Electrician<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i>Look for doers</span></h4>                        
                    </a>
                  </div>
                  <div class="col-md-4">
                        <a href="/service-providers/{{ $lahore->id }}/{{ $homeCleaning->id }}">
                            <img src="images/service3.jpg" alt="laundry" class="services-img">
                            <h4>Laundry<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i>Look for doers</span></h4>
                        </a>
                    </div>
                </div>
            </div>
        </section>
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
                            <h2 class="services-heading">Photography &amp; Tutor</h2>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row">
                       <div class="col-md-4">
                            <a href="/service-providers/{{ $lahore->id }}/{{ $photography->id }}">
                                <img src="images/photo1.jpg" alt="couple shoot" class="services-img">
                                <h4>Couple Shoot<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i>Look for doers</span></h4>                               
                            </a>
                       </div>
                       <div class="col-md-4">
                        <a href="/service-providers/{{ $lahore->id }}/{{ $photography->id }}">
                            <img src="images/photo2.jpg" alt="wedding shoot" class="services-img">
                            <h4>Wedding Shoot<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>
                        </a>
                      </div>
                      <div class="col-md-4">
                        <img src="images/tutor.jpg" alt="Tutor" class="services-img">
                        <a href="/service-providers/{{ $lahore->id }}/{{ $tutor->id }}">
                            <h4>Tutor<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>
                        </a>
                    </div>
                    </div>
                </div>
        </section>
        <section id="health-fitness">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h2 class="services-heading">Plumber &amp; Mechanic</h2>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row">
                       <div class="col-md-4">
                            <a href="/service-providers/{{ $lahore->id }}/{{ $mechanic->id }}">
                                <img src="images/mechanic.jpg" alt="Mechanic" class="services-img">
                                <h4>Mechanic<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>                               
                            </a>
                       </div>
                       <div class="col-md-4">
                        <a href="/service-providers/{{ $lahore->id }}/{{ $mechanic->id }}">
                            <img src="images/generator.jpg" alt="Generator Repair" class="services-img">
                            <h4>Generator Repairs<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>                            
                        </a>
                      </div>
                      <div class="col-md-4">
                        <a href="/service-providers/{{ $lahore->id }}/{{ $plumber->id }}">
                            <img src="images/Plumber.jpg" alt="Plumber" class="services-img">
                            <h4>Plumber<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>                            
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
                        <a href="/service-providers/{{ $lahore->id }}/{{ $plumber->id }}">
                            <img src="images/watermeter.jpg" alt="water meter installation" class="expert-img">
                            <h4>Water Meter Installation<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>                                
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/service-providers/{{ $lahore->id }}/{{ $plumber->id }}">
                            <img src="images/bathtub.jpg" alt="Bath-tub Fitting" class="expert-img1">
                            <h4>Bath-Tub Fitting<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>                            
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/service-providers/{{ $lahore->id }}/{{ $electrician->id }}">
                            <img src="images/service2.jpg" alt="Electronic wiring" class="expert-img2">
                            <h4>Electricial Wiring<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>                                
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8 plumber">
                        <a href="/service-providers/{{ $lahore->id }}/{{ $electrician->id }}">
                            <img src="images/upsandinverter.jpg" alt="UPS Inverter repair" class="expert-img3">
                            <h4>UPS & Inverter Replacement<br/><span class="date-info"><i class="fas fa-map-marker-alt"></i> Look for doers</span></h4>                            
                        </a>
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
                       <a href="/register/service-provider" class="buy-btn">Become a servicedoer</a>
                    </div>
                </div>
        </section>

@endsection
          

