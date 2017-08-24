<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class QueryFilters {

	protected $request;
	protected $builder;

	public function __construct(Request $request) {
		$this->request = $request;
	}

	public function filters() {
		return $this->request->all();
	}

	public function apply (Builder $builder) {
		$this->builder = $builder;

		foreach ($this->filters() as $name => $value) {
			if (method_exists($this, $name)) {
				call_user_func_array([$this, $name], array_filter([$value]));
			}
		}
	}
	
}