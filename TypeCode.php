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

namespace lyquidity\xml;

/**
 * Specifies the type of an object.
 */
class TypeCode
{
	/**
	 * Generated a type code value for a variable
	 * @param mixed $value
	 * @return TypeCode
	 */
	public static function getTypeCodeFromObject( $value )
	{
		if ( is_null( $value ) )
		{
			return TypeCode::Null_;
		}

		if ( is_array( $value ) )
		{
			return TypeCode::assocArray;
		}

		if ( is_string( $value ) )
		{
			return strlen( $value ) === 1 ? TypeCode::Char : TypeCode::String;
		}

		if ( $value instanceof DateTime )
		{
			return TypeCode::DateTime;
		}

		if ( $value instanceof DateTimeInterval )
		{
			return TypeCode::DateTimeInterval;
		}

		if ( is_double( $value ) )
		{
			return TypeCode::Double;
		}

		if ( is_int( $value ) )
		{
			return TypeCode::Int32;
		}

		if ( is_bool( $value ) )
		{
			return TypeCode::Boolean;
		}

		if ( is_object( $value ) )
		{
			return TypeCode::Object;
		}
	}

	/**
	 * A null reference.
	 */
	const Null_ = 0;
	/**
	 * A general type representing any reference or value type not explicitly represented by another TypeCode.
	 */
	const Object = 1;
	/**
	 * A database null (column) value.
	 */
	const DBNull = 2;
	/**
	 * A simple type representing Boolean values of true or false.
	 */
	const Boolean = 3;
	/**
	 * An integral type representing unsigned 16-bit integers with values between 0 and 65535.
	 * The set of possible values for the System.TypeCode.Char type corresponds to the Unicode character set.
	 */
	const Char = 4;
	/**
	 * An integral type representing signed 8-bit integers with values between -128 and 127.
	 */
	const SByte = 5;
	/**
	 * An integral type representing unsigned 8-bit integers with values between 0 and 255.
	 */
	const Byte = 6;
	/**
	 * An integral type representing signed 16-bit integers with values between -32768 and 32767.
	 */
	const Int16 = 7;
	/**
	 * An integral type representing unsigned 16-bit integers with values between 0 and 65535.
	 */
	const UInt16 = 8;
	/**
	 * An integral type representing signed 32-bit integers with values between -2147483648 and 2147483647.
	 */
	const Int32 = 9;
	/**
	 * An integral type representing unsigned 32-bit integers with values between 0 and 4294967295.
	 */
	const UInt32 = 10;
	/**
	 * An integral type representing signed 64-bit integers with values between -9223372036854775808 and 9223372036854775807.
	 */
	const Int64 = 11;
	/**
	 * An integral type representing unsigned 64-bit integers with values between 0 and 18446744073709551615.
	 */
	const UInt64 = 12;
	/**
	 * A floating point type representing values ranging from approximately 1.5 x 10
	 * -45 to 3.4 x 10 38 with a precision of 7 digits.
	 */
	const Single = 13;
	/**
	 * A floating point type representing values ranging from approximately 1.5 x 10
	 * -45 to 3.4 x 10 38 with a precision of 7 digits.
	 */
	const Float = 13;
	/**
	 * A floating point type representing values ranging from approximately 5.0 x 10-324 to 1.7 x 10+308 with a precision of 15-16 digits.
	 */
	const Double = 13;
	/**
	 * A type representing a date and time value.
	 */
	const DateTimeInterval = 14;
	/**
	 * A simple type representing values ranging from 1.0 x 10-28 to approximately 7.9 x 10+28 with 28-29 significant digits.
	 */
	const Decimal = 15;
	/**
	 * A type representing a date and time value.
	 */
	const DateTime = 16;
	/**
	 * A type representing Unicode character strings.
	 */
	const String = 18;

	/**
	 * A type representing arrays
	 */
	const AssocArray = 19;

	/**
	 * A type representing a union of different simple types
	 * @var integer
	 */
	const UNION = 20;
}

/**
 * Unit tests
 */
function TestTypeCode()
{
	$typeCode = TypeCode::getTypeCode( 1 );
	$typeCode = TypeCode::getTypeCode( "a" );
	$typeCode = TypeCode::getTypeCode( "1" );
	$typeCode = TypeCode::getTypeCode( true );
	$typeCode = TypeCode::getTypeCode( date('now') );
	$date = new \DateTime();
	$typeCode = TypeCode::getTypeCode( $date );
}
