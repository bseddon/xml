<?php

/**
 * Part of the XML Schema library for PHP
 *  _      _ _ _ _
 * | |   _   _  __ _ _   _(_) __| (_) |_ _   _
 * | |  | | | |/ _` | | | | |/ _` | | __| | | |
 * | |__| |_| | (_| | |_| | | (_| | | |_| |_| |
 * |_____\__, |\__, |\__,_|_|\__,_|_|\__|\__, |
 *   |___/    |_|    |___/
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
 * Represents the complexType element from XML Schema as specified by the World
 * Wide Web Consortium (W3C). This class defines a complex type that determines
 * the set of attributes and content of an element.
 */
class XmlSchemaComplexType extends XmlSchemaType
{
	/**
	 * Initializes a new instance of the XmlSchemaComplexType class.
	 */
	public function __construct() {}

	/**
	 * NOT USED
	 * Gets or sets the value for the XmlSchemaAnyAttribute component of the complex type.
	 *
	 * @var XmlSchemaAnyAttribute $AnyAttribute
	 * The XmlSchemaAnyAttribute component of the complex type.
	 */
	public $AnyAttribute = null;

	/**
	 * NOT USED
	 * Gets the collection of attributes for the complex type.
	 *
	 * @var XmlSchemaObjectCollection $Attributes
	 * Contains XmlSchemaAttribute and XmlSchemaAttributeGroupRef classes.
	 */
	public $Attributes = null;

	/**
	 * NOT USED
	 * Gets the collection of all the complied attributes of this complex type and its base types.
	 *
	 * @var XmlSchemaObjectTable $AttributeUses
	 * The collection of all the attributes from this complex type and its base types.
	 * The post-compilation value of the AttributeUses property.
	 */
	public $AttributeUses = null;

	/**
	 * NOT USED
	 * Gets the post-compilation value for anyAttribute for this complex type and its
	 * base type(s).
	 *
	 * @var XmlSchemaAnyAttribute $AttributeWildcard
	 * The post-compilation value of the anyAttribute element.
	 */
	public $AttributeWildcard;

	/**
	 * NOT USED
	 * Gets or sets the block attribute.
	 *
	 * @var XmlSchemaDerivationMethod $Block
	 * The block attribute prevents a complex type from being used in the specified
	 * type of derivation. The default is XmlSchemaDerivationMethod.None.Optional.
	 */
	public $Block = XmlSchemaDerivationMethod::None;

	/**
	 * NOT USED
	 * Gets or sets the post-compilation XmlSchemaContentModel of
	 * this complex type.
	 *
	 * @var XmlSchemaContentModel
	 * The content model type that is one of the XmlSchemaSimpleContent
	 * or XmlSchemaComplexContent classes.
	 */
	public $ContentModel;

	/**
	 * NOT USED
	 * Gets the content model of the complex type which holds the post-compilation value.
	 *
	 * @var XmlSchemaContentType $ContentType
	 * The post-compilation value of the content model for the complex type.
	 */
	public $ContentType = null;

	/**
	 * NOT USED
	 * Gets the particle that holds the post-compilation value of the XmlSchemaComplexType.ContentType
	 * particle.
	 *
	 * @var XmlSchemaParticle $ContentTypeParticle
	 * 		The particle for the content type. The post-compilation value of the XmlSchemaComplexType.ContentType
	 * 		particle.
	 */
	public $ContentTypeParticle = null;

	/**
	 * NOT USED
	 * Gets or sets the information that determines if the complexType element can be
	 * used in the instance document.
	 *
	 * @var bool $IsAbstract
	 * 		If true, an element cannot use this complexType element directly and must use
	 * 		a complex type that is derived from this complexType element. The default is
	 * 		false.Optional.
	 */
	public $IsAbstract = false;

	/**
	 * NOT USED
	 * Gets or sets information that determines if the complex type has a mixed content
	 * model (markup within the content).
	 *
	 * @var bool $IsMixed
	 * 		true, if character data can appear between child elements of this complex type;
	 * 		otherwise, false. The default is false.Optional.
	 */
	public $IsMixed = false;

	/**
	 * NOT USED
	 * Gets or sets the compositor type as one of the XmlSchemaGroupRef,
	 * XmlSchemaChoice, XmlSchemaAll, or XmlSchemaSequence
	 * classes.
	 *
	 * @var XmlSchemaParticle $Particle
	 * The compositor type.
	 *     [XmlElement("choice", typeof(XmlSchemaChoice))]
	 *     [XmlElement("sequence", typeof(XmlSchemaSequence))]
	 *     [XmlElement("group", typeof(XmlSchemaGroupRef))]
	 *     [XmlElement("all", typeof(XmlSchemaAll))]
	 */
	public $Particle;
}