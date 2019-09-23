               <div id="pictures" class="tab-pane">
                <div class="col-md-12">
   <!-- Notification........................................................  -->         <div class="error_notifi" name=""></div>        
                       <div id='img_error_noti' class="alert alert-danger" role="alert" style="display: none  ;" >
                            <h3 class='display-3'><strong>Whoops!</strong> There were some problems with your input.</h3>
                           <ul class="outgoing_img_invalid">
                               <li>
                                   <p>Error uploading pic7: Invalid mimetype</p>
                               </li>
                               <li>
                                   <p>We will be allow <strong>"jpg",'jpeg','png','gif'</strong> Formate</p>
                               </li>
                           </ul>
                        </div>
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-4 text-right ">


                    <button id="img_save" class="save-btn"><i class="fas fa-save mr-2"></i> Save</button>
                     <button id="img_loading" type="submit" class="save-btn"  style="display: none;">
                     <img src="views/besma/assets/images/gif/submit_loding.gif" style="width: 23px;margin-right: 3px;">
                        Save
                    </button>

                </div>
                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div id="show_result1"></div>


                        <div class="header mb-2">
                            <h3><?php echo $Lan['outgoing_pictures']; ?> </h3>
                        </div>
                        <div class="alert alert-bag py-2 px-3 mt-2" role="alert" style="margin-top: 11px;" id='noti_empty'>
                            <p class="display-2">
                               Add up to 10 images and send them as MMS anytime by using the %p token 
                            </p>
                            <p class="display-2" style="margin-left: 4px;margin-top: 0 !important;">
                                <strong>anywhere</strong>  in your messages (script/keywords/keep-alives/etc..) 
                            </p>
                        </div>
                        <div class="content">
                           <!--  <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="" method="post" id="script_form"> -->
                                
                                <!-- get number................................. -->
                                <div class="form-group row mt-5 ">
                                    
        <div class="col-sm-6">

            <div class="media-div">
                <div class="media">
                    
                   <div class="media-img align-self-center">
    <?php 
        $queryP1 = "SELECT * FROM sms_outgoing_img WHERE campaign_id = :campaign_id AND pic_title = :pic_title";
        $p1Stmt = $dbh->prepare($queryP1);
        $p1Stmt->execute(array(":campaign_id"=>$camp_id,":pic_title"=>'%p1'));

        if($p1Stmt->rowCount() == '1')
        {
            $p1Fetch = $p1Stmt->fetch();
            $p1PicLoc = substr($p1Fetch['pic_loc'],3);
    ?>
            <img src="<?php echo $p1PicLoc; ?>" class="rounded">
 <?php       
    }else{
 ?>
        <div class="ns">
           <h3 class="align-self-center">NOT SET</h3>
       </div>
 <?php       
    }
 ?>            
                   </div>


                    <div class="media-body">
                        <h3 class="">%p1</h3>
                                
                        <div class="input-group mb-3">

                              <div class="custom-file" class="__BVID__24__BV_file_outer_">
