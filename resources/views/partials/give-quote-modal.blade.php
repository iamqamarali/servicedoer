<!--  give quote modal -->
<div class="modal fade" id="give-quote-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-inner-box">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                    <h3><b> Quote request From <a href="" target="_blank" class="customer-name"></a> </b></h3>
                    <hr>
                    
                    <h3 style="margin: 10px 0 30px; font-size: 1.5em">Project Details</h3>

                    <div class="project-description">
                    </div>

                    <br>
                    <div class="quote">
                        <form action="" class="give-quote-form" id="give-quote-form" method="post">
                            @csrf
                            <p><b>Please enter the quote from the above described details</b></p>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="number" placeholder="Price" name="quote" class="form-control" value="">
                                </div>
                            </div>
                            <div class="text-center"><input type="button" class="continue continue-btn continue-button give-quote-form-submit-button" value="Continue"></div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@auth
@if (auth()->user()->type =='service-provider')
    @push('scripts')
        <script>
            $('.give-quote-notification').click(function(){
                var projectId = $(this).attr('project-id')
                var notificationId = $(this).attr('notification-id');
                $.ajax({
                    url: '/api/projects/'+projectId,
                    success: function(project){
                        console.log(project);
                        $('.customer-name').html(project.customer.name)
                        $('.customer-name').attr('href', '/customer/profile/' + project.customer._id)
                        $('#give-quote-modal').modal('show')
                        var $pd = $('.project-description');
                        $pd.html('')
                        project.questions.forEach(function(q){
                            var $question = $('<div class="question"><h5 class="question-text"><b>'+q.question+'</b></h5></div>')
                            var $contatiner = $('<div class="answers"></div> <br>')
                            q.answers.forEach(function(a){
                                $contatiner.append($('<div class="answers">' + a.answer +'</div>'))
                            })
                            $question.append($contatiner);                            
                            $pd.append($question);
                        })

                        $('.give-quote-form').attr('action','/givequote/project/'+ projectId);
                        $('.give-quote-form-submit-button').on('click', function(e){
                            e.preventDefault();
                            $.ajax({
                                method: 'get',
                                url : '/api/notifications/markasread/'+notificationId,
                                success: function(res){ 
                                    console.log(res)
                                    $('.give-quote-form').submit();
                                },
                            })
                        })
                    },
                    error: function(err){
                    }
                })
            })
        </script>   
    @endpush    
@endif
@endauth
