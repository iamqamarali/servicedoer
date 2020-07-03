@auth
    
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
                                <p class="gender question"></p>


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

    @push('scripts')
    <script>
        var questions = '{!! $questions !!}'
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
                var $form = $('<form action="/create-project" class="d-none" method="post">@csrf</form>')
                customerAnswers.forEach(function(a){
                    var checkbox = $('<input type="checkbox" name="answers[]" checked hidden value="'+a+'" />')
                    $form.append(checkbox);
                })
                var questionsAnswers = $('<input type="text" name="question_answers"  value=""/>')
                questionsAnswers.val(JSON.stringify(customerQuestionAndAnswers));
                $form.append(questionsAnswers);
                $(document.body).append($form);
                $form.submit()
            } 
        })
    </script>
    @endpush
@endauth
