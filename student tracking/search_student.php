<style>
    
    .search-form{
        padding: 1% 0 0 0;
    }
    .ui-datepicker{
        font-size: 95%;
    }
    
    #search-btn{
        width: 70px;
        height: 34px;
    }
    .search-results{
        margin-top: 50px;
    }
    .search-result-table{
        width: 70%
    }
</style>



<div class="container">
    
    <div class="search-form">
        <form action="" class="form-horizontal" method="get">
            <div class="form-group">
                <label class="col-sm-2 control-label">Search a Student</label>
                <div class="col-sm-2" style="margin-left:10px">
                    <input type="text" name="reg_id" id="regId" class="form-control" placeholder="by Registration Id">
                </div> 
                
                <label class="col-sm-1 control-label" style="width:5%;padding-right: 0px;">OR</label>
                <div class="col-sm-3">
                    <input type="text" name="st_name" id="st_name" class="form-control" placeholder="by Name">
                </div>
                
                    <label class="col-sm-1 control-label" style="width:5%;padding-left: 0px">OR</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="datepicker" name="st_dob" placeholder="by Date of Birth">
                    </div>
                    <button type="submit" class="btn btn-primary" id="search-btn" style="margin-left:20px"><span class="glyphicon glyphicon-search"></span></button>
            </div>   
        </form>
    </div>  
    
    <div class="search-results" id="query-result" style="visibility:hidden;">
        <div style="padding-left: 100px">
            <h4 id="search-query">Showing results for "Searched query"</h4>    
        </div>
        <div class="search-result-table">
        <table class="table table-striped table-bordered table-hover" id="result-table">
            <thead>
                <tr><th>#</th><th>Registration. No.</th><th>Name</th><th>D.O.B</th><th></th></tr>
            </thead>
            <tbody data-link="row" class="rowlink">
                <tr><td><a href="view_student.php?id=1" target="_blank">1</a></td><td>1234ABCD</td><td>Name Lastname</td><td class="rowlink-skip"><a href="view_student.php?id=1" target="_blank">View</a></td></tr>
              </tbody>    
        </table>
        </div>
    </div>
              
</div>

<!--<script src="assets/js/jquery.min.js"></script> -->
<script>
$(function(){
                $("#datepicker").datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
                yearRange:"-30:+0"
                }); 
            });
        
        $('#search-btn').click(function(){ 
            var regId = $('#regId').val();
            var name = $('#st_name').val();
            var dob = $('#datepicker').val();
            
            var search_query="";
            var count=0;
            if(regId!=""){
                search_query+="Reg.Id: <i>"+regId+"</i>";
                count++;
            } 
            if(name!=""){
                if(count==1) search_query+=" and ";
              search_query+=" name: <i>"+name+"</i>";
              count++;
            } 
            if(dob!=""){
                if(count>=1) search_query+=" and ";
              search_query+=" dob: <i>"+dob+"</i>";
              count++;
            }
            if(count==0) {
                $('#query-result').css("visibility","hidden");
                return false;
            }
            
            //alert(regId+fname+lname+dob);
            $.ajax({
                type:'POST',
                url : 'search.php',
                data : {reg_id:regId,name:name,dob:dob},
                cache : false,
                success: function(result){ alert(result);
                if (result== 0) {
                    $('#search-query').html('No results found for '+'&nbsp;"'+search_query+'"');
                    $('#search-query').css("visibility","visible");
                }
                else{
                    $('#search-query').html('Showing search results for &nbsp;'+'"'+search_query+'&nbsp;"'+'');
                    $('#query-result').css("visibility","visible");
                    
                    $('#result-table tr').has('td').remove();
                    
                    var obj = jQuery.parseJSON(result);
                    var i=0;
                    for(i=0;i<obj.length;i++){
                        $('#result-table tbody').append('<tr><td><a href="view_student.php?id='+obj[i].id+'" target="_blank">'+(i+1)+'</a></td>'+
                                                        '<td>'+obj[i].id+'</td><td>'+obj[i].name+'</td>'+
                                                         '<td>'+obj[i].dob+'</td>'+
                                                         '<td class="rowlink-skip"><a href="view_student.php?id='+obj[i].id+'" target="_blank">View</td></tr>');
                    }
                   }   
                }
            });
        });
</script>