<?php

namespace App\Rules;

use DB;
use Illuminate\Contracts\Validation\Rule;

class MaxRegistrations implements Rule
{
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		$accountNumber = DB::table('account.account')
							->select('email')
							->where('email', '=', $value)
							->count();
		return ($accountNumber >= 3) ? false : true;
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return 'Only 3 accounts per email';
	}
}
