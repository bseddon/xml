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

namespace lyquidity\xml\MS;

use lyquidity\xml\schema\SchemaTypes;

/**
 * Represents the W3C XML Schema Definition Language (XSD) schema types.
 */
class XmlTypeCode
{
	/**
	 * No type information.
	 */
	const None = 0;
	/**
	 * An item such as a node or atomic value.
	 */
	const Item = 1;
	/**
	 * This value supports the .NET Framework infrastructure and is not intended to
	 * be used directly from your code.
	 */
	const Node = 2;
	/**
	 * This value supports the .NET Framework infrastructure and is not intended to
	 * be used directly from your code.
	 */
	const Document = 3;
	/**
	 * This value supports the .NET Framework infrastructure and is not intended to
	 * be used directly from your code.
	 */
	const Element = 4;
	/**
	 * This value supports the .NET Framework infrastructure and is not intended to
	 * be used directly from your code.
	 */
	const Attribute = 5;
	/**
	 * This value supports the .NET Framework infrastructure and is not intended to
	 * be used directly from your code.
	 */
	const Namespace_ = 6;
	/**
	 * This value supports the .NET Framework infrastructure and is not intended to
	 * be used directly from your code.
	 */
	const ProcessingInstruction = 7;
	/**
	 * This value supports the .NET Framework infrastructure and is not intended to
	 * be used directly from your code.
	 */
	const Comment = 8;
	/**
	 * This value supports the .NET Framework infrastructure and is not intended to
	 * be used directly from your code.
	 */
	const Text = 9;
	/**
	 * Any atomic value of a union.
	 */
	const AnyAtomicType = 10;
	/**
	 * An untyped atomic value.
	 */
	const UntypedAtomic = 11;
	/**
	 * A W3C XML Schema xs:string type.
	 */
	const String = 12;
	/**
	 * A W3C XML Schema xs:boolean type.
	 */
	const Boolean = 13;
	/**
	 * A W3C XML Schema xs:decimal type.
	 */
	const Decimal = 14;
	/**
	 * A W3C XML Schema xs:float type.
	 */
	const Float = 15;
	/**
	 * A W3C XML Schema xs:double type.
	 */
	const Double = 16;
	/**
	 * A W3C XML Schema xs:Duration type.
	 */
	const Duration = 17;
	/**
	 * A W3C XML Schema xs:dateTime type.
	 */
	const DateTime = 18;
	/**
	 * A W3C XML Schema xs:time type.
	 */
	const Time = 19;
	/**
	 * A W3C XML Schema xs:date type.
	 */
	const Date = 20;
	/**
	 * A W3C XML Schema xs:gYearMonth type.
	 */
	const GYearMonth = 21;
	/**
	 * A W3C XML Schema xs:gYear type.
	 */
	const GYear = 22;
	/**
	 * A W3C XML Schema xs:gMonthDay type.
	 */
	const GMonthDay = 23;
	/**
	 * A W3C XML Schema xs:gDay type.
	 */
	const GDay = 24;
	/**
	 * A W3C XML Schema xs:gMonth type.
	 */
	const GMonth = 25;
	/**
	 * A W3C XML Schema xs:hexBinary type.
	 */
	const HexBinary = 26;
	/**
	 * A W3C XML Schema xs:base64Binary type.
	 */
	const Base64Binary = 27;
	/**
	 * A W3C XML Schema xs:anyURI type.
	 */
	const AnyUri = 28;
	/**
	 * A W3C XML Schema xs:QName type.
	 */
	const QName = 29;
	/**
	 * A W3C XML Schema xs:NOTATION type.
	 */
	const Notation = 30;
	/**
	 * A W3C XML Schema xs:normalizedString type.
	 */
	const NormalizedString = 31;
	/**
	 * A W3C XML Schema xs:token type.
	 */
	const Token = 32;
	/**
	 * A W3C XML Schema xs:language type.
	 */
	const Language = 33;
	/**
	 * A W3C XML Schema xs:NMTOKEN type.
	 */
	const NmToken = 34;
	/**
	 * A W3C XML Schema xs:Name type.
	 */
	const Name = 35;
	/**
	 * A W3C XML Schema xs:NCName type.
	 */
	const NCName = 36;
	/**
	 * A W3C XML Schema xs:ID type.
	 */
	const Id = 37;
	/**
	 * A W3C XML Schema xs:IDREF type.
	 */
	const Idref = 38;
	/**
	 * A W3C XML Schema xs:ENTITY type.
	 */
	const Entity = 39;
	/**
	 * A W3C XML Schema xs:integer type.
	 */
	const Integer = 40;
	/**
	 * A W3C XML Schema xs:nonPositiveInteger type.
	 */
	const NonPositiveInteger = 41;
	/**
	 * A W3C XML Schema xs:negativeInteger type.
	 */
	const NegativeInteger = 42;
	/**
	 * A W3C XML Schema xs:long type.
	 */
	const Long = 43;
	/**
	 * A W3C XML Schema xs:int type.
	 */
	const Int = 44;
	/**
	 * A W3C XML Schema xs:short type.
	 */
	const Short = 45;
	/**
	 * A W3C XML Schema xs:byte type.
	 */
	const Byte = 46;
	/**
	 * A W3C XML Schema xs:nonNegativeInteger type.
	 */
	const NonNegativeInteger = 47;
	/**
	 * A W3C XML Schema xs:unsignedLong type.
	 */
	const UnsignedLong = 48;
	/**
	 * A W3C XML Schema xs:unsignedInt type.
	 */
	const UnsignedInt = 49;
	/**
	 * A W3C XML Schema xs:unsignedShort type.
	 */
	const UnsignedShort = 50;
	/**
	 * A W3C XML Schema xs:unsignedByte type.
	 */
	const UnsignedByte = 51;
	/**
	 * A W3C XML Schema xs:positiveInteger type.
	 */
	const PositiveInteger = 52;
	/**
	 * This value supports the .NET Framework infrastructure and is not intended to be used directly from your code.
	 */
	const YearMonthDuration = 53;
	/**
	 * This value supports the .NET Framework infrastructure and is not intended to be used directly from your code.
	 */
	const DayTimeDuration = 54;
	/**
	 * This is any complex type
	 */
	const AnyType = 55;
	/**
	 * A W3C XML Schema xs:NMTOKENS type.
	 */
	const NMTOKENS = 56;
	/**
	 * A W3C XML Schema xs:IDREFS type.
	 */
	const IDREFS = 57;
	/**
	 * A W3C XML Schema xs:ENTITIES type.
	 */
	const ENTITIES = 58;

