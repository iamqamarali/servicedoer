@extends('layouts.app')

@section('content')
<section id="review" class="service-provider-profile-page">
  <div class="container">
    @include('partials.messages')
      <div class="row">
          <div class="col-md-4">
              <div class="reviewer-div text-center left-box">
                  <div class="profile-pic" style="background-image:url({{ $provider->profile_image }})" ></div>
                  <h3>{{ $provider->name }}</h3>
                  <p class="location1"><i class="fas fa-map-marker-alt alt2"></i> {{ $provider->address  }}   {{ $provider->city->name }}</p>
                  <div class="review-buttons">
                    @auth
                      @if (auth()->user()->type == 'customer')
                        <button class="hire-me get-quote">Get Quote</button>
                      @endif
                    @else
                      <a href="/login" class="hire-me ">Get Quote</a>
                    @endauth

                    @auth
                      @if (auth()->user()->type == 'service-provider')
                        <div>
                          <b>Connects Available: </b>
                          {{ auth()->user()->connects }}                      
                        </div>
                      @endif
                    @endauth                      

                    <div style="margin:10px 0">
                      <b>Orders Completed : </b>
                      {{ $orders->count() }}                      
                    </div>
                    <div style="margin:10px 0">
                      <b>Money Earned : </b>
                      {{ $orders->pluck('amount')->sum() }}                      
                    </div>

                 </div>
   
              </div>
              <div class="reviewer-info info2 left-box">
                    <p class="bio-para">Bio<br/><span class="bio">{{ $provider->bio }}</span></p>
                    <p class="service-providers">Provide Services</p>
                    <p class="service-provide1">{{ $provider->service->name }}</p>
              </div>
          </div>
          <div class="col-md-8">
              <h3>Reviews </h3>
              @foreach ($reviews as $review)
                <p class="customer-para">{{ $review->review }}</p>
                <div class="row">
                  <div class="col-md-4">
                  <p class="rating">{{ $review->created_at->diffForHumans() }}</p>
                  </div>
                  <div class="col-md-2"></div>
                  <div class="col-md-6">
                    <p class="rating-info">- <a href="/customer/profile/{{ $review->customer->id }}">{{$review->customer->name}}</a> &nbsp; {{$review->rating }}
                        @for ($i = 0; $i < $review->rating ;$i++)
                          <i class="fas fa-star star2"></i>
                        @endfor
                      </p>
                  </div>
                </div>
              @endforeach   
          </div>

      </div>
  </div>
</section>



<div class="modal fade" id="service-questions-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="trainer-box"> 
            <div class="row let-us">
                <h3>Please choose your requirements</h3>
            </div>
            <div class="row">
                  <form action="#" id="main-form">
                        <p class="gender question"></p>

                        <div class="answers">
            
                        </div>            
                  </form>
                  <div class="text-center"><input type="button" class="continue continue-btn continue-button" value="Continue"></div>
              </div>
          </div>   
      </div>
      <div class="modal-footer">
      </div>
  </div>
  </div>
</div>


@if (session('project'))
  <form action="{{ route('request-quote', [$provider->id, session('project')]) }}" method="post" class="get-quote-form d-none">
    @csrf
  </form>
@endif


@endsection

@push('scripts')
  <script>
        @if(session('project'))
          $('.get-quote').click(function(){
              $('.get-quote-form').submit();
          })
        @else
          $('.get-quote').click(function(){
            $('#service-questions-modal').modal('show')
          })

          var questions = '{!! $provider->service->questions()->with("answers")->get() !!}'
          questions = JSON.parse(questions)
          console.log(questions)
          var question_number = 0

          
          var customerAnswers = []
          var customerQuestionAndAnswers = []
          
          $('#service-questions-modal').on('shown.bs.modal', function () {
              question_number = 0
              customerAnswers = []
              renderQuestion(question_number)
          })

          function renderQuestion(qn){
            $('#service-questions-modal .question').html(questions[qn].question)
            var $answersContainer = $('#service-questions-modal .answers')
            $answersContainer.html('');
            var answers = questions[qn].answers
            answers.forEach(function(a){
                $answer = $('<div class="answer"></div>')
                $checkbox = $('<label class="box1">'+ a.answer +'<input type="checkbox" class="checkbox-input" name="answer" id="' + a._id + '" value="'+ a._id +'" ><span class="checkmark"></span></label><br><br>')
                $answer.append($checkbox)
                $answersContainer.append($answer);
            })
        }
          $('#service-questions-modal .continue-button').click(function(){
              var $answersContainer = $('#service-questions-modal .answers')
              $answer = $answersContainer.find('.checkbox-input:checked')
              if(!$answer.length)
                  return

              var tempAnsArray = [];
              $answer.each(function(i, elm){
                  tempAnsArray.push($(elm).val())
              })
              customerQuestionAndAnswers.push({
                  'question' : questions[question_number]._id,
                  'answers' : tempAnsArray
              })
              
              $answer.each(function(i , elm){
                  customerAnswers.push($(elm).val())
              })        

              if(question_number + 1< questions.length ){
                  question_number++
                  renderQuestion(question_number)
                  if(question_number + 1 == questions.length){
                      // change the txt of the continue button
                      $(this).html('Find Service Providers')
                  }
              }else{
                  // submit the form to create a project and function service providers
                  var $form = $('<form action="/create-project/requestquote/{{$provider->id}}" method="post">@csrf</form>')
                  customerAnswers.forEach(function(a){
                      var checkbox = $('<input name="answers[]" checked hidden value="'+a+'" />')
                      $form.append(checkbox);
                  });
                  var questionsAnswers = $('<input type="text" name="question_answers"  value=""/>')
                  questionsAnswers.val(JSON.stringify(customerQuestionAndAnswers));
                  $form.append(questionsAnswers);
                  $(document.body).append($form)
                  $form.submit()
              } 
          })

        @endif
  </script>
@endpush