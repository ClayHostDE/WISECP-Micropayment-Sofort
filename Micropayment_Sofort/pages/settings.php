<?php
    if(!defined("CORE_FOLDER")) die();
    $LANG           = $module->lang;
    $CONFIG         = $module->config;
    $callback_url   = Controllers::$init->CRLink("payment",['Micropayment_Sofort',$module->get_auth_token(),'callback']);
    $success_url    = Controllers::$init->CRLink("pay-successful");
    $failed_url     = Controllers::$init->CRLink("pay-failed");
?>
<form action="<?php echo Controllers::$init->getData("links")["controller"]; ?>" method="post" id="Micropayment_Sofort">
    <input type="hidden" name="operation" value="module_controller">
    <input type="hidden" name="module" value="Micropayment_Sofort">
    <input type="hidden" name="controller" value="settings">

    <div class="blue-info" style="margin-bottom:20px;">
        <div class="padding15">
            <i class="fa fa-info-circle" aria-hidden="true"></i>
            <p><?php echo $LANG["description"]; ?></p>
        </div>
    </div>
	
	<div class="formcon">
        <div class="yuzde30"><?php echo $LANG["licensekey"]; ?></div>
        <div class="yuzde70">
            <input type="text" name="licensekey" value="<?php echo $CONFIG["settings"]["licensekey"]; ?>" style="width: 80px;">
        </div>
    </div>

    <div class="formcon">
        <div class="yuzde30"><?php echo $LANG["module_name"]; ?></div>
        <div class="yuzde70">
            <input type="text" name="module_name" value="<?php echo $CONFIG["settings"]["module_name"]; ?>">
        </div>
    </div>

    <div class="formcon">
        <div class="yuzde30"><?php echo $LANG["access_key"]; ?></div>
        <div class="yuzde70">
            <input type="text" name="access_key" value="<?php echo $CONFIG["settings"]["access_key"]; ?>">
        </div>
    </div>

    <div class="formcon">
        <div class="yuzde30"><?php echo $LANG["project_name"]; ?></div>
        <div class="yuzde70">
            <input type="text" name="project_name" value="<?php echo $CONFIG["settings"]["project_name"]; ?>" style="width: 80px;">
        </div>
    </div>
	
	<div class="formcon">
        <div class="yuzde30"><?php echo $LANG["fixed_fee"]; ?></div>
        <div class="yuzde70">
            <input type="text" name="fixed_fee" value="<?php echo $CONFIG["settings"]["fixed_fee"]; ?>" style="width: 80px;">
        </div>
    </div>
	
	<div class="formcon">
        <div class="yuzde30"><?php echo $LANG["percentage_fee"]; ?></div>
        <div class="yuzde70">
            <input type="text" name="percentage_fee" value="<?php echo $CONFIG["settings"]["percentage_fee"]; ?>" style="width: 80px;">
        </div>
    </div>
	
	<div class="formcon">
        <div class="yuzde30"><?php echo $LANG["trial_mode"]; ?></div>
        <div class="yuzde70">
            <input type="checkbox" name="trial_mode" value="<?php echo $CONFIG["settings"]["trial_mode"]; ?>" style="width: 80px;">
        </div>
    </div>
	
	<div class="formcon">
        <div class="yuzde30"><?php echo $LANG["payment_module_version"]; ?></div>
        <div class="yuzde70">
			<span style="font-size:13px;font-weight:600;" class="selectalltext"><?php echo $CONFIG["meta"]["version"]; ?></span>
        </div>
    </div>

    
    <div class="formcon">
        <div class="yuzde30">Callback URL</div>
        <div class="yuzde70">
            <span style="font-size:13px;font-weight:600;" class="selectalltext"><?php echo $callback_url; ?></span>
        </div>
    </div>

    <div class="formcon">
        <div class="yuzde30">Success URL</div>
        <div class="yuzde70">
            <span style="font-size:13px;font-weight:600;" class="selectalltext"><?php echo $success_url; ?></span>
        </div>
    </div>

    <div class="formcon">
        <div class="yuzde30">Failed URL</div>
        <div class="yuzde70">
            <span style="font-size:13px;font-weight:600;" class="selectalltext"><?php echo $failed_url; ?></span>
        </div>
    </div>


    <div style="float:right;" class="guncellebtn yuzde30"><a id="Micropayment_Sofort_submit" href="javascript:void(0);" class="yesilbtn gonderbtn"><?php echo $LANG["save-button"]; ?></a></div>

</form>


<script type="text/javascript">
    $(document).ready(function(){

        $("#Micropayment_Sofort_submit").click(function(){
            MioAjaxElement($(this),{
                waiting_text:waiting_text,
                progress_text:progress_text,
                result:"Micropayment_Sofort_handler",
            });
        });

    });

    function Micropayment_Sofort_handler(result){
        if(result != ''){
            var solve = getJson(result);
            if(solve !== false){
                if(solve.status == "error"){
                    if(solve.for != undefined && solve.for != ''){
                        $("#Micropayment_Sofort "+solve.for).focus();
                        $("#Micropayment_Sofort "+solve.for).attr("style","border-bottom:2px solid red; color:red;");
                        $("#Micropayment_Sofort "+solve.for).change(function(){
                            $(this).removeAttr("style");
                        });
                    }
                    if(solve.message != undefined && solve.message != '')
                        alert_error(solve.message,{timer:5000});
                }else if(solve.status == "successful"){
                    alert_success(solve.message,{timer:2500});
                }
            }else
                console.log(result);
        }
    }
</script>
<span>Payment Gateway Developed by <a href="https://clayhost.de" target="_blank"><b>ClayHost</b></a> | Developed with <i class="fa fa-heart" style="color: red;"></i></span>