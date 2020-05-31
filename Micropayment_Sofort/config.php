<?php 
return [
    'meta'     => [
        'name'    => 'Micropayment Sofort',
        'version' => '1.0',
        'logo'    => 'logo.svg',
		'description' => 'SOFORT (ehemals Sofort Überweisung) gehört in Deutschland zu den bekanntesten Zahlungsmethoden und kombiniert die klassische Online Überweisung mit den Vorteilen eines Echtzeitzahlungssystems. Unser Zahlungsgateway für SOFORT über den Zahlungsdienstanbieter Micropayment bietet Ihnen die Möglichkeit Ihren Kunden diese bequeme Art des Zahlens anbieten zu können.',
    ],
    'settings' => [
        'module_name'                => 'Sofort Überweisung',
		'access_key'                => '',
		'project_name'				=> '',
		'fixed_fee' => 0.25,
		'percentage_fee' => 2.9,
		'trial_mode' => 'off',
		'licensekey' => '',
    ],
];
