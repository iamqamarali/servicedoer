<!--  give quote modal -->
<div class="modal fade" id="order-quote-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-inner-box">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h3 class="modal-heading">Quote Sent by <a href="" class="service-provider-name"></a></h3>
                    <hr>

                    <h3 class="project-description-heading" style="margin: 10px 0 30px; font-size: 1.5em">Project Description</h3>
                    <div class="project-description">
                    </div>
                    
                    <br>

                    <div>
                        <span class="service-provider-name"></span> has asked for the following price for your requirements
                    </div>
                    <div>
                        <b>Quote Price: </b>  <span class="quote-price"></span>            
                    </div>

                    <input type="button" class="continue continue-btn order-quote-form-submit-button" value="Accept Quote">
                    <input type="button" class="continue continue-btn " data-dismiss="modal"  value="Cancel">
                </div>

            </div>
        </div>
    </div>
</div>


<form action="" class="order-quote-form d-none" method="post">
    @csrf
</form>    


@auth
@if (auth()->user()->type =='customer')
    @push('scripts')
        <script>

            $('.order-cancel-button').click(function(){
                $('#order-quote-modal').modal('hide');
            })

            $('.quote-received-notification').click(function(e){
                e.preventDefault();
                var $self = $(this)
                var quoteId = $self.attr('quote-id')
                var notificationId = $self.attr('notification-id');
                $('.order-quote-form').attr('action', 'orders/'+quoteId)
                $.ajax({
                    url: '/api/quotes/'+quoteId,
                    success: function(quote){
                        console.log(quote);
                        $('#order-quote-modal').modal('show')
                        var $pd = $('.project-description');
                        $pd.html('');
                        $('.service-provider-name').html(quote.service_provider.first_name + ' ' + quote.service_provider.last_name);
                        $('.service-provider-name').attr('href', '/profile/' + quote.service_provider._id );
                        $('.quote-price').html(quote.quote)
                        quote.project.questions.forEach(function(q){
                            var $question = $('<div class="question"><h5 class="question-text"><b>'+q.question+'</b></h5></div><br>')
                            var $contatiner = $('<div class="answers"></div>')
                            q.answers.forEach(function(a){
                                $contatiner.append($('<div class="answers">' + a.answer +'</div>'))
                            })
                            $question.append($contatiner);                            
                            $pd.append($question);
                        })

                        $('.order-quote-form-submit-button').on('click', function(e){
                            e.preventDefault();
                            $.ajax({
                                method: 'get',
                                url : '/api/notifications/markasread/'+notificationId,
                                success: function(res){
                                    console.log(res)
                                   $('.order-quote-form').submit();
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
