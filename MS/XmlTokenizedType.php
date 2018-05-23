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
 * Represents the XML type for the string. This allows the string to be read as
 * a particular XML type; for example a CDATA section type.
 */
class XmlTokenizedType
{
	/**
	 * CDATA type.
	 */
	const CDATA = 0;
	/**
	 * ID type.
	 */
	const ID = 1;
	/**
	 * IDREF type.
	 */
	const IDREF = 2;
	/**
	 * IDREFS type.
	 */
	const IDREFS = 3;
	/**
	 * ENTITY type.
	 */
	const ENTITY = 4;
	/**
	 * ENTITIES type.
	 */
	const ENTITIES = 5;
	/**
	 * NMTOKEN type.
	 */
	const NMTOKEN = 6;
	/**
	 * NMTOKENS type.
	 */
	const NMTOKENS = 7;
	/**
	 * NOTATION type.
	 */
	const NOTATION = 8;
	/**
	 * ENUMERATION type.
	 */
	const ENUMERATION = 9;
	/**
	 * QName type.
	 */
	const QName = 10;
	/**
	 * NCName type.
	 */
	const NCName = 11;
	/**
	 * No type.
	 */
	const None = 12;

	/**
	 * Get a type code for an Xml type name
	 * @param string $type An Xml type
	 * @return XmlTokenizedType value
	 */
	public static function TokenizedTypeFromXmlType( $type )
	{
		// Sanity check
		if ( is_null( $type )  || ! is_string( $type ) )
		{
			return XmlTokenizedType::None;
		}

		$types = SchemaTypes::getInstance();
		$atom = $types->getAtomicType( $type );

		return isset( XmlTokenizedType::$typeToCodeMap[ $atom ] )
			? XmlTokenizedType::$typeToCodeMap[ $atom ]
			: XmlTokenizedType::None;
	}

	/**
	 * Return the constant name corresponding to the $tokenValue
	 * @param int $tokenValue
	 * @return string
	 */
	public static function getTokenName( $tokenValue )
	{
		// $oClass = new \ReflectionClass( "\lyquidity\XPath2\Token" );
		$oClass = new \ReflectionClass( __CLASS__ );
		foreach ( $oClass->getConstants() as $key => $value )
		{
			if ( $value == $tokenValue ) return $key;
		}

		return false;

	}

	/**
	 * A map of type names to codes
	 * @var array
	 */
	private static $typeToCodeMap = array();

