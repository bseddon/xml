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

use \lyquidity\xml\exceptions\NotSupportedException;


/**
 * Class to represent the
 */
abstract class XmlSchemaDatatype
{
	/**
	 * Initializes a new instance of the XmlSchemaDatatype class.
	 *
	 */
	protected function __construct()
	{
	}

	/**
	 * When overridden in a derived class, gets the type for the string as specified
	 * in the World Wide Web Consortium (W3C) XML 1.0 specification.
	 *
	 * @var XmlTokenizedType $TokenizedType An XmlTokenizedType (enum) value for the string.
	 *
	 */
	public $TokenizedType = null;

	/**
	 * Gets the XmlTypeCode value for the simple type that has anySimpleType as the direct parent type.
	 *
	 * @var XmlTypeCode $TypeCode The XmlTypeCode value for the simple type.
	 */
	public $TypeCode = null;

	/**
	 * When overridden in a derived class, gets the PHP Runtime type of the item.
	 *
	 * @var Type ValueType The PHP engine type of the item.
	 */
	public $ValueType = null;

	/**
	 * Gets the XmlSchemaDatatypeVariety value for the simple type.
	 *
	 * @var XmlSchemaDatatypeVariety $Variety The XmlSchemaDatatypeVariety value for the simple type.
	 */
	public $Variety = null;

	/**
	 * NOT USED
	 * Converts the value specified, whose type is one of the valid Common Language
	 * Runtime (CLR) representations of the XML schema type represented by the XmlSchemaDatatype,
	 * to the CLR type specified.
	 *
	 * @param object $value The input value to convert to the specified type.
	 * @param Type $targetType The target type to convert the input value to.
	 *
	 * @return mixed The converted input value.
	 *
	 * @throws
	 *   ArgumentNullException the object or Type parameter is null.
	 *   InvalidCastException The type represented by the XmlSchemaDatatype does not support a conversion from type of the value specified to the type specified.
	 */
	public function ChangeType1( $value, $targetType )
	{
		throw new NotSupportedException( "XmlSchemaDatatype::ChangeType" );
	}

	/**
	 * NOT USED
	 * Converts the value specified, whose type is one of the valid Common Language
	 * Runtime (CLR) representations of the XML schema type represented by the XmlSchemaDatatype,
	 * to the CLR type specified using the System.Xml.IXmlNamespaceResolver if the XmlSchemaDatatype
	 * represents the xs:QName type or a type derived from it.
	 *
	 * @param object $value  The input value to convert to the specified type.
	 * @param Type $targetType The target type to convert the input value to.
	 * @param IXmlNamespaceResolver $namespaceResolver
	 *     An IXmlNamespaceResolver used for resolving namespace prefixes. This
	 *     is only of use if the XmlSchemaDatatype represents the xs:QName
	 *     type or a type derived from it.
	 *
	 * @return object The converted input value.
	 *
	 * @throws
	 *   ArgumentNullException Object or Type parameter is null.
	 *   InvalidCastException The type represented by the XmlSchemaDatatype does not support
	 *     a conversion from type of the value specified to the type specified.
	 */
	public function ChangeType2( $value, $targetType, $namespaceResolver )
	{
		throw new NotSupportedException( "XmlSchemaDatatype::ChangeType2" );
	}

	/**
	 * NOT USED
	 * The XmlSchemaDatatype.IsDerivedFrom(XmlSchemaDatatype) method always returns false.
	 *
	 * @param XmlSchemaDatatype $datatype
	 * @return bool Always returns false.
	 */
	public function IsDerivedFrom( $datatype )
	{
		return false;
	}

	/**
	 * NOT USED
	 * When overridden in a derived class, validates the string specified against a built-in or user-defined simple type.
	 *
	 * @param string $s The string to validate against the simple type.
	 * @param XmlNameTable $nameTable The XmlNameTable to use for atomization while parsing the string if
	 *     this XmlSchemaDatatype object represents the xs:NCName type.
	 * @param IXmlNamespaceResolver $nsmgr The object to use while parsing the string if
	 *     this XmlSchemaDatatype object represents the xs:QName type.
	 *
	 * @return object An object that can be cast safely to the type returned by the XmlSchemaDatatype.ValueType property.
	 *
	 * @throws
	 *   XmlSchemaValidationException : The input value is not a valid instance of this W3C XML Schema type.
	 *   ArgumentNullException : The value to parse cannot be null.
	 */
	public function ParseValue( $s, $nameTable, $nsmgr )
	{
		throw new NotSupportedException( "XmlSchemaDatatype::ParseValue" );
	}

}
