Aside part: 
 <li><a href="#"><i class="fas fa-outdent"></i></i><span><?php echo ucwords($Lan['Outgoing']); ?></span></a>
                        <ul class="sub-menu outgoing_cls">
                    
        
                            <li >
                                <a href="#script" class="active">
                                <i class="fas fa-scroll"></i><?php echo ucwords($Lan['Script']); ?></a>
                            </li>
                              <li >
                                <a href="#keywords" class="">
                                    <i class="fas fa-robot"></i><?php echo ucwords($Lan['Keywords']); ?></a>
                            </li>

                              <li>
                                <a href="#links" class="">
                                 <i class="fas fa-link"></i> <?php echo ucwords($Lan['Links']); ?>
                                </a>
                            </li>
                            <li><a href="#pictures" class="">
                                <i class="fas fa-images"></i> <?php echo ucwords($Lan['Pictures']); ?></a>
                            </li>
                             <li >
                                <a  href="#alive" class="">
                                <i class="fas fa-user-md"></i><?php echo ucwords($Lan['Keep-Alive']); ?></a>
                            </li>
                              <li >
                                <a href="#signature" class="">
                                <i class="fas fa-pen-fancy"></i><?php echo ucwords($Lan['Sms-Signature']); ?></a>
                            </li>

                         </ul>
             </li>

              <li><a href="#"><i class="fas fa-outdent"></i></i><span><?php echo ucwords($Lan['Incoming']); ?></span></a>

                        <ul class="sub-menu incoming_cls">
                    
                            <li >
                                <a href="#voicemail" class="">
                                <i class="fas fa-phone"></i><?php echo ucwords($Lan['Calls']); ?></a>
                            </li>
                              <li >
                                <a href="#pic_responce" class=''>
                                    <i class="fas fa-camera"></i><?php echo ucwords($Lan['Pictures']); ?></a>
                            </li>

                         </ul>
             </li>

             <li><a href="#">
             <i class="fas fa-cogs"></i></i><span><?php echo ucwords($Lan['Settings']); ?></span></a>

                        <ul class="sub-menu setting_cls">
                    
                            <li>
                                <a href="#general" class="">
                                <i class="fas fa-puzzle-piece"></i><?php echo ucwords($Lan['General']); ?></a>
                            </li>
                             <li>
                                <a href="#remove-number" class="">
                                <i class="fa fa-eraser"></i><?php echo ucwords($Lan['Numbers_Remove']); ?></a>
                            </li>
                              <!-- <li <?php  if($url==''){echo 'class="active"';} ?>>
                                <a href="chatbox.php">
                                    <i class="fas fa-headset"></i><?php echo ucwords($Lan['Menual-Mode']); ?></a>
                            </li>
                             <li <?php  if($url==''){echo 'class="active"';} ?>>
                                <a href="chatbox.php">
                                    <i class="fas fa-wrench"></i><?php echo ucwords($Lan['Advanced']); ?></a>
                            </li> -->

                         </ul>
             </li>

              
