<?php

/**
 * Implements class to hold and manage types.
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
 */

namespace lyquidity\xml\schema;

require_once 'SchemaException.php';

use lyquidity\Log;
use lyquidity\xml\QName;

require_once __DIR__ . "/../functions.php";
\lyquidity\xml\initializeLog();

/**
 * Class implementation
 */
class SchemaTypes
{
	/**
	 * Pattern for the start character of a name
	 * @var string $nameStartChar
	 */
	public static $nameStartChar;
	/**
	 * Pattern for the character in the body of a name
	 * @var string $nameChar
	 */
	public static $nameChar;
	/**
	 * Pattern for the body of a name
	 * @var string $name
	 */
	public static $name;
	/**
	 * Pattern for the whole of a name
	 * @var string $ncName
	 */
	public static $ncName;

	/**
	 * A list of all the built-in schema types
	 * @var array
	 */
	private static $xsTypes;

	/**
	 * A reference to this singleton instance
	 *
	 * @var Singleton
	 */
	private static $instance;

	/**
	 * An indexed array of types.  The index is "{$standardPrefix}:{$localName}}"
	 *
	 * @var array
	 */
	protected $types = array();

	/**
	 * An indexed array of attributes.  The index is "{$standardPrefix}:{$localName}}"
	 *
	 * @var array
	 */
	protected $attributes = array();

	/**
	 * An indexed array of attributeGroups.  The index is "{$standardPrefix}:{$localName}}"
	 *
	 * @var array
	 */
	protected $attributeGroups = array();

	/**
	 * An indexed array of elements.  The index is "{$standardPrefix}:{$localName}}"
	 *
	 * @var array
	 */
	protected $elements = array();

	/**
	 * A list of the schemas already processed
	 * @var array
	 */
	protected $processedSchemas = array();

	/**
	 * Flag to test if base types (schema specification) need to be loaded.
	 * @var string
	 */
	private $baseTypesLoaded = false;

	/**
	 * The prefix used for the schema namespace.  NULL if no prefix is used.
	 * @var string
	 */
	private $activeSchemaPrefix = null;

	/**
	 * A list of types that include an id indexed by that id
	 * @var array $typeIds
	 */
	protected $typeIds = array();

	/**
	 * Used by processElement to record the global element that is being processed.
	 * This is to allow recursive ref ids to locate the global parent before the
	 * global parent has finished being processed.
	 * @var array $currentGlobalElement
	 */
	private $currentGlobalElement;

	/**
	 * A map of the namespaces used to their 'correct' prefix where 'correct' is the one defined
	 * by the the original schema.  For example, the standard prefix for the Xml Schema Instance
	 * (with prefix 'xsi' for namespace http://www.w3.org/2001/XMLSchema-instance) can be anything
	 * else in a user defined schema.
	 * @var array
	 */
	protected $namespacePrefixMap = array();

	/**
	 * A log instance initialized in the constructor
	 * @var \XBRL_Log $log
	 */
	public $log = null;

	/**
	 * Static constructor
	 */
	public static function __static()
	{
		SchemaTypes::$nameStartChar = "[:_\.\p{Ll}\p{Lu}\p{Lt}\p{Lo}]";
		SchemaTypes::$nameChar = "[:_\-.\p{L}\p{Ll}\p{M}\p{Nd}\p{Nl}]";
		SchemaTypes::$name = SchemaTypes::$nameStartChar .  SchemaTypes::$nameChar . "*";
		SchemaTypes::$ncName = "(?:(?!:)" . SchemaTypes::$nameStartChar. ")(?:(?!:)" . SchemaTypes::$nameChar . ")*";

		// SchemaTypes are organized hierarchically
		// BMS 2018-04-09 Fixing the kluge
		SchemaTypes::$xsTypes = array(
			'xs:anyType'				=> null,
			'xs:anySimpleType'			=> 'xs:anyType',
			'xs:string'					=> 'xs:anySimpleType',
			'xs:boolean'				=> 'xs:anySimpleType',
			'xs:decimal'				=> 'xs:anySimpleType',
			'xs:double'					=> 'xs:anySimpleType',
			'xs:float'					=> 'xs:anySimpleType',
			'xs:duration'				=> 'xs:anySimpleType',
			'xs:dateTime'				=> 'xs:anySimpleType',
			'xs:time'					=> 'xs:anySimpleType',
			'xs:date'					=> 'xs:anySimpleType',
			'xs:gYearMonth'				=> 'xs:anySimpleType',
			'xs:gYear'					=> 'xs:anySimpleType',
			'xs:gMonthDay'				=> 'xs:anySimpleType',
			'xs:gDay'					=> 'xs:anySimpleType',
			'xs:gMonth'					=> 'xs:anySimpleType',
			'xs:hexBinary'				=> 'xs:anySimpleType',
			'xs:base64Binary'			=> 'xs:anySimpleType',
			'xs:anyURI'					=> 'xs:anySimpleType',
			'xs:QName'					=> 'xs:anySimpleType',
			'xs:NOTATION'				=> 'xs:anySimpleType',
			'xs:NOTATION'				=> 'xs:anySimpleType',
			'xs:normalizedString'		=> 'xs:string',
			'xs:token'					=> 'xs:normalizedString',
			'xs:Name'					=> 'xs:token',
			'xs:NCName'					=> 'xs:Name',
			'xs:NMTOKEN'				=> 'xs:token',
			'xs:NMTOKENS'				=> 'xs:NMTOKEN',
			'xs:language'				=> 'xs:token',
			'xs:ID'						=> 'xs:NCName',
			'xs:IDREF'					=> 'xs:NCName',
			'xs:ENTITY'					=> 'xs:NCName',
			'xs:IDREFS'					=> 'xs:IDREF',
			'xs:ENTITIES'				=> 'xs:ENTITY',
			'xs:integer'				=> 'xs:decimal',
			'xs:nonPositiveInteger'		=> 'xs:integer',
			'xs:long'					=> 'xs:integer',
			'xs:nonNegativeInteger'		=> 'xs:integer',
			'xs:negativeInteger' 		=> 'xs:nonPositiveInteger',
			'xs:int'					=> 'xs:long',
			'xs:short'					=> 'xs:int',
			'xs:byte'					=> 'xs:short',
			'xs:positiveInteger' 		=> 'xs:nonNegativeInteger',
			'xs:unsignedLong' 			=> 'xs:nonNegativeInteger',
			'xs:unsignedInt' 			=> 'xs:unsignedLong',
			'xs:unsignedShort'			=> 'xs:unsignedInt',
			'xs:unsignedByte'			=> 'xs:unsignedShort',
			'xs:anyComplexType'			=> 'xs:anyType',
			'xs:untypedAtomic'			=> 'xs:anySimpleType',
			// Not really a type but trying to find an easy way to accommodate
			// unions of simple types such as xbrli:dateTimeItemType
			'xs:UNION'					=> 'xs:anySimpleType',
			'xs:yearMonthDuration'		=> 'xs:duration',
			'xs:dayTimeDuration'		=> 'xs:duration',
		);
	}

	/**
	 * Find out if $haystack starts with $needle
	 * @param string $haystack
	 * @param string $needle
	 * @return bool
	 */
	public static function startsWith( $haystack, $needle )
	{
		return strpos( $haystack, $needle ) === 0;
	}

	/**
	 * Find out if $haystack ends with $needle
	 * @param string $haystack
	 * @param string $needle
	 * @return boolean
	 */
	public static function endsWith( $haystack, $needle )
	{
		$strlen = strlen( $haystack );
		$testlen = strlen( $needle );
		if ( $testlen > $strlen ) return false;
		return substr_compare( $haystack, $needle, $strlen - $testlen, $testlen ) === 0;
	}