	const UNION = 60;

	/**
	 * Get a type code for an XML type name
	 * @param string $xmlType An Xml type
	 * @return XmlTypeCode value
	 */
	public static function TypeCodeForXmlType( $xmlType )
	{
		// Sanity check
		if ( is_null( $xmlType ) || ! is_scalar( $xmlType ) )
		{
			return XmlTypeCode::UntypedAtomic;
		}

		$types = SchemaTypes::getInstance();
		$atom = $types->getAtomicType( $xmlType );

		return isset( XmlTypeCode::$typeToCodeMap[ $atom ] )
			? XmlTypeCode::$typeToCodeMap[ $atom ]
			: XmlTypeCode::UntypedAtomic;
	}

	/**
	 * Return the constant name corresponding to the $tokenValue
	 * @param int $typeCode
	 * @return string
	 */
	public static function getCodeName( $typeCode )
	{
		// Maybe this should be: XmlTypeCode::$codeToTypeMap[ $typeCode ];
		$oClass = new \ReflectionClass( __CLASS__ );
		foreach ( $oClass->getConstants() as $key => $value )
		{
			if ( $value == $typeCode ) return $key;
		}

		return false;
	}

	/**
	 * Look up the Xml type associated with a type code
	 * @param int $typeCode (XmlTypeCode)
	 * @return boolean|string
	 */
	public static function getTypeForCode( $typeCode )
	{
		return isset( XmlTypeCode::$codeToTypeMap[ $typeCode ] )
			? XmlTypeCode::$codeToTypeMap[ $typeCode ]
			: false;
	}

