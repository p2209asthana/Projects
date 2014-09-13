<style>
    #result-heading{
        text-align: center;
        margin : 1% 0 0 0;
    }
    #class-list{
       padding: 0px;
       width: 45%
    }
    .result-table{
        margin-top: 3%;
    }
    .result-table h4{
        text-align: center;
    }
    .selected{
        background-color: #00FF00;
    }
   
</style>

<div class="container">
    <h3 id="result-heading">Update Results</h3>
    <label class="col-sm-2 control-label" style="width:8%;padding: 0px">Select Class</label>
    <div class="col-sm-1" style="padding:0px;">    
        <select class="form-control" id="class-list">
            <option value=""></option>
            <?php 
            $i=1;
            while($i<=12) {
                ?> <option value="<?php echo $i;?>"><?php echo $i++;?></option>    
            <?php 
            }
            ?>
        </select>
    </div>
    <div class="result-table" style="visibility:hidden">
        <h4 id="table-top">Showing record of class - 3</h4>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr><th>#</th><th>Student id</th><th>Name</th><th>DOB</th><th>Academic Year</th><th>%age</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                
                <tr><td>1</td><td>123112</td><td>Chaman Lal</td><td>12-12-1992</td><td>2013-14</td><td><input type="text" class="form-control dec-only" name="perc"></td>
                    <td><select class="form-control" required>
                            <option value="">select</option>
                            <option value="1">Promoted to next class</option>
                            <option value="2">Retained in same class</option>
                            <option value="3">Passed and left</option>
                            <option value="4">Failed and left</option>
                        </select></td>
                        <td><button type="submit" class="btn btn-primary update-btn">Update</button></td>   
                </tr>
                
                <tr><td>1</td><td>123112</td><td>Chaman Lal</td><td>12-12-1992</td><td>2013-14</td><td><input type="text" class="form-control dec-only" name="perc"></td>
                    <td><select class="form-control">
                            <option value="">select</option>
                            <option value="1">Promoted to next class</option>
                            <option value="2">Retained in same class</option>
                            <option value="3">Passed and left</option>
                            <option value="4">Failed and left</option>
                        </select></td>
                        <td><button class="btn btn-primary update-btn">Update</button></td>   
                </tr>
                <tr><td>1</td><td>123112</td><td>Chaman Lal</td><td>12-12-1992</td><td>2013-14</td><td><input type="text" class="form-control dec-only" name="perc"></td>
                    <td><select class="form-control">
                            <option value="">select</option>
                            <option value="1">Promoted to next class</option>
                            <option value="2">Retained in same class</option>
                            <option value="3">Passed and left</option>
                            <option value="4">Failed and left</option>
                        </select></td>
                        <td><button class="btn btn-primary update-btn">Update</button></td>   
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#class-list').on('change',function(){
        if(this.value!=""){
            $("#table-top").text("Showing records of Class - "+this.value);
            $(".result-table").css("visibility","visible");
        }
        else{
            $(".result-table").css("visibility","hidden");
        }
            
    });
    
    $(".dec-only").keypress(function(e){
                if (e.which != 8 && e.which != 0 && (e.which < 46 || e.which > 57)) {
                 return false;
                }
            });
            
            
    
    $('.update-btn').click(function(){
        
        var perc = $(this).parent().parent().find('input[type=text][name=perc]').val();
        var status = $(this).parent().parent().find('select').val();
        
        if(perc=="" || status=="") return false;
        if(perc<0 || perc >100) return false;
        
        alert("%age = "+perc+"status = "+status);
        
        $(this).parent().parent().children('td').each(function() {
             $(this).addClass("selected");
        });
        $('.selected').css('background-color','#00FF00');
       // var z = $(this).closest('td').siblings('input[type=text][name=perc]').text();
        //alert(z); 
    });
</script>