	/**
	 * Used to compute an absolute path for a resource ($target) with respect to a source.
	 * For example, the presentation linkbase file will be specified as relative to the
	 * location of the host schema.
	 * @param string $source The resource for the source
	 * @param string $target The resource for the target
	 * @return string
	 */
	public static function resolve_path( $source, $target )
	{
		$target = urldecode( $target );

		$source = str_replace( '\\', '/', $source );
			// Remove any // instances as they confuse the path normalizer but take care to
		// not to remove ://
		$offset = 0;
		while ( true )
		{
			$pos = strpos( $source, "//", $offset );
			if ( $pos === false ) break;
			$offset = $pos + 2;
			// Ignore :// (eg https://)
			if ( $pos > 0 && $source[ $pos-1 ] == ":" ) continue;
			$source = str_replace( "//", "/", $source );
			$offset--;
		}

		$source = pathinfo( $source, PATHINFO_EXTENSION ) === ""
			? $source
			: pathinfo( $source, PATHINFO_DIRNAME );

		$sourceIsUrl = filter_var( $source, FILTER_VALIDATE_URL );
		$targetIsUrl = filter_var( $target, FILTER_VALIDATE_URL );

		// Absolute
		if ( filter_var( $target, FILTER_VALIDATE_URL ) || ( strtoupper( substr( PHP_OS, 0, 3 ) ) === 'WIN' && ( $target[1] === ':' || substr( $target, 0, 2 ) === '\\\\' ) ) )
			$path = $target;

		// Relative to root
		elseif ( $target[0] === '/' || $target[0] === '\\' )
		{
			$root = SchemaTypes::get_schema_root( $source );
			$path = $root . $target;
		}
		// Relative to source
		else
			$path = $source . "/" . $target;

		// Process the components
		// BMS 2018-06-06 By ignoring a leading slash the effect is to create relative paths on linux
		//				  However, its been done to handle http://xxx sources.  But this is not necessary (see below)
		$parts = explode( '/', $path );
		$safe = array();
		foreach ( $parts as $idx => $part )
		{
			// if ( empty( $part ) || ( '.' === $part ) )
			if ( '.' === $part )
			{
				continue;
			}
			elseif ( '..' === $part )
			{
				array_pop( $safe );
				continue;
			}
			else
			{
				$safe[] = $part;
			}
		}

		// BMS 2108-06-06 See above
		return implode( '/', $safe );

		// Return the "clean" path
		return $sourceIsUrl || $targetIsUrl
			? str_replace( ':/', '://', implode( '/', $safe ) )
			: implode( '/', $safe );
	}

	/**
	 * Used by resolve_path to obtain the root element of a uri or file path.
	 * This is necessary because a schema or linkbase uri may be absolute but without a host.
	 *
	 * @param string The file
	 * @return string The root
	 */
	private static function get_schema_root( $file )
	{
		if ( filter_var( $file, FILTER_VALIDATE_URL ) === false )
		{
			// my else codes goes
			if ( strtoupper( substr( PHP_OS, 0, 3 ) ) === 'WIN' )
			{
				// First case is c:\
				if ( strlen( $file ) > 1 && substr( $file, 1, 1 ) === ":" )
					$root = "{$file[0]}:";
				// Second case is a volume
				elseif ( strlen( $file ) > 1 && substr( $file, 0, 2 ) === "\\\\" )
				{
					$pos = strpos( $file, '\\', 2 );

					if ( $pos === false )
						$root = $file;
					else
						$root = substr( $file, 0, $pos );
				}
				// The catch all is that no root is provided
				else
					$root = pathinfo( $file, PATHINFO_EXTENSION ) === ""
						? $file
						: pathinfo( $file, PATHINFO_DIRNAME );
			}
		}
		else
		{
			$components = parse_url( $file );
			$root = "{$components['scheme']}://{$components['host']}";
		}

		return $root;
	}

	/**
	 * Get an instance of the types singleton
	 * @param Function $instance (optional) A potentially descendant instance to use
	 * @return SchemaTypes
	 */
	public static function &getInstance( $instance = null )
	{
		if ( is_null( self::$instance ) )
		{
			self::$instance = $instance ? $instance : new self();
			// if ( $callback ) $callback( self::$instance );
		}
		return self::$instance;
	}

	/**
	 * Default constructor
	 */
	public function __construct()
	{
		// Default logger
		$this->log = \Log::singleton( 'error_log', PEAR_LOG_TYPE_SYSTEM, 'xbrl_log',
			array(
				'lineFormat' => '[%{priority}] %{message}',
			)
		);
		$this->createBaseTypes();
	}

	/**
	 * The prefix is replaced with its namespace
	 * @param string $qname
	 */
	public function normalizePrefix( $qname )
	{
		$prefix = strstr( $qname, ":", true );
		if ( isset( $this->namespacePrefixMap[ $prefix ] ) )
		{
			$qname = str_replace( "$prefix:", "{$this->namespacePrefixMap[ $prefix ]}:", $qname );
		}

		return $qname;
	}

	/**
	 * Add a simple type as a child of xs:anySimpleType
	 *
	 * @param string $prefix
	 * @param string $localName
	 * @param string $parentType
	 * @param bool $numeric
	 * @return bool True if adding was successful. False if the type already exists
	 */
	public function AddSimpleType( $prefix, $localName, $parentType = "xs:anySimpleType", $numeric = false )
	{
		$name = "$prefix:$localName";

		if ( isset( $this->types[ $name ] ) ) return false;

		$parentType = is_null( $parentType ) ? "xs:anySimpleType" : $parentType;

		$this->types[ $name ] = array(
			"parent" => $parentType,
			"prefix" => $prefix,
			"name" => $localName,
			"numeric" => false,
		);

		// BMS 2018-04-09 Fixing the kluge
		if ( $prefix == SCHEMA_PREFIX && ! isset( SchemaTypes::$xsTypes[ $name ] ) )
		{
			SchemaTypes::$xsTypes[ $name ] = $parentType;
		}
	}

	/**
	 * Add an entry to the global attributes list
	 * @param string $prefix
	 * @param string $name
	 * @param string $parentType (optional default: "xs:anySimpleType")
	 * @return boolean|mixed
	 */
	public function AddAttribute( $prefix, $name, $parentType = "xs:anySimpleType" )
	{
		$attribute = array();

		$parts = explode( ":", $parentType );
		$parentLocalName = count( $parts ) == 1 ? $parts[0] : $parts[1];
		// BMS 2018-04-09 Fixing the kluge
		$parentPrefix = count( $parts ) == 1 ? SCHEMA_PREFIX : $parts[0];

		$type = $this->getType( $parentLocalName, $parentPrefix );
		if ( ! $type )
		{
			return false;
		}

		$attribute['types'][] = $type;

		$attribute += array(
			'name' => $name,
			'prefix' => $prefix,
			'use' => "optional",
			'class' => 'attribute',
		);

		$this->attributes[ "$prefix:$name"] = $attribute;

		return $this->attributes[ "$prefix:$name"];
	}

	/**
	 * Remove all existing element information
	 * @return void
	 */
	public function clearElements()
	{
		$this->elements = array();
	}

	/**
	 * Complex types and groups may contain nested elements
	 * The purpose of this function is to retrieve such nested elements
	 * @param array|string $type The name of a type or an array representing a type
	 */
	public function gatherElementsFromType( $type )
	{
		if ( is_string( $type ) )
		{
			$type = $this->getType( $type );
		}

		if ( ! is_array( $type ) ) return false;

		$elements = array();

		foreach ( array( 'elements', 'sequence', 'choice', 'group' ) as $typeComponent )
		{
			if ( ! isset( $type[ $typeComponent ] ) )
			{
				continue;
			}

			foreach ( $type[ $typeComponent ] as $id => $element )
			{
				if ( $id == 'restrictionType')
				{
					continue;
				}

				if ( $id == 'elements' )
				{
					$elements += $element;
					continue;
				}

				$result = $this->gatherElementsFromType( $element );
				if ( ! $result )
				{
					$elements[ "{$element['prefix']}:{$element['name']}" ] = $element;
				}

				$elements += $result;
			}

		}

		return $elements;
	}

	/**
	 * Returns a list of the schema that have been processed and types collected
	 * @return array An array of namespaces indexed by prefix
	 */
	public function getProcessedSchemas()
	{
		return $this->processedSchemas;
	}

