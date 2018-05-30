var Home = function(){
    var mainForm = function(){
         $('#bookticket').validate({
            rules: {
               fromstaton: {required: true},
               tostation: {required: true},
               depature: {required: true},
               return: {required: {depends: function (e) {
                            return ($('input[name="trip"]').val !== 'round');
                    }}},
            },
            messages: {
                fromstaton: {
                    required: "please select from station"
                },
                tostation: {
                    required: "please select to station"
                },
                depature: {
                    required: "please select to depature"
                },
                return: {
                    required: "please select to return"
                },
            },
            
        });
        var form = $('#bookticket');
        var rules = {
            fromstaton: {required: true}
            
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
        
        $('body').on('click','.nextbtn',function(){
            var nextForm = $(this).attr('data-next-form');
           
           $('.submit-form').addClass('hidden');
           $('.form'+nextForm).removeClass('hidden');
        });
        $('body').on('click','.prevbtn',function(){
            var nextForm = $(this).attr('data-prev-form');
           
           $('.submit-form').addClass('hidden');
           $('.form'+nextForm).removeClass('hidden');
        });
    }
    
    var handleGenral = function (){
        $('body').on('click','.tripSelection',function(){
            var value = $(this).val();
            if(value == 'one-way'){
                $('.roundTrip').attr('disabled',true);
                $('.roundTicket').attr('disabled',true);
                
            }else{
                $('.roundTrip').attr('disabled',false);
                $('.roundTicket').attr('disabled',false);
                
            }
        });
        
        $('body').on('change','.tripFrom',function(){
            var selectedValue = $(this).val();
           $(".tripTo option").remove();
           $(".tripFrom option").each(function()
            {
                if($(this).val() != '' && $(this).val() != selectedValue)
                {
                    $('.tripTo').append($('<option>', {value:$(this).val(), text:$(this).text()}));
                }
            });
           
        });
        
        var date = new Date();
            date.setDate(date.getDate());
            
        $('#deparure').datepicker({
            startDate: date,
        }).on('changeDate',function(e){
            var postData = {fromDate:e.date};
            ajaxcall(baseurl +'trip-detail',postData,function(data){
                //alert(data);
            });
            var html = ticketSelection(e.date);
            $('.ticketOneway').html(html);
            $('.less2years').trigger('change');
        });
        $('#return').datepicker({
            startDate: date,
        }).on('changeDate',function(e){
            var html = ticketSelection(e.date);
            $('.ticketRound').html(html);
        });
        
        $('body').on('click','.selectTrip',function(){
          
           $(this).parents('fieldset').find('.selectTrip').removeClass('active');
           $(this).addClass('active');
           var time = $(this).attr('data-time');
           var price = $(this).attr('data-price');
       
           $(this).parents('fieldset').find('.tripPrice').val(price);
           $(this).parents('fieldset').find('.tripTime').val(time);
        });
        
        $('body').on('change','.less2years',function(){
            if($( ".more2years" ).val() == ''){
                $( this ).rules( "add", {
                required : true
              });
            $( ".more2years" ).rules( "remove" );
            }
            
        })
        $('body').on('change','.more2years',function(){
            if($( ".less2years" ).val() == ''){
                $( this ).rules( "add", {
                required : true
              });
            $( ".less2years" ).rules( "remove" );
            }
            
        })
    }
    
    function ticketSelection(selectDate){
        var d = new Date();
        var todayDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
        
        var selectedDate = selectDate.getFullYear() + "-" + (selectDate.getMonth()+1) + "-" + selectDate.getDate();
        
        var html = '';
        if(todayDate == selectedDate){
            html = "<button type='button' class='btn btn-default cusClass' disabled>09:30 AM<span class='price'><i class='fa fa-rupee'></i>500</span></button><button type='button' class='btn btn-default cusClass' disabled>02:30 PM<span class='price'><i class='fa fa-rupee'></i>500</span></button>";
        }else{
            html = "<button type='button' class='btn btn-default cusClass selectTrip' data-time='09:30 AM' data-price='500'>09:30 AM<span class='price'><i class='fa fa-rupee'></i>500</span></button><button type='button' class='btn btn-default cusClass selectTrip' data-time='02:30 PM' data-price='500'>02:30 PM<span class='price'><i class='fa fa-rupee'></i>500</span></button>";
        }
        return html;
    }
    
    return{
         init: function() {
            mainForm();
            handleGenral();
        },
    }
}();