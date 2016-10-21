
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>Annual Felicitation Program </h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="#">Home</a></li>
									<li><a href="#">gallery</a></li>
								</ul>
							</div>
                        </div>
                        <!--KF INR BANNER DES Wrap End-->
                    </div>
                </div>
            </div>
        </div>

        <!--Banner Wrap End-->

    	<!--Content Wrap Start-->
    	<div class="kf_content_wrap">	
    		<div class="gallery-masonery_page gallery inner-content-holder">
    			<div class="container">
	    			<div class="row">
	    				<ul id="filterable-item-filter-1">
                        <?php foreach($al as $al){?>
							<li><a data-value="img<?php echo $al->id;?>"><?php echo $al->album_name;?></a></li>
							<?php }?>
						</ul>

	    				<div id="filterable-item-holder-1">
                        
                        	<?php $ims=$this->db->get("album_images")->result();
							foreach($ims as $album){?>
							<div class="filterable-item img<?php echo $album->alb_id;?> col-md-3 col-sm-4 col-xs-12">
								<div class="edu_masonery_thumb">
									<img src="<?php echo base_url();?>album/<?php echo $album->image;?>" alt=""/>
									<div class="caption"><a href="#">Partha Education</a></div>
									<a href="<?php echo base_url();?>album/<?php echo $album->image;?>" data-rel="prettyPhoto[gallery2]" class="zoom"><i class="fa fa-search"></i></a>
								</div>	
							</div>
                            <?php }?>
							
							
						</div>
					</div>
    			
    		</div>
    			
    	</div>
     