############################## Content part ex ###############################

  <div class="row wizard-row">
            
            <!-- Script............................................................................................ -->
            <div id="script" class="tab-pane hide active ">
                <div class="col-md-8"></div>

                <div class="col-md-4 text-right ">

                    <button id="script_save" type="submit" class="save-btn"><i class="fas fa-save mr-2"></i> Save</button>

                     <button id="script_loading" type="submit" class="save-btn"  style="display: none;">
                                   
                    <img src="views/besma/assets/images/gif/submit_loding.gif" style="width: 23px;margin-right: 3px;">
                        Save
                    </button>

                </div>

                <div class="col-sm-12 col-md-12">

                    <div class="block-flat">    
           <!-- NOTIFICATION MESSAGE............................... -->
                        <div  id='script_emp_noti' class="alert alert-danger" role="alert" style="display: none ;">
                                <p class="display-3">Field can't empty !!</p>
                        </div>

                         <div id='script_succ_noti' class="alert alert-success" role="alert" style="display: none ;" >
                            <p class='display-3'>Script update successfully.</p>
                        </div>
             
                        
                        <div class="header mb-2">

                            <h3><?php echo $Lan['Script']; ?></h3>
                        </div>
                        <!-- Default notification................................................ -->

                         <div id="script_noti"></div>


                        <div class="alert alert-bag py-2 px-3 mt-2" role="alert" style="margin-top: 11px;" id='noti_empty'>
                            <p class="display-2">
                                One reply per line. Follows this line by line whenever user talks to system.
                            </p>
                             <p class="display-3 ml-2" style="margin-left: 8px;">
                                <strong>FORMAT: </strong> One line for one script. You can use {} one line for make options. Such as: <strong>[Hey|Hello|Hi baby]</strong>you texted me!
                            </p>
                        </div>

                        <div class="content">
                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="" method="post" id="script_form">


                                
                                <!-- get number................................. -->
                                <div class="form-group">
                                    
                                    <div class="col-sm-12">
                                        
                                        <!-- ACE-EDITOR............. -->
                                       <!-- <pre id="campaign_script"  name="sms_temp"></pre> -->
                                    <input type="hidden" name="script_name" class='camp_id' value="<?php echo $camp_id; ?>">
                        <input type="hidden" name="script_name" class='cid' value="<?php echo $cid; ?>">
                        <?php 

                        $query1 = "SELECT * FROM sms_script WHERE campaign_id = :campaign_id AND accounts_id = :accounts_id ";
                        $selectstmt = $dbh->prepare($query1);
                        $selectstmt->bindValue(':campaign_id',$camp_id);
                        $selectstmt->bindValue(':accounts_id',$cid);
                        $selectstmt->execute();

                        // $script_fetch = $selectstmt->fetch();
                        $script_count = $selectstmt->rowCount();
                           if($script_count > 0)
                                {
                                                  
                        ?>      
                   <textarea id="script_textarea"><?php  while ($value = $selectstmt->fetch(PDO::FETCH_ASSOC)) {echo $value['script_name']."\n";}?> </textarea>
                                   <?php }else{?>
                                   <textarea id="script_textarea"> </textarea>
                               <?php } ?>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Keywords.......................................................................................................................................................................... -->
        
            <div id="keywords" class="tab-pane ">
                <div class="col-md-8"></div>
                <div class="col-md-4 text-right ">





                    <button id="keywords_save" class="save-btn"><i class="fas fa-save mr-2"></i> Save</button>
                     <button id="keywords_loading" type="submit" class="save-btn"  style="display: none;">
                     <img src="views/besma/assets/images/gif/submit_loding.gif" style="width: 23px;margin-right: 3px;">
                        Save
                    </button>




                </div>
                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div id="show_result1"></div>





                        <!-- NOTIFICATION MESSAGE............................... -->
              
                        <div  id='keywords_emp_noti' class="alert alert-danger" role="alert" style="display: none ;">
                                <p class="display-3">Field can't empty !!</p>
                        </div>

                         <div id='keywords_succ_noti' class="alert alert-success" role="alert" style="display: none ;" >
                            <p class='display-3'>Keywords update successfully.</p>
                        </div>






                        <div class="header mb-2">
                            <h3><?php echo $Lan['Keywords']; ?></h3>
                        </div>
                        <div class="alert alert-bag py-2 px-3 mt-2" role="alert" style="margin-top: 11px;" id='noti_empty'>
                            <p class="display-2">
                                Keywords make conversations seem more realistic by responding in a way the script normally would not.
                                ex: talk later|Sure, I'll be here|Yup, message me anytime!
                            </p>
                            <p class="display-2" style="margin-left: 4px;margin-top: 0 !important;">
                                <strong> FORMAT: </strong>KEYWORD|RESPONSE-1|RESPONSE-2 <br> Example:
                                send me another pic|%p4 [Lol|Well lol] Maybe you can just see 
                            </p>
                        </div>
                        <div class="content">
                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="" method="post" id="script_form">
                                
                                <!-- get number................................. -->
                                <div class="form-group">
                                    
                                    <div class="col-sm-12">
                                        
                                        <!-- ACE-EDITOR............. -->
                                       <!-- <pre id="campaign_script"  name="sms_temp"></pre> -->

                     <input type="hidden" name="" class='cid' value="<?php echo $cid; ?>">
                     <input type="hidden" name="keyword_name" class='camp_id' value="<?php echo $camp_id; ?>">
                        <?php 
                            $query1 = "SELECT * FROM sms_keywords WHERE campaign_id = :campaign_id AND accounts_id = :accounts_id ";
                        $kstmt = $dbh->prepare($query1);
                        $kstmt->bindValue(':campaign_id',$camp_id);
                        $kstmt->bindValue(':accounts_id',$cid);
                        $kstmt->execute();

                        // $script_fetch = $selectstmt->fetch();
                        $key_count = $kstmt->rowCount();
                           if($key_count > 0)
                                {
                                                  
                        ?>      
                   <textarea id="campaign_keywords"><?php  while ($value = $kstmt->fetch()) {echo $value['key_keyword']."|".$value['key_response'];}?> </textarea>
                                   <?php }else{?>
                                   <textarea id="campaign_keywords"></textarea>
                               <?php } ?>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
			
			
			############################## Scripot part ###############################
			
			$(document).ready(function(){
	// make aside active and change tab-pans............................
	//  after page load hide is active in that #id.......................
	$('.wizard-row #keywords').addClass('hide');
	$('.wizard-row #links').addClass('hide');
	$('.wizard-row #pictures').addClass('hide');
	$('.wizard-row #alive').addClass('hide');
	$('.wizard-row #signature').addClass('hide');
	$('.wizard-row #voicemail').addClass('hide');
	$('.wizard-row #pic_responce').addClass('hide');
	$('.wizard-row #general').addClass('hide');
	$('.wizard-row #remove-number').addClass('hide');

$('.outgoing_cls li a').click(function(){
	$('.outgoing_cls').find('.active').removeClass('active');
	$('.incoming_cls').find('.active').removeClass('active');
	$('.setting_cls').find('.active').removeClass('active');

	$(this).addClass('active');

	// get href attribute value for show content with attribute...
	var $attr = $(this).attr('href');

	// alert($attr);

	//remove content all active class
	$('.wizard-row').find('.active').removeClass('active');
	$($attr).addClass('active');
});

$(".incoming_cls li a").click(function(){
	$('.outgoing_cls').find('.active').removeClass('active');
	$('.incoming_cls').find('.active').removeClass('active');
	$('.setting_cls').find('.active').removeClass('active');
	$(this).addClass('active');

	var $attr = $(this).attr('href');

	$('.wizard-row').find('.active').removeClass('active');
	$($attr).addClass('active');

});

$(".setting_cls li a").click(function(){
	$('.outgoing_cls').find('.active').removeClass('active');
	$('.incoming_cls').find('.active').removeClass('active');
	$('.setting_cls').find('.active').removeClass('active');
	$(this).addClass('active');

	var $attr = $(this).attr('href');

	$('.wizard-row').find('.active').removeClass('active');
	$($attr).addClass('active');

});













});
