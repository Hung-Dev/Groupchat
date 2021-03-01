setInterval(seenMessage,1000); 
setInterval(allMessageView,1000); 

function seenMessage() {
  

   $.ajax({
       type:'get',
       url:'{{URL::to('/seen')}}',
       datatype:'html',
       success:function(response){
           
           if(response > 0){
               $('#smsnum').show();
               $('#smsnum').html(response);

           }else{
               $('#smsnum').hide();
           }
            
          }
       });
}
function allMessageView() {
  

   $.ajax({
       type:'get',
       url:'{{URL::to('/allmessageview')}}',
       datatype:'html',
       success:function(response){
          $('#all-chat-message').html(response);
          }
       });
}

function seenUpdate() {

   $.ajax({
       type:'get',
       url:'{{URL::to('/seenUpdate')}}',
       datatype:'html'
       });
}
function singleSeenUpdate(id) {
var sender=id;
   $.ajax({
       type:'get',
       url:'{{URL::to('/singleSeenUpdate')}}/'+sender,
       datatype:'html'
       });
}
