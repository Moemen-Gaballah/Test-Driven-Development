<?php 

namespace App\BackingClasses;

use Illuminate\Support\Str;

class Char
{
	public function koko()
	{
		return "Welcome Koko";
	}

	public function getCamelCase(String $string)
	{
		// return "callOfDuty";
	
		return Str::camel($string);
	}
}