	/**
	 * Returns true if the $prefix is in the $processedSchemas array
	 *
	 * @param string $prefix
	 * @return boolean
	 */
	public function hasProcessedSchema( $prefix )
	{
		return isset( $this->processedSchemas[ $prefix ] );
	}

	/**
	 * Used to cache a reverse lookup table to $this->processedSchemas
	 * @var array
	 */
	private $processedSchemasByNamespace;

	/**
	 * Get the prefix of a processed schema with target namespace of $namespace
	 *
	 * @param string $namespace
	 * @return string|false  Will return the prefix or false if one does not exist
	 */
	public function getPrefixForNamespace( $namespace )
	{
		if ( ! isset( $this->processedSchemasByNamespace ) ||
			 count( $this->processedSchemasByNamespace ) != count( $this->processedSchemas )
		)
		{
			$this->processedSchemasByNamespace = array_flip( $this->processedSchemas );
		}

		return isset( $this->processedSchemasByNamespace[ $namespace ] )
			? $this->processedSchemasByNamespace[ $namespace ]
			: false;
	}

	/**
	 * Adds the prefix to the list of processed schemas
	 * @param string $prefix
	 * @param string $namespace
	 */
	public function setProcessedSchema( $prefix, $namespace )
	{
		$this->processedSchemas[ $prefix ] = $namespace;
	}

	/**
	 * Return true if a named element exists
	 *
	 * @param string $name
	 * @param string $prefix
	 * @return boolean
	 */
	public function hasElement( $name, $prefix = null )
	{
		return isset( $this->elements[ is_null( $prefix ) ? $name : "$prefix:$name" ] );
	}

	/**
	 * Return a named element
	 *
	 * @param string $name
	 * @param string $prefix
	 * @return boolean|array
	 */
	public function getElement( $name, $prefix = null )
	{
		return $this->hasElement( $name, $prefix )
			? $this->elements[ is_null( $prefix ) ? $name : "$prefix:$name" ]
			: false;
	}

	/**
	 * Return an array of all elements in the $substitutionGroup
	 * @param string $substitutionGroup
	 * @return array[QName]
	 */
	public function getElementsInSubstitutionGroup( $substitutionGroup )
	{
		// Check the substitution group exists as an element
		if ( isset( $this->elements[ $substitutionGroup ] ) )
		{
			$result[] = \lyquidity\xml\qname( $substitutionGroup, $this->processedSchemas );
		}
		else if ( ! isset( $this->types[ $substitutionGroup ] ) )
		{
			return false;
		}

		foreach ( $this->elements as $key => $element )
		{
			if ( ! isset( $element['substitutionGroup'] ) )
			{
				continue;
			}

			if ( ! $this->resolveToSubstitutionGroup( $element['substitutionGroup'], array( $substitutionGroup ) ) )
			{
				continue;
			}

			$result[] = \lyquidity\xml\qname( $key, $this->processedSchemas );
		}

		return $result;
	}

	/**
	 * Return true if a named type exists
	 *
	 * @param string $name
	 * @param string $prefix
	 * @return boolean
	 */
	public function hasType( $name, $prefix = null )
	{
		return isset( $this->types[ is_null( $prefix ) ? $name : "$prefix:$name" ] );
	}

	/**
	 * Return a named type
	 *
	 * @param string $name
	 * @param string $prefix The prefix does not need to be supplied if it is already part of the name
	 * @return boolean|array
	 */
	public function getType( $name, $prefix = null )
	{
		// It can be the case that the type passed in is an array.  This can happen if the type for an
		// element is defined in the schema as simpleContent extending some base type by restriction.
		// In case this could be the case, look for an array with an element key of 'class' and value
		// 'simple'. If found, there should be an element with a key of 'parent'.  Use this.
		if ( is_array( $name ) && isset( $name['class'] ) && isset( $name['parent'] ) )
		{
			$name = $name['parent'];
		}

		if ( strpos( $name, ":" ) === false && is_null( $prefix ) )
		{
			// Assume xs
			$prefix = "xs";
		}

		return $this->hasType( $name, $prefix )
			? $this->types[ is_null( $prefix ) ? $name : "$prefix:$name" ]
			: false;
	}

	/**
	 * Get all the types associated with a union type
	 * @param QName|string $qname
	 * @return array
	 */
	public function getSimpleTypesFromUnion( $qname )
	{
		$name = $qname instanceof QName ? "{$qname->prefix}:{$qname->localName}" : $qname;

		while (true)
		{
			if ( ! $this->hasType( $name ) ) return array();

			$type = $this->getType( $name );
			if ( isset( $type['restrictionType'] ) && $type['restrictionType'] == 'union' )
			{
				return $type['types'];
			}

			if ( ! isset( $type['parent'] ) ) return array();
			$name = $type['parent'];

		}
	}

	/**
	 * Returns true if the type is union
	 * @param QName|string $qname
	 * @return bool
	 */
	public function isUnionType( $qname )
	{
		$name = $qname instanceof QName ? "{$qname->prefix}:{$qname->localName}" : $qname;

		$type = $this->getType( $name );
		if ( ! $type ) return false;

		if ( isset( $type['restrictionType'] ) && $type['restrictionType'] == 'union' )
		{
			return true;
		}

		if ( ! isset( $type['parent'] ) ) return false;
		$name = $type['parent'];

		$type = $this->getType( $name );
		if ( ! $type ) return false;

		return isset( $type['restrictionType'] ) && $type['restrictionType'] == 'union';
	}

	/**
	 * Try to access a type by an id
	 * @param array $id
	 * @param string $prefix The prefix does not need to be supplied if it is already part of the name
	 * @return boolean|array
	 */
	public function getTypeById( $id, $prefix = null )
	{
		if ( ! isset( $this->typeIds[ $id ] ) ) return false;
		return isset( $this->typeIds[ $id ]['istype'] ) && $this->typeIds[ $id ]['istype']
			? $this->getType( $this->typeIds[ $id ]['name'], $prefix )
			: $this->getElement( $this->typeIds[ $id ]['name'], $prefix );
	}

	/**
	 * Return true if a named attribute exists
	 *
	 * @param string $name
	 * @param string $prefix
	 * @return boolean
	 */
	public function hasAttribute( $name, $prefix )
	{
		return isset( $this->attributes[ "$prefix:$name" ] );
	}

	/**
	 * Return true if a named attribute group exists
	 *
	 * @param string $name
	 * @param string $prefix
	 * @return boolean
	 */
	public function hasAttributeGroup( $name, $prefix )
	{
		return isset( $this->attributeGroups[ "$prefix:$name" ] );
	}

	/**
	 * Return a named attribute
	 *
	 * @param string $name
	 * @param string $prefix
	 * @return boolean|array
	 */
	public function getAttribute( $name, $prefix )
	{
		return $this->hasAttribute( $name, $prefix )
			? $this->attributes[ "$prefix:$name" ]
			: (
				$this->hasAttributeGroup( $name, $prefix )
					? $this->attributeGroups[ "$prefix:$name" ]
					: false
			  );
	}

	/**
	 * Load types from a schema file
	 *
	 * @param string $xsd
	 * @param bool $includeElements
	 * @return bool
	 */
	public function processSchema( $xsd, $includeElements = false )
	{
		libxml_use_internal_errors();

		$xml = @simplexml_load_file( $xsd );
		if ( ! $xml )
		{
			return false;
		}

		$activeSchemaPrefix = null;

		$prefix = null;
		$targetNamespace = (string) $xml->attributes()->targetNamespace;
		foreach ( $xml->getDocNamespaces() as $namespacePrefix => $namespace )
		{
			if ( ! empty( $namespacePrefix ) && $namespace == SCHEMA_NAMESPACE )
			{
				$activeSchemaPrefix = $namespacePrefix;
			}

			$xml->registerXPathNamespace( $namespacePrefix, $namespace );
			if ( $namespace != $targetNamespace ) continue;
			$prefix = $namespacePrefix;
		}
		$xml->registerXPathNamespace( SCHEMA_PREFIX, SCHEMA_NAMESPACE );

		if ( ! $prefix )
		{
			// If there is no prefix generate a random one
			$prefix = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyz" ), 0, 8 );
		}

		$xpath = new \DOMXPath( dom_import_simplexml( $xml )->ownerDocument );
		$xpath->registerNamespace( SCHEMA_PREFIX, SCHEMA_NAMESPACE );
		$imports = $xpath->query( "/xs:schema/xs:import" );

		foreach ( $imports as $import )
		{
			$nextNamespace = (string) $import->getAttribute( 'namespace' );

			$schemaLocation = (string) $import->getAttribute( 'schemaLocation' );
			$nextXSD = SchemaTypes::resolve_path( $xsd, $schemaLocation );

			$this->processSchema( $nextXSD, $includeElements );
		}

		if ( in_array( $targetNamespace, $this->processedSchemas ) ) return true;

		$this->processedSchemas[ $prefix ] = $targetNamespace;
		$this->activeSchemaPrefix = $activeSchemaPrefix;

		foreach ( $xml->children( SCHEMA_NAMESPACE ) as $nodeKey => $node )
		{
			$this->processNode( $node, $nodeKey, $prefix, $includeElements );
		}

		return true;
	}

