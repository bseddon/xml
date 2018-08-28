<?php

/**
 * QName class and factory functions.  This is ported from Arelle.
 *
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

use lyquidity\xml\schema\SchemaTypes;

/**
 * Definition of the main schema prefix
 */
// BMS 2018-04-09 Fixing the kluge
define( 'SCHEMA_PREFIX', "xs" );
define( 'SCHEMA_PREFIX_ALTERNATIVE', "xsd" );
define( 'SCHEMA_INSTANCE_PREFIX', "xsi" );
define( 'XML_PREFIX', "xml" );
/**
 * Definition of the main schema namespace
 */
define( 'SCHEMA_NAMESPACE', "http://www.w3.org/2001/XMLSchema" );
define( 'SCHEMA_INSTANCE_NAMESPACE', "http://www.w3.org/2001/XMLSchema-instance" );
define( 'XML_NAMESPACE', "http://www.w3.org/XML/1998/namespace" );

/**
 * Generate a QName instance.
 *
 * @param array|string $value	can be a QName, an array or a string.  If a string it will be the
 * 								namespace of the value of $name or a Clark notation.
 * 								If an array then it will be an array representation of the QName.
 * @param array|string $name	Can be an array of prefix/namespace key/value pairs or it can be
 * 								the prefixed local name
 * @param bool $noPrefixIsNoNamespace  If no prefix is found then there will be no namespace if this is true
 * @param Exception $castException		In case there is a cast exception
 * @param Exception $prefixException	In case there is a prefix exception
 * @throws Exception
 * @return QName
 */
function qname( $value, $name = null, $noPrefixIsNoNamespace = false, $castException = null, $prefixException = null )
{
	if ( $value instanceof SimpleXMLElement )
	{
		if ( $name ) // name is prefixed name
		{
			$element = $value;  // may be an attribute
			$value = $name;
			$name = null;
		}
		else
		{
			return new QName( value.prefix, value.namespaceURI, value.localName );
		}
	}
	else if ( $name instanceof SimpleXMLElement )
	{
		$element = $name;
		$name = null;
		$element = null;
		$value = $name;
	}
	else
	{
		$element = null;
	}

	if ( $value instanceof QName )
	{
		return $value;
	}
	else if ( is_array( $value ) )
	{
		if ( ! isset( $value['localname'] ) )
		{
			return null;
		}

		return new QName(
			isset( $value['prefix'] ) ? $value['prefix'] : null,
			isset( $value['namespace'] ) ? $value['namespace'] : null,
			$value['localname']
		);
	}
	else if ( ! is_string( $value ) )
	{
		if ( $castException ) throw $castException;
		return null;
	}

	$namespaceDict = null;
	if ( $value && $value[0] == '{' ) // clark notation (with optional prefix)
	{
		// namespaceURI,sep,prefixedLocalName = value[1:].rpartition('}')
		$matches = null;
		if ( ! preg_match( "/({(?<namespaceURI>.*)})?(?<prefixedLocalName>.*)/", $value, $matches ) )
		{
			return null;
		}
		$namespaceURI = $matches['namespaceURI'];
		$prefixedLocalName = $matches['prefixedLocalName'];

		// prefix,sep,localName = $prefixedLocalName.rpartition(':')
		$matches = null;
		if ( ! preg_match( "/((?<prefix>.*):)?(?<localName>.*)/", $prefixedLocalName, $matches ) )
		{
			return null;
		}
		$prefix = $matches['prefix'];
		$localName = $matches['localName'];

		if ( ! $prefix )
		{
			$prefix = null;
			if ( is_array( $name ) )
			{
				if ( isset( $name[ $namespaceURI ] ) )
				{
					$prefix = $name[ $namespaceURI ];
				}
				else // reverse lookup
				{
					foreach ( $name as $_prefix => $_namespaceURI )
					{
						if ( $_namespaceURI == $namespaceURI )
						{
							$prefix = $_prefix;
							break;
						}
					}
				}
			}
		}
	}
	else
	{
		if ( is_array( $name ) )
		{
			$namespaceURI = null;
			$namespaceDict = $name; // note that functional prefix must be null, not '', in dict
			$namespaceDict['xml'] = XML_NAMESPACE;
		}
		else if ( $name != null )
		{
			$namespaceURI = $name // len > 0
				? $value
				: null;
			$namespaceDict = null;
			$value = $name;
		}
		else
		{
			$namespaceURI = null;
			$namespaceDict = null;
		}
		// prefix,sep,localName = value.strip().partition(":")  # must be whitespace collapsed
		$matches = null;
		if ( ! preg_match( "/((?<prefix>.*):)?(?<localName>.*)/", $value, $matches ) )
		{
			return null;
		}
		$prefix = $matches['prefix'];
		$localName = $matches['localName'];

		if ( ! $prefix )
		{
			$prefix = null; # don't want '' but instead null if no prefix
			if ( $noPrefixIsNoNamespace )
			{
				return new QName( null, null, $localName );
			}
		}
	}

	if ( $namespaceURI )
	{
		return new QName( $prefix, $namespaceURI, $localName );
	}
	else if ( $namespaceDict && isset( $namespaceDict[ $prefix ] ) )
	{
		return new QName( $prefix, $namespaceDict[ $prefix ], $localName );
	}
	else if ( isset( $element ) )
	{
		// same as XmlUtil.xmlns but local for efficiency
		// namespaceURI = element.nsmap.get(prefix)
		$names = $element->getDocNamespaces();
		$namespaceURI = $names[ $prefix ] ? $names[ $prefix ] : null;
		if ( ! $namespaceURI && $prefix == 'xml' )
		{
			$namespaceURI = "http://www.w3.org/XML/1998/namespace";
		}
	}

	if ( ! $namespaceURI )
	{
		if ( $prefix )
		{
			if ( $prefixException ) throw $prefixException;
			return null;  // error, prefix not found
		}
		$namespaceURI = null; # cancel namespace if it is a zero length string
	}

	return new QName( $prefix, $namespaceURI, $localName );
}

