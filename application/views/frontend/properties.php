

<!-- Sub banner start -->
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Properties</h1>
            <!-- <ul class="breadcrumbs">
                <li><a href="<?php echo base_url() ?>">Home</a></li>
                <li class="active">Properties</li>
            </ul> -->
        </div>
    </div>
</div>
<!-- Sub Banner end -->

<!-- Properties section body start -->
<div class="properties-section-body content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <!-- Option bar start -->
                <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">
                    <div class="row">
                        <div class="col-lg-6 col-md-7 col-sm-7">
                            <div class="sorting-options2">
                                <span class="sort">Sort by:</span>
                                <select class="selectpicker search-fields" name="default-order">
                                    <option>Default Order</option>
                                    <option>Price High to Low</option>
                                    <option>Price: Low to High</option>
                                    <option>Newest Properties</option>
                                    <option>Oldest Properties</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-5">
                            <div class="sorting-options">
                                <a href="properties-list-fullwidth.html" class="change-view-btn"><i class="fa fa-th-list"></i></a>
                                <a href="properties-grid-fullwidth.html" class="change-view-btn active-view-btn"><i class="fa fa-th-large"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- grid properties start -->
                <div class="row" id="propertiesinfo">

                <!----
                    <div class="col-lg-4 col-md-6 col-sm-12" >
                        <div class="property-box">
                            <div class="property-thumbnail">
                                <a href="#" class="property-img">
                                    <div class="listing-badges">
                                        <span class="featured">FOR SALE</span>
                                    </div>
                                    <div class="price-box"><span><span>&#8377</span>63.23 L - 90.01 L</span> </div>
                                    <img class="d-block w-100" src="<?php echo base_url() ?>assets/frontend/img/properties/properties2.jpg" alt="properties" height="236px">
                                </a>
                            </div>
                            <div class="detail">
                                <h1 class="title">
                                    <a href="#">Vaishnavi Soudha</a>
                                </h1>

                                <div class="location">
                                    <a href="#">
                                        <i class="flaticon-pin"></i>Karmanghat, Hyderabad,
                                    </a>
                                </div>
                            </div>
                            <ul class="facilities-list clearfix">
                                <li>
                                    <span>Apartments</span> 
                                </li>
                                <li>
                                    <span>Beds</span> 2,3
                                </li>
                                <li>
                                    <span>Baths</span> 2
                                </li>
                                <li>
                                    <span>Garage</span> 1
                                </li>
                            </ul>
                            <div class="footer">
                                <a href="#">
                                    <i class="flaticon-male"></i>Jhon Doe
                                </a>
                                <span>
                                <i class="flaticon-calendar"></i>5 Days ago
                            </span>
                            </div>
                        </div>
                    </div>
                -------->
                </div>
                <!-- Page navigation start --> 
                <div class="pagination-box hidden-mb-45 text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                               <input type="hidden" id="limit" name="limit" value="9">
                               <input type="hidden" id="offset" name="offset" value="0">
                                <button type="button" class="page-link" id="Loadmore">Load More...</button>
                                <?php
                                // $offset = $pagenation+9;
                                //  if($properties_count >= $pagenation){
                                //      
                                //     echo '<a class="page-link" href="'.base_url().'properties/'.$limit.'">Load More...</a>';
                                //  }
                                ?>
                            </li>
                        </ul>
                    </nav>
                </div>  
                <!-----           
                <div class="pagination-box hidden-mb-45 text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="<?php echo base_url(); ?>properties">First</a>
                            </li>
                            <?php 
                                $offset = 0;
                                for($x = 1; $offset <= $properties_count; $x++){
                                    if($offset != $pagenation)
                                    {
                                        $active ="";
                                    }else {
                                        $active ="active";
                                    }
                                   echo  '<li class="page-item"><a class="page-link '.$active.' " href="'.base_url().'properties/'.$offset.'">'.$x.'</a></li>';                                    
                                   $offset = $offset+9;                                   
                                }
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo base_url(); ?>properties/<?php echo $offset-9;?>">Last</a>
                            </li>

                        </ul>
                    </nav>
                </div>
               -----> 
            </div>
        </div>
    </div>
</div>
<!-- Properties section body end -->