	/**
	 * Returns an array representing either a simple or complex element type
	 * THIS FUNCTION SHOULD ONLY BE USED TO PROCESS GLOBAL OR TOP LEVEL NODES
	 *
	 * @param SimpleXMLElement $node The node to process
	 * @param $nodeKey The local name of the node
	 * @param string $prefix The prefix associated with the namespace of the containing schema
	 * @param bool $includeElements
	 * @return boolean
	 */
	public function processNode( $node, $nodeKey, $prefix, $includeElements = false )
	{
		if ( $nodeKey == 'schema' )
		{
			if ( is_null( $this->activeSchemaPrefix ) )
			{
				$this->activeSchemaPrefix = null;

				foreach ( $node->getDocNamespaces() as $namespacePrefix => $namespace )
				{
					if ( ! empty( $namespacePrefix ) && $namespace == SCHEMA_NAMESPACE )
					{
						$this->activeSchemaPrefix = $namespacePrefix;
						break;
					}
				}
			}

			// Create a map of local namespace prefixes to schema namespace prefixes
			$processedNamespaces = array_flip( $this->processedSchemas );
			foreach ( $node->getDocNamespaces() as $namespacePrefix => $namespace )
			{
				if ( empty( $namespacePrefix ) || $namespacePrefix == $prefix || ! isset( $processedNamespaces[ $namespace ] ) )
				{
					continue;
				}

				if ( isset( $processedNamespaces[ $namespace ] ) && $processedNamespaces[ $namespace ] == $namespacePrefix )
				{
					continue;
				}

				$this->namespacePrefixMap[ $namespacePrefix ] = $processedNamespaces[ $namespace ];
			}
		}

		$content = $this->handleTypes( $node, $prefix );
		if ( $content )
		{
			$name = "$prefix:{$node->attributes()->name}";

			if (property_exists( $node->attributes(), 'id' ) )
			{
				$id = (string) $node->attributes()->id;
				$content['id'] = $id;
				$this->typeIds[ $id ] = array( 'name' => $name, 'istype' => true );
			}

			$this->types[ $name ] = $content + array( 'prefix' => $prefix );
			return true;
		}

		switch ( $nodeKey )
		{
			case 'attributeGroup':

				$groupName = (string) $node->attributes()->name;

				$attributes = array();

				foreach ( $node->children( SCHEMA_NAMESPACE ) as $attributeGroupKey => $attributeGroupElement )
				{
					$content = $this->getContent( $attributeGroupKey, $attributeGroupElement, $prefix);
					if ( ! count( $content ) ) continue;
					if ( isset( $content['attributes'] ) )
					{
						$attributes = array_merge( $attributes, $content['attributes']  );
					}
					else if ( isset( $content['attributeGroups'] ) )
					{
						foreach ( $content['attributeGroups'] as $attributeGroupKey => $attributeGroup )
						{
							$attributes = array_merge( $attributes, $attributeGroup['attributes']  );
						}
					}
					else
					{
						$attributes = array_merge( $attributes, $content  );
					}
				}

				$group = array( 'attributes' => $attributes );

				// Merge groups in the same named attributes group together
				if ( isset( $this->attributeGroups[ "$prefix:$groupName" ] ) )
				{
					$this->attributeGroups[ "$prefix:$groupName" ] = $attributeGroups[ "$prefix:$groupName" ] + $group;
				}
				else
				{
					$this->attributeGroups[ "$prefix:$groupName" ] = $group;
				}

				break;

			case 'attribute':

				$content = $this->processAttribute( $node, $prefix );
				if ( $content === false ) continue;
				$this->attributes[ "$prefix:{$content['name']}" ] = $content;
				if ( isset( $this->types[ "$prefix:{$content['name']}" ] ) ) break;
				$parent = is_array( $content['types'][0] )
					?  $content['types'][0]['parent']
					:  $content['types'][0];
				$this->types[ "$prefix:{$content['name']}" ] = array(
					'parent' => $parent,
					'name' => $content['name'],
					'prefix' => $prefix,
					'class' => 'simple',
					'contentType' => 'attribute',
					'numeric' => isset( $this->types[ $parent ]['numeric'] )
									? $this->types[ $parent ]['numeric']
									: false,
				);
				break;

			case 'group':

				$this->processGroup( $node, $prefix );
				break;

			case 'element':

				if ( ! $includeElements ) break;

				// processNode() is only ever called to process global top level elements
				// so this element is global
				$element = $this->processElement( $node, $prefix, true );
				// $this->elements[ "$prefix:{$element['name']}" ] = $element;

				break;

			case 'annotation':
			case 'import':
			case 'include':
			case 'redefine':
				// Do nothing
				break;

			case 'schema':

				foreach ( $node->children( SCHEMA_NAMESPACE ) as $schemaNodeKey => $schemaNode )
				{
					$this->processNode( $schemaNode, $schemaNodeKey, $prefix, $includeElements );
				}
				break;

			default:

				echo "Does not handle '$nodeKey'\n";

				return false;
		}

		return true;
	}

	/**
	 * Returns an array representing either a simple or complex element type
	 *
	 * @param SimpleXMLElement $node The node to process
	 * @param string $prefix The prefix associated with the namespace of the containing schema
	 * @return boolean|array
	 */
	private function handleTypes( $node, $prefix )
	{
		switch ( $node->getName() )
		{
			case 'simpleType':

				return $this->getSimpleType( $node, $prefix );

				break;

			case 'complexType':

				return $this->getComplexType( $node, $prefix );

				break;

		}

		return false;
	}

	/**
	 * Returns an array representing either a simple or complex element type
	 *
	 * @param SimpleXMLElement $node The node to process
	 * @param string $prefix The prefix associated with the namespace of the containing schema
	 * @return boolean|array
	 */
	private function getComplexType( $node, $prefix )
	{
		if ( property_exists( $node, 'complexContent' ) )
		{
			$content = $this->getNodeContent( $node->complexContent, $prefix );
			$content['class'] = 'complex';
			if ( property_exists( $node->attributes(), 'mixed' ) )
			{
				$content['mixed'] = filter_var( $node->attributes()->mixed, FILTER_VALIDATE_BOOLEAN );
			}
			else if ( property_exists( $node->complexContent->attributes(), 'mixed' ) )
			{
				$content['mixed'] = filter_var( $node->complexContent->attributes()->mixed, FILTER_VALIDATE_BOOLEAN );
			}
		}
		else if ( property_exists( $node, 'simpleContent' ) )
		{
			$content = $this->getNodeContent( $node->simpleContent, $prefix );
			$content['class'] = 'simple';
		}
		else
		{
			$content = array( 'class' => str_replace( 'Type', '', $node->getName() ) );

			foreach ( $node->children( SCHEMA_NAMESPACE ) as $key => $child )
			{
				$x = $this->getContent( $key, $child, $prefix );
				if ( $key == 'sequence' )
				{
					$content['sequence'] = $x;
				}
				else
				{
					$content = array_merge_recursive( $content, $x );
				}
			}
		}

		if ( ! empty( $node->attributes()->name ) )
		{
			$content['name'] = (string) $node->attributes()->name;
		}

		return $content;
	}

