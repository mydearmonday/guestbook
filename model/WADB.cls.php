<?
	class WADB{
		private $sDbHost;           //資料庫位置
		private $sDbName;           //資料庫名稱
		private $sDbUser;           //資料庫帳號
		private $sDbPwd;            //資料庫密碼
		private $iNoOfRecords;
		private $oQueryResult;
		private $aSelectRecords;
		private $aArrRec;
		private $bInsertRecords;
		private $iInsertRecId;
		
		/* 建構函式 */
		function __construct($sDbHost, $sDbName, $sDbUser, $sDbPwd){
			$oDbLink = mysql_connect ($sDbHost, $sDbUser, $sDbPwd) or die ("MySQL DB could not be connected");
			@mysql_select_db ($sDbName, $oDbLink)or die ("MySQL DB could not be selected");
			@mysql_query("set names 'utf8'");
		}
		
	    /* 查詢 */
		function selectRecords ($sSqlQuery){
			unset($this->aSelectRecords);
			$this->oQueryResult = mysql_query($sSqlQuery) or die(mysql_error());
			$this->iNoOfRecords = mysql_num_rows($this->oQueryResult);
			if ($this->iNoOfRecords > 0) {
				while ($oRow = mysql_fetch_array($this->oQueryResult,MYSQL_ASSOC)) {
					$this->aSelectRecords[] = $oRow;
				}
				mysql_free_result($this->oQueryResult);
			}
			$this->aArrRec = $this->aSelectRecords;
			return array(	'data'		=> $this->aArrRec,
							'record'	=> $this->iNoOfRecords);
		}
	
		/* 新增 */
		function insertRecords($sSqlQuery){
			$this->bInsertRecords = mysql_query ($sSqlQuery) or die (mysql_error());
			$this->iInsertRecId = mysql_insert_id();
			return $this->iInsertRecId;
		}
	
		/* 修改 */
		function updateRecords($sSqlQuery){
			return mysql_query($sSqlQuery) or die(mysql_error());
		}
		
		/* 刪除 */
		function deleteRecords($sSqlQuery){
			return mysql_query($sSqlQuery) or die(mysql_error());
		}
	}
?>