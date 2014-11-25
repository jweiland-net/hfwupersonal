<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA["tx_hfwupersonal_personal"] = array (
	"ctrl" => $TCA["tx_hfwupersonal_personal"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "sys_language_uid,l18n_parent,l18n_diffsource,hidden,starttime,endtime,fe_group,nachname,vorname,titel,beschaeftigtals,funktion1,funktion2,funktion3,funktion4,fachgebiet,fakultaet,studiengang,forschungsgebiet,strasse,strasse2,strasse3,plz,plz2,plz3,ort,ort2,ort3,tel,tel2,tel3,fax,fax2,fax3,email,homepage,www,gebaeude,geschoss,raum,raum2,raum3,sprechzeiten,sprechzeiten2,sprechzeiten3,hochschulrat,hochschulratsort,senat,senatsort,image,imgcaption,sort1,sort2,extlinktext1,extlinktext2,sw"
	),
	"feInterface" => $TCA["tx_hfwupersonal_personal"]["feInterface"],
	"columns" => array (
		't3ver_label' => array (		
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array (
				'type' => 'input',
				'size' => '30',
				'max'  => '30',
			)
		),
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l18n_parent' => array (		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_hfwupersonal_personal',
				'foreign_table_where' => 'AND tx_hfwupersonal_personal.pid=###CURRENT_PID### AND tx_hfwupersonal_personal.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'starttime' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'default'  => '0',
				'checkbox' => '0'
			)
		),
		'endtime' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0',
				'range'    => array (
					'upper' => mktime(0, 0, 0, 12, 31, 2020),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
				)
			)
		),
		'fe_group' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config'  => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		"nachname" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.nachname",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "50",	
				"eval" => "trim",
			)
		),
		"vorname" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.vorname",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "50",	
				"eval" => "trim",
			)
		),
		"titel" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.titel",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "50",	
				"eval" => "trim",
			)
		),
		"beschaeftigtals" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.beschaeftigtals",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "50",	
				"eval" => "trim",
			)
		),
		"funktion1" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.funktion1",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"funktion2" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.funktion2",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"funktion3" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.funktion3",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"funktion4" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.funktion4",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"fachgebiet" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.fachgebiet",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"fakultaet" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.fakultaet",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"studiengang" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.studiengang",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"forschungsgebiet" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.forschungsgebiet",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		'strasse' => array(		
			'exclude' => 1,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.strasse',		
			'config' => array(
				'type' => 'input',	
				'size' => '48',	
				'max' => '50',	
				'eval' => 'trim',
			)
		),
		'strasse2' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.strasse2',		
			'config' => array(
				'type' => 'input',	
				'size' => '48',	
				'max' => '50',
			)
		),
		'strasse3' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.strasse3',		
			'config' => array(
				'type' => 'input',	
				'size' => '48',	
				'max' => '50',
			)
		),
		'plz' => array(		
			'exclude' => 1,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.plz',		
			'config' => array(
				'type' => 'input',	
				'size' => '10',	
				'max' => '10',	
				'eval' => 'trim',
			)
		),
		'plz2' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.plz2',		
			'config' => array(
				'type' => 'input',	
				'size' => '10',	
				'max' => '10',
			)
		),
		'plz3' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.plz3',		
			'config' => array(
				'type' => 'input',	
				'size' => '10',	
				'max' => '10',
			)
		),
		'ort' => array(		
			'exclude' => 1,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.ort',		
			'config' => array(
				'type' => 'input',	
				'size' => '48',	
				'max' => '50',	
				'eval' => 'trim',
			)
		),
		'ort2' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.ort2',		
			'config' => array(
				'type' => 'input',	
				'size' => '48',	
				'max' => '50',
			)
		),
		'ort3' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.ort3',		
			'config' => array(
				'type' => 'input',	
				'size' => '48',	
				'max' => '50',
			)
		),
		'tel' => array(		
			'exclude' => 1,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.tel',		
			'config' => array(
				'type' => 'input',	
				'size' => '48',	
				'max' => '255',	
				'eval' => 'trim',
			)
		),
		'tel2' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.tel2',		
			'config' => array(
				'type' => 'input',	
				'size' => '48',	
				'max' => '255',
			)
		),
		'tel3' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.tel3',		
			'config' => array(
				'type' => 'input',	
				'size' => '48',	
				'max' => '255',
			)
		),
		'fax' => array(		
			'exclude' => 1,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.fax',		
			'config' => array(
				'type' => 'input',	
				'size' => '48',	
				'max' => '255',	
				'eval' => 'trim',
			)
		),
		'fax2' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.fax2',		
			'config' => array(
				'type' => 'input',	
				'size' => '30',
			)
		),
		 'fax3' => array(
                         'exclude' => 0,
                         'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.fax3',
                         'config' => array(
                                 'type' => 'input',
                                 'size' => '30',
				)
                 ),
		"email" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.email",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",	
				"rows" => "3",
			)
		),
		"homepage" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.homepage",		
			"config" => Array (
				"type"     => "input",
				"size"     => "15",
				"max"      => "255",
				"checkbox" => "",
				"eval"     => "trim",
				"wizards"  => array(
					"_PADDING" => 2,
					"link"     => array(
						"type"         => "popup",
						"title"        => "Link",
						"icon"         => "link_popup.gif",
						"script"       => "browse_links.php?mode=wizard",
						"JSopenParams" => "height=300,width=500,status=0,menubar=0,scrollbars=1"
					)
				)
			)
		),
		"www" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.www",		
			"config" => Array (
				"type" => "text",
				"cols" => "40",	
				"rows" => "3",
			)
		),
		"gebaeude" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.gebaeude",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "50",	
				"eval" => "trim",
			)
		),
		"geschoss" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.geschoss",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",	
				"max" => "30",	
				"eval" => "trim",
			)
		),
		"raum" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.raum",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",	
				"max" => "300",	
				"eval" => "trim",
			)
		),
		'raum2' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.raum2',		
			'config' => array(
				'type' => 'input',	
				'size' => '30',
			)
		),
		'raum3' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.raum3',		
			'config' => array(
				'type' => 'input',	
				'size' => '30',
			)
		),
		'sprechzeiten' => array(		
			'exclude' => 1,		
			'label' => 'LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.sprechzeiten',		
			'config' => array(
				'type' => 'text',
				'cols' => '48',	
				'rows' => '5',
			)
		),
		"sprechzeiten2" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.sprechzeiten2",		
			"config" => Array (
				"type" => "text",
				"cols" => "48",	
				"rows" => "5",
			)
		),
		"sprechzeiten3" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.sprechzeiten3",		
			"config" => Array (
				"type" => "text",
				"cols" => "48",	
				"rows" => "5",
			)
		),
		"hochschulrat" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.hochschulrat",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "50",	
				"eval" => "trim",
			)
		),
		"hochschulratsort" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.hochschulratsort",		
			"config" => Array (
				"type"     => "input",
				"size"     => "4",
				"max"      => "4",
				"eval"     => "int",
				"checkbox" => "0",
				"range"    => Array (
					"upper" => "1000",
					"lower" => "0"
				),
				"default" => 0
			)
		),
		"senat" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.senat",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "50",	
				"eval" => "trim",
			)
		),
		"senatsort" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.senatsort",		
			"config" => Array (
				"type"     => "input",
				"size"     => "4",
				"max"      => "4",
				"eval"     => "int",
				"checkbox" => "0",
				"range"    => Array (
					"upper" => "1000",
					"lower" => "0"
				),
				"default" => 0
			)
		),
		"image" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.image",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "50",	
				"eval" => "trim",
			)
		),
		"imgcaption" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.imgcaption",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"sort1" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.sort1",		
			"config" => Array (
				"type"     => "input",
				"size"     => "4",
				"max"      => "4",
				"eval"     => "int",
				"checkbox" => "0",
				"range"    => Array (
					"upper" => "1000",
					"lower" => "0"
				),
				"default" => 0
			)
		),
		"sort2" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.sort2",		
			"config" => Array (
				"type"     => "input",
				"size"     => "4",
				"max"      => "4",
				"eval"     => "int",
				"checkbox" => "0",
				"range"    => Array (
					"upper" => "1000",
					"lower" => "0"
				),
				"default" => 0
			)
		),
		"extlinktext1" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.extlinktext1",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"extlinktext2" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.extlinktext2",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"sw" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_personal.sw",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_hfwupersonal_sw",	
				"foreign_table_where" => "AND tx_hfwupersonal_sw.pid=###CURRENT_PID### ORDER BY tx_hfwupersonal_sw.sw",	
				"size" => 10,	
				"minitems" => 0,
				"maxitems" => 20,	
				"MM" => "tx_hfwupersonal_personal_sw_mm",	
				"wizards" => Array(
					"_PADDING" => 2,
					"_VERTICAL" => 1,
					"add" => Array(
						"type" => "script",
						"title" => "Create new record",
						"icon" => "add.gif",
						"params" => Array(
							"table"=>"tx_hfwupersonal_sw",
							"pid" => "###CURRENT_PID###",
							"setValue" => "prepend"
						),
						"script" => "wizard_add.php",
					),
					"list" => Array(
						"type" => "script",
						"title" => "List",
						"icon" => "list.gif",
						"params" => Array(
							"table"=>"tx_hfwupersonal_sw",
							"pid" => "###CURRENT_PID###",
						),
						"script" => "wizard_list.php",
					),
					"edit" => Array(
						"type" => "popup",
						"title" => "Edit",
						"script" => "wizard_edit.php",
						"popup_onlyOpenIfSelected" => 1,
						"icon" => "edit2.gif",
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
				),
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource, hidden;;1, nachname, vorname, titel, beschaeftigtals, funktion1, funktion2, funktion3, funktion4, fachgebiet, fakultaet, studiengang, forschungsgebiet, strasse, strasse2, strasse3, plz, plz2, plz3, ort, ort2, ort3, tel, tel2, tel3, fax, fax2, fax3,  email, homepage, www, raum, raum2, raum3, sprechzeiten, sprechzeiten2, sprechzeiten3, hochschulrat, hochschulratsort, senat, senatsort, image, imgcaption, sort1, sort2, extlinktext1, extlinktext2, sw")
	),
	"palettes" => array (
		"1" => array("showitem" => "starttime, endtime, fe_group")
	)
);



$TCA["tx_hfwupersonal_sw"] = array (
	"ctrl" => $TCA["tx_hfwupersonal_sw"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,starttime,endtime,fe_group,sw,swen"
	),
	"feInterface" => $TCA["tx_hfwupersonal_sw"]["feInterface"],
	"columns" => array (
		't3ver_label' => array (		
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array (
				'type' => 'input',
				'size' => '30',
				'max'  => '30',
			)
		),
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'starttime' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'default'  => '0',
				'checkbox' => '0'
			)
		),
		'endtime' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'  => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0',
				'range'    => array (
					'upper' => mktime(0, 0, 0, 12, 31, 2020),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
				)
			)
		),
		'fe_group' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config'  => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		"sw" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_sw.sw",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "required,trim",
			)
		),
		"swen" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:hfwupersonal/locallang_db.xml:tx_hfwupersonal_sw.swen",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, sw, swen")
	),
	"palettes" => array (
		"1" => array("showitem" => "starttime, endtime, fe_group")
	)
);
?>