<!-- // hidden cmap_id...................................................... -->
  <input type="hidden" name="outgoing_pic" class='camp_id' value="<?php echo $camp_id; ?>">

                                <input type="file" class="custom-file-input" id="p1"   aria-describedby="inputGroupFileAddon03" name="filesP1[]" accept="image/*">


                                <label class="custom-file-label" for="p1">Choose file........</label>
                              </div>
                              <span class="btn btn-primary browse-btn" style="">Browse</span>
                        </div>

                     

                    </div>
                </div>
                

            </div>

        </div>

        <div class="col-sm-6">

            <div class="media-div">
                <div class="media">
                    
                   <div class="media-img align-self-center">
 <?php 
        $queryP2 = "SELECT * FROM sms_outgoing_img WHERE campaign_id = :campaign_id AND pic_title = :pic_title";
        $p2Stmt = $dbh->prepare($queryP2);
        $p2Stmt->execute(array(":campaign_id"=>$camp_id,":pic_title"=>'%p2'));

        if($p2Stmt->rowCount() == '1')
        {
            $p2Fetch = $p2Stmt->fetch();
            $p2PicLoc = substr($p2Fetch['pic_loc'],3);
    ?>
            <img src="<?php echo $p2PicLoc; ?>" class="rounded">
 <?php       
    }else{
 ?>
        <div class="ns">
           <h3 class="align-self-center">NOT SET</h3>
       </div>
 <?php       
    }
 ?>   


                   </div>
                    <div class="media-body">
                        <h3 class="">%p2</h3>
                                
                        <div class="input-group mb-3">

                              <div class="custom-file" class="__BVID__25__BV_file_outer_">

                                <input type="file" class="custom-file-input" id="p2" aria-describedby="inputGroupFileAddon03" name="filesP2[]" accept="image/*">

                                <label class="custom-file-label" for="p2">Choose file........ </label>
                              </div>
                              <span class="btn btn-primary browse-btn" >Browse</span>
                        </div>

                    </div>
                </div>
                

            </div>

        </div>


            </div>


             <div class="form-group row mt-5 ">
                                    
        <div class="col-sm-6">

            <div class="media-div">
                <div class="media">
                    
                   <div class="media-img align-self-center">
           

 <?php 
        $queryP3 = "SELECT * FROM sms_outgoing_img WHERE campaign_id = :campaign_id AND pic_title = :pic_title";
        $p3Stmt = $dbh->prepare($queryP3);
        $p3Stmt->execute(array(":campaign_id"=>$camp_id,":pic_title"=>'%p3'));

        if($p3Stmt->rowCount() == '1')
        {
            $p3Fetch = $p3Stmt->fetch();
            $p3PicLoc = substr($p3Fetch['pic_loc'],3);
    ?>
            <img src="<?php echo $p3PicLoc; ?>" class="rounded">
 <?php       
    }else{
 ?>
        <div class="ns">
           <h3 class="align-self-center">NOT SET</h3>
       </div>
 <?php       
    }
 ?>   


                   </div>
                    <div class="media-body">
                        <h3 class="">%p3</h3>
                                
                        <div class="input-group mb-3">

                              <div class="custom-file" class="__BVID__26__BV_file_outer_">

                                <input type="file" class="custom-file-input" id="p3" aria-describedby="inputGroupFileAddon03" name="filesP3[]"  accept="image/*">

                                <label class="custom-file-label" for="p3">Choose file........</label>
                              </div>
                              <span class="btn btn-primary browse-btn" >Browse</span>
                        </div>

                     

                    </div>
                </div>
                

            </div>

        </div>

        <div class="col-sm-6">

            <div class="media-div">
                <div class="media">
                    
                   <div class="media-img align-self-center">

<?php 
        $queryP4 = "SELECT * FROM sms_outgoing_img WHERE campaign_id = :campaign_id AND pic_title = :pic_title";
        $p4Stmt = $dbh->prepare($queryP4);
        $p4Stmt->execute(array(":campaign_id"=>$camp_id,":pic_title"=>'%p4'));

        if($p4Stmt->rowCount() == '1')
        {
            $p4Fetch = $p4Stmt->fetch();
            $p4PicLoc = substr($p4Fetch['pic_loc'],3);
    ?>
            <img src="<?php echo $p4PicLoc; ?>" class="rounded">
 <?php       
    }else{
 ?>
        <div class="ns">
           <h3 class="align-self-center">NOT SET</h3>
       </div>
 <?php       
    }
 ?>  


                   </div>
                    <div class="media-body">
                        <h3 class="">%p4</h3>
                                
                        <div class="input-group mb-3">

                              <div class="custom-file" class="__BVID__27__BV_file_outer_">

                                <input type="file" class="custom-file-input" id="p4" aria-describedby="inputGroupFileAddon03" name="filesP4[]" accept="image/*">

                                <label class="custom-file-label" for="p4">Choose file........</label>
                              </div>
                              <span class="btn btn-primary browse-btn">Browse</span>
                        </div>

                    </div>
                </div>
                

            </div>

        </div>


                                </div>


                                             <div class="form-group row mt-5 ">
                                    
        <div class="col-sm-6">

            <div class="media-div">
                <div class="media">
                    
                   <div class="media-img align-self-center">
                       
