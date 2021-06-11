
<!-- Contact section start -->
<div class="contact-section">
    <div class="container">
        <div class="row" style="max-width:1600px;">
            <div class="col-lg-6   none-992" style="background-color: #E04343;">
              <div class=" clearfix pt-2 pl-5 pr-5 mt-5" >
                  <div class="">
                      <a href="index.html">
                          <img src="<?php echo base_url()?>assets/frontend/img/logos/telangana.jpeg" class="img-thumbnail" alt="logo">
                      </a>
                  </div>
                  <h2 class="text-light text-center mt-5 ">Land Regularisation Scheme 2020 </h2>
              </div>

            </div>
            <div class="col-lg-6 align-self-center pad-0" >
                <div id="loading_box" ></div>
                <div id="success_box">

                </div>
                <div class="form-section clearfix" id="form_box">
                    <h2>RISEE - LRS</h2>

                    <div class="clearfix my-5"></div>
                    <form id="lrs_form" enctype="multipart/form-data">
 
                        <div class="form-group row">
                           <label for="property_type" class="col-sm-4 col-form-label text-left">Property:</label>
                           <div class="col-sm-8 ">
                                <select class="form-control" id="property_type" name="property_type" required>
                                    <option value="">Select Property Type:</option>
                                    <option value="Individual Plot">Individual Plot</option>
                                    <option value="Layout">Layout</option>
                                </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="property_location" class="col-sm-4 col-form-label text-left">Property Location:</label>
                           <div class="col-sm-8">
                                <select class="form-control" id="property_location" name="property_location" required>
                                    <option value="">Select Location:</option>
                                    <option value="Hyderabad">Hyderabad</option>
                                    <option value="Mancherial">Mancherial</option>
                                    <option value="Secunderabad">Secunderabad</option>
                                </select>
                           </div>
                        </div>
                        <h5 class="text-left my-3">Your Details:</h5>

                        <div class="form-group row">
                          <label for="name" class="col-sm-2 col-form-label text-left">Name:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="phone" class="col-sm-2 col-form-label text-left">Phone:</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter phone Number" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="email" class="col-sm-2 col-form-label text-left">Email:</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="lrs_img" class="col-sm-2 col-form-label text-left">Upload Image:</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" id="lrs_img" name="lrs_img"  required>
                          </div>
                        </div>

                        <div class="form-group clearfix mb-0 ">
                            <button type="submit" id="lrs_post_submit" class=" btn-md btn-theme float-left">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