	/**
	 * Returns an array representing a complex content of a complex type
	 *
	 * @param SimpleXMLElement $contentNode The node to process
	 * @param string $prefix The prefix associated with the namespace of the containing schema
	 * @return boolean|array
	 */
	private function getNodeContent( $contentNode, $prefix )
	{
		$contentType = "";
		if ( property_exists( $contentNode, 'restriction' ) )
		{
			$parent = (string) $contentNode->restriction->attributes()->base;
			$contentType = "restriction";
		}
		else if ( property_exists( $contentNode, 'extension' ) )
		{
			$parent = (string) $contentNode->extension->attributes()->base;
			$contentType = "extension";
		}
		else
		{
			return $this->getComplexType( $contentNode, $prefix );
			return false;
		}

		// BMS 2018-04-09 Test candidates changed.
		$parent = $this->normalizePrefix( strpos( $parent, ":" ) ? $parent : "xs:$parent" );

		$content = array( 'parent' => $parent );
		$content['numeric'] = isset( $this->types[ $parent ]['numeric'] ) ? $this->types[ $parent ]['numeric'] : false;

		$name = (string) $contentNode->attributes()->name;
		if ( ! empty( $name ) )
		{
			$content['name'] = $name;
		}

		foreach ( $contentNode->$contentType->children( SCHEMA_NAMESPACE ) as  $key => $node )
		{
			$x = $this->getContent( $key, $node, $prefix );
			$content = array_merge_recursive( $content, $x );
		}

		if ( property_exists( $contentNode->$contentType->attributes(), 'base' ) )
		{
			$base = $this->normalizePrefix( (string) $contentNode->$contentType->attributes()->base );
			$content['base'] = $base;
			$content['contentType'] = $contentType;
		}

		return $content;
	}

	/**
	 * Read the content of a schema element
	 *
	 * @param string $key The local name of the element
	 * @param SimpleXMLElement $node The node to process
	 * @param string $prefix The prefix associated with the namespace of the containing schema
	 * @return boolean|array
	 */
	private function getContent( $key, $node, $prefix )
	{
		$content = array();

		switch ( $key )
		{
			case 'annotation':
				// Do nothing
				break;

			case 'attributeGroup':

				if ( ! property_exists( $node->attributes(), 'ref' ) ) continue;
				if ( ! isset( $content['attributeGroups'] ) ) $content['attributeGroups'] = array();

				$ref = (string) $node->attributes()->ref;
				// BMS 2018-04-09 Test candidates changed.
				$ref = $this->normalizePrefix( strpos( $ref, ":" ) ? $ref : "xs:$ref" );

				$attributeGroups =& $this->attributeGroups;

				if ( ! isset( $attributeGroups[ $ref ] ) )
				{
					$this->log->err( "An attribute group '$ref' does not already exist" );
				}

				$content['attributeGroups'][] = $attributeGroups[ $ref ];

				break;

			case 'attribute':

				if ( ! isset( $content['attributes'] ) ) $content['attributes'] = array();
				$attribute = $this->processAttribute( $node, $prefix );
				if ( ! $attribute ) break;
				$content['attributes'][ "{$attribute['prefix']}:{$attribute['name']}" ] = $attribute;

				// Should add attributes to the attributes list
				if ( ! $attribute || isset( $this->attributes[ "{$attribute['prefix']}:{$attribute['name']}" ] ) ) break;
				$name = $attribute['name'];
				$this->attributes[ "$prefix:$name" ] = $attribute;
				if ( isset( $this->types[ "$prefix:$name" ] ) ) break;
				$parent = is_array( $attribute['types'][0] )
					? $attribute['types'][0]['parent']
					: $attribute['types'][0];
				$this->types[ "$prefix:$name" ] = array(
					'parent' => $parent,
					'name' => $name,
					'prefix' => $prefix,
					'class' => 'simple',
					'contentType' => 'attribute',
					'numeric' => isset( $this->types[ $parent ]['numeric'] )
						? $this->types[ $parent ]['numeric']
						: false,
				);

				break;

			case 'anyAttribute':

				$content['any'] = true;

				break;

			case 'choice':

				if ( ! isset( $content['elements'] ) ) $content['elements'] = array();

				foreach ( $node->children( SCHEMA_NAMESPACE ) as $key => $child )
				{
					switch ( $key )
					{
						case 'sequence':

							$element = $this->getContent( $key, $child, $prefix );

							if ( $element )
							{
								$content['elements'] = $element;
							}

							break;

						case 'group':

							$group = $this->processGroup( $node, $prefix );

							if ( $group )
							{
								$content['elements'][ "$prefix:{$element['name']}" ] = $group;
							}

							break;

						case 'element':

							$element = $this->processElement( $child, $prefix );

							if ( $element )
							{
								$elementPrefix = isset( $element['prefix'] ) ? $element['prefix'] : $prefix;
								$content['elements'][ "$elementPrefix:{$element['name']}" ] = $element;
							}

							break;

						case 'any':

							$content['any'] = true;
							break;

						default:

							$this->log->info( "Need to handle choice component '$key'" );
							return false;
					}
				}

				$content['restrictionType'] = "choice";

				break;

			case 'union':

				$memberTypes = $node->attributes()->memberTypes;
				if ( $memberTypes )
				{
					// Get the name of each type
					$localTypes =& $this->types;
					$memberTypes = array_map( function( $typeName ) use( $localTypes ) {
						$typeName = strpos( $typeName, ":" ) ? $typeName : "xs:$typeName";
						return isset( $localTypes[ $typeName ] )
							? $typeName
							: $false;
					}, array_filter( explode( " ", $memberTypes ) ) );

					$content['types'] = array_filter( $memberTypes );
				}

				// Will be either complexType or simpleType
				foreach ( $node->children( SCHEMA_NAMESPACE ) as $child )
				{
					$content['types'][] = $this->handleTypes( $child, $prefix );
				}

				$content['restrictionType'] = "union";

				break;

			case 'sequence':

				$elements = array();
				$elementIndex = 1;
				foreach ( $node->children( SCHEMA_NAMESPACE ) as $seqKey => $child )
				{
					switch ( $seqKey )
					{
						case 'group':

							$group = $this->processGroup( $child, $prefix );

							if ( ! isset( $elements['group'] ) ) $elements['group'] = array();
							foreach ( $group['types'] as $type )
							{
								$elements['group'] = array_merge( $elements['group'], $type );
							}

							break;

						case 'element':

							$el = $this->processElement( $child, $prefix );
							// BMS 2018-05-02
							$elements[ $elementIndex ] = $el;
							$elementIndex++;
							// $elements[ "{$el['prefix']}:{$el['name']}" ] = $el;

							break;

						case 'any':

							$content['any'] = true;
							break;

						case 'choice':

							$el = $this->getContent( $seqKey, $child, $prefix );
							$elements['choice'] = $el;
							break;

						case 'sequence':

							$el = $this->getContent( $seqKey, $child, $prefix );
							$elements['sequence'] = $el;
							break;

						default:

							echo "Handle '$seqKey'";
							break;
					}

				}

				if ( $elements )
				{
					$content['elements'] = $elements;
				}

				$content['restrictionType'] = "union";

				break;

			case 'minLength':

				$content['minLength'] = (string) $node->attributes()->value;

				break;

			case 'maxLength':

				$content['maxLength'] = (string) $node->attributes()->value;

				break;

			case 'minExclusive':

				$content['minExclusive'] = (string) $node->attributes()->value;

				break;

			case 'maxExclusive':

				$content['maxExclusive'] = (string) $node->attributes()->value;

				break;

			case 'length':

				$content['length'] = (string) $node->attributes()->value;

				break;

			case 'enumeration':

				$attribs = $node->attributes();
				$enum = array( 'value' => (string) $attribs->value );
				if ( property_exists( $attribs, 'id' ) )
				{
					$enum['id'] = (string)$attribs->id;
					$name = \XBRL::GUID();
					$this->typeIds[ $enum['id'] ] = array( 'name' => $name, 'istype' => true );
					$this->AddSimpleType( $prefix, $name );
				}

				$content['values'][] = $enum;
				break;

			case 'pattern':

				$content['pattern'] = (string) $node->attributes()->value;

				break;

			case 'maxInclusive':

				$content['maxInclusive'] = (string) $node->attributes()->value;

				break;

			case 'minInclusive':

				$content['minInclusive'] = (string) $node->attributes()->value;

				break;

			default:

				$this->log->info( "Have not used $key" );
				break;
		}

		return $content;
	}

