<?php
/**
 * php command lind interface helper
 * 
 * @author Mohamad Mehdi Habibi (i@mhabibi.net)
 * @license MIT License
 * @link http://github.com/mm-habibi/php-cli/
 *
 */
class Cli {
	private static $foregroundColors = array(
		# Regular Colors
		'Black'=>'0;30',        # Black
		'Red'=>'0;31',          # Red
		'Green'=>'0;32',        # Green
		'Yellow'=>'0;33',       # Yellow
		'Blue'=>'0;34',         # Blue
		'Purple'=>'0;35',       # Purple
		'Cyan'=>'0;36',         # Cyan
		'White'=>'0;37',        # White
		
		# Bold
		'BBlack'=>'1;30',       # Black
		'BRed'=>'1;31',         # Red
		'BGreen'=>'1;32',       # Green
		'BYellow'=>'1;33',      # Yellow
		'BBlue'=>'1;34',        # Blue
		'BPurple'=>'1;35',      # Purple
		'BCyan'=>'1;36',        # Cyan
		'BWhite'=>'1;37',       # White
		
		# Underline
		'UBlack'=>'4;30',       # Black
		'URed'=>'4;31',         # Red
		'UGreen'=>'4;32',       # Green
		'UYellow'=>'4;33',      # Yellow
		'UBlue'=>'4;34',        # Blue
		'UPurple'=>'4;35',      # Purple
		'UCyan'=>'4;36',        # Cyan
		'UWhite'=>'4;37',       # White
		
		# High Intensity
		'IBlack'=>'0;90',       # Black
		'IRed'=>'0;91',         # Red
		'IGreen'=>'0;92',       # Green
		'IYellow'=>'0;93',      # Yellow
		'IBlue'=>'0;94',        # Blue
		'IPurple'=>'0;95',      # Purple
		'ICyan'=>'0;96',        # Cyan
		'IWhite'=>'0;97',       # White
		
		# Bold High Intensity
		'BIBlack'=>'1;90',      # Black
		'BIRed'=>'1;91',        # Red
		'BIGreen'=>'1;92',      # Green
		'BIYellow'=>'1;93',     # Yellow
		'BIBlue'=>'1;94',       # Blue
		'BIPurple'=>'1;95',     # Purple
		'BICyan'=>'1;96',       # Cyan
		'BIWhite'=>'1;97',      # White
		
		# High Intensity backgrounds
		'On_IBlack'=>'0;100',   # Black
		'On_IRed'=>'0;101',     # Red
		'On_IGreen'=>'0;102',   # Green
		'On_IYellow'=>'0;103',  # Yellow
		'On_IBlue'=>'0;104',    # Blue
		'On_IPurple'=>'0;105',  # Purple
		'On_ICyan'=>'0;106',    # Cyan
		'On_IWhite'=>'0;107',   # White
	);
	private static $backgroundColors = array(
		'Black'		=> '40',
		'Red' 		=> '41',
		'Green' 	=> '42',
		'Yellow' 	=> '43',
		'Blue' 		=> '44',
		'Magenta' 	=> '45',
		'Cyan' 		=> '46',
		'LightGray'	=> '47',
	);

	public static function log($string, $fColor = null, $bColor = null, $break=true)
	{
		echo self::getColoredString($string, ucfirst($fColor), ucfirst($bColor)).($break ? "\n" : "");
	}
	
	public static function getColoredString($string, $fColor = null, $bColor = null)
	{
		$coloredString = "";
 
		if (isset(self::$foregroundColors[$fColor])) {
			$coloredString .= "\033[" . self::$foregroundColors[$fColor] . "m";
		}
		if (isset(self::$backgroundColors[$bColor])) {
			$coloredString .= "\033[" . self::$backgroundColors[$bColor] . "m";
		}

		$coloredString .=  $string . "\033[0m";

		return $coloredString;
	}
	
	public static function get($message, $fColor = null, $bColor = null)
	{
		$fColor = ucfirst($fColor);
		$bColor = ucfirst($bColor);
		if (PHP_OS == 'WINNT') {
			echo $message.' ';
			$line = stream_get_line(STDIN, 1024, PHP_EOL);
		} else {
			$closeColor = false;
			if (isset(self::$foregroundColors[$fColor])) {
				echo "\033[" . self::$foregroundColors[$fColor] . "m";
				$closeColor = true;
			}
			if (isset(self::$backgroundColors[$bColor])) {
				echo "\033[" . self::$backgroundColors[$bColor] . "m";
				$closeColor = true;
			}
			$line = readline($message.' ');
			
			if ($closeColor) {
				echo "\033[0m";			
			}
		}
		return $line;
	}
}