/**
 * Convert a namespace/local name pair into a QName instance
 * Does not handle localNames with prefix
 *
 * @param string $namespaceURI
 * @param string $localName
 * @return null|QName
 */
function qnameNsLocalName( $namespaceURI, $localName )
{
	return new QName( null, $namespaceURI ? $namespaceURI : null, $localName );
}

/**
 * Converts a string in the clark notation format to a QName instance
 * Does not handle clark names with prefix
 *
 * @param string $clarkname
 * @return null|QName
 */
function qnameClarkName( $clarkname )
{
	// clark notation (with optional prefix)
	if ( $clarkname && $clarkname[0] == '{' )
	{
		// namespaceURI,sep,prefixedLocalName = value[1:].rpartition('}')
		$matches = null;
		if ( ! preg_match( "/({(?<namespaceURI>.*)})?(?<prefixedLocalName>.*)/", $clarkname, $matches ) )
		{
			return null;
		}
		$namespaceURI = $matches['namespaceURI'] ? $matches['namespaceURI'] : null;
		$prefixedLocalName = $matches['prefixedLocalName'];

		// prefix,sep,localName = $prefixedLocalName.rpartition(':')
		$matches = null;
		if ( ! preg_match( "/((?<prefix>.*):)?(?<localName>.*)/", $prefixedLocalName, $matches ) )
		{
			return null;
		}
		$prefix = $matches['prefix'] ? $matches['prefix'] : null;
		$localName = $matches['localName'] ? $matches['localName'] : null;

		return new QName( $prefix, $namespaceURI, $localName );
	}
	else
	{
		return new QName( null, null, $clarkname );
	}
}

/**
 * Create a QName from a prefix:name pair.  Use the namespace associated
 * with $element to resolve the prefix (if there is one)
 *
 * @param SimpleXMLElement $element
 * @param string $prefixedName
 * @param Exception $prefixException
 * @throws Exceptio
 * @return NULL|QName
 */
