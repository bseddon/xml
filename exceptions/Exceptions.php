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

namespace lyquidity\xml\exceptions;

/**
 * Thrown when an argument is not valid
 */
class ArgumentException extends \Exception
{}

/**
 * An expected argument has an unexpected null value
 */
class ArgumentNullException extends \Exception
{}

/**
 * A value argument is out of the expected range
 */
class ArgumentOutOfRangeException extends \Exception
{}

/**
 * A value argument is out of the expected range
 */
class DivideByZeroException extends \Exception
{}

/**
 * String formatting error
 */
class FormatException extends \Exception
{}

/**
 * An index is out of range (usually for an array)
 */
class IndexOutOfRangeException extends \Exception
{}

/**
 * An object cannot be cast to another type
 */
class InvalidCastException extends \Exception
{}

/**
 * An error processing a function or method
 */
class InvalidOperationException extends \Exception
{}

/**
 * A key cannot be found in an array
 */
class KeyNotFoundException extends \Exception
{}

/**
 * An interface member that is not implemented
 */
class NotImplementedException extends \Exception
{}

/**
 * An action is not supported
 */
class NotSupportedException extends \Exception
{}

/**
 * An exception caused when a URI is not well formed
 */
class UriFormatException extends \Exception
{}

/**
 * An error processing an XPath expression
 */
class XPathException extends \Exception
{}

/**
 * A error processing an Xml document
 */
class XmlException extends \Exception
{}

/**
 * An error raised managing the XmlSchemaSets
 */
class XmlSchemaException extends \Exception
{}

