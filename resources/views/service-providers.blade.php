@extends('layouts.app')


@section('content')
@if ($errors->count())
    <div class="alert alert-danger">
        Sorry but there is some problem with your input please retry again
    </div>
@endif


<section id="trainer-main">
    <div class="container">
      <div class="row">
            <div class="col-md-8">
                
                @include('partials.messages')

                @if (!isset($city))
                    {{--
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="select-box">
                                        <select class="form-control form-input location-input">
                                            @foreach ($cities as $city)                               
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </label>   
                                </div>

                                <input type="text" hidden value="{{ $service->id }}">
                                <div class="col-md-3">
                                    <input type="submit" value="Search" class="service-btn">
                                </div>
                            </div>
                        </form>
                        <br><br>
                    --}}
                @endif

                <div class="main-trainer">
                    @foreach ($users as $user)
                            <div class="trainers">
                                <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ $user->profile_image }}" alt="trainer" class="profile-img">
                                </div>
                                <div class="col-md-7">
                                    <h2>{{ $user->name }}</h2>
                                    <p>{{ $user->rating }}<span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span>(19 reviews)</p>
                                    <p><i class="fas fa-map-marker-alt"></i> {{ $user->address  }}   {{ $user->city->name }}</p>
                                    @if ($user->serviceProviderReviews->count())
                                        <p class="testimonial testimonial2">{{ $user->serviceProviderReviews[0]->review }}</p>
                                        <p class="reviewer">{{ $user->serviceProviderReviews[0]->customer->name }}</p>
                                    @endif
                                    <div class="button-div">
                                        <a href="/profile/{{ $user->id }}" class="action-btn2">View Profile</a>
                                    </div>   
                                </div>
                                <div class="col-md-1"></div>  
                                </div>
                            </div>                        
                    @endforeach
                </div>
                {{ $users->links() }}
 
            </div>
          <div class="col-md-4">
              <form action="#" class="trainer-form2 service-question-trigger-box">
                  <h3 class="trainer-heading service-main-question-heading">Trainer Need for</h3>
                  <div class="service-main-question-answers">
                </div>
            </form>
          </div>
      </div>
      <!-- <div class="row">
          <div class="col-md-8"></div>
          <div class="col-md-4 button-col">
              <button class="action-btn1">Hire me</button>
              <button class="action-btn2">View Profile</button>
          </div>

      </div>     -->

    </div>
</section>

@include('partials.questions-modal', ['questions' => $questions])


@endsection

@push('scripts')
<script>
    var questions = '{!! $questions !!}'
    questions = JSON.parse(questions)
    $('.service-main-question-heading').html(questions[0].question)

    questions[0].answers.forEach(function(a){
        var a  = $('<label class="trainer-gender"><div class="form-control form-input trainer-input">'+ a.answer + '</div></label>')
        $('.service-main-question-answers').append(a)
        a.click(function(){
            @auth
                $('#service-questions-modal').modal('show')
            @else
                window.location = '/login'
            @endauth
        })
    })

</script>
@endpush