	/**
	 * Map variable set in static constructor
	 * @var array
	 */
	private static $typeToCodeMap = array();
	/**
	 * Map variable set in static constructor
	 * @var array
	 */
	private static $codeToTypeMap = array();

	/**
	 * Static constructor
	 */
	static function __static()
	{
		XmlTypeCode::$typeToCodeMap = array(
			'xs:anyType'				=> XmlTypeCode::AnyType,
			'xs:anySimpleType'			=> XmlTypeCode::AnyAtomicType,
			'xs:untypedAtomic'			=> XmlTypeCode::UntypedAtomic,
			'xs:string'					=> XmlTypeCode::String,
			'xs:boolean'				=> XmlTypeCode::Boolean,
			'xs:decimal'				=> XmlTypeCode::Decimal,
			'xs:double'					=> XmlTypeCode::Double,
			'xs:float'					=> XmlTypeCode::Float,
			'xs:duration'				=> XmlTypeCode::Duration,
			'xs:dateTime'				=> XmlTypeCode::DateTime,
			'xs:time'					=> XmlTypeCode::Time,
			'xs:date'					=> XmlTypeCode::Date,
			'xs:gYearMonth'				=> XmlTypeCode::GYearMonth,
			'xs:gYear'					=> XmlTypeCode::GYear,
			'xs:gMonthDay'				=> XmlTypeCode::GMonthDay,
			'xs:gDay'					=> XmlTypeCode::GDay,
			'xs:gMonth'					=> XmlTypeCode::GMonth,
			'xs:hexBinary'				=> XmlTypeCode::HexBinary,
			'xs:base64Binary'			=> XmlTypeCode::Base64Binary,
			'xs:anyURI'					=> XmlTypeCode::AnyUri,
			'xs:QName'					=> XmlTypeCode::QName,
			'xs:NOTATION'				=> XmlTypeCode::Notation,
			'xs:normalizedString'		=> XmlTypeCode::NormalizedString,
			'xs:token'					=> XmlTypeCode::Token,
			'xs:language'				=> XmlTypeCode::Language,
			'xs:Name'					=> XmlTypeCode::Name,
			'xs:NCName'					=> XmlTypeCode::NCName,
			'xs:NMTOKEN'				=> XmlTypeCode::NmToken,
			'xs:ID'						=> XmlTypeCode::Id,
			'xs:IDREF'					=> XmlTypeCode::Idref,
			'xs:ENTITY'					=> XmlTypeCode::Entity,
			'xs:integer'				=> XmlTypeCode::Integer,
			'xs:nonPositiveInteger'		=> XmlTypeCode::NonPositiveInteger,
			'xs:long'					=> XmlTypeCode::Long,
			'xs:nonNegativeInteger'		=> XmlTypeCode::NonNegativeInteger,
			'xs:negativeInteger' 		=> XmlTypeCode::NegativeInteger,
			'xs:int'					=> XmlTypeCode::Int,
			'xs:short'					=> XmlTypeCode::Short,
			'xs:byte'					=> XmlTypeCode::Byte,
			'xs:positiveInteger' 		=> XmlTypeCode::PositiveInteger,
			'xs:unsignedLong' 			=> XmlTypeCode::UnsignedLong,
			'xs:unsignedInt' 			=> XmlTypeCode::UnsignedInt,
			'xs:unsignedShort'			=> XmlTypeCode::UnsignedShort,
			'xs:unsignedByte'			=> XmlTypeCode::UnsignedByte,
			'xs:IDREFS'					=> XmlTypeCode::IDREFS,
			'xs:ENTITIES'				=> XmlTypeCode::ENTITIES,
			'xs:NMTOKENS'				=> XmlTypeCode::NMTOKENS,
			'xs:yearMonthDuration'		=> XmlTypeCode::YearMonthDuration,
			'xs:dayTimeDuration'		=> XmlTypeCode::DayTimeDuration,
			'xs:UNION'					=> XmlTypeCode::UNION,
		);

		XmlTypeCode::$codeToTypeMap = array_flip( XmlTypeCode::$typeToCodeMap );
	}
}

XmlTypeCode::__static();
