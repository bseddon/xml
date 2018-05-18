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
 * The base class for any element that can contain annotation elements.
 */
class XmlSchemaAnnotated extends XmlSchemaObject
{
	/**
	 * Initializes a new instance of the System.Xml.Schema.XmlSchemaAnnotated class.
	 */
	public function __construct() {}

	/**
	 * Gets or sets the annotation property.
	 *
	 * @var XmlSchemaAnnotation $Annotation representing the annotation property.
	 */
	public $Annotation;

	/**
	 * Gets or sets the string id.
	 *
	 * @var string $id The default is an optional empty String
	 */
	public $Id;

	/**
	 * Gets or sets the qualified attributes that do not belong to the current schema's target namespace.
	 *
	 * @var array $UnhandledAttributes XmlAttribute[]
	 *     An array of qualified System.Xml.XmlAttribute objects that do not belong to the
	 *     schema's target namespace.
	 */
	public $UnhandledAttributes = array();
}
