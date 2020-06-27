
$(document.body).ready(function(){
    $('.services-search-input').on('input', function(){
        $(this).attr('service-id', '');
        var val = $(this).val();
        $.ajax({
            url: '/api/services/search?query=' + val,
            success: function(data){
                $('.services-autocomplete-search .autocomplete-suggestions').html('')
                data.forEach(function(service){
                    var $suggestion = $('<div class="autocomplete-suggestion">'+ service.name +'</div>')
                    $suggestion.on('click', function(){
                        $('.services-search-input').val(service.name)
                        $('.services-search-input').attr('service-id', service._id)
                        $('.services-autocomplete-search .autocomplete-suggestions').html('')
                    });
                    $('.services-autocomplete-search .autocomplete-suggestions')
                    .append($suggestion)
                })
            }
        })
    });

    $('.service-provider-search-btn').click(function(e){
        e.preventDefault();
        if(!$('.city-select').val())
            return
        if(!$('.services-search-input').attr('service-id'))
            return
        window.location = '/service-providers/' + $('.city-select').val() + '/' + $('.services-search-input').attr('service-id');
    });
})
