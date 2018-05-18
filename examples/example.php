<?php

/**
 * Part of the XML Schema for PHP library
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

/**
 * This example shows how to create a SchemaType instance filled with the
 * types for an instance docuent that hase a defined XML 'schemaLocation'
 * attribute or imports other schemas.
 */

use lyquidity\xml\schema\SchemaTypes;

// Load the XML type processor files
require_once __DIR__ . '/../bootstrap.php';

// Initialize a logging instance.  This is not necessary if
// the XPath 2.0 or XBRL libraries have been loaded
\lyquidity\xml\initializeLog();

example2();

/**
 * Basic example of loading a document and loading the associated schema types
 * Illustrates:
 * 	using resolve_path to join two paths
 * 	using processSchema to build a SchemmaType instance of all the elements, attributes and types defined in the schema
 */
function example1()
{
	// Get the schema file reference from an XML instance document
	$doc = simplexml_load_file( SchemaTypes::resolve_path( __DIR__, "context-test-cases.xml" ) );
	$types = \lyquidity\xml\importTypesForDocument( $doc );
	$elementType = $types->getElement( "t", "eg" );

	var_dump( $elementType );
}

/**
 * Extends the idea of example1 by reading the attributes of an element finding the respective type and reporting it
 * Illustrates using:
 *  resolve_path to join two paths
 *  processSchema to build a SchemmaType instance of all the elements, attributes and types defined in the schema
 *  resolvesToBaseType to determine the base type of each attribute type
 *  getElement to retrieve information about an element definition (if there is any)
 *  getAttribute to retrieve information about an attribute definition (if there is any)
 *  getPrefixForNamespace to return the prefix used in the schema to reference a namespace. All types and elements are indexed by this prefix
 */
function example2()
{
	$doc = simplexml_load_file( SchemaTypes::resolve_path( __DIR__, "331-equivalentRelationships-01-calculation.xml" ) );
	/**
	 * @var SchemaTypes $types
	 */
	$types = \lyquidity\xml\importTypesForDocument( $doc );

	foreach ( $doc->getDocNamespaces() as $prefix => $namespace )
	{
		if ( ! $prefix ) $prefix = "link";
		$doc->registerXPathNamespace( $prefix, $namespace );
	}

	$nodes = $doc->xpath("/link:linkbase/link:calculationLink/link:calculationArc");
	/**
	 * @var SimpleXMLElement $arc
	 */
	$arc = $nodes[1];
	$arcName = $arc->getName();
	// Use getElement to retrieve the schema definition for an element if it is known (the applicable schema may not have been processed)
	// The prefix used will be the prefix used to identify the namespace as used in the schema.  See below for an example of resolving the prefix.
	$arcElement = $types->getElement( $arcName, "link" );
	if ( $arcElement )
	{
		// If the getElement function is successful then $arcElement will contain an array of information
	}
	else
	{
		// The element definition is unknown
	}

	$namespace = $doc->getDocNamespaces()['t'];
	$attributes = $arc->attributes( $namespace );
	foreach( $attributes as $name => $attribute )
	{
		// Find the prefix of the namespace for 't' as used in the schema
		// NOTE: If the schema did not define one then a random one will have been generated when the schea was processed
		$schemaPrefix = $types->getPrefixForNamespace( $namespace );
		// Use getAtttribute to retrieve information about the attribute (if any)
		$attributeType = $types->getAttribute( $name, $schemaPrefix );
		// Information about the type of the attribute can be accessed
		$type = $types->getType( $name, $schemaPrefix );

		// Sometimes it can be useful to work with a QName class instance.
		$qname = lyquidity\xml\qname( "t:$name", $doc->getDocNamespaces() );
		echo "The clark notation of the attribute is: " . $qname->clarkNotation() . "\n";

		if ( ! $attributeType ) continue;

		// It can be more convenient to use these boolan function to find out the type class
		if ( $types->resolvesToBaseType( "$schemaPrefix:$name", array( "xs:string" ) ) )
		{
			echo "Attribute '$name' is a string '{$attribute}' \n";
		}
		else if ( $types->resolvesToBaseType( "$schemaPrefix:$name", array( "xs:decimal", "xs:double", "xs:float" ) ) )
		{
			echo "Attribute '$name' is a number '{$attribute}' \n";
		}
		// This is an alternative way to determine if the type is numeric.
		else if ( $types->isNumeric( "$schemaPrefix:$name" ) )
		{
			echo "Attribute '$name' is a number '{$attribute}' \n";
		}
		else if ( $types->resolvesToBaseType( "$schemaPrefix:$name", array( "xs:boolean" ) ) )
		{
			echo "Attribute '$name' is a boolean '{$attribute}' \n";
		}

		unset( $attribute );
	}
}

?>