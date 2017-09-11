<?php

class String_Generator
{

	public function String_Shuffle($string)
	{
		/* --- GET STRING AS TWO PART --- */
		$string_length 		= strlen($string);
		$string_devide 		= $string_length / 2;

		$first_string 		= substr($string, 0, $string_devide);
		$second_string 		= substr($string, $string_devide);

		/* --- SPLIT FIRST STRING --- */
		$first_string_length 	= strlen($first_string);
		$first_string_devide 	= $first_string_length / 2;

		$string_one = substr($first_string, 0, $first_string_devide);
		$string_two = substr($first_string, $first_string_devide);

		/* --- SPLIT SECOND STRING --- */
		$second_string_length 	= strlen($second_string);
		$second_string_devide 	= $second_string_length / 2;

		$string_three 	= substr($second_string, 0, $second_string_devide);
		$string_four 	= substr($second_string, $second_string_devide);

		$string_shuffled 	= "$string_three$string_two$string_four$string_one";

		return $string_shuffled;
		/* --- ================================================================ --- */
	}

	public function String_Replace($string)
	{
		/* --- STRING REPLACE --- */
		$char_replace 	= array('A'=>'Q','a'=>'g','I'=>'A','i'=>'@','U'=>'q','u'=>'C','E'=>'f','e'=>'d','O'=>'u','o'=>'S','B'=>'G','b'=>'W','C'=>'Z','c'=>'X','D'=>'F','d'=>'K','F'=>'s','f'=>'O','G'=>'.','g'=>'L','H'=>'N','h'=>'2','J'=>'5','j'=>'v','K'=>'y','k'=>'P','L'=>'c','l'=>'D','M'=>'U','m'=>'9','N'=>'z','n'=>'R','P'=>'t','p'=>'','Q'=>'0','q'=>'H','R'=>'B','r'=>'k','S'=>'4','s'=>'3','T'=>'h','t'=>'a','V'=>'6','v'=>'r','W'=>'T','w'=>'n','X'=>'J','x'=>'7','Y'=>'i','y'=>'w','Z'=>'Y','z'=>'p','@'=>'b','.'=>'1','0'=>'I','1'=>'x','2'=>'1','3'=>'V','4'=>'8','5'=>'o','6'=>'m','7'=>'j','8'=>'e','9'=>'E',' '=>'M');

		$string_replaced 	= strtr($string,$char_replace);

		return $string_replaced;
		/* --- ================================================================ --- */
	}

	public function ANCrypt($key,$string)
	{
		/* --- STRING ENCRYPTION --- */
		$string_shuffled 	= $this->String_Shuffle($string);
		$string_replaced 	= $this->String_Replace($string_shuffled);
		$string_key			= crypt($string_replaced,$key);
		$string_crypted 	= md5($string_replaced).substr($string_key,-7);

		return $string_crypted;
		/* --- ================================================================ --- */
	}

}

/* --- END OF FILE --- */
/* --- ©2017 Afdhal Afrilliyansyah --- */