function qnameEltPfxName( $element, $prefixedName, $prefixException = null )
{
	$matches = null;
	if ( ! preg_match( "/(?<prefix>.*)?:(?<localName>.*)/", $prefixedName, $matches ) )
	{
		return null;
	}

	if ( ! $matches['prefix'] )
	{
		$prefix = null; // don't want '' but instead null if no prefix
	}

	$names = $element->getDocNamespaces();
	$namespaceURI = $names[ $prefix ] ? $names[ $prefix ] : null;
	if ( ! $namespaceURI )
	{
		if ( $prefix )
		{
			if ( $prefix == 'xml' )
			{
				$namespaceURI = "http://www.w3.org/XML/1998/namespace";
			}
			else
			{
				if ( $prefixException ) throw $prefixException;
				return null;
			}
		}
		else
		{
			$namespaceURI = null; // cancel namespace if it is a zero length string
		}
	}
	return new QName( $prefix, $namespaceURI, $localName );
}

/**
 * Call this function to initialize a default logger.
 * This function does not need to be called if the Lyquidity XPath 2.0 or
 * Lyquidity XBRL library bootstrap functions have been called as both
 * these initialize a suitable logger.
 */
function initializeLog()
{
	/**
	 * Load the Log class if not already loaded
	 */
	if ( ! class_exists( "\\Log", true ) )
	{
		$logPath = isset( $_ENV['LOG_LIBRARY_PATH'] )
			? $_ENV['LOG_LIBRARY_PATH']
			: ( defined( 'LOG_LIBRARY_PATH' ) ? LOG_LIBRARY_PATH : __DIR__ . "/../log/" );

		require_once $logPath . "Log.php";
		/**
		 * Load the event_log handler implementation
		 */
		require_once "$logPath/log/error-log.php";
	}

	$log = \Log::singleton( 'error_log', PEAR_LOG_TYPE_SYSTEM, 'xpath2_log',
		array(
			'lineFormat' => '[%{priority}] %{message}',
		)
	);
}

/**
 * Call to load types for an XML instance document
 * The current SchemaTypes instance will be returned but the same instance
 * can be retrieve any time by calling SchemaTypes::getInstance()
 * @param \SimpleXMLElement $doc A document
 * @return SchemaTypes
 */
function importTypesForDocument( $doc )
{
	if ( ! $doc )
	{
		return false;
	}
	$owner = dom_import_simplexml( $doc )->ownerDocument;

	$attributes = $doc->attributes( SCHEMA_INSTANCE_NAMESPACE );
	if ( ! count( $attributes ) || ! property_exists( $attributes, 'schemaLocation' ) )
	{
		return false;
	}

	$parts = array_filter( preg_split( "/\s/s",  (string)$attributes['schemaLocation'] ) );
	if ( count( $parts ) == 1 ) array_unshift( $parts, '-' );
	// Assume the schema location is relative to this file
	$types = new SchemaTypes();

	$key = "";
	foreach ( $parts as $part )
	{
		if ( empty( $key ) )
		{
			$key = $part;
		}
		else
		{
			$basename = basename( $part );
			$path = SchemaTypes::resolve_path( null, $basename );
			$types->processSchema( $path, true );
			$key = "";
		}
	}

	return $types;
}

/**
 * Examines the content to determine if the content represent an XML document
 * @param string $content
 * @param bool $throwException
 * @return bool
 * @throws \Exception
 */
function isXml( $content, $throwException = true )
{
	// Use strpos because the xml document might start with comments
	if ( empty( $content ) || strpos( $content, "<?xml" ) === false )
	{
		$previous = libxml_use_internal_errors(true);
		$xml = \simplexml_load_string( $content );
		libxml_use_internal_errors( $previous );
		if ( $xml !== false ) return $xml;
		if ( ! $throwException ) return false;
		throw new \Exception( __( "The file does not contain a valid XML document", 'xbrl_validate' ) );
	}

	return true;
}


?>