	/**
	 * Returns true if the array passed reprsents a numeric type
	 *
	 *
	 * @param array|QName $type Can be a QName or an array representing a type
	 * @return bool
	 */
	public function isNumeric( $type )
	{
		// BMS 2018-05-02 Changed to use resolvesToBaseType instead of relying on some property
		if ( $type instanceof QName )
		{
			// $type = $this->getType( $type->localName, $type->prefix );
			$type = "{$type->prefix}:{$type->localName}";
		}
		else if ( is_string( $type ) && isset( $this->types[ $type ] ) )
		{
			$type = $this->types[ $type ];
		}

		$result = $this->resolvesToBaseType( $type, array( 'xs:decimal', 'xs:double', 'xs:float' ) );
		return $result;

		// if ( is_array( $type ) )
		// {
		// 	return isset( $type['numeric'] ) && filter_var( $type['numeric'], FILTER_VALIDATE_BOOLEAN );
		// }
		// else
		// {
		// 	return false;
		// }
	}

	/**
	 * Return true if the $substitutionGroup resolves to one of the $candidates
	 *
	 * @param string|QName $substitutionGroup The substitution group to test in prefix:localname format.
	 * @param array $candidates An array of possible candidate groups
	 * @return bool
	 */
	public function resolveToSubstitutionGroup( $substitutionGroup, $candidates )
	{
		// Check the potential candidates are valid
		if ( ! is_array( $candidates ) || ! count( $candidates ) ) return false;

		if ( $substitutionGroup instanceof QName )
		{
			$substitutionGroup = "{$substitutionGroup->prefix}:{$substitutionGroup->localName}";
		}
		else if ( ! is_string( $substitutionGroup ) ) return false;

		// Is the $substitutionGroup already in $candidates
		if ( in_array( $substitutionGroup, $candidates ) ) return true;

		// If its not then look to see if there are ancestral elements
		if ( ! isset( $this->elements[ $substitutionGroup ] ) ) return false;

		$element = $this->elements[ $substitutionGroup ];
		if ( isset( $element['substitutionGroup'] ) )
		{
			// There are so repeat the test with the ancestor element
			return $this->resolveToSubstitutionGroup( $element['substitutionGroup'], $candidates );
		}
		else
		{
			return false;
		}
	}

	/**
	 * Return true if the $type resolves to one of the $candidates
	 *
	 * @param string|QName $type The type to test in prefix:localname format.
	 * @param array $candidates An array of possible candidate types
	 * @return bool
	 */
	public function resolvesToBaseType( $type, $candidates, $allowUnion = true )
	{
		// Check the potential candidates are valid
		if ( ! is_array( $candidates ) || ! count( $candidates ) ) return false;

		if ( $type instanceof \lyquidity\xml\QName )
		{
			$type = "{$type->prefix}:{$type->localName}";
		}
		else if ( is_array( $type ) && isset( $type['prefix'] ) && isset( $type['prefix'] ) )
		{
			$type = "{$type['prefix']}:{$type['name']}";
		}
		else if ( ! is_string( $type ) ) return false;

		// Is the $type already in $candidates
		if ( in_array( $type, $candidates ) ) return true;

		// If its not then look to see if there are ancestral types
		if ( ! isset( $this->types[ $type ] ) ) return false;

		$t = $this->types[ $type ];
		if ( isset( $t['parent'] ) )
		{
			// There are so repeat the test with the ancestor element
			return $this->resolvesToBaseType( $t['parent'], $candidates, $allowUnion );
		}
		else if ( isset( $t['types'] ) && isset( $t['class'] ) && $t['class'] == "simple" )
		{
			// The v-equal test V-20 could do with this returning false
			// BMS 2018-09-01 Changed to allow the caller control (at least until a better option is determined)
			return $allowUnion;
			// // It may be necessary to consider types if $t is defined as a union such as xbrli:dateTimeItemType
			// foreach ( $t['types'] as $parentType )
			// {
			// 	$result = $this->resolvesToBaseType( $parentType, $candidates );
			// 	if ( $result )
			// 	{
			// 		return $result;
			// 	}
			// }
		}
		else
		{
		}
		return false;
	}

	/**
	 * Return the atomic (xs defined simple type) type associated with a passed in type
	 *
	 * @param string|QName|array $type
	 */
	public function getAtomicType( $type )
	{
		if ( $type instanceof QName )
		{
			$type = "{$type->prefix}:{$type->localName}";
		}
		else if ( is_array( $type ) && isset( $type['prefix'] ) && isset( $type['prefix'] ) )
		{
			$type = "{$type['prefix']}:{$type['name']}";
		}
		else if ( ! is_string( $type ) ) return false;

		// If its not then look to see if there are ancestral types
		// BMS 2018-04-09 Test candidates changed.
		if ( $type == "xs:anyType" ) return "xs:anyType";

		// If its not then look to see if there are ancestral types
		// BMS 2018-04-09 Test candidates changed.
		if ( $type == "xs:anyComplexType" ) return false;

		// anyAtomicType is an alias for anySimpleType
		// BMS 2018-04-09 Test candidates changed.
		if ( $type == "xs:anyAtomicType" )
		{
			$type = "xs:anySimpleType";
		}
		// Is the $type already in $xsTypes
		if ( isset( SchemaTypes::$xsTypes[ $type ] ) )
		{
			return $type;
		}

		if ( ! isset( $this->types[ $type ] ) ) return false;

		$t = $this->types[ $type ];
		if ( isset( $t['parent'] ) )
		{
			// There are so repeat the test with the ancestor element
			return $this->getAtomicType( $t['parent'] );
		}
		// else if ( isset( $t['types'] ) )
		// {
		// 	// It may be necessary to consider types if $t is defined as a union such as xbrli:dateTimeItemType
		// 	foreach ( $t['types'] as $parentType )
		// 	{
		// 		$result = $this->getAtomicType( $parentType );
		// 		if ( $result )
		// 		{
		// 			return $t;
		// 		}
		// 	}
		// }
		else
		{
		}

		return false;
	}

	/**
	 * Return the schema type for the DOMNode or false
	 * @param DOMNode $node
	 * @return string|false A string representing the type associated with $node or false if one cannot be located
	 * @throws SchemaException Thrown for nodes types that are no supported
	 */
	public function getTypeForDOMNode( $node )
	{
		$ns = $node->namespaceURI;
		if ( ! $ns )
		{
			if ( $node instanceof \DOMElement )
			{
				// Get the default namespace for the DOMNode
				$doc = $node->ownerDocument;
				/**
				 * @var DOMNode $firstChild
				 */
				$firstChild = $doc->documentElement;
				$ns = $firstChild->getAttributeNode('xmlns')
					? $firstChild->getAttributeNode('xmlns')->nodeValue
					: "";
			}
			else if ( $node instanceof \DOMAttr )
			{
				$parent = $node->parentNode;
				if ( $parent )
				{
					$ns = $parent->namespaceURI;
				}
			}
		}

		$prefix = $this->getPrefixForNamespace( $ns );
		$types;

		if ( is_a( $node, "DOMElement" ) )
		{
			$el = $this->getElement( $node->localName, $prefix );
			if ( $el === false ) throw new SchemaException( "Unable to locate element '{$node->localName}' in the schema types" );
			$types = isset( $el['types'] ) ? $el['types'] : array();
		}
		else if ( is_a( $node, "DOMAttr" ) )
		{
			$attr = $this->getAttribute( $node->localName, $prefix );
			if ( $attr === false ) throw new SchemaException( "Unable to locate attribute '{$node->localName}' in the schema types" );
			$types = isset( $attr['types'] ) ? $attr['types'] : array();
		}
		else if ( is_a( $node, "DOMDocument" ) )
		{
			throw new SchemaException("Getting the type for a Document node is not supported");
		}
		else if ( is_a( $node, "DOMComment" ) )
		{
			// BMS 2018-04-09 Test candidates changed.
			return "xs:string";
		}
		else if ( is_a( $node, "DOMProcessingInstruction" ) )
		{
			throw new SchemaException("Getting the type for a Processing Instruction node is not supported");
		}
		else if ( is_a( $node, "DOMText" ) )
		{
			// BMS 2018-04-09 Test candidates changed.
			return "xs:string";
		}
		else if ( is_a( $node, "DOMNameSpaceNode" ) )
		{
			throw new SchemaException("Getting the type for a Namespace node is not supported");
		}

		// Get the first simple type
		$type = null;
		foreach ( $types as $xmlType )
		{
			if ( is_array( $xmlType ) )
			{
				if ( isset( $xmlType['class'] ) && $xmlType['class'] == "complex" )
				{
					continue;
				}

				if ( isset( $xmlType['contentType'] ) && $xmlType['contentType'] == "extension" && isset( $xmlType['base'] ) )
				{
					return $xmlType['parent'];
				}

				if ( isset( $xmlType['contentType'] ) && $xmlType['contentType'] == "restriction" && isset( $xmlType['base'] ) )
				{
					return $xmlType['parent'];
				}
			}

			return $xmlType;
		}

		return false;
	}

