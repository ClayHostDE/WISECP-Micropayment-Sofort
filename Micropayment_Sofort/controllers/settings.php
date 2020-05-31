<?php
    if(!defined("CORE_FOLDER")) die();

    $lang           = $module->lang;
    $config         = $module->config;

    Helper::Load(["Money"]);

    $module_name               = Filter::POST("module_name");
    $access_key               = Filter::POST("access_key");
    $project_name      = Filter::POST("project_name");
	$fixed_fee      = Filter::init("POST/fixed_fee","amount");
	$percentage_fee      = Filter::init("POST/percentage_fee","amount");
	$trial_mode               = Filter::POST("trial_mode");
	$licensekey               = Filter::POST("licensekey");


    $sets           = [];

    if($module_name != $config["settings"]["module_name"])
        $sets["settings"]["module_name"] = $module_name;

    if($access_key != $config["settings"]["access_key"])
        $sets["settings"]["access_key"] = $access_key;

    if($project_name != $config["settings"]["project_name"])
        $sets["settings"]["project_name"] = $project_name;
	
	if($fixed_fee != $config["settings"]["fixed_fee"])
        $sets["settings"]["fixed_fee"] = $fixed_fee;
	
	if($percentage_fee != $config["settings"]["percentage_fee"])
        $sets["settings"]["percentage_fee"] = $percentage_fee;
	
	if($trial_mode != $config["settings"]["trial_mode"])
        $sets["settings"]["trial_mode"] = $trial_mode;
	
	if($licensekey != $config["settings"]["licensekey"])
        $sets["settings"]["licensekey"] = $licensekey;


    if($sets){
        $config_result  = array_replace_recursive($config,$sets);
        $array_export   = Utility::array_export($config_result,['pwith' => true]);

        $file           = dirname(__DIR__).DS."config.php";
        $write          = FileManager::file_write($file,$array_export);

        $adata          = UserManager::LoginData("admin");
        User::addAction($adata["id"],"alteration","changed-payment-module-settings",[
            'module' => $config["meta"]["name"],
            'name'   => $lang["name"],
        ]);
    }

    echo Utility::jencode([
        'status' => "successful",
        'message' => $lang["success1"],
    ]);
