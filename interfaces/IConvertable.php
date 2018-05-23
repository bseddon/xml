<?php

/**
 * Part of the XML Schema library for PHP
 *  _                      _     _ _ _
 * | |   _   _  __ _ _   _(_) __| (_) |_ _   _
 * | |  | | | |/ _` | | | | |/ _` | | __| | | |
 * | |__| |_| | (_| | |_| | | (_| | | |_| |_| |
 * |_____\__, |\__, |\__,_|_|\__,_|_|\__|\__, |
 *       |___/    |_|                    |___/
 *
 * @author Bill Seddon
 * @version 0.9
 * @Copyright (C) 2018 Lyquidity Solutions Limited
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace lyquidity\xml\interfaces;

/**
 * Defines methods that convert the value of the implementing reference or value
 * type to a common language runtime type that has an equivalent value.
 */
interface IConvertable
{
	/**
	 * Returns the System.TypeCode for this instance.
	 *
	 * @return TypeCode
	 * The enumerated constant that is the System.TypeCode of the class or value type
	 * that implements this interface.
	 */
	function GetTypeCode();
	/**
	 * Converts the value of this instance to an equivalent Boolean value using the
	 * specified culture-specific formatting information.
	 *
	 * @param IFormatProvider $provider An interface implementation that supplies culture-specific formatting information.
	 * @return bool A Boolean value equivalent to the value of this instance.
	 */
	function ToBoolean( $provider );
	/**
	 * Converts the value of this instance to an equivalent Unicode character using
	 * the specified culture-specific formatting information.
	 *
	 * @param IFormatProvider $provider An interface implementation that supplies culture-specific formatting information.
	 * @return char A Unicode character equivalent to the value of this instance.
	 */
	function ToChar( $provider );
	/**
	 * Converts the value of this instance to an equivalent System.DateTime using the
	 * specified culture-specific formatting information.
	 *
	 * @param IFormatProvider $provider An interface implementation that supplies culture-specific formatting information.
	 * @return DateTime A DateTime instance equivalent to the value of this instance.
	 */
	 function ToDateTime( $provider );
	/**
	 * Converts the value of this instance to an equivalent System.Decimal number using
	 * the specified culture-specific formatting information.
	 *
	 * @param IFormatProvider $provider An implementation that supplies culture-specific formatting information.
	 * @return Decimal A Decimal number equivalent to the value of this instance.
	 */
	function ToDecimal( $provider );
	/**
	 * Converts the value of this instance to an equivalent double-precision floating-point
	 * number using the specified culture-specific formatting information.
	 *
	 * @param IFormatProvider $provider An interface implementation that supplies culture-specific formatting information.
	 * @return double A double-precision floating-point number equivalent to the value of this instance.
	 */
	function ToDouble( $provider );
	/**
	 * Converts the value of this instance to an equivalent integer
	 * using the specified culture-specific formatting information.
	 *
	 * @param IFormatProvider $provider An interface implementation that supplies culture-specific formatting information.
	 * @return ushort An 16-bit unsigned integer equivalent to the value of this instance.
	 */
	function ToInt( $provider );

}
