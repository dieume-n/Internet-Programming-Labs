$(document).ready(function(){
    // alert("Hello");
    $('#generate-api').click(function(event){
        // alert("Hello");
        let confirm_key = confirm("You are about to generate an api key");
        if(!confirm_key){
            return;
        }
        $.ajax({
            url: "/apis/generate",
            type: "post",
            success: function(data){
                if(data){
                    $('#api').val(JSON.parse(data));
                }
            }
        })
    });

});