<?php
class Catm extends Eloquent {
	protected $table = 'tab_catm';
	protected $primaryKey = 'catm_id';
	/*
	protected $fillable = array('catm_id', 'catm_name_en', 'catm_name_th');
	protected $guarded = array('catm_id', 'catm_name_en');
	 * 
	 */
	private $errors;

	public function errors() {
		return $this -> errors;
	}

}
