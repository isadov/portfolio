<?php
class Works_model{
	public function get_works(){
		$sql = 'SELECT * FROM works';
		$result = DB::get_select($sql);

		if($result['count']>0){
			return $result['result'];
		}
	}
}