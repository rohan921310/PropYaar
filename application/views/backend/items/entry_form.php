<?php
   $attributes = array('id' => 'item-form', 'enctype' => 'multipart/form-data');
   echo form_open('', $attributes);
   ?>
<section class="content animated fadeInRight">
   <div class="card card-info">
      <div class="card-header">
         <h3 class="card-title">
            <?php echo get_msg('prd_info') ?>
         </h3>
      </div>
      <form role="form">
         <div class="card-body">
            <div class="row">
               <div class="col-md-6">
                  <!--Item Name -->
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('itm_title_label') ?>
                     </label>
                     <?php echo form_input(array(
                        'name' => 'title',
                        'value' => set_value('title', show_data(@$item->title), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('itm_title_label'),
                        'id' => 'title'
                        )); ?>
                  </div>
                  <!--Product Category-->
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('Prd_search_cat') ?>
                     </label>
                     <?php
                        $options = array();
                        $conds['status'] = 1;
                        $options[0] = get_msg('Prd_search_cat');
                        $categories = $this->Category->get_all_by($conds);
                        foreach ($categories->result() as $cat) {
                          $options[$cat->cat_id] = $cat->cat_name;
                        }
                        echo form_dropdown(
                          'cat_id',
                          $options,
                          set_value('cat_id', show_data(@$item->cat_id), false),
                          'class="form-control form-control-sm mr-3" id="cat_id"'
                        );
                        ?>
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           <?php echo get_msg('Price(Start)') ?>
                           </label>
                           <?php echo form_input(array(
                              'name' => 'price',
                              'value' => set_value('price', show_data(@$item->price), false),
                              'class' => 'form-control form-control-sm',
                              'placeholder' => get_msg('Price(Start)'),
                              'id' => 'price'
                              
                              )); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           <?php echo get_msg('Price(To End)') ?>
                           </label>
                           <?php echo form_input(array(
                              'name' => 'price_end',
                              'value' => set_value('price_end', show_data(@$item->price_end), false),
                              'class' => 'form-control form-control-sm',
                              'placeholder' => get_msg('Price(To End)'),
                              'id' => 'price_end'
                              
                              )); ?>
                        </div>
                     </div>
                  </div>

                  <!--Property Id-->
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('Property Id') ?>
                     </label>
                     <?php echo form_input(array(
                        'name' => 'property_id',
                        'value' => set_value('property_id', show_data(@$item->property_id), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('Property Id'),
                        'id' => 'property_id'
                        )); ?>
                  </div>
                  <!--Listed By-->
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     Listed By
                     </label>
                     <select name="listed_by" class="form-control">
                        <?php if (empty($item->listed_by)) { ?>
                        <option value="">Select Listed by</option>
                        <?php } ?>
                        <option value="Owner" 
                           <?php if ($item->listed_by == "Owner") {
                              echo "selected";
                              } ?>>Owner
                        </option>
                        <option value="Dealer" 
                           <?php if ($item->listed_by == "Dealer") {
                              echo "selected";
                              } ?>>Dealer
                        </option>
                        <option value="Builder" 
                           <?php if ($item->listed_by == "Builder") {
                              echo "selected";
                              } ?>>Builder
                        </option>
                     </select>
                  </div>

                  <!--Furnishing-->
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('Furnishing') ?>
                     </label>
                     <?php
                        $options = array();
                        $conds['status'] = 1;
                        $options[0] = get_msg('Select Furnishing');
                        $furnishing = $this->Furnished->get_all_by($conds);
                        foreach ($furnishing->result() as $furnished) {
                          $options[$furnished->furnishing_id] = $furnished->name;
                        }
                        echo form_dropdown(
                          'furnishing_id',
                          $options,
                          set_value('furnishing_id', show_data(@$item->furnishing_id), false),
                          'class="form-control form-control-sm mr-3" id="furnishing_id"'
                        );
                        ?>
                  </div>

                  <!--Property Condition-->
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('itm_select_condition_of_item') ?>
                     </label>
                     <?php
                        $options = array();
                        $conds['status'] = 1;
                        $options[0] = get_msg('condition_of_item');
                        $conditions = $this->Condition->get_all_by($conds);
                        foreach ($conditions->result() as $cond) {
                          $options[$cond->id] = $cond->name;
                        }
                        
                        echo form_dropdown(
                          'condition_of_item_id',
                          $options,
                          set_value('condition_of_item_id', show_data(@$item->condition_of_item_id), false),
                          'class="form-control form-control-sm mr-3" id="condition_of_item_id"'
                        );
                        ?>
                  </div>
                  <!--Property Location-->
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('itm_select_location') ?>
                     </label>
                     <?php
                        $options = array();
                        $options[0] = get_msg('itm_select_location');
                        $locations = $this->Itemlocation->get_all();
                        foreach ($locations->result() as $location) {
                          $options[$location->id] = $location->name;
                        }
                        echo form_dropdown(
                          'item_location_id',
                          $options,
                          set_value('item_location_id', show_data(@$item->item_location_id), false),
                          'class="form-control form-control-sm mr-3" id="item_location_id"'
                        );
                        ?>
                  </div>

                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('Location Short') ?>
                     </label>
                     <?php echo form_input(array(
                        'name' => 'location_short',
                        'value' => set_value('location_short', show_data(@$item->location_short), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('Location Short'),
                        'id' => 'location_short'
                        )); ?>
                  </div>


                  <legend>
                     <?php echo get_msg('location_info_label'); ?>
                  </legend>
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('itm_address_label') ?>
                     </label>
                     <?php echo form_textarea(array(
                        'name' => 'address',
                        'value' => set_value('address', show_data(@$item->address), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('itm_address_label'),
                        'id' => 'address',
                        'rows' => "5"
                        )); ?>
                  </div>

                  <!-- <div class="form-group"><label><span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('itm_select_deal_option') ?></label>
                     <?php
                        $options = array();
                        $conds['status'] = 1;
                        $options[0] = get_msg('deal_option_id_label');
                        $deals = $this->Option->get_all_by($conds);
                        foreach ($deals->result() as $deal) {
                          $options[$deal->id] = $deal->name;
                        }
                        
                        echo form_dropdown(
                          'deal_option_id',
                          $options,
                          set_value('deal_option_id', show_data(@$item->deal_option_id), false),
                          'class="form-control form-control-sm mr-3" id="deal_option_id"'
                        );
                        ?></div> -->
                  <!--Area Type-->
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('item_description_label') ?>
                     </label>
                     <?php echo form_textarea(array(
                        'name' => 'description',
                        'value' => set_value('description', show_data(@$item->description), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('item_description_label'),
                        'id' => 'description',
                        'rows' => "5"
                        )); ?>
                  </div>
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('prd_high_info') ?>
                     </label>
                     <?php echo form_textarea(array(
                        'name' => 'highlight_info',
                        'value' => set_value('info', show_data(@$item->highlight_info), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('ple_highlight_info'),
                        'id' => 'info',
                        'rows' => "5"
                        )); ?>
                  </div>
                  <!-- form group -->


                  <?php// if (@$item->lat != '0' && @$item->lng != '0') : ?>
                  <div class="col-md-12"><div id="itm_location" style="width: 80%; height: 300px;"></div><div class="clearfix">&nbsp;</div><div class="form-group"><label>
                  <?php echo get_msg('itm_lat_label') ?><a href="#" class="tooltip-ps" data-toggle="tooltip" title="
                  <?php echo get_msg('city_lat_label') ?>"><span class='glyphicon glyphicon-info-sign menu-icon'></a></label><br>
                  <?php
                     echo form_input(array(
                       'type' => 'text',
                       'name' => 'lat',
                       'id' => 'lat',
                       'class' => 'form-control',
                       'placeholder' => '',
                       'value' => set_value('lat', show_data(@$item->lat), false),
                     ));
                     ?></div><div class="form-group"><label>
                  <?php echo get_msg('itm_lng_label') ?><a href="#" class="tooltip-ps" data-toggle="tooltip" 
                           title="
                  <?php echo get_msg('city_lng_tooltips') ?>"><span class='glyphicon glyphicon-info-sign menu-icon'></a></label><br>
                  <?php
                     echo form_input(array(
                       'type' => 'text',
                       'name' => 'lng',
                       'id' => 'lng',
                       'class' => 'form-control',
                       'placeholder' => '',
                       'value' =>  set_value('lat', show_data(@$item->lng), false),
                     ));
                     ?></div></div>
                  <?php// endif ?>


                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('Towers') ?>
                     </label>
                     <?php echo form_input(array(
                        'name' => 'towers',
                        'value' => set_value('towers', show_data(@$item->towers), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('Towers'),
                        'id' => 'towers'
                        
                        )); ?>
                  </div>

                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('Project Floors') ?>
                     </label>
                     <?php echo form_input(array(
                        'name' => 'no_project_floors',
                        'value' => set_value('no_project_floors', show_data(@$item->no_project_floors), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('Project Floors'),
                        'id' => 'no_project_floors'
                        
                        )); ?>
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                               Total Project Area
                           </label>
                           <input type="text" name="total_project_area" value="<?php echo $item->total_project_area ?>" class="form-control form-control-sm" placeholder="Total Project Area" id="total_project_area">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                              Total Planned Units
                           </label>
                           <input type="text" name="total_planned_units" value="<?php echo $item->total_planned_units ?>" class="form-control form-control-sm" placeholder="Total Planned Units" id="total_planned_units">
                        </div>
                     </div>
                  </div>


                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('Youtube url link') ?>
                     </label>
                     <?php echo form_input(array(
                        'name' => 'youtube_url_link',
                        'value' => set_value('youtube_url_link', show_data(@$item->youtube_url_link), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('Youtube url link'),
                        'id' => 'youtube_url_link'
                        
                        )); ?>
                  </div>

                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('3D Tour URL') ?>
                     </label>
                     <?php echo form_input(array(
                        'name' => 'url_3dtour',
                        'value' => set_value('url_3dtour', show_data(@$item->url_3dtour), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('3D Tour URL'),
                        'id' => 'url_3dtour'
                        )); ?>
                  </div>


                   <div class="row" style="padding-top: 10px;">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           <?php echo get_msg('Project Name') ?>
                           </label>
                           <?php echo form_input(array(
                              'name' => 'project_name',
                              'value' => set_value('project_name', show_data(@$item->project_name), false),
                              'class' => 'form-control form-control-sm',
                              'placeholder' => get_msg('Project Name'),
                              'id' => 'project_name'
                              
                              )); ?>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           <?php echo get_msg('Available Units') ?>
                           </label>
                           <?php echo form_input(array(
                              'name' => 'no_units_available',
                              'value' => set_value('no_units_available', show_data(@$this->Project->get_one($item->project_id)->no_units_available), false),
                              'class' => 'form-control form-control-sm',
                              'placeholder' => get_msg('Available Units'),
                              'id' => 'no_units_available'
                              
                              )); ?>
                        </div>                     
                     </div>                               
                   </div>

                   <div class="row" style="padding-top: 10px;">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           <?php echo get_msg('Project Website URL') ?>
                           </label>
                           <?php echo form_input(array(
                              'name' => 'project_website_url',
                              'value' => set_value('project_website_url', show_data(@$this->Project->get_one($item->project_id)->project_website_url), false),
                              'class' => 'form-control form-control-sm',
                              'placeholder' => get_msg('Project Website URL'),
                              'id' => 'project_website_url'
                              
                              )); ?>
                        </div>
                     </div>
                     <div class="col-md-6" >
                         <div class="form-group">
                            <label>
                            <span style="font-size: 17px; color: red;">*</span>
                            <?php echo get_msg('project email') ?>
                            </label>
                            <?php echo form_input(array(
                               'name' => 'email_id',
                               'value' => set_value('email_id', show_data(@$this->Project->get_one($item->project_id)->email_id), false),
                               'class' => 'form-control form-control-sm',
                               'placeholder' => get_msg('project email'),
                               'id' => 'email_id'
                               
                               )); ?>
                         </div>                    
                     </div>                               
                   </div>
  


                  <div class="row" style="padding-top: 10px;">

                     <div class="col-md-6" >

                        <?php if ( !isset( $item )): ?>
   
                        <div class="form-group">
                           <span style="font-size: 17px; color: red;">*</span>
                           <label><?php echo get_msg('Project PDF')?>
                              <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                                 <span class='glyphicon glyphicon-info-sign menu-icon'>
                              </a>
                           </label>
                        
                           <br/>
                        
                           <input class="btn btn-sm" type="file" name="project_pdf">
                        </div>
                        
                        <?php else: ?>
                        
                        <?php
                           $project_pdf = $this->Project->get_one($item->project_id);   
                        ?>
                        <?php if($project_pdf->pdf_link_url != ""){ ?>
                        <div class="py-5">
                           <a href="<?php echo $project_pdf->pdf_link_url;?>" target="_blank"><h5 class="text-bold ">Click here to PDF</h5></a>
                           <button type="button" value="<?php echo $project_pdf->pdf_link_url; ?>" data-id="<?php echo $item->project_id;?>" data-type="PDF" class="btn btn-sm text-danger" id="project_delete_btn">
                                  <span id="pdf_action_delete">Delete</span>  
                           </button>
                           
                        </div>
                        <?php }else{ ?>
                           <div class="form-group">
                              <span style="font-size: 17px; color: red;">*</span>
                              <label><?php echo get_msg('Project PDF')?>
                                 <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                                    <span class='glyphicon glyphicon-info-sign menu-icon'>
                                 </a>
                              </label>
                           
                              <br/>
                           
                              <input class="btn btn-sm" type="file" name="project_pdf">
                           </div>
                        <?php } ?>     
                           
                        
                        <?php endif; ?>
                        
                        <!-- End project PDF -->
                     </div>

                     <div class="col-md-6" >

                        <?php if ( !isset( $item )): ?>
      
                           <div class="form-group">
                              <label><?php echo get_msg('Project Icon')?>
                                 <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                                    <span class='glyphicon glyphicon-info-sign menu-icon'>
                                 </a>
                              </label>
                           
                              <br/>
                           
                              <input class="btn btn-sm" type="file" name="project_icon">
                           </div>
                           
                           <?php else: ?>
                           
                             <?php
                                $project_pdf = $this->Project->get_one($item->project_id);
                             ?>
                             <?php if($project_pdf->project_icon != ""){ ?>
                             <div>
                               <img src="<?php echo $project_pdf->project_icon;?>" class="img-thumbnail" alt="project_icon"  width="150">
                               <p>
                                     <span>Project </span> <span id="icon_file">Icon</span>
                                </p>
                                <p>       
                                     <button type="button" value="<?php echo $project_pdf->project_icon; ?>" data-id="<?php echo $item->project_id;?>" data-type="icon" class="btn btn-sm text-danger" id="project_delete_btn">
                                          <span id="icon_delete">Delete</span>  
                                     </button>
                                </p>
                             </div>
                             <?php }else{ ?>
                                 <div class="form-group">
                                     <label><?php echo get_msg('Project Icon')?>
                                        <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                                           <span class='glyphicon glyphicon-info-sign menu-icon'>
                                        </a>
                                     </label>
                                  
                                     <br/>
                                  
                                     <input class="btn btn-sm" type="file" name="project_icon">
                                  </div>
                             <?php } ?>
                           
                           
                        <?php endif; ?>                     

                     </div>
                  </div>


               </div>
               <div class="col-md-6">
                  <!--Select Offer Type-->

                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('itm_select_type') ?>
                     </label>
                     <?php
                        $options = array();
                        $options[0] = get_msg('itm_select_type');
                        $types = $this->Itemtype->get_all();
                        foreach ($types->result() as $typ) {
                          $options[$typ->id] = $typ->name;
                        }
                        echo form_dropdown(
                          'item_type_id',
                          $options,
                          set_value('item_type_id', show_data(@$item->item_type_id), false),
                          'class="form-control form-control-sm mr-3" id="item_type_id"'
                        );
                        ?>
                  </div>
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('Prd_search_subcat') ?>
                     </label>
                     <?php
                        if (isset($item)) {
                          $options = array();
                          $options[0] = get_msg('Prd_search_subcat');
                          $conds['cat_id'] = $item->cat_id;
                          $sub_cat = $this->Subcategory->get_all_by($conds);
                          foreach ($sub_cat->result() as $subcat) {
                            $options[$subcat->id] = $subcat->name;
                          }
                          echo form_dropdown(
                            'sub_cat_id',
                            $options,
                            set_value('sub_cat_id', show_data(@$item->sub_cat_id), false),
                            'class="form-control form-control-sm mr-3" id="sub_cat_id"'
                          );
                        } else {
                          $conds['cat_id'] = $selected_cat_id;
                          $options = array();
                          $options[0] = get_msg('Prd_search_subcat');
                        
                          echo form_dropdown(
                            'sub_cat_id',
                            $options,
                            set_value('sub_cat_id', show_data(@$item->sub_cat_id), false),
                            'class="form-control form-control-sm mr-3" id="sub_cat_id"'
                          );
                        }
                        
                        ?>
                  </div>
                  <!----
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('itm_select_currency') ?>
                     </label>
                     <?php
                        $options = array();
                        $conds['status'] = 1;
                        $options[0] = get_msg('itm_select_currency');
                        $currency = $this->Currency->get_all_by($conds);
                        foreach ($currency->result() as $curr) {
                          $options[$curr->id] = $curr->currency_short_form;
                        }
                        
                        echo form_dropdown(
                          'item_currency_id',
                          $options,
                          set_value('item_currency_id', show_data(@$item->item_currency_id), false),
                          'class="form-control form-control-sm mr-3" id="item_currency_id"'
                        );
                        ?>
                  </div>
                  ----->

                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('itm_select_price') ?>
                     </label>
                     <?php
                        $options = array();
                        $conds['status'] = 1;
                        $options[0] = get_msg('itm_select_price');
                        $pricetypes = $this->Pricetype->get_all_by($conds);
                        foreach ($pricetypes->result() as $price) {
                          $options[$price->id] = $price->name;
                        }
                        
                        echo form_dropdown(
                          'item_price_type_id',
                          $options,
                          set_value('item_price_type_id', show_data(@$item->item_price_type_id), false),
                          'class="form-control form-control-sm mr-3" id="item_price_type_id"'
                        );
                        ?>
                  </div>


                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                             Rent Collection Type
                           </label>
                           <select name="rent_collection_type" class="form-control">
                              <?php if (empty($item->rent_collection_type)) { ?>
                              <option value="">Select Rent Collection Type</option>
                              <?php } ?>
                              <option value="day" 
                                 <?php if ($item->rent_collection_type == "day") {
                                    echo "selected";
                                    } ?>>Day
                              </option>
                              <option value="month" 
                                 <?php if ($item->rent_collection_type == "month") {
                                    echo "selected";
                                    } ?>>Month
                              </option>
                              <option value="year" 
                                 <?php if ($item->rent_collection_type == "year") {
                                    echo "selected";
                                    } ?>>Year
                              </option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                             Bachelors Allowed
                           </label>
                           <select name="bachelors_allowed" class="form-control">
                              <?php if (empty($item->bachelors_allowed)) { ?>
                              <option value="">Select Bachelors Allowed</option>
                              <?php } ?>
                              <option value="yes" 
                                 <?php if ($item->bachelors_allowed == "yes") {
                                    echo "selected";
                                    } ?>>Yes
                              </option>
                              <option value="no" 
                                 <?php if ($item->bachelors_allowed == "no") {
                                    echo "selected";
                                    } ?>>No
                              </option>
                           </select>
                        </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <label>
                        <span style="font-size: 17px; color: red;">*</span>
                        <?php echo get_msg('Maintanance(monthly)') ?>
                     </label>
                     <?php echo form_input(array(
                        'name' => 'maintanance',
                        'value' => set_value('maintanance', show_data(@$item->maintanance), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('Maintanance'),
                        'id' => 'maintanance'
                        
                        )); ?>
                  </div>


                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           Area
                           </label>
                           <input type="text" name="area" value="<?php echo $item->area ?>" class="form-control form-control-sm" placeholder="Area" id="area">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           Area Type
                           </label>
                           <select name="area_type" class="form-control">
                              <?php if (empty($item->area_type)) { ?>
                              <option value="">Select Area Type</option>
                              <?php } ?>
                              <option value="Sq.Ft" 
                                 <?php if ($item->area_type == "Sq.Ft") {
                                    echo "selected";
                                    } ?>>Sq.Ft
                              </option>
                              <option value="Sq.Mt" 
                                 <?php if ($item->area_type == "Sq.Mt") {
                                    echo "selected";
                                    } ?>>Sq.Mt
                              </option>
                              <option value="Sq.Yds" 
                                 <?php if ($item->area_type == "Sq.Yds") {
                                    echo "selected";
                                    } ?>>Sq.Yds
                              </option>
                              <option value="Acres" 
                                 <?php if ($item->area_type == "Acres") {
                                    echo "selected";
                                    } ?>>Acres
                              </option>
                           </select>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                             Length
                           </label>
                           <input type="text" name="length" value="<?php echo $item->length ?>" class="form-control form-control-sm" placeholder="Length" id="length">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                             Breadth
                           </label>
                           <input type="text" name="breadth" value="<?php echo $item->breadth ?>" class="form-control form-control-sm" placeholder="Breadth" id="breadth">
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           <?php echo get_msg('Floor No') ?>
                           </label>
                           <?php echo form_input(array(
                              'name' => 'floor_no',
                              'value' => set_value('brand', show_data(@$item->floor_no), false),
                              'class' => 'form-control form-control-sm',
                              'placeholder' => get_msg('Floor No'),
                              'id' => 'floor_no'
                              
                              )); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           Total Floors
                           </label>
                           <select name="total_floors" class="form-control">
                              <?php if (empty($item->total_floors)) { ?>
                              <option value="">Select Total Floors</option>
                              <?php } ?>
                              <?php
                                 for ($x = 2; $x <= 15; $x++) {  ?>
                              <option value="
                                 <?= $x; ?>" 
                                 <?php if ($item->total_floors == $x) {
                                    echo "selected";
                                    } ?>>
                                 <?= $x; ?>
                              </option>
                              <?php
                                 } ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           Number Of Bed Rooms
                           </label>
                           <select name="numberofbedrooms" class="form-control">
                              <?php if (empty($item->numberofbedrooms)) { ?>
                              <option value="">Select Number Of Bed Rooms</option>
                              <?php } ?>
                              <option value="1" 
                                 <?php if ($item->numberofbedrooms == "1") {
                                    echo "selected";
                                    } ?>>1
                              </option>
                              <option value="2" 
                                 <?php if ($item->numberofbedrooms == "2") {
                                    echo "selected";
                                    } ?>>2
                              </option>
                              <option value="3" 
                                 <?php if ($item->numberofbedrooms == "3") {
                                    echo "selected";
                                    } ?>>3
                              </option>
                              <option value="4" 
                                 <?php if ($item->numberofbedrooms == "4") {
                                    echo "selected";
                                    } ?>>4
                              </option>
                              <option value="5" 
                                 <?php if ($item->numberofbedrooms == "5") {
                                    echo "selected";
                                    } ?>>5
                              </option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           Number Of Bath Rooms
                           </label>
                           <select name="numberofbathrooms" class="form-control">
                              <?php if (empty($item->numberofbathrooms)) { ?>
                              <option value="">Select Number Of Bath Rooms</option>
                              <?php } ?>
                              <option value="1" 
                                 <?php if ($item->numberofbathrooms == "1") {
                                    echo "selected";
                                    } ?>>1
                              </option>
                              <option value="2" 
                                 <?php if ($item->numberofbathrooms == "2") {
                                    echo "selected";
                                    } ?>>2
                              </option>
                              <option value="3" 
                                 <?php if ($item->numberofbathrooms == "3") {
                                    echo "selected";
                                    } ?>>3
                              </option>
                              <option value="4" 
                                 <?php if ($item->numberofbathrooms == "4") {
                                    echo "selected";
                                    } ?>>4
                              </option>
                              <option value="5" 
                                 <?php if ($item->numberofbathrooms == "5") {
                                    echo "selected";
                                    } ?>>5
                              </option>
                           </select>
                        </div>
                     </div>
                  </div>


                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           Facing
                           </label>
                           <select name="facing" class="form-control">
                              <?php if (empty($item->facing)) { ?>
                              <option value="">Select Facing</option>
                              <?php } ?>
                              <option value="east" 
                                 <?php if ($item->facing == "east") {
                                    echo "selected";
                                    } ?>>East
                              </option>
                              <option value="west" 
                                 <?php if ($item->facing == "west") {
                                    echo "selected";
                                    } ?>>West
                              </option>
                              <option value="north" 
                                 <?php if ($item->facing == "north") {
                                    echo "selected";
                                    } ?>>North
                              </option>
                              <option value="south" 
                                 <?php if ($item->facing == "south") {
                                    echo "selected";
                                    } ?>>South
                              </option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           Car Parking
                           </label>
                           <select name="car_parking" class="form-control">
                              <?php if (empty($item->car_parking)) { ?>
                              <option value="">Select Car Parking</option>
                              <?php } ?>
                              <option value="0" 
                                 <?php if ($item->car_parking == "0") {
                                    echo "selected";
                                    } ?>>0
                              </option>
                              <option value="1" 
                                 <?php if ($item->car_parking == "1") {
                                    echo "selected";
                                    } ?>>1
                              </option>
                              <option value="2" 
                                 <?php if ($item->car_parking == "2") {
                                    echo "selected";
                                    } ?>>2
                              </option>
                              <option value="3" 
                                 <?php if ($item->car_parking == "3") {
                                    echo "selected";
                                    } ?>>3
                              </option>
                           </select>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                             Listed By Name
                           </label>
                           <input type="text" name="listed_by_name" value="<?php echo $item->listed_by_name ?>" class="form-control form-control-sm" placeholder="Listed By Name" id="listed_by_name">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                             Listed By Phone
                           </label>
                           <input type="text" name="listed_by_phone" value="<?php echo $item->listed_by_phone ?>" class="form-control form-control-sm" placeholder="Listed By Phone" id="listed_by_phone">
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                              Organisation Name
                           </label>
                           <?php
                              $id= $item->org_id;
                              $org = $this->Organisation_model->get_one( $id );
                           ?>
                           <input type="text" name="org_name" value="<?php echo $org->org_name ?>" class="form-control form-control-sm" placeholder="Organisation Name" id="org_name">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                              Organisation Location
                           </label>
                           <input type="text" name="org_location" value="<?php echo $org->org_location ?>" class="form-control form-control-sm" placeholder="Organisation Location" id="org_location">
                        </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                       Organisation Type
                     </label>
                     <select name="org_type" class="form-control">
                        <?php if (empty($org->org_type)) { ?>
                        <option value="">Select Organisation Type</option>
                        <?php } ?>
                        <option value="agency" 
                           <?php if ($org->org_type == "agency") {
                              echo "selected";
                              } ?>>Agency
                        </option>
                        <option value="builder" 
                           <?php if ($org->org_type== "builder") {
                              echo "selected";
                              } ?>>Builder
                        </option>
                     </select>
                  </div>

                    <div class="form-group">
                        <label>
                        <span style="font-size: 17px; color: red;">*</span>
                          Possession Start Date
                        </label>
                        <input type="text" name="possession_start_date" value="<?php echo $item->possession_start_date ?>" class="form-control form-control-sm" placeholder="Possession Start Date" id="possession_start_date">
                     </div>
                  


                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label><span style="font-size: 17px; color: red;">*</span> Rera Id </label>
                           <input type="text" name="rera_id" value="<?php echo $item->rera_id ?>" class="form-control form-control-sm" placeholder="Rera Id" id="rera_id">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label><span style="font-size: 17px; color: red;">*</span> LP Number </label>
                           <input type="text" name="Lp_number" value="<?php echo $item->Lp_number ?>" class="form-control form-control-sm" placeholder="LP Number" id="Lp_number">
                        </div>
                     </div>
                  </div>  

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label><span style="font-size: 17px; color: red;">*</span> Price per (Sq.Yard) </label>
                           <input type="text" name="price_SqYard" value="<?php echo $item->price_SqYard ?>" class="form-control form-control-sm" placeholder="Price per (Sq.Yard)" id="price_SqYard">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label><span style="font-size: 17px; color: red;">*</span>Plot Type</label>
                           <select name="plot_type" class="form-control">
                              <?php if (empty($item->plot_type)) { ?>
                              <option value="">Select Plot Type</option>
                              <?php } ?>
                              <option value="HMDA" 
                                 <?php if ($item->plot_type == "HMDA") {
                                    echo "selected";
                                    } ?>>HMDA
                              </option>
                              <option value="DTCP" 
                                 <?php if ($item->plot_type == "DTCP") {
                                    echo "selected";
                                    } ?>>DTCP
                              </option>
                              <option value="Open Plot" 
                                 <?php if ($item->plot_type == "Open Plot") {
                                    echo "selected";
                                    } ?>>Open Plot
                              </option>
                              <option value="Farm Land" 
                                 <?php if ($item->plot_type == "Farm Land") {
                                    echo "selected";
                                    } ?>>Farm Land
                              </option>
                           </select>
                        </div>
                     </div>
                  </div>              
                  

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                             Per Growth Rate
                           </label>
                           <input type="text" name="per_growth_rate" value="<?php echo $item->per_growth_rate ?>" class="form-control form-control-sm" placeholder="Per Growth Rate" id="per_growth_rate">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                            Growth Rate Duration
                           </label>
                           <input type="text" name="growth_rate_duration" value="<?php echo $item->growth_rate_duration ?>" class="form-control form-control-sm" placeholder="Growth Rate Duration" id="growth_rate_duration">
                        </div>
                     </div>
                  </div>
                  

                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('Launch Date') ?>
                     </label>
                     <?php echo form_input(array(
                        'name' => 'launch_date',
                        'value' => set_value('launch_date', show_data(@$item->launch_date), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('Launch Date'),
                        'id' => 'launch_date'
                        
                        )); ?>
                  </div>

                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('About Builder') ?>
                     </label>
                     <?php echo form_textarea(array(
                        'name' => 'about_builder',
                        'value' => set_value('about_builder', show_data(@$item->about_builder), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('about_builder'),
                        'id' => 'About Builder',
                        'rows' => "3"
                        )); ?>
                  </div>



                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('Construction Details') ?>
                     </label>
                     <?php echo form_textarea(array(
                        'name' => 'construction_details',
                        'value' => set_value('construction_details', show_data(@$item->construction_details), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('Construction Details'),
                        'id' => 'construction_details',
                        'rows' => "3"
                        )); ?>
                  </div>

                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('About Project') ?>
                     </label>
                     <?php echo form_textarea(array(
                        'name' => 'about_project',
                        'value' => set_value('about_project', show_data(@$this->Project->get_one($item->project_id)->about_project), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('About Project'),
                        'id' => 'about_project',
                        'rows' => "3"
                        )); ?>
                  </div>



                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                       Status
                     </label>
                     <select name="status" class="form-control">
                        <?php if (empty($item->status)) { ?>
                        <option value="">Select Status</option>
                        <?php } ?>
                        <option value="0" 
                           <?php if ($item->status == "0") {
                              echo "selected";
                              } ?>>Unpublish
                        </option>
                        <option value="1" 
                           <?php if ($item->status == "1") {
                              echo "selected";
                              } ?>>Approved
                        </option>
                        <option value="2" 
                           <?php if ($item->status == "2") {
                              echo "selected";
                              } ?>>Disable
                        </option>
                        <option value="3" 
                           <?php if ($item->status == "3") {
                              echo "selected";
                              } ?>>Reject
                        </option>
                     </select>
                  </div>

                     
               
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('RISEE Score') ?>
                     </label>
                     <?php echo form_input(array(
                        'name' => 'risee_score',
                        'value' => set_value('risee_score', show_data(@$item->risee_score), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('RISEE Score'),
                        'id' => 'risee_score',
                        'type' => 'number',
                        'min'=>'0'
                        )); ?>
                  </div>


                  <div class="row" style="padding-top: 30px;">

                     

                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_gated_community',
                                 'id' => 'is_gated_community',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_gated_community', 1, (@$item->is_gated_community == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Gated Community'); ?>
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_24_water_supply',
                                 'id' => 'is_24_water_supply',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_24_water_supply', 1, (@$item->is_24_water_supply == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('24.hr Water Supply'); ?>
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>


                  <div class="row" >
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_intercom_facility',
                                 'id' => 'is_intercom_facility',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_intercom_facility', 1, (@$item->is_intercom_facility == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Intercom Facility'); ?>
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group" >
                            <div class="form-check">
                               <label>
                               <?php echo form_checkbox(array(
                                  'name' => 'is_fire_alarm',
                                  'id' => 'is_fire_alarm',
                                  'value' => 'accept',
                                  'checked' => set_checkbox('is_fire_alarm', 1, (@$item->is_fire_alarm == 1) ? true : false),
                                  'class' => 'form-check-input'
                                  )); ?>
                               <?php echo get_msg('Fire Alarm'); ?>
                               </label>
                            </div>
                         </div>
                     </div>
                  </div>


                  <div class="row" >
                     <div class="col-md-6">
                         <div class="form-group" >
                            <div class="form-check">
                               <label>
                               <?php echo form_checkbox(array(
                                  'name' => 'is_swimming_pool',
                                  'id' => 'is_swimming_pool',
                                  'value' => 'accept',
                                  'checked' => set_checkbox('is_swimming_pool', 1, (@$item->is_swimming_pool == 1) ? true : false),
                                  'class' => 'form-check-input'
                                  )); ?>
                               <?php echo get_msg('Swimming Pool'); ?>
                               </label>
                            </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group" >
                            <div class="form-check">
                               <label>
                               <?php echo form_checkbox(array(
                                  'name' => 'is_gym',
                                  'id' => 'is_gym',
                                  'value' => 'accept',
                                  'checked' => set_checkbox('is_gym', 1, (@$item->is_gym == 1) ? true : false),
                                  'class' => 'form-check-input'
                                  )); ?>
                               <?php echo get_msg('GYM'); ?>
                               </label>
                            </div>
                         </div>
                     </div>
                  </div>

                  <div class="row" >
                     <div class="col-md-6">
                         <div class="form-group" >
                            <div class="form-check">
                               <label>
                               <?php echo form_checkbox(array(
                                  'name' => 'is_bank_approval',
                                  'id' => 'is_bank_approval',
                                  'value' => 'accept',
                                  'checked' => set_checkbox('is_bank_approval', 1, (@$item->is_bank_approval == 1) ? true : false),
                                  'class' => 'form-check-input'
                                  )); ?>
                               <?php echo get_msg('Bank Approval'); ?>
                               </label>
                            </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group" >
                              <div class="form-check">
                                 <label>
                                 <?php echo form_checkbox(array(
                                    'name' => 'is_park',
                                    'id' => 'is_park',
                                    'value' => 'accept',
                                    'checked' => set_checkbox('is_park', 1, (@$item->is_park == 1) ? true : false),
                                    'class' => 'form-check-input'
                                    )); ?>
                                 <?php echo get_msg('Park'); ?>
                                 </label>
                              </div>
                         </div>

                     </div>
                  </div>

                  <div class="row" >
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_jogging_track',
                                 'id' => 'is_jogging_track',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_jogging_track', 1, (@$item->is_jogging_track == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Jogging Track'); ?>
                              </label>
                           </div>
                        </div>

                     </div>
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_library',
                                 'id' => 'is_library',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_library', 1, (@$item->is_library == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Library'); ?>
                              </label>
                           </div>
                        </div>

                     </div>
                  </div>

                  <div class="row" >
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_shares_property',
                                 'id' => 'is_shares_property',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_shares_property', 1, (@$item->is_shares_property == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Shares Property'); ?>
                              </label>
                           </div>
                        </div>

                     </div>
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_best_deal',
                                 'id' => 'is_best_deal',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_best_deal', 1, (@$item->is_best_deal == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Best Deal'); ?>
                              </label>
                           </div>
                        </div>

                     </div>
                  </div>

                  <div class="row" >
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_limited_offer',
                                 'id' => 'is_limited_offer',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_limited_offer', 1, (@$item->is_limited_offer == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Limited Offer'); ?>
                              </label>
                           </div>
                        </div>

                     </div>
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_call_allowed',
                                 'id' => 'is_call_allowed',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_call_allowed', 1, (@$item->is_call_allowed == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Call Allowed'); ?>
                              </label>
                           </div>
                        </div>

                     </div>
                  </div>

                  <div class="row" >
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_whatsapp_allowed',
                                 'id' => 'is_whatsapp_allowed',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_whatsapp_allowed', 1, (@$item->is_whatsapp_allowed == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Whatsapp Allowed'); ?>
                              </label>
                           </div>
                        </div>

                     </div>
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_premium',
                                 'id' => 'is_premium',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_premium', 1, (@$item->is_premium == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Premium'); ?>
                              </label>
                           </div>
                        </div>

                     </div>
                  </div>

                  <div class="row" >
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_verified',
                                 'id' => 'is_verified',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_verified', 1, (@$item->is_verified == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Verified'); ?>
                              </label>
                           </div>
                        </div>

                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_sold_out',
                                 'id' => 'is_sold_out',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_sold_out', 1, (@$item->is_sold_out == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('itm_is_sold_out'); ?>
                              </label>
                           </div>
                        </div>

                     </div>
                  
                  </div>   
                     <!----
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php// echo form_checkbox(array(
                                // 'name' => 'status',
                                // 'id' => 'status',
                                // 'value' => 'accept',
                                // 'checked' => set_checkbox('status', 1, (@$item->status == 1) ? true : false),
                                // 'class' => 'form-check-input'
                                // )); ?>
                              <?php// echo get_msg('status'); ?>
                              </label>
                           </div>
                        </div>

                     </div>
                     ------->
                  

                  <div class="row" >
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'business_mode',
                                 'id' => 'business_mode',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('business_mode', 1, (@$item->business_mode == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('itm_business_mode'); ?>
                              <br>
                              <?php echo get_msg('itm_show_shop') ?>
                              </label>
                           </div>
                        </div>
                     </div>
               
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_rera_approved',
                                 'id' => 'is_rera_approved',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_rera_approved', 1, (@$item->is_rera_approved == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Rera Approved'); ?>
                              </label>
                           </div>
                        </div>

                     </div>

                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_car_parking',
                                 'id' => 'is_car_parking',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_car_parking', 1, (@$item->is_car_parking == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Car Parking'); ?>
                              </label>
                           </div>
                        </div>

                     </div>


                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_indoor_games',
                                 'id' => 'is_indoor_games',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_indoor_games', 1, (@$item->is_indoor_games == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Indoor Games'); ?>
                              </label>
                           </div>
                        </div>

                     </div>

                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_garden',
                                 'id' => 'is_garden',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_garden', 1, (@$item->is_garden == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Garden Area'); ?>
                              </label>
                           </div>
                        </div>

                     </div>


                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_spa_available',
                                 'id' => 'is_spa_available',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_spa_available', 1, (@$item->is_spa_available == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Spa'); ?>
                              </label>
                           </div>
                        </div>

                     </div>

                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_tennis_court',
                                 'id' => 'is_tennis_court',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_tennis_court', 1, (@$item->is_tennis_court == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Tennis Court'); ?>
                              </label>
                           </div>
                        </div>

                     </div>


                     
                    

                  </div>


                  <div class="row" >
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_vid_available',
                                 'id' => 'is_vid_available',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_vid_available', 1, (@$item->is_vid_available == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('vid Available'); ?>
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_3dtour_available',
                                 'id' => 'is_3dtour_available',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_3dtour_available', 1, (@$item->is_3dtour_available == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('3D Tour Available'); ?>
                              </label>
                           </div>
                        </div>

                     </div>

                  </div>

                  <div class="row" >
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_hmda',
                                 'id' => 'is_hmda',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_hmda', 1, (@$item->is_hmda == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('HMDA Approved'); ?>
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_dtcp',
                                 'id' => 'is_dtcp',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_dtcp', 1, (@$item->is_dtcp == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('DTCP Approved'); ?>
                              </label>
                           </div>
                        </div>

                     </div>

                  </div>





                  <!-- form group -->
                  
               </div>
               <div class="col-md-6">

               </div>
               <div class="col-md-6">

               </div>
           
                

                    
            </div>

            <div class="row" style="padding-top: 14px;">
            
               <div class="col-md-3">
                <h3 class="text-center">
                  <span>Project Flat Details :</span>
                  <span>					
                      <button type="button" class='btn btn-sm btn-primary pull-right' id="add_new_flat">
					      	<span class='fa fa-plus'></span> 
					      	 Add New Flat
					       </button>
                  </span>
               </h3>
               </div>

            </div>


      <div id="new_flat_row">
        
        <?php if (isset( $item )): ?>

           <?php
                 $flats_data = $this->Project_flats->get_flats_data($item->project_id);
                 foreach($flats_data as $flat) 
                 {
                     $fn = 1;
           ?>

           <div class="row" style="padding-top: 14px;">
              <div class="col-md-1" >
                  <h5 class="text-center text-bold mt-4">
                       <button type="button" class='btn btn-sm btn-danger' value="<?php echo $flat->flat_image_url; ?>" data-id="<?php echo $flat->id;?>" data-type="flats_row">
                        <i style='font-size: 14px;' class='fa fa-trash-o'></i>
                       </button> 
                       Flat<?php echo $fn;  ?>:
                  </h5> 
                  <input type="hidden" value="<?php echo $flat->id; ?>" class="form-control form-control-sm" id="flat_id" name="flat_id[]">                     
              </div>
              <div class="col-md-1">
                 <div class="form-group">
                    <label>
                       Property Type
                    </label>
                    <select name="property_type[]" class="form-control">
                       <?php if (empty($flat->property_type)) { ?>
                       <option value="">Select Flat </option>
                       <?php } ?>
                       <option value="apartments" 
                          <?php if ($flat->property_type == "apartments") {
                             echo "selected";
                             } ?>>Apartments
                       </option>
                       <option value="villa" 
                          <?php if ($flat->property_type == "villa") {
                             echo "selected";
                             } ?>>Villa
                       </option>
                    </select>
                 </div>
              </div>
              <div class="col-md-1">
                 <div class="form-group">
                    <label>
                       Flat Type
                    </label>
                    <select name="flat_type[]" class="form-control">
                       <?php if (empty($flat->flat_type)) { ?>
                       <option value="">Select Flat </option>
                       <?php } ?>
                       <option value="1bhk" 
                          <?php if ($flat->flat_type == "1bhk") {
                             echo "selected";
                             } ?>>1BHK
                       </option>
                       <option value="2bhk" 
                          <?php if ($flat->flat_type == "2bhk") {
                             echo "selected";
                             } ?>>2BHK
                       </option>
                       <option value="3bhk" 
                          <?php if ($flat->flat_type == "3bhk") {
                             echo "selected";
                             } ?>>3BHK
                       </option>
                       <option value="4bhk" 
                          <?php if ($flat->flat_type == "4bhk") {
                             echo "selected";
                             } ?>>4BHK
                       </option>
                       <option value="5bhk" 
                          <?php if ($flat->flat_type == "5bhk") {
                             echo "selected";
                             } ?>>5BHK
                       </option>
                    </select>
                 </div>
              </div>
              <div class="col-md-1">
                 <div class="form-group">
                    <label>
                      Bedrooms
                    </label>
                    <input type="text" value="<?php echo $flat->flat_bed; ?>" class="form-control form-control-sm" placeholder="Bedrooms" id="flat_bed" name="flat_bed[]">
                 </div>
              </div>
              <div class="col-md-1">
                 <div class="form-group">
                    <label>
                      Bathrooms
                    </label>
                    <input type="text" value="<?php echo $flat->flat_bathrooms; ?>" class="form-control form-control-sm" placeholder="Bath" id="flat_bathrooms" name="flat_bathrooms[]">
                 </div>
              </div>
              <div class="col-md-1">
                 <div class="form-group">
                    <label >
                        Price
                    </label>
                    <input type="text" value="<?php echo $flat->flat_price; ?>" class="form-control form-control-sm" placeholder="Price" id="flat1_price" name="flat_price[]">
                 </div>
              </div>
              <div class="col-md-1">
                 <div class="form-group">
                    <label>
                         Area
                    </label>
                    <input type="text" value="<?php echo $flat->flat_area; ?>" class="form-control form-control-sm" placeholder="Area" id="flat1_area" name="flat_area[]">
                 </div>
              </div>
              <div class="col-md-1">
                 <div class="form-group">
                    <label>
                       Area Type
                    </label>
                    <select name="flat_area_type[]" class="form-control">
                       <?php if (empty($flat->flat_area_type)) { ?>
                       <option value="">Select Flat </option>
                       <?php } ?>
                       <option value="Sq.Ft" 
                          <?php if ($flat->flat_area_type == "Sq.Ft") {
                             echo "selected";
                             } ?>>Sq.Ft
                       </option>
                       <option value="Sq.Mt" 
                          <?php if ($flat->flat_area_type == "Sq.Mt") {
                             echo "selected";
                             } ?>>Sq.Mt
                       </option>
                       <option value="Sq.Yds" 
                          <?php if ($flat->flat_area_type == "Sq.Yds") {
                             echo "selected";
                             } ?>>Sq.Yds
                       </option>
                       <option value="Acres" 
                          <?php if ($flat->flat_area_type == "Acres") {
                             echo "selected";
                             } ?>>Acres
                       </option>
                    </select>
                 </div>
              </div>
              <div class="col-md-1">
                 <div class="form-group">
                    <label>
                      Carpet Area
                    </label>
                    <input type="text" value="<?php echo $flat->flat_carpet_area; ?>" class="form-control form-control-sm" placeholder="Carpet Area" id="flat_carpet_area" name="flat_carpet_area[]">
                 </div>
              </div>
              <div class="col-md-1">
                 <div class="form-group">
                    <label>
                        Balcony
                    </label>
                    <input type="text" value="<?php echo $flat->flat_balcony; ?>" class="form-control form-control-sm" placeholder="Balcony" id="flat_balcony" name="flat_balcony[]">
                 </div>
              </div>
              <div class="col-md-1">
                 <div class="form-group">
                    <label>
                        Available
                    </label>
                    <input type="text" value="<?php echo $flat->flat_available; ?>" class="form-control form-control-sm" placeholder="Available" id="flat_available" name="flat_available[]">
                 </div>
              </div>
              <div class="col-md-1">
              
                 <?php if($flat->flat_image_url != ""){ ?>
                    <div>
                      <img src="<?php echo $flat->flat_image_url;?>" class="img-thumbnail" alt="project_icon"  width="120">
                      <input type="hidden" value="<?php echo $flat->flat_image_url; ?>" class="form-control form-control-sm" id="flat_img_old_name" name="flat_img_old_name[]">
                      <p>
                            <span>Project Layout</span> <span id="image2_file">Image2</span>
                       </p>
                       <p>       
                          <button type="button" value="<?php echo $flat->flat_image_url; ?>" data-id="<?php echo $flat->id;?>" data-type="flats" class="btn btn-sm text-danger" id="project_delete_btn">
                               <span id="image2_action_delete">Delete</span>  
                          </button>
                       </p>
                    </div>  
                    <input type="file" style="display:none;" class="form-control form-control-sm"  name="flat_image_url[]"> 
                 <?php }else{?>
                    <div class="form-group">
                       <label><?php echo get_msg(' Layout Image')?>
                          <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                             <span class='glyphicon glyphicon-info-sign menu-icon'>
                          </a>
                       </label>
                       <br/>
                       <input type="hidden" value="" class="form-control form-control-sm" id="flat_img_old_name" name="flat_img_old_name[]">
                       <input class="btn btn-sm" type="file" name="flat_image_url[]">
                    </div>
                 <?php } ?>
              </div> 
              <!----     
              <div class="col-md-1 py-4">
                 <button type="button" class='btn btn-sm btn-danger' id="delete_flat_row">
                     <i style='font-size: 14px;' class='fa fa-trash-o'><span style='padding-left:4px;'>Delete row</span></i>
                 </button>               
              </div>
              ------->
           </div>
           <?php $fn++; } ?>
        <?php endif; ?>
     
     </div>
        
            <!------------END FLATs  -------------->


         </div>
         <!-- Grid row -->
         <?php if (isset($item)) : ?>
         <div class="gallery" id="gallery" style="margin-left: 15px; margin-bottom: 15px;">
            <?php
               $conds = array('img_type' => 'item', 'img_parent_id' => $item->id);
               $images = $this->Image->get_all_by($conds)->result();
               ?>
            <?php $i = 0;
               foreach ($images as $img) : ?>
            <!-- Grid column -->
            <div class="mb-3 pics animation all 2">
               <a href="#
                  <?php echo $i; ?>">
               <img class="img-fluid" src="
                  <?php echo img_url('/' . $img->img_path); ?>" alt="Card image cap">
               </a>
            </div>
            <!-- Grid column -->
            <?php $i++;
               endforeach; ?>
            <?php $i = 0;
               foreach ($images as $img) : ?>
            <a href="#_1" class="lightbox trans" id="
               <?php echo $i ?>">
            <img src="
               <?php echo img_url('/' . $img->img_path); ?>">
            </a>
            <?php $i++;
               endforeach; ?>
         </div>
         <?php endif; ?>
         <!-- Grid row -->
         <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">
            <?php echo get_msg('btn_save') ?>
            </button>
            <button type="submit" name="gallery" id="gallery" class="btn btn-sm btn-primary" style="margin-top: 3px;">
            <?php echo get_msg('btn_save_gallery') ?>
            </button>
            <button type="submit" name="promote" id="promote" class="btn btn-sm btn-primary" style="margin-top: 3px;">
            <?php echo get_msg('btn_promote') ?>
            </button>
            <a href="
               <?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
            <?php echo get_msg('btn_cancel') ?>
            </a>
         </div>
      </form>
   </div>
</section>