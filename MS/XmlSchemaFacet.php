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

/**
 * Abstract class for all facets that are used when simple types are derived by restriction.
 */
abstract class XmlSchemaFacet extends XmlSchemaAnnotated
{
	/**
	 * Initializes a new instance of the XmlSchemaFacet class.
	 */
	public function __construct() {}

	/**
	 * Gets or sets information that indicates that this facet is fixed.
	 *
	 * @var bool $IsFixed
	 *     If true, value is fixed; otherwise, false. The default is false.Optional.
	 */
	public $IsFixed = false;

	/**
	 * Gets or sets the value attribute of the facet.
	 *
	 * @var string $Value
	 *     The value attribute.
	 */
	public $Value;
}

/**
 * Represents the pattern element from XML Schema as specified by the World Wide
 * Web Consortium (W3C). This class can be used to specify a restriction on the
 * value entered for a simpleType element.
 */
class XmlSchemaLengthFacet extends XmlSchemaFacet
{
	/**
	 * Initializes a new instance of the Facet class.
	 */
	public function __construct() {}
}

/**
 * Represents the pattern element from XML Schema as specified by the World Wide
 * Web Consortium (W3C). This class can be used to specify a restriction on the
 * value entered for a simpleType element.
 */
class XmlSchemaMaxLengthFacet extends XmlSchemaFacet
{
	/**
	 * Initializes a new instance of the Facet class.
	 */
	public function __construct() {}
}

/**
 * Represents the pattern element from XML Schema as specified by the World Wide
 * Web Consortium (W3C). This class can be used to specify a restriction on the
 * value entered for a simpleType element.
 */
class XmlSchemaMinInclusiveFacet extends XmlSchemaFacet
{
	/**
	 * Initializes a new instance of the Facet class.
	 */
	public function __construct() {}
}

/**
 * Represents the pattern element from XML Schema as specified by the World Wide
 * Web Consortium (W3C). This class can be used to specify a restriction on the
 * value entered for a simpleType element.
 */
class XmlSchemaMinLengthFacet extends XmlSchemaFacet
{
	/**
	 * Initializes a new instance of the Facet class.
	 */
	public function __construct() {}
}

/**
 * Represents the pattern element from XML Schema as specified by the World Wide
 * Web Consortium (W3C). This class can be used to specify a restriction on the
 * value entered for a simpleType element.
 */
class XmlSchemaPatternFacet extends XmlSchemaFacet
{
	/**
	 * Initializes a new instance of the Facet class.
	 */
	public function __construct() {}
}

/**
 * Represents the pattern element from XML Schema as specified by the World Wide
 * Web Consortium (W3C). This class can be used to specify a restriction on the
 * value entered for a simpleType element.
 */
class XmlSchemaEnumerationFacet extends XmlSchemaFacet
{
	/**
	 * Initializes a new instance of the Facet class.
	 */
	public function __construct() {}
}

/**
 * Represents the pattern element from XML Schema as specified by the World Wide
 * Web Consortium (W3C). This class can be used to specify a restriction on the
 * value entered for a simpleType element.
 */
class XmlSchemaMaxExclusiveFacet extends XmlSchemaFacet
{
	/**
	 * Initializes a new instance of the Facet class.
	 */
	public function __construct() {}
}

/**
 * Represents the pattern element from XML Schema as specified by the World Wide
 * Web Consortium (W3C). This class can be used to specify a restriction on the
 * value entered for a simpleType element.
 */
class XmlSchemaTotalDigitsFacet extends XmlSchemaFacet
{
	/**
	 * Initializes a new instance of the Facet class.
	 */
	public function __construct() {}
}

/**
 * Represents the pattern element from XML Schema as specified by the World Wide
 * Web Consortium (W3C). This class can be used to specify a restriction on the
 * value entered for a simpleType element.
 */
class XmlSchemaMinExclusiveFacet extends XmlSchemaFacet
{
	/**
	 * Initializes a new instance of the Facet class.
	 */
	public function __construct() {}
}

/**
 * Represents the pattern element from XML Schema as specified by the World Wide
 * Web Consortium (W3C). This class can be used to specify a restriction on the
 * value entered for a simpleType element.
 */
class XmlSchemaFractionDigitsFacet extends XmlSchemaFacet
{
	/**
	 * Initializes a new instance of the Facet class.
	 */
	public function __construct() {}
}

/**
 * Represents the pattern element from XML Schema as specified by the World Wide
 * Web Consortium (W3C). This class can be used to specify a restriction on the
 * value entered for a simpleType element.
 */
class XmlSchemaWhiteSpaceFacet extends XmlSchemaFacet
{
	/**
	 * Initializes a new instance of the Facet class.
	 */
	public function __construct() {}
}

