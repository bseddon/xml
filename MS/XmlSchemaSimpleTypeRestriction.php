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

/**
 * Represents the restriction element for simple types from XML Schema as specified
 * by the World Wide Web Consortium (W3C). This class can be used restricting simpleType element.
 */
class XmlSchemaSimpleTypeRestriction extends XmlSchemaSimpleTypeContent
{
	/**
	 * Initializes a new instance of the  XmlSchemaSimpleTypeRestriction class.
	 * @param QName $qname
	 */
	public function __construct( $qname )
	{

	}

	/**
	 * Gets or sets information on the base type.
	 *
	 * @var XmlSchemaSimpleType $BaseType
	 *     The base type for the simpleType element.
	 */
	public $BaseType;

	/**
	 * Gets or sets the name of the qualified base type.
	 *
	 * @var QName $BaseTypeName
	 *     The qualified name of the simple type restriction base type.
	 */
	public $BaseTypeName;

	/**
	 * Gets or sets an Xml Schema facet.
	 *
	 * @var XmlSchemaObjectCollection $Facets
	 *     One of the following facet classes: XmlSchemaLengthFacet,  XmlSchemaMinLengthFacet,
	 *      XmlSchemaMaxLengthFacet,  XmlSchemaPatternFacet,
	 *      XmlSchemaEnumerationFacet,  XmlSchemaMaxInclusiveFacet,
	 *      XmlSchemaMaxExclusiveFacet,  XmlSchemaMinInclusiveFacet,
	 *      XmlSchemaMinExclusiveFacet,  XmlSchemaFractionDigitsFacet,
	 *      XmlSchemaTotalDigitsFacet,  XmlSchemaWhiteSpaceFacet.
	 *     [XmlElement("pattern", typeof(XmlSchemaPatternFacet))]
	 *     [XmlElement("length", typeof(XmlSchemaLengthFacet))]
	 *     [XmlElement("minLength", typeof(XmlSchemaMinLengthFacet))]
	 *     [XmlElement("maxLength", typeof(XmlSchemaMaxLengthFacet))]
	 *     [XmlElement("minInclusive", typeof(XmlSchemaMinInclusiveFacet))]
	 *     [XmlElement("enumeration", typeof(XmlSchemaEnumerationFacet))]
	 *     [XmlElement("maxInclusive", typeof(XmlSchemaMaxInclusiveFacet))]
	 *     [XmlElement("maxExclusive", typeof(XmlSchemaMaxExclusiveFacet))]
	 *     [XmlElement("totalDigits", typeof(XmlSchemaTotalDigitsFacet))]
	 *     [XmlElement("minExclusive", typeof(XmlSchemaMinExclusiveFacet))]
	 *     [XmlElement("fractionDigits", typeof(XmlSchemaFractionDigitsFacet))]
	 *     [XmlElement("whiteSpace", typeof(XmlSchemaWhiteSpaceFacet))]
	 */
	public $Facets = null;
}