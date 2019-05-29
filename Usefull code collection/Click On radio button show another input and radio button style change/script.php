<style type="text/css">
.less-padding{
padding: 9px 14px !important;
}
.my-radio {
-webkit-appearance: none;
content: '';
width: 20px;
height: 20px;
background-color: #7195fb;
border-radius: 50%;
outline: 0px;
}
.my-radio:checked::after {
content: '';
background: #fff;
display: block;
width: 50%;
height: 50%;
margin: 25%;
border-radius: 50%;
}
</style>


  <div class="form-group less-padding">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input " type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked="checked">
                                            <label class="form-check-label" for="exampleRadios1">
                                                Blank Campaign
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input " type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                            <label class="form-check-label" for="exampleRadios2">
                                                Copy From Existing
                                            </label>
                                        </div>
                                    </div>
                                </div>
 <!--...................Existing Campain name..............................................
                                 -->

                                <div class="form-group less-padding" style="display: none;" id="ext_camp">
                                    <label class="col-sm-3 control-label"><?php echo $Lan['Existing_Campaign']; ?></label>
                                    <div class="col-sm-6">
                        <select class="select2" multiple  name="exist_campaign_id[]">
                                <?php 
                                    $query = "SELECT * FROM sms_campaign";
                                    $stmt3 = $dbh->prepare($query);
                                    $stmt3->execute();
                                    while($value1 = $stmt3->fetch())
                                    {
                                ?>         
                                            <option value="<?php echo $value1['id']; ?>"><?php echo $value1['campaign_name']; ?></option>
                                <?php } ?>            
                                          
                         </select>
						 
						 <script>
						 
						 $("#exampleRadios1").each(function(){
if($("#exampleRadios1").is(":checked"))
	{
		$('#exampleRadios1').addClass('my-radio');
		$('#exampleRadios2').removeClass('my-radio');
		$("#ext_camp").hide();
	}
})

$("#exampleRadios1").click(function(){
if($("#exampleRadios1").is(":checked"))
	{
	$('#exampleRadios1').addClass('my-radio');
	$('#exampleRadios2').removeClass('my-radio');
	$("#ext_camp").hide();
	}


});

$("#exampleRadios2").click(function(){
	if($("#exampleRadios2").is(":checked"))
	{
	$('#exampleRadios2').addClass('my-radio');
	$('#exampleRadios1').removeClass('my-radio');
	$("#ext_camp").show();
	}

});

</script>
						 
						