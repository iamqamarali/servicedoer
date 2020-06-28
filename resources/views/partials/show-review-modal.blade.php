@auth
    @if (auth()->user()->type == 'service-provider')
        <!--  show review modal -->
        <div class="modal fade" id="show-review-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">

                    <h3><span class="customer-name"></span></h3>
                    <a href="" class="view-order">View Order</a>
                    &nbsp; <span class="review-rating"></span> 
                    <div class="stars-container">
                    </div>

                    <br>

                    <p class="customer-para"></p>

                    <button  class="continue continue-btn "  data-dismiss="modal" aria-label="Close" > Close</button>
                    
    
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
                            $modal.find('.view-order').attr('href', '/orders/'+review.order_id)
                            $modal.find('.customer-para').html(review.review)
                            $modal.find('.review-rating').html(review.rating);
                            for(var i = 0; i< 6; i++){
                                if(i < review.rating){
                                    $modal.find('.stars-container').append('<i class="fas fa-star star2"></i>')
                                }else{
                                    $modal.find('.stars-container').append('<i class="fas fa-star star2"></i>')
                                }
                            }

                            $modal.modal('show')                            
                        },
                        error: function(err){
                            console.log(err)
                        }
                    })
                    // $.ajax({
                    //     method: 'get',
                    //     url : '/api/notifications/markasread/'+notificationId,
                    //     success: function(res){
                    //         console.log(res)
                    //     },
                    // })        
                })

                
            </script>
        @endpush

    @endif
@endauth
        