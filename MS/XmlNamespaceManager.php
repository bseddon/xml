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

use lyquidity\xml\schema\SchemaTypes;
use lyquidity\xml\exceptions\ArgumentOutOfRangeException;
use lyquidity\xml\exceptions\NotSupportedException;

/**
 * Provides the functionality of a namespace manager that allows a caller to add an lookup namespaces
 */
class XmlNamespaceManager implements IXmlNamespaceResolver, \IteratorAggregate
{
	/**
	 * An array of namespaces indexed by prefix
	 * @var array
	 */
	private $namespaces = array();

	/**
	 * Identifies the namespace with an empty prefix
	 * @var string $defaultNamespace
	 */
	private $defaultNamespace = "";

	/**
	 * Reference to the name table instance
	 * @var XmlNameTable
	 */
	private  $nameTable = null;

	/**
	 * Create a constructor and fill it from a SimpleXMLElement if provided
	 * @param SimpleXMLElement $namespaces
	 */
	public function __construct( $namespaces = null )
	{
		$this->nameTable = new XmlNameTable();

		if ( is_null( $namespaces ) ) return;

		if ( $namespaces instanceof SimpleXMLElement )
		{
			$this->namespaces = $namespaces->getDocNamespaces( true );

		}
		else if ( is_array( $namespaces ) )
		{
			$this->namespaces = $namespaces;
		}

		if ( isset( $this->namespaces[""] ) )
		{
			$this->defaultNamespace = $this->namespaces[""];
		}
	}

	/**
	 * Constructor that allows the manager to be filled with namespaces from the existing SchemaTypes global instance
	 * @return \lyquidity\xml\MS\XmlNamespaceManager
	 */
	public static function fromSchemaTypes()
	{
		return new XmlNamespaceManager( SchemaTypes::getInstance()->getProcessedSchemas() );
	}

	/**
	 * Look up names
	 * @param string $name
	 * @throws NotSupportedException
	 * @return string
	 */
	public function __get( $name )
	{
		switch( $name )
		{
			case "DefaultNamespace":
				return $this->defaultNamespace;

			case "NameTable":
				return $this->nameTable;

			default:
				throw new NotSupportedException();
		}
	}

	/**
	 * Adds a namespace to the existing collection
	 * @param string $prefix
	 * @param string $namespace
	 */
	public function addNamespace( $prefix, $namespace )
	{
		if ( empty( $namespace ) )
		{
			throw new ArgumentOutOfRangeException( "The $namespace parameter to addNamespace cannot be null or empty" );
		}

		if ( substr( $prefix, 0, 5 ) == "xmlns" )
		{
			$prefix = substr( $prefix, 5 );
		}

		if ( strlen( $prefix ) > 0 && $prefix[0] == ":" )
		{
			$prefix = substr( $prefix, 1 );
		}

		if ( empty( $prefix) && empty( $this->defaultNamespace ) )
		{
			$this->defaultNamespace = $namespace;
		}

		$this->namespaces[ $prefix ] = $namespace;
	}

	/**
	 * Count of the number of namespaces in the manager
	 * @return number
	 */
	public function count()
	{
		return count( $this->namespaces );
	}

	/**
	 * Returns the value of the default namespace (the one with a blank prefix)
	 * @return string
	 */
	public function getDefaultNamespace()
	{
		return $this->defaultNamespace;
	}

	/**
	 * Get the iterator for foreach processing
	 */
	public function getIterator()
	{
		return new \ArrayIterator( $this->namespaces );
	}

	/**
	 * Access the available namespaces
	 */
	public function getNamespaces()
	{
		return $this->namespaces;
	}

	/**
	 * Return the namespaces.  At the moment $scope is ignored
	 * @param XmlNamespaceScope $scope
	 * @return array
	 */
	public function getNamespacesInScope( $scope = XmlNamespaceScope::All )
	{
		$namespaces = $this->namespaces;

		if ( $scope == XmlNamespaceScope::ExcludeXml )
		{
			// Make sure http://www.w3.org/XML/1998/namespace is not included
			if ( ( $prefix = $this->lookupPrefix( "http://www.w3.org/XML/1998/namespace" ) ) )
			{
				unset( $namespaces[ $prefix ] );
			}
		}
		return $namespaces;
	}

	/**
	 * Get the nametable instance from the manager
	 * @return XmlNameTable
	 */
	public function getNameTable()
	{
		return $this->nameTable;
	}

	/**
	 * Checks that $prefix is a member of the $namespaces array
	 * @param string $prefix
	 */
	public function hasNamespace( $prefix )
	{
		return isset( $this->namespaces[ $prefix ] );
	}

	/**
	 * Get the namespace associated with $prefix
	 * @param string $prefix
	 * @return string|bool
	 */
	public function lookupNamespace( $prefix )
	{
		if ( ! $this->hasNamespace( $prefix ) ) return false;
		return $this->namespaces[ $prefix ];
	}

	/**
	 * Get the prefix associated with $namespace
	 * @param string $namespace
	 * @return string|bool
	 */
	public function lookupPrefix( $namespace )
	{
		foreach ( $this->namespaces as $prefix => $value )
		{
			if ( strcasecmp( $namespace, $value ) === 0 ) return $prefix;
		}

		return false;
	}

	/**
	 * Pops a scope from the list.  At the moment this does nothing.
	 * @return void
	 */
	public function popScope()
	{
		// Do nothing
	}

	/**
	 * Pushes a scope into the list.  At the moment this does nothing.
	 * @return void
	 */
	public function pushScope()
	{
		// Do nothing
	}

	/**
	 * Remove the namespace associated with $prefix
	 * @param string $prefix
	 * @param string $namespace
	 * @return bool
	 */
	public function removeNamespace( $prefix, $namespace )
	{
		if ( ! $this->hasNamespace( $prefix ) ) return false;
		unset( $this->namespaces[ $prefix ] );
		return true;
	}

}

/**
 * Unit tests
 */
function Test()
{
	$xml = __DIR__ . "/../../tests/instance documents/uk-ae/Prod223_1329_04607019_20150131.xbrl";
	$doc = simplexml_load_file( $xml );
	if ( $doc === false ) return;
	$nsMgr = new XmlNamespaceManager();

	$nsMgr = new XmlNamespaceManager( $doc );
	echo "{$nsMgr->getDefaultNamespace()}\n";
	foreach( $nsMgr as $prefix => $namespace )
	{
		// echo "$prefix -> $namespace\n";
	}

	$nsMgr->addNamespace( "xbrli", "http://www.xbrl.org/2003/instance" );
	$nsMgr->addNamespace( "xml", "http://www.w3.org/XML/1998/namespace" );

	$nsMgr->removeNamespace( "ae", "http://www.companieshouse.gov.uk/ef/xbrl/uk/fr/gaap/ae/2009-06-21" );
	echo $nsMgr->lookupNamespace( "xlink" ) . "\n";
	echo $nsMgr->lookupPrefix( "http://www.w3.org/1999/xhtml" ) . "\n";

	$namespaces = $nsMgr->getNamespacesInScope( XmlNamespaceScope::ExcludeXml );
	echo "There are {$nsMgr->count()} namespaces\n";

}
