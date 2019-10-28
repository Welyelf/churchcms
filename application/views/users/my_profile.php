<div id="content">
    <div class="container">
        <div class="row">
            <div class="span4"></div>
            <div class="span3">
                <div class="row">
                    <div class="span3 " style="border-radius: 16px;">
                        <div class="well profile span3">
                            <div class="text-center">
                                <figure>
                                    <img src="/assets/img/profile.png" alt="" class="img-circle" style="width:75px;"
                                         id="user-img">
                                </figure>
                                <h5>
                                    <strong id="user-name"><?php echo $user->first_name . " " . $user->last_name; ?></strong>
                                </h5>
                                <div class="divider"></div>
                                <p><strong>Username</strong></p>
                                <p id="user-frid"><?php echo $user->username; ?> </p>
                                <div class="divider"></div>
                                <p><strong>Email</strong></p>
                                <p style="overflow-wrap: break-word;" id="user-email"><?php echo $user->email; ?></p>
                                <p><span class="tags" id="user-status"><?php echo $user->role; ?></span></p>
                                <div class="divider"></div>
                                <div class="divider text-center"></div>
                                <p><strong>Stripe ID</strong></p>
                                <p id="user-role"><?php echo $user->stripe_cust_id; ?></p>
                                <div class="divider"></div>
                                <p><strong>About</strong></p>
                                <div class="col-lg-6 left">
                                    <h4><p style="text-align: center;"><strong
                                                    id="user-globe-rank"><?php echo $user->about; ?> </strong></p></h4>
                                </div>

                            </div>
                            <div class="modal-footer">
                               <span class="pull-right">    
                                    <a href="/user/donations">
                                        <input type="button" class="btn btn-success btn-sm" value="My Donations"/>
                                    </a>
                                    <a href="/auth/logout">
                                        <input type="button" class="btn btn-danger btn-sm" value="Logout"/>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

     