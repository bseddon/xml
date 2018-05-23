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

 use lyquidity\xml\QName;
use lyquidity\xml\exceptions\NotSupportedException;

 /**
 * The base class for all simple types and complex types.
 */
class XmlSchemaType extends XmlSchemaAnnotated
{
	/**
	 * Initializes a new instance of the XmlSchemaType class.
	 */
	public function __construct( ) {}

	/**
	 * NOT USED
	 * Gets the post-compilation value for the base type of this schema type.
	 * @var XmlSchemaType $BaseXmlSchemaType An XmlSchemaType object representing the base type of this schema type.
	 */
	public $BaseXmlSchemaType;

	/**
	 * USED in CoreFuncs::ChangeType
	 * 		in XPath2Convert.ChangeType (451/560)
	 * 		in SequenceTypes.AtomizedValueType (299/304/310)
	 * 		in
	 * Gets the post-compilation value for the data type of the complex type.
	 * @var XmlSchemaDatatype $Datatype The XmlSchemaDatatype post-schema-compilation value.
	 */
	public $Datatype;

	/**
	 * NOT USED
	 * Gets the post-compilation information on how this element was derived from its base type.
	 *
	 * @var XmlSchemaDerivationMethod $DerivedBy One of the valid XmlSchemaDerivationMethod values.
	 */
	public $DerivedBy = null;

	/**
	 * NOT USED
	 * Gets or sets the final attribute of the type derivation that indicates if further
	 * derivations are allowed.
	 *
	 * @var XmlSchemaDerivationMethod $Final
	 *     One of the valid XmlSchemaDerivationMethod values. The default
	 *     is XmlSchemaDerivationMethod.None.
	 */
	public $Final  = XmlSchemaDerivationMethod::None;

	/**
	 * NOT USED
	 * Gets the post-compilation value of the XmlSchemaType.Final property.
	 *
	 * @var XmlSchemaDerivationMethod $FinalResolved
	 *     The post-compilation value of the XmlSchemaType.Final property.
	 *     The default is the finalDefault attribute value of the schema element.
	 */
	public $FinalResolved = XmlSchemaDerivationMethod::None;

	/**
	 * NOT USED
	 * Gets or sets a value indicating if this type has a mixed content model. This
	 * property is only valid in a complex type.
	 *
	 * @var bool $IsMixed true if the type has a mixed content model; otherwise, false. The default is false.
	 */
	public $IsMixed = null;

	/**
	 * NOT USED
	 * Gets or sets the name of the type.
	 *
	 * @var string $Name The name of the type.
	 */
	public $Name = null;

	/**
	 * NOT USED
	 * Gets the qualified name for the type built from the Name attribute of this type.
	 * This is a post-schema-compilation property.
	 *
	 * @var QName $QualifiedName for the type built from the Name attribute of this type.
	 */
	public $QualifiedName = null;

	/**
	 * USED CoreFuncs GetTypedValue 812
	 * Gets the XmlTypeCode of the type.
	 *
	 * @var XmlTypeCode $TypeCode One of the XmlTypeCode values.
	 */
	public $TypeCode = null;

	/**
	 * Returns an XmlSchemaComplexType that represents the built-in
	 * complex type of the complex type specified.
	 *
	 * @param  $typeCode One of the XmlTypeCode values representing the complex type.
	 *
	 * @return XmlSchemaComplexType The type that represents the built-in complex type.
	 */
	public static function GetBuiltInComplexTypeByTypeCode( $typeCode )
	{
		throw new NotSupportedException( "Use DomSchemaType::GetBuiltInComplexTypeByTypeCode");
	}

	/**
	 * Returns an XmlSchemaComplexType that represents the built-in
	 * complex type of the complex type specified by qualified name.
	 *
	 * @param QName $qualifiedName The QName of the complex type.
	 *
	 * @return The XmlSchemaComplexType that represents the built-in complex type.
	 *
	 * @throws ArgumentNullException The XmlQualifiedName parameter is null.
	 */
	public static function GetBuiltInComplexTypeByQName( $qualifiedName )
	{
		throw new NotSupportedException( "Use DomSchemaType::GetBuiltInComplexTypeByQName");
	}

	/**
	 * USED in XPath2Item to infer the xml type (48)
	 *      in CoreFuncs CastToItem (989) and TryProcessTypeName (1598)
	 *      in SequenceType.Create  and to initialize global variable references
	 * Returns an XmlSchemaSimpleType that represents the built-in
	 * simple type of the simple type that is specified by the qualified name.
	 *
	 * @param QName $qualifiedName The QName of the simple type.
	 *
	 * @return XmlSchemaSimpleType that represents the built-in simple type.
	 *
	 * @throws ArgumentNullException The XmlQualifiedName parameter is null.
	 */
	public static function GetBuiltInSimpleTypeByQName( $qualifiedName )
	{
		throw new NotSupportedException( "Use DomSchemaType::GetBuiltInSimpleTypeByQName");
	}

	/**
	 * USED in XPath2Item to infer the xml type (48)
	 *      in CoreFuncs CastToItem (989) and TryProcessTypeName (1598)
	 *      in SequenceType.Create  and to initialize global variable references
	 * Returns an XmlSchemaSimpleType that represents the built-in
	 * simple type of the specified simple type.
	 *
	 * @param XmlTypeCode $typeCode One of the XmlTypeCode values representing the simple type.
	 *
	 * @return XmlSchemaSimpleType that represents the built-in simple type.
	 */
	public static function GetBuiltInSimpleTypeByTypecode( $typeCode )
	{
		throw new NotSupportedException( "Use DomSchemaType::GetBuiltInSimpleTypeByTypecode");
	}

	/**
	 * USED This is the same as SchemaTypes::resolvesToBaseType
	 *      Only the 'Empty' XmlSchemaDerivationMethod value is used (so any derivation method is OK)
	 * 		in SequenceType.Match
	 * 		(423/427) to test if the current sequence is a document whether the derived type is also the same document
	 * 		(457/461) to test if the current sequence is an element whether the derived type is also the same element
	 * 		(487/489) to test if the current sequence is an attribute whether the derived type is also the same attribute
	 * 		(609) to test if the current sequence item is the same sequence item
	 * 		in SequenceType.IsDerivedFrom (1203)
	 *
	 * Returns a value indicating if the derived schema type specified is derived from
	 * the base schema type specified
	 *
	 * @param XmlSchemaType derivedType: The derived XmlSchemaType to test.
	 * @param baseType The base XmlSchemaType to test the derived XmlSchemaTypeagainst.
	 * @param XmlSchemaDerivationMethod $except One of the XmlSchemaDerivationMethod values representing a
	 *         type derivation method to exclude from testing.
	 * @return bool true if the derived type is derived from the base type; otherwise, false.
	 */
	public static function IsDerivedFrom( $derivedType, $baseType, $except )
	{
		throw new NotSupportedException( "Use DomSchemaType::IsDerivedFrom");
	}
}