	/**
	 * Static constructor
	 */
	static function __static()
	{
		XmlTokenizedType::$typeToCodeMap = array(
			'xs:string'					=> XmlTokenizedType::None,
			'xs:boolean'				=> XmlTokenizedType::None,
			'xs:decimal'				=> XmlTokenizedType::None,
			'xs:double'					=> XmlTokenizedType::None,
			'xs:float'					=> XmlTokenizedType::None,
			'xs:duration'				=> XmlTokenizedType::None,
			'xs:dateTime'				=> XmlTokenizedType::None,
			'xs:time'					=> XmlTokenizedType::None,
			'xs:date'					=> XmlTokenizedType::None,
			'xs:gYearMonth'				=> XmlTokenizedType::None,
			'xs:gYear'					=> XmlTokenizedType::None,
			'xs:gMonthDay'				=> XmlTokenizedType::None,
			'xs:gDay'					=> XmlTokenizedType::None,
			'xs:gMonth'					=> XmlTokenizedType::None,
			'xs:hexBinary'				=> XmlTokenizedType::None,
			'xs:base64Binary'			=> XmlTokenizedType::None,
			'xs:anyURI'					=> XmlTokenizedType::None,
			'xs:QName'					=> XmlTokenizedType::None,
			'xs:NOTATION'				=> XmlTokenizedType::NOTATION,
			'xs:normalizedString'		=> XmlTokenizedType::None,
			'xs:token'					=> XmlTokenizedType::None,
			'xs:language'				=> XmlTokenizedType::None,
			'xs:name'					=> XmlTokenizedType::None,
			'xs:NCName'					=> XmlTokenizedType::NCName,
			'xs:NMTOKEN'				=> XmlTokenizedType::NMTOKEN,
			'xs:ID'						=> XmlTokenizedType::ID,
			'xs:IDREF'					=> XmlTokenizedType::IDREF,
			'xs:ENTITY'					=> XmlTokenizedType::ENTITY,
			'xs:integer'				=> XmlTokenizedType::None,
			'xs:nonPositiveInteger'		=> XmlTokenizedType::None,
			'xs:long'					=> XmlTokenizedType::None,
			'xs:nonNegativeInteger'		=> XmlTokenizedType::None,
			'xs:negativeInteger' 		=> XmlTokenizedType::None,
			'xs:int'					=> XmlTokenizedType::None,
			'xs:short'					=> XmlTokenizedType::None,
			'xs:byte'					=> XmlTokenizedType::None,
			'xs:positiveInteger' 		=> XmlTokenizedType::None,
			'xs:unsignedLong' 			=> XmlTokenizedType::None,
			'xs:unsignedInt' 			=> XmlTokenizedType::None,
			'xs:unsignedShort'			=> XmlTokenizedType::None,
			'xs:unsignedByte'			=> XmlTokenizedType::None,
			'xs:IDREFS'					=> XmlTokenizedType::IDREFS,
			'xs:ENTITIES'				=> XmlTokenizedType::ENTITIES,
			'xs:NMTOKENS'				=> XmlTokenizedType::NMTOKENS,
			'xsd:string'				=> XmlTokenizedType::None,
			'xsd:boolean'				=> XmlTokenizedType::None,
			'xsd:decimal'				=> XmlTokenizedType::None,
			'xsd:double'				=> XmlTokenizedType::None,
			'xsd:float'					=> XmlTokenizedType::None,
			'xsd:duration'				=> XmlTokenizedType::None,
			'xsd:dateTime'				=> XmlTokenizedType::None,
			'xsd:time'					=> XmlTokenizedType::None,
			'xsd:date'					=> XmlTokenizedType::None,
			'xsd:gYearMonth'			=> XmlTokenizedType::None,
			'xsd:gYear'					=> XmlTokenizedType::None,
			'xsd:gMonthDay'				=> XmlTokenizedType::None,
			'xsd:gDay'					=> XmlTokenizedType::None,
			'xsd:gMonth'				=> XmlTokenizedType::None,
			'xsd:hexBinary'				=> XmlTokenizedType::None,
			'xsd:base64Binary'			=> XmlTokenizedType::None,
			'xsd:anyURI'				=> XmlTokenizedType::None,
			'xsd:QName'					=> XmlTokenizedType::None,
			'xsd:NOTATION'				=> XmlTokenizedType::NOTATION,
			'xsd:normalizedString'		=> XmlTokenizedType::None,
			'xsd:token'					=> XmlTokenizedType::None,
			'xsd:language'				=> XmlTokenizedType::None,
			'xsd:name'					=> XmlTokenizedType::None,
			'xsd:NCName'				=> XmlTokenizedType::NCName,
			'xsd:NMTOKEN'				=> XmlTokenizedType::NMTOKEN,
			'xsd:ID'					=> XmlTokenizedType::ID,
			'xsd:IDREF'					=> XmlTokenizedType::IDREF,
			'xsd:ENTITY'				=> XmlTokenizedType::ENTITY,
			'xsd:integer'				=> XmlTokenizedType::None,
			'xsd:nonPositiveInteger'	=> XmlTokenizedType::None,
			'xsd:long'					=> XmlTokenizedType::None,
			'xsd:nonNegativeInteger'	=> XmlTokenizedType::None,
			'xsd:negativeInteger' 		=> XmlTokenizedType::None,
			'xsd:int'					=> XmlTokenizedType::None,
			'xsd:short'					=> XmlTokenizedType::None,
			'xsd:byte'					=> XmlTokenizedType::None,
			'xsd:positiveInteger' 		=> XmlTokenizedType::None,
			'xsd:unsignedLong' 			=> XmlTokenizedType::None,
			'xsd:unsignedInt' 			=> XmlTokenizedType::None,
			'xsd:unsignedShort'			=> XmlTokenizedType::None,
			'xsd:unsignedByte'			=> XmlTokenizedType::None,
			'xsd:IDREFS'				=> XmlTokenizedType::IDREFS,
			'xsd:ENTITIES'				=> XmlTokenizedType::ENTITIES,
			'xsd:NMTOKENS'				=> XmlTokenizedType::NMTOKENS,
		);
	}
}

XmlTokenizedType::__static();