<?php 
        $queryP5 = "SELECT * FROM sms_outgoing_img WHERE campaign_id = :campaign_id AND pic_title = :pic_title";
        $p5Stmt = $dbh->prepare($queryP5);
        $p5Stmt->execute(array(":campaign_id"=>$camp_id,":pic_title"=>'%p5'));

        if($p5Stmt->rowCount() == '1')
        {
            $p5Fetch = $p5Stmt->fetch();
            $p5PicLoc = substr($p5Fetch['pic_loc'],3);
    ?>
            <img src="<?php echo $p5PicLoc; ?>" class="rounded">
     <?php       
        }else{
     ?>
        <div class="ns">
           <h3 class="align-self-center">NOT SET</h3>
       </div>
 <?php       
    }
 ?>  

                   </div>
                    <div class="media-body">
                        <h3 class="">%p5</h3>
                                
                        <div class="input-group mb-3">

                              <div class="custom-file" class="__BVID__28__BV_file_outer_">

                                <input type="file" class="custom-file-input" id="p5" aria-describedby="inputGroupFileAddon03" name="filesP5[]" accept="image/*">

                                <label class="custom-file-label" for="p5">Choose file........</label>
                              </div>
                              <span class="btn btn-primary browse-btn">Browse</span>
                        </div>

                     

                    </div>
                </div>
                

            </div>

        </div>

        <div class="col-sm-6">

            <div class="media-div">
                <div class="media">
                    
                   <div class="media-img align-self-center">
                       
<?php 
        $queryP6 = "SELECT * FROM sms_outgoing_img WHERE campaign_id = :campaign_id AND pic_title = :pic_title";
        $p6Stmt = $dbh->prepare($queryP6);
        $p6Stmt->execute(array(":campaign_id"=>$camp_id,":pic_title"=>'%p6'));

        if($p6Stmt->rowCount() == '1')
        {
            $p6Fetch = $p6Stmt->fetch();
            $p6PicLoc = substr($p6Fetch['pic_loc'],3);
    ?>
            <img src="<?php echo $p6PicLoc; ?>" class="rounded">
     <?php       
        }else{
     ?>
        <div class="ns">
           <h3 class="align-self-center">NOT SET</h3>
       </div>
 <?php       
    }
 ?>  
                   </div>
                    <div class="media-body">
                        <h3 class="">%p6</h3>
                                
                        <div class="input-group mb-3">

                              <div class="custom-file" class="__BVID__29__BV_file_outer_">

                                <input type="file" class="custom-file-input" id="p6" aria-describedby="inputGroupFileAddon03" name="filesP6[]" accept="image/*">

                                <label class="custom-file-label" for="p6">Choose file........</label>
                              </div>
                              <span class="btn btn-primary browse-btn">Browse</span>
                        </div>

                    </div>
                </div>
                

            </div>

        </div>


                                </div>

                                             <div class="form-group row mt-5 ">
                                    
        <div class="col-sm-6">

            <div class="media-div">
                <div class="media">
                    
                   <div class="media-img align-self-center">
    
<?php 
        $queryP7 = "SELECT * FROM sms_outgoing_img WHERE campaign_id = :campaign_id AND pic_title = :pic_title";
        $p7Stmt = $dbh->prepare($queryP7);
        $p7Stmt->execute(array(":campaign_id"=>$camp_id,":pic_title"=>'%p7'));

        if($p7Stmt->rowCount() == '1')
        {
            $p7Fetch = $p7Stmt->fetch();
            $p7PicLoc = substr($p7Fetch['pic_loc'],3);
    ?>
            <img src="<?php echo $p7PicLoc; ?>" class="rounded">
     <?php       
        }else{
     ?>
        <div class="ns">
           <h3 class="align-self-center">NOT SET</h3>
       </div>
 <?php       
    }
 ?>  
       



                   </div>
                    <div class="media-body">
                        <h3 class="">%p7</h3>
                                
                        <div class="input-group mb-3">

                              <div class="custom-file" class="__BVID__30__BV_file_outer_">

                                <input type="file" class="custom-file-input" id="p7" aria-describedby="inputGroupFileAddon03" name="filesP7[]" accept="image/*">

                                <label class="custom-file-label" for="p7">Choose file........</label>
                              </div>
                              <span class="btn btn-primary browse-btn" >Browse</span>
                        </div>

                     

                    </div>
                </div>
                

            </div>

        </div>

        <div class="col-sm-6">

            <div class="media-div">
                <div class="media">
                    
                   <div class="media-img align-self-center">

