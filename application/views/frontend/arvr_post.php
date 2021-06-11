
<!-- Contact section start -->
<div class="contact-section">
    <div class="">
        <div class="row " style="max-width:1600px;">
            <div class="col-lg-6   none-992" style="background-color: #E04343;">
              <div class=" clearfix pt-2 pl-5 pr-5 my-5" >
                  <div class="">
                        <img src="<?php echo base_url()?>assets/frontend/img/logos/augmented.jpeg" class="img-thumbnail" alt="augmented_realty">
                  </div>
                  <h2 class="text-light text-center my-4 ">Get your Augmented Realty QR Code Now !</h2>
                  <h5 class='text-light'>Process to get AR image:</h5>
                  <div class="row">
                    <div class="col-md-8 text-light">
                         <ol>
                           <li><p class="text-light">Share your Contact Details along with the Property images/Designs you want the AR image.</p></li>
                           <li><p class="text-light">We will review the images and qoute the price</p></li>
                           <li><p class="text-light">Once the payment is done, we will deliver your Image in 1-2 working days.</p></li>
                         </ol>
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo base_url()?>assets/frontend/img/logos/arimg.jpeg" class="img-thumbnail" alt="augmented">
                    </div>
                  </div>
                  <h5 class='text-light'>Contact No: +91-8688932501</h5>
              </div>

            </div>
            <div class="col-lg-6 align-self-center pad-0" >
                <div id="loading_box" ></div>
                <div id="success_box">

                </div>
                <div class="form-section clearfix" id="form_box">
                    <h2>RISEE - Augmented Realty</h2>
                    <a href="#" class="btn important-btn btn-theme btn-md mt-4">Get a Demo Now !</a>
                    <div class="clearfix my-5"></div>
                    <form id="arvr_form" enctype="multipart/form-data">
 

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
                          <label for="arvr_img" class="col-sm-2 col-form-label text-left">Upload Image:</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" id="arvr_img" name="arvr_img"  required>
                          </div>
                        </div>

                        <div class="form-group clearfix mb-0 ">
                            <button type="submit" id="lrs_post_submit" class=" btn important-btn btn-theme btn-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


