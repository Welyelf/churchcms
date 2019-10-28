<div class='maincontent'>
    <div class="title">Plan Details</div>
    <div class="content-divider"></div>
    <form method="post">
        <div style="width:80%; margin: 0 auto;">
            <ul>
                <li class="pull-left plan-details">
                    <ul class="inclusions">
                        <li>50 viewer hours per week</li>
                        <li>30 minutes of service transcription per week</li>
                        <li>Uploading of sermons on youtube</li>
                        <li>FREE CMS and Hosting with Online Donations through stripe</li>
                    </ul>
                    <br/><br/>
                </li>
                <li class="pull-left width-20">&nbsp;</li>
                <li class="pull-right plan-total">
                    <h2>$ 150.00/mo.</h2>
                </li>
                <li class="pull-left clear plan-details">
                    <p><strong>Have longer service?</strong> or a mid-week service that also needs transcription? Add
                        additional transcription time for $2.60 per month per minute of weekly service time.</p>
                    <br/><br/><br/>
                </li>
                <li class="pull-left plan-qty">
                    <div class="input-group">
                        <input type="number" class="form-control" step="1" min="0" name="plans[additional_minutes]"
                               id="plan-additional_minutes" value="0" onkeyup="updateAmt('additional_minutes');"
                               onclick="updateAmt('additional_minutes');"/>
                        <br/><label>Minutes/Week</label>
                    </div>
                </li>
                <li class="pull-right plan-total">
                    <h2>$ <span id="plan-additional_minutes-total">0.00</span>/mo.</h2>
                </li>
                <li class="pull-left clear plan-details">
                    <p><strong>Need more viewer hours per week?</strong> Add additional viewer hours for only $25.00 per
                        month per block of 50 viewer hours.</p>
                    <br/><br/>
                </li>
                <li class="pull-left plan-qty">
                    <div class="input-group">
                        <input type="number" class="form-control" step="1" min="0" name="plans[additional_viewer_hours]"
                               id="plan-additional_viewer_hours" value="0"
                               onkeyup="updateAmt('additional_viewer_hours');"
                               onclick="updateAmt('additional_viewer_hours');"/>
                        <br/><label>Blocks/Week</label>
                    </div>
                </li>
                <li class="pull-right plan-total">
                    <h2>$ <span id="plan-additional_viewer_hours-total">0.00</span>/mo.</h2>
                </li>
                <li class="pull-left clear width-50">
                    &nbsp;
                </li>
                <li class="pull-left width-20">
                    &nbsp;
                </li>
                <li class="pull-right plan-total">
                    <button class="headingbutton" id="donateNow" type="button">Pay $ <span
                                id="overall-total2">150.00</span> Monthly
                    </button>
                </li>
            </ul>
        </div>
        <br/>
        <br/>
        <!--<input type="number" class="form-control" value="<?php //echo number_format($plan->amount,2); ?>" disabled />-->
        <input type="hidden" class="form-control" id="amt" value="0.00">
        <input type="hidden" class="form-control" step="1" min="0" name="plans[base_plan]" id="plan-base_plan" value="1"
               onkeyup="updateAmt('base_plan');" onclick="updateAmt('base_plan');"/>
    </form>
</div>
