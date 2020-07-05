@auth
    @if (auth()->user()->type == 'service-provider')
        <!--  show review modal -->
        <div class="modal fade" id="show-review-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-inner-box">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <h3>New Review received for <a href="" class="view-order">order</a></h3>                            
                            <br>

                            <h4 style="margin: 20px 0 15px">
                                <b>
                                    <a href="" style="color:black" class="customer-name"></a>
                                </b>
                                &nbsp; <span class="review-rating"></span> 
                                <div class="stars-container">
                                </div>
                            </h4>

                            <p class="review-text"></p>

                        </div>    
                    </div>
                </div>
            </div>
        </div>


        @push('scripts')
            <script>
                $('.new-review-notification').click(function(e){
                    e.preventDefault();
                    var notificationId = $(this).attr('notification-id')
                    var reviewId = $(this).attr('review-id')
                    $.ajax({
                        url : '/api/reviews/'+ reviewId +'/show',
                        success: function(review){
                            var $modal = $('#show-review-modal')
                            $modal.find('.customer-name').html(review.customer.name)
                            $modal.find('.customer-name').attr('href', '/customer/profile/' + review.customer.id)
                            $modal.find('.view-order').attr('href', '/orders/'+review.order_id)
                            $modal.find('.review-text').html(review.review)
                            $modal.find('.review-rating').html(review.rating);
                            $modal.find('.stars-container').html('')
                            for(var i = 0; i< review.rating; i++){
                                $modal.find('.stars-container').append('<i class="fas fa-star star2"></i>')
                            }

                            $modal.modal('show')                            
                        },
                        error: function(err){
                            console.log(err)
                        }
                    })
                    $.ajax({
                        method: 'get',
                        url : '/api/notifications/markasread/'+notificationId,
                        success: function(res){
                            console.log(res)
                        },
                    })        
                })

                
            </script>
        @endpush

    @endif
@endauth
        