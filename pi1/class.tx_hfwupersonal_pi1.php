<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2007 Stephan Schlegel <stephan.schlegel@hfwu.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

// Todos:
// Clean up results from database (stripslashes etc.)

require_once(PATH_tslib.'class.tslib_pibase.php');

/**
 * Plugin 'HfWU Personnel ' for the 'hfwupersonal' extension.
 *
 * @author      Stephan Schlegel <stephan.schlegel@hfwu.de>
 * @package     TYPO3
 * @subpackage  tx_hfwupersonal
 */
class tx_hfwupersonal_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_hfwupersonal_pi1';             // Same as class name
	var $scriptRelPath = 'pi1/class.tx_hfwupersonal_pi1.php';       // Path to this script relative to the extension dir.
	var $extKey        = 'hfwupersonal';    // The extension key.
	var $pi_checkCHash = true;

	var $pidList;           // Page ID(s) to look for data in
	var $pidSingle; // Page ID for single View
	var $conf;                      // the TypoScript configuration array
	//var $flexConf;                // Configuration array from Flexform
	var $cObj;                      // The backReference to the mother cObj object set at call time
	var $swList;    // Pages where the keywords are
	var $imgPath;   // Path to the images
	var $dummyImage; // Image to show if no Image is available for the data
	var $sortKey1;
	var $sortKey2;
	var $filter1;
	var $filter2;
	var $userID;          // current UID of user logged in (0 = no user logged in)
	var $userName;          // user name for any logged in user
	var $templateCode;      // template code
	//var $theCode;         // current function to do
	var $responseMsg;       // any response message put at top
	var $dbFields;          // database fields to read in
	var $dbShowFields;      // database fields to show

	/**
	 * Initialize the Plugin
	 *
	 * @param       array $conf: The PlugIn configuration
	 * @return      nothing
	 */
	function init($conf) {
		if (!$this->cObj) $this->cObj = t3lib_div::makeInstance('tslib_cObj');
		//debug($this->cObj);
		//-----------------------------------------------------------------
		// Initialize all class and global variables
		//-----------------------------------------------------------------
		$this->conf = $conf;                            // TypoScript configuration
		$this->pi_setPiVarDefaults();           // GetPut-parameter configuration
		$this->pi_initPiflexForm();                     // Initialize the FlexForms array
		$this->pi_loadLL();                                     // localized language variables
		$GLOBALS["TSFE"]->set_no_cache();       // this is needed for the search of the 'campusapp' to work
		//set this for debugging, but turn it off when go to beta test
		//$this->pi_USER_INT_obj = 1;             // configure so caching not expected

		// TYPOSCRIPT VALUES
		$marker = array();
		$mySubparts = array();
		$this->imgPath = $conf["imgPath"]; // Path where the Pictures are stored
		$this->swList = $conf["swList"]; //Pages where the Keywords are
		$this->dummyImage = $conf["dummyImage"]; //Image to use if no Image is available (with Path)
		$this->templateFile = $conf["templateFile"]; //Template File (if nothing selected in Form)
		$this->pidList = $conf["pidList"]; // Pages to look for the Stuff is stored

		// FLEXFORM VALUES
		//debug($this->cObj->data['pi_flexform']);

		$this->flexConf['storagePID']   = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'storagePID', 'sDEF');
		$this->flexConf['theCode']      = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'theCode');
		$this->flexConf['template']     = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'template');
		$this->flexConf['singlePID']    = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'singlePID');

		$this->flexConf['sortKey1']     = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'sortKey1', 'sSortkeys');
		$this->flexConf['sortKey2']     = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'sortKey2', 'sSortkeys');
		$this->flexConf['sortKey3']     = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'sortKey3', 'sSortkeys');

		$this->flexConf['filter1']      = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'filter1', 'sFilter');
		$this->flexConf['filter2']      = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'filter2', 'sFilter');
		$this->flexConf['filter3']      = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'filter3', 'sFilter');

		$this->flexConf['name'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'name','sSingle');
		$this->flexConf['surname'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'surname','sSingle');
		$this->flexConf['uid']  = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'uid','sSingle');

		$this->flexConf['nameCheck'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'nameCheck','sSearch');
		$this->flexConf['functionCheck'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'functionCheck','sSearch');
		$this->flexConf['activityCheck'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'activityCheck','sSearch');


		// DATABASE FIELDS to retrieve, show and use in form
		// Fields to read from DB (personal)
		$this->dbFields = array('tx_hfwupersonal_personal.uid AS myUid','nachname','vorname','titel','beschaeftigtals','funktion1','funktion2','funktion3','funktion4','fachgebiet','fakultaet','studiengang','forschungsgebiet','strasse','strasse2','strasse3','plz','plz2','plz3','ort','ort2','ort3','tel','tel2','tel3','fax','fax2','fax3','email','homepage','www','gebaeude','geschoss','raum','raum2','raum3','sprechzeiten','sprechzeiten2','sprechzeiten3','hochschulrat','hochschulratsort','senat','senatsort','image','imgcaption','sort1','sort2','extlinktext1','extlinktext2');
		$this->selectClause = '';
		foreach ($this->dbFields as $key => $value){
			$this->selectClause.=$value.', ';
		}
		$this->selectClause = rtrim(rtrim( $this->selectClause),',');
		// Fields to read and show in Frontend (Markers)
		$this->dbShowFields = array('myUid','nachname','vorname','titel','beschaeftigtals','fachgebiet','fakultaet','studiengang','forschungsgebiet','strasse','strasse2','strasse3','plz','plz2','plz3','ort','ort2','ort3','tel','tel2','tel3','fax','fax2','fax3','email','www','gebaeude','geschoss','raum','raum2','raum3','sprechzeiten','sprechzeiten2','sprechzeiten3','hochschulrat','senat','imgcaption','extlinktext1','extlinktext2','funktion1','funktion2','funktion3','funktion4');

		// initialize class variables
		//$this->isAdministrator = 0;
		//$this->userID = 0;
		//$this->userName = "";
		//$this->theCode = 'LIST';

		//-----------------------------------------------------------------
		// Load & Process Incoming Vars -- GET/POST and Form
		//-----------------------------------------------------------------
		// SECURITY FOR ALL INCOMING VARS
		if ($this->piVars) {
			foreach ($this->piVars as $key => $value)
			$this->piVars[$key] = htmlspecialchars(stripslashes($value));
		}
		//debug($this->piVars);

		// DEFINE SINGLE PAGE
		if ($this->flexConf['singlePID'])       // flexform
		$this->pidSingle = $this->flexConf['singlePID'];
		else if ($this->conf['pidSingle']) // or TS
		$this->pidSingle = $this->conf['pidSingle'];
		else // or actual page
		$this->pidSingle = $GLOBALS['TSFE']->id;
		// Set Display Mode

		// DEFINE VIEW MODE
		if ($this->flexConf['theCode']) // value from Flexform
		$this->theCode = $this->flexConf['theCode'];
		// if there is a showUid Object...
		if ($this->piVars['showUid']){ //if Page is called with showUid Var as Param
			$sendCObj=intval($this->piVars['sendCObj']);
			// Show only if Element is sender of the Link or flexForm says Single Mode
			if ($sendCObj == $this->cObj->data['uid'] || $this->flexConf['theCode']== 'SINGLE'){
				$this->theCode = 'SINGLE';
			}
		}
		//else $this->theCode = 'LIST';
		//debug ($this->theCode);

		// STORAGE PAGES
		// set up the storage pid...if defined
		if ($this->flexConf['storagePID'])      // can specify in flexform
		$this->pidList = $this->flexConf['storagePID'];
		else if ($this->pidList)        // or specify in TypoScript
		$this->pidList = $this->pidList;
		else                                                                          // the default is the current page
		$this->pidList = $GLOBALS['TSFE']->id;

		// TEMPLATE CODE
		// Wenn Flextemplate dann Code aus diesem, sonst aus TS
		$this->templateCode = $this->cObj->fileResource($this->flexConf['template'] ? "uploads/tx_".$this->extKey."/".$this->flexConf['template'] : $this->templateFile);

		// Set DEFAULT USER INFO if logged in
		//		if ($GLOBALS["TSFE"]->loginUser) {
		//			$this->userID = $GLOBALS["TSFE"]->fe_user->user['uid'];
		//			$this->userName = $GLOBALS["TSFE"]->fe_user->user['username'];
		//		}

	}


	/**
	 * Handles main actions
	 *
	 * @param       string          $content: The PlugIn content
	 * @param       array           $conf: The PlugIn configuration
	 * @return      The content that is displayed on the website
	 */
	function main($content,$conf)   {
		$this->init($conf);
		//debug($this->flexConf['theCode']);
		switch ($this->theCode) {
			case 'SINGLE':
				$content = $this->displaySingle();
				break;

			case 'SELECT':
				$content = $this->displaySelect();
				break;

			case 'SEARCH':
				$content = $this->displaySearch();
				break;

			case 'PROCESSFORM':
				$content = $this->processForm();
				break;

			case 'SHOWFORM':
				$content = $this->showForm();
				break;

			case 'ADMIN':
				$content = $this->adminMenu();
				break;

			case 'LIST':
				$content = $this->displayList();
				break;

			default:
				$content = $this->displayList();
		}
		//ergebnis AUSGEBEN und in Klasse Wrappen
		return $this->pi_wrapInBaseClass($content);
	}


	/**
	 * Generates a Search Form in Frontend after submitting the query the List Output will be
	 * generatet after the Seachr Form
	 * @param       none
	 * @return      $content
	 */
	function displaySearch(){
		//debug($this->piVars);
		//debug(t3lib_div::_POST());
		$arrSearch=t3lib_div::_POST();
		$selectClause = $this->selectClause;
		$fromClause = 'tx_hfwupersonal_personal';
		$whereClause = 'tx_hfwupersonal_personal.deleted="0" AND tx_hfwupersonal_personal.hidden="0" AND tx_hfwupersonal_personal.pid IN ('.$this->pidList.')';
		$orderByClause = 'tx_hfwupersonal_personal.nachname ASC';
		$url=$this->pi_getPageLink($GLOBALS["TSFE"]->id);
		$content = '';

		// Suche nach Nachname
		if($this->flexConf['nameCheck']){
			$content .= 'Suche nach dem Nachnamen <br />';
			$content .= '<form method="POST" action="'.$url.'" >';
			$content .= '<input name="searchName" value="" type="text">';
			$content .= '<input type="submit" />';
			$content .= '</form>';
		}
		// Suche nach Funktion
		if($this->flexConf['functionCheck']){
			$content .= 'Suche nach Funktion des Ansprechpartners <br />';
			$content .= '<form method="POST" action="'.$url.'" >';
			$content .= '<input name="searchFunction" value="" type="text">';
			$content .= '<input type="submit" />';
			$content .= '</form>';
		}
		// Suche nach Fakult�t
		if($this->flexConf['activityCheck']){
			$content .= 'Suche im Fachgebiet<br />';
			$content .= '<form method="POST" action="'.$url.'" >';
			$content .= '<input name="searchActivity" value="" type="text">';
			$content .= '<input type="submit" />';
			$content .= '</form>';
		}


		// if there is a search value then generate a query
		if ($arrSearch['searchName']||$arrSearch['searchFunction']||$arrSearch['searchActivity']){
			if ($arrSearch['searchName'])
			$whereClause .= ' AND (tx_hfwupersonal_personal.nachname LIKE("%'.$arrSearch['searchName'].'%") OR (tx_hfwupersonal_personal.email LIKE("%'.$arrSearch['searchName'].'%")))';
			else if ($arrSearch['searchFunction'])
			$whereClause .= ' AND (tx_hfwupersonal_personal.funktion1 LIKE("%'.$arrSearch['searchFunction'].'%") OR tx_hfwupersonal_personal.funktion2 LIKE("%'.$arrSearch['searchFunction'].'%") OR tx_hfwupersonal_personal.funktion3 LIKE("%'.$arrSearch['searchFunction'].'%") OR tx_hfwupersonal_personal.funktion4 LIKE("%'.$arrSearch['searchFunction'].'%"))';
			else if($arrSearch['searchActivity'])
			$whereClause .= ' AND tx_hfwupersonal_personal.fachgebiet LIKE("%'.$arrSearch['searchActivity'].'%")';
			//debug($whereClause);
			$res=$GLOBALS["TYPO3_DB"]->exec_SELECTquery($selectClause,$fromClause,$whereClause,'',$orderByClause);
			$numrows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
			/*
			 while ($results = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			 echo "<pre>"; print_r($results); echo "</pre>";
			 }
			 */
			//$content .= $this->createOutput($res,'HFWUPERSONAL');
			if($numrows>0) $content.=$this->createOutput($res,'HFWUPERSONAL');
			else $content .= "<div class=\"noresult\"><h1>Kein Suchergebnis!</h1></div>";
		}
		return $content;
	}

	/**
	 * displaySingle()
	 * shows a single Entry after Clicking on an Item in List View
	 * todo check if there is a singleMode Plugin or if there are more then one
	 * @param       none
	 * @param       $tmplPart: Name of the appropriate template     subpart without ###
	 * @return      $content
	 */
	function displaySingle(){
		$myUid=intval($this->piVars['showUid']);
		$content = '';
		// Query
		$selectClause = $this->selectClause;
		$fromClause = 'tx_hfwupersonal_personal';
		$whereClause = 'tx_hfwupersonal_personal.uid = '.$myUid.' AND tx_hfwupersonal_personal.deleted="0" AND tx_hfwupersonal_personal.hidden="0" AND tx_hfwupersonal_personal.pid IN ('.$this->pidList.')';
		$res=$GLOBALS["TYPO3_DB"]->exec_SELECTquery($selectClause,$fromClause,$whereClause,$orderByClause);

		$content=$this->createOutput($res,'HFWUPERSONALSINGLE');
		return $content;
	}


	/**
	 * Uses the Manual Selext Sheet to generate a Single Entry
	 *
	 * @param       none
	 * @return      $content
	 */

	function displaySelect(){
		$selectClause =  $this->selectClause;
		$fromClause = 'tx_hfwupersonal_personal';
		$whereClause = 'tx_hfwupersonal_personal.deleted="0" AND tx_hfwupersonal_personal.hidden="0" AND tx_hfwupersonal_personal.pid IN ('.$this->pidList.')';
		if ($this->flexConf['name']){
			$myVal = htmlspecialchars(stripslashes($this->flexConf['name']));
			$whereClause .= ' AND tx_hfwupersonal_personal.nachname LIKE("%'.$myVal.'%")';
		}
		if ($this->flexConf['surname']){
			$myVal = htmlspecialchars(stripslashes($this->flexConf['surname']));
			$whereClause .= ' AND tx_hfwupersonal_personal.vorname LIKE("%'.$myVal.'%")';
		}
		if ($this->flexConf['uid']){
			$myVal = intval($this->flexConf['uid']);
			$whereClause .= ' AND tx_hfwupersonal_personal.uid ='.$myVal;
		}
		$res=$GLOBALS["TYPO3_DB"]->exec_SELECTquery($selectClause,$fromClause,$whereClause);
		$content=$this->createOutput($res,'HFWUPERSONALSINGLE');
		return $content;
	}


	/**
	 * Uses the Sort Fields and Filter Fields in Flexform to generate the List
	 *
	 * @param       none
	 * @return      $content
	 */

	function displayList(){
		### DATENBANK ABFRAGEN ###
		$selectClause = $this->selectClause;

		// Todo Select Clause & Abfragen optimieren
		// ORDER BY with parameters from flexform
		if(($this->flexConf['sortKey1']!='noSort')||($this->flexConf['sortKey1']='')){
			$orderByClause = "tx_hfwupersonal_personal.".$this->flexConf['sortKey1']." ASC";
			if (($this->flexConf['sortKey2']!='noSort')||($this->flexConf['sortKey2']='')){
				$orderByClause .= ',tx_hfwupersonal_personal.'.$this->flexConf['sortKey2'].' ASC';
				if (($this->flexConf['sortKey3']!='noSort')||($this->flexConf['sortKey3']='')){
					$orderByClause .= ',tx_hfwupersonal_personal.'.$this->flexConf['sortKey3'].' ASC';
				}
			}
		}else{
			$orderByClause = 'tx_hfwupersonal_personal.nachname ASC';
		}
		//debug($orderByClause);


		$whereClause = '';
		// Any Filter ?
		if ($this->flexConf['filter1']||$this->flexConf['filter2']||$this->flexConf['filter3']){
			### Query for OR ###
			if ($this->flexConf['filter1']){
				$whereClause = ' AND tx_hfwupersonal_personal_sw_mm.uid_foreign IN('.$this->flexConf['filter1'].') ';
			}
			$whereClause = $whereClause.'AND tx_hfwupersonal_personal.deleted="0" AND tx_hfwupersonal_personal.hidden="0" AND tx_hfwupersonal_personal.pid IN ('.$this->pidList.')';
			$res=$GLOBALS["TYPO3_DB"]->exec_SELECT_mm_query($selectClause,'tx_hfwupersonal_personal','tx_hfwupersonal_personal_sw_mm','tx_hfwupersonal_sw',$whereClause,'',$orderByClause);

			### Queries for AND ###
			if ($this->flexConf['filter2']){
				//$andArr contains all the uids of the Keywords
				$andArr = explode(',',$this->flexConf['filter2']);
				//For every Keyword we take the result of the prev Query and shrink it with next query/keyword
				foreach ($andArr as $mySW) {
					// Make a String of this kind with the ids of the Person uids: (1,2,4,6)
					$myPersons = '(';
					while ($row = $GLOBALS["TYPO3_DB"]->sql_fetch_assoc($res)){
						//$myPersons .= $row["uid_local"].',';
						$myPersons .= $row["myUid"].',';
					}
					$myPersons = rtrim ( $myPersons,',').')';
					$whereClause = ' AND tx_hfwupersonal_personal_sw_mm.uid_local IN '.$myPersons.' AND tx_hfwupersonal_personal_sw_mm.uid_foreign ='.$mySW.' ';
					$res=$GLOBALS["TYPO3_DB"]->exec_SELECT_mm_query($selectClause,'tx_hfwupersonal_personal','tx_hfwupersonal_personal_sw_mm','tx_hfwupersonal_sw',$whereClause,'',$orderByClause);
				}
			}
			### Queries for AND NOT ###
			if ($this->flexConf['filter3']){
				$andArr = explode(',',$this->flexConf['filter3']);
				// First our last result in a List of the form (1,2,3)
				$allPersons = '(';
				// Build List of all
				while ($row = $GLOBALS["TYPO3_DB"]->sql_fetch_assoc($res)){
					$allPersons .= $row["myUid"].',';
				}
				$allPersons = rtrim ( $allPersons,',').')';
				// Find the Persons which FIT (as in OR) just to exclude them later...
				$whereClause = ' AND tx_hfwupersonal_personal_sw_mm.uid_foreign IN('.$this->flexConf['filter3'].') ';
				$whereClause = $whereClause.'AND tx_hfwupersonal_personal.deleted="0" AND tx_hfwupersonal_personal.hidden="0" AND tx_hfwupersonal_personal.pid IN ('.$this->pidList.')';
				$resNot=$GLOBALS["TYPO3_DB"]->exec_SELECT_mm_query($selectClause,'tx_hfwupersonal_personal','tx_hfwupersonal_personal_sw_mm','tx_hfwupersonal_sw',$whereClause,'',$orderByClause);
				// and Store them in $notPersons
				$notPersons = '(';
				while ($row = $GLOBALS["TYPO3_DB"]->sql_fetch_assoc($resNot)){
					$notPersons .= $row["myUid"].',';
				}
				$notPersons = rtrim ( $notPersons,',').')';
				// Last step is to find Persons in allPersons and NOT in notPersons
				$whereClause = ' tx_hfwupersonal_personal.uid IN '.$allPersons.' AND tx_hfwupersonal_personal.uid NOT IN '.$notPersons.' ';
				$res=$GLOBALS["TYPO3_DB"]->exec_SELECTquery($selectClause,'tx_hfwupersonal_personal',$whereClause,'',$orderByClause);
			}
		} else {
			$whereClause = 'tx_hfwupersonal_personal.deleted="0" AND tx_hfwupersonal_personal.hidden="0" AND tx_hfwupersonal_personal.pid IN ('.$this->pidList.')';
			$res=$GLOBALS["TYPO3_DB"]->exec_SELECTquery($selectClause,'tx_hfwupersonal_personal',$whereClause,'',$orderByClause);
		}

		### Template füllen und Seitenausgabe erzeugen ### 
		$content=$this->createOutput($res,'HFWUPERSONAL');
		return $content;
	}



	/**
	 * is called after most display Functions to generate the Content
	 *
	 * @param       resource $res: resource id from db-query
	 * @param       $tmplPart: Name of the appropriate template     subpart without ###
	 * @return      $content
	 */

	function createOutput($res,$tmplPart) {
		### TEMPLATE fuellen und Seitenausgabe erzeugen ###
		$innerContent = '';
		$innerContentB = '';
		$myEntry = '';
		$tmplPart = '###'.strtoupper($tmplPart).'###';
		$tmpl = $this->templateCode;
		//debug($tmpl);
		//get outer subpart and throw away the rest
		$tmpl = $this->cObj->getSubpart($tmpl,$tmplPart);
		if($this->cObj->getSubpart($tmpl,"###HFWUPERSONALENTRYB###")) $tmpl_entryb = $this->cObj->getSubpart($tmpl,"###HFWUPERSONALENTRYB###");
		if($this->cObj->getSubpart($tmpl,"###HFWUPERSONALENTRYC###")) $tmpl_entryc = $this->cObj->getSubpart($tmpl,"###HFWUPERSONALENTRYC###");
		//echo "<pre>-->"; print_r($tmpl_entryc); echo "<--</pre>";

		while ($row = $GLOBALS["TYPO3_DB"]->sql_fetch_assoc($res)) {
//			echo "<pre>";
//			print_r($row);
//			echo "</pre>";
			$tmpl_entry = $this->cObj->getSubpart($tmpl, "###HFWUPERSONALENTRY###");
			// Loop throug the DB-Fields and create the appropriate MARKER Array
			//debug($row);
			$checkFields = array();
			foreach($this->dbShowFields as $myField){
				$marker['###'.strtoupper($myField).'###'] = $row[$myField];
				$checkFields[$myField] = $myField;
			}
			$checkPh2 = $marker['###TEL2###'];
			$checkPh3 = $marker['###TEL3###'];
			
			// Some special markers
			// FUNCTION
			$flag = 0;
			$funktion = '';
			if($row['funktion1']) {
				$funktion .= $row['funktion1'];
				$flag++;
				}
			if($row['funktion2']) {
				$funktion .= '<br />'.$row['funktion2'];
				$flag++;
				}
			if($row['funktion3']) {
				$funktion .= '<br />'.$row['funktion3'];
				$flag++;
				}
			if($row['funktion4']) {
				$funktion .= '<br />'.$row['funktion4'];
				$flag++;
				}
			$marker["###FUNKTION###"] = $funktion;
			if($flag > 1) $marker["###function###"] = "Funktionen";
			else $marker["###function###"] = "Funktion";

			// PICTURE
			$iconf = array();

			if ($this->cObj->fileResource($this->imgPath.$row["image"])){
				$iconf ['file'] = $this->imgPath.$row["image"];
			} else {
				$iconf ['file'] = $this->dummyImage;
			}
			$iconf['file.']['width'] = 105;

			//debug($iconf);
			$marker["###IMAGE###"] = $this->cObj->IMAGE($iconf);

			// EMAIL
			// Link Konfiguration (uses stdWrap Functionality)
			// Todo Put Konfiguration in internal TS evt. sch�ner Umzusetzen mit: function mailto_makelinks($data,$conf)
			$lconf = array();
			$myEmail = $row['email'];
			$lconf ['stdWrap.']['typolink.']['parameter'] = $myEmail;
			$lconf ['stdWrap.']['typolink.']['target']= "_blank";
			//debug($lconf);
			//debug($myEmail);
			$marker["###EMAIL###"] = $this->cObj->stdWrap($myEmail,$lconf);

			$myEmail = $row['email'];
			$mylconf = array();
			//debug($mylconf);
			//debug($myEmail);
			$marker["###EMAIL2###"] = $this->cObj->stdWrap($myEmail,$mylconf);

			// LINK TO HOMEPAGE
			//$marker["###HOMEPAGE###"] = $this->pi_linkToPage("Zur Homepage",$row["homepage"]);
			//debug($marker);
			if ($row["homepage"] > 0) $marker["###HOMEPAGE###"] = $this->pi_linkToPage("Zur Homepage",$row["homepage"])."<br>";
			else $marker["###HOMEPAGE###"] = $this->pi_linkToPage("",'');

			// LINK TO SINGLE PAGE
			// get Subparts for Link
			$singleLink = $this->cObj->getSubpart($tmpl_entry, "###SINGLELINK###");
			// create Link with backPID = actualpage, showUid=Person uid, id of actual Plugin (tt_content)
			$sendCObj = $this->cObj->data['uid'];
			$mergeArr=array(
			backPID => $GLOBALS['TSFE']->id,
			sendCObj => $sendCObj
			);
			$singleLink = $this->pi_list_linkSingle($singleLink,$row['myUid'],FALSE,$mergeArr,FALSE,$this->pidSingle);
			
			// 
			if ($row["extlinktext1"]) $marker["###EXTLINKTEXT1###"] = $this->pi_linkToPage($row["extlinktext1"],$row["www"])."<br>";


			$regex = "/<!-- ###HFWUPERSONALENTRYB### begin -->[\w\s\d:=\"!#'-<>\.]*<!-- ###HFWUPERSONALENTRYB### end -->/";
			$regexc = "/<!-- ###HFWUPERSONALENTRYC### begin -->[\w\s\d:=\"!#'-<>\.]*<!-- ###HFWUPERSONALENTRYC### end -->/";
			while ($myFieldMarker = each($checkFields)) {
				$themarker = $myFieldMarker['key'];
				$chk = $row[$themarker];
//				debug($themarker);
//				echo "<pre>";
//				print_r($row[$themarker]);
//				print_r($tmpl_entry);
//				echo "</pre>";
//				echo "<br>";
//				debug($chk);
//				echo "<hr>";
				if (strlen($chk) == 0) $tmpl_entry = $this->replaceRegex($themarker,$tmpl_entry);
			}
			if(strlen($checkPh2)==0) $tmpl_entry = preg_replace($regex,'', $tmpl_entry);
			if(strlen($checkPh3)==0) $tmpl_entry = preg_replace($regexc,'', $tmpl_entry);
			//debug($tmpl_entry);
			$myEntry = $this->cObj->substituteSubpart($tmpl_entry,"###SINGLELINK###",$singleLink);
			//debug($mergeArr);

			//SUBSTITUTE MARKERS for the actual entry
			$myEntry = $this->cObj->substituteMarkerArrayCached($myEntry, $marker);
			// clean up not used markers
			$myEntry = preg_replace('/###[A-Za-z_0-9]*###/','', $myEntry);
			$innerContent .= $myEntry;
			//$innerContentB .= $myEntryB;
		} // End of single entries
		// push the inner part into the outer part
		$content = $this->cObj->substituteSubpart($tmpl,"###HFWUPERSONALENTRY###",$innerContent);
		return $content;
	}

	function replaceRegex($strg,$tmpl) {
		$label = "";
		$lastchr = substr($strg, -1);
		if (is_numeric($lastchr)) {
			$stripped_strg = rtrim($strg,'0..9');
			if ($stripped_strg === "extlinktext") {
				$stripped_strg = substr($stripped_strg,0,3);
				$stripped_strg = strtolower($stripped_strg);
				$label = "<b(.*)".$stripped_strg."(.*)";
				$label .= "###".strtoupper($strg)."###( |<br>)*";
				$regex = "/$label/i";
				$tmpl = preg_replace($regex,'', $tmpl);
			} 
			elseif($stripped_strg === "funktion") {
				$label = "(-| |<br>)*";
                                $label .= "###".strtoupper($strg)."###( |<br>)*";
                                $regex = "/$label/i";
                                $tmpl = preg_replace($regex,' ', $tmpl);
			}
			else {
				$label = "<b(.*)".$stripped_strg.":(.*)";
				$label .= "###".strtoupper($strg)."###( |<br>)*";
				$regex = "/$label/i";
				$tmpl = preg_replace($regex,'', $tmpl);
			}
		} else {
			if ($strg === "fakultaet") {
				$sixchr = substr($strg,0,6);
				$label = "<b(.*)>".$sixchr."(.*)";
				$label .= "###".strtoupper($strg)."###( |<br>)*";
				$regex = "/$label/i";
				$tmpl = preg_replace($regex,'', $tmpl);
			} else {
				$label = "<b(.*)>".$strg.":(.*)";
				$label .= "###".strtoupper($strg)."###( |<br>)*";
				$regex = "/$label/i";
				$tmpl = preg_replace($regex,'', $tmpl);
			}
		}
		return $tmpl;
	}

}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hfwupersonal/pi1/class.tx_hfwupersonal_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hfwupersonal/pi1/class.tx_hfwupersonal_pi1.php']);
}

?>
