<?php
if(!function_exists('getRawSqlQuery')) {
    function getRawSqlQuery($builder) {
        foreach ($builder->bindings as $i => $binding) {
            if ($binding instanceof \DateTime) {
                $builder->bindings[ $i ] = $binding->format('\'Y-m-d H:i:s\'');
            } else {
                if (is_string($binding)) {
                    $builder->bindings[ $i ] = "'$binding'";
                }
            }
        }
        // Insert bindings into query
        $boundSql = str_replace(['%', '?'], ['%%', '%s'], $builder->sql);
        $boundSql = vsprintf($boundSql, $builder->bindings);

        Log::debug(
            "TIME - {$query->time}ms\n" .
            "                                   UNBOUND QUERY: {$builder->sql};\n" .
            "                                   BOUND QUERY: $boundSql;"
        );

        return $query;
    }
}

if(!function_exists('decimalToTextVietnamese')) {
    function decimalToTextVietnamese($amount)
    {
        return ucfirst(convert_number_to_words($amount)) . ' đồng';
    }
}

if(!function_exists('convert_number_to_words')) {
    function convert_number_to_words($number) {
 
		$hyphen      = ' ';
		$conjunction = ' ';
		$separator   = ' ';
		$negative    = 'âm ';
		$decimal     = ' phẩy ';
		$one		 = 'mốt';
		$ten         = 'lẻ';
		$dictionary  = array(
		0                   => 'không',
		1                   => 'một',
		2                   => 'hai',
		3                   => 'ba',
		4                   => 'bốn',
		5                   => 'năm',
		6                   => 'sáu',
		7                   => 'bảy',
		8                   => 'tám',
		9                   => 'chín',
		10                  => 'mười',
		11                  => 'mười một',
		12                  => 'mười hai',
		13                  => 'mười ba',
		14                  => 'mười bốn',
		15                  => 'mười lăm',
		16                  => 'mười sáu',
		17                  => 'mười bảy',
		18                  => 'mười tám',
		19                  => 'mười chín',
		20                  => 'hai mươi',
		30                  => 'ba mươi',
		40                  => 'bốn mươi',
		50                  => 'năm mươi',
		60                  => 'sáu mươi',
		70                  => 'bảy mươi',
		80                  => 'tám mươi',
		90                  => 'chín mươi',
		100                 => 'trăm',
		1000                => 'ngàn',
		1000000             => 'triệu',
		1000000000          => 'tỷ',
		1000000000000       => 'nghìn tỷ',
		1000000000000000    => 'ngàn triệu triệu',
		1000000000000000000 => 'tỷ tỷ'
		);
		 
		if (!is_numeric($number)) {
			return false;
		}
		 
		// if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
		// 	// overflow
		// 	trigger_error(
		// 	'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
		// 	E_USER_WARNING
		// 	);
		// 	return false;
		// }
		 
		if ($number < 0) {
			return $negative . convert_number_to_words(abs($number));
		}
		 
		$string = $fraction = null;
		 
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
		 
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
			break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= ( $hyphen . ($units==1?$one:$dictionary[$units]) );
				}
			break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= ( $conjunction . ($remainder<10?$ten.$hyphen:null) . convert_number_to_words($remainder) );
				}
			break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number - ($numBaseUnits*$baseUnit);
				$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= ( $remainder < 100 ? $conjunction : $separator );
					$string .= ( convert_number_to_words($remainder) );
				}
			break;
		}
		 
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
		 
		return $string;
	}
}

if(!function_exists('unique_multidim_array')) {
    function unique_multidim_array($array, $key) { 
		$temp_array = array(); 
		$i = 0; 
		$key_array = array(); 
		
		foreach($array as $val) { 
			if (!in_array($val[$key], $key_array)) { 
				$key_array[$i] = $val[$key]; 
				$temp_array[$i] = $val; 
			} 
			$i++; 
		} 
		return $temp_array; 
	}
}

if(!function_exists('array_unique_multidimensional')) {
	function array_unique_multidimensional($input)
	{
		$serialized = array_map('serialize', $input);
		$unique = array_unique($serialized);
		return array_intersect_key($input, $unique);
	}
}