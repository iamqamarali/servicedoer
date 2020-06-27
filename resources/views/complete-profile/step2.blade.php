@extends('layouts.app')

@section('content')
<section id="steps">
    <div class="container">
        <div class="row">
           <div class="col-md-1"></div>   
           <div class="col-md-10 text-center">  
               <ul>
                 <li class="steps">1</li>
                 <li class="steps step2">2</li>
              </ul> 
           </div>   
           <div class="col-md-1"></div>   

        </div>
    </div>
</section>
<section id="picture">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 text-center">
                <form action="/complete-profile/step2" method="post" class="picture-form complete-profile-form" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="profile_pic" class="custom-file-input profile-pic-file-input" accept="image/x-png,image/gif,image/jpeg">
                    <div class="profile-pic-image-name"></div>
                    <p class="profile">Hi Haider</p>

                    <br>
                    @include('partials.errors')
                    <br>

                    <div class="row location-info-row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            
                              <div class="form-group">
                                <label for="city" class="location-info">City</label>
                                <select class="form-control form-input city-select" name="city">
                                    <option value="">City</option>
                                    @foreach ($cities as $city)                               
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="service" class="location-info">Service</label>
                                <select class="form-control form-input service-select " name="service">
                                    <option value="">Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address" class="location-info">Address</label>
                                <input type="text" name="address" class="form-control form-input">
                            </div>
                        </div>
                        <div class="col-md-1"></div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="phone" class="location-info">Phone</label>
                                <input type="text" name="phone" class="form-control form-input phone-input" placeholder="">
                            </div>
                        </div>

                    </div>
                  <div class="row text-area">
                      <div class="col-md-1"></div>
                      <div class="col-md-10">
                          <div class="form-group">
                              <label for="biography" class="location-info">Tell us about yourself</label>
                              <textarea name="bio" class="form-control biography bio-input"  cols="30" rows="2"></textarea>
                          </div>
                      </div>
                      <div class="col-md-1"></div>

                  </div>
                  <div class="row">
                      <div class="col-md-4"></div>
                      <div class="col-md-4">
                          <button type="button" class="continue2 submit">Continue</button>
                      </div>
                      <div class="col-md-4"></div>
                  </div>  
                </form>
            </div>
            <div class="col-md-1"></div>
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
                    <h3>Let us help you find a better service provider</h3>
                </div>
                <div class="row">
                      <form action="#" id="main-form">
                            <p class="gender question">What sex are you looking for?</p>


                            <div class="answers">
                 
                            </div>            
                          </form>
                          <div class="text-center"><input type="button" class="continue continue-btn continue-button" value="Continue"></div>
                </div>
            </div>   
        </div>
    </div>
    </div>
</div>

@endsection

@push('scripts')
<script>

    questions = []
    var question_number = 0

    var customerAnswers = []
    var customerQuestionAndAnswers = []

    $('.profile-pic-file-input').change(function(){
        $('.profile-pic-image-name').html(this.value);
    })



    // after clicking on submit button
    $('.complete-profile-form .submit').click(function(e){
        e.preventDefault();
        if(!$('.city-select').val() || !$('.service-select').val() || !$('.bio-input').val() || !$('.phone-input').val()){
            $('.complete-profile-form').submit()
        }else{
            var service = $('.service-select').val();
            $.ajax({
                url : '/api/service/' + service + '/questions',
                success: function(qs){
                    $('#service-questions-modal').modal('show')
                    questions = qs
                },
                error: function(){

                }
            })
        }
    })


        
    $('#service-questions-modal').on('shown.bs.modal', function () {
        question_number = 0
        customerAnswers = []
        customerQuestionAndAnswers = []
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
        console.log(JSON.stringify(customerQuestionAndAnswers))
        
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
            var $form = $('.complete-profile-form')
            customerAnswers.forEach(function(a){
                var checkbox = $('<input type="checkbox" name="answers[]" checked hidden value="'+a+'" />')
                $form.append(checkbox);
            })
            var questionsAnswers = $('<input type="text" name="question_answers" hidden class="d-none"  value=""/>')
            questionsAnswers.val(JSON.stringify(customerQuestionAndAnswers));
            $form.append(questionsAnswers);
            $form.submit()
        } 
    })


</script>
@endpush