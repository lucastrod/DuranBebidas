﻿<?php include_once('inc/header.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons Icon -->

<title>Superb premium HTML5 &amp; CSS3 template</title>

<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS Style -->
<link rel="stylesheet" type="text/css" href="css/internal.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.css" media="all">
<link rel="stylesheet" type="text/css" href="css/simple-line-icons.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/revslider.css" >
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="css/flexslider.css">
<link rel="stylesheet" type="text/css" href="css/jquery.mobile-menu.css">

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,600,600italic,400italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
</head>

<body class="customer-account-index customer-account inner-page">
<div id="page"> 
  
  <!-- Main Container -->
  <section class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <div class="col-main col-sm-9 animated" style="visibility: visible;">
          <div class="my-account">
            <div class="page-title">
              <h1>Add New Address</h1>
            </div>
            <form action="#" method="post" id="form-validate">
              <div class="fieldset group-select">
                <input name="form_key" type="hidden" value="">
                <input type="hidden" name="success_url" value="">
                <input type="hidden" name="error_url" value="">
                <h2 class="legend">Contact Information</h2>
                <ul class="">
                  <li class="">
                    <div class="customer-name">
                      <div class="input-box name-firstname">
                        <label for="firstname">First Name<span class="required">*</span></label>
                        <div class="input-box1">
                          <input type="text" id="firstname" name="" value="John" title="" maxlength="255" class="input-text required-entry">
                        </div>
                      </div>
                      <div class="input-box name-lastname">
                        <label for="lastname">Last Name<span class="required">*</span></label>
                        <div class="input-box1">
                          <input type="text" id="lastname" name="" value="Deo" title="" maxlength="255" class="input-text required-entry">
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="">
                    <div class="">
                      <label for="company">Company</label>
                      <br>
                      <input type="text" name="" id="company" title="" value="" class="input-text ">
                    </div>
                  </li>
                  <li class="">
                    <div class="input-box">
                      <label for="telephone">Telephone<em class="required">*</em></label>
                      <br>
                      <input type="text" name="" value="" title="" class="input-text   required-entry" id="telephone">
                    </div>
                    <div class="input-box">
                      <label for="fax">Fax</label>
                      <br>
                      <input type="text" name="" id="fax" title="" value="" class="input-text ">
                    </div>
                  </li>
                </ul>
              </div>
              <div class="fieldset group-select">
                <h2 class="legend">Address</h2>
                <ul class="">
                  <li class="">
                    <label for="street_1">Street Address<em class="required">*</em></label>
                    <br>
                    <input type="text" name="" value="" title="" id="street_1" class="input-text  required-entry">
                  </li>
                  <li class="">
                    <input type="text" name="" value="" title="" id="street_2" class="input-text ">
                  </li>
                  <li class="">
                    <div class="field">
                      <div class="input-box">
                        <label for="city">City<em class="required">*</em></label>
                        <br>
                        <input type="text" name="" value="" title="" class="input-text  required-entry" id="city">
                      </div>
                    </div>
                    <div class="field">
                      <div class="input-box">
                        <label for="region_id">State/Province</label>
                        <br>
                        <select id="region_id" name="" title="" class="validate-select required-entry" defaultvalue="0">
                          <option value="">Please select region, state or province</option>
                          <option value="1" title="Alabama">Alabama</option>
                          <option value="2" title="Alaska">Alaska</option>
                          <option value="3" title="American Samoa">American Samoa</option>
                          <option value="4" title="Arizona">Arizona</option>
                          <option value="5" title="Arkansas">Arkansas</option>
                        </select>
                        <input type="text" id="region" name="region" value="" title="State/Province" class="input-text required-entry" style="display: none;">
                      </div>
                    </div>
                  </li>
                  <li class="">
                    <div class="field">
                      <div class="input-box">
                        <label for="zip">Zip/Postal Code<em class="required">*</em></label>
                        <br>
                        <input type="text" name="postcode" value="" title="Zip/Postal Code" id="zip" class="input-text validate-zip-international  required-entry">
                      </div>
                    </div>
                    <div class="field">
                      <div class="input-box">
                        <label for="country">Country<em class="required">*</em></label>
                        <br>
                        <select name="country_id" id="country" class="validate-select" title="Country">
                          <option value=""> </option>
                          <option value="AF">Afghanistan</option>
                          <option value="AX">Åland Islands</option>
                          <option value="AL">Albania</option>
                        </select>
                      </div>
                    </div>
                  </li>
                  <li class="control">
                    <input type="checkbox" id="primary_billing" name="" value="1" title="" class="checkbox">
                    <label for="primary_billing">Use as my default billing address</label>
                  </li>
                  <li class="control">
                    <input type="checkbox" id="primary_shipping" name="" value="1" title="" class="checkbox">
                    <label for="primary_shipping">Use as my default shipping address</label>
                  </li>
                </ul>
              </div>
              <div class="buttons-set">
                <p class="required">* Required Fields</p>
                <button type="submit" title="" class="button"><span>Save Address</span></button>
                <a href="#"><small>« </small>Back</a> </div>
            </form>
          </div>
        </div>
        <aside class="col-right sidebar col-sm-3 animated" style="visibility: visible;">
          <div class="block block-account">
            <div class="block-title"> My Account </div>
            <div class="block-content">
              <ul>
                <li><a href="#"><span> Account Dashboard</span></a></li>
                <li><a href="#"><span> Account Information</span></a></li>
                <li class="current"><a>Address Book</a></li>
                <li><a href="#"><span> My Orders</span></a></li>
                <li><a href="#"><span> Billing Agreements</span></a></li>
                <li><a href="#"><span> Recurring Profiles</span></a></li>
                <li><a href="#"><span> My Product Reviews</span></a></li>
                <li><a href="#"><span> My Tags</span></a></li>
                <li><a href="#"><span> My Wishlist</span></a></li>
                <li><a href="#"><span> My Applications</span></a></li>
                <li><a href="#"><span> Newsletter Subscriptions</span></a></li>
                <li class="last"><a href="#"><span> My Downloadable Products</span></a></li>
              </ul>
            </div>
            <!--block-content--> 
          </div>
          <!--block block-account--> 
          
        </aside>
        <!--col-right sidebar col-sm-3--> 
      </div>
    </div>
  </section>
  <!-- Main Container End --> 
  
  <!-- Brand logo starts  -->
  <div class="brand-logo wow bounceInUp animated">
    <div class="container">
      <div class="slider-items-products">
        <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col6"> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo3.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo2.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo1.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo4.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo5.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo6.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo1.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo4.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Brand logo ends  --> 
  
  <?php include_once('inc/footer.php'); ?>

</body>
</html>