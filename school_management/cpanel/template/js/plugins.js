
$(document).ready(function(){
    $('#slideshow').cycle({
        fx:'fade'
    });
    $(".list_head").click(function(){
        var nextList=$(this).next();
        nextList.slideToggle();
        
    });
     $(".questionBlock").click(function(){
         $(this).css('background','rgb(7, 24, 41)');
         $('.questionBlock').not(this).css('background','#2c2c2c');
        var nextList=$(this).next();
        nextList.slideToggle();
        
    });
    $('.image_box img').mouseenter(function(){
       
    });
    $('#selectExam').click(function(){
        var id_exam=$('#selectExam').val();
        $.ajax({
         type:'POST',
         url:'data.php?id='+id_exam,
         async:false,
         data:{
             'display':1
         },
         success:function(data){
             $("#examPaper").html(data);
         }
        })
        
     });
    
   //$("#beginExam").click(function(){
       $.ajax({
            type:'POST',
         url:'data.php',
         async:false,
         data:{
             'display':1
         },
         success:function(data){
             $("#studentExamPaper").html(data);
         }
       });
  // });

    /*$('#radio').change(function(){
        if($(this).is(':checked')){
            var val=$(this).val();
        }
    });*/
    /*$("#radio").click(function(){
        var choice=$("input[type='radio']:checked").val();
        var id_exam=$('#id_exam').val();
        
        //$('#getData').html(choices+' , '+id_exam);
        $.ajax({
            type:'post',
            url:'data.php?choice='+choice,
            async:false,
            data:{
                'display':1
            },
            success:function(data){
                $('#getData').html(data);
            }
        });
        
    });*/
    $('#finish').click(function(){
       var message='we hope to get a good grades';
            $('#getData').html(message);
       
    });
    $('#imageIndex img').click(function(){
        $('#imageIndex').css({
            width:'750px',
            height:'500px',
            position:'relative'
        });
        
    });
    $('#imageIndex img').dblclick(function(){
        $('#imageIndex').css({
            width:'500px',
            height:'300px'
           
        });
        
    });
  
    //.form > div:nth-child(3) > form:nth-child(2) > input:nth-child(6)
});
