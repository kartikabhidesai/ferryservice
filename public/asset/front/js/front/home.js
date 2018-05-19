var Home = function(){
    var mainForm = function(){
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
    return{
         init: function() {
            mainForm();
            
        },
    }
}();