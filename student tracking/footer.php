<script src="assets/js/jquery-ui.js"></script>

<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/jasny-bootstrap.js"></script>
<script src="assets/js/convert.js"></script>
<script>
$(document).ready(function(){
   var hash=window.location.hash;
   if (hash != ""){
       $('#tabs li').each(function(){
          $(this).removeClass('active');
       });
       $('#myTabContent div').each(function(){
          $(this).removeClass('active'); 
       });
       var link="";
       $('#tabs li').each(function(){
          link=$(this).find('a').attr('href');
          if(link==hash){  
              $(this).addClass('active');
          }
       });
       $('#myTabContent div').each(function(){
          link=$(this).attr('id');
          if('#'+link==hash){
              $(this).addClass('in');
              $(this).addClass('active');
              
          }
       });
   }
});               
</script>        
