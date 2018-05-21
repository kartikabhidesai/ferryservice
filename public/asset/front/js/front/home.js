var Home = function(){
    var mainForm = function(){
        
        var form = $('#bookticket');
        var rules = {
            fromstaton: {required: true}
            
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
        
//        $('body').on('click','.nextbtn',function(){
//            var nextForm = $(this).attr('data-next-form');
//           
//           $('.submit-form').addClass('hidden');
//           $('.form'+nextForm).removeClass('hidden');
//        });
//        $('body').on('click','.prevbtn',function(){
//            var nextForm = $(this).attr('data-prev-form');
//           
//           $('.submit-form').addClass('hidden');
//           $('.form'+nextForm).removeClass('hidden');
//        });
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
            var value = $(this).val();
            $(".tripTo option[value='" + value + "']").attr("disabled","disabled");
           
        });
        
        $('body').on('change','.tripTo',function(){
            var value = $(this).val();
            $(".tripFrom option[value='" + value + "']").attr("disabled","disabled");
        });
        
        var date = new Date();
            date.setDate(date.getDate());
            
        $('#deparure').datepicker({
            startDate: date,
        }).on('changeDate',function(e){
            var html = ticketSelection(e.date);
            $('.ticketOneway').html(html);
        });
        $('#return').datepicker({
            startDate: date,
        }).on('changeDate',function(e){
            var html = ticketSelection(e.date);
            $('.ticketRound').html(html);
        });
    }
    
    function ticketSelection(selectDate){
        var d = new Date();
        var todayDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
        
        var selectedDate = selectDate.getFullYear() + "-" + (selectDate.getMonth()+1) + "-" + selectDate.getDate();
        
        var html = '';
        if(todayDate == selectedDate){
            html = "<button class='btn btn-default cusClass' disabled>09:30 AM<span class='price'><i class='fa fa-rupee'></i>500</span></button><button class='btn btn-default cusClass' disabled>02:30 PM<span class='price'><i class='fa fa-rupee'></i>500</span></button>";
        }else{
            html = "<button class='btn btn-default cusClass'>09:30 AM<span class='price'><i class='fa fa-rupee'></i>500</span></button><button class='btn btn-default cusClass'>02:30 PM<span class='price'><i class='fa fa-rupee'></i>500</span></button>";
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