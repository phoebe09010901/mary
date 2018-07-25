<?php
class cloud_mysql {
	var $result;
	var $obj_all;

	public function run_mysql($query) {
		$this->result = mysql_query($query) or die(mysql_error());
		return $this->result;
	}
	public function run_mysql_list($query) {
		$this->result = $this->run_mysql($query);
		if($this->result){$this->obj_all = mysql_num_rows($this->result);}
	}
	public function run_mysql_out($query) {
		$this->result = $this->run_mysql($query);
		if($this->result){$this->result_data = mysql_fetch_array($this->result);}
		return $this->result_data;
	}
	public function run_mysql_close() {
		mysql_close();
	}
}
class mysql_page extends cloud_mysql {
	var $page_all;

	function count_page($query, $page_go, $page_num) {
		if($page_num!=0) {
			$this->run_mysql_list($query);
			//計算總頁數
			$this->page_all = ceil($this->obj_all / $page_num);
			if($this->page_all==0){$this->page_all = 1;}

			$t            = ($page_go-1) * $page_num; //設定query limit搜尋起始編號
			$query        = $query." Limit ".$t.",".$page_num."";
			$this->result = mysql_query($query) or die(mysql_error());
		}
	}
}
?>
