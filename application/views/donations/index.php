<div id="content" style="background:#ffffff;">
    <div class="container">
        <div class="row">
            <div class="find_wrapper">
                <div class="span1">
                    <div class="row"></div>
                </div>
                <div class="span9">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading display-table">
                            <div class="row display-tr">
                                <h3 class="panel-title display-td">DONATION FORM</h3>
                                <div class="display-td">
                                    <i class="fab fa-cc-stripe pull-right" style="font-size:36px"></i>
                                    <img class="img-responsive ">
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row" id="receipt" style="display:none;">
                                <div class="well span6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                                    <div id="printableArea">

                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 span6">
                                                <address>
                                                    <strong id="receipt-name"></strong>
                                                    <br>
                                                    <div id="address1"></div>
                                                    Email :<span id="receipt-email"> --- </span>
                                                    <br>
                                                    Landline: <span id="receipt-landline"> --- </span>
                                                    <br>
                                                    Mobile: <span id="receipt-mobile"> ---  </span>
                                                </address>
                                            </div>
                                            <div class="span6 text-right">
                                                <p>
                                                    <em>Date: <b id="receipt-date"> </b></em>
                                                </p>
                                                <p>
                                                    <em></em>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <strong style="font-size:1.5em;">Receipt</strong>
                                        </div>
                                        </span>
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="span9"><em id="rcpt_plan_name"></em></h4></td>
                                                <td class="span1" style="text-align: center" id="rcpt_plan_qty"></td>
                                                <td class="span1 text-center" id="rcpt_plan_amt"></td>
                                                <td class="span1 text-center" id="rcpt_plan_total"></td>
                                            </tr>
                                            <tr>
                                                <td>  </td>
                                                <td>  </td>
                                                <td class="text-right"><h4><strong>Total: </strong></h4></td>
                                                <td class="text-center text-danger"><h4><strong
                                                                id="rcpt_total"></strong></h4></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="/donations">
                                            <button style="cursor:pointer;" type="button" class="btn btn-primary">
                                                Reload
                                            </button>
                                        </a>
                                        <button style="cursor:pointer;" type="button" onclick="printDiv()"
                                                class="btn btn-success">Print
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="information_area">
                                <form id="loginform" class="form-horizontal" role="form">

                                    <input type="hidden" class="form-control" id="amt" value="0"/>
                                    <br><br>
                                    <h6 style="color:#636363;font-size: 14px;">
                                        <i>Cardholder Information</i>
                                    </h6>
                                    <div class="fields">
                                        <?php if (isset($this->session->user->first_name) && $this->session->user->first_name != "") { ?>
                                            <input type="text" class="form-control span8" id="name" name="first_name"
                                                   placeholder="Cardholder Name" required disabled="disabled"
                                                   value="<?php echo $this->session->user->first_name . ' ' . $this->session->user->last_name; ?>">
                                        <?php } else { ?>
                                            <input type="text" class="form-control span8" id="name" name="first_name"
                                                   placeholder="Cardholder Name" required>
                                        <?php } ?>
                                        <?php if (isset($this->session->user->email) && $this->session->user->email != "") { ?>
                                            <input type="email" class="form-control span8" id="email" name="email"
                                                   placeholder="Email" required disabled="disabled"
                                                   value="<?php echo $this->session->user->email; ?>">
                                        <?php } else { ?>
                                            <input type="email" class="form-control span8" id="email" name="email"
                                                   placeholder="Email" required>
                                        <?php } ?>
                                    </div>
                                    <div class="card">
                                        <div class="card-header rgba-stylish-strong z-depth-1 mb-1" role="tab"
                                             id="heading1">
                                            <a data-toggle="collapse" data-parent="#address" href="#adress-form"
                                               aria-expanded="true"
                                               aria-controls="adress-form">
                                                <h5 class="mb-0 white-text text-uppercase font-thin">
                                                    Address <i class="fas fa-angle-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>
                                        <div id="adress-form" class="collapse show" role="tabpanel"
                                             aria-labelledby="heading1" data-parent="#address">
                                            <div class="card-body mb-1 rgba-grey-light white-text">
                                                <div class="fields">
                                                    <?php if (isset($this->session->user->street) && $this->session->user->street != "") { ?>
                                                        <input type="text" class="form-control " id="street"
                                                               name="street" placeholder="House Number / Street"
                                                               autocomplete="shipping street-address"
                                                               value="<?php echo $this->session->user->street; ?>"
                                                               disabled="disabled">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control " id="street"
                                                               name="street" placeholder="House Number / Street"
                                                               autocomplete="shipping street-address">
                                                    <?php } ?>

                                                    <?php if (isset($this->session->user->city) && $this->session->user->city != "") { ?>
                                                        <input type="text" class="form-control " id="city" name="city"
                                                               placeholder="City" autocomplete="shipping locality"
                                                               value="<?php echo $this->session->user->city; ?>"
                                                               disabled="disabled">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control " id="city" name="city"
                                                               placeholder="City" autocomplete="shipping locality">
                                                    <?php } ?>
                                                    <?php if (isset($this->session->user->state) && $this->session->user->state != "") { ?>
                                                        <input type="text" class="form-control span4" id="state"
                                                               name="state" placeholder="State (optional)"
                                                               autocomplete="shipping region"
                                                               value="<?php echo $this->session->user->state; ?>"
                                                               disabled="disabled">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control span4" id="state"
                                                               name="state" placeholder="State (optional)"
                                                               autocomplete="shipping region">
                                                    <?php } ?>
                                                    <?php if (isset($this->session->user->zip) && $this->session->user->zip != "") { ?>
                                                        <input type="text" class="form-control span4" id="zip"
                                                               name="zip" placeholder="Zip Code"
                                                               autocomplete="shipping postal-code"
                                                               value="<?php echo $this->session->user->zip; ?>"
                                                               disabled="disabled">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control span3" id="zip"
                                                               name="zip" placeholder="Zip Code"
                                                               autocomplete="shipping postal-code">
                                                    <?php } ?>
                                                    <?php if (isset($this->session->user->country) && $this->session->user->country != "") { ?>
                                                        <input type="text" class="form-control span4" id="country"
                                                               name="country" placeholder="Country"
                                                               autocomplete="shipping country"
                                                               value="<?php echo $this->session->user->country; ?>"
                                                               disabled="disabled">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control span8" id="country"
                                                               name="country" placeholder="Country"
                                                               autocomplete="shipping country">
                                                    <?php } ?>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header rgba-stylish-strong z-depth-1 mb-1" role="tab"
                                             id="heading1">
                                            <a data-toggle="collapse" data-parent="#contact" href="#contact-form"
                                               aria-expanded="true"
                                               aria-controls="contact-form">
                                                <h5 class="mb-0 white-text text-uppercase font-thin">
                                                    Contact Information <i class="fas fa-angle-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>
                                        <div id="contact-form" class="collapse show" role="tabpanel"
                                             aria-labelledby="heading1" data-parent="#contact">
                                            <div class="card-body mb-1 rgba-grey-light white-text">
                                                <div class="fields">
                                                    <?php if (isset($this->session->user->landline) && $this->session->user->landline != "") { ?>
                                                        <input type="text" class="form-control span8" id="landline"
                                                               name="landline" placeholder="Landline Number"
                                                               value="<?php echo $this->session->user->landline; ?>"
                                                               disabled="disabled">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control span8" id="landline"
                                                               name="landline" value="" placeholder="Landline Number">
                                                    <?php } ?>
                                                    <?php if (isset($this->session->user->mobile) && $this->session->user->mobile != "") { ?>
                                                        <input type="text" class="form-control span8" id="mobile"
                                                               name="mobile" placeholder="Mobile Number"
                                                               value="<?php echo $this->session->user->mobile; ?>"
                                                               disabled="disabled">
                                                    <?php } else { ?>
                                                        <input type="text" class="form-control span8" id="mobile"
                                                               name="mobile" value="" placeholder="Mobile Number">
                                                    <?php } ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <h6 style="color:#636363;font-size: 14px;">
                                        <i>Type of Donation</i>
                                    </h6>
                                    <input class="messageCheckbox" type="checkbox" id="fruit1" name="fruit-1"
                                           value="Monthly" checked>
                                    <label for="fruit1">Monthly</label>
                                    <input class="messageCheckbox" type="checkbox" id="fruit4" name="fruit-4"
                                           value="One Time">
                                    <label for="fruit4">One Time</label>
                                    <div id="recurring">
                                        <h6 style="color:#636363;font-size:1.2em;">
                                            <i>Plans</i>
                                        </h6>
                                        <?php foreach ($plans as $plan) {
                                            ?>
                                            <div class='package'>
                                                <div class='planname'><?php echo $plan->nice_name; ?></div>
                                                <div class='plan_description'><?php echo $plan->description; ?></div>
                                                <div class=''></div>
                                                <hr>
                                                <ul>
                                                    <td width="">
                                                        <?php
                                                        if ($plan->is_fixed == 0) {
                                                            ?>
                                                            <div class="input-group input-group-icon">
                                                                <label>$</label>
                                                                <input style="width:90%;" type="number" value="0"
                                                                       step="1" min="0"
                                                                       id="plan-<?php echo $plan->name; ?>"
                                                                       onkeyup="updateAmt('<?php echo $plan->name; ?>');"
                                                                       onclick="updateAmt('<?php echo $plan->name; ?>');"/>
                                                            </div>
                                                            <strong> Total : </strong>
                                                            <span class="input-group-addon"
                                                                  id="plan-<?php echo $plan->name; ?>-total">
                                                                    = 0 / month
                                                                </span>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="input-group input-group-icon">
                                                                <label>Quantity</label>
                                                                <input style="width:90%;" type="number" value="0"
                                                                       step="1" min="0"
                                                                       id="plan-<?php echo $plan->name; ?>"
                                                                       onkeyup="updateAmt('<?php echo $plan->name; ?>');"
                                                                       onclick="updateAmt('<?php echo $plan->name; ?>');"/>
                                                            </div>
                                                            <span class="input-group-addon">
                                                                    <strong> &#215; $ <?php echo $plan->amount; ?></strong>
                                                                </span>
                                                            <br>
                                                            <strong> Total : </strong>
                                                            <span class="input-group-addon"
                                                                  id="plan-<?php echo $plan->name; ?>-total">
                                                                    = 0 / month
                                                                </span>
                                                            <?php
                                                        }
                                                        ?>

                                                    </td>
                                                    <!--<input style="width:20%;" data-toggle="tooltip" title="<?php echo $plan->description; ?>" type="button"  value="?" class="btn btn-default btn-block rounded-0 py-2 pull-right" style="color:red">-->

                                                </ul>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div id="oneTime" style="display:none">
                                        <h6 style="color:#636363;font-size: 14px;">
                                            <i>One Time Donation</i>
                                        </h6>
                                        <div class='package'>
                                            <div class='planname'>One Time Donation</div>
                                            <hr>
                                            <ul>
                                                <td width="">
                                                    <div class="input-group input-group-icon">
                                                        <label>Amount</label>
                                                        <input style="width:90%;" type="number" value="0" step="1"
                                                               min="0" id='one_time_donation'
                                                               onkeyup="updateAmtOntTime();"
                                                               onclick="updateAmtOntTime();"/>
                                                    </div>
                                                </td>
                                            </ul>
                                        </div>
                                    </div>
                                    <table class="table table-striped">
                                        <thead></thead>
                                    </table>
                                    <div class="alert" id="error-alert" style="display:none">
                                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                        <strong id="error_message"></strong>
                                    </div>

                                    <div id="donation_process" style="display:none">
                                        <p style="text-align:center;font-size:1.2em;">Processing Donation...</p>
                                        <div class="loader">
                                            <div class="loader-inner"></div>
                                            <div class="loader-inner"></div>
                                            <div class="loader-inner"></div>
                                        </div>
                                    </div>

                                    <div class="alert-success" id="success-alert" style="display:none">
                                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                        <strong id="success_message">Thank you for your donation.</strong>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <div class="pull-left" style="color:#636363;font-size: 1.5em;">
                                    <td>
                                        <span>Total Donation : </span>
                                        <strong style="color:#444444;">
                                            $ <span id="overall-total"> 0</span>.00
                                        </strong>
                                    </td>
                                </div>
                                <button style="cursor:pointer;" type="submit" id="donateNow" class="btn btn-primary">
                                    Donate
                                </button>
                            </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

        </div>


    </div>
</div> 