	/**
	 * Returns an array representing a group type
	 *
	 * @param SimpleXMLElement $node The node to process
	 * @param string $prefix The prefix associated with the namespace of the containing schema
	 * @return boolean|array
	 */
	function processGroup( $node, $prefix )
	{
		$ref = (string) $node->attributes()->ref;

		if ( empty( $ref ) )
		{
			//
			$content = array();
			foreach ( $node->children( SCHEMA_NAMESPACE ) as  $key => $groupChild )
			{
				$x = $this->getContent( $key, $groupChild, $prefix );
				$content = array_merge_recursive( $content, $x );
			}

			// Add the type
			// $this->types[ "$prefix:{$node->attributes()->name}" ] = $content;

			$group = array(
					'abstract' => true,
					'class' => 'group',
					'name' => (string) $node->attributes()->name,
					'prefix' => $prefix,
					'types' => array( $content ),
			);

			$this->groups[ "$prefix:{$group['name']}" ] = $group;

			return $group;
		}
		else
		{
			// BMS 2018-04-09 Test candidates changed.
			$ref = strpos( $ref, ":" ) ? $ref : "xs:$ref";
			if ( ! isset( $this->groups[ $ref ] ) )
			{
				// Try look ahead
				// The name in Ref may refer to the local XSD in which case the prefix needs to be removed
				$name = strpos( $ref, "$prefix:" ) === 0
					? str_replace( "$prefix:", "", $ref )
					: $ref;

				// For some reason the namespace registration applied to the XML root does not exist here so needs to be reapplied
				$node->registerXPathNamespace( SCHEMA_PREFIX, SCHEMA_NAMESPACE );
				// BMS 2018-04-09 Test candidates changed.
				$nodes = $node->xpath( "/xs:schema/xs:group[@name=\"$name\"]" );
				if ( $nodes )
				{
					// There is at least one node and only interested in one
					$el = $this->processGroup( $nodes[0], $prefix );
					// $this->elements[ "$prefix:{$el['name']}" ] = $el;
				}
			}

			if ( ! isset( $this->groups[ $ref ] ) ) return false;

			$result = $this->groups[ $ref ];

			if ( property_exists( $node->attributes(), 'minOccurs' ) )
			{
				$result['minOccurs'] = (string) $node->attributes()->minOccurs;
			}

			if ( property_exists( $node->attributes(), 'maxOccurs' ) )
			{
				$result['maxOccurs'] = (string) $node->attributes()->maxOccurs;
			}

			return $result;
		}
	}

	/**
	 * Returns an array representing an element type
	 *
	 * @param SimpleXMLElement $node The node to process
	 * @param string $prefix The prefix associated with the namespace of the containing schema
	 * @param bool $global A flag indicating whether this node is a top level or global element
	 * @return boolean|array
	 */
	function processElement( $node, $prefix, $global = false )
	{
		$ref = (string) $node->attributes()->ref;

		if ( empty( $ref ) )
		{
			$id = (string) $node->attributes()->id;
			$name = (string) $node->attributes()->name;

			// It may not be a reference but the named element may still exist
			if ( isset( $this->elements[ "{$prefix}:{$name}" ] ) )
			{
				return $this->elements[ "{$prefix}:{$name}" ];
			}

			// OK, it does not already exist so create it
			$abstract = empty( $node->attributes()->abstract )
				? false
				: filter_var( (string) $node->attributes()->abstract, FILTER_VALIDATE_BOOLEAN );

			$element = array(
				'abstract' => $abstract,
				'name' => $name,
				'prefix' => $prefix,
				'global' => $global,
			);

			if ( property_exists( $node->attributes(), 'default' ) )
			{
				$element['default'] = (string) $node->attributes()->default;
			}

			// If this is a global element record the basic facts so they can be
			// recovered by any recursive ref attributed.
			if ( $global )
			{
				$this->currentGlobalElement = $element;
			}

			if ( ! empty( $id ) )
			{
				$element['id'] = $id;
				$this->typeIds[ $id ] = array( 'name' => $name, 'istype' => false );
			}

			$substitutionGroup = $this->normalizePrefix( (string) $node->attributes()->substitutionGroup );

			if ( ! empty( $substitutionGroup ) )
			{
				$element['substitutionGroup'] = $substitutionGroup;
			}

			$type = (string) $node->attributes()->type;
			if ( empty( $type ) )
			{
				// Will be either complexType or simpleType
				foreach ( $node->children( SCHEMA_NAMESPACE ) as $child )
				{
					$content = $this->handleTypes( $child, $prefix );
					if ( $content )
					{
						$element['types'][] = $content;
						break;
					}
				}
			}
			else
			{
				// BMS 2018-04-09 Test candidates changed.
				$type = strpos( $type, ":" )
					? ( is_null( $this->activeSchemaPrefix )
						? $type
						: str_replace( "{$this->activeSchemaPrefix}:", "xs:", $type ) )
					: "xs:$type";
				$element['types'][] = $type;
			}

			$this->elements[ "$prefix:{$element['name']}" ] = $element;
			if ( $global )
			{
				$this->currentGlobalElement = null;
			}

			return $element;
		}
		else
		{
			$result = null;

			// Look at the current global as this ref may be a recursive call to a parent node
			if ( ! is_null( $this->currentGlobalElement ) )
			{
				$qname = "{$this->currentGlobalElement['prefix']}:{$this->currentGlobalElement['name']}";
				if ( $qname == $ref )
				{
					$result = $this->currentGlobalElement;
				}
			}

			if ( is_null( $result ) )
			{
				$ref = strpos( $ref, ":" ) ? $ref : ":$ref";
				if ( ! isset( $this->elements[ $ref ] ) )
				{
					// Try look ahead
					// The name in Ref may refer to the local XSD in which case the prefix needs to be removed
					$name = strpos( $ref, "$prefix:" ) === 0
						? str_replace( "$prefix:", "", $ref )
						: $ref;

					// For some reason the namespace registration applied to the XML root does not exist here so needs to be reapplied
					$node->registerXPathNamespace( SCHEMA_PREFIX, SCHEMA_NAMESPACE );
					// BMS 2018-04-09 Test candidates changed.
					$nodes = $node->xpath( "/xs:schema/xs:element[@name=\"$name\"]" );
					if ( $nodes )
					{
						// There is at least one node and only interested in one
						$el = $this->processElement( $nodes[0], $prefix, true );
						// $this->elements[ "$prefix:{$el['name']}" ] = $el;
					}

				}

				if ( ! isset( $this->elements[ $ref ] ) ) return false;

				$result = $this->elements[ $ref ];
			}

			if ( property_exists( $node->attributes(), 'minOccurs' ) )
			{
				$result['minOccurs'] = (string) $node->attributes()->minOccurs;
			}

			if ( property_exists( $node->attributes(), 'maxOccurs' ) )
			{
				$result['maxOccurs'] = (string) $node->attributes()->maxOccurs;
			}

			return $result;
		}

	}