<?php 
        $queryP8 = "SELECT * FROM sms_outgoing_img WHERE campaign_id = :campaign_id AND pic_title = :pic_title";
        $p8Stmt = $dbh->prepare($queryP8);
        $p8Stmt->execute(array(":campaign_id"=>$camp_id,":pic_title"=>'%p8'));

        if($p8Stmt->rowCount() == '1')
        {
            $p8Fetch = $p8Stmt->fetch();
            $p8PicLoc = substr($p8Fetch['pic_loc'],3);
    ?>
            <img src="<?php echo $p8PicLoc; ?>" class="rounded">
     <?php       
        }else{
     ?>
        <div class="ns">
           <h3 class="align-self-center">NOT SET</h3>
       </div>
 <?php       
    }
 ?>  
       

                   </div>
                    <div class="media-body">
                        <h3 class="">%p8</h3>
                                
                        <div class="input-group mb-3">

                              <div class="custom-file" class="__BVID__31__BV_file_outer_">

                                <input type="file" class="custom-file-input" id="p8" aria-describedby="inputGroupFileAddon03"  name="filesP8[]" accept="image/*">

                                <label class="custom-file-label" for="p8">Choose file........</label>
                              </div>
                              <span class="btn btn-primary browse-btn">Browse</span>
                        </div>

                    </div>
                </div>
                

            </div>

        </div>


                                </div>

                                             <div class="form-group row mt-5 ">
                                    
        <div class="col-sm-6">

            <div class="media-div">
                <div class="media">
                    
                   <div class="media-img align-self-center">
<?php 
        $queryP9 = "SELECT * FROM sms_outgoing_img WHERE campaign_id = :campaign_id AND pic_title = :pic_title";
        $p9Stmt = $dbh->prepare($queryP9);
        $p9Stmt->execute(array(":campaign_id"=>$camp_id,":pic_title"=>'%p9'));

        if($p9Stmt->rowCount() == '1')
        {
            $p9Fetch = $p9Stmt->fetch();
            $p9PicLoc = substr($p9Fetch['pic_loc'],3);
    ?>
            <img src="<?php echo $p9PicLoc; ?>" class="rounded">
     <?php       
        }else{
     ?>
        <div class="ns">
           <h3 class="align-self-center">NOT SET</h3>
       </div>
 <?php       
    }
 ?>  



                   </div>
                    <div class="media-body">
                        <h3 class="">%p9</h3>
                                
                        <div class="input-group mb-3">

                              <div class="custom-file" class="__BVID__32__BV_file_outer_">

                                <input type="file" class="custom-file-input" id="p9" aria-describedby="inputGroupFileAddon03" name="filesP9[]" accept="image/*">

                                <label class="custom-file-label" for="p9">Choose file........</label>
                              </div>
                              <span class="btn btn-primary browse-btn" >Browse</span>
                        </div>

                     

                    </div>
                </div>
                

            </div>

        </div>

        <div class="col-sm-6">

            <div class="media-div">
                <div class="media">
                    
                   <div class="media-img align-self-center">
                       
<?php 
        $queryP10 = "SELECT * FROM sms_outgoing_img WHERE campaign_id = :campaign_id AND pic_title = :pic_title";
        $p10Stmt = $dbh->prepare($queryP10);
        $p10Stmt->execute(array(":campaign_id"=>$camp_id,":pic_title"=>'%p10'));

        if($p10Stmt->rowCount() == '1')
        {
            $p10Fetch = $p10Stmt->fetch();
            $p10PicLoc = substr($p10Fetch['pic_loc'],3);
    ?>
            <img src="<?php echo $p10PicLoc; ?>" class="rounded">
     <?php       
        }else{
     ?>
        <div class="ns">
           <h3 class="align-self-center">NOT SET</h3>
       </div>
 <?php       
    }
 ?>  




                   </div>
                    <div class="media-body">
                        <h3 class="">%p10</h3>
                                
                        <div class="input-group mb-3">

                              <div class="custom-file" class="__BVID__33__BV_file_outer_">

                                <input type="file" class="custom-file-input" id="p10" aria-describedby="inputGroupFileAddon03" name="filesP10[]" accept="image/*">

                                <label class="custom-file-label" for="p10">Choose file........</label>
                              </div>
                              <sapn class="btn btn-primary browse-btn">Browse</sapn>
                        </div>

                    </div>
                </div>
                

            </div>

        </div>


                                </div>



                        </div>
                    </div>
                </div>
            </div>