	/**
	 * Returns an array representing a simple type
	 *
	 * @param SimpleXMLElement $node The node to process
	 * @param string $prefix The prefix associated with the namespace of the containing schema
	 * @return boolean|array
	 */
	function processAttribute( $node, $prefix )
	{
		if ( empty( $node->attributes()->ref ) )
		{
			$name = (string) $node->attributes()->name;

			$attribute = array();
			$type = (string) $node->attributes()->type;

			if ( empty( $type ) )
			{
				if ( property_exists( $node, 'simpleType' ) )
				{
					// Look for a simple type
					$attribute['types'][] = $this->getSimpleType( $node->simpleType, $prefix );
				}
				else if ( property_exists( $node, 'complexType' ) )
				{
					$this->log->info( "TBD: getAttribute::complexType" );
				}
				else
					return false;
			}
			else
			{
				$type = (string) $node->attributes()->type;
				// BMS 2018-04-09 Test candidates changed.
				$type = strpos( $type, ":" )
					? ( is_null( $this->activeSchemaPrefix )
						? $type
						: str_replace( "{$this->activeSchemaPrefix}:", "xs:", str_replace( "xs:", "xs:", $type ) ) )
					: "xs:$type";

				// The type should already exists
				if ( ! isset( $this->types[ $type ] ) )
				{
					$this->log->info( "The type '$type' used in attribute '$name' has not been defined yet." );
				}
				$attribute['types'][] = $type;
			}

			foreach ( $node->attributes() as $attributeName => $attributeValue )
			{
				if ( $attributeName == 'type' ) continue;
				$attribute[ $attributeName ] = (string)$attributeValue;
			}

			// $use = (string) $node->attributes()->use;
			// if ( empty( $use ) ) $use = "optional";
			if ( ! isset( $attribute['use'] ) ) $attribute['use'] = 'optional';

			$attribute += array(
				// 'name' => $name,
				'prefix' => $prefix,
				// 'use' => $use,
				'class' => 'attribute',
			);

			return $attribute;
		}
		else
		{
			$nodeAttributes = $node->attributes();
			$ref = (string) $nodeAttributes->ref;
			// BMS 2018-04-09 Test candidates changed.
			$ref = strpos( $ref, ":" ) ? $ref : "xs:$ref";

			$attributes =& $this->attributes;

			if ( ! isset( $attributes[ $ref ] ) ) return false;

			// BMS 2018-04-21 Changed to use a loop to read attributes
			foreach ( $nodeAttributes as $nodeAttribute => $nodeValue )
			{
				if ( $nodeAttribute == 'ref' ) continue;
				if ( ! empty( (string)$nodeValue ) ) $attributes[ $ref ][ $nodeAttribute ] = (string)$nodeValue;
			}

			// $use = (string) $node->attributes()->use;
			// if ( ! empty( $use ) ) $attributes[ $ref ]['use'] = $use;

			return $attributes[ $ref ];
		}
	}

	/**
	 * Returns an array representing a simple type
	 *
	 * @param SimpleXMLElement $node The node to process
	 * @param string $prefix The prefix associated with the namespace of the containing schema
	 * @return boolean|array
	 */
	function getSimpleType( $node, $prefix )
	{
		$simpleType = $this->getNodeContent( $node, $prefix );
		$simpleType['class'] = 'simple';

		return $simpleType;
	}

	/**
	 * Return the enumeration values associated with the node or false
	 * @param SimpleXMLElement $node
	 * @return boolean|array
	 */
	function getEnumeration( $node )
	{
		if ( ! count( $node->children( SCHEMA_NAMESPACE )->enumeration ) ) return false;

		$result = array();
		foreach ( $node->children( SCHEMA_NAMESPACE )->enumeration as $enumeration )
		{
			if ( empty( $enumeration->attributes()->value ) ) continue;
			$result[] = (string) $enumeration->attributes()->value;
		}

		return $result;
	}

	/**
	 * Create the default types provided by the schema spec.
	 * @return void
	 */
	function createBaseTypes()
	{
		if ( $this->baseTypesLoaded ) return;

		$types = SchemaTypes::$xsTypes;

		// SchemaTypes are organized hierarchically
		$this->types = array_reduce( array_keys( SchemaTypes::$xsTypes ), function( $carry, $type ) use( $types ) {
			/** @var QName $qn */
			$qn = \lyquidity\xml\qname( $type, array( SCHEMA_PREFIX => SCHEMA_NAMESPACE ) );
			$typeNode = array(
				'parent' => isset( $types[ $type ] ) ? $types[ $type ] : null,
				'prefix' => $qn->prefix,
				'name' => $qn->localName,
			);
			$typeNode['numeric'] = $typeNode['name'] == 'double' || $typeNode['name'] == 'decimal' || $typeNode['name'] == 'float' || ( isset( $carry[ $typeNode['parent'] ]['numeric'] ) && $carry[ $typeNode['parent'] ]['numeric'] );
			$carry[ $type ] = $typeNode;
			return $carry;
		}, array() );

		$this->baseTypesLoaded = true;
	}

	/**
	 * Resets the global types
	 */
	public static function reset()
	{
		SchemaTypes::$instance = null;
	}

	/**
	 * Returns true if there is an existing instance
	 * @return boolean
	 */
	public static function hasInstance()
	{
		return ! is_null( self::$instance );
	}

	/**
	 * Allows a constructor to load types from a json file
	 * @param string
	 * @return array
	 */
	public function fromJSON( $source )
	{
		$types = json_decode( $source, true );

		if ( json_last_error() !== JSON_ERROR_NONE )
		{
			$message = sprintf( "Error parsing JSON %s", XBRL::json_last_error_msg() );
			XBRL_Log::getInstance()->err( $message );
			return false;
		}

		return $this->fromArray( $types );
	}

	/**
	 * Create an types instance from an array
	 *
	 * @param array $types
	 * @return bool
	 */
	public function fromArray( $types )
	{
		$this->types			=& $types['types'];
		$this->attributes		=& $types['attributes'];
		$this->attributeGroups	=& $types['attributeGroups'];
		$this->elements			=& $types['elements'];
		$this->processedSchemas	=& $types['processedSchemas'];
		if ( isset( $types['typeIds'] ) )
		{
			$this->typeIds		=& $types['typeIds'];
		}

		// Prevent re-loading base types
		$this->baseTypesLoaded = true;

		return true;
	}

	/**
	 * Merge types from an array
	 *
	 * @param array $types
	 * @return bool
	 */
	public function mergeTypes( $types )
	{
		$this->types			= array_merge( $this->types, $types['types'] );
		$this->attributes		= array_merge( $this->attributes, $types['attributes'] );
		$this->attributeGroups	= array_merge( $this->attributeGroups, $types['attributeGroups'] );
		$this->elements			= array_merge( $this->elements, $types['elements'] );
		$this->processedSchemas	= array_merge( $this->processedSchemas, $types['processedSchemas'] );
		if ( isset( $types['typeIds'] ) )
		{
			$this->typeIds		= array_merge( $this->typeIds, $types['typeIds'] );
		}

		// Prevent re-loading base types
		$this->baseTypesLoaded = true;

		return true;
	}

	/**
	 * Save the type information
	 * @param $filename
	 */
	public function toArray()
	{
		return array(
			'types' => &$this->types,
			'attributes' => &$this->attributes,
			'attributeGroups' => &$this->attributeGroups,
			'elements' => &$this->elements,
			'processedSchemas' => &$this->processedSchemas,
			'typeIds' => &$this->typeIds,
		);
	}

	/**
	 * Save the type information
	 * @param $filename
	 */
	public function toJSON()
	{
		$json = json_encode( $this->toArray() );
		if ( json_last_error() == JSON_ERROR_NONE )
			return $json;

			XBRL_Log::getInstance()->err( "Failed to generate JSON for types" );

			return false;
	}
}

SchemaTypes::__static();
